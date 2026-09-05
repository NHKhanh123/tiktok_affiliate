@extends('layouts.frontend')

@section('title')
    @if ($keyword)
        Tìm kiếm "{{ $keyword }}" | TikTok Affiliate
    @else
        Tìm kiếm sản phẩm | TikTok Affiliate
    @endif
@endsection

@section('meta_description')
    @if ($keyword)
        Kết quả tìm kiếm sản phẩm "{{ $keyword }}" trên TikTok Affiliate.
    @else
        Tìm kiếm sản phẩm trên TikTok Affiliate.
    @endif
@endsection


@section('content')

    <div class="bg-gray-50">

        {{-- Header --}}
        <section class="border-b border-gray-200 bg-white">

            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

                <p class="text-sm font-medium text-gray-500">
                    Tìm kiếm
                </p>

                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                    @if ($keyword)
                        Kết quả cho "{{ $keyword }}"
                    @else
                        Tìm kiếm sản phẩm
                    @endif
                </h1>


                {{-- Search form --}}
                <form action="{{ route('search') }}" method="GET" class="mt-6 max-w-2xl">

                    <div class="relative">

                        <input type="search" name="q" value="{{ $keyword }}"
                            placeholder="Bạn đang tìm sản phẩm gì?"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-5 py-4 pr-32 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">

                        <button type="submit"
                            class="absolute right-2 top-2 rounded-xl bg-black px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                            Tìm kiếm
                        </button>

                    </div>

                </form>

            </div>

        </section>


        {{-- Results --}}
        <section class="py-12">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                @if ($keyword)
                    <div class="mb-6 flex items-center justify-between">

                        <p class="text-sm text-gray-500">

                            Tìm thấy
                            <span class="font-semibold text-gray-900">
                                {{ $products->total() }}
                            </span>
                            sản phẩm

                        </p>

                    </div>
                @endif


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
                    <div class="rounded-2xl border border-gray-200 bg-white px-6 py-20 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>

                        </div>


                        <h2 class="mt-5 text-lg font-semibold text-gray-900">
                            Không tìm thấy sản phẩm
                        </h2>


                        @if ($keyword)
                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                                Không tìm thấy sản phẩm phù hợp với từ khóa
                                "<span class="font-medium text-gray-700">{{ $keyword }}</span>".
                                Hãy thử tìm kiếm bằng từ khóa khác.
                            </p>
                        @else
                            <p class="mt-2 text-sm text-gray-500">
                                Hãy nhập từ khóa để tìm kiếm sản phẩm.
                            </p>
                        @endif


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
