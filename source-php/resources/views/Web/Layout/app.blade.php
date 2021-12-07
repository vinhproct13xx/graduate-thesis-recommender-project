<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
@include('Web.Layout.header')
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper" id="app" api-logout="{{route('api.account.logout')}}">

    <!-- Begin Header Area -->
    @include('Web.Layout.menu-top')
    {{--    Menu Left--}}
{{--    <div id="menu-left">--}}
{{--        <a id="scrollUp-custom" @click.stop.prevent="showMenuLeft()"--}}
{{--           style="position: absolute; bottom:207px;right:268px; z-index: 2147483647;"><i class="fas fa-bars"></i></a>--}}
{{--        <section id="menu-left-panel" is-hidden="yes">--}}

{{--            <!-- Card -->--}}
{{--            <div class="card booking-card card-menu-left" style="width: 18rem;">--}}
{{--                <!-- Card content -->--}}
{{--                <div class="card-body">--}}

{{--                    <!-- Title -->--}}
{{--                    <h4 style="margin-left: 40px" class="card-title font-weight-bold"><a>Khám phá</a></h4>--}}
{{--                    <!-- Data -->--}}
{{--                    <ul class="menu-sidebar-custom">--}}
{{--                        <li><a class="mb-2">55 Đặng Thùy Trâm<i class="fas fa-angle-right arrow-menu-left"></i></a></li>--}}
{{--                        <li><a class="mb-2">55 Đặng Thùy Trâm<i class="fas fa-angle-right arrow-menu-left"></i></a></li>--}}
{{--                        <li><a class="mb-2">55 Đặng Thùy Trâm<i class="fas fa-angle-right arrow-menu-left"></i></a></li>--}}
{{--                        <li><a class="mb-2">55 Đặng Thùy Trâm<i class="fas fa-angle-right arrow-menu-left"></i></a></li>--}}
{{--                    </ul>--}}

{{--                    <!-- Text -->--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <!-- Card -->--}}

{{--        </section>--}}
{{--    </div>--}}
{{--    End menu left--}}
    @yield('content')
    <!-- Li's Trendding Products Area End Here -->
    <!-- Begin Footer Area -->
{{--    @include('Web.Layout.footer')--}}
    <div class="system_message">
        <div class="title"></div>
    </div>

    <!-- Model more comment picture -->
    <div id="commentPictureModel" class="modal fade modal-wrapper" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" id="list-comment-picture">
{{--                            <div class="carousel-item active">--}}
{{--                                <img class="d-block w-100" src="/images/new_logo.png" alt="First slide">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img class="d-block w-100" src="/images/slider/foody-slider1.jpg" alt="Second slide">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img class="d-block w-100" src="/images/slider/foody-slider1.jpg" alt="Third slide">--}}
{{--                            </div>--}}
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i style="font-size: x-large" class="fas fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i style="font-size: x-large" class="fas fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View | Modal Area End Here -->

</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src="/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper js -->
<script src="/js/vendor/popper.min.js"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="/js/bootstrap.min.js"></script>
<!-- Ajax Mail js -->
<script src="/js/ajax-mail.js"></script>
<!-- Meanmenu js -->
<script src="/js/jquery.meanmenu.min.js"></script>
<!-- Wow.min js -->
<script src="/js/wow.min.js"></script>
<!-- Slick Carousel js -->
<script src="/js/slick.min.js"></script>
<!-- Owl Carousel-2 js -->
<script src="/js/owl.carousel.min.js"></script>
<!-- Magnific popup js -->
<script src="/js/jquery.magnific-popup.min.js"></script>
<!-- Isotope js -->
<script src="/js/isotope.pkgd.min.js"></script>
<!-- Imagesloaded js -->
<script src="/js/imagesloaded.pkgd.min.js"></script>
<!-- Mixitup js -->
<script src="/js/jquery.mixitup.min.js"></script>
<!-- Countdown -->
<script src="/js/jquery.countdown.min.js"></script>
<!-- Counterup -->
<script src="/js/jquery.counterup.min.js"></script>
<!-- Waypoints -->
<script src="/js/waypoints.min.js"></script>
<!-- Barrating -->
<script src="/js/jquery.barrating.min.js"></script>
<!-- Jquery-ui -->
<script src="/js/jquery-ui.min.js"></script>
<!-- Venobox -->
<script src="/js/venobox.min.js"></script>
<!-- Nice Select js -->
<script src="/js/jquery.nice-select.min.js"></script>
<!-- ScrollUp js -->
<script src="/js/scrollUp.min.js"></script>
<!-- Main/Activator js -->
<script src="/js/main.js"></script>
<script src="/js/vue.js"></script>
<script src="/js/axios.min.js"></script>
@yield('script')
</body>
<script>
    function App(){
        this.api_logout = $('#app').attr('api-logout');

        this.logout = function (){
            var token = localStorage.getItem('token');
            $.ajax({
                method: "GET",
                headers : {
                    "Authorization" : "Bearer " + token
                },
                url : this.api_logout
            }).done(function (data,error){
                if(data.success){
                    localStorage.removeItem('user');
                    localStorage.removeItem('token');
                    window.location.href = '/login'
                }else{
                    helper.showNotification(data.message,'danger');
                }
            }).fail(function (data){
                helper.showNotification(data.responseJSON.message, 'danger');
            });
        }
        this.initial = function (){
            var user = localStorage.getItem('user');
            if(user){
                user = JSON.parse(user);
                var avatar = user['Avatar'] ? '/'+ user['Avatar'] : '/images/menu/logo/avatar.jpg'
                var name = user['DisplayName'] ? (user['DisplayName']).slice(0,8)+'...' : user['email'].slice(0,8)+'...';
                $('#avatar').attr('src',avatar);
                $('#display-name').text(name);
                $('#login-info').removeClass('hide-elm');

            }else{
                $('#btn-login-index').removeClass('hide-elm');
            }
        }
        return this;
    }
    $(document).ready(function (){
        // $.ajax({
        //     method : "GET",
        //     data : {
        //         query : "Gần tôi nhất"
        //     },
        //     // url: 'http://127.0.0.1:8000/polls/go'
        //     url: 'https://recommender-2oclock.herokuapp.com/polls/go'
        // }).done(function (result){
        //     console.log(result)
        // })
        $(document).trigger('vue-loaded');
        var app = new App();
        app.initial();
        $('#btn-logout').click(function (){
            app.logout();
        });
        $('#btn-login-index').click(function (){
            window.location.href = '/login';
        });
        $('#btn-search').click(function (event) {
            event.preventDefault();
            var search_val = $('#search-input').val();
            window.location.href ='search/'+search_val;
        })

    });
    function getCategory(query){
        $.ajax({
            method : "GET",
            data : {
                query : query
            },
            url: 'https://recommender-2oclock.herokuapp.com/polls/category'
        }).done(function (result){
            if(result.success ==1){
                if((result.data)[1]['sim'] > 2.5){
                    return (result.data)[1]['sim']['name'];
                }
                return false;
            }
            return false;
        })
    }
    function search(){
        // var search_val = $('#search-input').val();
        // console.log(222222);
        // window.location.href = '/search?value=';
    }
    function startRecording() {
        console.log('Start recording......');
        if (window.hasOwnProperty('webkitSpeechRecognition')) {
            var recognition = new webkitSpeechRecognition();
            recognition.continuous = false;
            recognition.interimResults = false;
            recognition.lang = "vi-VN";
            recognition.start();
            recognition.onresult = function(e) {
                console.log(e.results[0][0].transcript);
                $.ajax({
                    method : "GET",
                    data : {
                        query : e.results[0][0].transcript
                    },
                    url: 'https://recommender-2oclock.herokuapp.com/polls/go'
                }).done(function (result){
                    if(result.success && result.success ==1){
                        if((result.data)[1]['sim'] > 0){
                            var action = (result.data)[1]['action'];
                            var category_id = '';
                            if(result.category){
                                console.log(result.category.name)
                                category_id = result.category.id
                            }
                            console.log(action)

                            switch (action){
                                case 'NEAREST':
                                    window.location.href = '/more-res/nearest?category_id=' + category_id
                                    break;
                                case 'NEAR':
                                    window.location.href = '/more-res/nearest?category_id=' + category_id
                                    break;
                                case 'OPEN':
                                    window.location.href = '/more-res/open?category_id=' + category_id
                                    break;
                                case 'LOGIN' :
                                    window.location.href = '/login'
                                    break;
                                case 'SUGGEST' :
                                    window.location.href = '/more-res/suggest?category_id=' + category_id
                                    break;
                                case 'LOGOUT' :
                                    var app = new App();
                                    app.logout();
                            }
                        }
                    }
                })
                recognition.stop();
            };
            recognition.onerror = function(e) {
                recognition.stop();
            }
        }
    }
</script>
<!-- index30:23-->
</html>
