<section class="section wow fadeInUp new-arriavls">
    <h3 class="section-title">
        Menu List
    </h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach ($new_products as $product)
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                <img src="{{ !empty($product->product_thumbnail) ? $product->product_thumbnail : env('PRODUCT_IMAGE') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /.product-image -->

                    <div class="product-info text-left">
                        <h3 class="name"><a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                            {{ $product->product_name_en }}
                        </a></h3>
                    </div>
                </div>
                <!-- /.product -->

            </div>
            <!-- /.products -->
        </div>
        @endforeach
        <!-- /.item -->
    </div>
    <!-- /.home-owl-carousel -->
</section>
<!-- /.section -->
