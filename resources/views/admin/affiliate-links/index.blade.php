```blade
@extends('admin.layouts.app')

@section('title', 'Affiliate Links')

@section('page-title', 'Affiliate Links')

@section('content')

    <div class="page-header">

        <div>
            <h1>Affiliate Links</h1>

            <p>
                Quản lý các liên kết tiếp thị sản phẩm trên TikTok Shop.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.affiliate-links.create') }}" class="btn btn-primary">
                + Tạo Affiliate Link
            </a>
        </div>

    </div>


    {{-- Thông báo --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- Thống kê --}}

    <div class="stats">

        <div class="card">

            <div class="card-title">
                Tổng Affiliate Link
            </div>

            <div class="card-value">
                {{ number_format($affiliateLinks->total()) }}
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                Đang hoạt động
            </div>

            <div class="card-value">

                {{ number_format($affiliateLinks->where('status', true)->count()) }}

            </div>

        </div>


        <div class="card">

            <div class="card-title">
                Đang tắt
            </div>

            <div class="card-value">

                {{ number_format($affiliateLinks->where('status', false)->count()) }}

            </div>

        </div>

    </div>


    {{-- Danh sách --}}

    <div class="section">

        <div class="card">

            <div class="section-header">

                <div>

                    <h2>
                        Danh sách Affiliate Link
                    </h2>

                    <p class="section-description">
                        Mỗi sản phẩm chỉ có một Affiliate Link.
                    </p>

                </div>

            </div>


            <div class="table-wrapper">

                <table class="data-table">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Sản phẩm</th>

                            <th>Tên Affiliate</th>

                            <th>Commission</th>

                            <th>Affiliate URL</th>

                            <th>Trạng thái</th>

                            <th>Thao tác</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($affiliateLinks as $affiliateLink)
                            <tr>

                                <td>
                                    #{{ $affiliateLinks->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="product-name">

                                        {{ $affiliateLink->product?->name ?? 'Không xác định' }}

                                    </div>


                                    <small>

                                        Product ID:
                                        {{ $affiliateLink->product_id }}

                                    </small>

                                </td>


                                <td>

                                    <strong>
                                        {{ $affiliateLink->name }}
                                    </strong>

                                </td>


                                <td>

                                    <span class="commission-badge">

                                        {{ number_format($affiliateLink->commission_rate, 2) }}%

                                    </span>

                                </td>


                                <td>

                                    <div class="url-wrapper">

                                        {{ \Illuminate\Support\Str::limit($affiliateLink->affiliate_url, 45) }}

                                    </div>

                                </td>


                                <td>

                                    @if ($affiliateLink->status)
                                        <span class="badge badge-success">
                                            Đang hoạt động
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Đang tắt
                                        </span>
                                    @endif

                                </td>


                                <td>

                                    <div class="action-buttons">

                                        <a href="{{ route('admin.affiliate-links.show', $affiliateLink) }}"
                                            class="btn btn-secondary">
                                            Xem
                                        </a>


                                        <a href="{{ route('admin.affiliate-links.edit', $affiliateLink) }}"
                                            class="btn btn-primary">
                                            Sửa
                                        </a>


                                        <form method="POST"
                                            action="{{ route('admin.affiliate-links.destroy', $affiliateLink) }}"
                                            onsubmit="return confirm(
                                        'Bạn có chắc muốn xóa Affiliate Link này?'
                                    );">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Xóa
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="empty-state">
                                    Chưa có Affiliate Link nào.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @include('layouts.pagination', ['paginator' => $affiliateLinks])

        </div>

    </div>


    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 5px;
        }

        .page-header p {
            margin: 0;
            color: #6b7280;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
        }

        .card-value {
            margin-top: 8px;
            font-size: 26px;
            font-weight: 700;
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-header h2 {
            margin: 0 0 5px;
        }

        .section-description {
            margin: 0;
            color: #6b7280;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            text-align: left;
            vertical-align: middle;
        }

        .data-table th {
            font-size: 13px;
            color: #6b7280;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .data-table small {
            color: #6b7280;
        }

        .commission-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #fef3c7;
            color: #92400e;
            font-weight: 600;
            font-size: 13px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .url-wrapper {
            max-width: 220px;
            word-break: break-all;
            color: #6b7280;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .action-buttons form {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 7px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-secondary {
            background: #6b7280;
            color: #fff;
        }

        .btn-danger {
            background: #dc2626;
            color: #fff;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            text-align: center !important;
            padding: 40px !important;
            color: #6b7280;
        }

        .pagination-wrapper {
            margin-top: 20px;
        }

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

        }
    </style>

@endsection
