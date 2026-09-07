@extends('layouts.frontend')

@section('title', 'Thông tin tài khoản')

@section('meta_description', 'Quản lý thông tin tài khoản của bạn.')

@section('content')

    <div class="min-h-screen bg-gray-50 pt-8 sm:pt-10 sm:pb-20">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- ================================================= --}}
            {{-- BREADCRUMB --}}
            {{-- ================================================= --}}

            <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">

                <a href="{{ route('home') }}" class="transition hover:text-gray-900">
                    Trang chủ
                </a>

                <span>/</span>

                <span class="text-gray-900">
                    Tài khoản
                </span>

            </div>


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="mb-8">

                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Thông tin tài khoản
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Quản lý thông tin cá nhân và tài khoản Affiliate của bạn.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-4">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />

                    </svg>

                    <div class="text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </div>

                </div>
            @endif


            {{-- ================================================= --}}
            {{-- ERROR MESSAGE --}}
            {{-- ================================================= --}}

            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4">

                    <div class="flex gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />

                        </svg>

                        <div>

                            <div class="text-sm font-semibold text-red-700">
                                Không thể cập nhật thông tin
                            </div>

                            <ul class="mt-2 space-y-1 text-sm text-red-600">

                                @foreach ($errors->all() as $error)
                                    <li>
                                        • {{ $error }}
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- MAIN GRID --}}
            {{-- ================================================= --}}

            <div class="grid gap-6 lg:grid-cols-3">


                {{-- ================================================= --}}
                {{-- LEFT SIDEBAR --}}
                {{-- ================================================= --}}

                <aside class="lg:col-span-1">

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">


                        {{-- User card --}}
                        <div class="border-b border-gray-100 px-5 py-6">

                            <div class="flex items-center gap-4">

                                {{-- Avatar --}}
                                <div
                                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-gray-900 text-lg font-bold text-white">

                                    {{ strtoupper(substr($user->name, 0, 1)) }}

                                </div>


                                <div class="min-w-0">

                                    <h2 class="truncate font-semibold text-gray-900">
                                        {{ $user->name }}
                                    </h2>

                                    <p class="mt-1 truncate text-xs text-gray-500">
                                        {{ $user->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Navigation --}}
                        <nav class="p-2">

                            {{-- Profile --}}
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 rounded-xl bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-900">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1-7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />

                                </svg>

                                <span>
                                    Thông tin tài khoản
                                </span>

                            </a>


                            {{-- Orders --}}
                            <a href="{{ route('account.orders.index') }}"
                                class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5 12 3l9 4.5M3 7.5v9L12 21l9-4.5v-9M3 7.5 12 12l9-4.5M12 12v9" />

                                </svg>

                                <span>
                                    Đơn hàng
                                </span>

                            </a>

                        </nav>


                        {{-- Logout --}}
                        <div class="border-t border-gray-100 p-2">

                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50">

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

                </aside>


                {{-- ================================================= --}}
                {{-- RIGHT CONTENT --}}
                {{-- ================================================= --}}

                <main class="space-y-6 lg:col-span-2">


                    {{-- ================================================= --}}
                    {{-- PERSONAL INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">

                        <div class="border-b border-gray-100 px-6 py-5">

                            <h2 class="font-semibold text-gray-900">
                                Thông tin cá nhân
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Cập nhật thông tin cơ bản của tài khoản.
                            </p>

                        </div>


                        <form action="{{ route('profile.update') }}" method="POST" class="p-6">

                            @csrf
                            @method('PUT')


                            {{-- Name --}}
                            <div>

                                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">

                                    Họ và tên

                                </label>

                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" required autocomplete="name"
                                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-1 focus:ring-gray-900">

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Email --}}
                            <div class="mt-5">

                                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">

                                    Email

                                </label>

                                <input id="email" type="email" value="{{ $user->email }}" disabled
                                    class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500">

                                <p class="mt-2 text-xs text-gray-500">
                                    Email được sử dụng để đăng nhập và hiện chưa thể thay đổi.
                                </p>

                            </div>


                            {{-- Save --}}
                            <div class="mt-6 flex justify-end border-t border-gray-100 pt-5">

                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800">

                                    Lưu thay đổi

                                </button>

                            </div>

                        </form>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ACCOUNT INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">

                        <div class="border-b border-gray-100 px-6 py-5">

                            <h2 class="font-semibold text-gray-900">
                                Thông tin tài khoản
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Thông tin trạng thái của tài khoản.
                            </p>

                        </div>


                        <div class="divide-y divide-gray-100">


                            {{-- Account ID --}}
                            <div class="flex items-center justify-between gap-4 px-6 py-4">

                                <div>

                                    <div class="text-sm font-medium text-gray-900">
                                        ID tài khoản
                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">
                                        Mã định danh tài khoản
                                    </div>

                                </div>

                                <div class="text-sm font-semibold text-gray-900">
                                    #{{ $user->id }}
                                </div>

                            </div>


                            {{-- Email --}}
                            <div class="flex items-center justify-between gap-4 px-6 py-4">

                                <div>

                                    <div class="text-sm font-medium text-gray-900">
                                        Email
                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">
                                        Địa chỉ email đăng nhập
                                    </div>

                                </div>

                                <div class="max-w-[55%] truncate text-sm text-gray-700">
                                    {{ $user->email }}
                                </div>

                            </div>


                            {{-- Email verified --}}
                            <div class="flex items-center justify-between gap-4 px-6 py-4">

                                <div>

                                    <div class="text-sm font-medium text-gray-900">
                                        Xác thực email
                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">
                                        Trạng thái xác thực địa chỉ email
                                    </div>

                                </div>


                                @if ($user->email_verified_at)
                                    <span
                                        class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Đã xác thực

                                    </span>
                                @else
                                    <span
                                        class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1.5 text-xs font-semibold text-yellow-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>

                                        Chưa xác thực

                                    </span>
                                @endif

                            </div>


                            {{-- Created --}}
                            <div class="flex items-center justify-between gap-4 px-6 py-4">

                                <div>

                                    <div class="text-sm font-medium text-gray-900">
                                        Ngày tham gia
                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">
                                        Ngày tạo tài khoản
                                    </div>

                                </div>

                                <div class="text-sm text-gray-700">

                                    {{ $user->created_at?->format('d/m/Y') ?? '—' }}

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ACCOUNT SECURITY --}}
                    {{-- ================================================= --}}

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">

                        <div class="px-6 py-5">
                            <h2 class="font-semibold text-gray-900">
                                Bảo mật tài khoản
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Các thiết lập bảo mật của tài khoản.
                            </p>
                        </div>

                        <div class="border-t border-gray-100 px-6 py-5">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        Mật khẩu
                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">
                                        Bạn nên thay đổi mật khẩu định kỳ để bảo vệ tài khoản.
                                    </div>
                                </div>

                                <a href="#"
                                    class="inline-flex shrink-0 items-center justify-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 hover:text-gray-900">
                                    Đổi mật khẩu
                                </a>

                            </div>

                        </div>

                    </div>


                </main>

            </div>

        </div>

    </div>

@endsection
