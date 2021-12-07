@extends('Web.Layout.app')
@section('content')
    <div class="container" id="list_location" path="{{url('/')}}" api-get-list="{{route('admin.list_location_get')}}">
        <div class="row">
            <div class="col-lg-12">
                <!-- breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Admin</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-3">
                <!--
                *** PAGES MENU ***
                _________________________________________________________
                -->
                <div class="card sidebar-menu mb-4">
                    <div class="card-header">
                        <h3 class="h4 card-title">Admin</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <a href="{{route('admin.add_location')}}" class="nav-link"><i class="fa fa-plus-square-o"></i> Thêm nhà hàng</a>
                            {{--<a href="customer-wishlist.html" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>--}}
                            <a href="{{route('admin.list_location_approval')}}" class="nav-link"><i class="fa fa-check-square-o"></i> Duyệt nhà hàng</a>
                            <li><a href="{{route('admin.list_location')}}" class="nav-link active"><i class="fa fa fa-list-ul"></i> Danh sách nhà hàng</a></li>
                            <li><a href="{{route('admin.list_user_get')}}" class="nav-link"><i class="fa fa-user"></i> Tài khoản người dùng</a></li>
                            <a href="{{route('admin.list_admin_get')}}" class="nav-link"><i class="fa fa-user"></i> Tài khoản admin</a></li>
                            <li><a href="{{route('admin.statistic')}}" class="nav-link"><i class="fa fa-bar-chart"></i> Thống kê</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="box">
                    <h1>Danh sách nhà hàng</h1>
                    {{--<p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>--}}
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <label for="City">Thành phố</label>
                                    <select id="City" name="City" class="form-control">
                                        <option value="Tp.HCM" selected>Tp.HCM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <div>
                                    <label for="District">Quận</label>
                                    <select id="District" name="District" class="form-control" >
                                        <option selected>--Chọn--</option>
                                        <option value="Quận 1">Quận 1</option>
                                        <option value="Quận 2">Quận 2</option>
                                        <option value="Quận 3">Quận 3</option>
                                        <option value="Quận 4">Quận 4</option>
                                        <option value="Quận 5">Quận 5</option>
                                        <option value="Quận 6">Quận 6</option>
                                        <option value="Quận 7">Quận 7</option>
                                        <option value="Quận 8">Quận 8</option>
                                        <option value="Quận 9">Quận 9</option>
                                        <option value="Quận 10">Quận 10</option>
                                        <option value="Quận 11">Quận 11</option>
                                        <option value="Quận 12">Quận 12</option>
                                        <option value="Quận Thủ Đức">Quận Thủ Đức</option>
                                        <option value="Quận Gò Vấp">Quận Gò Vấp</option>
                                        <option value="Quận Bình Thạnh">Quận Bình Thạnh</option>
                                        <option value="Quận Tân Phú">Quận Tân Phú</option>
                                        <option value="Quận Phú Nhuận">Quận Phú Nhuận</option>
                                        <option value="Quận Bình Tân">Quận Bình Tân</option>
                                        <option value="Huyện Củ Chi">Huyện Củ Chi</option>
                                        <option value="Huyện Hóc Môn">Huyện Hóc Môn</option>
                                        <option value="Huyện Bình Chánh">Huyện Bình Chánh</option>
                                        <option value="Huyện Nhà Bè">Huyện Nhà Bè</option>
                                        <option value="Huyện Cần Giờ">Huyện Cần Giờ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-4">--}}
                        {{--<a class="btn btn-primary btn-sm" onclick="getTable(this)">Xác--}}
                        {{--nhận</a>--}}
                        {{--</div>--}}
                        <div class="table-responsive table table-bordered table-striped" >
                            <table style="height: auto" class="table table-hover">

{{--                                @if(isset($res_list))--}}
{{--                                    @foreach($res_list as $item)--}}
                                        <div id="list">

                                        </div>
{{--                                    @endforeach--}}
{{--                                @endif--}}
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-9-->
        </div>

    </div>

    <script>

        $('#District').change(function () {
            // console.log($('#District').val());
            var path = $('#list_location').attr('path');
            {{--console.log('heheheh' + {{route('admin.list_location_get')}})--}}
            // let objective = $(obj).parent().parent();
            // let id_product = objective.find("District").val();
            // console.log(id_product);
            console.log($('#list_location').attr('api-get-list'));
            var district = $('#District').val();
            $.ajax({
                url: $('#list_location').attr('api-get-list'),
                type: 'GET',
                async: true,
                data: {
                    "district": district,
                }
            }).done(function (result){
                var str = '';
                str +="<thead>";
                str +="<tr>\n" +
                    "       <th>Mã nhà hàng</th>\n" +
                    "       <th>Tên nhà hàng</th>\n" +
                    "       <th>Địa chỉ</th>\n" +
                    "       <th>Sửa</th>\n" +
                    "       <th>Xóa</th>\n" +
                    "  </tr>\n" +
                    "  </thead>\n" +
                    "  <tbody>";
                var list = result.res_list;
                for (i in list) {
                    // $url1 = route('admin.detail_location',list[i]['Id']);
                    str +="<tr>" +
                            "<td>"+ list[i]['Id'] +"</td>"+
                            "<td>"+ list[i]['Name'] +"</td>"+
                            "<td>"+ list[i]['Address'] +"</td>"+
                            "<td class=\"btnEdit\">"+
                            "<a  class=\"btn btn-primary btn-sm\" href="+ path + '/admin/detail_location/'+ list[i]['Id'] +" >"+
                            "Sửa"+
                            "</a>"+"</td>"+
                            "<td class=\"btnDelete\">"+
                            "<a  class=\"btn btn-primary btn-sm\" href="+ path + '/admin/delete_location/'+ list[i]['Id'] +" >"+
                            "Xóa"+
                            "</a>"+"</td>"+
                        "</tr>";
                }
                str +="</tbody>";
                $('#list').html(str);
            });
        })
        {{--function getTable(obj) {--}}
        {{--    return 222;--}}
        {{--    --}}{{--console.log('heheheh' + {{route('admin.list_location_get')}})--}}
        {{--    let objective = $(obj).parent().parent();--}}
        {{--    let id_product = objective.find("District").val();--}}
        {{--    console.log(id_product);--}}

        {{--    $.ajax({--}}
        {{--        url:"{{route('admin.list_location_get')}}",--}}
        {{--        type:'GET',--}}
        {{--        async: true,--}}
        {{--        data: {"_id_type":id_product},--}}
        {{--        success: function (result) {--}}
        {{--            var str = '';--}}
        {{--            var list = result.res_list;--}}
        {{--            for (i in list){--}}
        {{--                str += '<p>' + list[i]['Name'] + '</p>';--}}
        {{--            }--}}
        {{--            $('#list').html(str);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection
