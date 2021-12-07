@extends('Web.Layout.app')
@section('content')
    <div class="row" id="loginObj" api-login="{{route('api.account.login')}}"
         data-login-google = "{{$data_login_google ?? null}}">
        <div class="col-md-6">
            <img id="img-login" style="width: 100%" src="{{asset('images/background/hihihi-1.jpg')}}">
        </div>
        <div class="col-md-6 col-sm-12 panel-login-right">
            <div class="container">
                <h4 class="mb-20">ĐĂNG NHẬP</h4>
                <div class="my-card" style="padding: 20px;border-radius: 15px; box-shadow: -1px 1px 9px 0px #00c851">
                    <div class="login-form-group">
                        <b>Email:</b>
                        <input id="txb-email" type="email" value="b@gmail.com" placeholder="Email" class="form-control">
                        <p class="error"></p>
                    </div>
                    <div class="login-form-group">
                        <b>Mật khẩu:</b>
                        <input id="txb-password" value="1" type="password" placeholder="Mật khẩu" class="form-control">
                    </div>
                    <div class="login-form-group form-inline">
                        <input style="width: 15px; height: 15px" type="checkbox" class="form-control mr-10"><span>Nhớ mật khẩu</span>
                    </div>
                    <div class="login-form-group">
                        <button id="btn-login" type="submit" class="btn btn-primary">Đăng nhập</button>

                        <button id="btn-login-gg" class="loginBtn loginBtn--google ">
                            Login with Google
                        </button>
                    </div>
                    <div style="text-align: center; margin-top: 5px">
                        <p>Bạn chưa có tài khoản? <a href="/register">ĐĂNG KÝ</a> ngay</p>
                        <a href="/forget">Quên mật khẩu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function LoginObject() {
            this.email = $('#txb-email').val();
            this.password = $('#txb-password').val();
            this.api_login = $('#loginObj').attr('api-login');

            this.login = function () {
                $.ajax({
                    method: "POST",
                    data : {
                        email : this.email,
                        password : this.password
                    },
                    url:  this.api_login,
                })
                    .done(function (data) {
                        if(data.success){
                            localStorage.setItem('token',data['data']['token']);
                            localStorage.setItem('user',JSON.stringify(data['data']['user']));
                            window.location.href = '/';
                        }else{
                            helper.showNotification(data['message'],'danger');
                        }
                    });
            };

            this.setEmail = function (val){
                this.email = val;
            }
            this.setPassword = function (val){
                this.password = val;
            }
        return this;
        };
        $(document).ready(function () {
            initial();
            var loginObj = new LoginObject();

            $("#txb-email").change(function (){
                loginObj.setEmail($(this).val());
            });
            $("#txb-password").change(function (){
                loginObj.setPassword($(this).val());
            });
            $("#btn-login").click(function () {
                loginObj.login()
            });
            $("#btn-login-gg").click(function () {
                window.location.href = 'auth/google'
            });
        });
        function initial(){
            var token = localStorage.getItem('token');
            if(token){
                window.location.href = '/';
            }
            var data_login_gg = $('#loginObj').attr('data-login-google');
            if(data_login_gg){
                data_login_gg = JSON.parse(data_login_gg);
                localStorage.setItem('token',data_login_gg['token']);
                localStorage.setItem('user',JSON.stringify(data_login_gg['user']));
                window.location.href = '/';
            }
        }
    </script>
@endsection
