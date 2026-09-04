@extends('admin.layouts.app')

@section('title', 'Click Tracking')

@section('page-title', 'Click Tracking')

@section('content')

    <style>
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 22px;
            border: 1px solid #e5e7eb;
        }

        .stat-title {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .section {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .section-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .click-table {
            width: 100%;
            border-collapse: collapse;
        }

        .click-table th,
        .click-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        .click-table th {
            background: #f8fafc;
            font-size: 13px;
            color: #475569;
        }

        .click-table td {
            font-size: 14px;
            color: #334155;
        }

        .product-name {
            font-weight: 600;
            color: #111827;
        }

        .affiliate-name {
            color: #2563eb;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            background: #dcfce7;
            color: #166534;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        .pagination {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .page-btn {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin: 0 3px;

            border: 1px solid #e5e7eb;
            border-radius: 8px;

            background: #ffffff;
            color: #374151;

            font-size: 14px;
            font-weight: 500;

            text-decoration: none;

            transition: all 0.2s ease;
        }

        .page-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #111827;
        }

        .page-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            font-weight: 600;
        }

        .page-btn.disabled {
            background: #f9fafb;
            color: #d1d5db;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 600px) {

            .pagination {
                padding: 15px;
            }

            .pagination a,
            .pagination span {
                min-width: 34px;
                height: 34px;
                padding: 0 9px;
                font-size: 13px;
            }

        }

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: 1fr;
            }

        }
    </style>


    {{-- ========================================================= --}}
    {{-- THỐNG KÊ --}}
    {{-- ========================================================= --}}

    <div class="stats">

        <div class="stat-card">

            <div class="stat-title">
                Tổng lượt click
            </div>

            <div class="stat-value">
                {{ number_format($totalClicks) }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Click hôm nay
            </div>

            <div class="stat-value">
                {{ number_format($todayClicks) }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Click tháng này
            </div>

            <div class="stat-value">
                {{ number_format($monthlyClicks) }}
            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- DANH SÁCH CLICK --}}
    {{-- ========================================================= --}}

    <div class="section">

        <div class="section-header">

            <h2>
                Lịch sử click
            </h2>

        </div>


        <div class="table-wrapper">

            <table class="click-table">

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Thời gian
                        </th>

                        <th>
                            Sản phẩm
                        </th>

                        <th>
                            Affiliate Link
                        </th>

                        <th>
                            IP
                        </th>

                        <th>
                            Referer
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($clicks as $click)
                        <tr>

                            <td>
                                #{{ $clicks->firstItem() + $loop->index }}
                            </td>


                            <td>

                                {{ $click->clicked_at ? $click->clicked_at->format('d/m/Y H:i:s') : '-' }}

                            </td>


                            <td>

                                <div class="product-name">

                                    {{ $click->product->name ?? 'Không xác định' }}

                                </div>

                            </td>


                            <td>

                                <div class="affiliate-name">

                                    {{ $click->affiliateLink->name ?? 'Không xác định' }}

                                </div>

                            </td>


                            <td>

                                {{ $click->ip_address ?? '-' }}

                            </td>


                            <td>

                                {{ $click->referer ?? '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="empty">
                                Chưa có lượt click nào.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @include('admin.layouts.pagination', ['paginator' => $clicks])

    </div>

@endsection
