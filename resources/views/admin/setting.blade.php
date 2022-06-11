@extends('admin.admin_master')

@section('title', 'Web Profile Setting')

@section('dashboard_content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Admin Profile Edit Form</h4>
                    </div>
                    <div class="box-body">
                                <form action="{{ route('admin.setting.upadte', $editData) }}" method="POST" enctype="multipart/form-data">
                                    <!-- @method('PUT') -->
                                    @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Website Title <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_title" value="{{ !empty($editData->website_title) ? $editData->website_title : ''}}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_title')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="website_email" value="{{ !empty($editData->website_email) ? $editData->website_email : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_email')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="website_address" class="form-control">{{ !empty($editData->website_address) ? $editData->website_address : '' }}</textarea><div class="help-block"></div>
                                            </div>
                                            @error('website_address')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Address City <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_address_city" value="{{ !empty($editData->website_address_city) ? $editData->website_address_city : ''}}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_address_city')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Address State <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_address_state" value="{{ !empty($editData->website_address_state) ? $editData->website_address_state : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_address_state')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Address Pin <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_address_pin" value="{{ !empty($editData->website_address_pin) ? $editData->website_address_pin : ''}}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_address_pin')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Phone 1 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_phone_1" value="{{ !empty($editData->website_phone_1) ? $editData->website_phone_1 : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_phone_1')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Phone 2 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_phone_2" value="{{ !empty($editData->website_phone_2) ? $editData->website_phone_2 : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_phone_2')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Phone 3 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_phone_3" value="{{ !empty($editData->website_phone_3) ? $editData->website_phone_3 : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_phone_3')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Phone 4 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="website_phone_4" value="{{ !empty($editData->website_phone_4) ? $editData->website_phone_4 : '' }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                            @error('website_phone_4')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Logo <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="website_logo" id="website_logo" class="form-control" required=""> <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 widget-user-image">
                                            <img  id="show-image-logo" class="rounded-circle" src="{{ !empty($editData->website_logo) ? $editData->website_logo : ''}}" alt="User Avatar" style="float: right" width="100px" height="100px">
                                        </div>
                                        <div class="form-group">
                                            <h5>Website Favicon <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="website_favicon" id="website_favicon" class="form-control" required=""> <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 widget-user-image">
                                            <img  id="show-image-favicon" class="rounded-circle" src="{{ !empty($editData->website_favicon) ? $editData->website_favicon : ''}}" alt="User Avatar" style="float: right" width="100px" height="100px">
                                        </div>
                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
    </section>
    @section('dashboard_script')
    <script type="text/javascript">
        $(document).ready(function(){
        // For Logo
        $('#website_logo').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#show-image-logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        // For Favicon

        $('#website_favicon').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#show-image-favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
    </script>
    @endsection
@endsection
