@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('page-title', 'Chi tiết đơn hàng')

@push('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 15px;
    }

    .page-header-left h2 {
        margin: 0 0 5px;
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-header-left p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 15px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #fff;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: .2s;
    }

    .btn-back:hover {
        background: #f9fafb;
        color: #111827;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }

    .card-body {
        padding: 20px;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .info-row {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #6b7280;
        font-size: 14px;
    }

    .info-value {
        color: #111827;
        font-size: 14px;
        font-weight: 500;
        word-break: break-word;
    }

    .text-muted {
        color: #9ca3af;
        font-weight: 400;
    }

    .text-right {
        text-align: right;
    }

    .money {
        font-weight: 700;
        color: #111827;
    }

    .money-green {
        font-weight: 700;
        color: #059669;
    }

    .money-red {
        font-weight: 700;
        color: #dc2626;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-info {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-secondary {
        background: #f3f4f6;
        color: #4b5563;
    }

    .product-box {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-image {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #f3f4f6;
    }

    .product-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 24px;
    }

    .product-name {
        font-weight: 600;
        color: #111827;
        margin-bottom: 5px;
    }

    .product-id {
        color: #6b7280;
        font-size: 13px;
    }

    .finance-table {
        width: 100%;
        border-collapse: collapse;
    }

    .finance-table tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .finance-table tr:last-child {
        border-bottom: none;
    }

    .finance-table td {
        padding: 12px 0;
        font-size: 14px;
    }

    .finance-table td:first-child {
        color: #6b7280;
    }

    .finance-total td {
        padding-top: 16px;
        font-size: 16px;
        font-weight: 700;
    }

    .commission-box {
        padding: 16px;
        border-radius: 8px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .commission-amount {
        font-size: 24px;
        font-weight: 700;
        color: #15803d;
        margin-top: 5px;
    }

    .timeline {
        position: relative;
        margin-top: 5px;
    }

    .timeline-item {
        position: relative;
        display: flex;
        gap: 15px;
        padding-bottom: 22px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-line {
        position: absolute;
        left: 8px;
        top: 18px;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item:last-child .timeline-line {
        display: none;
    }

    .timeline-dot {
        position: relative;
        z-index: 2;
        width: 18px;
        height: 18px;
        flex: 0 0 18px;
        border-radius: 50%;
        background: #d1d5db;
        border: 3px solid #fff;
        box-shadow: 0 0 0 1px #d1d5db;
    }

    .timeline-dot.active {
        background: #16a34a;
        box-shadow: 0 0 0 1px #16a34a;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .timeline-date {
        margin-top: 3px;
        color: #6b7280;
        font-size: 13px;
    }

    .raw-data {
        background: #111827;
        color: #e5e7eb;
        border-radius: 8px;
        padding: 16px;
        overflow-x: auto;
        font-size: 13px;
        line-height: 1.6;
        max-height: 450px;
        overflow-y: auto;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .empty-state {
        color: #9ca3af;
        font-size: 14px;
        padding: 10px 0;
    }

    .section-full {
        grid-column: 1 / -1;
    }

    .status-current {
        margin-left: 8px;
    }

    @media (max-width: 900px) {
        .grid {
            grid-template-columns: 1fr;
        }

        .section-full {
            grid-column: auto;
        }
    }

    @media (max-width: 600px) {
        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .info-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }
    }
</style>
@endpush


@section('content')

@php
    $statusLabels = [
        'pending' => 'Đang xử lý',
        'processing' => 'Đang xử lý',
        'paid' => 'Đã thanh toán',
        'completed' => 'Hoàn tất',
        'cancelled' => 'Đã hủy',
        'refunded' => 'Đã hoàn tiền',
        'failed' => 'Thất bại',
    ];

    $statusClasses = [
        'pending' => 'badge-warning',
        'processing' => 'badge-warning',
        'paid' => 'badge-info',
        'completed' => 'badge-success',
        'cancelled' => 'badge-danger',
        'refunded' => 'badge-danger',
        'failed' => 'badge-danger',
    ];

    $statusLabel = $statusLabels[$affiliateOrder->status]
        ?? ucfirst($affiliateOrder->status ?? 'Không xác định');

    $statusClass = $statusClasses[$affiliateOrder->status]
        ?? 'badge-secondary';

    $netAmount =
        (float) $affiliateOrder->order_amount
        - (float) $affiliateOrder->refund_amount;

    $commission = $affiliateOrder->commission;
@endphp


<div class="page-header">
    <div class="page-header-left">
        <h2>Chi tiết đơn hàng</h2>

        <p>
            Đơn #{{ $affiliateOrder->id }}

            @if($affiliateOrder->tiktok_order_id)
                · TikTok Order:
                {{ $affiliateOrder->tiktok_order_id }}
            @endif
        </p>
    </div>

    <a
        href="{{ route('admin.affiliate-orders.index') }}"
        class="btn-back"
    >
        ← Quay lại danh sách
    </a>
</div>


<div class="grid">

    {{-- =========================
        THÔNG TIN ĐƠN TIKTOK
    ========================== --}}
    <div class="card">
        <div class="card-header">
            <h3>Thông tin đơn TikTok</h3>

            <span class="badge {{ $statusClass }}">
                {{ $statusLabel }}
            </span>
        </div>

        <div class="card-body">

            <div class="info-list">

                <div class="info-row">
                    <div class="info-label">
                        ID hệ thống
                    </div>

                    <div class="info-value">
                        #{{ $affiliateOrder->id }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        TikTok Order ID
                    </div>

                    <div class="info-value">
                        {{ $affiliateOrder->tiktok_order_id ?? '—' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        TikTok Product ID
                    </div>

                    <div class="info-value">
                        {{ $affiliateOrder->tiktok_product_id ?? '—' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        TikTok Shop ID
                    </div>

                    <div class="info-value">
                        {{ $affiliateOrder->tiktok_shop_id ?? '—' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        Trạng thái
                    </div>

                    <div class="info-value">
                        <span class="badge {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </div>


    {{-- =========================
        SẢN PHẨM
    ========================== --}}
    <div class="card">

        <div class="card-header">
            <h3>Sản phẩm</h3>
        </div>

        <div class="card-body">

            @if($affiliateOrder->product)

                <div class="product-box">

                    @if(
                        isset($affiliateOrder->product->image)
                        && $affiliateOrder->product->image
                    )

                        <img
                            src="{{ $affiliateOrder->product->image }}"
                            alt="{{ $affiliateOrder->product->name }}"
                            class="product-image"
                        >

                    @else

                        <div class="product-placeholder">
                            📦
                        </div>

                    @endif

                    <div>

                        <div class="product-name">
                            {{ $affiliateOrder->product->name }}
                        </div>

                        <div class="product-id">
                            Product ID:
                            {{ $affiliateOrder->product->id }}
                        </div>

                        @if($affiliateOrder->tiktok_product_id)

                            <div class="product-id">
                                TikTok Product:
                                {{ $affiliateOrder->tiktok_product_id }}
                            </div>

                        @endif

                    </div>

                </div>

            @else

                <div class="empty-state">
                    Không tìm thấy sản phẩm nội bộ.
                </div>

            @endif

        </div>

    </div>


    {{-- =========================
        TÀI CHÍNH
    ========================== --}}
    <div class="card">

        <div class="card-header">
            <h3>Tài chính đơn hàng</h3>
        </div>

        <div class="card-body">

            <table class="finance-table">

                <tr>
                    <td>Giá trị đơn hàng</td>

                    <td class="text-right money">
                        {{ number_format(
                            $affiliateOrder->order_amount,
                            0,
                            ',',
                            '.'
                        ) }} ₫
                    </td>
                </tr>

                <tr>
                    <td>Tiền sản phẩm</td>

                    <td class="text-right">
                        {{ number_format(
                            $affiliateOrder->product_amount,
                            0,
                            ',',
                            '.'
                        ) }} ₫
                    </td>
                </tr>

                <tr>
                    <td>Tiền hoàn</td>

                    <td class="text-right money-red">
                        -
                        {{ number_format(
                            $affiliateOrder->refund_amount,
                            0,
                            ',',
                            '.'
                        ) }} ₫
                    </td>
                </tr>

                <tr class="finance-total">

                    <td>
                        Doanh số sau hoàn
                    </td>

                    <td class="text-right money-green">
                        {{ number_format(
                            $netAmount,
                            0,
                            ',',
                            '.'
                        ) }} ₫
                    </td>

                </tr>

            </table>

        </div>

    </div>


    {{-- =========================
        TRACKING AFFILIATE
    ========================== --}}
    <div class="card">

        <div class="card-header">
            <h3>Tracking Affiliate</h3>
        </div>

        <div class="card-body">

            <div class="info-list">

                <div class="info-row">

                    <div class="info-label">
                        Affiliate Link
                    </div>

                    <div class="info-value">

                        @if($affiliateOrder->affiliateLink)

                            #{{ $affiliateOrder->affiliateLink->id }}

                            @if(
                                isset($affiliateOrder->affiliateLink->code)
                                && $affiliateOrder->affiliateLink->code
                            )
                                <span class="text-muted">
                                    · {{ $affiliateOrder->affiliateLink->code }}
                                </span>
                            @endif

                        @else

                            <span class="text-muted">
                                Không có
                            </span>

                        @endif

                    </div>

                </div>


                <div class="info-row">

                    <div class="info-label">
                        Affiliate Click
                    </div>

                    <div class="info-value">

                        @if($affiliateOrder->affiliateClick)

                            #{{ $affiliateOrder->affiliateClick->id }}

                        @else

                            <span class="text-muted">
                                Không có
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        HOA HỒNG
    ========================== --}}
    <div class="card">

        <div class="card-header">

            <h3>Hoa hồng Affiliate</h3>

            @if($commission)

                <span class="badge badge-success">
                    {{ ucfirst($commission->status ?? 'N/A') }}
                </span>

            @endif

        </div>

        <div class="card-body">

            @if($commission)

                <div class="commission-box">

                    <div class="info-label">
                        Hoa hồng nhận được
                    </div>

                    <div class="commission-amount">

                        {{ number_format(
                            $commission->commission_amount,
                            0,
                            ',',
                            '.'
                        ) }} ₫

                    </div>

                </div>


                <div class="info-list" style="margin-top: 15px;">

                    <div class="info-row">

                        <div class="info-label">
                            Tỷ lệ hoa hồng
                        </div>

                        <div class="info-value">
                            {{ $commission->commission_rate }}%
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            Giá trị tính hoa hồng
                        </div>

                        <div class="info-value">

                            {{ number_format(
                                $commission->order_amount,
                                0,
                                ',',
                                '.'
                            ) }} ₫

                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            Trạng thái
                        </div>

                        <div class="info-value">

                            {{ $commission->status ?? '—' }}

                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            Đã quyết toán
                        </div>

                        <div class="info-value">

                            @if($commission->settled_at)

                                {{ $commission->settled_at->format('d/m/Y H:i') }}

                            @else

                                <span class="text-muted">
                                    Chưa quyết toán
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @else

                <div class="empty-state">
                    Đơn hàng này chưa có dữ liệu hoa hồng.
                </div>

            @endif

        </div>

    </div>


    {{-- =========================
        THỜI GIAN / TIMELINE
    ========================== --}}
    <div class="card">

        <div class="card-header">
            <h3>Lịch sử thời gian</h3>
        </div>

        <div class="card-body">

            <div class="timeline">

                {{-- Ordered --}}
                <div class="timeline-item">

                    <div class="timeline-line"></div>

                    <div class="timeline-dot active"></div>

                    <div class="timeline-content">

                        <div class="timeline-title">
                            Đơn hàng được tạo
                        </div>

                        <div class="timeline-date">

                            @if($affiliateOrder->ordered_at)

                                {{ $affiliateOrder->ordered_at->format('d/m/Y H:i:s') }}

                            @else

                                Chưa có dữ liệu

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Paid --}}
                <div class="timeline-item">

                    <div class="timeline-line"></div>

                    <div class="timeline-dot
                        {{ $affiliateOrder->paid_at ? 'active' : '' }}">
                    </div>

                    <div class="timeline-content">

                        <div class="timeline-title">
                            Đơn hàng đã thanh toán
                        </div>

                        <div class="timeline-date">

                            @if($affiliateOrder->paid_at)

                                {{ $affiliateOrder->paid_at->format('d/m/Y H:i:s') }}

                            @else

                                Chưa thanh toán

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Completed --}}
                <div class="timeline-item">

                    <div class="timeline-line"></div>

                    <div class="timeline-dot
                        {{ $affiliateOrder->completed_at ? 'active' : '' }}">
                    </div>

                    <div class="timeline-content">

                        <div class="timeline-title">
                            Đơn hàng hoàn tất
                        </div>

                        <div class="timeline-date">

                            @if($affiliateOrder->completed_at)

                                {{ $affiliateOrder->completed_at->format('d/m/Y H:i:s') }}

                            @else

                                Chưa hoàn tất

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Current status --}}
                <div class="timeline-item">

                    <div class="timeline-dot active"></div>

                    <div class="timeline-content">

                        <div class="timeline-title">
                            Trạng thái hiện tại
                        </div>

                        <div class="timeline-date">

                            <span class="badge {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        RAW DATA TIKTOK
    ========================== --}}
    <div class="card section-full">

        <div class="card-header">

            <h3>
                Raw Data từ TikTok API
            </h3>

            <span class="badge badge-secondary">
                Debug / API
            </span>

        </div>

        <div class="card-body">

            @if($affiliateOrder->raw_data)

                <pre class="raw-data">{{ json_encode(
                    $affiliateOrder->raw_data,
                    JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_UNICODE |
                    JSON_UNESCAPED_SLASHES
                ) }}</pre>

            @else

                <div class="empty-state">
                    Chưa có raw data từ TikTok API.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection