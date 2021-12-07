@extends('Web.Layouts.app')
@section('content')
    <div class="padding-top"></div>
    <section class="blog">
        <div class="container">
            <h1 class=""><a class="blog-link" href="javascript:void(0)">Đổi mật khẩu</a>
            </h1>
        </div>
    </section>
    <div class="wrap" id='change-password' api-change-password="{{route('api.account.change_password')}}"
         api-check-has-password="{{route('api.account.check_has_password')}}">
        <div class="register">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100 register-img images" data-src="../assets/images/profile/quen-mat-khau.png"
                             alt="">
                    </div>
                    <div class="col-md-6">
                        <form>
                            <template v-if="is_has_password">
                                <div class="form-group">
                                    <label class="register-label" for="email">Mật khẩu hiện tại</label>
                                    <input v-validate="'required|min:6'" data-vv-as="Mật khẩu cũ" name="old_password"
                                           v-model="data_create.old_password" type="password"
                                           class="form-control register-input"
                                           placeholder="Nhập mật khẩu hiện tại của bạn">
                                    <div v-cloak v-show="errors.has('old_password')" class="error">
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                        <span class="error-text">@{{ errors.first('old_password') }}</span>
                                    </div>
                                </div>
                            </template>
                            <div class="form-group">
                                <label class="register-label" for="email">Mật khẩu mới</label>
                                <input v-validate="'required|min:6'" data-vv-as="Mật khẩu mới" name="new_password"
                                       v-model="data_create.new_password" type="password"
                                       class="form-control register-input"
                                       placeholder="Nhập mật khẩu mới của bạn">
                                <div v-cloak v-show="errors.has('new_password')" class="error">
                                    <i class="fas fa-exclamation-circle error-icon"></i>
                                    <span class="error-text">@{{ errors.first('new_password') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="register-label" for="email">Nhập lại mật khẩu mới</label>
                                <input data-vv-as="Nhập lại mật khẩu"
                                       v-validate="'required|min:6|confirmed:new_password'" name="password_confirm"
                                       v-model="data_create.confirm_password" type="password"
                                       class="form-control register-input"
                                       placeholder="Nhập lại mật khẩu mới của bạn">
                                <div v-cloak v-show="errors.has('password_confirm')" class="error">
                                    <i class="fas fa-exclamation-circle error-icon"></i>
                                    <span class="error-text">@{{ errors.first('password_confirm') }}</span>
                                </div>
                            </div>
                            <div class="mt-5">

                                <button type="submit" class="button button-cancel">Huỷ</button>
                                <button type="submit" v-if="!loading" @click.stop.prevent="changePassword()"
                                        class="button button-save">Lưu
                                </button>
                                <button type="submit" v-if="loading" class="button button-save"><i
                                        class="fas fa-spinner fa-spin"></i>Lưu
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var change_password = new objectChangePassword('#change-password');

        function objectChangePassword(element) {
            var timeout = null;
            Vue.use(VeeValidate, {
                locale: 'vi',
                fieldsBagName: 'vvFields'
            });
            this.vm = new Vue({
                el: element,
                data: {
                    loading: false,
                    api_change_password: $(element).attr('api-change-password'),
                    api_check_has_password: $(element).attr('api-check-has-password'),
                    token: '',
                    is_has_password: true,
                    data_create: {
                        old_password: '',
                        new_password: '',
                        confirm_password: '',
                    },
                },
                methods: {
                    changePassword: function () {
                        var vm = this;

                        var config = {
                            headers: {
                                Authorization: this.token,
                                'Content-Type': 'application/json;charset=UTF-8',
                            }
                        };
                        vm.loading = true;
                        this.$validator.validate().then(valid => {
                            if (valid) {
                                axios.post(vm.api_change_password, vm.data_create, config).then(function (response) {
                                    var data = response.data;
                                    if (data.error) {
                                        helper.showNotification(data.message, 'danger');
                                        vm.loading = false;
                                        return;
                                    }
                                    helper.showNotification(data.message, 'success');
                                    // localStorage.removeItem('user');
                                    // localStorage.removeItem('token');
                                    if(localStorage.getItem('next_url')){
                                        var next_url = localStorage.getItem('next_url');
                                        localStorage.removeItem('next_url');
                                        window.location= next_url;
                                    }else {
                                        window.location='/';
                                    }

                                }).catch(function (error) {
                                    if (error.response) {
                                        loading = false;
                                        localStorage.removeItem('user');
                                        localStorage.removeItem('token');
                                        helper.showNotification(error.response.data.message, 'danger');
                                        var t = setTimeout(function () {
                                            window.location = '/login'
                                        }, 800)
                                    }
                                })
                            } else {
                                vm.loading = false;
                            }
                        })
                    },

                    checkHasPassword: function ($email) {
                        var vm = this;
                        axios.get(vm.api_check_has_password, {params: {email: $email}}).then(function (response) {
                            var data = response.data;
                            if (data.error) {
                                helper.showNotification(data.message, 'danger');
                                vm.loading = false;
                                return;
                            }
                            vm.is_has_password = data.data;
                        })
                    }
                },

                created: function () {
                    if (!localStorage.getItem("token") || !localStorage.getItem("user")) {
                        window.location = '/';
                    }
                    $user = JSON.parse(localStorage.getItem("user"));
                    this.checkHasPassword($user['email']);

                    var token = 'Bearer ' + localStorage.getItem('token').replace(/['"]+/g, '');
                    this.token = token;
                },
                watch: {}
            });
            return this;
        }

    </script>
@endsection
