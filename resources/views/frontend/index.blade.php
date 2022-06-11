@extends('frontend.frontend_master')

@section('title')
    Raju Caters
@endsection

@section('frontend_content')
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!--  SIDEBAR  -->
               @include('frontend.frontend_layout.body.sidebar')
            <!--  SIDEBAR : END  -->
            <!--  CONTENT  -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- SECTION – HERO  -->
                {{--@include('frontend.frontend_layout.home_page.hero-section')--}}
                <!--  SECTION – HERO : END  -->

                <!--  INFO BOXES  -->
                {{--@include('frontend.frontend_layout.home_page.info-boxes')--}}
                <!--  INFO BOXES : END  -->
                <!--  SCROLL TABS  -->
                {{--@include('frontend.frontend_layout.home_page.new-products')--}}
                <!-- /.scroll-tabs -->
                <!--  SCROLL TABS : END  -->
                <!--  WIDE PRODUCTS  -->
                {{--@include('frontend.frontend_layout.home_page.two-column-banner')--}}
                <!--  WIDE PRODUCTS : END  -->


                <!--  FEATURED PRODUCTS  -->
                {{--@include('frontend.frontend_layout.home_page.featured-products')--}}
                <!-- /.section -->
                <!--  FEATURED PRODUCTS : END  -->

                <!--  WIDE PRODUCTS  -->
                {{--@include('frontend.frontend_layout.home_page.middle-banner')--}}
                <!--  WIDE PRODUCTS : END  -->
                @if(count($skip_category_products_0) > 0)
                    <!--  Category wise PRODUCTS  -->
                    <?php echo 'hello';?>
                    @include('frontend.frontend_layout.home_page.categorywise')
                    <!-- /.section -->
                    <!--  Category wise PRODUCTS : END  -->
                @else
                    <!--  Category wise PRODUCTS  -->
                    @include('frontend.frontend_layout.home_page.gallery-carousel')
                    <!-- /.section -->
                    <!--  Category wise PRODUCTS : END  -->
                @endif

                <!--  Category wise PRODUCTS  -->
                {{--@include('frontend.frontend_layout.home_page.brandwise')--}}
                <!-- /.section -->
                <!--  Category wise PRODUCTS : END  -->
                <!--  BEST SELLER  -->
                {{--@include('frontend.frontend_layout.home_page.best-seller')--}}
                <!-- /.sidebar-widget -->
                <!--  BEST SELLER : END  -->

                <!--  BLOG SLIDER  -->
                {{--@include('frontend.frontend_layout.home_page.blog-slider')--}}
                <!--  BLOG SLIDER : END  -->

                <!--  FEATURED PRODUCTS  -->
                @include('frontend.frontend_layout.home_page.new-arrivals')
                <!--  FEATURED PRODUCTS : END  -->

            </div>
            <!-- /.homebanner-holder -->
            <!--  CONTENT : END  -->
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
@endsection
