@extends('frontend.frontend_master')

@section('frontend_content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row single-product">
                <div class="col-md-3 sidebar">
                    <div class="sidebar-module-container">
                        <!-- <div class="home-banner outer-top-n">
                            <img src="{{ asset('frontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
                        </div> -->
                        <!--  NEWSLETTER  -->
                        @include('frontend.frontend_layout.widgets.newsletter-widget')
                        <!--  NEWSLETTER: END  -->

                        <!--  Testimonials -->
                        @include('frontend.frontend_layout.widgets.testimonial-widget')
                        <!--  Testimonials: END  -->

                    </div>
                </div><!-- /.sidebar -->
                <div class="col-md-9">
                    <div class="detail-block">
                        <div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide{{ $product->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{!empty($product->product_thumbnail) ? $product->product_thumbnail : env('PRODUCT_IMAGE')}}">
                                            <img class="img-responsive" alt="" src="{{!empty($product->product_thumbnail) ? $product->product_thumbnail : env('PRODUCT_IMAGE')}}" data-echo="{{!empty($product->product_thumbnail) ? $product->product_thumbnail : env('PRODUCT_IMAGE')}}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    </div><!-- /.single-product-slider -->

                                    <div class="single-product-gallery-thumbs gallery-thumbs">
                                        <div id="owl-single-product-thumbnails">
                                        @foreach($product_gallery->images as $img)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                                </a>
                                            </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->
                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class="col-sm-6 col-md-7 product-info-block">
                                <div class="product-info">
                                    <h1 class="name" id="pname">
                                        @if (session()->get('language') =='hindi')
                                        {{ $product->product_name_hi }}
                                        @else
                                        {{ $product->product_name_en }}
                                        @endif
                                    </h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <!-- <div class="rating rateit-small rateit">
                                                    <button id="rateit-reset-5"
                                                        data-role="none" class="rateit-reset" aria-label="reset rating"
                                                        aria-controls="rateit-range-5" style="display: none;"></button>
                                                    <div id="rateit-range-5" class="rateit-range" tabindex="0" role="slider"
                                                        aria-label="rating" aria-owns="rateit-reset-5" aria-valuemin="0"
                                                        aria-valuemax="5" aria-valuenow="4" aria-readonly="true"
                                                        style="width: 70px; height: 14px;">
                                                        <div class="rateit-selected" style="height: 14px; width: 56px;">
                                                        </div>
                                                        <div class="rateit-hover" style="height:14px"></div>
                                                    </div>
                                                </div> -->
                                                <div class="mt-5 d-flex justify-content-between align-items-center">
                                                    <?php 
                                                        $rate = 1;
                                                        $total = 0;
                                                        $finalRate;
                                                        foreach($reviewRating as $ratingCount){
                                                            $total = $total+$ratingCount->rating;
                                                        }
                                                        $finalRate = round($total/5);
                                                    ?>
                                                    <div class="small-ratings">
                                                        @if($finalRate == 1)
                                                            <i class="fa fa-star rating-color"></i>
                                                            @for($i=1; $i <= 4; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        @elseif($finalRate == 2)
                                                            @for($i=1; $i <= 2; $i++)
                                                                <i class="fa fa-star rating-color"></i>
                                                            @endfor
                                                            @for($i=1; $i <= 3; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        @elseif($finalRate == 3)
                                                            @for($i=1; $i <= 3; $i++)
                                                                <i class="fa fa-star rating-color"></i>
                                                            @endfor
                                                            @for($i=1; $i <= 2; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        @elseif($finalRate == 4)
                                                            @for($i=1; $i <= 4; $i++)
                                                                <i class="fa fa-star rating-color"></i>
                                                            @endfor
                                                            <i class="fa fa-star"></i>
                                                        @elseif($finalRate == 5)
                                                            @for($i=1; $i <= 5; $i++)
                                                                <i class="fa fa-star rating-color"></i>
                                                            @endfor
                                                        @else
                                                            @for($i=1; $i <= 5; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">({{$reviewCount}} Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    {{--<div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    @if ($product->product_qty<1)
                                                    <span class="value">Out of Stock</span>
                                                    @else
                                                    <span class="value">In Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div>--}}<!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if (session()->get('language') == 'hindi')
                                        {!! $product->short_description_hi !!}
                                        @else
                                        {!! $product->short_description_en !!}
                                        @endif
                                    </div><!-- /.description-container -->
                                    
                                    <!-- <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="number" id="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-7">
                                                <input type="hidden" name="" id="product_id" value="{{ $product->id }}" min="1">
                                                <button type="submit" class="btn btn-primary" onclick="addToCart()">
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>


                                        </div>
                                    </div> -->
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>
                    <div class="product-tabs inner-bottom-xs  wow fadeInUp animated"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                @if (session()->get('language') == 'hindi')
                                                {!! $product->long_description_hi !!}
                                                @else
                                                {!! $product->long_description_en !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary">We love this
                                                                product</span><span class="date"><i
                                                                    class="fa fa-calendar"></i><span>1 days
                                                                    ago</span></span></div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit.Aliquam suscipit."</div>
                                                    </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->


                                            <form role="form" class="cnt-form" id="user_review_form" enctype="multipart/form-data">
                                                <div class="product-add-review">
                                                    <h4 class="title">Write your own review</h4>
                                                    <div class="review-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="5"></td>
                                                                    </tr>
                                                                    <!-- <tr>
                                                                        <td class="cell-label">Price</td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="5"></td>
                                                                    </tr> -->
                                                                    <!-- <tr>
                                                                        <td class="cell-label">Value</td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio"
                                                                                value="5"></td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table><!-- /.table .table-bordered -->
                                                        </div><!-- /.table-responsive -->
                                                    </div><!-- /.review-table -->

                                                    <div class="review-form">
                                                        <div class="form-container">
                                                            <!-- <form role="form" class="cnt-form"> -->

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName">Your Name <span
                                                                                    class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt"
                                                                                name="user_review_name">
                                                                            <input type="hidden" class="form-control txt"
                                                                                name="user_review_type"
                                                                                id="exampleInputName" value="Product Review">
                                                                            <input type="hidden" class="form-control txt"
                                                                                name="product_detail"
                                                                                id="product_detail" value="{{$product->product_name_en}}">
                                                                            <input type="hidden" class="form-control txt"
                                                                                name="product_id"
                                                                                id="product_id" value="{{$product->id}}">
                                                                        </div><!-- /.form-group -->
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName"> Review Image <span
                                                                                    class="astk">*</span></label>
                                                                            <input type="file" class="form-control txt" id="user_review_image"
                                                                                name="user_review_image">
                                                                        </div><!-- /.form-group -->
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span
                                                                                    class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review"
                                                                                id="exampleInputReview" rows="4"
                                                                                name="user_review"
                                                                                placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit" class="btn btn-primary btn-upper" id="submit_user_review">SUBMIT
                                                                        REVIEW</button>
                                                                </div><!-- /.action -->

                                                            <!-- </form> -->
                                                        </div><!-- /.form-container -->
                                                    </div><!-- /.review-form -->

                                                </div><!-- /.product-add-review -->
                                            </form>

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">
                                            <h4 class="title">Product Tags</h4>
                                            <div class="form-container">
                                                <div class="form-group">
                                                    <label for="exampleInputTag">{{$product->product_tags_en}}</label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!--  UPSELL PRODUCTS  -->
                    @include('frontend.frontend_layout.product_page.up-sell-products')
                    <!--  UPSELL PRODUCTS : END  -->
                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div>
            <!-- /.row -->
            <!--  BRANDS CAROUSEL  -->
            {{-- @include('frontend.frontend_layout.home_page.brands-carousel') --}}
            <!-- /.logo-slider -->
            <!--  BRANDS CAROUSEL : END  -->
        </div>
        <!-- /.container -->

    </div>
@endsection
