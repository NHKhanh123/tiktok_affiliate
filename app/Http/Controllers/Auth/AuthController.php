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
     *
     * Hiện tại website sử dụng Login Modal,
     * nhưng vẫn giữ method này để tránh lỗi route login.
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


        /*
        |--------------------------------------------------------------------------
        | Kiểm tra tài khoản
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials, $remember)) {
            return redirect()
                ->route('home')
                ->withErrors([
                    'email' => 'Email hoặc mật khẩu không chính xác.',
                ])
                ->withInput($request->only('email'))
                ->with('open_login_modal', true);
        }


        /*
        |--------------------------------------------------------------------------
        | Regenerate session
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Kiểm tra email đã xác minh
        |--------------------------------------------------------------------------
        */

        if (
            $user &&
            method_exists($user, 'hasVerifiedEmail') &&
            !$user->hasVerifiedEmail()
        ) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('home')
                ->with(
                    'warning',
                    'Email của bạn chưa được xác minh. Vui lòng kiểm tra email để xác minh tài khoản.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Kiểm tra role
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return $this->logoutInvalidUser(
                $request,
                'Không thể xác định tài khoản đăng nhập.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Đăng nhập thành công. Chào mừng quản trị viên!'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'user') {

            return redirect()
                ->route('home')
                ->with(
                    'success',
                    'Đăng nhập thành công. Chào mừng bạn trở lại!'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Role không hợp lệ
        |--------------------------------------------------------------------------
        */

        return $this->logoutInvalidUser(
            $request,
            'Tài khoản không có quyền truy cập hợp lệ.'
        );
    }


    /**
     * Đăng xuất.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();


        /*
        |--------------------------------------------------------------------------
        | Xóa session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        /*
        |--------------------------------------------------------------------------
        | Thông báo
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Bạn đã đăng xuất thành công.'
            );
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
            ->route('home')
            ->with(
                'error',
                $message
            );
    }
}
