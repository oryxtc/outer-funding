@if ($paginator->hasPages())
    <ul class="pagination">
        <li><a href="{{$paginator->url(1)}}" rel="first">&nbsp;首页&nbsp;</a></li>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&nbsp;上一页&nbsp;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&nbsp;上一页&nbsp;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&nbsp;下一页&nbsp;</a></li>
        @else
            <li class="disabled"><span>&nbsp;下一页&nbsp;</span></li>
        @endif
        <li><a href="{{$paginator->url($paginator->lastPage())}}" rel="last">&nbsp;尾页&nbsp;</a></li>
    </ul>
@endif

<style type="text/css">
    .pagination  li{
        float: left;
    }
</style>