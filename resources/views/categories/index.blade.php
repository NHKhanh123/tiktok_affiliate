@extends('layouts.frontend')

@section('title', 'Danh mục sản phẩm | TikTok Affiliate')

@section('meta_description', 'Khám phá các danh mục sản phẩm được chọn lọc trên TikTok Affiliate.')

@section('content')

    <div class="bg-gray-50">

        {{-- Header --}}
        <section class="border-b border-gray-200 bg-white">

            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                <p class="text-sm font-medium text-gray-500">
                    Khám phá
                </p>

                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Danh mục sản phẩm
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Khám phá sản phẩm theo từng danh mục và tìm những sản phẩm phù hợp với nhu cầu của bạn.
                </p>

            </div>

        </section>


        {{-- Categories --}}
        <section class="py-12">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                @if ($categories->count())

                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($categories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}"
                                class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:shadow-lg">

                                {{-- Image --}}
                                <div class="aspect-[4/3] overflow-hidden bg-gray-100">

                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="flex h-full items-center justify-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4-4 3 3 5-6 4 5M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>

                                        </div>
                                    @endif

                                </div>


                                {{-- Information --}}
                                <div class="p-5">

                                    <h2 class="font-semibold text-gray-900 group-hover:text-black">
                                        {{ $category->name }}
                                    </h2>

                                    @if ($category->description)
                                        <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                                            {{ $category->description }}
                                        </p>
                                    @endif

                                    <div class="mt-4 flex items-center justify-between">

                                        <span class="text-xs text-gray-400">
                                            {{ $category->products_count }} sản phẩm
                                        </span>

                                        <span class="text-sm font-semibold text-gray-700">
                                            Xem →
                                        </span>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>


                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="rounded-2xl border border-gray-200 bg-white px-6 py-16 text-center">

                        <h2 class="text-lg font-semibold text-gray-900">
                            Chưa có danh mục
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Hiện tại chưa có danh mục sản phẩm nào được công khai.
                        </p>

                    </div>

                @endif

            </div>

        </section>

    </div>

@endsection
