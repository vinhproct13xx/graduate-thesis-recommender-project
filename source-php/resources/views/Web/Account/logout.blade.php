@extends('Web.Layouts.app')
@section('content')
    <div id = "logout"
    api-logout="{{route('api.account.logout')}}"></div>
@endsection
@section('script')
    <script>
        var logOut = new objectLogout('#logout');

        function objectLogout(element) {
            var timeout = null;
            this.vm = new Vue({
                el: element,
                data: {
                    loading: false,
                    api_logout: $(element).attr('api-logout'),
                },
                methods: {
                    logout: function () {
                        var vm = this;
                        vm.loading = true;
                        if (!localStorage.getItem("token") || !localStorage.getItem("user")) {
                            window.location = '/login';
                        }
                        var token = 'Bearer ' + localStorage.getItem('token').replace(/['"]+/g, '');
                        this.token = token;
                        var config = {
                            headers: {
                                Authorization: this.token,
                                'Content-Type': 'application/json;charset=UTF-8',
                            }
                        };
                        axios.get(vm.api_logout, config).then(function (response) {
                            vm.loading = false;
                            var data = response.data;
                            localStorage.removeItem('user');
                            localStorage.removeItem('token');

                            window.location = '/login';
                        })

                    },
                },

                created: function () {
                    if (!localStorage.getItem("token")) {
                        window.location = '/login';
                    }
                    this.logout();
                },
                watch: {}
            });
            return this;
        }

    </script>
@endsection
