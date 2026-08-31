```blade
@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('page-title', 'Quản lý sản phẩm')

@section('content')

    <div class="page-header">

        <div>

            <h1>Quản lý sản phẩm</h1>

            <p>
                {{ $product->name }}
            </p>

        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif


    <form method="POST" action="{{ route('admin.products.update', $product) }}">

        @csrf
        @method('PUT')


        {{-- ============================= --}}
        {{-- DỮ LIỆU TIKTOK --}}
        {{-- ============================= --}}

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Dữ liệu TikTok Shop
                        <span class="lock">🔒</span>
                    </h2>

                    <p>
                        Các thông tin này được lấy từ TikTok Shop
                        và sẽ được cập nhật thông qua API.
                    </p>

                </div>

                <span class="source-badge">
                    TikTok API
                </span>

            </div>


            <div class="form-group">

                <label>
                    Tên sản phẩm
                </label>

                <input type="text" value="{{ $product->name }}" disabled>

            </div>


            <div class="form-group">

                <label>
                    Slug
                </label>

                <input type="text" value="{{ $product->slug }}" disabled>

            </div>


            <div class="form-group">

                <label>
                    Mô tả
                </label>

                <textarea rows="5" disabled>{{ $product->description }}</textarea>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>
                        Giá
                    </label>

                    <input type="text"
                        value="{{ $product->price !== null ? number_format($product->price, 0, ',', '.') . 'đ' : '—' }}"
                        disabled>

                </div>


                <div class="form-group">

                    <label>
                        Giá khuyến mãi
                    </label>

                    <input type="text"
                        value="{{ $product->sale_price !== null ? number_format($product->sale_price, 0, ',', '.') . 'đ' : '—' }}"
                        disabled>

                </div>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>
                        TikTok Product ID
                    </label>

                    <input type="text" value="{{ $product->tiktok_product_id ?? '—' }}" disabled>

                </div>


                <div class="form-group">

                    <label>
                        TikTok Shop ID
                    </label>

                    <input type="text" value="{{ $product->tiktok_shop_id ?? '—' }}" disabled>

                </div>

            </div>


            <div class="form-group">

                <label>
                    TikTok URL
                </label>

                <input type="text" value="{{ $product->tiktok_url ?? '—' }}" disabled>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- DỮ LIỆU WEBSITE --}}
        {{-- ============================= --}}

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Quản lý trên website
                        ✏️
                    </h2>

                    <p>
                        Admin có thể thay đổi các thông tin này.
                    </p>

                </div>

                <span class="admin-badge">
                    Admin
                </span>

            </div>


            <div class="form-group">

                <label>
                    Danh mục
                </label>

                <select name="category_id">

                    <option value="">
                        -- Chưa phân loại --
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>
                    Trạng thái
                </label>

                <label class="switch-row">

                    <input type="checkbox" name="status" value="1"
                        {{ old('status', $product->status) ? 'checked' : '' }}>

                    <span>
                        Hiển thị sản phẩm trên website
                    </span>

                </label>

            </div>


            <div class="form-group">

                <label>
                    Sản phẩm nổi bật
                </label>

                <label class="switch-row">

                    <input type="checkbox" name="featured" value="1"
                        {{ old('featured', $product->featured) ? 'checked' : '' }}>

                    <span>
                        Đưa sản phẩm vào khu vực nổi bật
                    </span>

                </label>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- THỐNG KÊ --}}
        {{-- ============================= --}}

        <div class="card">

            <div class="card-header">

                <h2>
                    Thống kê
                    📊
                </h2>

                <p>
                    Các số liệu này được hệ thống tự động ghi nhận.
                </p>

            </div>


            <div class="stats">

                <div class="stat-box">

                    <span>
                        Lượt click
                    </span>

                    <strong>
                        {{ number_format($product->click_count) }}
                    </strong>

                </div>


                <div class="stat-box">

                    <span>
                        Ngày tạo
                    </span>

                    <strong>
                        {{ $product->created_at?->format('d/m/Y H:i') }}
                    </strong>

                </div>


                <div class="stat-box">

                    <span>
                        Cập nhật
                    </span>

                    <strong>
                        {{ $product->updated_at?->format('d/m/Y H:i') }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="form-actions">

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Quay lại
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
            gap: 20px;
            margin-bottom: 25px;
        }

        .card-header h2 {
            margin: 0 0 5px;
        }

        .card-header p {
            margin: 0;
            color: #6b7280;
        }

        .lock {
            font-size: 16px;
        }

        .source-badge,
        .admin-badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .source-badge {
            background: #e0f2fe;
            color: #0369a1;
        }

        .admin-badge {
            background: #dcfce7;
            color: #166534;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
        }

        .form-group input:disabled,
        .form-group textarea:disabled {
            background: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .switch-row {
            display: flex !important;
            align-items: center;
            gap: 10px;
            font-weight: 500 !important;
            cursor: pointer;
        }

        .switch-row input {
            width: auto;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .stat-box {
            padding: 18px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .stat-box span {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .stat-box strong {
            font-size: 18px;
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
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {

            .form-row,
            .stats {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
            }

        }
    </style>

@endsection
