<?php

namespace App\Http\Controllers\Auths;

use App\Enums\AdminStatusEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function getUserLogin(): View
    {
        return view('auths.user');
    }

    public function postUserLogin(LoginRequest $request): RedirectResponse
    {
        $email = $request->string('email')->trim();
        $password = $request->input('password');

        $auth = auth();

        if ($auth->attempt(['email' => $email, 'password' => $password])) {
            if ($auth->user()->status == UserStatusEnum::ACTIVE) {
                return to_route('user.dashboard.index');
            }

            return back()->withErrors(['msg' => 'บัญชีนี้ถูกระงับการใช้'])->withInput();
        }

        return back()->withErrors(['msg' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    public function userLogout(): RedirectResponse
    {
        auth()->logout();

        return to_route('user.login.get');
    }

    public function getAdminLogin(): View
    {
        return view('auths.admin');
    }

    public function postAdminLogin(LoginRequest $request): RedirectResponse
    {
        $email = $request->string('email')->trim();
        $password = $request->input('password');

        $auth = auth()->guard('admin');

        if ($auth->attempt(['email' => $email, 'password' => $password])) {
            if ($auth->user()->status == AdminStatusEnum::ACTIVE) {
                return to_route('admin.dashboard.index');
            }

            return back()->withErrors(['msg' => 'บัญชีนี้ถูกระงับการใช้'])->withInput();
        }

        return back()->withErrors(['msg' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    public function adminLogout(): RedirectResponse
    {
        auth()->guard('admin')->logout();

        return to_route('admin.login.get');
    }
}
