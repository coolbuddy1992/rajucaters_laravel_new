<section class="section outer-bottom-vs wow fadeInUp">
<div id="hero">
<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
    @foreach ($gallery as $galleries)
    <div class="item" style="background-image: url({{ asset($galleries->photo_location) }});">
        <div class="container-fluid">
            <div class="caption bg-color vertical-center text-left">
                <!-- <div class="big-text fadeInDown-1">{{ $galleries->photo_name }}</div> -->
            </div>
            <!-- /.caption -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @endforeach
    <!-- /.item -->
</div>
<!-- /.owl-carousel -->
</div>
</section>
