```blade
@extends('admin.layouts.app')

@section('title', 'Tạo Affiliate Link')

@section('page-title', 'Tạo Affiliate Link')

@section('content')

    <div class="page-header">

        <div>

            <h1>Tạo Affiliate Link</h1>

            <p>
                Tạo liên kết tiếp thị cho sản phẩm TikTok Shop.
            </p>

        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Có lỗi xảy ra:
            </strong>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach

            </ul>

        </div>

    @endif


    <form method="POST" action="{{ route('admin.affiliate-links.store') }}">

        @csrf


        {{-- SẢN PHẨM --}}

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Sản phẩm
                    </h2>

                    <p>
                        Chọn sản phẩm mà Affiliate Link sẽ trỏ tới.
                    </p>

                </div>

                <span class="source-badge">
                    Product
                </span>

            </div>


            <div class="form-group">

                <label>
                    Sản phẩm <span class="required">*</span>
                </label>

                <select name="product_id" required>

                    <option value="">
                        -- Chọn sản phẩm --
                    </option>


                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                            {{ $product->name }}

                            @if ($product->tiktok_product_id)
                                — TikTok ID:
                                {{ $product->tiktok_product_id }}
                            @endif

                        </option>
                    @endforeach

                </select>

            </div>

        </div>


        {{-- AFFILIATE --}}

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Thông tin Affiliate
                    </h2>

                    <p>
                        Các thông tin của liên kết tiếp thị.
                    </p>

                </div>

                <span class="affiliate-badge">
                    Affiliate
                </span>

            </div>


            <div class="form-group">

                <label>
                    Tên Affiliate Link
                    <span class="required">*</span>
                </label>

                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Affiliate sản phẩm A"
                    required>

            </div>


            <div class="form-group">

                <label>
                    Affiliate URL
                    <span class="required">*</span>
                </label>

                <textarea name="affiliate_url" rows="4" placeholder="https://..." required>{{ old('affiliate_url') }}</textarea>

                <small>
                    Nhập Affiliate URL được cung cấp bởi TikTok.
                </small>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>
                        Tỷ lệ hoa hồng (%)
                    </label>

                    <input type="number" name="commission_rate" value="{{ old('commission_rate', 0) }}" min="0"
                        max="100" step="0.01">

                    <small>
                        Tạm thời nhập thủ công để kiểm thử.
                        Sau này sẽ lấy từ TikTok API.
                    </small>

                </div>


                <div class="form-group">

                    <label>
                        Trạng thái
                    </label>

                    <label class="checkbox-row">

                        <input type="checkbox" name="status" value="1"
                            {{ old('status', true) ? 'checked' : '' }}>

                        <span>
                            Kích hoạt Affiliate Link
                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}

        <div class="form-actions">

            <a href="{{ route('admin.affiliate-links.index') }}" class="btn btn-secondary">
                Hủy
            </a>


            <button type="submit" class="btn btn-primary">
                Tạo Affiliate Link
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
            background: #fef3c7;
            color: #92400e;
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
        .form-group textarea,
        .form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group small {
            display: block;
            margin-top: 6px;
            color: #6b7280;
        }

        .required {
            color: #dc2626;
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

            .form-row {
                grid-template-columns: 1fr;
            }

        }
    </style>

@endsection
