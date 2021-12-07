@extends('Web.Layout.app')
@section('content')
    <div id="objProfile" api-upload-image="{{route('api.utity.upload_image')}}" api-get-saved-res="{{route('api.res.saved')}}"
         api-update-profile="{{route('api.account.update_profile')}}" api-get-comment-image="{{route('api.comment.get_comment_image')}}"
         api-get-res="{{route('api.res.get-list')}}">
        <div id="accordion" style="margin:0px 12px 20px 12px">
            <div class="card">
                <div id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-bars"></i>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body" style="padding: 0.25px">
                        <ul class="menu-collap">
                            <li><a href="#collection" data-toggle="tab" class="mb-2">
                                    <i style="color: blue" class="mr-10 fa fa-history" aria-hidden="true"></i>Bộ sưu tập
                                    <i class="fas fa-angle-right arrow-menu-left"></i>
                                </a>
                            </li>
                            <li><a href="#saved" data-toggle="tab" class="mb-2">
                                    <i style="color: red" class="mr-10 fas fa-save"></i>Nhà hàng đã lưu
                                    <i class="fas fa-angle-right arrow-menu-left"></i></a></li>
                            <li><a href="#owner-res" data-toggle="tab" class="mb-2">
                                    <i style="color: lawngreen" class="mr-10 fas fa-location-arrow"></i>Địa điểm của bạn
                                    <i class="fas fa-angle-right arrow-menu-left"></i></a></li>
                            <li><a href="#profile" data-toggle="tab" class="mb-2">
                                    <i style="color: purple" class="mr-10 fas fa-user"></i>Thông tin cá nhân
                                    <i class="fas fa-angle-right arrow-menu-left"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 0px 20px">
            <div id="menu-left" class="col-md-4 col-lg-3">
                <section id="menu-left-panel" is-hidden="yes">
                    <!-- Card -->
                    <div class="card booking-card card-menu-left" style="width: 18rem;">
                        <!-- Card content -->
                        <div class="card-body">

                            <!-- Title -->
                            <div class="row">
                                <div class="ml-10 mr-10">
                                    <img class="avatar" src="images/Screenshot_50.png">
                                </div>
                                <div style="padding: 8px 0px">
                                    <h5 class="card-title font-weight-bold"><a>{{__('discover')}}</a></h5>
                                </div>
                            </div>
                            <!-- Data -->
                            <ul class="menu-sidebar-custom nav nav-tabs" style="border-bottom: none">
                                <li><a href="#collection" data-toggle="tab" class="mb-2">
                                        <i style="color: blue" class="mr-10 fa fa-history" aria-hidden="true"></i>{{__('collection')}}
                                        <i class="fas fa-angle-right arrow-menu-left"></i>
                                    </a>
                                </li>
                                <li><a href="#saved" data-toggle="tab" class="mb-2">
                                        <i style="color: red" class="mr-10 fas fa-save"></i>{{__('saved')}}
                                        <i class="fas fa-angle-right arrow-menu-left"></i></a></li>
                                <li><a href="#owner-res" data-toggle="tab" class="mb-2">
                                        <i style="color: lawngreen" class="mr-10 fas fa-location-arrow"></i>{{__('own_res')}}
                                        <i class="fas fa-angle-right arrow-menu-left"></i></a></li>
                                <li><a href="#profile" data-toggle="tab" class="mb-2">
                                        <i style="color: purple" class="mr-10 fas fa-user"></i>{{__('info')}}
                                        <i class="fas fa-angle-right arrow-menu-left"></i></a>
                                </li>
                            </ul>

                            <!-- Text -->
                        </div>

                    </div>
                    <!-- Card -->

                </section>
            </div>
            <div class="col-md-8 col-lg-9 tab-content">
                <div id="collection" class="tab-pane fade in active">
                    <div class="row" id="collection-list">
                        <div class="saved-res">
                            <section>
                                <img class="comment-image"
                                     src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg">
                            </section>
                        </div>
                        <div class="saved-res">
                            <section>
                                <img class="comment-image"
                                     src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg">
                            </section>
                        </div>
                        <div class="saved-res">
                            <section>
                                <img class="comment-image"
                                     src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg">
                            </section>
                        </div>
                        <div class="saved-res">
                            <section>
                                <img class="comment-image"
                                     src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg">
                            </section>
                        </div>
                        <div class="saved-res">
                            <section>
                                <img class="comment-image"
                                     src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg">
                            </section>
                        </div>
                    </div>
                </div>
                <div id="saved" style="padding-left: 10px" class="tab-pane fade">
                    <div class="row" id="saved-list">
                        <div class="saved-res">
                            <section>
                                <div class="card booking-card" style="max-width: 22rem;">
                                    <div class="view overlay"><img
                                            src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg"
                                            alt="Card image cap" class="card-img-top"> <a href="#!">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a></div>
                                    <div class="card-body"><h4 class="card-title font-weight-bold"><a href="#">Texas
                                                Chicken</a>
                                        </h4>
                                        <ul class="list-unstyled list-inline rating mb-0">
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item"><i class="fas fa-star-half-alt amber-text"></i>
                                            </li>
                                            <li class="list-inline-item"><p class="text-muted">4.5 (413)</p></li>
                                        </ul>
                                        <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp; 55 Đặng Thùy Trâm,
                                            quận....</a>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="saved-res">
                            <section>
                                <div class="card booking-card" style="max-width: 22rem;">
                                    <div class="view overlay"><img
                                            src="https://mdbootstrap.com/img/Photos/Horizontal/Food/8-col/img (5).jpg"
                                            alt="Card image cap" class="card-img-top"> <a href="#!">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a></div>
                                    <div class="card-body"><h4 class="card-title font-weight-bold"><a>Texas Chicken</a>
                                        </h4>
                                        <ul class="list-unstyled list-inline rating mb-0">
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                            </li>
                                            <li class="list-inline-item"><i class="fas fa-star-half-alt amber-text"></i>
                                            </li>
                                            <li class="list-inline-item"><p class="text-muted">4.5 (413)</p></li>
                                        </ul>
                                        <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp; 55 Đặng Thùy Trâm,
                                            quận....</a>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div id="owner-res" style="padding-left: 10px" class="tab-pane fade">
                    <div class="row" id="owner-res-list">
                    </div>
                </div>
                <div id="profile" style="padding-left: 10px" class="tab-pane fade">
                    <div class="mb-20">
                        <h4>THÔNG TIN CÁ NHÂN</h4>
                    </div>
                    <div class="user-info">
                        <div class="row  mb-20">
                            <div class="col-md-3 input-name">
                                <b style="font-size: initial"></b>
                            </div>
                            <div class="col-md-9">
                                <img id="avatar-profile" style="width: 150px; height: 150px" class="avatar mb-10"
                                     src="images/Screenshot_50.png">
                                <input type="file" id="image" class="m"
                                       style="border: unset !important; background: white">
                            </div>
                        </div>
                        <div class="row  mb-15">
                            <div class="col-md-3 input-name">
                                <b style="font-size: initial">Mật khẩu mới</b>
                            </div>
                            <div class="col-md-9">
                                <input id="new-password" type="password" placeholder="Mật khẩu mới"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row mb-15">
                            <div class="col-md-3 input-name">
                                <b style="font-size: initial">Mật khẩu cũ</b>
                            </div>
                            <div class="col-md-9">
                                <input id="old-password" type="password" placeholder="Mật khẩu cũ" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-15">
                            <div class="col-md-3 input-name">
                                <b style="font-size: initial"></b>
                            </div>
                            <div class="col-md-9">
                                <button id="btn-update-profile" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function ProfileObject() {
            this.api_upload_image = $('#objProfile').attr('api-upload-image');
            this.api_update_profile = $('#objProfile').attr('api-update-profile');
            this.api_get_comment_image = $('#objProfile').attr('api-get-comment-image');
            this.api_get_saved_res = $('#objProfile').attr('api-get-saved-res');
            this.api_get_res = $('#objProfile').attr('api-get-res');
            this.token = localStorage.getItem('token');
            this.user = JSON.parse(localStorage.getItem('user'));
            this.data_update = {
                image: '',
                old_password: $('#old-password').val(),
                new_password: $('#new-password').val()
            }

            this.setOldPassword = function (val) {
                this.data_update.old_password = val;
            }
            this.setNewPassword = function (val) {
                this.data_update.new_password = val;
            }
            this.setImage = function (val) {
                this.data_update.image = val;
            }
            var pr = this;
            this.uploadImage = function () {
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
                        pr.data_update.image = result.data.path;
                        pr.updateProfile();
                    } else {
                        helper.showNotification(result.message, 'danger')
                    }
                })
            }
            this.updateProfile = function () {
                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + pr.token
                    },
                    url: pr.api_update_profile,
                    method: 'POST',
                    data: pr.data_update
                }).done(function (result) {
                    if (result.success) {
                        $('#avatar-profile').attr('src', '/'+ result.data.Avatar);
                        $('#avatar').attr('src', '/'+ result.data.Avatar);
                        localStorage.setItem('user',JSON.stringify(result.data))
                        helper.showNotification(result.message, 'success')
                    } else {
                        helper.showNotification(result.message, 'danger')
                    }
                })
            }
            this.getCommentImage = function () {
                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + pr.token
                    },
                    url: pr.api_get_comment_image,
                    method: 'POST',
                    data: {}
                }).done(function (result) {
                    if (result.success) {
                        var xhtml = '';
                        var images = result.data;
                        for(i in images){
                            xhtml += '<div class="saved-res">\n' +
                                '                            <section>\n' +
                                '                                <img class="comment-image"\n' +
                                '                                     src="'+ images[i] +'">\n' +
                                '                            </section>\n' +
                                '                        </div>'
                        }
                        $('#collection-list').html(xhtml);
                    } else {
                        helper.showNotification(result.message, 'danger')
                    }
                })
            }
            this.getOwnerRes = function () {
                $.ajax({
                    url: pr.api_get_res,
                    method: 'POST',
                    data: {
                        owner_id : pr.user.Id
                    }
                }).done(function (result) {
                    if (result.success) {
                        var xhtml = $('#owner-res-list').html();
                        var res_list = result.data.data;
                        for(i in res_list){
                            xhtml += '<div class="saved-res">\n' +
                                '                                <section>\n' +
                                '                                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                                '                                        <div class="view overlay"><img\n' +
                                '                                                src="'+ res_list[i]['PhotoUrl'] +'"\n' +
                                '                                                alt="Card image cap" class="card-img-top"> <a href="#!">\n' +
                                '                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                                '                                            </a></div>\n' +
                                '                                        <div class="card-body"><p class="card-title font-weight-bold"><a style="color: black" href="/res-detail/'+ res_list[i]['Id'] +'">'+ (res_list[i]['name_summary']) +'</a>\n' +
                                '                                            </p>\n' +
                                '                                            <p><i class="mr-10 fas fa-clock"></i><span>'+ (res_list[i]['restaurant_detail'] ? res_list[i]['restaurant_detail']['open_time'] :'') +'</span></p>\n' +
                                '                                            <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>'+ res_list[i]['address_summary']+'\n' +
                                '                                            <p class="card-text"></p>\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '                                </section>\n' +
                                '                            </div>'
                        }
                        $('#owner-res-list').html(xhtml);
                    } else {
                        helper.showNotification(result.message, 'danger')
                    }
                })
            }
            this.getSavedRes = function (customer_id){
                $.ajax({
                    method: 'POST',
                    data: {
                        customer_id : customer_id
                    },
                    url : pr.api_get_saved_res
                }).done(function (data){

                    var res_list = data.data;
                    var xhtml = '';
                    for(i in res_list ){
                        xhtml += '<div class="saved-res">\n' +
                            '                                <section>\n' +
                            '                                    <div class="card booking-card" style="max-width: 22rem;">\n' +
                            '                                        <div class="view overlay"><img\n' +
                            '                                                src="'+ res_list[i]['PhotoUrl'] +'"\n' +
                            '                                                alt="Card image cap" class="card-img-top"> <a href="#!">\n' +
                            '                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                            '                                            </a></div>\n' +
                            '                                        <div class="card-body"><p class="card-title font-weight-bold"><a style="color: black" href="/res-detail/'+ res_list[i]['Id']+'">'+ (res_list[i]['name_summary']) +'</a>\n' +
                            '                                            </p>\n' +
                            '                                            <p><i class="mr-10 fas fa-clock"></i><span>'+ res_list[i]['restaurant_detail']['open_time'] +'</span></p>\n' +
                            '                                            <a class="mb-2"><i class="mr-5 fas fa-map-marker-alt"></i>'+ res_list[i]['address_summary']+'\n' +
                            '                                            <p class="card-text"></p>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </section>\n' +
                            '                            </div>'

                    }
                    $('#saved-list').html(xhtml);
                })
            }
        }

        $(document).ready(function () {
            var profileObj = new ProfileObject();
            profileObj.getCommentImage();
            var user = localStorage.getItem('user');
            if (!user) {
                window.location.href = "/"
            }
            user = JSON.parse(user)
            profileObj.getSavedRes(user['Id']);
            profileObj.getOwnerRes();
            var avatar = user['Avatar'] ? '/' + user['Avatar'] : '/images/menu/logo/avatar.jpg';
            $('#avatar-profile').attr('src', avatar);
            $('#new-password').change(function (){
                profileObj.setNewPassword($(this).val())
            })
            $('#old-password').change(function (){
                profileObj.setOldPassword($(this).val())
            })
            $('#btn-update-profile').click(function () {
                var file = $('#image')[0].files[0];
                if (file) {
                    profileObj.uploadImage()
                } else {
                    profileObj.updateProfile()
                }
            })
            $('.comment-image').click(function () {
                var xhtml = ' <div class="carousel-item active' + '">\n' +
                    '                                <img class="d-block w-100" src="' + $(this).attr('src') + '" alt="First slide">\n' +
                    '                            </div>';
                $("#list-comment-picture").html(xhtml);
                $('#commentPictureModel').modal('show');
            });
        })
    </script>
@endsection
