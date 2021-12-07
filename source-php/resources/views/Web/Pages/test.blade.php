@extends('Web.Layout.app')
@section('content')
    <div class="container">
        <div id="newObj" api-create-res="{{route('api.res.create')}}" class="box">
            <h1>Thêm nhà hàng mới</h1>
            <hr>
            {{----}}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <label for="Name">Tên nhà hàng</label>
                        <input id="name" name="Name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Name">Mô tả</label>
                        <textarea id="discription" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Address">Địa chỉ</label>
                        <input id="address" name="Address" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="PhotoUrl">Địa chỉ ảnh</label>
                        <input type="file" id="image" class="m"
                               style="border: unset !important; background: white">
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
                        <label for="Latitude">Vĩ độ</label>
                        <input id="latitude" name="Latitude" type="text" disabled="true" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="Longitude">Kinh độ</label>
                        <input id="longitude" name="Longitude" type="text" disabled="true" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Categories">Loại hình</label>
                        <select id="category" name="Categories" class="form-control">
                            @foreach($categories as $key=>$category)
                                <option value="{{$category['id']}}" {{$key==0 ? 'selected' : ''}}>{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="District">Quận</label>
                        <select id="district" name="District" class="form-control">
                            @foreach($districts as $key=>$district)
                                <option value="{{$district}}" {{$key==0 ? 'selected' : ''}}>{{$district}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="City">Thành phố</label>
                        <select id="city" name="City" class="form-control">
                            <option value="Tp.HCM">Tp.HCM</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="OpenHour">Giờ mở cửa</label>
                        <select id="open-hour" name="OpenHour" class="form-control">
                            @for($i=0 ; $i<24; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="OpenMinute">Phút mở cửa</label>
                        <select id="open-minute" name="OpenMinute" class="form-control">
                            @for($i=0 ; $i<60; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="CloseHour">Giờ đóng cửa</label>
                        <select id="close-hour" name="CloseHour" class="form-control">
                            @for($i=0 ; $i<24; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="CloseMinute">Phút đóng cửa</label>
                        <select id="close-minute" name="CloseMinute" class="form-control">
                            @for($i=0 ; $i<60; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="min-price">Giá tiền thấp nhất</label>
                        <input id="min-price" name="MinPrice" type="number" step="1000" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="min-price">Giá tiền cao nhất</label>
                        <input id="max-price" name="MaxPrice" type="number" step="1000" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <label name="space2"></label>
                </div>
                <div class="col-md-12 text-center">
                    <button id="btn-create" class="btn btn-success">Gửi</button>
                </div>

            </div>
            <!-- /.row-->
            <div class="col-lg-12">
                <label name="space3"></label>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
    <script>
        function NewObject(){
            this.api_create_res = $('#newObj').attr('api-create-res');
            var pr = this;
            this.createRes = function (image){
                $.ajax({
                    method: 'POST',
                    data : {
                        name : $('#name').val(),
                        description : $('#description').val(),
                        address : $('#address').val,
                        photoUrl : image,
                        longitude : $('#longitude').val,
                        latitude : $('#latitude').val,
                        category_id : $('#category').val,
                        district : $('#district').val,
                        city : $('#city').val,
                        open_hour : $('#open-hour').val,
                        open_minute : $('#open-minute').val,
                        close_hour : $('#close-hour').val,
                        close_minute : $('#close-minute').val,
                        min_price : $('#min-price').val(),
                        max_price : $('#max-price').val(),
                    },
                    url : pr.api_create_res
                }).done(function (result) {
                    if(result.success){

                    }else {

                    }
                })
            }
        }
        $(document).ready(function () {
            var newObj = new NewObject();
            $('#btn-create').click(function (){
                newObj.createRes('aaa');
            })
        })
    </script>
@endsection
