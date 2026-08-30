@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa danh mục')

@section('page-title', 'Chỉnh sửa danh mục')

@push('styles')
    <style>
        .form-page {
            max-width: 850px;
        }


        /* =========================
               FORM CARD
            ========================= */

        .form-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }


        /* =========================
               HEADER
            ========================= */

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


        /* =========================
               FORM GROUP
            ========================= */

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


        /* =========================
               INPUT
            ========================= */

        .form-control {
            width: 100%;

            height: 42px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            padding: 0 12px;

            font-size: 14px;

            color: #111827;

            background: #ffffff;

            outline: none;

            transition: 0.2s;
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


        /* =========================
               SLUG
            ========================= */

        .slug-preview {
            margin-top: 6px;

            font-size: 12px;

            color: #9ca3af;
        }


        /* =========================
               CHECKBOX
            ========================= */

        .checkbox-group {
            display: flex;

            align-items: center;

            gap: 8px;
        }


        .checkbox-group input {
            width: 16px;

            height: 16px;

            cursor: pointer;
        }


        .checkbox-label {
            margin: 0;

            font-size: 14px;

            color: #374151;

            cursor: pointer;
        }


        /* =========================
               ERROR
            ========================= */

        .form-error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 13px;
        }


        /* =========================
               ACTIONS
            ========================= */

        .form-actions {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;

            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }


        .left-actions,
        .right-actions {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        /* =========================
               BUTTON
            ========================= */

        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 10px 16px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 500;

            text-decoration: none;

            border: none;

            cursor: pointer;

            transition: 0.2s;
        }


        .btn-primary {
            background: #2563eb;

            color: #ffffff;
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


        /* =========================
               ALERT
            ========================= */

        .alert-error {
            background: #fef2f2;

            color: #b91c1c;

            border: 1px solid #fecaca;

            padding: 12px 15px;

            border-radius: 8px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        /* =========================
               RESPONSIVE
            ========================= */

        @media (max-width: 650px) {

            .form-card {
                padding: 18px;
            }


            .form-actions {
                align-items: stretch;

                flex-direction: column;
            }


            .left-actions,
            .right-actions {
                width: 100%;
            }


            .left-actions .btn,
            .right-actions .btn {
                flex: 1;
            }

        }
    </style>
@endpush

@section('content')

    <div class="form-page">

        {{-- VALIDATION ERROR --}}

        @if ($errors->any())

            <div class="alert-error">

                <strong>
                    Có lỗi xảy ra:
                </strong>

                <ul style="margin: 6px 0 0 18px;">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="form-card">


            <!-- HEADER -->

            <div class="form-header">

                <h2>
                    Chỉnh sửa danh mục
                </h2>

                <p>
                    Cập nhật thông tin danh mục
                    <strong>{{ $category->name }}</strong>.
                </p>

            </div>


            <!-- FORM -->

            <form method="POST" action="{{ route('admin.categories.update', $category) }}">

                @csrf

                @method('PUT')


                <!-- NAME -->

                <div class="form-group">

                    <label for="name" class="form-label">

                        Tên danh mục

                        <span class="required">
                            *
                        </span>

                    </label>


                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                        class="form-control" placeholder="Ví dụ: Điện thoại" required>


                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- SLUG -->

                <div class="form-group">

                    <label for="slug" class="form-label">
                        Slug
                    </label>


                    <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                        class="form-control" placeholder="vi-du-dien-thoai">


                    <div class="slug-preview">
                        Slug dùng cho URL của danh mục.
                    </div>


                    @error('slug')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- DESCRIPTION -->

                <div class="form-group">

                    <label for="description" class="form-label">
                        Mô tả
                    </label>


                    <textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả danh mục...">{{ old('description', $category->description) }}</textarea>


                    @error('description')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- STATUS -->

                <div class="form-group">

                    <div class="checkbox-group">

                        <input type="hidden" name="status" value="0">

                        <input type="checkbox" id="status" name="status" value="1"
                            {{ old('status', $category->status) ? 'checked' : '' }}>

                        <label for="status" class="checkbox-label">
                            Kích hoạt danh mục
                        </label>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="form-actions">


                    <div class="left-actions">

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            ← Danh sách
                        </a>

                    </div>


                    <div class="right-actions">

                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-secondary">
                            Xem
                        </a>


                        <button type="submit" class="btn btn-primary">
                            Lưu thay đổi
                        </button>

                    </div>


                </div>


            </form>


        </div>

    </div>

@endsection
