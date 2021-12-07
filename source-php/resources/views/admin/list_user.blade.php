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
                            <li><a href="{{route('admin.list_location')}}" class="nav-link"><i class="fa fa fa-list-ul"></i> Danh sách nhà hàng</a></li>
                            <li><a href="{{route('admin.list_user_get')}}" class="nav-link active"><i class="fa fa-user"></i> Tài khoản người dùng</a></li>
                            <a href="{{route('admin.list_admin_get')}}" class="nav-link"><i class="fa fa-user"></i> Tài khoản admin</a></li>
                            <li><a href="{{route('admin.statistic')}}" class="nav-link"><i class="fa fa-bar-chart"></i> Thống kê</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="box">
                    <h1>Danh sách người dùng</h1>
                    {{--<p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>--}}
                    <hr>
                    <form action="{{route('admin.add_user')}}" enctype="multipart/form-data"  method="get">
                        {{----}}
                        {{ csrf_field() }}
                    <div class="row">
                        {{--<div class="col-md-4">--}}
                        {{--<a class="btn btn-primary btn-sm" onclick="getTable(this)">Xác--}}
                        {{--nhận</a>--}}
                        {{--</div>--}}
                        <div class="col-md-12 text-left">
                            <button id="submit" name="submit" onclick="{{route('admin.add_user')}}" value="Submit" class="btn btn-primary">
                                <i class="fa fa-plus-square-o"></i> Thêm mới
                            </button>
                        </div>
                        <div class="col-md-12">
                            <label name="space2"></label>
                        </div>
                        <div class="table-responsive table table-bordered table-striped col-md-12" >
                            <table style="height: auto" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($cus_list))
                                    @foreach($cus_list as $item)
                                        <tr>
                                            <td>{{$item['Id']}}</td>
                                            <td>{{$item['DisplayName']}}</td>
                                            <td>{{$item['Email']}}</td>
                                            <td class="BtnEdit">
                                                <a class ="btn btn-primary btn-sm" href="{{route('admin.detail_user',$item['Id'])}}">
                                                    Sửa
                                                </a>
                                            </td>
                                            <td class="BtnDelete">
                                                <a class ="btn btn-primary btn-sm" href="{{route('admin.delete_user',$item['Id'])}}">
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{$cus_list -> links()}}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.col-md-9-->
        </div>

    </div>


@endsection
