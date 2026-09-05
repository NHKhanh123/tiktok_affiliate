@extends('layouts.frontend')

@php

    $price = $product->sale_price ?? $product->price;

    $hasSale = $product->sale_price !== null && $product->price !== null && $product->sale_price < $product->price;

    $discount = $hasSale ? round((($product->price - $product->sale_price) / $product->price) * 100) : null;

    $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
@endphp


@section('title', $product->name . ' | TikTok Affiliate')

@section('meta_description', Str::limit(strip_tags($product->description ?? 'Khám phá sản phẩm trên TikTok Affiliate.'),
    160))


@section('seo')

    {{-- Canonical --}}
    <link rel="canonical" href="{{ route('products.show', $product->slug) }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $product->name }}">

    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description ?? ''), 160) }}">

    <meta property="og:type" content="product">

    <meta property="og:url" content="{{ route('products.show', $product->slug) }}">

    @if ($primaryImage)
        <meta property="og:image" content="{{ asset('storage/' . $primaryImage->image_url) }}">
    @endif

    {{-- Product Schema --}}
    @php
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => strip_tags($product->description ?? ''),
            'url' => route('products.show', $product->slug),
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'VND',
                'price' => number_format($price, 0, '.', ''),
                'availability' => 'https://schema.org/InStock',
                'url' => route('products.show', $product->slug),
            ],
        ];

        if ($primaryImage) {
            $schema['image'] = [asset('storage/' . $primaryImage->image_url)];
        }
    @endphp

    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

@endsection


@section('content')

    <div class="bg-white">

        {{-- Breadcrumb --}}
        <div class="border-b border-gray-100">

            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

                <nav class="flex flex-wrap items-center gap-2 text-sm">

                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-900">
                        Trang chủ
                    </a>

                    <span class="text-gray-300">
                        /
                    </span>

                    <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-gray-900">
                        Sản phẩm
                    </a>

                    @if ($product->category)
                        <span class="text-gray-300">
                            /
                        </span>

                        <a href="{{ route('categories.show', $product->category->slug) }}"
                            class="text-gray-400 hover:text-gray-900">
                            {{ $product->category->name }}
                        </a>
                    @endif

                    <span class="text-gray-300">
                        /
                    </span>

                    <span class="max-w-[250px] truncate font-medium text-gray-700">
                        {{ $product->name }}
                    </span>

                </nav>

            </div>

        </div>

        @include('layouts.noice');

        {{-- Product --}}
        <section class="py-10 sm:py-14">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid gap-10 lg:grid-cols-2 lg:gap-16">


                    {{-- ================================================== --}}
                    {{-- IMAGE GALLERY --}}
                    {{-- ================================================== --}}

                    <div>

                        <div id="main-product-image" class="relative aspect-square overflow-hidden rounded-3xl bg-gray-100">

                            @if ($primaryImage)
                                <img id="mainImage" src="{{ asset('storage/' . $primaryImage->image_url) }}"
                                    alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 16.5 8.5 11l4 4 3-3 5.5 5.5M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10Z" />
                                    </svg>

                                </div>
                            @endif


                            {{-- Sale --}}
                            @if ($discount)
                                <span
                                    class="absolute left-4 top-4 rounded-xl bg-black px-3 py-1.5 text-sm font-bold text-white">
                                    -{{ $discount }}%
                                </span>
                            @endif


                            {{-- Featured --}}
                            @if ($product->featured)
                                <span
                                    class="absolute right-4 top-4 rounded-xl bg-white/95 px-3 py-1.5 text-sm font-semibold text-gray-900 shadow-sm">
                                    Nổi bật
                                </span>
                            @endif

                        </div>


                        {{-- Thumbnails --}}
                        @if ($product->images->count() > 1)

                            <div class="mt-4 grid grid-cols-5 gap-3">

                                @foreach ($product->images as $image)
                                    <button type="button"
                                        onclick="changeProductImage('{{ asset('storage/' . $image->image) }}')"
                                        class="group overflow-hidden rounded-xl border border-gray-200 bg-gray-100">

                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                            class="aspect-square w-full object-cover transition group-hover:scale-105">

                                    </button>
                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- ================================================== --}}
                    {{-- PRODUCT INFORMATION --}}
                    {{-- ================================================== --}}

                    <div class="flex flex-col justify-center">

                        {{-- Category --}}
                        @if ($product->category)
                            <a href="{{ route('categories.show', $product->category->slug) }}"
                                class="text-sm font-semibold text-gray-500 hover:text-black">
                                {{ $product->category->name }}
                            </a>
                        @endif


                        {{-- Name --}}
                        <h1 class="mt-3 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            {{ $product->name }}
                        </h1>


                        {{-- Rating placeholder --}}
                        <div class="mt-4 flex items-center gap-3">

                            <div class="flex items-center gap-1 text-sm">
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                            </div>

                            <span class="text-sm text-gray-400">
                                Sản phẩm nổi bật
                            </span>

                        </div>


                        {{-- Price --}}
                        <div class="mt-6 flex flex-wrap items-end gap-3">

                            <span class="text-3xl font-bold text-gray-900">
                                {{ number_format($price, 0, ',', '.') }}₫
                            </span>

                            @if ($hasSale)
                                <span class="text-lg text-gray-400 line-through">
                                    {{ number_format($product->price, 0, ',', '.') }}₫
                                </span>
                            @endif

                            @if ($discount)
                                <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-sm font-semibold text-gray-700">
                                    Tiết kiệm {{ $discount }}%
                                </span>
                            @endif

                        </div>


                        {{-- Description --}}
                        @if ($product->description)
                            <div class="mt-8 border-t border-gray-100 pt-8">

                                <h2 class="text-base font-semibold">
                                    Thông tin sản phẩm
                                </h2>

                                <div class="mt-3 whitespace-pre-line text-sm leading-7 text-gray-600">
                                    {{ $product->description }}
                                </div>

                            </div>
                        @endif


                        {{-- Affiliate CTA --}}
                        <div class="mt-8">

                            @if ($affiliateStatus === 'active')
                                {{-- ====================================================== --}}
                                {{-- CÓ AFFILIATE LINK ĐANG HOẠT ĐỘNG --}}
                                {{-- ====================================================== --}}

                                <a href="{{ route('affiliate.redirect', $product->slug) }}" target="_blank"
                                    rel="nofollow sponsored noopener"
                                    class="flex w-full items-center justify-center gap-3 rounded-2xl bg-black px-6 py-4 text-base font-semibold text-white transition hover:bg-gray-800">

                                    <span>
                                        🛍️
                                    </span>

                                    <span>
                                        Xem sản phẩm trên TikTok Shop
                                    </span>

                                    <span>
                                        ↗
                                    </span>

                                </a>

                                <p class="mt-3 text-center text-xs text-gray-400">
                                    Bạn sẽ được chuyển đến TikTok Shop để xem sản phẩm.
                                </p>
                            @elseif ($affiliateStatus === 'none')
                                {{-- ====================================================== --}}
                                {{-- CHƯA CÓ AFFILIATE LINK --}}
                                {{-- ====================================================== --}}

                                <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white shadow-sm">
                                            <span>ℹ️</span>
                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                Sản phẩm chưa có liên kết mua hàng
                                            </p>

                                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                                Sản phẩm hiện chưa có liên kết mua hàng.
                                                Vui lòng quay lại sau.
                                            </p>

                                        </div>

                                    </div>

                                </div>
                            @elseif ($affiliateStatus === 'disabled')
                                {{-- ====================================================== --}}
                                {{-- AFFILIATE LINK ĐÃ BỊ TẮT --}}
                                {{-- ====================================================== --}}

                                <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white shadow-sm">
                                            <span>⏸️</span>
                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                Liên kết mua hàng đang tạm thời không khả dụng
                                            </p>

                                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                                Liên kết mua hàng của sản phẩm hiện đang tạm thời không khả dụng.
                                                Vui lòng quay lại sau.
                                            </p>

                                        </div>

                                    </div>

                                </div>
                            @else
                                {{-- ====================================================== --}}
                                {{-- AFFILIATE LINK KHÔNG HỢP LỆ --}}
                                {{-- ====================================================== --}}

                                <div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white shadow-sm">
                                            <span>⚠️</span>
                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                Liên kết mua hàng chưa sẵn sàng
                                            </p>

                                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                                Liên kết mua hàng của sản phẩm hiện chưa sẵn sàng.
                                                Vui lòng quay lại sau.
                                            </p>

                                        </div>

                                    </div>

                                </div>
                            @endif

                        </div>


                        {{-- Trust information --}}
                        <div class="mt-6 grid grid-cols-3 divide-x rounded-2xl border border-gray-200 bg-gray-50">

                            <div class="p-4 text-center">

                                <div class="text-lg">
                                    ✓
                                </div>

                                <p class="mt-1 text-xs font-medium text-gray-700">
                                    Sản phẩm được chọn lọc
                                </p>

                            </div>


                            <div class="p-4 text-center">

                                <div class="text-lg">
                                    🔗
                                </div>

                                <p class="mt-1 text-xs font-medium text-gray-700">
                                    Mua trên TikTok Shop
                                </p>

                            </div>


                            <div class="p-4 text-center">

                                <div class="text-lg">
                                    ⚡
                                </div>

                                <p class="mt-1 text-xs font-medium text-gray-700">
                                    Cập nhật liên tục
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================== --}}
        {{-- RELATED PRODUCTS --}}
        {{-- ========================================================== --}}

        @if ($relatedProducts->count())

            <section class="border-t border-gray-200 bg-gray-50 py-16">

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <div class="flex items-end justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Có thể bạn quan tâm
                            </p>

                            <h2 class="mt-1 text-2xl font-bold tracking-tight">
                                Sản phẩm liên quan
                            </h2>

                        </div>

                        <a href="{{ route('products.index') }}"
                            class="text-sm font-semibold text-gray-600 hover:text-black">
                            Xem tất cả →
                        </a>

                    </div>


                    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($relatedProducts as $relatedProduct)
                            <x-product-card :product="$relatedProduct" />
                        @endforeach

                    </div>

                </div>

            </section>

        @endif

    </div>


    {{-- Gallery Javascript --}}
    <script>
        function changeProductImage(imageUrl) {
            const mainImage =
                document.getElementById('mainImage');

            if (!mainImage) {
                return;
            }

            mainImage.src = imageUrl;
        }
    </script>

@endsection
