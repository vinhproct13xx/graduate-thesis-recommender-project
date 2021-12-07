@if ($paginator->lastPage() > 1)
    <div class="my-pagination">
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->url(1) }}">&laquo;</a>
            {{--         <a class="content-pagination-left" href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="fas fa-chevron-left"></i></a>--}}
        @endif
        @if (($paginator->currentPage() - 1) > 0)
            <a href="{{ $paginator->url($paginator->currentPage() - 1) }}">{{$paginator->currentPage() - 1}}</a>
            {{--         <a class="content-pagination-left" href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="fas fa-chevron-left"></i></a>--}}
        @endif
        <a class="active">{{$paginator->currentPage()}}</a>
        {{--         <span>Trang {{$paginator->currentPage()}}</span>--}}
        @if (($paginator->currentPage() + 1) < $paginator->lastPage())
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}">{{$paginator->currentPage() + 1}}</a>
            {{--         <a class="content-pagination-left" href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="fas fa-chevron-left"></i></a>--}}
        @endif
        @if (!($paginator->currentPage() == $paginator->lastPage()))
            <a href="{{$paginator->url($paginator->lastPage())}}">&raquo;</a>
            {{--         <a class="content-pagination-right" href="{{$paginator->url($paginator->currentPage()+1)}}"><i class="fas fa-chevron-right"></i></a>--}}
        @endif
    </div>
@endif
