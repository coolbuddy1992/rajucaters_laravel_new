@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content outer-top-xs">
  <div class="container">
    <div class="row">
      <div class="col-md-3 sidebar"> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        @include('frontend.frontend_layout.body.side-menu')
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        @include('frontend.frontend_layout.category_page.shop-by-widget')
        <!-- /.sidebar-module-container --> 
      </div>
      <div class="col-md-9"> 
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            @if($menuSlug == "customize-menu")
            <div class="container-fluid">
              <div class="row justify-content-center">
                  <div class="col-lg-12 col-md-12 com-sm-12 col -xl-12">
                      <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                          <h2 id="heading">Build own menu</h2>
                          @php
                            $i = 1;
                            $totalcat = count($categories) + 1;
                          @endphp
                          <form id="msform">
                              <!-- progressbar -->
                              <input type="hidden" name="menu_id" id="menu_id" value="{{$getMenu->id}}">
                              <ul id="progressbar">
                                  @foreach($categories as $category)
                                    <li id="{{$category->category_slug_en}}" class="step"><strong>{{$category->category_name_en}}</strong></li>
                                  @endforeach
                                  <li id="review_menu" class="step"><strong>Review Menu</strong></li>
                              </ul>
                              <div class="progress">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div> <br> <!-- fieldsets -->

                              @foreach($categories as $category)
                                <fieldset class="menu_stepform">
                                  <div class="tab-menu">
                                      <div class="form-check form-switch">
                                          <input class="form-check-input categoryId" type="checkbox" id="statuscat_{{$category->category_name_en}}" name="category" data-category_id="{{$category->id}}" data-category="{{$category->category_name_en}}" value="{{$category->category_name_en}}">
                                          <label class="form-check-label" for="statuscat_{{$category->category_name_en}}">{{$category->category_name_en}}</label>
                                      </div>
                                      @if(!empty($category->products) && count($category->products) > 0)
                                        <div class="catproduct menu_title hide" id="catproduct_{{$category->id}}">
                                            <h5>Product</h5>
                                            @foreach($category->products as $products)
                                            @php
                                                $productcs = \App\Models\Product::where(['subcategory_id'=>$products->subcategory_id,'sub_subcategory_id'=>$products->sub_subcategory_id])->first();
                                            @endphp
                                                @if (empty($productcs->subcategory_id) && empty($productcs->sub_subcategory_id))
                                                <div class="form-check form-switch form-menu-checkbox">
                                                    <input class="form-check-input categoryprodId" type="checkbox" id="statuscatpro_{{$products->product_name_en}}" name="catpro" data-pro_category_id="{{$category->id}}" data-category_product_id="{{$products->id}}" data-category_product="{{$category->category_name_en}}" value="{{$products->product_name_en}}">
                                                    <label class="form-check-label" for="statuscatpro_{{$products->product_name_en}}">{{$products->product_name_en}}</label>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                      @endif
                                          @if(!empty($category->subcategory) && count($category->subcategory) > 0)
                                          <div class="submenu menu_title hide" id="subcat_{{$category->id}}">
                                              <h5>Sub Category</h5>
                                              @foreach($category->subcategory as $subcategory)
                                                  <div class="form-check form-switch">
                                                      <input class="form-check-input subcategoryId" type="checkbox" id="statussubcategoryId_{{$subcategory->subcategory_name_en}}" name="subcat" data-subcategory_id="{{$subcategory->id}}" data-subcategory="{{$subcategory->subcategory_name_en}}" data-subcategory_name="{{$subcategory->subcategory_name_en}}" value="{{$subcategory->subcategory_name_en}}">
                                                      <label class="form-check-label" for="statussubcategoryId_{{$subcategory->subcategory_name_en}}">{{$subcategory->subcategory_name_en}}</label>
                                                  </div>
                                                  @if (!empty($subcategory->products) && count($subcategory->products) > 0)
                                                      <div class="subcatproduct menu_title hide" id="subcatproduct_{{$subcategory->id}}">
                                                          <h5>Product</h5>
                                                          @foreach($subcategory->products as $products)
                                                          @php
                                                              $productcs = \App\Models\Product::where(['sub_subcategory_id'=>$products->sub_subcategory_id])->first();
                                                          @endphp
                                                          @if (empty($productcs->sub_subcategory_id))
                                                              <div class="form-check form-switch form-menu-checkbox">
                                                                  <input class="form-check-input subcategoryprodId" type="checkbox" id="statussubcategoryprodId_{{$products->product_name_en}}" name="subcatproduct" data-subcategory_product_id="{{$products->id}}" data-subcategory_product_name="{{$products->product_name_en}}"
                                                                  data-pro_subcategory_name="{{$subcategory->subcategory_name_en}}" value="{{$products->product_name_en}}">
                                                                  <label class="form-check-label" for="statussubcategoryprodId_{{$products->product_name_en}}">{{$products->product_name_en}}</label>
                                                              </div>
                                                          @endif
                                                          @endforeach
                                                      </div>
                                                  @endif
                                                  @if(!empty($subcategory->subsubcategory) && count($subcategory->subsubcategory) > 0)
                                                      <div class="subsubmenu menu_title hide" id="subsubmenu_{{$subcategory->id}}">
                                                          <h5>Sub-subcategory</h5>
                                                          @foreach($subcategory->subsubcategory as $subsubcategory)
                                                              <div class="form-check form-switch">
                                                                  <input class="form-check-input subsubcategoryId" type="checkbox" id="statussubsubcategoryId_{{$subsubcategory->subsubcategory_name_en}}" name="subsubcat" data-sub_subcategory_id="{{$subsubcategory->id}}" data-sub_subcategory="{{$subsubcategory->subsubcategory_name_en}}" data-subcategory_name="{{$subcategory->subcategory_name_en}}" value="{{$subsubcategory->subsubcategory_name_en}}">
                                                                  <label class="form-check-label" for="statussubsubcategoryId_{{$subsubcategory->subsubcategory_name_en}}">{{$subsubcategory->subsubcategory_name_en}}</label>
                                                              </div>
                                                              @if (!empty($subsubcategory->products) && count($subsubcategory->products) > 0)
                                                                  <div class="subsubproduct_menu menu_title hide" id="subsubcategoryId_{{$subsubcategory->id}}">
                                                                  <h5>Product</h5>
                                                                      @foreach($subsubcategory->products as $products)
                                                                          <div class="form-check form-switch form-menu-checkbox">
                                                                              <input class="form-check-input subsubcategoryprodId" type="checkbox" id="statussubsubcategoryprodId_{{$products->product_name_en}}" name="subsubcatproduct" data-sub_subcategory_product_id="{{$products->id}}" data-sub_subcategory_product="{{$products->product_name_en}}" data-subsubcategory_name="{{$subsubcategory->subsubcategory_name_en}}" value="{{$products->product_name_en}}">
                                                                              <label class="form-check-label" for="statussubsubcategoryprodId_{{$products->product_name_en}}">{{$products->product_name_en}}</label>
                                                                          </div>
                                                                      @endforeach
                                                                  </div>
                                                              @endif
                                                          @endforeach
                                                      </div>
                                                  @endif
                                              @endforeach
                                          </div>
                                          @endif
                                      </div>
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="submitMenu" class="submitMenu action-button-menu" value="Add Menu" />
                                </fieldset>
                              @endforeach
                             <fieldset>
                                  <div class="form-card">
                                      <div class="row justify-content-center" id="menutablecontainerCustom">
                                          <div class="showMenu">
                                            <p>No Menu Select</p>
                                          </div>
                                          <button type="button" class="btn btn-primary book-now-btn hide" data-menu_id="{{$getMenu->id}}" data-menu_type="{{$getMenu->slug_en}}" id="book_now"> Book Now </button>
                                      </div>
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
            </div>
            @else
            <div class="col col-sm-12 col-md-6">
              <div class="search-result-container menutablecontainer">
                  @foreach($bom_detail as $build_own_menu)
                    <h3 class="menu-name">{{$build_own_menu->menu_name_en}}</h3>
                    @foreach($build_own_menu->build_own_menu_list as $build_own_menu_list)
                      @php
                        $menuList = json_decode($build_own_menu_list->build_menu_list_name, true);
                      @endphp
                      <table border="1" class="menuTable">
                        
                          @foreach ($menuList as $menuData)
                          <tr>
                            @foreach($menuData['data'] as $menucat)
                              <td>{{$menucat['categoryName']}}</td>
                              <td>
                                <table>
                                  @if(!empty($menucat['categoryProduct']))
                                      <tr><td><table><thead><th>Product</th></thead><tbody>
                                      @foreach($menucat['categoryProduct'] as $catProDetail)
                                          <tr><td> {{$catProDetail}}</td></tr>
                                      @endforeach
                                      </tbody></table></td></tr>
                                  @endif
                                  <!-- For subcategory -->
                                  @if(!empty($menucat['subcategoryDetail']))
                                    <tr>
                                      <td>
                                        <table>
                                          @foreach($menucat['subcategoryDetail'] as $subcatDetail)
                                            <thead><th> {{$subcatDetail['subcategoryName']}}</th></thead>
                                            <!-- For subcategory Product -->
                                            @foreach($subcatDetail['subcatPro'] as $subcatProDetail)
                                                <tbody>
                                                @foreach($subcatProDetail['subcategoryPro'] as $subcategoryPro)
                                                    <tr><td>{{$subcategoryPro}}</td></tr>
                                                @endforeach
                                                </tbody>
                                            @endforeach
                                          @endforeach
                                        </table>
                                      </td>
                                    </tr>
                                  @endif
                                  @if(!empty($menucat['subsubcategoryDetail']))
                                    <tr>
                                        <td>
                                            <table>
                                            @foreach($menucat['subsubcategoryDetail'] as $subsubcatDetail)
                                                <thead><th> {{ $subsubcatDetail['subsubcategoryName'] }}</th></thead>
                                                <!-- For subsubcategory Product -->
                                                @foreach($subsubcatDetail['subsubcatProducts'] as $subsubcatProDetail)
                                                    <tbody>
                                                    @foreach($subsubcatProDetail['subsubcatprod'] as $subsubcategoryPro)
                                                        <tr><td> {{ $subsubcategoryPro }} </td></tr>
                                                    @endforeach
                                                    </tbody>
                                                @endforeach
                                            @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                                </table>
                              </td> 
                            @endforeach
                            </tr>
                          @endforeach
                      </table>
                    @endforeach
                    <button type="button" class="btn btn-primary book-now-btn" data-menu_id="{{$build_own_menu->id}}" id="book_now"> Book Now </button>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection