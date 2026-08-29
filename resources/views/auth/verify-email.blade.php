<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Xác minh Email - TikTok Affiliate</title>


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

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f5f6fa;

            color: #111827;
        }


        .verification-container {
            width: 100%;

            max-width: 450px;

            padding: 20px;
        }


        .verification-card {
            background: #ffffff;

            padding: 40px 35px;

            border-radius: 12px;

            border: 1px solid #e5e7eb;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08);

            text-align: center;
        }


        /* Email Icon */

        .email-icon {
            width: 70px;

            height: 70px;

            margin: 0 auto 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #eff6ff;

            color: #2563eb;

            font-size: 32px;
        }


        .logo {
            font-size: 25px;

            font-weight: 700;

            color: #111827;

            margin-bottom: 8px;
        }


        .title {
            margin: 0 0 12px;

            font-size: 24px;

            font-weight: 700;

            color: #111827;
        }


        .description {
            margin: 0 0 20px;

            color: #6b7280;

            font-size: 14px;

            line-height: 1.6;
        }


        /* Email */

        .email-address {
            display: inline-block;

            max-width: 100%;

            padding: 10px 15px;

            margin-bottom: 20px;

            background: #f9fafb;

            border: 1px solid #e5e7eb;

            border-radius: 7px;

            color: #111827;

            font-size: 14px;

            font-weight: 600;

            word-break: break-all;
        }


        .instruction {
            margin: 0 0 25px;

            color: #6b7280;

            font-size: 13px;

            line-height: 1.6;
        }


        /* Success message */

        .success-message {
            margin-bottom: 20px;

            padding: 11px 14px;

            border-radius: 7px;

            background: #f0fdf4;

            border: 1px solid #bbf7d0;

            color: #15803d;

            font-size: 14px;
        }


        /* Button */

        .verify-button {
            width: 100%;

            height: 45px;

            border: none;

            border-radius: 7px;

            background: #2563eb;

            color: #ffffff;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.1s ease;
        }


        .verify-button:hover {
            background: #1d4ed8;
        }


        .verify-button:active {
            transform: scale(0.98);
        }


        /* Help */

        .help-text {
            margin-top: 22px;

            color: #9ca3af;

            font-size: 12px;

            line-height: 1.5;
        }


        /* Mobile */

        @media (max-width: 480px) {

            .verification-container {
                padding: 15px;
            }


            .verification-card {
                padding: 30px 20px;
            }


            .title {
                font-size: 21px;
            }


            .logo {
                font-size: 22px;
            }

        }
    </style>

</head>

<body>

    <div class="verification-container">

        <div class="verification-card">


            {{-- Email Icon --}}

            <div class="email-icon">

                ✉

            </div>


            {{-- Logo --}}

            <div class="logo">

                TikTok Affiliate

            </div>


            {{-- Title --}}

            <h1 class="title">

                Xác minh Email

            </h1>


            {{-- Description --}}

            <p class="description">

                Cảm ơn bạn đã đăng ký tài khoản.

                Chúng tôi đã gửi một email xác minh
                đến địa chỉ:

            </p>


            {{-- Email Address --}}

            <div class="email-address">

                {{ auth()->user()->email }}

            </div>


            {{-- Instruction --}}

            <p class="instruction">

                Hãy mở hộp thư của bạn và bấm vào
                liên kết xác minh trong email để
                hoàn tất quá trình đăng ký.

            </p>


            {{-- Success Message --}}

            @if (session('message'))
                <div class="success-message">

                    {{ session('message') }}

                </div>
            @endif


            {{-- Resend Email --}}

            <form method="POST" action="{{ route('verification.send') }}">

                @csrf

                <button type="submit" class="verify-button">

                    Gửi lại email xác minh

                </button>

            </form>


            {{-- Help --}}

            <div class="help-text">

                Không nhận được email?

                Hãy kiểm tra thư mục
                <strong>Spam</strong> hoặc
                <strong>Thư rác</strong>.

            </div>


        </div>
    </div>

</body>

</html>
