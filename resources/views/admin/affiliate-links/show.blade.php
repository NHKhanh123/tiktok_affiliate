```blade
@extends('admin.layouts.app')

@section('title', 'Chi tiết Affiliate Link')

@section('page-title', 'Chi tiết Affiliate Link')

@section('content')

    <div class="page-header">

        <div>

            <h1>
                {{ $affiliateLink->name }}
            </h1>

            <p>
                Chi tiết Affiliate Link #{{ $affiliateLink->id }}
            </p>

        </div>


        <div>

            <a href="{{ route('admin.affiliate-links.edit', $affiliateLink) }}"
                class="btn btn-primary">
                Chỉnh sửa
            </a>


            <a href="{{ route('admin.affiliate-links.index') }}" class="btn btn-secondary">
                Quay lại
            </a>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- PRODUCT --}}
    {{-- ========================= --}}

    <div class="card">

        <div class="card-header">

            <div>

                <h2>
                    Sản phẩm 🔒
                </h2>

                <p>
                    Thông tin sản phẩm mà Affiliate Link liên kết.
                </p>

            </div>

            <span class="source-badge">
                Product
            </span>

        </div>


        <div class="info-grid">

            <div class="info-item">

                <span>
                    Tên sản phẩm
                </span>

                <strong>
                    {{ $affiliateLink->product?->name ?? 'Không xác định' }}
                </strong>

            </div>


            <div class="info-item">

                <span>
                    Product ID
                </span>

                <strong>
                    {{ $affiliateLink->product_id }}
                </strong>

            </div>


            <div class="info-item">

                <span>
                    TikTok Product ID
                </span>

                <strong>
                    {{ $affiliateLink->product?->tiktok_product_id ?? '—' }}
                </strong>

            </div>


            <div class="info-item">

                <span>
                    TikTok Shop ID
                </span>

                <strong>
                    {{ $affiliateLink->product?->tiktok_shop_id ?? '—' }}
                </strong>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- AFFILIATE --}}
    {{-- ========================= --}}

    <div class="card">

        <div class="card-header">

            <div>

                <h2>
                    Thông tin Affiliate
                </h2>

                <p>
                    Thông tin liên kết tiếp thị.
                </p>

            </div>

            <span class="affiliate-badge">
                Affiliate
            </span>

        </div>


        <div class="info-grid">

            <div class="info-item">

                <span>
                    Tên
                </span>

                <strong>
                    {{ $affiliateLink->name }}
                </strong>

            </div>


            <div class="info-item">

                <span>
                    Commission
                </span>

                <strong class="commission">

                    {{ number_format($affiliateLink->commission_rate, 2) }}%

                </strong>

            </div>


            <div class="info-item">

                <span>
                    Trạng thái
                </span>

                <strong>

                    @if ($affiliateLink->status)
                        <span class="badge badge-success">
                            Đang hoạt động
                        </span>
                    @else
                        <span class="badge badge-danger">
                            Đang tắt
                        </span>
                    @endif

                </strong>

            </div>


            <div class="info-item">

                <span>
                    Ngày tạo
                </span>

                <strong>

                    {{ $affiliateLink->created_at ? $affiliateLink->created_at->format('d/m/Y H:i') : '—' }}

                </strong>

            </div>

        </div>


        <div class="url-section">

            <span>
                Affiliate URL
            </span>

            <div class="url-box">

                <a href="{{ $affiliateLink->affiliate_url }}" target="_blank" rel="noopener noreferrer">
                    {{ $affiliateLink->affiliate_url }}
                </a>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- NOTE --}}
    {{-- ========================= --}}

    <div class="card note-card">

        <h2>
            Lưu ý
        </h2>

        <p>
            Affiliate Link hiện tại được quản lý thủ công.
            Khi tích hợp TikTok Shop API, Affiliate URL và
            tỷ lệ hoa hồng có thể được đồng bộ tự động từ TikTok.
        </p>

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

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .card-header h2 {
            margin: 0 0 5px;
        }

        .card-header p {
            margin: 0;
            color: #6b7280;
        }

        .source-badge,
        .affiliate-badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .source-badge {
            background: #e0f2fe;
            color: #0369a1;
        }

        .affiliate-badge {
            background: #fef3c7;
            color: #92400e;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .info-item span,
        .url-section>span {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .info-item strong {
            word-break: break-word;
        }

        .commission {
            color: #92400e;
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

        .url-section {
            margin-top: 20px;
        }

        .url-box {
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
            word-break: break-all;
        }

        .url-box a {
            color: #2563eb;
        }

        .note-card {
            background: #fffbeb;
        }

        .note-card h2 {
            margin-top: 0;
        }

        .note-card p {
            color: #92400e;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 7px;
            text-decoration: none;
            margin-left: 5px;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-secondary {
            background: #6b7280;
            color: #fff;
        }

        @media (max-width: 700px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>

@endsection
