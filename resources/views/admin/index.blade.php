@extends('admin.admin_master')

@section('dashboard_content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-primary-light rounded w-60 h-60">
                        <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">New Customers</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$user}} <small class="text-success"><i class="fa fa-caret-up"></i> {{(($user*10)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-warning-light rounded w-60 h-60">
                        <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Total Orders</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$order}} <small class="text-success"><i class="fa fa-caret-up"></i> {{(($order*100)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-info-light rounded w-60 h-60">
                        <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Total Build Menu</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$bomCount}} <small class="text-success"><i class="fa fa-caret-up"></i> {{(($bomCount*5)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-warning-light rounded w-60 h-60">
                        <i class="text-warning mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Total Category</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$category}} <small class="text-success"><i class="fa fa-caret-up"></i>{{(($category*30)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-success-light rounded w-60 h-60">
                        <i class="text-success mr-0 font-size-24 mdi mdi-phone-outgoing"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Total Product</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$product}}<small class="text-success"><i class="fa fa-caret-up"></i>{{(($product*500)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">                          
                    <div class="icon bg-success-light rounded w-60 h-60">
                        <i class="text-success mr-0 font-size-24 mdi mdi-phone-outgoing"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Total Reviews</p>
                        <h3 class="text-white mb-0 font-weight-500">{{$reviewCount}}<small class="text-success"><i class="fa fa-caret-up"></i>{{(($reviewCount*500)/100)}}%</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection