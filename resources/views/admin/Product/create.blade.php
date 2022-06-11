@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Product',
    'url' => "products.index",
    'section_name' => 'Create Product'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Category Page --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Product</h3>
                        <a href="{{ route('subsubcategories.index') }}" class="btn btn-primary">Back List Product</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- First row start--}}
                            <h5 class="text-warning">Product Related Category and Brand Selection Area</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Category Name <span class="text-danger">*</span></h5>
                                        <select class="custom-select" aria-label="Default select example" name="category_id">
                                            <option selected>Select Category Name</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 subcatcheck">
                                    <div class="form-group">
                                        <h5>SubCategory Name <span class="text-danger">*</span></h5>
                                        <select class="custom-select" name="subcategory_id" aria-label="Default select example">
                                            <option value="" selected="" disabled="">Select SubCategory Name</option>
                                        </select>
                                        @error('subcategory_id')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 subsubcatcheck">
                                    <div class="form-group">
                                        <h5>Sub-SubCategory Name <span class="text-danger">*</span></h5>
                                        <select class="custom-select" name="sub_subcategory_id" aria-label="Default select example">
                                            <option value="" selected="" disabled="">Select Sub-SubCategory Name</option>
                                        </select>
                                        @error('sub_subcategory_id')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- First row end --}}
                            <h5 class="text-warning mt-4">Product Basic Information Area</h5>
                            <hr>
                            {{-- Second row start --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Product Name EN <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_en" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                        @error('product_name_en')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Product Name HI <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_hi" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                        @error('product_name_hi')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Product SKU Code # <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control"> <div class="help-block"></div>
                                        </div>
                                        @error('product_code')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Product Qty <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="product_qty" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                        @error('product_qty')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Second row end --}}
                            <h5 class="text-warning mt-4">Product Tag Information Area</h5>
                            <hr>
                            {{-- Third row start --}}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5>Product Tag EN <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" class="form-control" value="lorem, Ipsum, Amet" data-role="tagsinput"> <div class="help-block"></div>
                                        </div>
                                        @error('product_tags_en')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5>Product Tag HI <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_hi" class="form-control" value="lorem, Ipsum, Amet" data-role="tagsinput"> <div class="help-block"></div>
                                        </div>
                                        @error('product_tags_hi')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Third row end --}}
                            <h5 class="text-warning mt-4">Product Description Area</h5>
                            <hr>
                            {{-- Fifth row start --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Short Description EN <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <textarea name="short_description_en" id="editor1" cols="30" rows="5" class="form-control"></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                        @error('short_description_en')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Short Description HI <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <textarea name="short_description_hi" id="editor2" cols="30" rows="5" class="form-control"></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                        @error('short_description_hi')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Fifth row end --}}
                            {{-- Sixth row start --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Long Description EN <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <textarea name="long_description_en" id="editor3" cols="30" rows="5" class="form-control"></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                        @error('long_description_en')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Long Description HI <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <textarea name="long_description_hi" id="editor4" cols="30" rows="5" class="form-control"></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                        @error('long_description_hi')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Sixth row end --}}
                            <h5 class="text-warning mt-4">Product Image Upload Area</h5>
                            <hr>
                            {{-- Seventh row start --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Thumbnail <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thumbnail" class="form-control" required="" data-validation-required-message="This field is required"
                                            onChange="mainThumbnailShow(this)"> <div class="help-block"></div>
                                        </div>
                                        @error('product_thumbnail')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                        <img src="" id="mainThumbnail" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Multiple Image <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_images[]" class="form-control"  multiple="" id="multiImg" > <div class="help-block"></div>
                                        </div>
                                        @error('product_images')
                                            <span class="alert text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- Seventh row end --}}
                            {{-- Eighth row start --}}
                            <h5 class="text-warning mt-4">Product Additional Information Area</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                        id="status" name="status" checked value="1">
                                        <label class="form-check-label" for="status">Active Status</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@section('dashboard_script')
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          console.log(category_id)
          if(category_id) {
              $.ajax({
                  url: "{{  url('/admin/category/subcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    $('select[name="subcategory_id"]').html('<option>Select SubCategory</option>');
                    //var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                  },
              });
          } else {
            alert('danger');
          }
      });
      $('select[name="subcategory_id"]').on('change', function(){
          var subcategory_id = $(this).val();
          if(subcategory_id) {
              $.ajax({
                  url: "{{  url('/admin/category/subsubcategory/ajax') }}/"+subcategory_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    $('select[name="sub_subcategory_id"]').html('<option>Select Sub-SubCategory</option>');
                    //var d =$('select[name="sub_subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                        });
                  },
              });
          } else {
            
            alert('danger');
          }
      });
      $(document).ready(function(){
    $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
    });
  });
</script>
<script type="text/javascript">
    function mainThumbnailShow(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumbnail').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="{{ asset('') }}assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
<script src="{{ asset('') }}assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script src="{{ asset('backend') }}/js/pages/editor.js"></script>
@endsection
@endsection
