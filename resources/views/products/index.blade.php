@extends('layouts.frontend')

@section('title', 'Sản phẩm | TikTok Affiliate')

@section('meta_description', 'Khám phá các sản phẩm nổi bật và sản phẩm mới nhất trên TikTok Affiliate.')

@section('content')

    <section class="py-12">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- Header --}}
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

                <div>

                    <div class="text-sm text-gray-500">
                        Trang chủ / Sản phẩm
                    </div>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight">
                        Tất cả sản phẩm
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Khám phá những sản phẩm đang được quan tâm.
                    </p>

                </div>


                {{-- Sort --}}
                <form method="GET">

                    <select name="sort" onchange="this.form.submit()"
                        class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-gray-400">

                        <option value="">
                            Mới nhất
                        </option>

                        <option value="popular" @selected(request('sort') === 'popular')>
                            Phổ biến nhất
                        </option>

                        <option value="price_asc" @selected(request('sort') === 'price_asc')>
                            Giá thấp → cao
                        </option>

                        <option value="price_desc" @selected(request('sort') === 'price_desc')>
                            Giá cao → thấp
                        </option>

                    </select>

                </form>

            </div>


            {{-- Product Grid --}}
            @if ($products->count())

                <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach

                </div>


                {{-- Pagination --}}
                @include('layouts.pagination', ['paginator' => $products])
            @else
                <div class="py-24 text-center">

                    <div class="text-5xl">
                        📦
                    </div>

                    <h2 class="mt-4 text-xl font-semibold">
                        Chưa có sản phẩm
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Hiện tại chưa có sản phẩm nào được hiển thị.
                    </p>

                </div>

            @endif

        </div>

    </section>

@endsection
