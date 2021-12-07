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
                            <a href="{{route('admin.add_location')}}" class="nav-link active"><i class="fa fa-plus-square-o"></i> Thêm nhà hàng</a>
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
                    <h1>Thêm nhà hàng mới</h1>
                    <hr>
                    <form action="{{route('admin.add_location_post')}}" enctype="multipart/form-data"  method="post">
                        {{----}}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label for="Name">Tên nhà hàng</label>
                                    <input id="Name" name="Name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="Address">Địa chỉ</label>
                                    <input id="Address" name="Address" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="PhotoUrl">Địa chỉ ảnh</label>
                                    <input id="PhotoUrl" name="PhotoUrl" type="text" class="form-control">
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
                                    <input id="Latitude" name="Latitude" type="text" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="Longitude">Vĩ độ</label>
                                    <input id="Longitude" name="Longitude" type="text" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="Categories">Loại hình</label>
                                    <select id="Categories" name="Categories" class="form-control">
                                        <option value="1" selected>Ăn uống</option>
                                        <option value="2">Sang trọng</option>
                                        <option value="3">Buffet</option>
                                        <option value="4">Nhà hàng</option>
                                        <option value="5">Ăn vặt/vỉa hè</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="District">Quận</label>
                                    <select id="District" name="District" class="form-control">
                                        <option value="Quận 1" selected>Quận 1</option>
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
                            <div class="col-md-6">
                                <div>
                                    <label for="City">Thành phố</label>
                                    <select id="City" name="City" class="form-control">
                                        <option value="Tp.HCM">Tp.HCM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="OpenHour">Giờ mở cửa</label>
                                    <select id="OpenHour" name="OpenHour" class="form-control">
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="OpenMinute">Phút mở cửa</label>
                                    <select id="OpenMinute" name="OpenMinute" class="form-control">
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59">59</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="CloseHour">Giờ đóng cửa</label>
                                    <select id="CloseHour" name="CloseHour" class="form-control">
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23" selected>23</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label for="CloseMinute">Phút đóng cửa</label>
                                    <select id="CloseMinute" name="CloseMinute" class="form-control">
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59" selected>59</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="MinPrice">Giá tiền thấp nhất</label>
                                    <input id="MinPrice" name="MinPrice" type="number" step="1000" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="MaxPrice">Giá tiền cao nhất</label>
                                    <input id="MaxPrice" name="MaxPrice" type="number" step="1000" class="form-control">
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
            const myLatlng = { lat: 10.776530, lng: 106.700981 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click vào để lấy tọa độ!!",
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
