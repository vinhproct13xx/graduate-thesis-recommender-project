@extends('Web.Layouts.app')
@section('content')
    <div class="padding-top"></div>
    <section class="blog">
        <div class="container">
            <h1 class=""><a class="blog-link" href="javascript:void(0)">TÀI KHOẢN</a></h1>
        </div>
    </section>
    <div class="wrap" id="profile-contents" api-update="{{route('api.account.update')}}"
         api-upgrade="{{route('api.package_used.update')}}"
         api-get-products="{{route('api.product.get_list')}}" products="{{json_encode($products)}}"
         api-get-package-used="{{route('api.package_used.get')}}">
        <section class="account">
            <div class="container">
                <div class="account-info">
                    <div class="avatar-wrapper upload-profile-button">
                        <img class="profile-pic avatar" :src="user.avatar.url != '' ? user.avatar.url : '../assets/images/default-thumbnail.png'" />
                        <input ref="file" class="file-upload" type="file" accept="image/*" />
                    </div>
                    <!-- <img class="account-img images"
                         :src="user.avatar.url != ''? user.avatar.url : '../assets/images/avatar.jpg'" alt="avatar"> -->
                    <span v-cloak class="account-name">@{{ data_create.name }}</span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <input v-model="data_create.name" type="text" class="form-control account-input"
                                       placeholder="Họ Tên">
                                <i class="fas fa-user-circle account-icon"></i>
                            </div>
                            <div class="form-group">
                                <input v-model="data_create.phone" type="phone" class="form-control account-input"
                                       placeholder="0123.456.789">
                                <i class="fas fa-phone-alt account-icon"></i>
                            </div>
                            {{--                            <div class="form-group account-custom">--}}
                            {{--                                <input type="password" class="form-control account-input" placeholder="******">--}}
                            {{--                                <i class="fas fa-lock account-icon"></i>--}}
                            {{--                            </div>--}}

                            <button type="submit" v-if="!loading" @click.stop.prevent="updateProfile()"
                                    class="button button-account">Thay đổi
                            </button>
                            <button type="submit" v-if="loading" class="button button-account"><i
                                    class="fas fa-spinner fa-spin"></i>Thay đổi
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6  account-package">
                        <div class="account-upgrade ">
                            <template v-if="package_used!=null">
                                <span class="account-upgrade-text ">Gói sử dụng</span>
                                <h5 class="account-upgrade-title ">@{{ package_used.product ? package_used.product.name : '' }}</h5>
                                <span class="account-upgrade-text ">Ngày hết hạn: @{{package_used.expire | dd-mm-yyyy }}</span>
                            </template>
                            <button class="button button-account mt-5 mb-3" data-toggle="modal" data-target="#upGrade">Nâng
                                cấp gói
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade modal-group" id="upGrade" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close modal-header-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-add-title">Nâng cấp gói </h3>
                        <div class="card modal-card">
                            <div class="card-body" v-for="item in products">
                                <label class="modal-card-title">
                                    <input  v-validate="'required'" data-vv-as="Gói" name="package" v-model="product_to_upgrade"
                                           :value="item" type="radio" name="upgrade"
                                           class=" modal-card-radio"/>
                                    Gói @{{item.number_account}} tài khoản - @{{item.price/1000}}
                                    k/@{{item.expire}} tháng<i class="fas fa-angle-down"></i>
                                </label>
                                <!-- <a class="modal-card-title" href="">Gói 1 tài khoản - 30k/1 tháng<i class="fas fa-angle-down"></i></a> -->
                                <ul class="modal-card-list">
{{--                                    <li>--}}
{{--                                        <div class="form-group mt-3 mb-0">--}}
{{--                                            <select class="form-control disc-item-mon" id="exampleFormControlSelect1">--}}
{{--                                                <option value="1">1 Tháng</option>--}}
{{--                                                <option value="3">3 Tháng</option>--}}
{{--                                                <option value="6">6 Tháng</option>--}}
{{--                                                <option value="12">12 Tháng</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                    <li class="modal-card-item">Tư vấn sử dụng</li>
                                    <li class="modal-card-item">Đấy đủ tính năng</li>
                                    <li class="modal-card-item">Cập nhật miễn phí</li>
                                    <li class="disc-item">Bảo Hành Trọng Gói</li>
{{--                                    <li class="modal-card-item">Hoàn tiền trong vòng 7 ngày hoặc đổi phần mềm có giá trị--}}
{{--                                        tương đương.--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" @click="redirect()" class="button button-discount"
                                data-dismiss="modal">NÂNG CẤP GÓI
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js "></script>
    <script>
        var profile = new objectProfile('#profile-contents');

        function objectProfile(element) {
            var timeout = null;
            Vue.use(VeeValidate, {
                locale: 'vi',
                fieldsBagName: 'vvFields'
            });
            this.vm = new Vue({
                el: element,
                data: {
                    loading: false,
                    api_update: $(element).attr('api-update'),
                    api_get_products: $(element).attr('api-get-products'),
                    api_upgrade: $(element).attr('api-upgrade'),
                    api_get_package_used: $(element).attr('api-get-package-used'),
                    token: '',
                    products: JSON.parse($(element).attr('products')),
                    package_used: '',
                    product_to_upgrade: '',
                    user: {},
                    data_create: {
                        name: '',
                        phone: '',
                    },
                },
                methods: {
                    updateProfile: function () {
                        var vm = this;
                        vm.loading = true;
                        var config = {
                            headers: {
                                Authorization: this.token,
                                'Content-Type': 'application/json;charset=UTF-8',
                            }
                        };
                        let form_data = new FormData();
                        for (let key in this.data_create) {
                            form_data.append(key, this.data_create[key]);
                        }
                        form_data.set('avatar', this.$refs.file.files[0]);
                        axios.post(vm.api_update, form_data, config).then(function (response) {
                            vm.loading = false;
                            var data = response.data;
                            if(data.error){
                                helper.showNotification(data.message,'danger');
                                return;
                            }
                            localStorage.setItem("user", JSON.stringify(data.data.customer));
                            helper.showNotification("Cập nhật thành công", 'success');
                            if (data.data.customer.name != '') {
                                $('#username-menu-top').html(data.data.customer.name);
                            }

                            var avatarElms= document.getElementsByClassName("avatar");

                            for(var key in avatarElms){
                                avatarElms[key].src=data.data.customer.avatar ? data.data.customer.avatar.url : "";
                            }

                            // vm.data_create.avatar = data.data.customer.avatar ? data.data.customer.avatar.url : "";

                        }).catch(function (error) {
                            if (error.response) {
                                vm.loading = false;
                                helper.showNotification(error.response.data.message, 'danger');
                                timer = setTimeout(function () {
                                    localStorage.removeItem('user');
                                    localStorage.removeItem('token');
                                    window.location = '/login';
                                }, 500)
                            }
                        })
                    },

                    getPackageUsed: function () {
                        var vm = this;
                        var config = {
                            headers: {
                                Authorization: this.token,
                                'Content-Type': 'application/json;charset=UTF-8',
                            },
                            params:
                                {
                                    customer_id: vm.user._id
                                }
                        };
                        axios.get(vm.api_get_package_used, config).then(function (response) {
                            var data = response.data;

                            if (data.error) {
                                helper.showNotification(data.message);
                            }
                            vm.package_used = data.data.package_used;
                        })
                    },

                     redirect:function () {
                         this.$validator.validate().then(valid => {
                             if (valid) {
                                 window.location = '/payment-info/' + this.product_to_upgrade._id;
                             }else{
                                 helper.showNotification('Vui lòng chọn gói !','danger')
                             }
                         });
                     }
                },
                created: function () {
                    if (!localStorage.getItem("token") || !localStorage.getItem("user")) {
                        window.location = '/login';
                    }
                    this.user = JSON.parse(localStorage.getItem("user"));
                    var token = 'Bearer ' + localStorage.getItem('token').replace(/['"]+/g, '');
                    this.token = token;
                    this.data_create.name = this.user.name ?? "";
                    this.data_create.phone = this.user.phone ?? "";
                    this.getPackageUsed();
                },
                watch: {}
            });
            return this;
        }

        $(document).ready(function () {

            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function () {
                readURL(this);
            });

            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });
        });

    </script>
@endsection

