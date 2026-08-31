@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('page-title', 'Chi tiết sản phẩm')

@push('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 20px;
            color: #111827;
        }

        .page-header p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .header-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 15px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        .layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 22px;
        }

        .card+.card {
            margin-top: 20px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 18px;
        }

        .product-name {
            font-size: 22px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .product-slug {
            color: #9ca3af;
            font-size: 12px;
        }

        .description {
            margin-top: 20px;
            line-height: 1.7;
            font-size: 13px;
            color: #4b5563;
            white-space: pre-line;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 13px;
        }

        .info-label {
            color: #6b7280;
        }

        .info-value {
            color: #111827;
            font-weight: 500;
            text-align: right;
            word-break: break-word;
        }

        .price-main {
            font-size: 20px;
            font-weight: 600;
            color: #dc2626;
        }

        .price-old {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 12px;
        }

        .badge {
            display: inline-flex;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-featured {
            background: #fef3c7;
            color: #92400e;
        }

        .tiktok-box {
            background: #f9fafb;
            border-radius: 8px;
            padding: 15px;
        }

        .tiktok-item {
            margin-bottom: 14px;
        }

        .tiktok-item:last-child {
            margin-bottom: 0;
        }

        .tiktok-label {
            font-size: 11px;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        .tiktok-value {
            font-size: 13px;
            color: #111827;
            word-break: break-all;
        }

        .tiktok-link {
            color: #2563eb;
            text-decoration: none;
        }

        .tiktok-link:hover {
            text-decoration: underline;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .mini-stat {
            background: #f9fafb;
            border-radius: 8px;
            padding: 14px;
        }

        .mini-stat-label {
            font-size: 11px;
            color: #6b7280;
        }

        .mini-stat-value {
            margin-top: 5px;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        @media (max-width: 900px) {

            .layout {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

        }

        @media (max-width: 500px) {

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

        }
    </style>
@endpush

@section('content')

    <div class="page-header">

        <div>

            <h2>
                Chi tiết sản phẩm
            </h2>

            <p>
                Thông tin chi tiết của sản phẩm Affiliate.
            </p>

        </div>


        <div class="header-actions">

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                ← Quay lại
            </a>

            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                Chỉnh sửa
            </a>

        </div>

    </div>

    <div class="layout">

        {{-- CỘT TRÁI --}}

        <div>


            {{-- THÔNG TIN SẢN PHẨM --}}

            <div class="card">

                <div class="card-title">
                    Thông tin sản phẩm
                </div>


                <div class="product-name">

                    {{ $product->name }}

                    @if ($product->featured)
                        <span class="badge badge-featured">
                            Nổi bật
                        </span>
                    @endif

                </div>


                <div class="product-slug">

                    Slug:
                    {{ $product->slug }}

                </div>


                @if ($product->description)
                    <div class="description">

                        {{ $product->description }}

                    </div>
                @else
                    <div
                        style="
                margin-top:20px;
                color:#9ca3af;
                font-size:13px;
            ">
                        Chưa có mô tả sản phẩm.
                    </div>
                @endif

            </div>


            {{-- THÔNG TIN TIKTOK --}}

            <div class="card">

                <div class="card-title">
                    TikTok Shop
                </div>


                <div class="tiktok-box">


                    <div class="tiktok-item">

                        <div class="tiktok-label">
                            TikTok Product ID
                        </div>

                        <div class="tiktok-value">

                            {{ $product->tiktok_product_id ?? 'Chưa có' }}

                        </div>

                    </div>


                    <div class="tiktok-item">

                        <div class="tiktok-label">
                            TikTok Shop ID
                        </div>

                        <div class="tiktok-value">

                            {{ $product->tiktok_shop_id ?? 'Chưa có' }}

                        </div>

                    </div>


                    <div class="tiktok-item">

                        <div class="tiktok-label">
                            TikTok URL
                        </div>

                        <div class="tiktok-value">

                            @if ($product->tiktok_url)
                                <a href="{{ $product->tiktok_url }}" target="_blank" rel="noopener noreferrer"
                                    class="tiktok-link">
                                    {{ $product->tiktok_url }}
                                </a>
                            @else
                                Chưa có
                            @endif

                        </div>

                    </div>


                </div>

            </div>


            {{-- XÓA --}}

            <div class="card">

                <div class="card-title">
                    Khu vực nguy hiểm
                </div>

                <p style="
            color:#6b7280;
            font-size:13px;
            margin-top:0;
        ">
                    Xóa sản phẩm khỏi hệ thống. Thao tác này không thể hoàn tác.
                </p>


                <form method="POST"
                    action="{{ route('admin.products.destroy', $product) }}"
                    onsubmit="
                return confirm(
                    'Bạn có chắc chắn muốn xóa sản phẩm này?'
                );
            ">

                    @csrf

                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Xóa sản phẩm
                    </button>

                </form>

            </div>


        </div>


        {{-- CỘT PHẢI --}}

        <div>


            {{-- TRẠNG THÁI --}}

            <div class="card">

                <div class="card-title">
                    Trạng thái
                </div>


                <div style="margin-bottom:15px;">

                    @if ($product->status)
                        <span class="badge badge-success">
                            Đang hoạt động
                        </span>
                    @else
                        <span class="badge badge-danger">
                            Đang ẩn
                        </span>
                    @endif

                </div>


                <div class="info-list">

                    <div class="info-row">

                        <span class="info-label">
                            Danh mục
                        </span>

                        <span class="info-value">

                            {{ $product->category?->name ?? 'Chưa phân loại' }}

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Ngày tạo
                        </span>

                        <span class="info-value">

                            {{ $product->created_at?->format('d/m/Y H:i') }}

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Cập nhật
                        </span>

                        <span class="info-value">

                            {{ $product->updated_at?->format('d/m/Y H:i') }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- GIÁ --}}

            <div class="card">

                <div class="card-title">
                    Giá sản phẩm
                </div>


                @if ($product->sale_price)
                    <div class="price-main">

                        {{ number_format($product->sale_price, 0, ',', '.') }}đ

                    </div>


                    <div class="price-old">

                        {{ number_format($product->price, 0, ',', '.') }}đ

                    </div>
                @elseif ($product->price)
                    <div class="price-main">

                        {{ number_format($product->price, 0, ',', '.') }}đ

                    </div>
                @else
                    <div style="
                color:#9ca3af;
                font-size:13px;
            ">
                        Chưa có giá
                    </div>
                @endif

            </div>


            {{-- THỐNG KÊ --}}

            <div class="card">

                <div class="card-title">
                    Thống kê
                </div>


                <div class="stat-grid">

                    <div class="mini-stat">

                        <div class="mini-stat-label">
                            Lượt click
                        </div>

                        <div class="mini-stat-value">

                            {{ number_format($product->click_count) }}

                        </div>

                    </div>


                    <div class="mini-stat">

                        <div class="mini-stat-label">
                            ID sản phẩm
                        </div>

                        <div class="mini-stat-value">

                            #{{ $product->id }}

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection
