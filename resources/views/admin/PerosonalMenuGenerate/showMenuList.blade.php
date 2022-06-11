@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Build Own Menu',
    'url' => "buildOwnMenu.index",
    'section_name' => 'All Build Own Menu'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
            @foreach ($bml as $item)
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h4 class="box-title">{{$item->build_own_menu->menu_name_en}}</h4>
                        <a href="{{ route('show-menu-list') }}" class="btn btn-primary">Back to Menu</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php $menuList = json_decode($item['build_menu_list_name'], TRUE); ?>
                                        <table border="1">
                                            @foreach ($menuList as $menuData)
                                                @foreach($menuData['data'] as $menucat)
                                                    <thead><tr><th> {{$menucat['categoryName']}} </th></tr></thead>
                                                    <tbody>
                                                    <!-- For category Product -->
                                                    @if(!empty($menucat['categoryProduct']))
                                                        <tr><td><table><thead><th>Product</th></thead><tbody>
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
                                                                        <thead><th> {{$subcatDetail['subcategoryName']}}</th></thead>
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
                                                    <!-- For subsubcategory -->
                                                    @if(!empty($menucat['subsubcategoryDetail']))
                                                        <tr>
                                                            <td>
                                                                <table>
                                                                @foreach($menucat['subsubcategoryDetail'] as $subsubcatDetail)
                                                                    <thead><th> {{ $subsubcatDetail['subsubcategoryName'] }}</th></thead>
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
                                                    </tbody>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            @endforeach
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    @section('dashboard_script')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    @endsection
@endsection
