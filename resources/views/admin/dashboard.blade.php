@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@push('styles')
    <style>
        /* =========================
           DASHBOARD STATS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }


        .stats .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .stats .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
        }


        /* =========================
           CARD HEADER
        ========================= */

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }


        .card-title {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }


        .card-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            font-size: 20px;
        }


        .icon-product {
            background: #eff6ff;
        }


        .icon-click {
            background: #f5f3ff;
        }


        .icon-order {
            background: #fff7ed;
        }


        .icon-money {
            background: #ecfdf5;
        }


        /* =========================
           CARD VALUE
        ========================= */

        .card-value {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            line-height: 1.2;
        }


        /* =========================
           CARD DESCRIPTION
        ========================= */

        .card-description {
            margin-top: 10px;
            font-size: 12px;
            color: #9ca3af;
        }


        /* =========================
           SECTION
        ========================= */

        .section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }


        .section .card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }


        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
            padding-bottom: 16px;

            border-bottom: 1px solid #f0f0f0;
        }


        .section-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }


        .section-header span {
            font-size: 13px;
            color: #6b7280;
        }


        .section-description {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================
           QUICK STATS
        ========================= */

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 20px;
        }


        .quick-item {
            padding: 16px;
            background: #f9fafb;
            border-radius: 9px;
        }


        .quick-item-title {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 7px;
        }


        .quick-item-value {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1100px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media (max-width: 650px) {

            .stats {
                grid-template-columns: 1fr;
            }


            .quick-stats {
                grid-template-columns: 1fr;
            }


            .stats .card {
                padding: 18px;
            }


            .card-value {
                font-size: 24px;
            }

        }
    </style>
@endpush

@section('content')

    <!-- =========================
         STATISTICS
    ========================= -->

    <div class="stats">

        <!-- PRODUCTS -->

        <div class="card">

            <div class="card-top">

                <div class="card-title">
                    Tổng sản phẩm
                </div>

                <div class="card-icon icon-product">
                    📦
                </div>

            </div>


            <div class="card-value">

                {{ number_format($totalProducts) }}

            </div>


            <div class="card-description">
                Sản phẩm đang được quản lý
            </div>

        </div>


        <!-- CLICKS -->

        <div class="card">

            <div class="card-top">

                <div class="card-title">
                    Tổng lượt click
                </div>

                <div class="card-icon icon-click">
                    🔗
                </div>

            </div>


            <div class="card-value">

                {{ number_format($totalClicks) }}

            </div>


            <div class="card-description">
                Lượt truy cập qua Affiliate
            </div>

        </div>


        <!-- ORDERS -->

        <div class="card">

            <div class="card-top">

                <div class="card-title">
                    Đơn hàng
                </div>

                <div class="card-icon icon-order">
                    🛒
                </div>

            </div>


            <div class="card-value">

                {{ number_format($totalOrders) }}

            </div>


            <div class="card-description">
                Tổng số đơn hàng
            </div>

        </div>


        <!-- COMMISSION -->

        <div class="card">

            <div class="card-top">

                <div class="card-title">
                    Hoa hồng tháng này
                </div>

                <div class="card-icon icon-money">
                    💰
                </div>

            </div>


            <div class="card-value">

                {{ number_format($monthlyCommission, 0, ',', '.') }}đ

            </div>


            <div class="card-description">
                Hoa hồng Affiliate trong tháng
            </div>

        </div>

    </div>

    <!-- =========================
         AFFILIATE OVERVIEW
    ========================= -->

    <div class="section">

        <div class="card">


            <div class="section-header">

                <h2>
                    Tổng quan Affiliate
                </h2>

                <span>
                    Hệ thống Affiliate
                </span>

            </div>


            <p class="section-description">

                Đây là khu vực thống kê hiệu quả
                tiếp thị liên kết của website.

            </p>


            <div class="quick-stats">


                <div class="quick-item">

                    <div class="quick-item-title">
                        Sản phẩm
                    </div>

                    <div class="quick-item-value">

                        {{ number_format($totalProducts) }}

                    </div>

                </div>


                <div class="quick-item">

                    <div class="quick-item-title">
                        Lượt click
                    </div>

                    <div class="quick-item-value">

                        {{ number_format($totalClicks) }}

                    </div>

                </div>


                <div class="quick-item">

                    <div class="quick-item-title">
                        Đơn hàng
                    </div>

                    <div class="quick-item-value">

                        {{ number_format($totalOrders) }}

                    </div>

                </div>


            </div>


        </div>

    </div>

@endsection
