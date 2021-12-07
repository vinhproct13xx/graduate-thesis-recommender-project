@extends('Web.Layout.app')
@section('content')
    <div class="container" id="chart" path="{{url('/')}}" api-get-admin="{{route('admin.statistic_get')}}">
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
                            <li><a href="{{route('admin.list_location')}}" class="nav-link"><i class="fa fa fa-list-ul"></i> Danh sách nhà hàng</a></li>
                            <li><a href="{{route('admin.list_user_get')}}" class="nav-link"><i class="fa fa-user"></i> Tài khoản người dùng</a></li>
                            <a href="{{route('admin.list_admin_get')}}" class="nav-link"><i class="fa fa-user"></i> Tài khoản admin</a></li>
                            <li><a href="{{route('admin.statistic')}}" class="nav-link  active"><i class="fa fa-bar-chart"></i> Thống kê</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="box">
                    <h1>Thống kê</h1>
                    {{--<p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>--}}
                    <hr>
                        {{----}}
                        {{ csrf_field() }}
                    <div class="row">
                        {{--<div class="col-md-4">--}}
                        {{--<a class="btn btn-primary btn-sm" onclick="getTable(this)">Xác--}}
                        {{--nhận</a>--}}
                        {{--</div>--}}
                        <div class="col-md-12 text-left">
                            <div>
                                <label for="YearLabel">Năm</label>
                                <select id="Year" name="Year" class="form-control">
                                    <option selected>--Chọn--</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label name="space2"></label>
                        </div>
                        <div class="col-md-12">
                            <div id="AdminChart" class="form-control"></div>
                        </div>
                        <div class="col-md-12">
                            <div id="RestaurantChart" class="form-control"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-9-->
        </div>

    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        $('#Year').change(function (){
            var year = $('#Year').val();
            var path = $('#chart').attr('path');
            console.log($('#chart').attr('api-get-admin'));
            $.ajax({
                url: $('#chart').attr('api-get-admin'),
                type: 'GET',
                async: true,
                data: {
                    "year": year,
                }
            }).done(function (result){
                var admin = result.admin;
                var restaurant = result.restaurant;
                console.log(admin);
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                google.charts.setOnLoadCallback(drawChart1);
                function drawChart() {
                    data = google.visualization.arrayToDataTable(admin);
                    var options = {
                        title: 'Số lượng User tạo theo từng tháng',
                        curveType: 'function',
                        legend: { position: 'bottom' },
                        width: 550,
                        height:400
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('AdminChart'));
                    chart.draw(data, options);
                }
                function drawChart1() {
                    data = google.visualization.arrayToDataTable(restaurant);
                    var options = {
                        title: 'Số lượng nhà hàng tạo theo từng tháng',
                        curveType: 'function',
                        legend: { position: 'bottom' },
                        width: 550,
                        height:400
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('RestaurantChart'));
                    chart.draw(data, options);
                }
            });
        })


    </script>
@endsection
