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
            'config' => Configuration::all(),
        ]);
    }

    public function edit($id)
    {
        return view('admins.settings.edit', [
            'config' => Configuration::findOrFail($id),
        ]);
    }

    public function update(AdminSettingRequest $request, $id)
    {
        Configuration::where('id', $id)->update($request->validated());
        return back()->with(['success' => 'บันทึกสำเร็จ']);
    }

}
