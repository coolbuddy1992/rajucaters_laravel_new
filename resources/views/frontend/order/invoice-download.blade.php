<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        /** {
            font-family: Verdana, Arial, sans-serif;
        }*/
        /*.table-bordered {
            border: 1px solid #ddd;
        }*/
        table{
            font-size: x-small;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;
        }
        /*.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #f9f9f9;
        }
        table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            vertical-align: middle;
            padding: 30px;
        }
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid #ddd;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }*/
        /*td, th, tr {
            padding: 0;
            text-align: center ;
        }*/
        tbody, th, tr, td{
            text-align: left;
        }
        .gray {
            background-color: lightgray
        }
        .font{
          font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
            margin-left: 35px;
        }
        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <h2 style="color: green; font-size: 20px;"><strong>{{ str_replace('-',' ',env('APP_NAME')) }}</strong></h2>
                <p>
                   Email:{{ env('MAIL_FROM_ADDRESS') }}<br>
                   Mob: {{ env('MOBILE_NUMBER') }}<br>
                   Address: {{ str_replace('-',' ',env('BUSINESS_ADDRESS'))}}<br>
                   City: {{env('BUSINESS_CITY')}}<br>
                   State: {{str_replace('-',' ',env('BUSINESS_STATE'))}}<br>
                   Pin: {{env('BUSINESS_PIN')}}<br>

                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="background:white;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                   <h3><span style="color: green;"><strong>Name:</strong></span> {{ $user->name }}</h3>
                   <h3><span style="color: green;"><strong>Email:</strong></span> {{ $user->email }}</h3>
                   <h3><span style="color: green;"><strong>Phone:</strong></span> {{ $user->phone_number }}</h3>
                </p>
            </td>
            <td>
                <p class="font">
                    <h3><span style="color: green;">Order Number:</span> #{{ $order->order_number }}</h3>
                    <h3><span style="color: green;">Invoice Number:</span> #{{ $order->invoice_number }}</h3>
                    <h3><span style="color: green;">Order Date:</span> {{ $order->created_at }}</h3>
                </p>
            </td>
        </tr>
    </table>
    <br/>
    <h3>Order Detail</h3>
    <table border="1" class="table table-striped table-bordered table-responsive-sm table-responsive-md table-responsive-lg">
        <?php $menuListData = $orderItems->menu_list; 
              $menuList = json_decode($menuListData, TRUE);
        ?>
        @foreach ($menuList as $menuData)
        <tr>
        @foreach($menuData['data'] as $menucat)
          <td>{{$menucat['categoryName']}}</td>
          <td>
            <table>
              @if(!empty($menucat['categoryProduct']))
                  <tr><td><table><thead class="thead-dark"><th>Product</th></thead><tbody>
                  @foreach($menucat['categoryProduct'] as $catProDetail)
                      <tr><td>{{$catProDetail}}</td></tr>
                  @endforeach
                  </tbody></table></td></tr>
              @endif
              <!-- For subcategory -->
              @if(!empty($menucat['subcategoryDetail']))
                <tr>
                  <td>
                    <table>
                      @foreach($menucat['subcategoryDetail'] as $subcatDetail)
                        <thead class="thead-dark"><th> {{$subcatDetail['subcategoryName']}}</th></thead>
                        <!-- For subcategory Product -->
                        @foreach($subcatDetail['subcatPro'] as $subcatProDetail)
                            <tbody>
                            @foreach($subcatProDetail['subcategoryPro'] as $subcategoryPro)
                                <tr><td>{{$subcategoryPro}}</td></tr>
                            @endforeach
                            </tbody>
                        @endforeach
                      @endforeach
                    </table>
                  </td>
                </tr>
              @endif
              @if(!empty($menucat['subsubcategoryDetail']))
                <tr>
                    <td>
                        <table>
                        @foreach($menucat['subsubcategoryDetail'] as $subsubcatDetail)
                            <thead class="thead-dark"><th> {{ $subsubcatDetail['subsubcategoryName'] }}</th></thead>
                            <!-- For subsubcategory Product -->
                            @foreach($subsubcatDetail['subsubcatProducts'] as $subsubcatProDetail)
                                <tbody>
                                @foreach($subsubcatProDetail['subsubcatprod'] as $subsubcategoryPro)
                                    <tr><td> {{ $subsubcategoryPro }} </td></tr>
                                @endforeach
                                </tbody>
                            @endforeach
                        @endforeach
                        </table>
                    </td>
                </tr>
            @endif
            </table>
          </td> 
        @endforeach
        </tr>
        @endforeach
    </table>
    <div class="thanks mt-3">
        <p>Thanks For Order..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>Raju Caters</p>
        <p>Authority Signature:</p>
    </div>
    </body>
</html>
