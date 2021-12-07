@extends('Web.Layout.app')
@section('content')
    <div class="row" id="registerObj" api-register="{{route('api.account.register')}}">
        <div class="col-md-6">
            <img id="img-login" style="width: 100%" src="{{asset('images/background/hihihi-1.jpg')}}">
        </div>
        <div class="col-md-6 col-sm-12 panel-login-right">
            <div class="container">
                <h4 class="mb-20">ĐĂNG KÝ</h4>
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
                    <div class="login-form-group">
                        <b>Nhập lại mật khẩu:</b>
                        <input id="txb-re-password" value="1" type="password" placeholder="Nhập lại mật khẩu" class="form-control">
                    </div>
                    <div class="login-form-group form-inline">
                        <a style="text-decoration: underline" href="/login">Đã có tài khoản</a>
                    </div>
                    <div class="login-form-group">
                        <button id="btn-register" type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function RegisterObject() {
            this.email = $('#txb-email').val();
            this.password = $('#txb-password').val();
            this.re_password = $('#txb-re-password').val();
            this.api_register = $('#registerObj').attr('api-register');

            this.register = function () {
                if(this.password != this.re_password){
                    helper.showNotification('Mật khẩu không khớp','danger')
                    return;
                }
                $.ajax({
                    method: "POST",
                    data : {
                        email : this.email,
                        password : this.password
                    },
                    url:  this.api_register,
                })
                    .done(function (data) {
                        if(data.success){
                            window.location.href = '/login';
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
            this.setRePassword = function (val){
                this.re_password = val;
            }
            return this;
        };
        $(document).ready(function () {
            var registerObj = new RegisterObject();

            $("#txb-email").change(function (){
                registerObj.setEmail($(this).val());
            });
            $("#txb-password").change(function (){
                registerObj.setPassword($(this).val());
            });
            $("#txb-re-password").change(function (){
                registerObj.setRePassword($(this).val());
            });
            $("#btn-register").click(function () {
                registerObj.register()
            });
        });
        function initial(){
            var token = localStorage.getItem('token');
            if(token){
                window.location.href = '/';
            }
            var data_login_gg = $('#registerObj').attr('data-login-google');
            if(data_login_gg){
                data_login_gg = JSON.parse(data_login_gg);
                localStorage.setItem('token',data_login_gg['token']);
                localStorage.setItem('user',JSON.stringify(data_login_gg['user']));
                window.location.href = '/';
            }
        }
    </script>
@endsection
