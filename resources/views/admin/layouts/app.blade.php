<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard')
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #111827;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            padding: 22px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #374151;
        }

        .menu {
            padding: 15px 0;
        }

        .menu a {
            display: block;
            padding: 13px 22px;

            color: #d1d5db;
            text-decoration: none;
        }

        .menu a:hover {
            background: #1f2937;
            color: white;
        }

        .menu .active {
            background: #2563eb;
            color: white;
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        /* HEADER */

        .header {
            height: 70px;
            background: white;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 25px;

            border-bottom: 1px solid #e5e7eb;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* CONTENT */

        .content {
            padding: 25px;
        }

        /* CARDS */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 20px;
        }

        .card {
            background: white;

            padding: 22px;

            border-radius: 10px;

            border: 1px solid #e5e7eb;
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
        }

        .card-value {
            font-size: 28px;
            font-weight: bold;
            margin-top: 8px;
        }

        .section {
            margin-top: 25px;
        }

        .logout-button {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            font-size: 14px;
        }

        @media (max-width: 1000px) {

            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                width: calc(100% - 200px);
            }

            .stats {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            TikTok Affiliate
        </div>

        <nav class="menu">

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                Dashboard
            </a>

            <a href="">
                Sản phẩm
            </a>

            <a href="">
                Danh mục
            </a>

            <a href=" ">
                Affiliate Links
            </a>

            <a href="">
                Click
            </a>

            <a href="">
                Đơn hàng
            </a>

            <a href="">
                Hoa hồng
            </a>

            <a href="">
                Rút tiền
            </a>

            <a href="">
                Cài đặt
            </a>

            <form
                method="POST"
                action="{{ route('logout') }}"
                style="padding: 10px 22px;"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Đăng xuất
                </button>

            </form>

        </nav>

    </aside>


    <!-- MAIN -->

    <main class="main">

        <!-- HEADER -->

        <header class="header">

            <div class="header-title">

                @yield('page-title', 'Dashboard')

            </div>

            <div class="admin-info">

                <span>
                    {{ auth()->user()->name }}
                </span>

            </div>

        </header>


        <!-- CONTENT -->

        <div class="content">

            @yield('content')

        </div>

    </main>

</div>

</body>

</html>