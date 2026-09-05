@extends('layouts.frontend')

@section('title', $category->name . ' | TikTok Affiliate')

@section('meta_description', Str::limit(strip_tags($category->description ?? 'Khám phá sản phẩm thuộc danh mục ' .
    $category->name . '.'), 160))

@section('content')

    <div class="bg-gray-50">

        {{-- Breadcrumb --}}
        <div class="border-b border-gray-200 bg-white">

            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

                <nav class="flex items-center gap-2 text-sm">

                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-900">
                        Trang chủ
                    </a>

                    <span class="text-gray-300">/</span>

                    <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-gray-900">
                        Danh mục
                    </a>

                    <span class="text-gray-300">/</span>

                    <span class="font-medium text-gray-700">
                        {{ $category->name }}
                    </span>

                </nav>

            </div>

        </div>


        {{-- Category header --}}
        <section class="bg-white py-10 sm:py-14">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col gap-8 md:flex-row md:items-center">

                    @if ($category->image)
                        <div class="h-32 w-32 shrink-0 overflow-hidden rounded-2xl bg-gray-100 sm:h-40 sm:w-40">

                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="h-full w-full object-cover">

                        </div>
                    @endif

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Danh mục sản phẩm
                        </p>

                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            {{ $category->name }}
                        </h1>

                        @if ($category->description)
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-gray-500">
                                {{ $category->description }}
                            </p>
                        @endif

                        <p class="mt-4 text-sm text-gray-400">
                            {{ $products->total() }} sản phẩm
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- Products --}}
        <section class="py-12">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                @if ($products->count())

                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach

                    </div>


                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="rounded-2xl border border-gray-200 bg-white px-6 py-16 text-center">

                        <h2 class="text-lg font-semibold text-gray-900">
                            Chưa có sản phẩm
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Danh mục này hiện chưa có sản phẩm nào.
                        </p>

                        <a href="{{ route('products.index') }}"
                            class="mt-6 inline-flex rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800">
                            Xem tất cả sản phẩm
                        </a>

                    </div>

                @endif

            </div>

        </section>

    </div>

@endsection
