@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="stats">

    <div class="card">

        <div class="card-title">
            Tổng sản phẩm
        </div>

        <div class="card-value">
            {{ number_format($totalProducts) }}
        </div>

    </div>


    <div class="card">

        <div class="card-title">
            Tổng lượt click
        </div>

        <div class="card-value">
           {{ number_format($totalClicks) }}
        </div>

    </div>


    <div class="card">

        <div class="card-title">
            Đơn hàng
        </div>

        <div class="card-value">
            {{ number_format($totalOrders) }}
        </div>

    </div>


    <div class="card">

        <div class="card-title">
            Hoa hồng tháng này
        </div>

        <div class="card-value">
            {{ number_format($monthlyCommission, 0, ',', '.') }}đ
        </div>

    </div>

</div>


<div class="section">

    <div class="card">

        <h2>
            Tổng quan Affiliate
        </h2>

        <p>
            Đây là khu vực thống kê hiệu quả
            tiếp thị liên kết.
        </p>

    </div>

</div>

@endsection