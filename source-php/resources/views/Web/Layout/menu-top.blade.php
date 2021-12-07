<header>
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="/">
                            <img src={{asset("images/new_logo2.png")}}  alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <div class="hm-searchbox">
                        <input type="text" id="search-input" placeholder="Enter your search key ...">
                        <button class="li-btn" id="btn-search"><i class="fa fa-search"></i></button>
                    </div>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            <li class="hm-wishlist">
                                <a onclick="startRecording()" style="border-radius: 55px" data-toggle="tooltip" data-placement="top" title="Điều khiển bằng giọng nói" >
                                    <i class="fas fa-microphone"></i>
                                </a>
                            </li>
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart hide-elm" id="login-info">
                                <div class="hm-minicart-trigger">
                                    <div class="item-icon"><img id="avatar" src="/images/menu/logo/avatar.jpg"></div>
                                    <span id="display-name" class="item-text">Đoàn &nbsp;<i class="fas fa-angle-down"></i></span>
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        <li>
                                            <div class="minicart-product-details">
                                                <h6><a href="/profile"><i style="color: blue" class="icon-menu-user fas fa-chalkboard-teacher"></i>{{__('profile')}}</a></h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="minicart-product-details">
                                                <h6><a href="/new-res"><i style="color: greenyellow" class="icon-menu-user far fa-calendar-minus"></i>{{__('new_location')}}</a></h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="minicart-product-details">
                                                <h6><a href="/admin"><i style="color: blueviolet" class="icon-menu-user far fa-calendar-minus"></i>Admin</a></h6>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="minicart-button" id="btn-logout">
                                        <a class="li-button li-button-fullwidth li-button-red">
                                            <span>{{__('logout')}}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                        <button class="btn btn-primary hide-elm" id="btn-login-index">{{__('login')}}</button>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a href="/more-res/open">{{__('open')}}</a></li>
                                <li><a href="/more-res/nearest">{{__('nearest')}}</a></li>
                                <li><a href="/more-res/suggest">{{__('suggest')}}</a>
                                </li>
{{--                                <li><a href="blog-left-sidebar.html">{{__('newest')}}</a>--}}
                                </li>
                                <li >
                                    <div class="form-inline">
                                        <a class="mr-10" data-toggle="tooltip" data-placement="top" data-original-title="Việt Nam" href="{!! route('user.change-language', ['vi']) !!}">
                                            <img style="width: 34px; height: 34px" src="{{asset('images/vietnam.png')}}">
                                        </a>
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="English" href="{!! route('user.change-language', ['en']) !!}">
                                            <img style="width: 30px; height: 30px" src="{{asset('images/united-kingdom.png')}}">
                                        </a>
                                    </div>

                                </li>
                                <li style="position: absolute;right: 0px; top: 4px">

                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>

