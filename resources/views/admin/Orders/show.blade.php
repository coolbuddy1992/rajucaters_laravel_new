@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Order Details',
    'url' => "orders.index",
    'section_name' => 'View Order'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Details</h3>
                        <span class="text-danger"> Invoice : {{ $order->order_number }}</span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th> Name : </th>
                                <th> {{ $user->name }} </th>
                            </tr>
                            <tr>
                                <th> Phone : </th>
                                <th> {{ $order->phone }} </th>
                            </tr>
                            <tr>
                                <th> Order Number : </th>
                                <th class="text-danger"> {{ $order->order_number }} </th>
                            </tr>
                            <tr>
                                <th> Invoice : </th>
                                <th class="text-danger"> {{ $order->invoice_number }} </th>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 col-lg-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order View</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table border="1" width="100%">
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
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
