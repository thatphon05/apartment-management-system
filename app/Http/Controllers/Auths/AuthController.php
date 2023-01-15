<?php

namespace App\Http\Controllers\Auths;

use App\Enums\AdminStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getUserLogin()
    {

    }

    public function postUserLogin()
    {

    }

    public function userLogout()
    {

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getAdminLogin()
    {
        return view('auths.admin');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdminLogin(LoginRequest $request)
    {
        $email = $request->string('email')->trim();
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::guard('admin')->user();
            if ($user->status == AdminStatusEnum::ACTIVE) {
                return redirect(route('admin.dashboard.index'));
            }

            return back()->withErrors(['msg' => 'บัญชีนี้ถูกระงับการใช้'])->withInput();
        }

        return back()->withErrors(['msg' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login.get'));
    }
}
