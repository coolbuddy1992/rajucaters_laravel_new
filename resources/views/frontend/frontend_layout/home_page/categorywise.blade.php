<section class="section featured-product wow fadeInUp">
    @if (session()->get('language') == 'hindi')
        <h3 class="section-title">
            {{ $skip_category_0->category_name_hi }}
        </h3>
        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            @foreach ($skip_category_products_0 as $product)
            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image"> 
                                <a href="{{ route('frontend-product-details',['slug' => $product->product_slug_hi]) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                </a> 
                            </div>
                            <!-- /.image -->
                        </div>
                        <!-- /.product-image -->

                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                                                class="fa fa-shopping-cart"></i> </button>
                                        <button class="btn btn-primary cart-btn" type="button">कार्ट में जोड़ें</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="{{ route('frontend-product-details',['slug' => $product->product_slug_hi]) }}" title="Wishlist"> <i
                                                class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="{{ route('frontend-product-details',['slug' => $product->product_slug_hi]) }}" title="Compare"> <i
                                                class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                    <!-- /.product -->

                </div>
                <!-- /.products -->
            </div>
            @endforeach
            <!-- /.item -->
        </div>
    @else
        <h3 class="section-title">
            {{ $skip_category_0->category_name_en }}
        </h3>
        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            @foreach ($skip_category_products_0 as $product)
            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image"> 
                                <a href="{{ route('frontend-product-details',['slug' => $product->product_slug_en]) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                </a> 
                            </div>
                            <!-- /.image -->
                        </div>
                        <!-- /.product-image -->

                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                                                class="fa fa-shopping-cart"></i> </button>
                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="{{ route('frontend-product-details',['slug' => $product->product_slug_en]) }}" title="Wishlist"> <i
                                                class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="{{ route('frontend-product-details',['slug' => $product->product_slug_en]) }}" title="Compare"> <i
                                                class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                    <!-- /.product -->

                </div>
                <!-- /.products -->
            </div>
            @endforeach
            <!-- /.item -->
        </div>
    @endif
</section>
