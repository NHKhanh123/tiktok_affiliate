<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors([
                    'email' => 'Email hoặc mật khẩu không chính xác.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user && method_exists($user, 'hasVerifiedEmail') && !$user->hasVerifiedEmail()) {
            Auth::logout();

            return redirect()
                ->route('verification.notice')
                ->withErrors([
                    'email' => 'Email của bạn chưa được xác minh.',
                ]);
        }

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'user' => redirect()->route('home'),
            default => $this->logoutInvalidUser(
                $request,
                'Tài khoản không có quyền truy cập hợp lệ.'
            ),
        };
    }

    /**
     * Đăng xuất.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Đăng xuất tài khoản có role không hợp lệ.
     */
    private function logoutInvalidUser(
        Request $request,
        string $message
    ): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => $message,
            ]);
    }
}
