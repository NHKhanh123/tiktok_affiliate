@extends('layouts.frontend')

@section('title', 'Đơn hàng của tôi')

@section('content')

    <div class="bg-gray-50 py-10">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">

                <div class="text-sm text-gray-500">
                    Tài khoản
                </div>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Đơn hàng của tôi
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Theo dõi các đơn hàng phát sinh từ liên kết Affiliate của bạn.
                </p>

            </div>


            {{-- Search --}}
            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-4">

                <form method="GET" action="{{ route('account.orders.index') }}" class="flex flex-col gap-3 sm:flex-row">

                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Tìm mã đơn hàng..."
                        class="flex-1 rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-900">


                    <select name="status"
                        class="rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-900">

                        <option value="">
                            Tất cả trạng thái
                        </option>

                        <option value="pending" @selected(request('status') === 'pending')}>
                            Chờ xử lý
                        </option>

                        <option value="completed" @selected(request('status') === 'completed')}>
                            Hoàn thành
                        </option>

                        <option value="cancelled" @selected(request('status') === 'cancelled')}>
                            Đã hủy
                        </option>

                        <option value="refunded" @selected(request('status') === 'refunded')}>
                            Đã hoàn tiền
                        </option>

                    </select>


                    <button type="submit"
                        class="rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800">

                        Lọc

                    </button>

                </form>

            </div>


            {{-- Orders --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">

                @forelse($orders as $order)

                    <a href="{{ route('account.orders.show', $order) }}"
                        class="block border-b border-gray-100 p-5 transition last:border-0 hover:bg-gray-50">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">


                            {{-- Product --}}
                            <div class="flex min-w-0 items-center gap-4">

                                @if ($order->product)
                                    @php
                                        $image = $order->product->images->first() ?? null;
                                    @endphp

                                    <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-gray-100">

                                        @if ($image)
                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                alt="{{ $order->product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center text-xs text-gray-400">
                                                No image
                                            </div>
                                        @endif

                                    </div>
                                @endif


                                <div class="min-w-0">

                                    <div class="truncate font-semibold text-gray-900">

                                        {{ $order->product?->name ?? 'Sản phẩm không còn tồn tại' }}

                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">

                                        Mã đơn:
                                        {{ $order->external_order_id }}

                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">

                                        {{ $order->ordered_at?->format('d/m/Y H:i') ?? '—' }}

                                    </div>

                                </div>

                            </div>


                            {{-- Amount --}}
                            <div class="sm:text-right">

                                <div class="font-semibold text-gray-900">

                                    {{ number_format($order->order_amount, 0, ',', '.') }}
                                    {{ $order->currency }}

                                </div>


                                @php

                                    $status = $order->order_status;

                                    $statusClass = match ($status) {
                                        'completed' => 'bg-green-100 text-green-700',

                                        'cancelled', 'refunded' => 'bg-red-100 text-red-700',

                                        default => 'bg-yellow-100 text-yellow-700',
                                    };

                                    $statusText = match ($status) {
                                        'completed' => 'Hoàn thành',

                                        'cancelled' => 'Đã hủy',

                                        'refunded' => 'Đã hoàn tiền',

                                        'pending' => 'Chờ xử lý',

                                        default => ucfirst($status),
                                    };

                                @endphp


                                <span
                                    class="mt-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">

                                    {{ $statusText }}

                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21l9-4.5v-9M3 7.5 12 12l9-4.5M12 12v9" />

                            </svg>

                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Chưa có đơn hàng
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Các đơn hàng phát sinh từ tài khoản của bạn sẽ xuất hiện tại đây.
                        </p>

                        <a href="{{ route('products.index') }}"
                            class="mt-5 inline-flex rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800">

                            Khám phá sản phẩm

                        </a>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            @include('layouts.pagination', ['paginator' => $orders]);

        </div>

    </div>

@endsection
