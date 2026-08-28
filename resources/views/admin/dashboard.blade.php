<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <title>Admin Dashboard</title>
</head>

<body>

    <h1>Admin Dashboard</h1>

    <p>
        Xin chào,
        {{ auth()->user()->name }}
    </p>

    <p>
        Bạn đã đăng nhập thành công với quyền Admin.
    </p>

    <form
        method="POST"
        action="{{ route('admin.logout') }}"
    >
        @csrf

        <button type="submit">
            Đăng xuất
        </button>
    </form>

</body>

</html>