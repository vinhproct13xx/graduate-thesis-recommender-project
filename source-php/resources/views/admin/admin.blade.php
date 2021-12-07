@extends('Web.Layout.app')
@section('content')
    <div class="container" id="admin" path="{{url('/')}}" api-create-admin="{{route('admin.add_admin_post')}}">
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
                            <li><a href="{{route('admin.statistic')}}" class="nav-link"><i class="fa fa-bar-chart"></i> Thống kê</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div id="product" class="box">
                    <h1>Thêm mới Admin</h1>
                    <hr>
                    {{----}}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label for="Name">Tên người dùng</label>
                                <input id="DisplayName" name="DisplayName" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="Email">Email</label>
                                <input id="Email" name="Email" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="Password">Password</label>
                                <input id="Password" name="Password" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label name="space2"></label>
                        </div>
                        <div class="col-md-12 text-center">
                            <button id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">
                                <i class="fa fa-save	"></i> Lưu

                            </button>
                        </div>

                    </div>
                    <!-- /.row-->
                    <div class="col-lg-12">
                        <label name="space3"></label>
                    </div>
                </div>
            </div>
            <!-- /.col-md-9-->
        </div>

    </div>

    <script type="text/javascript">
        $('#submit').click(function (){
            console.log($('#Email').val());
            var email = $('#Email').val();
            var password = $('#Password').val();
            var displayname = $('#DisplayName').val();
            var path = $('#admin').attr('path');
            console.log($('#admin').attr('api-create-admin'));
            $.ajax({
                url: $('#admin').attr('api-create-admin'),
                type: 'POST',
                async: true,
                data: {
                    "email": email,
                    "password": password,
                    "displayname": displayname,
                }
            }).done(function (result){
                var ok = result.success;
                if(!ok){
                    window.alert('Email đã trùng!!');
                }
                else{
                    window.alert('Thành công!!');
                    window.location.href = 'list_admin_get';
                }
            });
        })

    </script>
@endsection
