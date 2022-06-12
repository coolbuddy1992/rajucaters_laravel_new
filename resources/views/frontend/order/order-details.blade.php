@extends('dashboard')

@section('frontend_style')

@endsection

@section('userdashboard_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background: #E9EBEC;">
                    <table class="table">
                        <tr>
                            <th> Name : </th>
                            <th> {{ $order->customer_name }} </th>
                        </tr>

                        <tr>
                            <th> Booking Date </th>
                            <?php
                                $timestamp = strtotime($order->booking_date);
   
                                // Create the new format from the timestamp
                                $date = date("d-m-Y", $timestamp);
                            ?>
                            <th> {{ $date }} </th>
                        </tr>

                        <tr>
                            <th> Phone : </th>
                            <th> {{ $user->phone_number }} </th>
                        </tr>
                        <tr>
                            <th> Invoice : </th>
                            <th class="text-danger"> {{ $order->invoice_number }} </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div> <!-- // 2ND end col md -5 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <h3>Order Name : {{$bom_menu->menu_name_en}}</h3>
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
                                  <tr><td> {{$catProDetail}}</td></tr>
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
            </div>
        </div> <!-- / end col md 8 -->
    </div> <!-- // END ORDER ITEM ROW -->
@endsection

@section('frontend_script')

@endsection
