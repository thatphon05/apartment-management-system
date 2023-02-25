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
        Admin::where('id', 1)->update(['password' => $request->password_new]);
//        if (!(Hash::check($request->get('password_old'), auth()->admins()->password))) {
//            // The passwords matches
//            return redirect()->back()->with("error", "Your current password does not matches with the password.");
//        }
//
//        if (strcmp($request->get('password_old'), $request->get('password_new')) == 0) {
//            // Current password and new password same
//            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
//        }
//
//        if (strcmp($request->get('password_new'), $request->get('password_new_confirmation')) == 0) {
//            // Current password and new password same
//            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
//        }

        return redirect()->back()->with(['success' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
    }

}
