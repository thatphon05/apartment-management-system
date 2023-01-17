<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        return view('admins.settings.index');
    }

    public function edit($id)
    {
        return view('admins.settings.edit');
    }

    public function update(AdminSettingRequest $request, $id)
    {
    }

}
