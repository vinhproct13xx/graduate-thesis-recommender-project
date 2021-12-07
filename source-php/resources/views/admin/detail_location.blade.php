@extends('Web.Layout.app')
@section('content')
    <div class="container">
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
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div id="product" class="box">
                    <h1>Sửa thông tin nhà hàng</h1>
                    <hr>
                    <form action="{{route('admin.update_location_post',[$location->Id])}}" enctype="multipart/form-data"  method="post">
                        {{----}}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label for="Name">Mã nhà hàng</label>
                                    <input id="Name" name="Name" type="text" value="{{$location['Id']}}" readonly="true" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="Name">Tên nhà hàng</label>
                                    <input id="Name" name="Name" type="text" value="{{$location['Name']}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="Address">Địa chỉ</label>
                                    <input id="Address" name="Address" type="text" value="{{$location['Address']}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="PhotoUrl">Địa chỉ ảnh</label>
                                    <input id="PhotoUrl" name="PhotoUrl" type="text" value="{{$location['PhotoUrl']}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="Address">Tọa độ nhà hàng</label>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div style="width:100%;height:400px;" id="map" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <label name="space1"></label>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="Latitude">Kinh độ</label>
                                    <input id="Latitude" name="Latitude" type="text" readonly value="{{$location['Latitude']}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="Longitude">Vĩ độ</label>
                                    <input id="Longitude" name="Longitude" type="text" readonly value="{{$location['Longitude']}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="Categories">Loại hình</label>
                                    <select id="Categories" name="Categories" class="form-control">
                                        @foreach($categories as $category)
                                            @if($location['restaurant_detail']['category_id'] == $category['id'])
                                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                            @else
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="District">Quận</label>
                                    <select id="District" name="District" class="form-control">
                                        @foreach($districts as $name)
                                            @if($location['restaurant_detail']['district'] == $name)
                                                <option value="{{$name}}" selected>{{$name}}</option>
                                            @else
                                                <option value="{{$name}}" >{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="City">Thành phố</label>
                                    <select id="City" name="City" class="form-control">
                                        @foreach($cities as $key=>$name)
                                            <option value="{{$key}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="OpenHour">Giờ mở cửa</label>
                                    <select id="OpenHour" name="OpenHour" class="form-control">
                                        @foreach($hours as $key=>$name)
                                            @if(substr($location['restaurant_detail']['open_time'],0,4)==$key)
                                                <option value="{{$key}}" selected>{{$name}}</option>
                                            @else
                                                <option value="{{$key}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="OpenMinute">Phút mở cửa</label>
                                    <select id="OpenMinute" name="OpenMinute" class="form-control">
                                        @foreach($minutes as $key=>$name)
                                            @if(substr($location['restaurant_detail']['open_time'],5,2)==$key)
                                                <option value="{{$key}}" selected>{{$name}}</option>
                                            @else
                                                <option value="{{$key}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="CloseHour">Giờ đóng cửa</label>
                                    <select id="CloseHour" name="CloseHour" class="form-control">
                                        @foreach($hours as $key=>$name)
                                            @if(substr($location['restaurant_detail']['close_time'],0,4)==$key)
                                                <option value="{{$key}}" selected>{{$name}}</option>
                                            @else
                                                <option value="{{$key}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="CloseMinute">Phút đóng cửa</label>
                                    <select id="CloseMinute" name="CloseMinute" class="form-control">
                                        @foreach($minutes as $key=>$name)
                                            @if(substr($location['restaurant_detail']['close_time'],5,2)==$key)
                                                <option value="{{$key}}" selected>{{$name}}</option>
                                            @else
                                                <option value="{{$key}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="MinPrice">Giá tiền thấp nhất</label>
                                    <input id="MinPrice" name="MinPrice" type="number" step="1000" @if(strlen($location['restaurant_detail']['price'])==19)
                                        value="{{substr($location['restaurant_detail']['price'],0,2)*1000}}"
                                          @else  value="{{substr($location['restaurant_detail']['price'],0,3)*1000}}"
                                           @endif
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="MaxPrice">Giá tiền cao nhất</label>
                                    <input id="MaxPrice" name="MaxPrice" type="number" step="1000" @if(strlen($location['restaurant_detail']['price'])==19)
                                    value="{{substr($location['restaurant_detail']['price'],11,2)*1000}}"
                                           @else  value="{{substr($location['restaurant_detail']['price'],12,3)*1000}}"
                                           @endif
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
                    </form>
                    <div class="col-lg-12">
                        <label name="space3"></label>
                    </div>
                </div>
            </div>
            <!-- /.col-md-9-->
        </div>

    </div>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap" async defer>
    </script>
    <script>
        function initMap() {
            x = document.getElementById("Latitude").value;
            y = document.getElementById("Longitude").value;
            const myLatlng = { lat: 10.776530, lng: 106.700981 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: new google.maps.LatLng(x, y),
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Tọa độ: "+x+", "+y,
                position: myLatlng,
            });
            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                let location = mapsMouseEvent.latLng.toJSON();
                document.getElementById('Latitude').value = location.lat;
                document.getElementById('Longitude').value = location.lng;
                infoWindow.open(map);


            });
        }
    </script>
    <script>
        CKEDITOR.config.toolbar = [

            { name: 'document',  items:[ 'Source','-','DocProps','Preview','Print','-','Templates' ] },

            {name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
            '/',
            { name: 'styles' , items : [ 'Styles','Format','Font','FontSize' ]},

            { name: 'links',  items:[ 'Link','Unlink','Anchor' ] }
        ];
    </script>

@endsection
