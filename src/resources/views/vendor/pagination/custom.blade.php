@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <a class="btn btn-icon email-pagination-prev d-none d-sm-block disabled">
            <i class="bx bx-chevron-left"></i>
        </a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon email-pagination-prev d-none d-sm-block">
            <i class="bx bx-chevron-left"></i>
        </a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon email-pagination-next d-none d-sm-block">
            <i class="bx bx-chevron-right"></i>
        </a>
    @else
        <a class="btn btn-icon email-pagination-next d-none d-sm-block disabled">
            <i class="bx bx-chevron-right"></i>
        </a>
    @endif

{{--    <nav aria-label="Page navigation example">--}}
{{--        <ul class="pagination justify-content-center">--}}
{{--            @if ($paginator->onFirstPage())--}}
{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link" href="#" tabindex="-1">Previous</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>--}}
{{--            @endif--}}

{{--            @foreach ($elements as $element)--}}
{{--                @if (is_string($element))--}}
{{--                    <li class="page-item disabled">{{ $element }}</li>--}}
{{--                @endif--}}

{{--                @if (is_array($element))--}}
{{--                    @foreach ($element as $page => $url)--}}
{{--                        @if ($page == $paginator->currentPage())--}}
{{--                            <li class="page-item active">--}}
{{--                                <a class="page-link">{{ $page }}</a>--}}
{{--                            </li>--}}
{{--                        @else--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            @endforeach--}}

{{--            @if ($paginator->hasMorePages())--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link" href="#">Next</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        </ul>--}}
@endif