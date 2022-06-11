<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
    <div id="advertisement" class="advertisement">
    @foreach($review as $reviews)
        <div class="item">
            <div class="avatar">
                <img src="{{$reviews->review_image}}" alt="Image">
            </div>
            <div class="testimonials"><em>"</em> {{$reviews->review_comments}}<em>"</em></div>
            <div class="clients_author">{{$reviews->name}} <!-- <span>Abc Company</span> --> </div>
        </div>
    @endforeach
    </div>
</div>