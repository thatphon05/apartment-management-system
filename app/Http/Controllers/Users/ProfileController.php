<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function getChangePassword(): View
    {
        return view('users.profiles.change_password');
    }

    public function postChangePassword(UserChangePasswordRequest $request): RedirectResponse
    {
        auth()->user()->update([
            'password' => $request->password_new,
        ]);

        return redirect()->back()->with(['success' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
    }
}
