@extends('Web.Layout.app')
@section('content')
    <div class="row" style="margin-left: 15px; margin-top: 20px" id="searchObj" style="margin: 0px 0px 10px">
        @if(!empty($res_list))
            @foreach($res_list as $res)
                <div class="saved-res">
                    <section>
                        <div class="card booking-card" style="max-width: 22rem;">
                            <div class="view overlay"><img src="{{$res['PhotoUrl']}}" alt="Card image cap" class="card-img-top"> <a href="/res-detail/{{$res['Id']}}">
                                    <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                </a></div>
                            <div class="card-body"><h4 class="card-title font-weight-bold"><a href="/res-detail/174482">{{$res['name_summary']}}</a>
                                    <p class="mt-10"><i class="mr-10 fas fa-clock"></i><span>&nbsp;{{isset($res['restaurant_detail']['open_time']) ? $res['restaurant_detail']['open_time'] : 'Không có dữ liệu'}}</span></p>
                                </h4>
                                <a class="mb-2"><i class="fas fa-map-marker-alt"></i>&nbsp;{{$res['address_summary']}}</a>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </section>
                </div>
            @endforeach
        @endif

    </div>
    <div style="text-align: center">{{$res_list->links('Web.Pagination.comment-pagination')}}
    </div>
@endsection
