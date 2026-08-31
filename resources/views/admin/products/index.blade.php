@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('page-title', 'Sản phẩm')

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

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
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

        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 18px;
        }

        .stat-title {
            color: #6b7280;
            font-size: 13px;
        }

        .stat-value {
            margin-top: 8px;
            font-size: 24px;
            font-weight: 600;
            color: #111827;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .filter {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            background: #fafafa;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 10px;
        }

        .form-control {
            width: 100%;
            height: 40px;
            box-sizing: border-box;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            padding: 0 11px;
            font-size: 13px;
            background: #fff;
            outline: none;
        }

        .form-control:focus {
            border-color: #2563eb;
        }

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
            font-size: 12px;
            font-weight: 600;
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 14px 13px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: #374151;
        }

        tr:hover td {
            background: #fafafa;
        }

        .product-name {
            font-weight: 500;
            color: #111827;
        }

        .product-id {
            margin-top: 4px;
            color: #9ca3af;
            font-size: 11px;
        }

        .price {
            font-weight: 500;
            color: #111827;
        }

        .sale-price {
            color: #dc2626;
            font-weight: 600;
        }

        .badge {
            display: inline-flex;
            padding: 4px 8px;
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

        .actions {
            display: flex;
            gap: 6px;
            white-space: nowrap;
        }

        .action-btn {
            padding: 6px 9px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            background: #f3f4f6;
            color: #374151;
        }

        .action-btn:hover {
            background: #e5e7eb;
        }

        .pagination {
            padding: 15px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 11px 14px;
            border-radius: 7px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: 1fr;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header">

        <div>

            <h2>
                Quản lý sản phẩm
            </h2>

            <p>
                Quản lý sản phẩm Affiliate từ TikTok Shop.
            </p>

        </div>


        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Thêm sản phẩm
        </a>

    </div>

    {{-- THỐNG KÊ --}}

    <div class="stats">

        <div class="stat-card">

            <div class="stat-title">
                Tổng sản phẩm
            </div>

            <div class="stat-value">
                {{ number_format($totalProducts) }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Đang hoạt động
            </div>

            <div class="stat-value">
                {{ number_format($activeProducts) }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Sản phẩm nổi bật
            </div>

            <div class="stat-value">
                {{ number_format($featuredProducts) }}
            </div>

        </div>

    </div>

    <div class="card">

        {{-- FILTER --}}

        <div class="filter">

            <form method="GET" action="{{ route('admin.products.index') }}" class="filter-form">

                <input type="text" name="search" class="form-control"
                    placeholder="Tìm sản phẩm hoặc TikTok Product ID..." value="{{ request('search') }}">


                <select name="category_id" class="form-control">

                    <option value="">
                        Tất cả danh mục
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>


                <select name="status" class="form-control">

                    <option value="">
                        Tất cả trạng thái
                    </option>

                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                        Đang hoạt động
                    </option>

                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                        Đang ẩn
                    </option>

                </select>


                <button type="submit" class="btn btn-primary">
                    Lọc
                </button>

            </form>

        </div>


        {{-- TABLE --}}

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Sản phẩm
                        </th>

                        <th>
                            Danh mục
                        </th>

                        <th>
                            Giá
                        </th>

                        <th>
                            Click
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

                    @forelse ($products as $product)
                        <tr>

                            <td>
                                {{ $products->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <div class="product-name">

                                    {{ $product->name }}

                                    @if ($product->featured)
                                        <span class="badge badge-featured">
                                            Nổi bật
                                        </span>
                                    @endif

                                </div>


                                @if ($product->tiktok_product_id)
                                    <div class="product-id">

                                        TikTok ID:
                                        {{ $product->tiktok_product_id }}

                                    </div>
                                @endif

                            </td>


                            <td>

                                {{ $product->category?->name ?? 'Chưa phân loại' }}

                            </td>


                            <td>

                                @if ($product->sale_price)
                                    <div class="sale-price">
                                        {{ number_format($product->sale_price, 0, ',', '.') }}đ
                                    </div>

                                    <div
                                        style="
                                text-decoration: line-through;
                                color:#9ca3af;
                                font-size:11px;
                            ">
                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                    </div>
                                @elseif ($product->price)
                                    <div class="price">
                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                    </div>
                                @else
                                    <span style="color:#9ca3af;">
                                        Chưa có giá
                                    </span>
                                @endif

                            </td>


                            <td>

                                {{ number_format($product->click_count) }}

                            </td>


                            <td>

                                @if ($product->status)
                                    <span class="badge badge-success">
                                        Đang hoạt động
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Đang ẩn
                                    </span>
                                @endif

                            </td>


                            <td>

                                <div class="actions">

                                    <a href="{{ route('admin.products.show', $product) }}" class="action-btn">
                                        Xem
                                    </a>


                                    <a href="{{ route('admin.products.edit', $product) }}" class="action-btn">
                                        Quản lý
                                    </a>


                                    {{-- <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                        onsubmit="
                                    return confirm(
                                        'Bạn có chắc muốn xóa sản phẩm này?'
                                    );
                                ">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="action-btn"
                                            style="
                                        border:none;
                                        cursor:pointer;
                                    ">
                                            Xóa
                                        </button>

                                    </form> --}}

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                style="
                            text-align:center;
                            padding:40px;
                            color:#9ca3af;
                        ">
                                Không tìm thấy sản phẩm.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        <div class="pagination">

            {{ $products->links() }}

        </div>

    </div>

@endsection
