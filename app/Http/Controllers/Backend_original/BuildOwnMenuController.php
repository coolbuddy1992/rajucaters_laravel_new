<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuildOwnMenuStoreRequest;
use App\Http\Requests\BuildOwnMenuUpdateRequest;
use App\Models\Build_own_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\FileUploadController;

class BuildOwnMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bom = Build_own_menu::all();
        return view('admin.BuildOwnMenu.index', compact('bom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.BuildOwnMenu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildOwnMenuStoreRequest $request)
    {
        Build_own_menu::create([
                'menu_name_en' => $request->input('menu_name_en'),
                'menu_name_hi' => $request->input('menu_name_hi'),
                'slug_en' => Str::slug($request->input('menu_name_en')),
                'slug_hi' => (new FileUploadController)->add_hypen($request->input('menu_name_hi')),
                'status' => $request->input('status')|false
            ]);

        $notification = [
            'message' => 'Menu Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('buildOwnMenu.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Build_own_menu $bom, $id)
    {
        $bom = Build_own_menu::where('id', $id)->first();
        return view('admin.BuildOwnMenu.edit', compact('bom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuildOwnMenuUpdateRequest $request, Build_own_menu $bom, $id)
    {
        $bom = Build_own_menu::where('id', $id)->first();
        $bom->update([
                'menu_name_en' => $request->input('menu_name_en'),
                'menu_name_hi' => $request->input('menu_name_hi'),
                'slug_en' => Str::slug($request->input('menu_name_en')),
                'slug_hi' => (new FileUploadController)->add_hypen($request->input('menu_name_hi')),
                'status' => $request->input('status')|false
            ]);

        $notification = [
            'message' => 'Menu Updated Successfully!!!',
            'alert-type' => 'info'
        ];

        return redirect()->route('buildOwnMenu.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Build_own_menu $bom)
    {
        $bom->delete();

        $notification = [
            'message' => 'Menu Deleted Successfully!!!',
            'alert-type' => 'warning'
        ];

        return redirect()->route('buildOwnMenu.index')->with($notification);
    }

    /**
     * Build Menu Change Status
     */

     public function buildmenuchangestatus(Request $request)
     {
        $bom = Build_own_menu::findOrFail($request->menu_id);
        $bom->status = $request->status;
        $bom->save();

        return response()->json(['success'=>'Menu status change successfully.']);
     }
}
