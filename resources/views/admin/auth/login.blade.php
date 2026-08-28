<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;
        }

        .login-box {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;

            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;

            border: none;
            border-radius: 6px;

            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h1>Login</h1>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.login.submit') }}">

        @csrf

        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >

        </div>

        <div class="form-group">

            <label for="password">
                Mật khẩu
            </label>

            <input
                type="password"
                id="password"
                name="password"
                required
            >

        </div>

        <div class="form-group">

            <label style="
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: flex-start;
                gap: 8px;
                width: auto;
                margin: 0;">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    style="margin: 0;">
               <span style="white-space: nowrap;">Ghi nhớ đăng nhập</span>
            </label>
        </div>
        <button type="submit">
            Đăng nhập
        </button>

    </form>

</div>

</body>
</html>