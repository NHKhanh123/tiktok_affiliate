<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin')
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }


        /* =========================
       LAYOUT
    ========================= */

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }


        /* =========================
       SIDEBAR
    ========================= */

        .sidebar {
            width: 250px;
            background: #111827;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }


        /* LOGO */

        .sidebar-logo {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom: 1px solid #374151;
        }

        .sidebar-logo h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .sidebar-logo span {
            color: #60a5fa;
        }


        /* MENU */

        .sidebar-menu {
            padding: 20px 12px;
            flex: 1;
        }

        .menu-title {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            margin: 10px 10px;
            letter-spacing: 0.5px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            margin-bottom: 4px;
            border-radius: 7px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #1f2937;
            color: white;
        }

        .menu-item.active {
            background: #2563eb;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }


        /* SIDEBAR BOTTOM */

        .sidebar-bottom {
            padding: 15px 12px;
            border-top: 1px solid #374151;
        }


        /* =========================
       MAIN
    ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }


        /* =========================
       HEADER
    ========================= */

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: #6b7280;
        }


        /* =========================
       CONTENT
    ========================= */

        .content {
            padding: 30px;
        }


        /* =========================
       RESPONSIVE
    ========================= */

        @media (max-width: 768px) {

            .sidebar {
                width: 70px;
            }

            .sidebar-logo {
                justify-content: center;
                padding: 0;
            }

            .sidebar-logo h2 {
                font-size: 0;
            }

            .sidebar-logo h2::after {
                content: "A";
                font-size: 22px;
            }

            .menu-title {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 12px;
            }

            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 15px;
            }

            .user-name,
            .user-role {
                display: none;
            }

        }
    </style>

    @stack('styles')

</head>

<body>

    <div class="admin-layout">

        <!-- =========================
     SIDEBAR
========================== -->

        <aside class="sidebar">


            <!-- LOGO -->

            <div class="sidebar-logo">

                <h2>
                    Affiliate<span>Admin</span>
                </h2>

            </div>


            <!-- MENU -->

            <div class="sidebar-menu">


                <div class="menu-title">
                    Tổng quan
                </div>


                <!-- DASHBOARD -->

                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    <span class="menu-icon">
                        🏠
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <div class="menu-title">
                    Quản lý
                </div>


                <!-- CATEGORIES -->

                <a href="{{ route('admin.categories.index') }}"
                    class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

                    <span class="menu-icon">
                        📁
                    </span>

                    <span>
                        Danh mục
                    </span>

                </a>


                <!-- PRODUCTS -->

                <a href="{{ route('admin.products.index') }}" class="menu-item">

                    <span class="menu-icon">
                        📦
                    </span>

                    <span>
                        Sản phẩm
                    </span>

                </a>


                <!-- ORDERS -->

                <a href="#" class="menu-item">

                    <span class="menu-icon">
                        🛒
                    </span>

                    <span>
                        Đơn hàng
                    </span>

                </a>


                <!-- AFFILIATE -->

                <a href="{{ route('admin.affiliate-links.index') }}" class="menu-item">

                    <span class="menu-icon">
                        🔗
                    </span>

                    <span>
                        Affiliate
                    </span>

                </a>


                <!-- CLICKS -->

                <a href="#" class="menu-item">

                    <span class="menu-icon">
                        📊
                    </span>

                    <span>
                        Tracking
                    </span>

                </a>


                <div class="menu-title">
                    Hệ thống
                </div>


                <!-- USERS -->

                <a href="#" class="menu-item">

                    <span class="menu-icon">
                        👥
                    </span>

                    <span>
                        Người dùng
                    </span>

                </a>


                <!-- SETTINGS -->

                <a href="#" class="menu-item">

                    <span class="menu-icon">
                        ⚙️
                    </span>

                    <span>
                        Cài đặt
                    </span>

                </a>


            </div>


            <!-- BOTTOM -->

            <div class="sidebar-bottom">


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="menu-item"
                        style="
                    width: 100%;
                    border: none;
                    background: transparent;
                    cursor: pointer;
                    text-align: left;
                ">

                        <span class="menu-icon">
                            🚪
                        </span>

                        <span>
                            Đăng xuất
                        </span>

                    </button>

                </form>


            </div>


        </aside>


        <!-- =========================
     MAIN
========================== -->

        <main class="main">


            <!-- TOPBAR -->

            <header class="topbar">


                <div class="topbar-title">

                    @yield('page-title')

                </div>


                <div class="user-info">


                    <div>

                        <div class="user-name">

                            {{ auth()->user()->name }}

                        </div>

                        <div class="user-role">

                            {{ auth()->user()->role }}

                        </div>

                    </div>


                    <div class="user-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                </div>


            </header>


            <!-- CONTENT -->

            <div class="content">

                @yield('content')

            </div>


        </main>

    </div>

    @stack('scripts')

</body>

</html>
