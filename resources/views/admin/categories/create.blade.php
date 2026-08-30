@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('page-title', 'Thêm danh mục')

@push('styles')
    <style>
        .form-page {
            max-width: 850px;
        }


        .form-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }


        .form-header {
            padding-bottom: 18px;
            margin-bottom: 25px;
            border-bottom: 1px solid #e5e7eb;
        }


        .form-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }


        .form-header p {
            margin-top: 5px;
            color: #6b7280;
            font-size: 13px;
        }


        .form-group {
            margin-bottom: 20px;
        }


        .form-label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 500;

            color: #374151;
        }


        .required {
            color: #dc2626;
        }


        .form-control {
            width: 100%;

            height: 42px;

            border: 1px solid #d1d5db;
            border-radius: 7px;

            padding: 0 12px;

            font-size: 14px;

            outline: none;
        }


        textarea.form-control {
            height: 120px;
            padding: 12px;
            resize: vertical;
        }


        .form-control:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 2px rgba(37, 99, 235, 0.1);
        }


        .form-error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 13px;
        }


        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }


        .checkbox-group input {
            width: 16px;
            height: 16px;
        }


        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }


        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 10px 16px;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 500;

            text-decoration: none;

            border: none;
            cursor: pointer;
        }


        .btn-primary {
            background: #2563eb;
            color: white;
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
    </style>
@endpush

@section('content')

    <div class="form-page">

        <div class="form-card">


            <div class="form-header">

                <h2>
                    Thêm danh mục mới
                </h2>

                <p>
                    Nhập thông tin danh mục sản phẩm.
                </p>

            </div>


            <form method="POST" action="{{ route('admin.categories.store') }}">

                @csrf


                <!-- NAME -->

                <div class="form-group">

                    <label class="form-label">

                        Tên danh mục

                        <span class="required">
                            *
                        </span>

                    </label>


                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Ví dụ: Điện thoại" required>


                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- DESCRIPTION -->

                <div class="form-group">

                    <label class="form-label">
                        Mô tả
                    </label>


                    <textarea name="description" class="form-control" placeholder="Nhập mô tả danh mục...">{{ old('description') }}</textarea>


                    @error('description')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- STATUS -->
                
                <div class="form-group">

                    <div class="checkbox-group">

                        <input type="checkbox" name="status" value="1" id="status"
                            {{ old('status', true) ? 'checked' : '' }}>

                        <label for="status" class="form-label" style="margin: 0;">
                            Kích hoạt danh mục
                        </label>

                    </div>

                </div>


                <!-- ACTION -->

                <div class="form-actions">

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        Hủy
                    </a>


                    <button type="submit" class="btn btn-primary">
                        Thêm danh mục
                    </button>

                </div>


            </form>


        </div>

    </div>

@endsection
