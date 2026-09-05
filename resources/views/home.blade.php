@extends('layouts.frontend')


@section('title', 'Khám phá sản phẩm | TikTok Affiliate')

@section('meta_description', 'Khám phá sản phẩm nổi bật, sản phẩm mới và các danh mục được chọn lọc trên TikTok
    Affiliate.')


@section('content')

    <div class="bg-white">


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden bg-gray-950">

            <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">

                <div class="max-w-3xl">

                    <p class="text-sm font-semibold uppercase tracking-widest text-gray-400">
                        TikTok Affiliate
                    </p>


                    <h1 class="mt-5 text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">

                        Khám phá sản phẩm
                        <span class="text-gray-400">
                            bạn đang tìm kiếm.
                        </span>

                    </h1>


                    <p class="mt-6 max-w-2xl text-base leading-8 text-gray-400 sm:text-lg">
                        Khám phá những sản phẩm được chọn lọc,
                        tìm kiếm nhanh chóng và xem sản phẩm trực tiếp
                        trên TikTok Shop.
                    </p>


                    {{-- Search --}}
                    <form action="{{ route('search') }}" method="GET" class="mt-8 max-w-2xl">

                        <div class="flex flex-col gap-3 sm:flex-row">

                            <input type="search" name="q" placeholder="Bạn đang tìm sản phẩm gì?"
                                class="min-w-0 flex-1 rounded-xl border border-gray-700 bg-white px-5 py-4 text-sm text-gray-900 outline-none focus:border-white">

                            <button type="submit"
                                class="rounded-xl bg-white px-7 py-4 text-sm font-bold text-gray-900 transition hover:bg-gray-200">
                                Tìm kiếm
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- CATEGORIES --}}
        {{-- ========================================================= --}}

        @if ($categories->count())

            <section class="py-16 sm:py-20">

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <div class="flex items-end justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Khám phá
                            </p>

                            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                Danh mục sản phẩm
                            </h2>

                        </div>


                        <a href="{{ route('categories.index') }}"
                            class="hidden text-sm font-semibold text-gray-600 hover:text-black sm:block">
                            Xem tất cả →
                        </a>

                    </div>


                    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-8">

                        @foreach ($categories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" class="group text-center">

                                <div class="mx-auto aspect-square overflow-hidden rounded-2xl bg-gray-100">

                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="flex h-full items-center justify-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4-4 3 3 5-6 4 5" />
                                            </svg>

                                        </div>
                                    @endif

                                </div>


                                <h3 class="mt-3 line-clamp-2 text-sm font-semibold text-gray-800">
                                    {{ $category->name }}
                                </h3>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $category->products_count }} sản phẩm
                                </p>

                            </a>
                        @endforeach

                    </div>

                </div>

            </section>

        @endif


        {{-- ========================================================= --}}
        {{-- FEATURED PRODUCTS --}}
        {{-- ========================================================= --}}

        @if ($featuredProducts->count())

            <section class="bg-gray-50 py-16 sm:py-20">

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <div class="flex items-end justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Được chọn lọc
                            </p>

                            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                Sản phẩm nổi bật
                            </h2>

                        </div>


                        <a href="{{ route('products.index') }}"
                            class="text-sm font-semibold text-gray-600 hover:text-black">
                            Xem tất cả →
                        </a>

                    </div>


                    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($featuredProducts as $product)
                            <x-product-card :product="$product" />
                        @endforeach

                    </div>

                </div>

            </section>

        @endif


        {{-- ========================================================= --}}
        {{-- LATEST PRODUCTS --}}
        {{-- ========================================================= --}}

        @if ($latestProducts->count())

            <section class="py-16 sm:py-20">

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <div class="flex items-end justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Cập nhật mới
                            </p>

                            <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                Sản phẩm mới
                            </h2>

                        </div>


                        <a href="{{ route('products.index') }}"
                            class="text-sm font-semibold text-gray-600 hover:text-black">
                            Xem tất cả →
                        </a>

                    </div>


                    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($latestProducts as $product)
                            <x-product-card :product="$product" />
                        @endforeach

                    </div>

                </div>

            </section>

        @endif


        {{-- ========================================================= --}}
        {{-- CTA --}}
        {{-- ========================================================= --}}

        <section class="border-t border-gray-200 bg-gray-950">

            <div class="mx-auto max-w-7xl px-4 py-16 text-center sm:px-6 lg:px-8">

                <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                    Đang tìm kiếm một sản phẩm cụ thể?
                </h2>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-gray-400">
                    Sử dụng công cụ tìm kiếm để nhanh chóng tìm
                    sản phẩm phù hợp với nhu cầu của bạn.
                </p>

                <a href="{{ route('search') }}"
                    class="mt-7 inline-flex rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-gray-900 transition hover:bg-gray-200">
                    Bắt đầu tìm kiếm
                </a>

            </div>

        </section>


    </div>

@endsection
