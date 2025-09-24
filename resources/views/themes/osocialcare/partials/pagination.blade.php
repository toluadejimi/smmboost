<nav id="pagination">
    @if ($paginator->hasPages())
        <ul class="pagination flex items-center justify-center flex-wrap gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <span class="page-link px-3 py-1 text-sm text-gray-500 bg-gray-800 rounded cursor-not-allowed">
                        &larr;
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="page-link px-3 py-1 text-sm text-gray-300 bg-gray-700 hover:bg-gray-600 rounded transition">
                        &larr;
                    </a>
                </li>
            @endif

            {{-- First Page --}}
            <li class="page-item {{ $paginator->currentPage() == 1 ? 'active' : '' }}">
                <a href="{{ $paginator->url(1) }}"
                   class="page-link px-3 py-1 text-sm {{ $paginator->currentPage() == 1 ? 'bg-orange-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} rounded transition">
                    1
                </a>
            </li>

            {{-- Ellipsis Before --}}
            @if ($paginator->currentPage() > 4)
                <li class="page-item">
                    <span class="page-link px-3 py-1 text-sm text-gray-400 bg-gray-800 rounded">...</span>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach (range(max(2, $paginator->currentPage() - 3), min($paginator->lastPage() - 1, $paginator->currentPage() + 3)) as $page)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="{{ $paginator->url($page) }}"
                       class="page-link px-3 py-1 text-sm {{ $page == $paginator->currentPage() ? 'bg-orange-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} rounded transition">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            {{-- Ellipsis After --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="page-item">
                    <span class="page-link px-3 py-1 text-sm text-gray-400 bg-gray-800 rounded">...</span>
                </li>
            @endif

            {{-- Last Page --}}
            @if ($paginator->lastPage() > 1)
                <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'active' : '' }}">
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                       class="page-link px-3 py-1 text-sm {{ $paginator->currentPage() == $paginator->lastPage() ? 'bg-orange-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} rounded transition">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="page-link px-3 py-1 text-sm text-gray-300 bg-gray-700 hover:bg-gray-600 rounded transition">
                        &rarr;
                    </a>
                </li>
            @else
                <li class="page-item">
                    <span class="page-link px-3 py-1 text-sm text-gray-500 bg-gray-800 rounded cursor-not-allowed">
                        &rarr;
                    </span>
                </li>
            @endif
        </ul>
    @endif
</nav>
