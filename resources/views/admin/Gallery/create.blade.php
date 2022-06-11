@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Gallery',
    'url' => "gallery.index",
    'section_name' => 'Add New Gallery'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Gallery Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Gallery</h3>
                        <a href="{{ route('gallery.index') }}" class="btn btn-primary">Back to Gallery List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-warning">Gallery Image Status Bar</h4>
                            <hr ><hr>
                            <div class="form-group mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                    id="status" name="gallery_status" value="1" checked>
                                    <label class="form-check-label" for="status">Active Status</label>
                                </div>
                            </div>
                            <h4 class="text-warning">Gallery Image Information</h4>
                            <hr><hr>
                            <div class="form-group">
                                <h5>Gallery Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="gallery_name" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('gallery_name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <h4 class="text-warning">Gallery Single Image Upload</h4>
                            <hr><hr>
                            <div class="form-group">
                                <h5>Gallery Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="gallery_image" class="form-control" required="" data-validation-required-message="This field is required"
                                    onchange="galleryShow(this)"> <div class="help-block"></div>
                                </div>
                                @error('gallery_image')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                                <img src="" id="galleryImage" alt="">
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
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
        function galleryShow(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#galleryImage').attr('src', e.target.result).width(100).height(100);
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
