<!-- Vendor JS -->
<script src="{{ asset('backend') }}/js/vendors.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="{{ asset('') }}assets/icons/feather-icons/feather.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/jquery-steps-master/build/jquery.steps.js"></script>
<script src="{{ asset('') }}assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script>
<script src="{{ asset('') }}assets/vendor_components/sweetalert/sweetalert.min.js"></script>
{{-- <script src="{{ asset('') }}assets/vendor_components/easypiechart/dist/jquery.easypiechart.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('') }}assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
{{-- <script src="{{ asset('') }}assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script> --}}
<script src="{{ asset('backend') }}/js/pages/steps.js"></script>
<script src="{{ asset('') }}assets/vendor_components/datatable/datatables.min.js"></script>
<script src="{{ asset('backend') }}/js/pages/data-table.js"></script>
@yield('dashboard_script')

<!-- Sunny Admin App -->
<script src="{{ asset('backend') }}/js/template.js"></script>
<script src="{{ asset('backend') }}/js/jq.stepform.js"></script>

{{-- <script src="{{ asset('backend') }}/js/pages/dashboard.js"></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Modal -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

{{-- custom toaster script --}}
<script type="text/javascript">
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
</script>
<script type="text/javascript">

  $(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  })
    });
    /****************************************************/

    /****************** Menu Logic *********************/
    $( document ).ready(function() {
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

    
      if($('.tab').hasClass('active')){
        
        var initialattr = $(this).data('initilize');
        var category = $(".tab.active input[name='category']:checked");
        var catproduct = $(".tab.active input[name='catpro']:checked");
        var subcat = $(".tab.active input[name='subcat']:checked");
        var subcatproduct = $(".tab.active input[name='subcatproduct']:checked");
        var subsubcat = $(".tab.active input[name='subsubcat']:checked");
        var subsubcatproduct = $(".tab.active input[name='subsubcatproduct']:checked");

        
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
            url: "{{route('OwnMenuGenerateController.ajax')}}",  
            type: 'POST', 
            data: {'category': cat, 'categoryProduct': catepro,'subcatwithpro': subpro ,'subsubcatwithpro': subsubcategorypro},
            success: function(data) {  
              toastr.success(data.success);
              menulist = data.menuData
              $('.showMenu').html(menulist);
            }  
        });
      }
    });
  });
});

</script>
