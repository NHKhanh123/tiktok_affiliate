@extends('admin.layouts.app')

@section('title', 'Affiliate Orders')

@section('page-title', 'Affiliate Orders')

@section('content')

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="page-header">

        <div>
            <h1>Affiliate Orders</h1>

            <p>
                Quản lý và theo dõi lịch sử đơn hàng từ TikTok Shop.
            </p>
        </div>

    </div>


    {{-- =====================================================
        THÔNG BÁO
    ====================================================== --}}

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


    {{-- =====================================================
        THỐNG KÊ
    ====================================================== --}}

    <div class="stats">

        {{-- Tổng đơn hàng --}}
        <div class="card">

            <div class="card-title">
                Tổng đơn hàng
            </div>

            <div class="card-value">
                {{ number_format($totalOrders) }}
            </div>

            <div class="card-description">
                Tất cả đơn hàng
            </div>

        </div>


        {{-- Đơn hoàn tất --}}
        <div class="card">

            <div class="card-title">
                Đơn hoàn tất
            </div>

            <div class="card-value">
                {{ number_format($completedOrders) }}
            </div>

            <div class="card-description">
                Đơn hàng đã hoàn tất
            </div>

        </div>


        {{-- Doanh số --}}
        <div class="card">

            <div class="card-title">
                Doanh số
            </div>

            <div class="card-value money">
                {{ number_format($totalRevenue, 0, ',', '.') }}đ
            </div>

            <div class="card-description">
                Doanh số đơn hoàn tất
            </div>

        </div>

    </div>


    {{-- =====================================================
        LỊCH SỬ ĐƠN HÀNG
    ====================================================== --}}

    <div class="section">

        <div class="card">

            <div class="section-header">

                <div>
                    <h2>
                        Lịch sử đơn hàng
                    </h2>

                    <p class="section-description">
                        Danh sách đơn hàng được đồng bộ từ TikTok Shop.
                    </p>
                </div>

            </div>


            {{-- =================================================
                TABLE
            ================================================== --}}

            <div class="table-wrapper">

                <table class="data-table">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>TikTok Order</th>

                            <th>Sản phẩm</th>

                            <th>Affiliate Link</th>

                            <th>Click</th>

                            <th>Tiền hàng</th>

                            <th>Hoàn tiền</th>

                            <th>Commission</th>

                            <th>Trạng thái</th>

                            <th>Ngày đặt</th>

                            <th>Thao tác</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($orders as $order)

                            <tr>

                                {{-- =================================
                                    ID
                                ================================== --}}

                                <td>

                                    <strong>
                                        #{{ $orders->firstItem() + $loop->index }}
                                    </strong>

                                </td>


                                {{-- =================================
                                    TIKTOK ORDER
                                ================================== --}}

                                <td>

                                    @if ($order->tiktok_order_id)
                                        <span class="order-id">
                                            {{ $order->tiktok_order_id }}
                                        </span>
                                    @else
                                        <span class="muted">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    PRODUCT
                                ================================== --}}

                                <td>

                                    @if ($order->product)
                                        <div class="product-name">

                                            {{ $order->product->name }}

                                        </div>

                                        <small>
                                            Product #{{ $order->product_id }}
                                        </small>
                                    @elseif ($order->tiktok_product_id)
                                        <div class="product-name">
                                            Sản phẩm TikTok
                                        </div>

                                        <small>
                                            TikTok Product:
                                            {{ $order->tiktok_product_id }}
                                        </small>
                                    @else
                                        <span class="muted">
                                            Không xác định
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    AFFILIATE LINK
                                ================================== --}}

                                <td>

                                    @if ($order->affiliateLink)
                                        <div class="affiliate-name">

                                            {{ $order->affiliateLink->name }}

                                        </div>

                                        <small>
                                            Link #{{ $order->affiliateLink->id }}
                                        </small>
                                    @else
                                        <span class="muted">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    CLICK
                                ================================== --}}

                                <td>

                                    @if ($order->affiliateClick)
                                        <span class="click-badge">

                                            #{{ $order->affiliateClick->id }}

                                        </span>
                                    @elseif ($order->affiliate_click_id)
                                        <span class="click-badge">

                                            #{{ $order->affiliate_click_id }}

                                        </span>
                                    @else
                                        <span class="muted">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    PRODUCT AMOUNT
                                ================================== --}}

                                <td>

                                    <strong class="money">

                                        {{ number_format($order->product_amount ?? 0, 0, ',', '.') }}đ

                                    </strong>

                                </td>


                                {{-- =================================
                                    REFUND
                                ================================== --}}

                                <td>

                                    @if (($order->refund_amount ?? 0) > 0)
                                        <span class="refund">

                                            -{{ number_format($order->refund_amount, 0, ',', '.') }}đ

                                        </span>
                                    @else
                                        <span class="muted">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    COMMISSION
                                ================================== --}}

                                <td>

                                    @if ($order->commission)
                                        <span class="commission-badge">

                                            {{ number_format($order->commission->commission_amount ?? 0, 0, ',', '.') }}đ

                                        </span>

                                        @if ($order->commission->commission_rate !== null)
                                            <small class="commission-rate">

                                                {{ number_format($order->commission->commission_rate, 2) }}%

                                            </small>
                                        @endif
                                    @else
                                        <span class="muted">
                                            Chưa có
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    STATUS
                                ================================== --}}

                                <td>

                                    @switch($order->status)
                                        @case('completed')
                                            <span class="badge badge-success">
                                                Hoàn tất
                                            </span>
                                        @break

                                        @case('processing')
                                            <span class="badge badge-warning">
                                                Đang xử lý
                                            </span>
                                        @break

                                        @case('pending')
                                            <span class="badge badge-info">
                                                Chờ xử lý
                                            </span>
                                        @break

                                        @case('cancelled')
                                            <span class="badge badge-danger">
                                                Đã hủy
                                            </span>
                                        @break

                                        @case('refunded')
                                            <span class="badge badge-danger">
                                                Đã hoàn tiền
                                            </span>
                                        @break

                                        @default
                                            <span class="badge badge-secondary">
                                                {{ $order->status ?? 'Không xác định' }}
                                            </span>
                                    @endswitch

                                </td>


                                {{-- =================================
                                    ORDERED AT
                                ================================== --}}

                                <td>

                                    @if ($order->ordered_at)
                                        <div class="date">

                                            {{ $order->ordered_at->format('d/m/Y') }}

                                        </div>

                                        <small class="time">

                                            {{ $order->ordered_at->format('H:i') }}

                                        </small>
                                    @else
                                        <span class="muted">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- =================================
                                    ACTION
                                ================================== --}}

                                <td>

                                    <div class="action-buttons">

                                        <a href="{{ route('admin.affiliate-orders.show', $order) }}"
                                            class="btn btn-secondary">
                                            Xem
                                        </a>

                                    </div>

                                </td>

                            </tr>


                            @empty

                                <tr>

                                    <td colspan="11" class="empty-state">

                                        <div class="empty-icon">
                                            📦
                                        </div>

                                        <strong>
                                            Chưa có đơn hàng
                                        </strong>

                                        <p>
                                            Hệ thống chưa ghi nhận đơn hàng Affiliate nào.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                PAGINATION
            ================================================== --}}

                @include('layouts.pagination', ['paginator' => $orders])

            </div>

        </div>


        {{-- =====================================================
        CSS
    ====================================================== --}}

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


            /* =========================
                   STATS
                ========================== */

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
                font-weight: 500;
            }


            .card-value {
                margin-top: 8px;
                font-size: 26px;
                font-weight: 700;
            }


            .card-description {
                margin-top: 5px;
                color: #9ca3af;
                font-size: 12px;
            }


            .money {
                font-weight: 700;
            }


            /* =========================
                   SECTION
                ========================== */

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


            /* =========================
                   TABLE
                ========================== */

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
                font-weight: 600;
                white-space: nowrap;
            }


            .data-table tbody tr:hover {
                background: #fafafa;
            }


            .data-table small {
                color: #6b7280;
                font-size: 12px;
            }


            /* =========================
                   ORDER
                ========================== */

            .order-id {
                font-family: monospace;
                font-weight: 600;
                white-space: nowrap;
            }


            /* =========================
                   PRODUCT
                ========================== */

            .product-name {
                font-weight: 600;
                margin-bottom: 4px;
                min-width: 150px;
            }


            .affiliate-name {
                font-weight: 500;
                margin-bottom: 4px;
                min-width: 120px;
            }


            /* =========================
                   CLICK
                ========================== */

            .click-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 6px;
                background: #eff6ff;
                color: #2563eb;
                font-size: 13px;
                font-weight: 600;
            }


            /* =========================
                   COMMISSION
                ========================== */

            .commission-badge {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                background: #fef3c7;
                color: #92400e;
                font-weight: 600;
                font-size: 13px;
                white-space: nowrap;
            }


            .commission-rate {
                display: block;
                margin-top: 4px;
                color: #9ca3af !important;
            }


            /* =========================
                   REFUND
                ========================== */

            .refund {
                color: #dc2626;
                font-weight: 600;
                white-space: nowrap;
            }


            /* =========================
                   STATUS
                ========================== */

            .badge {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                white-space: nowrap;
            }


            .badge-success {
                background: #dcfce7;
                color: #166534;
            }


            .badge-warning {
                background: #fef3c7;
                color: #92400e;
            }


            .badge-info {
                background: #dbeafe;
                color: #1d4ed8;
            }


            .badge-danger {
                background: #fee2e2;
                color: #991b1b;
            }


            .badge-secondary {
                background: #e5e7eb;
                color: #374151;
            }


            .muted {
                color: #9ca3af;
            }


            /* =========================
                   DATE
                ========================== */

            .date {
                font-weight: 500;
                white-space: nowrap;
            }


            .time {
                color: #9ca3af;
            }


            /* =========================
                   BUTTON
                ========================== */

            .action-buttons {
                display: flex;
                gap: 6px;
                flex-wrap: wrap;
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


            .btn-secondary {
                background: #6b7280;
                color: #fff;
            }


            .btn-secondary:hover {
                background: #4b5563;
            }


            /* =========================
                   ALERT
                ========================== */

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


            /* =========================
                   EMPTY
                ========================== */

            .empty-state {
                text-align: center !important;
                padding: 50px !important;
                color: #6b7280;
            }


            .empty-state p {
                margin: 6px 0 0;
                font-size: 13px;
                color: #9ca3af;
            }


            .empty-icon {
                font-size: 32px;
                margin-bottom: 10px;
            }


            .pagination-wrapper {
                margin-top: 20px;
            }


            /* =========================
                   RESPONSIVE
                ========================== */

            @media (max-width: 1200px) {

                .table-wrapper {
                    overflow-x: auto;
                }

                .data-table {
                    min-width: 1400px;
                }

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
