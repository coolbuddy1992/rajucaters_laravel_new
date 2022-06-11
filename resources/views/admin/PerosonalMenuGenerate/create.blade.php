{{--@foreach($categories as $category)
{{dd($category->subcategory->products)}}
@endforeach
{{dd('1')}}--}}
@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Personal Menu Generate',
    'url' => "OwnMenuGenerate.index",
    'section_name' => 'Personal Menu Generate'
    ])
    
    <section class="content">
        <div class="row">
            {{-- Add Menu Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Menu</h3>
                        <a href="{{ route('buildOwnMenu.index') }}" class="btn btn-primary">Back List Menu</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('OwnMenuGenerate.store') }}" method="post" enctype="multipart/form-data" class="stepform">
                            @csrf
                            <input class="hide" name="build_menu_id" value="{{$getMenu->id}}">
                            <div class="all-steps" id="all-steps">@foreach($categories as $category) <span class="step"></span>@endforeach<span class="step"></span></div>
                            @foreach($categories as $category)
                            <div class="tab">
                                <div class="form-check form-switch">
                                    <input class="form-check-input categoryId" type="checkbox" id="statuscat_{{$category->category_name_en}}" name="category" data-category_id="{{$category->id}}" data-category="{{$category->category_name_en}}" value="{{$category->category_name_en}}">
                                    <label class="form-check-label" for="statuscat_{{$category->category_name_en}}">{{$category->category_name_en}}</label>
                                </div>
                                @if(!empty($category->products) && count($category->products) > 0)
                                <div class="catproduct hide" id="catproduct_{{$category->id}}">
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
                                <div class="submenu hide" id="subcat_{{$category->id}}">
                                    <h5>Sub Category</h5>
                                    @foreach($category->subcategory as $subcategory)
                                        <div class="form-check form-switch">
                                            <input class="form-check-input subcategoryId" type="checkbox" id="statussubcategoryId_{{$subcategory->subcategory_name_en}}" name="subcat" data-subcategory_id="{{$subcategory->id}}" data-subcategory="{{$subcategory->subcategory_name_en}}" data-subcategory_name="{{$subcategory->subcategory_name_en}}" value="{{$subcategory->subcategory_name_en}}">
                                            <label class="form-check-label" for="statussubcategoryId_{{$subcategory->subcategory_name_en}}">{{$subcategory->subcategory_name_en}}</label>
                                        </div>
                                        @if (!empty($subcategory->products) && count($subcategory->products) > 0)
                                            <div class="subcatproduct hide" id="subcatproduct_{{$subcategory->id}}">
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
                                            <div class="subsubmenu hide" id="subsubmenu_{{$subcategory->id}}">
                                                <h5>Sub-subcategory</h5>
                                                @foreach($subcategory->subsubcategory as $subsubcategory)
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input subsubcategoryId" type="checkbox" id="statussubsubcategoryId_{{$subsubcategory->subsubcategory_name_en}}" name="subsubcat" data-sub_subcategory_id="{{$subsubcategory->id}}" data-sub_subcategory="{{$subsubcategory->subsubcategory_name_en}}" data-subcategory_name="{{$subcategory->subcategory_name_en}}" value="{{$subsubcategory->subsubcategory_name_en}}">
                                                        <label class="form-check-label" for="statussubsubcategoryId_{{$subsubcategory->subsubcategory_name_en}}">{{$subsubcategory->subsubcategory_name_en}}</label>
                                                    </div>
                                                    @if (!empty($subsubcategory->products) && count($subsubcategory->products) > 0)
                                                        <div class="subsubproduct_menu hide" id="subsubcategoryId_{{$subsubcategory->id}}">
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
                            @endforeach
                            <div class="tab">
                                <div class="showMenu">
                                </div>
                            </div>
                            <div style="overflow:auto;" id="nextprevious">
                                <div style="float:right;"> 
                                     <button type="button" class="submitMenu" id="finalnextBtn">AddMenu</button>
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> 
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    <button type="submit" id="showSubmitbtn" class="hide">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
