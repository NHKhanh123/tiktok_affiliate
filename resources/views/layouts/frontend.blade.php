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

    @include('partials.header')
    @include('partials.notifications')


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main>

        @yield('content')

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')


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

    @include('partials.login-modal')
    @include('partials.register-modal')

</body>

</html>
