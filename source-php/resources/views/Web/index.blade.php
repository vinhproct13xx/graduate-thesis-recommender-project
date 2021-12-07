@extends('Web.Layout.app')
@section('content')
    <!-- Header Area End Here -->
    <!-- Begin Slider With Banner Area -->
    <div id="index-obj" class="slider-with-banner" api-get-nearest="{{route('api.res.nearest')}}" api-get-saved-res="{{route('api.res.saved')}}"
         api-get-suggest="{{route('api.res.suggest')}}">
        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
                <div class="col-lg-12 col-md-12">
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left  animation-style-01 bg-1">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h2>Khuyến mãi 50% ngay hôm nay</h2>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">XEM NGAY</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-02 bg-2">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h2>Ưu đãi cuối tuần</h2>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">XEM NGAY</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-01 bg-3">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h2>Thực đơn đặc biệt ngày cuối tuần</h2>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">XEM NGAY</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin suggested Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{__('suggest')}}</span>
                        </h2>
                    </div>
                    <div class="product-container">
                        <div class="row" id="suggested-res-list">

                        </div>
                    </div>

                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>

    <!-- suggested Product End Here -->
    <!-- Li's Static Banner Area End Here -->
    <!-- Begin nearest Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{__('nearest')}}</span>
                        </h2>
                    </div>
                    <div class="product-container">
                        <div class="row" id="nearest-list">

                        </div>
                    </div>

                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <div id="map" style="overflow: hidden;height: 275px;max-width: 1135px; margin-top: 150px;margin: auto;
    border-radius: 10px;"></div>
    <!-- nearest Product End Here -->
    <!-- Begin banner -->
    <div class="li-static-home" style="margin-top: 20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Li's Static Home Image Area -->
                    <div class="li-static-home-image"></div>
                    <!-- Li's Static Home Image Area End Here -->
                    <!-- Begin Li's Static Home Content Area -->
                    <div class="li-static-home-content">
                        <p>Khuyến mãi <span>20%</span>mỗi cuối tuần</p>
                        <h2>Chuối nhà hàng</h2>
                        <h2>2 O'CLOCK</h2>
                        <p class="schedule">
                            Giá chỉ từ
                            <span> 50.000 đ</span>
                        </p>
                        <div class="default-btn">
                            <a href="shop-left-sidebar.html" class="links">Xem ngay</a>
                        </div>
                    </div>
                    <!-- Li's Static Home Content Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- banner End Here -->
    <!-- Begin saved Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{__('saved')}}</span>
                        </h2>
                    </div>
                    <div class="product-container">
                        <div class="row" id="saved-res-list">

                        </div>
                    </div>

                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- saved ProductEnd Here -->
    <!-- Begin new Products Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{__('newest')}}</span>
                        </h2>
                    </div>
                    <div class="product-container">
                        <div class="row">
                            @foreach($new_res as $res)
                                <div>
                                    <section>
                                        <div class="card booking-card" style="max-width: 22rem;">
                                            <div class="view overlay"><img src="{{$res['PhotoUrl']}}" alt="Card image cap" class="card-img-top"> <a href="#!">
                                                    <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                                </a></div>
                                            <div class="card-body"><h4 class="card-title font-weight-bold"><a href="/res-detail/{{$res['Id']}}" style="color: black">{{$res['name_summary']}}</a>
                                                </h4>
                                                <p><i class="mr-10 fas fa-clock"></i><span>{{$res['restaurant_detail'] ? ($res['restaurant_detail']['open_time'] ?? '') : ''}}</span></p>
                                                <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>{{$res['address_summary']}}
                                                    <p class="card-text"></p>
                                                </a></div><a class="mb-2">
                                            </a></div><a class="mb-2">
                                        </a></section><a class="mb-2">
                                    </a></div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>

    {{--    <div id="map" style="overflow: hidden;height: 275px;max-width: 1135px; margin-top: 150px;margin: auto;--}}
    {{--    border-radius: 10px;"></div>--}}
@endsection
@section('script')
    <script>
        function IndexObj() {
            this.api_get_nearest = $('#index-obj').attr('api-get-nearest');
            this.api_get_suggest = $('#index-obj').attr('api-get-suggest');
            this.api_get_saved_res = $('#index-obj').attr('api-get-saved-res');
            this.user = localStorage.getItem('user');

            var pr = this;
            this.get_saved_res = function (customer_id){
                $.ajax({
                    method: 'POST',
                    data: {
                        customer_id : customer_id
                    },
                    url : $('#index-obj').attr('api-get-saved-res')
                }).done(function (data){

                    var res_list = data.data;
                    var xhtml = '';
                    for(i in res_list ){
                        if(i==10){
                            break;
                        }
                        xhtml += '<div>\n' +
                            '                                <section>\n' +
                            '                                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                            '                                        <div class="view overlay"><img\n' +
                            '                                                src="'+ res_list[i]['PhotoUrl'] +'"\n' +
                            '                                                alt="Card image cap" class="card-img-top"> <a href="#!">\n' +
                            '                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                            '                                            </a></div>\n' +
                            '                                        <div class="card-body"><p class="card-title font-weight-bold"><a style="color: black" href="/res-detail/'+ res_list[i]['Id'] +'">'+ (res_list[i]['name_summary']) +'</a>\n' +
                            '                                            </p>\n' +
                            '                                            <p><i class="mr-10 fas fa-clock"></i><span>'+ (res_list[i]['restaurant_detail'] ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa cập nhật') +'</span></p>\n' +
                            '                                            <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>'+ res_list[i]['address_summary']+'\n' +
                            '                                            <p class="card-text"></p>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </section>\n' +
                            '                            </div>'

                    }
                    $('#saved-res-list').html(xhtml);
                })
            }
            this.get_suggest_res = function (customer_id){
                $.ajax({
                    method: 'POST',
                    data: {
                        user_id : customer_id
                    },
                    url : pr.api_get_suggest
                }).done(function (data){
                    var res_list = data.data;
                    var xhtml = '';
                    for(i in res_list ){
                        if(i==20){
                            break;
                        }
                        xhtml += '<div>\n' +
                            '                                <section>\n' +
                            '                                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                            '                                        <div class="view overlay"><img\n' +
                            '                                                src="'+ res_list[i]['PhotoUrl'] +'"\n' +
                            '                                                alt="Card image cap" class="card-img-top"> <a href="#!">\n' +
                            '                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                            '                                            </a></div>\n' +
                            '                                        <div class="card-body"><p class="card-title font-weight-bold"><a style="color: black" href="/res-detail/'+ res_list[i]['Id'] +'">'+ (res_list[i]['name_summary']) +'</a>\n' +
                            '                                            </p>\n' +
                            '                                            <p><i class="mr-10 fas fa-clock"></i><span>'+ (res_list[i]['restaurant_detail'] ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa cập nhật') +'</span></p>\n' +
                            '                                            <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>'+ res_list[i]['address_summary']+'\n' +
                            '                                            <p class="card-text"></p>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </section>\n' +
                            '                            </div>'

                    }
                    $('#suggested-res-list').html(xhtml);
                })
            }
            return this;
        }

        $(document).ready(function () {
            // getNearest();
            var indexObj = new IndexObj();
            var user = localStorage.getItem('user');
            if(user){
                user = JSON.parse(user);
                indexObj.get_saved_res(user['Id']); //45
                indexObj.get_suggest_res(user['Id']);
            }else{
                indexObj.get_suggest_res(-2);
            }
        })
        function showNearst(res_list){
            var xhtml = '';
            for(i in res_list ){
                if(i==10){
                    break;
                }
                xhtml += '<div>\n' +
                    '                                <section>\n' +
                    '                                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                    '                                        <div class="view overlay"><img\n' +
                    '                                                src="'+ res_list[i]['PhotoUrl'] +'"\n' +
                    '                                                alt="Card image cap" class="card-img-top"> <a href="#!">\n' +
                    '                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                    '                                            </a></div>\n' +
                    '                                        <div class="card-body"><p class="card-title font-weight-bold"><a style="color: black" href="/res-detail/'+ res_list[i]['Id'] +'">'+ (res_list[i]['name_summary']) +'</a>\n' +
                    '                                            </p>\n' +
                    '                                            <p><i class="mr-10 fas fa-clock"></i><span>'+ (res_list[i]['restaurant_detail'] ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa cập nhật') +'</span></p>\n' +
                    '                                            <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>'+ res_list[i]['address_summary']+'\n' +
                    '                                            <p class="card-text"></p>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </section>\n' +
                    '                            </div>'
            }
            $('#nearest-list').html(xhtml);
        }
    </script>
    <script>
        function createElement(name, text = '', css_string = null, attr_list = null) {
            var elm = document.createElement(name);
            elm.textContent = text
            if (css_string) {
                elm.style.cssText = css_string;
            }
            if (attr_list) {
                for (var attribute in attr_list) {
                    elm.setAttribute(attribute, attr_list[attribute]);
                }
            }
            return elm;
        }

        var customLabel = {
            restaurant: {
                label: ''
            },
            bar: {
                label: 'B'
            }
        };

        function initMap() {
            if (navigator.geolocation) {
                console.log('inital map.....');
                navigator.geolocation.getCurrentPosition(function (position){
                    console.log('Lat: '+ position.coords.latitude+ ' Lng: '+ position.coords.longitude);
                    $.ajax({
                        method: 'POST',
                        data: {
                            user_location: {
                                Latitude : position.coords.latitude,
                                Longitude: position.coords.longitude
                                // Latitude : 10.8380621 ,
                                // Longitude: 106.78649750000001
                            }
                        },
                        url : $('#index-obj').attr('api-get-nearest')
                    }).done(function (data){
                        if(data.success){
                            var res_list = data.data
                            showNearst(res_list);
                            var map = new google.maps.Map(document.getElementById('map'), {
                                // center: new google.maps.LatLng(10.8139, 106.717),
                                center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                                zoom: 12
                            });
                            var infoWindow = new google.maps.InfoWindow;

                            Array.prototype.forEach.call(res_list, function (res) {
                                var id = res['Id'];
                                var name = res['Name'];
                                var address = res['Address'];
                                var type = 'restaurant';
                                var open_time = res['restaurant_detail'] ? res['restaurant_detail']['open_time'] : 'Chưa có dữ liệu'
                                var point = new google.maps.LatLng(
                                    parseFloat(res['Latitude']),
                                    parseFloat(res['Longitude']));

                                var infowincontent = document.createElement('div');
                                var res_name = createElement('a', name, null, {
                                    'id': 'res_name_gg_map',
                                    'href': '/res-detail/'+id,
                                    'target': '_blank'
                                });
                                infowincontent.appendChild(res_name);
                                infowincontent.appendChild(document.createElement('br'));

                                var text = createElement('text', address, null, null, null);
                                infowincontent.appendChild(text);
                                infowincontent.appendChild(document.createElement('br'));

                                var time_label = createElement('strong', 'Giờ mở cửa: ', 'font-style:italic', null);
                                infowincontent.appendChild(time_label);

                                var time = createElement('text', open_time, 'color:green; font-weight:bold', null);
                                infowincontent.appendChild(time);
                                var icon = customLabel[type] || {};
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                    label: icon.label
                                });
                                marker.addListener('click', function () {
                                    infoWindow.setContent(infowincontent);
                                    infoWindow.open(map, marker);
                                });
                            });
                        }
                    })

                });
            }
        }

    </script>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap">
    </script>
@endsection
