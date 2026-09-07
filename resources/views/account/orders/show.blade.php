@extends('layouts.frontend')

@section('title', 'Chi tiết đơn hàng')

@section('content')

    <div class="bg-gray-50 py-10">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <a href="{{ route('account.orders.index') }}"
                class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-black">

                ← Quay lại đơn hàng

            </a>


            {{-- Header --}}
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-900">
                    Chi tiết đơn hàng
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Mã đơn: {{ $order->external_order_id }}
                </p>

            </div>


            {{-- Order --}}
            <div class="space-y-6">


                {{-- Product --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6">

                    <h2 class="mb-5 font-semibold text-gray-900">
                        Sản phẩm
                    </h2>


                    @if ($order->product)

                        <div class="flex items-center gap-4">

                            @php
                                $image = $order->product->images->first() ?? null;
                            @endphp

                            <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-gray-100">

                                @if ($image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $order->product->name }}"
                                        class="h-full w-full object-cover">
                                @endif

                            </div>


                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    {{ $order->product->name }}
                                </h3>

                                @if ($order->product->slug)
                                    <a href="{{ route('products.show', $order->product->slug) }}"
                                        class="mt-1 inline-block text-sm text-gray-500 hover:text-black">

                                        Xem sản phẩm →

                                    </a>
                                @endif

                            </div>

                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Sản phẩm không còn tồn tại.
                        </p>

                    @endif

                </div>


                {{-- Information --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6">

                    <h2 class="mb-5 font-semibold text-gray-900">
                        Thông tin đơn hàng
                    </h2>

                    <dl class="divide-y divide-gray-100">


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-sm text-gray-500">
                                Mã đơn hàng
                            </dt>

                            <dd class="text-sm font-medium text-gray-900">
                                {{ $order->external_order_id }}
                            </dd>

                        </div>


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-sm text-gray-500">
                                Giá trị đơn hàng
                            </dt>

                            <dd class="text-sm font-semibold text-gray-900">

                                {{ number_format($order->order_amount, 0, ',', '.') }}
                                {{ $order->currency }}

                            </dd>

                        </div>


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-sm text-gray-500">
                                Trạng thái
                            </dt>

                            <dd class="text-sm font-semibold">

                                @php

                                    $status = $order->order_status;

                                    $statusClass = match ($status) {
                                        'completed' => 'text-green-600',

                                        'cancelled', 'refunded' => 'text-red-600',

                                        default => 'text-yellow-600',
                                    };

                                    $statusText = match ($status) {
                                        'completed' => 'Hoàn thành',

                                        'cancelled' => 'Đã hủy',

                                        'refunded' => 'Đã hoàn tiền',

                                        'pending' => 'Chờ xử lý',

                                        default => ucfirst($status),
                                    };

                                @endphp

                                <span class="{{ $statusClass }}">
                                    {{ $statusText }}
                                </span>

                            </dd>

                        </div>


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-sm text-gray-500">
                                Thời gian đặt
                            </dt>

                            <dd class="text-sm text-gray-900">

                                {{ $order->ordered_at?->format('d/m/Y H:i') ?? '—' }}

                            </dd>

                        </div>


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-sm text-gray-500">
                                Hoàn thành
                            </dt>

                            <dd class="text-sm text-gray-900">

                                {{ $order->completed_at?->format('d/m/Y H:i') ?? '—' }}

                            </dd>

                        </div>


                    </dl>

                </div>

            </div>

        </div>

    </div>

@endsection
