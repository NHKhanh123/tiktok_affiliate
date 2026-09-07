<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/95 backdrop-blur">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between gap-4">

            {{-- ================================================= --}}
            {{-- LOGO --}}
            {{-- ================================================= --}}

            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-black font-bold text-white">
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


            {{-- ================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ================================================= --}}

            <nav class="hidden items-center gap-6 lg:flex">

                <a href="{{ route('home') }}"
                    class="text-sm font-medium transition
                    {{ request()->routeIs('home') ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                    Trang chủ
                </a>

                <a href="{{ route('products.index') }}"
                    class="text-sm font-medium transition
                    {{ request()->routeIs('products.*') ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                    Sản phẩm
                </a>

                <a href="{{ route('categories.index') }}"
                    class="text-sm font-medium transition
                    {{ request()->routeIs('categories.*') ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                    Danh mục
                </a>

                {{-- <a href="{{ route('home') }}#featured"
                    class="text-sm font-medium text-gray-700 transition hover:text-black">
                    Nổi bật
                </a> --}}

            </nav>


            {{-- ================================================= --}}
            {{-- SEARCH --}}
            {{-- ================================================= --}}

            <div class="hidden flex-1 md:block md:max-w-md">

                <form action="{{ route('search') }}" method="GET" class="w-full">

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


            {{-- ================================================= --}}
            {{-- RIGHT ACTIONS --}}
            {{-- ================================================= --}}

            <div class="flex shrink-0 items-center gap-2">


                {{-- ================================================= --}}
                {{-- DESKTOP AUTH / USER DROPDOWN --}}
                {{-- ================================================= --}}

                @guest

                    <div class="hidden items-center gap-2 sm:flex">

                        <button type="button" onclick="openLoginModal()"
                            class="rounded-xl px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 hover:text-gray-900">
                            Đăng nhập
                        </button>

                        <button type="button" onclick="openRegisterModal()"
                            class="rounded-xl bg-black px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                            Đăng ký
                        </button>

                    </div>
                @else
                    {{-- User button --}}
                    <div class="relative hidden sm:block">

                        <button type="button" onclick="toggleUserMenu()"
                            class="flex items-center gap-3 rounded-xl p-1.5 transition hover:bg-gray-100">

                            {{-- User info --}}
                            <div class="text-right">

                                <div class="max-w-[140px] truncate text-sm font-semibold text-gray-900">
                                    {{ auth()->user()->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    Tài khoản
                                </div>

                            </div>

                            {{-- Avatar --}}
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            {{-- Arrow --}}
                            <svg id="userMenuArrow" xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-gray-500 transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />

                            </svg>

                        </button>


                        {{-- ================================================= --}}
                        {{-- USER DROPDOWN --}}
                        {{-- ================================================= --}}

                        <div id="userMenu"
                            class="absolute right-0 top-full z-50 mt-2 hidden w-64 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl">

                            {{-- User header --}}
                            <div class="border-b border-gray-100 px-4 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Avatar --}}
                                    <div
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-bold text-white">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>

                                    {{-- Name + email --}}
                                    <div class="min-w-0">

                                        <div class="truncate text-sm font-semibold text-gray-900">
                                            {{ auth()->user()->name }}
                                        </div>

                                        <div class="truncate text-xs text-gray-500">
                                            {{ auth()->user()->email }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Menu --}}
                            <div class="p-2">

                                {{-- Thông tin tài khoản --}}
                                <a href="{{ route('profile') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-black">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />

                                    </svg>

                                    <span>
                                        Thông tin tài khoản
                                    </span>

                                </a>


                                {{-- Đơn hàng --}}
                                <a href="{{ route('account.orders.index') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-black">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21l9-4.5v-9M3 7.5 12 12l9-4.5M12 12v9" />

                                    </svg>

                                    <span>
                                        Đơn hàng
                                    </span>

                                </a>

                                {{-- Divider --}}
                                <div class="my-2 border-t border-gray-100"></div>


                                {{-- Logout --}}
                                <form action="{{ route('logout') }}" method="POST">

                                    @csrf

                                    <button type="submit"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 15l3-3m0 0-3-3m3 3H3" />

                                        </svg>

                                        <span>
                                            Đăng xuất
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endguest


                {{-- --------------------------------------------- --}}
                {{-- MOBILE SEARCH --}}
                {{-- --------------------------------------------- --}}

                <a href="{{ route('search') }}"
                    class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-gray-100 md:hidden"
                    aria-label="Tìm kiếm">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                    </svg>

                </a>


                {{-- --------------------------------------------- --}}
                {{-- MOBILE MENU --}}
                {{-- --------------------------------------------- --}}

                <button type="button" onclick="toggleMobileMenu()"
                    class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-gray-100 lg:hidden"
                    aria-label="Menu">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                </button>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- MOBILE MENU --}}
        {{-- ================================================= --}}

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

                <a href="{{ route('home') }}#featured"
                    class="block rounded-xl px-4 py-3 text-sm font-medium hover:bg-gray-50">
                    Nổi bật
                </a>

            </nav>


            {{-- Mobile Auth --}}

            @guest

                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-gray-100 pt-4">

                    <a href="{{ route('login') }}"
                        class="rounded-xl border border-gray-200 px-4 py-3 text-center text-sm font-semibold text-gray-700">
                        Đăng nhập
                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-black px-4 py-3 text-center text-sm font-semibold text-white">
                        Đăng ký
                    </a>

                </div>
            @else
                <div class="mt-4 border-t border-gray-100 pt-4">

                    <div class="flex items-center gap-3 px-4">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-black text-sm font-bold text-white">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                        <div>

                            <div class="text-sm font-semibold text-gray-900">
                                {{ auth()->user()->name }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </div>

                        </div>

                    </div>


                    {{-- Logout --}}

                    <form action="{{ route('logout') }}" method="POST" class="mt-3">

                        @csrf

                        <button type="submit"
                            class="w-full rounded-xl px-4 py-3 text-left text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Đăng xuất
                        </button>

                    </form>

                </div>

            @endguest


            {{-- Mobile Search --}}

            <form action="{{ route('search') }}" method="GET" class="mt-4">

                <input type="search" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm sản phẩm..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-gray-900">

            </form>

        </div>

    </div>

</header>


<script>
    function toggleMobileMenu() {

        const menu = document.getElementById('mobileMenu');

        if (!menu) {
            return;
        }

        menu.classList.toggle('hidden');

    }

    function toggleUserMenu() {

        const menu = document.getElementById('userMenu');
        const arrow = document.getElementById('userMenuArrow');

        if (!menu) {
            return;
        }

        menu.classList.toggle('hidden');

        if (arrow) {
            arrow.classList.toggle('rotate-180');
        }
    }


    // Click ra ngoài dropdown
    document.addEventListener('click', function(event) {

        const menu = document.getElementById('userMenu');

        if (!menu) {
            return;
        }

        const button = event.target.closest(
            '[onclick="toggleUserMenu()"]'
        );

        // Nếu click bên ngoài cả button và menu
        if (!menu.contains(event.target) && !button) {

            menu.classList.add('hidden');

            const arrow = document.getElementById('userMenuArrow');

            if (arrow) {
                arrow.classList.remove('rotate-180');
            }
        }

    });
</script>
