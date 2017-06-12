@if ($paginator->hasPages())
    <nav class="pagination">
      <ul class="pagination-list">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li>
            <a class="pagination-link" disabled><span>&laquo;</span></a>
          </li>
        @else
            <li>
              <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                  <a class="pagination-link" disabled><span>{{ $element }}</span></a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                          <a class="pagination-link is-current"><span>{{ $page }}</span></a>
                        </li>
                    @else
                        <li>
                          <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
              <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            </li>
        @else
            <li>
              <a class="pagination-link" disabled><span>&raquo;</span></a>
            </li>
        @endif
      </ul>
    </nav>
@endif
