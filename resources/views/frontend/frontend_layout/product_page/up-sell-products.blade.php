<section class="section featured-product wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
    <h3 class="section-title">Related products</h3>
    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs"
        style="opacity: 1; display: block;">

        <div class="owl-wrapper-outer">
            <div class="owl-wrapper" style="width: 2484px; left: 0px; display: block;">
                @foreach ($related_products as $product)
                <?php $reviewRatingRelated = App\Models\Review::where('product_id' , $product->id)->get();?>
                <div class="owl-item" style="width: 207px;">
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}"><img src="{{!empty($product->product_thumbnail) ? $product->product_thumbnail : env('PRODUCT_IMAGE')}}" alt="">
                                        </a>
                                    </div><!-- /.image -->

                                    <!-- <div class="tag sale"><span>sale</span></div> -->
                                </div><!-- /.product-image -->
                                <div class="product-info text-center">
                                    <h3 class="name"><a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                        @if (session()->get('language') == 'hindi')
                                            {{ $product->product_name_hi }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a></h3>
                                    {{--<div class="rating rateit-small rateit">
                                        <button id="rateit-reset-6" data-role="none"
                                            class="rateit-reset" aria-label="reset rating"
                                            aria-controls="rateit-range-6" style="display: none;">
                                        </button>
                                        <div id="rateit-range-6" class="rateit-range" tabindex="0" role="slider"
                                            aria-label="rating" aria-owns="rateit-reset-6" aria-valuemin="0"
                                            aria-valuemax="5" aria-valuenow="4" aria-readonly="true"
                                            style="width: 70px; height: 14px;">
                                            <div class="rateit-selected" style="height: 14px; width: 56px;"></div>
                                            <div class="rateit-hover" style="height:14px"></div>
                                        </div>
                                    </div>
                                    <div class="description"></div>--}}
                                    <div class="mt-5 d-flex justify-content-between align-items-center">
                                        <?php 
                                            $rate = 1;
                                            $total = 0;
                                            $finalRate;
                                            foreach($reviewRatingRelated as $ratingCount){
                                                $total = $total+$ratingCount->rating;
                                            }
                                            $finalRate = round($total/5);
                                            // echo $finalRate;

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

                                    {{--<div class="product-price">
                                        @if ($product->discount_price == NULL)
                                        <span class="price">${{ $product->selling_price }}</span>
                                        @else
                                        <span class="price">${{ $product->discount_price }}</span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                        @endif
                                    </div>--}}<!-- /.product-price -->

                                </div><!-- /.product-info -->
                                {{--<div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                    <i class="icon fa fa-heart"></i>
                                                </a>
                                            </li>
                                            <li class="lnk">
                                                <a class="add-to-cart" href="detail.html" title="Compare">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->
                                </div>--}}<!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.item -->

        <div class="owl-controls clickable">
            <div class="owl-buttons">
                <div class="owl-prev"></div>
                <div class="owl-next"></div>
            </div>
        </div>
    </div><!-- /.home-owl-carousel -->
</section>
