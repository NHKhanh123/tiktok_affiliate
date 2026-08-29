<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký tài khoản - TikTok Affiliate</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, Helvetica, sans-serif;

            background: #f5f6fa;
        }

        .register-container {
            width: 100%;
            max-width: 430px;

            padding: 20px;
        }

        .register-card {
            background: #ffffff;

            padding: 35px;

            border-radius: 12px;

            border: 1px solid #e5e7eb;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;

            font-size: 26px;

            font-weight: 700;

            color: #111827;

            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;

            color: #6b7280;

            font-size: 14px;

            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            font-size: 14px;

            font-weight: 600;

            color: #374151;
        }

        .form-group input {
            width: 100%;

            height: 44px;

            padding: 0 13px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            font-size: 14px;

            outline: none;

            transition: border-color 0.2s,
                box-shadow 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .error-box {
            margin-bottom: 20px;

            padding: 12px 14px;

            border-radius: 7px;

            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #b91c1c;

            font-size: 14px;
        }

        .error-box p {
            margin: 4px 0;
        }

        .register-button {
            width: 100%;

            height: 45px;

            border: none;

            border-radius: 7px;

            background: #2563eb;

            color: white;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: background 0.2s;
        }

        .register-button:hover {
            background: #1d4ed8;
        }

        .login-link {
            text-align: center;

            margin-top: 22px;

            font-size: 14px;

            color: #6b7280;
        }

        .login-link a {
            color: #2563eb;

            text-decoration: none;

            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {

            .register-container {
                padding: 15px;
            }

            .register-card {
                padding: 25px 20px;
            }

            .logo {
                font-size: 23px;
            }

        }
    </style>

</head>

<body>

    <div class="register-container">

        <div class="register-card">

            <div class="logo">
                TikTok Affiliate
            </div>

            <div class="subtitle">
                Tạo tài khoản để bắt đầu mua sắm
            </div>


            {{-- Hiển thị lỗi --}}

            @if ($errors->any())

                <div class="error-box">

                    @foreach ($errors->all() as $error)
                        <p>
                            {{ $error }}
                        </p>
                    @endforeach

                </div>

            @endif


            <form method="POST" action="{{ route('register') }}">

                @csrf


                {{-- Họ tên --}}

                <div class="form-group">

                    <label for="name">
                        Họ tên
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Nhập họ tên" autocomplete="name" required>

                </div>


                {{-- Email --}}

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="example@gmail.com" autocomplete="email" required>

                </div>


                {{-- Mật khẩu --}}

                <div class="form-group">

                    <label for="password">
                        Mật khẩu
                    </label>

                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                        autocomplete="new-password" required>

                </div>


                {{-- Xác nhận mật khẩu --}}

                <div class="form-group">

                    <label for="password_confirmation">
                        Xác nhận mật khẩu
                    </label>

                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" autocomplete="new-password" required>

                </div>


                {{-- Submit --}}

                <button type="submit" class="register-button">
                    Đăng ký
                </button>

            </form>


            {{-- Login --}}

            <div class="login-link">

                Đã có tài khoản?

                <a href="{{ route('login') }}">
                    Đăng nhập
                </a>

            </div>

        </div>

    </div>

</body>

</html>
