<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build_own_menu;
use App\Models\Build_own_menu_list;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Session;

class OwnMenuGenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::forget('menuDetail');
        Session::forget('jsonmenuDetail');
        Session::forget('menuDetailHtml');


        $getMenu = Build_own_menu::where('id', $request->id)->first();
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        return view('admin.PerosonalMenuGenerate.create', compact('getMenu', 'categories'));
    }

    public function showMenuDetail($menuId)
    {
        $bml = Build_own_menu_list::with(['build_own_menu'])->where('build_menu_id',$menuId)->latest()->get();
        return view('admin.PerosonalMenuGenerate.index', compact('bml'));  
    }

    public function showMenuListDetail($menu_id)
    {
        $bml = Build_own_menu_list::with(['build_own_menu'])->where('build_menu_id',$menu_id)->latest()->get();
        return view('admin.PerosonalMenuGenerate.showMenuList', compact('bml'));
        // return json_decode($bml[0]['build_menu_list_name'], True);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menuDetail = Session::get('jsonmenuDetail');
        $finalMenu = end($menuDetail);
        $json = json_encode($finalMenu);
        $json_menu = json_decode($json, TRUE);

        Build_own_menu_list::create([
            'build_menu_id' => $request->input('build_menu_id'),
            'build_menu_list_name' => $json_menu,
        ]);

        $notification = [
            'message' => 'Menu List Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('show-menu-list')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMenuList()
    {
        $bml = Build_own_menu_list::with(['build_own_menu'])->latest()->get();
        // dd($bml);
        return view('admin.PerosonalMenuGenerate.index', compact('bml'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchForValue($menuDataCheck, $array) {
        // return($array);
        foreach ($array as $menuList) {
            foreach ($menuList as $menuDetail) {
                foreach ($menuDetail['categoryDetail'] as $categoryList) {
                    if ($categoryList == $menuDataCheck) {
                        return(end($array));
                    }
                }   
            }
        }
        return null;
     }

    public function array_multi_unique($multiArray){

        $uniqueArray = array();
      
        foreach($multiArray as $subArray){
            foreach($subArray as $subArrayUnique){
                print_r($subArrayUnique);
                foreach($subArrayUnique as $arryUnique){
                }
            }
        }
        // return $uniqueArray;
      }


    public function getMenu(Request $request)
    {
        $category = $request->category;
        $categoryProduct = $request->categoryProduct;
        $subcategory = $request->subcatwithpro;
        $subsubcategory = $request->subsubcatwithpro;
        $catpro = [];
        $subcatData = [];
        $subsubcatData = [];

        // category product
        if (!empty($categoryProduct)) {
            foreach ($categoryProduct as $product) {
                if (!empty($product)) {
                    foreach ($product as $catproduct) {
                        $catpro[] = $catproduct;
                    }
                }
            }
        }

        //subcategory and subcategory product
        if (!empty($subcategory)) {
            foreach ($subcategory as $subcat) {
                $subcatNm = $subcat['subcatName'];
                $subcatProduct = [];
                if (!empty($subcat['product'])) {
                    foreach ($subcat['product'] as $subcatpro) {
                        $subcatProduct[$subcatNm]['subcategoryPro'][] = $subcatpro;
                    }
                }
                $subcatData[] = ['subcategoryName' => $subcat['subcatName'], 'subcatPro' => $subcatProduct ];
            }
        }

        //subsubcategory and subsubcategory product
        if (!empty($subsubcategory)) {
            foreach ($subsubcategory as $subsubcat) {
                $subsubcatName = $subsubcat['subsubcatName'];
                $subsubcatProduct = [];
                if (!empty($subsubcat['product'])) {
                    foreach($subsubcat['product'] as $subsubcatpro){
                        $subsubcatProduct[$subsubcatName]['subsubcatprod'][] = $subsubcatpro;
                    }
                }
                $subsubcatData[] = ['subsubcategoryName' => $subsubcat['subsubcatName'], 'subsubcatProducts' => $subsubcatProduct ];
            }
        }
        
        $menuData = ["data" => ["categoryDetail" => ["categoryName" => $category, "categoryProduct" => $catpro,"subcategoryDetail"=> $subcatData, "subsubcategoryDetail"=> $subsubcatData]]];
        
        // print_r($menuData);
        
        Session::push('menuDetail', $menuData);

        $menuSession = array_map("unserialize", array_unique(array_map("serialize", Session::get('menuDetail'))));
        
        // $menuArray = $this->array_multi_unique($menuSession);
        // print_r($menuArray);
        

        $jsonConvertMenu = json_encode($menuSession);
        $jsonData = Session::push('jsonmenuDetail', $jsonConvertMenu);
        
        $html = '<table border="1">';

        foreach($menuSession as $menuDatas){
            foreach($menuDatas['data'] as $menucat){
                $html .= '<thead><th>'.$menucat['categoryName'] .'</th></thead>';
                $html .= '<tbody>';
                // For category Product
                if(!empty($menucat['categoryProduct'])){
                    $html .= '<tr><td><table><thead><th>Product</th></thead><tbody>';
                    foreach($menucat['categoryProduct'] as $catProDetail){
                        $html .= '<tr><td>' .$catProDetail. '</td></tr>';
                    }
                    $html .= '</tbody></table></td></tr>';
                }
                // For subcategory
                if(!empty($menucat['subcategoryDetail'])){
                    $html .= '<tr><td><table>';
                    foreach($menucat['subcategoryDetail'] as $subcatDetail){
                        $html .= '<thead><th>' .$subcatDetail['subcategoryName']. '</th></thead>';
                        // For subcategory Product
                        foreach($subcatDetail['subcatPro'] as $subcatProDetail){
                            $html .= '<tbody>';
                            foreach($subcatProDetail['subcategoryPro'] as $subcategoryPro){
                                $html .= '<tr><td>' .$subcategoryPro. '</td></tr>';
                            }
                            $html .= '</tbody>';
                        }
                    }
                    $html .= '</table></td></tr>';
                }

                // For subsubcategory
                if(!empty($menucat['subsubcategoryDetail'])){
                    $html .= '<tr><td><table>';
                    foreach($menucat['subsubcategoryDetail'] as $subsubcatDetail){
                        $html .= '<thead><th>' .$subsubcatDetail['subsubcategoryName']. '</th></thead>';
                        // For subsubcategory Product
                        foreach($subsubcatDetail['subsubcatProducts'] as $subsubcatProDetail){
                            $html .= '<tbody>';
                            foreach($subsubcatProDetail['subsubcatprod'] as $subsubcategoryPro){
                                $html .= '<tr><td>' .$subsubcategoryPro. '</td></tr>';
                            }
                            $html .= '</tbody>';
                        }
                    }
                    $html .= '</table></td></tr>';
                }
            
                $html .= '</tbody>';
            }
        }

        $html .= '</table>';

        
        
        // Session::push('menuDetailHtml', $html);

        $menuresponse = ['menuData'=> $html ,'success' => 'Menu added Successfully, Please click next button to add more menu'];
        
        return $menuresponse;
    }
}