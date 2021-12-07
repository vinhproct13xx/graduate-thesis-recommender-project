@extends('Web.Layout.app')
@section('content')
    <a style="text-decoration: underline " class="ml-40 mb-10" data-toggle="modal" data-target="#coordination">
        <i class="fas fa-map-marker-alt"></i>
        <span>Chọn ví trí của bạn</span>
    </a>
    <div id="map2" style="overflow: hidden;height: 275px;max-width: 1135px; margin-top: 150px;margin: auto;
    border-radius: 10px;"></div>
    <div class="row" style="margin-left: 15px; margin-top: 20px" id="moreObj" style="margin: 0px 0px 10px"
         type="{{\request()->type}}" api-get-open-res="{{route('api.res.get_open_res')}}"
         api-get-nearest="{{route('api.res.nearest')}}"
         api-get-suggest="{{route('api.res.suggest')}}"
         category-id="{{isset(\request()->category_id) ? \request()->category_id :''}}"
         long="{{isset(\request()->long) ? \request()->long : ''}}"
         lat="{{isset(\request()->lat) ? \request()->lat : ''}}">
    </div>
    <div style="text-align: center">
        <button style="width: 150px" id="btn-load-more" class="btn btn-primary">Tải thêm</button>
    </div>
    <div style="margin-top: 100px" id="coordination" class="modal fade modal-wrapper" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nhấn chọn địa điểm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="width:100%;height:400px;" id="map-to-choose" class="form-control">

                    </div>
                    <input style="display: none" type="text" id="long">
                    <input style="display: none" type="text" id="lat">
                    <div style="text-align: right">
                        <button id="btn-choose-coor" class="btn btn-success">Tìm kiếm</button>
                        <button id="btn-get-current" class="btn btn-primary">Lấy vị trí hiện tại</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function MoreObject() {
            this.api_get_open_res = $('#moreObj').attr('api-get-open-res');
            this.page = 1;
            this.res_list = [];
            var pr = this;
            this.getOpenRes = function (long, lat) {
                $.ajax({
                    url: pr.api_get_open_res,
                    method: 'POST',
                    data: {
                        user_location: {
                            Latitude: lat,
                            Longitude: long
                        },
                        category_id: $('#moreObj').attr('category-id'),
                        page: pr.page
                    }
                }).done(function (result) {
                    if (result.success) {
                        var res_list = result.data;
                        if (res_list[0]) {
                            pr.res_list = (pr.res_list).concat(res_list);
                            pr.page = pr.page + 1;
                        } else {
                            $('#btn-load-more').css('display', 'none');
                        }
                        $xhtml = $('#moreObj').html();
                        for (i in res_list) {
                            $xhtml += '<div class="saved-res">\n' +
                                '                <section>\n' +
                                '                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                                '                        <div class="view overlay"><img\n' +
                                '                                src="' + res_list[i]['PhotoUrl'] + '"\n' +
                                '                                alt="Card image cap" class="card-img-top"> <a href="/res-detail/' + res_list[i]['Id'] + '">\n' +
                                '                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                                '                            </a></div>\n' +
                                '                        <div class="card-body"><h4 class="card-title font-weight-bold"><a href="/res-detail/' + res_list[i]['Id'] + '">' + res_list[i]['Name'] + '</a>\n' +
                                '                                <p class="mt-10"><i class="mr-10 fas fa-clock"></i><span>' + (res_list[i]['restaurant_detail'] != null ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa có dữ liệu') + '</span></p>\n' +
                                '                            </h4>\n' +
                                '                            <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp;' + res_list[i]['address_summary'] + '</a>\n' +
                                '                            <p class="card-text"></p>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                </section>\n' +
                                '            </div>'
                        }
                        $('#moreObj').html($xhtml);
                        renderMap(pr.res_list);
                    } else {

                    }
                })
            }
            this.getNearest = function (long, lat) {
                $.ajax({
                    method: 'POST',
                    data: {
                        user_location: {
                            Latitude: lat,
                            Longitude: long
                        },
                        page: pr.page,
                        category_id: $('#moreObj').attr('category-id'),
                    },
                    url: $('#moreObj').attr('api-get-nearest')
                }).done(function (data) {
                    var res_list = data.data;
                    if (res_list[0]) {
                        pr.res_list = (pr.res_list).concat(res_list);
                        pr.page = pr.page + 1;
                    } else {
                        $('#btn-load-more').css('display', 'none');
                    }
                    $xhtml = $('#moreObj').html();
                    for (i in res_list) {
                        $xhtml += '<div class="saved-res">\n' +
                            '                <section>\n' +
                            '                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                            '                        <div class="view overlay"><img\n' +
                            '                                src="' + res_list[i]['PhotoUrl'] + '"\n' +
                            '                                alt="Card image cap" class="card-img-top"> <a href="/res-detail/' + res_list[i]['Id'] + '">\n' +
                            '                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                            '                            </a></div>\n' +
                            '                        <div class="card-body"><h4 class="card-title font-weight-bold"><a href="/res-detail/' + res_list[i]['Id'] + '">' + res_list[i]['Name'] + '</a>\n' +
                            '                                <p class="mt-10"><i class="mr-10 fas fa-clock"></i><span>' + (res_list[i]['restaurant_detail'] != null ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa có dữ liệu') + '</span></p>\n' +
                            '                            </h4>\n' +
                            '                            <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp;' + res_list[i]['address_summary'] + '</a>\n' +
                            '                            <p class="card-text"></p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </section>\n' +
                            '            </div>'
                    }
                    $('#moreObj').html($xhtml);
                    renderMap(pr.res_list);
                })
            }
            this.get_suggest_res = function (customer_id) {
                $.ajax({
                    method: 'POST',
                    data: {
                        user_id: customer_id,
                        category_id: $('#moreObj').attr('category-id'),
                    },
                    url: $('#moreObj').attr('api-get-suggest')
                }).done(function (data) {
                    var res_list = data.data;
                    $xhtml = $('#moreObj').html();
                    for (i in res_list) {
                        $xhtml += '<div class="saved-res">\n' +
                            '                <section>\n' +
                            '                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                            '                        <div class="view overlay"><img\n' +
                            '                                src="' + res_list[i]['PhotoUrl'] + '"\n' +
                            '                                alt="Card image cap" class="card-img-top"> <a href="/res-detail/' + res_list[i]['Id'] + '">\n' +
                            '                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                            '                            </a></div>\n' +
                            '                        <div class="card-body"><h4 class="card-title font-weight-bold"><a href="/res-detail/' + res_list[i]['Id'] + '">' + res_list[i]['Name'] + '</a>\n' +
                            '                                <p class="mt-10"><i class="mr-10 fas fa-clock"></i><span>' + (res_list[i]['restaurant_detail'] != null ? res_list[i]['restaurant_detail']['open_time'] : 'Chưa có dữ liệu') + '</span></p>\n' +
                            '                            </h4>\n' +
                            '                            <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp;' + res_list[i]['address_summary'] + '</a>\n' +
                            '                            <p class="card-text"></p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </section>\n' +
                            '            </div>'
                    }
                    $('#moreObj').html($xhtml);
                    renderMap(res_list);
                })
            }
            this.setPage = function (val) {
                this.page = val;
            }
            return this;
        }

        function renderMap(res_list) {
            var map = new google.maps.Map(document.getElementById('map2'), {
                // center: new google.maps.LatLng(10.8139, 106.717),
                center: new google.maps.LatLng(lat, long),
                zoom: 15
            });
            var infoWindow = new google.maps.InfoWindow;
            Array.prototype.forEach.call(res_list, function (res) {
                var id = res['Id'];
                var name = res['Name'];
                var address = res['Address'];
                var distance_haversine = (res['distance']);
                var distance_gg_api = (res['distance_gg'])/1000;
                var type = 'restaurant';
                var open_time = res['restaurant_detail'] ? res['restaurant_detail']['open_time'] : 'Chưa có dữ liệu'
                var point = new google.maps.LatLng(
                    parseFloat(res['Latitude']),
                    parseFloat(res['Longitude']));

                var infowincontent = document.createElement('div');
                var res_name = createElement('a', name, null, {
                    'id': 'res_name_gg_map',
                    'href': '/res-detail/' + id,
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
                infowincontent.appendChild(document.createElement('br'));

                var haversine_label = createElement('strong', 'Harversine: ', '', null);
                infowincontent.appendChild(haversine_label);

                var haversine = createElement('text', distance_haversine + ' km', 'color:blue; font-weight:bold', null);
                infowincontent.appendChild(haversine);
                infowincontent.appendChild(document.createElement('br'));

                var distance_gg_label = createElement('strong', 'Google Map API: ', '', null);
                infowincontent.appendChild(distance_gg_label);

                var distance_gg = createElement('text', distance_gg_api + ' km', 'color:blue; font-weight:bold', null);
                infowincontent.appendChild(distance_gg);

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

        function gup( name, url ) {
            if (!url) url = location.href;
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\?&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec( url );
            return results == null ? null : results[1];
        }

        $(document).ready(function () {
            $('#btn-get-current').click(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var path = window.location.pathname;
                        path = path + '?long='+ position.coords.longitude +'&lat=' + position.coords.latitude;
                        if (gup("category_id",window.location.href)){
                            path = path + '&category_id=' + gup("category_id",window.location.href);
                        }
                        window.location.href = path;
                    }, function (error) {
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert('Vui lòng cho phép website truy cập vị trí của bạn!')
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("Location information is unavailable.")
                                break;
                            case error.TIMEOUT:
                                alert("The request to get user location timed out.")
                                break;
                            case error.UNKNOWN_ERROR:
                                alert("An unknown error occurred.")
                                break;
                        }
                    });
                } else {
                    alert('Trình duyệt của bạn không hỗ trợ định vị')
                }
            })
            $('#btn-choose-coor').click(function () {
                var path = window.location.pathname;
                path = path + '?long='+ $('#long').val() +'&lat=' + $('#lat').val();
                if (gup("category_id",window.location.href)){
                    path = path + '&category_id=' + gup("category_id",window.location.href);
                }
                window.location.href = path;
            })
            $('#btn-load-more').click(function () {
                var type = $('#moreObj').attr('type');
                switch (type) {
                    case 'nearest':
                        moreObj.getNearest(long, lat);
                        break;
                    case 'open':
                        moreObj.getOpenRes(long, lat);
                        break;
                    case 'suggest':
                        if (user) {
                            user = JSON.parse(user);
                            moreObj.get_suggest_res(user['Id']);
                        } else {
                            helper.showNotification('Vui lòng đăng nhập', 'danger')
                        }
                        break;
                }
            });
        });
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

        var type = $('#moreObj').attr('type');
        var moreObj = new MoreObject();
        var long = 106.7864965;
        var lat = 10.8380984;
        var user = localStorage.getItem('user');

        function initMap2() {
            if($('#moreObj').attr('lat') != '' && $('moreObj').attr('long') != ''){
                long = $('#moreObj').attr('long');
                lat = $('#moreObj').attr('lat');
                console.log('initial map 2 without user location........');
                switch (type) {
                    case 'nearest':
                        moreObj.getNearest(long, lat);
                        break;
                    case 'open':
                        moreObj.getOpenRes(long, lat);
                        break;
                    case 'suggest':
                        if (user) {
                            user = JSON.parse(user);
                            moreObj.get_suggest_res(user['Id']);
                        } else {
                            helper.showNotification('Vui lòng đăng nhập', 'danger')
                        }
                        break
                }
                return;
            }
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    long = position.coords.longitude;
                    lat = position.coords.latitude;
                    console.log('Lat: ' + position.coords.latitude + ' Lng: ' + position.coords.longitude);
                    console.log('initial map 2 with user location........');
                    switch (type) {
                        case 'nearest':
                            moreObj.getNearest(long, lat);
                            break;
                        case 'open':
                            moreObj.getOpenRes(long, lat);
                            break;
                        case 'suggest':
                            if (user) {
                                user = JSON.parse(user);
                                moreObj.get_suggest_res(user['Id']);
                            } else {
                                helper.showNotification('Vui lòng đăng nhập', 'danger')
                            }
                            break
                    }
                }, function (error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            long = 106.7864965;
                            lat = 10.83809844;
                            console.log('initial map 2 without user location........');
                            moreObj = new MoreObject();
                            switch (type) {
                                case 'nearest':
                                    moreObj.getNearest(long, lat);
                                    break;
                                case 'open':
                                    moreObj.getOpenRes(long, lat);
                                    break;
                                case 'suggest':
                                    if (user) {
                                        user = JSON.parse(user);
                                        moreObj.get_suggest_res(user['Id']);
                                    } else {
                                        helper.showNotification('Vui lòng đăng nhập', 'danger')
                                    }
                                    break
                            }
                            console.log("User denied the request for Geolocation.")
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Location information is unavailable.")
                            break;
                        case error.TIMEOUT:
                            alert("The request to get user location timed out.")
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("An unknown error occurred.")
                            break;
                    }
                });
            } else {
                alert('Trình duyệt của bạn không hỗ trợ định vị')
            }
        }

        function initMapToChoose() {
            const myLatlng = {lat: 10.776530, lng: 106.700981};
            const map = new google.maps.Map(document.getElementById("map-to-choose"), {
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
                $('#long').val(location.lng);
                $('#lat').val(location.lat);
                infoWindow.open(map);
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMapToChoose" async
        defer>
    </script>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap2">
    </script>
@endsection
