```blade
@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Affiliate Link')

@section('page-title', 'Chỉnh sửa Affiliate Link')

@section('content')

    <div class="page-header">

        <div>

            <h1>Chỉnh sửa Affiliate Link</h1>

            <p>
                {{ $affiliateLink->name }}
            </p>

        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div>
                    {{ $error }}
                </div>
            @endforeach

        </div>

    @endif


    <form method="POST" action="{{ route('admin.affiliate-links.update', $affiliateLink) }}">

        @csrf

        @method('PUT')


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
                        Sản phẩm được liên kết với Affiliate Link.
                    </p>

                </div>

                <span class="source-badge">
                    Product
                </span>

            </div>


            <div class="product-info">

                <div>

                    <span>
                        Tên sản phẩm
                    </span>

                    <strong>
                        {{ $affiliateLink->product?->name ?? 'Không xác định' }}
                    </strong>

                </div>


                <div>

                    <span>
                        Product ID
                    </span>

                    <strong>
                        {{ $affiliateLink->product_id }}
                    </strong>

                </div>


                <div>

                    <span>
                        TikTok Product ID
                    </span>

                    <strong>
                        {{ $affiliateLink->product?->tiktok_product_id ?? '—' }}
                    </strong>

                </div>

            </div>


            <div class="info-note">

                Sản phẩm không được thay đổi tại màn hình này.
                Nếu cần liên kết sản phẩm khác, hãy tạo Affiliate
                Link mới.

            </div>

        </div>


        {{-- ========================= --}}
        {{-- AFFILIATE --}}
        {{-- ========================= --}}

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Thông tin Affiliate ✏️
                    </h2>

                    <p>
                        Admin được phép chỉnh sửa các thông tin này.
                    </p>

                </div>

                <span class="affiliate-badge">
                    Admin
                </span>

            </div>


            <div class="form-group">

                <label>
                    Tên Affiliate Link
                </label>

                <input type="text" name="name"
                    value="{{ old('name', $affiliateLink->name) }}"
                    required>

            </div>


            <div class="form-group">

                <label>
                    Affiliate URL
                </label>

                <textarea name="affiliate_url" rows="4" required>{{ old('affiliate_url', $affiliateLink->affiliate_url) }}</textarea>

                <small>
                    URL Affiliate được cung cấp bởi TikTok.
                </small>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>
                        Tỷ lệ hoa hồng (%)
                    </label>

                    <input type="number" name="commission_rate"
                        value="{{ old('commission_rate', $affiliateLink->commission_rate) }}"
                        min="0" max="100" step="0.01" required>

                    <small>
                        Sau này giá trị này có thể được đồng bộ
                        tự động từ TikTok.
                    </small>

                </div>


                <div class="form-group">

                    <label>
                        Trạng thái
                    </label>

                    <label class="checkbox-row">

                        <input type="checkbox" name="status" value="1"
                            {{ old('status', $affiliateLink->status) ? 'checked' : '' }}>

                        <span>
                            Affiliate Link đang hoạt động
                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- ACTION --}}

        <div class="form-actions">

            <a href="{{ route('admin.affiliate-links.index') }}" class="btn btn-secondary">
                Hủy
            </a>


            <button type="submit" class="btn btn-primary">
                Lưu thay đổi
            </button>

        </div>

    </form>


    <style>
        .page-header {
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
            background: #dcfce7;
            color: #166534;
        }

        .product-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .product-info>div {
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .product-info span {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .product-info strong {
            word-break: break-word;
        }

        .info-note {
            margin-top: 20px;
            padding: 12px 15px;
            background: #f3f4f6;
            border-radius: 8px;
            color: #6b7280;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group small {
            display: block;
            margin-top: 6px;
            color: #6b7280;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .checkbox-row {
            display: flex !important;
            align-items: center;
            gap: 8px;
            font-weight: 500 !important;
            cursor: pointer;
        }

        .checkbox-row input {
            width: auto;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-secondary {
            background: #6b7280;
            color: #fff;
        }

        .alert-danger {
            padding: 15px;
            margin-bottom: 20px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
        }

        @media (max-width: 700px) {

            .product-info,
            .form-row {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                gap: 10px;
            }

        }
    </style>

@endsection
