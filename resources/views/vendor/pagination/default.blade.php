<ul class="pagination justify-content-center justify-content-md-start">
    @if ($paginator->currentPage() > 1)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <em class="icon ni ni-chevrons-left"></em>
            </a>
        </li>
    @endif
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item{{ ($i == $paginator->currentPage()) ? ' active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>

    @endfor
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <em class="icon ni ni-chevrons-right"></em>
            </a>
        </li>
    @endif
</ul>