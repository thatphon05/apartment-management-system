<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSettingRequest;
use App\Models\Configuration;

class SettingController extends Controller
{
    public function index()
    {
        return view('admins.settings.index', [
            'config' => Configuration::latest()->first(),
        ]);
    }

    public function edit($id)
    {
        return view('admins.settings.edit');
    }

    public function update(AdminSettingRequest $request, $id)
    {
    }

}
