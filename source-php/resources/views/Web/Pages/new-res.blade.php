@extends('Web.Layout.app')
@section('content')
    <div class="container">
        <div id="newObj" api-upload-image="{{route('api.utity.upload_image')}}" api-create-res="{{route('api.res.create')}}" class="box">
            <h1>{{__('new_res')}}</h1>
            <hr>
            {{----}}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <label for="Name">{{__('res_name')}}</label>
                        <input id="name" value="Nhà Hàng A" name="Name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Name">{{__('description')}}</label>
                        <textarea id="description" class="form-control">hehe</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Address">{{__('address')}}̉</label>
                        <input id="address" value="hcm" name="Address" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="PhotoUrl">{{__('image')}}</label>
                        <input type="file" id="image" class="m"
                               style="border: unset !important; background: white">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Address">{{__('coordination')}}</label>
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
                        <label for="Latitude">{{__('Latitude')}}</label>
                        <input id="latitude" name="Latitude" type="text" disabled="true" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="Longitude">{{__('Longitude')}}</label>
                        <input id="longitude" name="Longitude" type="text" disabled="true" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="Categories">{{__('category')}}</label>
                        <select id="category" name="Categories" class="form-control">
                            @foreach($categories as $key=>$category)
                                <option value="{{$category['id']}}" {{$key==0 ? 'selected' : ''}}>{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="District">{{__('district')}}</label>
                        <select id="district" name="District" class="form-control">
                            @foreach($districts as $key=>$district)
                                <option value="{{$district}}" {{$key==0 ? 'selected' : ''}}>{{$district}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="City">{{__('city')}}</label>
                        <select id="city" name="City" class="form-control">
                            <option value="Tp.HCM">Tp.HCM</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="OpenHour">{{__('open_hour')}}</label>
                        <select id="open-hour" name="OpenHour" class="form-control">
                            @for($i=0 ; $i<24; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="OpenMinute">{{__('open_minute')}}</label>
                        <select id="open-minute" name="OpenMinute" class="form-control">
                            @for($i=0 ; $i<60; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="CloseHour">{{__('close_hour')}}</label>
                        <select id="close-hour" name="CloseHour" class="form-control">
                            @for($i=0 ; $i<24; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="CloseMinute">{{__('close_minuter')}}</label>
                        <select id="close-minute" name="CloseMinute" class="form-control">
                            @for($i=0 ; $i<60; $i ++)
                                <option {{$i==0 ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="min-price">{{__('min_price')}}</label>
                        <input id="min-price" value="10000" name="MinPrice" type="number" step="1000" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="min-price">{{__('max_price')}}</label>
                        <input id="max-price" value="20000" name="MaxPrice" type="number" step="1000" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <label name="space2"></label>
                </div>
                <div class="col-md-12 text-center">
                    <button id="btn-create" class="btn btn-success">{{__('submit')}}</button>
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
                document.getElementById('latitude').value = location.lat;
                document.getElementById('longitude').value = location.lng;
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
            this.api_upload_image = $('#newObj').attr('api-upload-image');
            this.description = '';
            this.token = localStorage.getItem('token');
            var pr = this;
            this.uploadImage = function () {
                if(!$('#image')[0].files[0]){
                    helper.showNotification('Vui lòng chọn ảnh','danger');
                    return;
                }
                var fd = new FormData();
                fd.append('image', $('#image')[0].files[0])
                $.ajax({
                    url: pr.api_upload_image,
                    method: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false
                }).done(function (result) {
                    if (result.success) {
                        pr.createRes(result.data.path);
                    } else {
                        helper.showNotification(result.message, 'danger')
                    }
                })
            }
            this.createRes = function (image){
                var data_create = {
                    name : $('#name').val(),
                    description :this.description,
                    address : $('#address').val(),
                    image : image,
                    longitude : $('#longitude').val(),
                    latitude : $('#latitude').val(),
                    category_id : $('#category').val(),
                    district : $('#district').val(),
                    city : $('#city').val(),
                    open_hour : $('#open-hour').val(),
                    open_minute : $('#open-minute').val(),
                    close_hour : $('#close-hour').val(),
                    close_minute : $('#close-minute').val(),
                    min_price : $('#min-price').val(),
                    max_price : $('#max-price').val(),
                };
                for(i in data_create){
                    if(!data_create[i]){
                        helper.showNotification(i + ' bắt buộc phải có','danger');
                        return ;
                    }
                }
                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + pr.token
                    },
                    method: 'POST',
                    data : data_create,
                    url : pr.api_create_res
                }).done(function (result) {
                    if(result.success){
                        helper.showNotification(result.message,'success');
                    }else {
                        helper.showNotification(result.message,'danger');
                    }
                })
            }
        }
        $(document).ready(function () {
            var newObj = new NewObject();
            var user = localStorage.getItem('user');
            if (!user) {
                window.location.href = "/"
            }
            $('#description').on('change keyup paste',function (){
                newObj.description = $(this).val()
            })
            $('#btn-create').click(function (){
                newObj.uploadImage();
            })
        })
    </script>
@endsection
