<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'TikTok Affiliate')
    </title>

    <meta name="description" content="@yield('meta_description', 'Khám phá sản phẩm được chọn lọc trên TikTok Affiliate.')">

    <meta name="robots" content="@yield('robots', 'index,follow')">

    @yield('seo')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="min-h-screen bg-white text-gray-900 antialiased">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white/95 backdrop-blur">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex h-16 items-center justify-between gap-6">


                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="shrink-0">

                    <span class="text-xl font-black tracking-tight text-gray-900">
                        TikTok
                    </span>

                    <span class="text-xl font-black tracking-tight text-gray-500">
                        Affiliate
                    </span>

                </a>


                {{-- DESKTOP NAV --}}
                <nav class="hidden items-center gap-7 lg:flex">

                    <a href="{{ route('home') }}"
                        class="text-sm font-medium transition
                        {{ request()->routeIs('home') ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                        Trang chủ
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="text-sm font-medium transition
                        {{ request()->routeIs('products.*') ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                        Sản phẩm
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="text-sm font-medium transition
                        {{ request()->routeIs('categories.*') ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                        Danh mục
                    </a>

                </nav>


                {{-- SEARCH --}}
                <form action="{{ route('search') }}" method="GET" class="hidden flex-1 md:block md:max-w-md">

                    <div class="relative">

                        <input type="search" name="q" value="{{ request('q') }}"
                            placeholder="Tìm kiếm sản phẩm..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pr-11 text-sm outline-none transition focus:border-gray-900 focus:bg-white">

                        <button type="submit" aria-label="Tìm kiếm"
                            class="absolute right-0 top-0 flex h-full w-11 items-center justify-center text-gray-400 hover:text-black">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>

                        </button>

                    </div>

                </form>


                {{-- MOBILE MENU BUTTON --}}
                <button type="button" onclick="toggleMobileMenu()"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-700 lg:hidden"
                    aria-label="Mở menu">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                </button>

            </div>


            {{-- MOBILE MENU --}}
            <div id="mobileMenu" class="hidden border-t border-gray-100 py-4 lg:hidden">

                <nav class="space-y-1">

                    <a href="{{ route('home') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-gray-50">
                        Trang chủ
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-gray-50">
                        Sản phẩm
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-gray-50">
                        Danh mục
                    </a>

                </nav>


                {{-- Mobile search --}}
                <form action="{{ route('search') }}" method="GET" class="mt-4">

                    <input type="search" name="q" placeholder="Tìm kiếm sản phẩm..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-gray-900">

                </form>

            </div>

        </div>

    </header>


    {{-- ========================================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div class="border-b border-gray-200 bg-gray-50">

            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">

                <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700">
                    {{ session('success') }}
                </div>

            </div>

        </div>
    @endif


    @if (session('error'))
        <div class="border-b border-gray-200 bg-gray-50">

            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">

                <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700">
                    {{ session('error') }}
                </div>

            </div>

        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main>

        @yield('content')

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="border-t border-gray-200 bg-gray-950 text-gray-300">

        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">


                {{-- ABOUT --}}
                <div>

                    <a href="{{ route('home') }}" class="text-xl font-black text-white">
                        TikTok Affiliate
                    </a>

                    <p class="mt-4 max-w-sm text-sm leading-7 text-gray-400">
                        Khám phá những sản phẩm được chọn lọc và tìm
                        kiếm sản phẩm phù hợp trên TikTok Shop.
                    </p>

                </div>


                {{-- NAVIGATION --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Điều hướng
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        <li>
                            <a href="{{ route('home') }}" class="hover:text-white">
                                Trang chủ
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('products.index') }}" class="hover:text-white">
                                Tất cả sản phẩm
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('categories.index') }}" class="hover:text-white">
                                Danh mục
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('search') }}" class="hover:text-white">
                                Tìm kiếm
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- CATEGORIES --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Khám phá
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        @foreach ($footerCategories ?? [] as $category)
                            <li>

                                <a href="{{ route('categories.show', $category->slug) }}" class="hover:text-white">
                                    {{ $category->name }}
                                </a>

                            </li>
                        @endforeach

                    </ul>

                </div>


                {{-- INFORMATION --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Thông tin
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        <li>
                            <span class="text-gray-400">
                                Sản phẩm được chọn lọc từ TikTok Shop.
                            </span>
                        </li>

                        <li>
                            <span class="text-gray-400">
                                Giá và tình trạng sản phẩm có thể thay đổi.
                            </span>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <div class="mt-12 border-t border-gray-800 pt-6">

                <div class="flex flex-col gap-3 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between">

                    <p>
                        © {{ date('Y') }} TikTok Affiliate. All rights reserved.
                    </p>

                    <p>
                        Nội dung và thông tin sản phẩm có thể thay đổi theo TikTok Shop.
                    </p>

                </div>

            </div>

        </div>

    </footer>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        function toggleMobileMenu() {

            const menu = document.getElementById('mobileMenu');

            if (!menu) {
                return;
            }

            menu.classList.toggle('hidden');
        }
    </script>

</body>

</html>
