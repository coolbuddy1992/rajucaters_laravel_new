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
      <!-- /.sidebar -->
      <div class="col-md-9"> 
        @foreach($gallery as $galleries)
          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a href="{{$galleries->photo_location}}" class="fancybox" rel="ligthbox">
                <img  src="{{$galleries->photo_location}}" class="zoom img-fluid "  alt="">
               
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection