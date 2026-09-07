<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    /**
     * Thông tin tài khoản
     */
    public function profile()
    {
        $user = Auth::user();

        return view('account.profile', compact('user'));
    }


    /**
     * Cập nhật thông tin tài khoản
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $user->update([
            'name' => $validated['name'],
        ]);

        return back()->with(
            'success',
            'Cập nhật thông tin tài khoản thành công.'
        );
    }
}
