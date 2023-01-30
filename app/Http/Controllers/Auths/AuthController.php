<?php

namespace App\Http\Controllers\Auths;

use App\Enums\AdminStatusEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getUserLogin()
    {
        return view('auths.user');
    }

    public function postUserLogin(LoginRequest $request)
    {
        $email = $request->string('email')->trim();
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();
            if ($user->status == UserStatusEnum::ACTIVE) {
                return to_route('user.dashboard.index');
            }

            return back()->withErrors(['msg' => 'บัญชีนี้ถูกระงับการใช้'])->withInput();
        }

        return back()->withErrors(['msg' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    public function userLogout()
    {
        Auth::logout();

        return to_route('user.login.get');
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
                return to_route('admin.dashboard.index');
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

        return to_route('admin.login.get');
    }
}
