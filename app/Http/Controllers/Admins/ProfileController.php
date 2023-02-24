<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
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
        return to_route();
    }

}
