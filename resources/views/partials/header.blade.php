<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/95 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-black text-white font-bold">
                    TA
                </div>

                <div class="hidden sm:block">
                    <div class="text-lg font-bold tracking-tight">
                        TikTok Affiliate
                    </div>

                    <div class="text-xs text-gray-500">
                        Khám phá sản phẩm hay
                    </div>
                </div>
            </a>

            {{-- Navigation --}}
            <nav class="hidden lg:flex items-center gap-7">

                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-black transition">
                    Trang chủ
                </a>

                <a href="{{ route('products.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-black transition">
                    Sản phẩm
                </a>

                <a href="{{ route('categories.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-black transition">
                    Danh mục
                </a>

                <a href="#featured" class="text-sm font-medium text-gray-700 hover:text-black transition">
                    Nổi bật
                </a>

            </nav>


            {{-- Search --}}
            <div class="hidden md:block flex-1 max-w-md
                <form action="{{ route('search') }}" method="GET" class="hidden md:block md:w-72 lg:w-96">

                    <div class="relative">

                        <input type="search" name="q" value="{{ request('q') }}"
                            placeholder="Tìm kiếm sản phẩm..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pr-12 text-sm outline-none transition focus:border-gray-900 focus:bg-white">

                        <button type="submit"
                            class="absolute right-0 top-0 flex h-full w-12 items-center justify-center text-gray-400 hover:text-gray-900"
                            aria-label="Tìm kiếm">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>

                        </button>

                    </div>

                </form>

            </div>


            {{-- Right actions --}}
            <div class="flex items-center gap-2">

                {{-- Mobile search --}}
                <a href="{{ route('search') }}"
                    class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-gray-100 md:hidden"
                    aria-label="Tìm kiếm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                    </svg>
                </a>

                {{-- Menu mobile --}}
                <button type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-gray-100 lg:hidden"
                    aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>

        </div>

    </div>
</header>
