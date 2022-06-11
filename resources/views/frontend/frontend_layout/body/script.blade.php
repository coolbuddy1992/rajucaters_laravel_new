<?php $route_current = url()->current(); ?>

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->
<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/echo.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap-slider.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/lightbox.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap-select.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/scripts.js"></script>
@if(Request::segment(1) == 'gallery')
<script src="{{ asset('frontend') }}/assets/js/jquery.fancybox.min.js"></script>
@endif

<!-- StepForm -->
<script src="{{ asset('frontend') }}/assets/js/jq.stepform.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

{{-- custom toastr script --}}
<script>
@if (Session::has('message'))
    let type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}")
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}")
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}")
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}")
            break;
        default:
            break;
    }
@endif
$(document).ready(function() {
  
  $('input[id^="statuscat_"]').click(function() {
    var catid = $(this).data('category_id');
    if ($(this).prop("checked") == true){
      if ($('#catproduct_'+catid).children().length == 1) {
        $('#catproduct_'+catid).addClass('hide');
      } else {
        $('#catproduct_'+catid).removeClass('hide');
      }
      // $('#catproduct_'+catid).removeClass('hide');
      $('#subcat_'+catid).removeClass('hide');
    } else if ($(this).prop("checked") == false) {
      $('#catproduct_'+catid).addClass('hide');
      $('#subcat_'+catid).addClass('hide');
    }
  });
  $('input[id^="statussubcategoryId_"]').click(function() {
      var subcatid = $(this).data('subcategory_id');
      if ($(this).prop("checked") == true) {
        if ($('#subcatproduct_'+subcatid).children().length == 1) {
          $('#subcatproduct_'+subcatid).addClass('hide');
        } else {
            $('#subcatproduct_'+subcatid).removeClass('hide');
        } 
        // $('#subcatproduct_'+subcatid).removeClass('hide');
        $('#subsubmenu_'+subcatid).removeClass('hide');
      } else if($(this).prop("checked") == false) {
        $('#subcatproduct_'+subcatid).addClass('hide');
        $('#subsubmenu_'+subcatid).addClass('hide');
      }
  });
  $('input[id^="statussubsubcategoryId_"]').click(function(){
      var subsubcatid = $(this).data('sub_subcategory_id');
      if($(this).prop("checked") == true){ 
        $('#subsubcategoryId_'+subsubcatid).removeClass('hide');
      } else if($(this).prop("checked") == false){
        $('#subsubcategoryId_'+subsubcatid).addClass('hide');
      }
  });

  $('.submitMenu').click(function(){

      // var menuArr;
    if($('.menu_stepform').hasClass('active')){

        
      var initialattr = $(this).data('initilize');
      var menuId = $("#menu_id").val();
      var category = $(".menu_stepform.active .tab-menu input[name='category']:checked");
      var catproduct = $(".menu_stepform.active .tab-menu input[name='catpro']:checked");
      var subcat = $(".menu_stepform.active .tab-menu input[name='subcat']:checked");
      var subcatproduct = $(".menu_stepform.active .tab-menu input[name='subcatproduct']:checked");
      var subsubcat = $(".menu_stepform.active .tab-menu input[name='subsubcat']:checked");
      var subsubcatproduct = $(".menu_stepform.active .tab-menu input[name='subsubcatproduct']:checked");

      
      var cat;
      var catpro;
      var catepro = [];
      var subcateg = [];
      var subcate, subcatid, subsubcatid;
      var subpro = {};
      var subsubcategory = {};
      var subsubcategorypro = {};
      // var subcatpro = [];
      var finaldata = {};


      $.each(category, function(catkey, catvalue){
        cat = $(this).val();
        var catval = catvalue.value
        $.each(catproduct, function(key, value){
          catpro = $(this).val();
          catepro.push({catpro});
        });
        
        $.each(subcat, function(subcatkey, value){
          subcate = $(this).val();
          subcatid = $(this).data('subcategory_name');
          if(subcatproduct.length == 0){
            subpro[subcate] = {'subcatName': subcatid}
          }
          var subcatpro = [];
          var subsubcate;
          $.each(subcatproduct, function(key, value){
            if(subcatid == $(this).data('pro_subcategory_name')){
              subcatpro.push($(this).val())
              subpro[subcatid] = {'subcatName': subcatid,'product':subcatpro};
            }
          });
          
          $.each(subsubcat, function(key, value){
            if(subcatid == $(this).data('subcategory_name')){
              subsubcate= $(this).val()
              subsubcatid = $(this).data('sub_subcategory')
              if(subsubcatproduct.length == 0) {
                subsubcategorypro[subsubcate] = {'subsubcatName': subsubcatid}
              }
              subsubcatpro = []
              $.each(subsubcatproduct, function(key, value){
                if(subsubcatid == $(this).data('subsubcategory_name')){
                  subsubcatpro.push($(this).val())
                  subsubcategorypro[subsubcatid] = {'subcatName': subcatid,'subsubcatName': subsubcatid,'product':subsubcatpro};
                }
              });
            }
          });
        });
      });
      
      var menulist;
      var menuHtml;

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }, 
          url: "{{route('FrontendPageController.ajax')}}",  
          type: 'POST', 
          data: {'category': cat, 'categoryProduct': catepro,'subcatwithpro': subpro ,'subsubcatwithpro': subsubcategorypro},
          success: function(data) {
            toastr.success(data.success);
            menulist = '<h3 class="menu-name">Customize Menu</h3>'+data.menuDataCustomer
            $('.showMenu').html(menulist);
            $('.book-now-btn').removeClass('hide');
          }  
      });
    }
  });

  @if(Request::segment(1) == 'gallery')
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
  @endif
    
  $(".zoom").hover(function(){
    $(this).addClass('transition');
  }, function(){
        
    $(this).removeClass('transition');
  });

  var usermobile;
  var OrderType;
  var request;
  $('#book_now').click(function(e){
      e.preventDefault();
      menuId = $(this).data('menu_id');
      <?php if(Auth::check()) {?>
        usermobile = {{Auth::user()->phone_number}}
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }, 
          url: "{{route('storeMenu')}}",  
          type: 'POST', 
          data: {'phone': usermobile, 'bom_id': menuId},
          success: function(data) {
            toastr.success(data.message);
            if(data.success) {
              window.location.href = '{{route('home')}}';
            }
              
          }  
        });
      <?php } else {?>
        $("#testmodal").modal('show');
        $('#sendotp').click(function(){
          usermobile = $("#user_mobile").val();
          OrderType = $(this).data('menu_type');

          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: "{{route('sendOtp')}}",  
            type: 'POST', 
            data: {'phone': usermobile, 'otp_type': OrderType},
            success: function(data) {
              toastr.success(data.message);
              request = data.request_id
              if(data.success) {
                $("#sendotp").addClass("hide");
                $("#user_otp").removeClass("hide");
                $(".confirmotp").removeClass("hide");
                $("#user_mobile").addClass("hide");
                $("#user_request").val(request);
              }  
            }
          });
          $('#confirmotp').click(function(){
            mobileOtp = $("#user_otp").val();
            request = $("#user_request").val();
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: "{{route('verify.verifyOtp')}}",  
              type: 'POST', 
              data: {'phone': usermobile, 'Otp':mobileOtp, 'otpRequestId':request},
              success: function(data) {
                toastr.success(data.message);
                if(data.success) {
                  $("#user_otp").addClass("hide");
                  $("#confirmotp").addClass("hide");
                  $('.responseMessage').removeClass("hide");
                  $("#modelbutton_save").removeClass("hide");
                }  
              }
            });
          });
          $('#modelbutton_save').click(function(){
            $("#testmodal").modal('hide');
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: "{{route('storeMenu')}}",  
              type: 'POST', 
              data: {'phone': usermobile, 'bom_id': menuId},
              success: function(data) {
                toastr.success(data.message);
                if(data.success) {
                  window.location.href = '{{route('home')}}';
                }
                  
              }  
            });
          });
        });
      <?php } ?>
    });

  $("#user_review_name").change(function (event) {
      
      let formData = new FormData(this);
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "{{route('userReviewImg')}}",
      data: formData,
      contentType: false,
      processData: false,
    })
  });

  $("#user_review_image").change(function () {
      
    var postData = new FormData();
    postData.append('file',document.getElementById('user_review_image').files[0]);
      
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "{{route('userReviewImg')}}",
      data: postData,
      contentType: false,
      processData: false,
    })
  });


  $("form#user_review_form").submit(function (event) {

    event.preventDefault();

    // var fd = new FormData();
    // var files = $('#user_reviw_image')[0].files;
    // if(files.length > 0 ){
    //   fd.append('file',files[0]);
    // }

    var formData = {
      name: $('input[name = "user_review_name"]').val(),
      rating: $('input[name = "quality"]:checked').val(),
      comments: $('textarea[name = "user_review"]').val(),
      review_type: $('input[name = "user_review_type"]').val(),
      product_detail: $('input[name = "product_detail"]').val(),
      product_id: $('input[name = "product_id"]').val(),
    };

    // let formData = new FormData(this);

    // var FormDetail = [];
    // var postData = new FormData();
    // var name = $('input[name = "user_review_name"]').val();
    // postData.append('file',document.getElementById('user_review_image').files[0]);
    
    // FormDetail['name'] = name;
    // FormDetail['image'] = postData;

    // console.log(FormDetail)

    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "{{route('collectuserReview')}}",
      data: formData,
    }).done(function (data) {
       toastr.success(data.message);
       if(data.success){
        window.location.href = '{{$route_current}}'
       }
    });

  });

});
</script>
<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Enter Mobile Number</h4>
            </div>
            <div class="modal-body">
              <input type="text" name="mobile_num" id="user_mobile" placeholder="1234567890">
              <input type="text" name="otp" id="user_otp" class="hide" placeholder="1234567890">
              <input type="hidden" name="user_request" id="user_request">
              <p class="responseMessage hide">Thanks we will contact you shortly</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sendotp" id="sendotp">Send Otp</button>

                <button type="button" class="btn btn-primary confirmotp hide" id="confirmotp">Confirm Otp</button>
                <button type="button" class="btn btn-primary hide" id="modelbutton_save">Save changes</button>
            </div>
        </div>
    </div>
</div>
@yield('frontend_script')
