@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Build Own Menu',
    'url' => "buildOwnMenu.index",
    'section_name' => 'Edit Menu
    ])
    <section class="content">
        <div class="row">
            {{-- Add Menu Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Update Menu</h3>
                        <a href="{{ route('buildOwnMenu.index') }}" class="btn btn-primary">Back List Menu</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('buildOwnMenu.update', $bom) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <h5>Menu Name EN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('menu_name_en', $bom->menu_name_en) }}" name="menu_name_en" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('menu_name_en')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Menu Name HI <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('menu_name_hi', $bom->menu_name_hi) }}" name="menu_name_hi" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('menu_name_hi')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                        id="status" name="status" checked value="1" {{ $bom->status == 1 ? 'checked': '' }}>
                                        <label class="form-check-label" for="status">Active Status</label>
                                    </div>
                                </div>
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
@endsection
