@if ($paginator->hasPages())

    <style>
        .pagination {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #e5e7eb;
            border-radius: 8px;

            background: #ffffff;
            color: #374151;

            font-size: 14px;
            font-weight: 500;

            text-decoration: none;

            transition: all 0.2s ease;
        }

        .page-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #111827;
        }

        .page-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            font-weight: 600;
        }

        .page-btn.disabled {
            background: #f9fafb;
            color: #d1d5db;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        @media (max-width: 600px) {

            .pagination {
                padding: 15px 10px;
                gap: 4px;
            }

            .page-btn {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }
        }
    </style>


    <div class="pagination">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn disabled">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">
                ‹
            </a>
        @endif


        {{-- Các trang --}}
        @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="page-btn active">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}" class="page-btn">
                    {{ $page }}
                </a>
            @endif
        @endforeach


        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">
                ›
            </a>
        @else
            <span class="page-btn disabled">
                ›
            </span>
        @endif

    </div>

@endif
