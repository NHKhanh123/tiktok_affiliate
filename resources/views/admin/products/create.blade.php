```blade
@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm')

@section('page-title', 'Thêm sản phẩm')

@section('content')

    <div class="page-header">

        <div>
            <h1>Thêm sản phẩm</h1>

            <p>
                Tạo sản phẩm thủ công để kiểm thử hệ thống.
                Sản phẩm thực tế sẽ được đồng bộ từ TikTok Shop.
            </p>
        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form method="POST" action="{{ route('admin.products.store') }}">

        @csrf


        {{-- DỮ LIỆU SẢN PHẨM --}}

        <div class="card">

            <div class="card-header">

                <h2>Thông tin sản phẩm</h2>

                <p>
                    Trong tương lai các thông tin này sẽ được
                    lấy từ TikTok Shop API.
                </p>

            </div>


            <div class="form-group">

                <label>
                    Tên sản phẩm
                </label>

                <input type="text" name="name" value="{{ old('name') }}" required>

            </div>


            <div class="form-group">

                <label>
                    Slug
                </label>

                <input type="text" name="slug" value="{{ old('slug') }}">

            </div>


            <div class="form-group">

                <label>
                    Mô tả
                </label>

                <textarea name="description" rows="5">{{ old('description') }}</textarea>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>
                        Giá
                    </label>

                    <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01">

                </div>


                <div class="form-group">

                    <label>
                        Giá khuyến mãi
                    </label>

                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" min="0" step="0.01">

                </div>

            </div>

        </div>


        {{-- DỮ LIỆU WEBSITE --}}

        <div class="card">

            <div class="card-header">

                <h2>Quản lý website</h2>

                <p>
                    Đây là các thông tin Admin được phép quản lý.
                </p>

            </div>


            <div class="form-group">

                <label>
                    Danh mục
                </label>

                <select name="category_id">

                    <option value="">
                        -- Chọn danh mục --
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

            </div>


            <div class="form-group checkbox-group">

                <label>

                    <input type="checkbox" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>

                    Hiển thị sản phẩm trên website

                </label>

            </div>


            <div class="form-group checkbox-group">

                <label>

                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>

                    Sản phẩm nổi bật

                </label>

            </div>

        </div>


        <div class="form-actions">

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Hủy
            </a>

            <button type="submit" class="btn btn-primary">
                Lưu sản phẩm
            </button>

        </div>

    </form>


    <style>
        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin-bottom: 5px;
        }

        .page-header p {
            color: #6b7280;
        }

        .card {
            background: #fff;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header h2 {
            margin-bottom: 5px;
        }

        .card-header p {
            color: #6b7280;
            margin: 0;
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
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            box-sizing: border-box;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .checkbox-group input {
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
