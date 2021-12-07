@extends('Web.Layouts.app')
@section('content')
    <div class="wrap" id="reset-password" class="mb-5 login" api-reset-password="{{route('api.account.reset_password')}}" token="{{$token}}">
        <div class="register">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100 register-img images" data-src="../assets/images/profile/quen-mat-khau.png" alt="">
                    </div>
                    <div class="col-md-6">
                        <h3 class="register-title">QUÊN MẬT KHẨU</h3>
                        <form>
                            <div class="form-group">
                                <label class="register-label" for="email">Tạo lại mật khẩu mới</label>
                                <input v-validate="'required|min:6'" data-vv-as="Mật khẩu mới" name="password"
                                       v-model="data_create.password" type="password" class="form-control register-input" id="email" placeholder="Nhập mật khẩu mới của bạn">
                                <div v-cloak v-show="errors.has('password')" class="error">
                                    <i class="fas fa-exclamation-circle error-icon"></i>
                                    <span class="error-text">@{{ errors.first('password') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="register-label" for="email">Nhập lại mật khẩu mới</label>
                                <input data-vv-as="Nhập lại mật khẩu mới"  v-validate="'required|min:6|confirmed:password'" name="password_confirm"
                                       type="password" class="form-control register-input" id="email" placeholder="Nhập lại mật khẩu mới của bạn">
                                <div v-cloak v-show="errors.has('password_confirm')" class="error">
                                    <i class="fas fa-exclamation-circle error-icon"></i>
                                    <span class="error-text">@{{ errors.first('password_confirm') }}</span>
                                </div>
                            </div>
                            <button v-show="!loading" @click.stop.prevent="resetPassword()" type="submit" class="button button-register">GỬI</button>
                            <button v-show="loading" type="submit" class="button button-register"><i class="fas fa-spinner fa-spin mr-3"></i>GỬI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var resetPassword = new objectResetPassword('#reset-password');
        function objectResetPassword(element) {
            var timeout = null;
            Vue.use(VeeValidate, {
                locale: 'vi',
                fieldsBagName: 'vvFields'
            });
            this.vm = new Vue({
                el:element,
                data:{
                    loading: false,
                    api_reset_password: $(element).attr('api-reset-password'),
                    data_create: {
                        token: $(element).attr('token'),
                        email:''
                    },
                },
                methods:{
                    resetPassword: function(){
                        var vm = this;
                        vm.loading = true;
                        this.$validator.validate().then(valid => {
                            if(valid) {
                                axios.put(vm.api_reset_password, vm.data_create).then(function (response) {
                                    vm.loading = false;
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        window.location='/forget-password'
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    timeout = setTimeout(function () {
                                        window.location = '/login'
                                    }, 800)
                                })
                            }else{
                                vm.loading = false;
                            }
                        })
                    },
                },

                created: function () {

                },
                watch:{

                }
            });
            return this;
        }

    </script>
@endsection
