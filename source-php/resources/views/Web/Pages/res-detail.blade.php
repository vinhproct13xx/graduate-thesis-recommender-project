@extends('Web.Layout.app')
@section('content')
    <div id="detail-page" res-id="{{$res['Id']}}" api-get-comment="{{route('api.comment.get-list')}}"
         api-like="{{route('api.comment.like')}}" api-upload-image="{{route('api.utity.upload_image')}}"
         api-remove-image="{{route('api.utity.remove_image')}}" api-create-comment="{{route('api.comment.create')}}"
         api-save="{{route('api.res.save')}}" api-get-saved-res="{{route('api.res.saved')}}"
         api-report="{{route('api.report.create')}}">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Single Product</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!-- content-wraper start -->
        <div class="content-wraper my-card">
            <div class="container">
                <div class="row single-product-area">
                    <div class="col-lg-5 col-md-6">
                        <div class="lg-image">
                            @if($res['IsFoody'])
                                <a class="popup-img venobox vbox-item" href="{{$res['PhotoUrl']}}"
                                   data-gall="myGallery">
                                    <img id="detail-product-img" src="{{$res['PhotoUrl']}}" alt="product image">
                                </a>
                            @else
                                <a class="popup-img venobox vbox-item" href="/{{$res['PhotoUrl']}}"
                                   data-gall="myGallery">
                                    <img id="detail-product-img" src="/{{$res['PhotoUrl']}}" alt="product image">
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6">
                        <div class="product-details-view-content pt-20">
                            <div class="product-info">
                                <span
                                    class="product-details-ref">{{!empty($res['restaurant_detail']['category'])? $res['restaurant_detail']['category']['name'] : ''}}</span>
                                <h2 class="pl-15"
                                    style="font-size: 25px !important; margin: 7px 0px 0px -17px;">{{$res['Name']}}</h2>
                                <div class="price-box pt-20">
                                    <div class="row">
                                        <div class="col-sm-1 haha-custom">
                                            <span class="rating-point-main">{{$res['AvgRating']}}</span>
                                        </div>
                                        <div class="col-sm-11 form-inline">
                                            <div class="mr-20">
                                                <p class="point-rating-header">{{$res['QualityRating'] ?? $res['AvgRating']}}</p>
                                                <p style="margin-top: -14px; color: #898989">Chất lượng</p>
                                            </div>
                                            <div class="mr-20" style="width: 58px">
                                                <p class="point-rating-header">{{$res['ServiceRating'] ?? $res['AvgRating']}}</p>
                                                <p style="margin-top: -14px; color: #898989">Dịch vụ</p>
                                            </div>
                                            <div class="mr-20" style="width: 58px">
                                                <p class="point-rating-header">{{$res['PriceRating'] ?? $res['AvgRating']}}</p>
                                                <p style="margin-top: -14px; color: #898989">Giá cả</p>
                                            </div>
                                            <div class="mr-20" style="width: 58px">
                                                <p class="point-rating-header">{{$res['PositionRating'] ?? $res['AvgRating']}}</p>
                                                <p style="margin-top: -14px; color: #898989">Vị trí</p>
                                            </div>
                                            <div class="mr-20" style="width: 72px">
                                                <p class="point-rating-header">{{$res['SpaceRating'] ?? $res['AvgRating']}}</p>
                                                <p style="margin-top: -14px; color: #898989">Không gian</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-desc">
                                    <div class="mb-5">
                                        <i class="mr-10 fas fa-location-arrow"></i>{{$res['Address']}}
                                    </div>
                                    <div class="mb-5">
                                        <i class="mr-10 fas fa-clock"></i>{{$res['restaurant_detail']['open_time']}}
                                    </div>
                                    <div class="mb-5">
                                        <i class=" mr-10 fas fa-tags"></i>{{$res['restaurant_detail']['price']}}
                                    </div>
                                </div>
                                <div class="product-additional-info mb-20">
                                    <a class="wishlist-btn" style="color: blue" data-toggle="modal"
                                       data-target="#comment" href="wishlist.html">
                                        <i class="fa fa-comment"></i>Bình luận</a>
                                    <a id="btn-save" class="wishlist-btn  ml-20">
                                        <i class="fa fa-bookmark"></i>Lưu
                                    </a>
                                    <div class="product-social-sharing pt-15">
                                        <ul>
                                            <li class="facebook"><a href="http://www.facebook.com/sharer.php?u={{asset('res-detail').'/'.$res['Id']}}"><i class="fa fa-facebook"></i>Facebook</a>
                                            </li>
{{--                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google--}}
{{--                                                    +</a></li>--}}
{{--                                            <li class="instagram"><a href="#"><i--}}
{{--                                                        class="fa fa-instagram"></i>Instagram</a>--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wraper end -->
        <!-- Begin Product Area -->
        <div class="product-area pt-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="li-product-tab">
                            <ul class="nav li-product-menu">
                                <li><a class="active" data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                                <li><a data-toggle="tab" href="#description"><span>Description</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- Begin Li's Tab Menu Content Area -->
                    </div>
                </div>
                <div class="tab-content row">
                    <div class="col-lg-9">
                        <div id="description" class="tab-pane" role="tabpanel">
                            <div class="product-description">
                                <span>The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.</span>
                            </div>
                        </div>
                        <div id="product-details" class="tab-pane" role="tabpanel">
                            <div class="product-details-manufacturer">
                                <a href="#">
                                    <img src="/images/product-details/1.jpg" alt="Product Manufacturer Image">
                                </a>
                                <p><span>Reference</span> demo_7</p>
                                <p><span>Reference</span> demo_7</p>
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane active show" role="tabpanel">
                            <div id="review-list" class="product-reviews">
                                @foreach($comments as $comment)
                                    <div class="my-card comment-panel">
                                        <div class="comment-header">
                                            <div class="row">
                                                <div class="mt-10 mb-10 ml-20 mr-10">
                                                    <img class="avatar" src="{{$comment['customer']['Avatar'] ? ($comment['customer']['IsFoody'] ? $comment['customer']['Avatar'] : '/'.$comment['customer']['Avatar']) : '/images/menu/logo/avatar.jpg'}}">
                                                </div>
                                                <div class="mt-10">
                                                    <p class="comment-user"
                                                       style="margin-bottom: -5px !important;">{{$comment['customer']['DisplayName']}}</p>
                                                    <p class="comment-time">{{$comment['CreatedOnTimeDiff']}}</p>
                                                </div>
                                                <p class="rating-point">{{$comment['AvgRating']}}</p>
                                            </div>
                                        </div>
                                        <div class="my-comment-body">
                                            <div class="comment-content">
                                                <p style="color: black; margin-bottom: 0px !important;">{{$comment['Description']}}</span>
                                                </p>
                                            </div>
                                            <div class="comment-picture">
                                                <div class="row" style="padding: 20px">
                                                    @foreach($comment['comment_pictures'] as $key=>$pic)
                                                        @if($key == 2 && count($comment['comment_pictures']) > 3)
                                                            <div class="col-sm-4"
                                                                 style="text-align: center; padding: 2px !important;">
                                                                <p>+{{count($comment['comment_pictures']) - 3}}</p>
                                                                <img class="comment-image last-comment-image"
                                                                     is-foody="{{$pic['IsFoody']}}"
                                                                     urls="{{json_encode($comment['comment_pictures'])}}"
                                                                     src="{{$pic['IsFoody'] ? $pic['Url'] : '/'.$pic['Url']}}">
                                                            </div>
                                                            @break
                                                        @endif
                                                        <div class="col-sm-4"
                                                             style="text-align: center; padding: 2px !important; ">
                                                            <img class="comment-image " style="text-align: center"
                                                                 is-foody="{{$pic['IsFoody']}}"
                                                                 urls="{{json_encode($comment['comment_pictures'])}}"
                                                                 src="{{$pic['IsFoody'] ? $pic['Url'] : '/'.$pic['Url']}}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-footer">
                                            <div class="row mb-5">
                                                <div class="mr-20">
                                                    <i style="color: blue" class="fa fa-heart mr-5"></i><span
                                                        id="{{$comment['Id']}}">{{$comment['TotalLike']}} </span>người
                                                    đã thích
                                                </div>
                                            </div>
                                            <hr class="my-hr">
                                            <div class="row mb-5 action">
                                                <div class="mr-20 like" comment_id="{{$comment['Id']}}">
                                                    <i class="fa fa-heart mr-5"></i><span>Like</span>
                                                </div>
                                                <div class="mr-20 btn-report-comment" comment_id="{{$comment['Id']}}">
                                                    <a data-toggle="modal" data-target="#report">
                                                        <i class="fa fa-exclamation-triangle report-btn mr-5"></i>
                                                        <span>report</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{--                                <div  id="load-more" class="see-more"><a>Tải nhiều hơn<i--}}
                                {{--                                            class="ml-5 fas fa-angle-double-down"></i></a></div>--}}
                                <div
                                    style="text-align: center">{{$comments->links('Web.Pagination.comment-pagination')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="my-card mt-25 rating-card" style="box-shadow: 0px 0px 10px 0px #4285f4 !important;">
                            <div>
                                <p style="color: black!important; text-align: center; font-size: initial"><b>{{$res['TotalReviews']}} </b>người
                                    dùng đã chia sẻ</p>
                            </div>
                            <hr style="margin: 10px 0px">
                            <div class="row">
                                <div class="col-6" style="padding-right: 5px !important; text-align: right">
                                    <p style="color: green" class="point_rating_detail">25</p>
                                    <p style="color: red" class="point_rating_detail">7</p>
                                    <p style="color: blue" class="point_rating_detail">7</p>
                                    <p style="color: purple" class="point_rating_detail">2</p>
                                </div>
                                <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                    <p>Tuyệt vời</p>
                                    <p>Khá tốt</p>
                                    <p>Trung bình</p>
                                    <p>Kém</p>
                                </div>
                            </div>
                            <hr style="margin: 10px 0px">
                            <div>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                        <p class="mbI-0" style="color: black!important;">Vị trí</p>
                                    </div>
                                    <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                        <div class="progress" style="border-radius: 0; height: 15px; margin-top: 3px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="10" aria-valuemax="100" style="width:{{($res['PostionRating'] ?? $res['AvgRating']) *10}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 plI-0 prI-0">{{$res['PostionRating'] ?? $res['AvgRating']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                        <p class="mbI-0" style="color: black!important;">Giá cả</p>
                                    </div>
                                    <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                        <div class="progress" style="border-radius: 0; height: 15px; margin-top: 3px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="10" aria-valuemax="100" style="width:{{($res['PriceRating'] ?? $res['AvgRating']) *10}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 plI-0 prI-0">{{$res['PriceRating'] ?? $res['AvgRating']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                        <p class="mbI-0" style="color: black!important;">Chất lượng</p>
                                    </div>
                                    <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                        <div class="progress" style="border-radius: 0; height: 15px; margin-top: 3px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="10" aria-valuemax="100" style="width:{{($res['QualityRating'] ?? $res['AvgRating']) *10}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 plI-0 prI-0">{{$res['QualityRating'] ?? $res['AvgRating']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                        <p class="mbI-0" style="color: black!important;">Dịch vụ</p>
                                    </div>
                                    <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                        <div class="progress" style="border-radius: 0; height: 15px; margin-top: 3px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="10" aria-valuemax="100" style="width:{{($res['ServiceRating'] ?? $res['AvgRating']) *10}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 plI-0 prI-0">{{$res['ServiceRating'] ?? $res['AvgRating']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                        <p class="mbI-0" style="color: black!important;">Không gian</p>
                                    </div>
                                    <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                        <div class="progress" style="border-radius: 0; height: 15px; margin-top: 3px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="10" aria-valuemax="100" style="width:{{($res['SpaceRating'] ?? $res['AvgRating']) *10}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 plI-0 prI-0">{{$res['SpaceRating'] ?? $res['AvgRating']}}</div>
                                </div>
                            </div>
                            <hr style="margin: 10px 0px">
                            <div style="text-align: center">
                                <b style="font-size: x-large; color: #03ae03">{{$res['AvgRating']}}</b> điểm
                            </div>
                            <div>
                                <button style="margin-left: 0px; width: 100%" class="btn btn-primary"><a
                                        data-toggle="modal" data-target="#comment">Viết bình luận</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End Here -->
        <!-- Begin suggested Product Area -->

        <!-- Model comment -->
        <div class="modal fade modal-wrapper" id="comment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area row">
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">
                                    <div class="product-details-images slider-navigation-1">
                                        <div class="lg-image">
                                            @if($res['IsFoody'])
                                                <img src="{{$res['PhotoUrl']}}" alt="product image">
                                            @else
                                                <img src="/{{$res['PhotoUrl']}}" alt="product image">
                                            @endif
                                        </div>
                                    </div>
                                    <div style="text-align: center; margin-top: 10px">
                                        <p style="font-size: large; font-weight: bold; color: chocolate">Đánh giá</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" style="padding-right: 5px !important; text-align: right">
                                            <p>Vị trí</p>
                                            <p>Giá cả</p>
                                            <p>Chất lượng</p>
                                            <p>Dịch vụ</p>
                                            <p>Không gian</p>
                                        </div>
                                        <div class="col-6" style=" padding-left: 5px !important; text-align: left">
                                            <input id="PositionRating" class="custom-range" type="range" min="1" max="10">
                                            <input id="PriceRating" class="custom-range" type="range" min="1" max="10">
                                            <input id="QualityRating" class="custom-range" type="range" min="1" max="10">
                                            <input id="ServiceRating" class="custom-range" type="range" min="1" max="10">
                                            <input id="SpaceRating" class="custom-range" type="range" min="1" max="10">
                                        </div>
                                        <div class="col-2" style="padding-left: 5px !important; text-align: left">
                                            <p id="PositionRatingLabel" style="color: #9c25b9!important;">5</p>
                                            <p id="PriceRatingLabel" style="color: #00c851 !important;">5</p>
                                            <p id="QualityRatingLabel" style="color: black!important;">5</p>
                                            <p id="ServiceRatingLabel" style="color: red!important;">5</p>
                                            <p id="SpaceRatingLabel" style="color: red!important;">5</p>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <p style="font-size: large; font-weight: bold">Trung bình:
                                            <span id="AvgRatingLabel"
                                                style="margin-left:5px; font-size: large; font-weight: bold; color: red">5</span>
                                        </p>
                                    </div>
                                </div>
                                <!--// Product Details Left -->
                            </div>

                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="product-details-view-content">
                                    <div class="product-info">
                                        <h2>{{$res['Name']}}</h2>
                                        <span class="product-details-ref"><i class="mr-10 fas fa-location-arrow"></i>{{$res['Address']}}</span>
                                        <div class="product-desc">
                                        <textarea id="discription_ta" placeholder="Nhập bình luận">
                                        </textarea>
                                        </div>
                                        <p>Chọn hình</p>
                                        <div class="row">
                                            <div class="row ml-10" id="temp-images">

                                            </div>
                                            <div style="margin-left: 14px" class="select-img-comment"><input id="image"
                                                    style="margin-top: -5px; opacity: 0; height: 140px" type="file"><i
                                                    id="add-img-comment" class="fas fa-plus"></i></div>
                                        </div>
                                        <div>
                                            <button class="btn btn-success" id="btn-create-comment">Gửi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View | Modal Area End Here -->
    </div>
    <div style="margin-top: 100px" id="report" class="modal fade modal-wrapper" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Báo cáo <i style="color: red" class="fa fa-exclamation-triangle"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b>Nội dung: </b>
                    <textarea id="ta-report" placeholder="Nhập nội dung"></textarea>
                    <button id="btn-submit-report" class="btn btn-success">Gửi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function DetailPage() {
            this.limit = 10;
            this.page = 2;
            this.token = localStorage.getItem('token');
            this.user = localStorage.getItem('user');
            if(this.user){
                this.user = JSON.parse(this.user);
            }
            this.res_id = $('#detail-page').attr('res-id');
            this.api_get_comment = $('#detail-page').attr('api-get-comment');
            this.api_like = $('#detail-page').attr('api-like');
            this.api_create_comment = $('#detail-page').attr('api-create-comment');
            this.api_save = $('#detail-page').attr('api-save');
            this.api_get_saved_res = $('#detail-page').attr('api-get-saved-res');
            this.api_report = $('#detail-page').attr('api-report');

            this.comment = {
                ResId : this.res_id,
                PositionRating : 5,
                PriceRating : 5,
                QualityRating : 5,
                ServiceRating : 5,
                SpaceRating : 5,
                AvgRating : 5,
                Description : '',
                pictures : []
        };
            this.report = {
                object_id : null,
                type : null,
                content : null,
                owner_id : null,
            }

            var ancestor = this;
            this.init = function () {
                $('.comment-image').click(function () {
                    var pics = JSON.parse($(this).attr('urls'));
                    var is_foody = parseInt($(this).attr('is-foody'));
                    var xhtml = '';
                    for (i in pics) {
                        var is_active = '';
                        if (i == 0) {
                            is_active = 'active'
                        }
                        var url = pics[i]['Url'];
                        if(!is_foody){
                            url = '/' + url;
                        }
                        xhtml += ' <div class="carousel-item ' + is_active + '">\n' +
                            '                                <img class="d-block w-100" src="' + url + '" alt="First slide">\n' +
                            '                            </div>';
                    }
                    $("#list-comment-picture").html(xhtml);
                    $('#commentPictureModel').modal('show');
                });
            }
            this.getComment = function () {
                $.ajax({
                    method: 'POST',
                    data: {
                        limit: ancestor.limit,
                        page: ancestor.page,
                        res_id: ancestor.res_id
                    },
                    url: ancestor.api_get_comment
                }).done(function (result) {
                    if (result['success'] && result['data']['data'][0]) {
                        var comments = result['data']['data'];
                        var xhtml = $('#review-list').html();
                        for (i in comments) {
                        }
                        $('#review-list').html(xhtml);
                    }
                });
            }
            this.like = function (comment_id) {
                if (!ancestor.token) {
                    helper.showNotification('Vui lòng đăng nhập', 'danger');
                    return;
                }
                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + ancestor.token
                    },
                    method: 'POST',
                    data: {
                        comment_id: comment_id,
                    },
                    url: ancestor.api_like
                }).done(function (result) {
                    if (result.success) {
                        $('#' + comment_id).html(result.data + ' ');
                    }
                })
            }
            this.createReport = function () {
                if (!ancestor.token) {
                    helper.showNotification('Vui lòng đăng nhập', 'danger');
                    return;
                }
                this.report.content = $('#ta-report').val();
                this.report.owner_id = ancestor.user['Id'];

                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + ancestor.token
                    },
                    method: 'POST',
                    data: ancestor.report,
                    url: ancestor.api_report
                }).done(function (result) {
                    if (result.success) {
                        helper.showNotification(result.message,'success');

                    }
                })
            }
            this.save = function () {
                if (!ancestor.token) {
                    helper.showNotification('Vui lòng đăng nhập', 'danger');
                    return;
                }
                $.ajax({
                    headers: {
                        "Authorization": "Bearer " + ancestor.token
                    },
                    method: 'POST',
                    data: {
                        res_id: ancestor.res_id,
                    },
                    url: ancestor.api_save
                }).done(function (result) {
                    if (result.success) {
                        // $('#btn-save').css('color','blue');
                        // ancestor.get_saved_res();
                        if(result.type=='save'){
                            $('#btn-save').css('color','blue');
                        }else {
                            $('#btn-save').css('color','black');
                        }
                        helper.showNotification(result.message,'success')
                    }
                })
            }
            this.get_saved_res = function (){
                if (!ancestor.token) {
                    return;
                }
                $.ajax({
                    method: 'POST',
                    data: {
                        customer_id : ancestor.user['Id']
                    },
                    url : ancestor.api_get_saved_res
                }).done(function (result){
                    var res_list = result.data;
                    if(res_list[0]){
                        for (i in res_list){
                            if(res_list[i]['Id'] == ancestor.res_id){
                                $('#btn-save').css('color','blue');
                                return;
                            }
                        }
                        $('#btn-save').css('color','black');
                    }
                })
            }

            this.setPage = function (val = 1) {
                this.page = 1;
            }
            this.setComment = function ($key,$val){
                this.comment[$key] = $val;
            }
            this.setReport = function ($key,$val){
                this.report[$key] = $val;
            }
            this.calculateAvgRating = function (){
                this.comment.AvgRating = (this.comment.PositionRating + this.comment.PriceRating + this.comment.QualityRating
                + this.comment.ServiceRating + this.comment.SpaceRating)/5;
            }
            this.createComment = function (){
                if(!this.token){
                    helper.showNotification('Vui lòng đăng nhập','danger');
                    return
                }
                this.comment.Owner_id = this.user['Id'];
                $.ajax({
                    method : 'POST',
                    data : ancestor.comment,
                    url: ancestor.api_create_comment
                }).done(function (result){
                    if(result.success){
                        helper.showNotification(result.message,'success');
                        location.reload(true);
                        $('#comment').modal('hide');
                    }else{
                        helper.showNotification(result.message,'danger')
                    }
                })
            }
            return this;
        }

        $(document).ready(function () {
            var detail_page = new DetailPage();
            detail_page.init();
            detail_page.get_saved_res();
            $('.like').click(function () {
                var comment_id = $(this).attr('comment_id')
                detail_page.like(comment_id);
            });
            $('.btn-report-comment').click(function () {
                var comment_id = $(this).attr('comment_id')
                detail_page.setReport('object_id',comment_id);
                detail_page.setReport('type','comment');
            });
            $('#btn-save').click(function () {
                detail_page.save();
            });

            $('#btn-submit-report').click(function () {
                detail_page.createReport();
            });

            $('#PositionRating').change(function (){
                var val = $(this).val();
                detail_page.setComment('PositionRating',parseInt(val));
                detail_page.calculateAvgRating();
                $('#PositionRatingLabel').html(val);
                $('#AvgRatingLabel').html(detail_page.comment.AvgRating);
            });
            $('#PriceRating').change(function (){
                var val = $(this).val();
                detail_page.setComment('PriceRating',parseInt(val));
                detail_page.calculateAvgRating();
                $('#PriceRatingLabel').html(val);
                $('#AvgRatingLabel').html(detail_page.comment.AvgRating);
            });
            $('#QualityRating').change(function (){
                var val = $(this).val();
                detail_page.setComment('QualityRating',parseInt(val));
                detail_page.calculateAvgRating();
                $('#QualityRatingLabel').html(val);
                $('#AvgRatingLabel').html(detail_page.comment.AvgRating);
            });
            $('#ServiceRating').change(function (){
                var val = $(this).val();
                detail_page.setComment('ServiceRating',parseInt(val));
                detail_page.calculateAvgRating();
                $('#ServiceRatingLabel').html(val);
                $('#AvgRatingLabel').html(detail_page.comment.AvgRating);
            });
            $('#SpaceRating').change(function (){
                var val = $(this).val();
                detail_page.setComment('SpaceRating',parseInt(val));
                detail_page.calculateAvgRating();
                $('#SpaceRatingLabel').html(val);
                $('#AvgRatingLabel').html(detail_page.comment.AvgRating);
            });
            $('#discription_ta').on('change keyup paste',function (){
                detail_page.setComment('Description',$(this).val());
            })
            $('#image').change(function (){
                var fd = new FormData();
                fd.append('image',$('#image')[0].files[0])
                $.ajax({
                        url : $('#detail-page').attr('api-upload-image'),
                    method : 'POST',
                    data: fd,
                    contentType : false,
                    processData : false
                }).done(function (result){
                    if(result.success){
                        detail_page.comment.pictures.push(result.data.path);
                        var xhtml = $('#temp-images').html();
                        xhtml += '<div  class="select-img-comment"> \n' +
                            '<img class="img-comment" src="/'+ result.data.path +'"> \n' +
                            '<i data-path="'+result.data.path +'" onclick="deleteImage(this)" class="cancel far fa-times-circle"></i> \n' +
                            '</div>';
                        $('#temp-images').html(xhtml);
                    }else{
                        helper.showNotification(result.message,'danger')
                    }
                    $('#image').val(null);
                })
            })
            $('#btn-create-comment').click(function (){
                detail_page.createComment();
            })
            // $('html, body').animate({
            //     scrollTop: $('#review-list').offset().top
            // }, 'slow');
        });
        function deleteImage(el){
            var api_remove_image = $('#detail-page').attr('api-remove-image');
            $.ajax({
                method: 'POST',
                data : {
                    path : $(el).attr('data-path'),
                },
                url : api_remove_image
            }).done(function (result){
                if(result.success){
                   $(el).parent().remove();
                }else {
                    helper.showNotification(result.message,'danger')
                }
            })
        }
    </script>
@endsection
