@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pm-pagination-nav">
        <p class="pm-pagination-summary">
            Showing
            @if ($paginator->firstItem())
                <strong>{{ $paginator->firstItem() }}</strong>
                to
                <strong>{{ $paginator->lastItem() }}</strong>
            @else
                {{ $paginator->count() }}
            @endif
            of
            <strong>{{ $paginator->total() }}</strong>
            results
        </p>

        <div class="pm-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="pm-page-btn pm-page-btn-disabled" aria-disabled="true">&lsaquo; Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pm-page-btn">&lsaquo; Previous</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pm-page-btn pm-page-btn-disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pm-page-btn pm-page-btn-active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pm-page-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pm-page-btn">Next &rsaquo;</a>
            @else
                <span class="pm-page-btn pm-page-btn-disabled" aria-disabled="true">Next &rsaquo;</span>
            @endif
        </div>
    </nav>
@endif
