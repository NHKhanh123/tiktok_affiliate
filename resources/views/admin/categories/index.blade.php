@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@push('styles')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .page {
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        /* HEADER */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 28px;
            margin-bottom: 6px;
        }

        .page-title p {
            color: #6b7280;
            font-size: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* ALERT */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* CARD */

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            padding: 14px 18px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 15px 18px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        /* CATEGORY */

        .category-name {
            font-weight: 600;
            color: #111827;
        }

        .category-slug {
            color: #6b7280;
            font-size: 13px;
        }

        /* IMAGE */

        .category-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }

        .no-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 12px;
        }

        /* STATUS */

        .status {
            display: inline-flex;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ACTION */

        .actions {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 7px 11px;
            font-size: 12px;
            border-radius: 6px;
        }

        .btn-view {
            background: #eff6ff;
            color: #2563eb;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .actions form {
            margin: 0;
        }

        /* EMPTY */

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }

        /* PAGINATION */

        .pagination {
            padding: 18px;
            border-top: 1px solid #e5e7eb;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {

            .page {
                padding: 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title h1 {
                font-size: 24px;
            }

            .card-header {
                padding: 16px;
            }

            th,
            td {
                padding: 12px;
            }

        }
    </style>
@endpush
@section('content')
    <div class="page">

        <div class="container">


            <!-- HEADER -->

            <div class="page-header">

                <div class="page-title">

                    <h1>
                        Quản lý danh mục
                    </h1>

                    <p>
                        Quản lý các danh mục sản phẩm trên website
                    </p>

                </div>


                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    + Thêm danh mục
                </a>

            </div>


            <!-- ALERT -->

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif


            <!-- CARD -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        Danh sách danh mục
                    </h2>

                </div>


                <div class="table-wrapper">

                    @if ($categories->count())

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        ID
                                    </th>

                                    <th>
                                        Hình ảnh
                                    </th>

                                    <th>
                                        Danh mục
                                    </th>

                                    <th>
                                        Slug
                                    </th>

                                    <th>
                                        Trạng thái
                                    </th>

                                    <th>
                                        Thao tác
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>

                                        <td>
                                            #{{ $category->id }}
                                        </td>


                                        <td>

                                            @if ($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" class="category-image"
                                                    alt="{{ $category->name }}">
                                            @else
                                                <div class="no-image">
                                                    No image
                                                </div>
                                            @endif

                                        </td>


                                        <td>

                                            <div class="category-name">
                                                {{ $category->name }}
                                            </div>

                                            @if ($category->description)
                                                <div class="category-slug">
                                                    {{ Str::limit($category->description, 50) }}
                                                </div>
                                            @endif

                                        </td>


                                        <td>

                                            <span class="category-slug">
                                                {{ $category->slug }}
                                            </span>

                                        </td>


                                        <td>

                                            @if ($category->status)
                                                <span class="status status-active">
                                                    Đang hoạt động
                                                </span>
                                            @else
                                                <span class="status status-inactive">
                                                    Đang ẩn
                                                </span>
                                            @endif

                                        </td>


                                        <td>

                                            <div class="actions">

                                                <a href="{{ route('admin.categories.show', $category) }}"
                                                    class="btn btn-small btn-view">
                                                    Xem
                                                </a>


                                                <a href="{{ route('admin.categories.edit', $category) }}"
                                                    class="btn btn-small btn-edit">
                                                    Sửa
                                                </a>


                                                <form method="POST"
                                                    action="{{ route('admin.categories.destroy', $category) }}">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-small btn-delete"
                                                        onclick="
                                                    return confirm(
                                                        'Bạn có chắc muốn xóa danh mục này?'
                                                    );
                                                ">
                                                        Xóa
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    @else
                        <div class="empty">

                            <div class="empty-icon">
                                📁
                            </div>

                            <p>
                                Chưa có danh mục nào.
                            </p>

                            <br>

                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                + Tạo danh mục đầu tiên
                            </a>

                        </div>

                    @endif

                </div>


                @if ($categories->hasPages())
                    <div class="pagination">

                        {{ $categories->links() }}

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
