@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 12px; border-radius:8px; background:#f5eee7; color:#c9b5a4; font-size:11px; font-weight:600; cursor:not-allowed; border:1px solid #eaded2;">
                ‹ Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 12px; border-radius:8px; background:#fff; color:#6b4d38; font-size:11px; font-weight:600; text-decoration:none; border:1px solid #eaded2; transition:.15s;"
               onmouseover="this.style.background='#f5eee7'"
               onmouseout="this.style.background='#fff'">
                ‹ Prev
            </a>
        @endif


        {{-- Page Numbers --}}
        @foreach ($elements as $element)

            {{-- Three Dots Separator --}}
            @if (is_string($element))
                <span style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 6px; color:#a89a8c; font-size:11px; font-weight:600;">
                    {{ $element }}
                </span>
            @endif


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 6px; border-radius:8px; background:#6b4d38; color:#fff; font-size:11px; font-weight:700; border:1px solid #6b4d38;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 6px; border-radius:8px; background:#fff; color:#6b4d38; font-size:11px; font-weight:600; text-decoration:none; border:1px solid #eaded2; transition:.15s;"
                           onmouseover="this.style.background='#f5eee7'"
                           onmouseout="this.style.background='#fff'">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif

        @endforeach


        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 12px; border-radius:8px; background:#fff; color:#6b4d38; font-size:11px; font-weight:600; text-decoration:none; border:1px solid #eaded2; transition:.15s;"
               onmouseover="this.style.background='#f5eee7'"
               onmouseout="this.style.background='#fff'">
                Next ›
            </a>
        @else
            <span style="display:inline-flex; align-items:center; justify-content:center; min-width:34px; height:34px; padding:0 12px; border-radius:8px; background:#f5eee7; color:#c9b5a4; font-size:11px; font-weight:600; cursor:not-allowed; border:1px solid #eaded2;">
                Next ›
            </span>
        @endif

    </nav>
@endif
