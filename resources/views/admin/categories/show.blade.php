@extends('admin.layouts.app')

@section('title', 'Chi tiết danh mục')

@section('page-title', 'Chi tiết danh mục')

@push('styles')
    <style>
        .detail-page {
            max-width: 900px;
        }


        .detail-card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }


        .detail-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding-bottom: 20px;

            margin-bottom: 20px;

            border-bottom: 1px solid #e5e7eb;
        }


        .detail-header h2 {
            font-size: 20px;

            font-weight: 600;

            color: #111827;
        }


        .actions {
            display: flex;

            gap: 8px;
        }


        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 9px 14px;

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


        .btn-danger {
            background: #fee2e2;

            color: #dc2626;
        }


        .btn-danger:hover {
            background: #fecaca;
        }


        /* INFO */

        .info-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 18px;
        }


        .info-item {
            padding: 16px;

            background: #f9fafb;

            border-radius: 9px;
        }


        .info-label {
            font-size: 12px;

            color: #6b7280;

            margin-bottom: 6px;
        }


        .info-value {
            font-size: 15px;

            font-weight: 500;

            color: #111827;
        }


        .description-box {
            margin-top: 20px;

            padding: 18px;

            background: #f9fafb;

            border-radius: 9px;
        }


        .description-label {
            font-size: 12px;

            color: #6b7280;

            margin-bottom: 8px;
        }


        .description {
            font-size: 14px;

            line-height: 1.6;

            color: #374151;
        }


        .status {
            display: inline-flex;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 500;
        }


        .status-active {
            background: #dcfce7;

            color: #15803d;
        }


        .status-inactive {
            background: #f3f4f6;

            color: #6b7280;
        }


        .bottom-actions {
            display: flex;

            justify-content: space-between;

            margin-top: 25px;

            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }


        @media (max-width: 650px) {

            .info-grid {
                grid-template-columns: 1fr;
            }


            .detail-header {
                align-items: flex-start;

                flex-direction: column;

                gap: 15px;
            }


            .bottom-actions {
                flex-direction: column;

                gap: 10px;
            }

        }
    </style>
@endpush

@section('content')

    <div class="detail-page">

        <div class="detail-card">


            <!-- HEADER -->

            <div class="detail-header">

                <h2>
                    {{ $category->name }}
                </h2>


                <div class="actions">

                    <a href="{{ route('admin.categories.edit', $category) }}"
                        class="btn btn-primary">
                        Chỉnh sửa
                    </a>

                </div>

            </div>


            <!-- INFORMATION -->

            <div class="info-grid">


                <div class="info-item">

                    <div class="info-label">
                        ID
                    </div>

                    <div class="info-value">
                        #{{ $category->id }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Tên danh mục
                    </div>

                    <div class="info-value">
                        {{ $category->name }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Slug
                    </div>

                    <div class="info-value">
                        {{ $category->slug }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Trạng thái
                    </div>


                    <div class="info-value">

                        @if ($category->is_active)
                            <span class="status status-active">
                                Đang hoạt động
                            </span>
                        @else
                            <span class="status status-inactive">
                                Tạm khóa
                            </span>
                        @endif

                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Ngày tạo
                    </div>

                    <div class="info-value">
                        {{ $category->created_at?->format('d/m/Y H:i') }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Cập nhật lần cuối
                    </div>

                    <div class="info-value">
                        {{ $category->updated_at?->format('d/m/Y H:i') }}
                    </div>

                </div>


            </div>


            <!-- DESCRIPTION -->

            <div class="description-box">

                <div class="description-label">
                    Mô tả
                </div>

                <div class="description">

                    {{ $category->description ?: 'Chưa có mô tả.' }}

                </div>

            </div>


            <!-- BOTTOM ACTION -->

            <div class="bottom-actions">


                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    ← Quay lại danh sách
                </a>


                <form method="POST"
                    action="{{ route('admin.categories.destroy', $category) }}"
                    onsubmit="return confirm(
                'Bạn có chắc muốn xóa danh mục này?'
            );">

                    @csrf

                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Xóa danh mục
                    </button>

                </form>


            </div>


        </div>

    </div>

@endsection
