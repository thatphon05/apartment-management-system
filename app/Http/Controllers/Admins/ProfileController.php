<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function getChangePassword(): View
    {
        return view('admins.profiles.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request): RedirectResponse
    {
        Admin::find(auth()->guard('admin')->user()->id)
            ->update(['password' => $request->password_new]);

        return redirect()->back()->with(['success' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
    }

}
