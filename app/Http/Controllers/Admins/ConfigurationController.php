<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSettingRequest;
use App\Models\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConfigurationController extends Controller
{

    public function index(): View
    {
        return view('admins.configurations.index', [
            'configs' => Configuration::all(),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admins.configurations.edit', [
            'config' => Configuration::findOrFail($id),
        ]);
    }

    public function update(AdminSettingRequest $request, string $id): RedirectResponse
    {
        Configuration::where('id', $id)->update($request->validated());

        return back()->with(['success' => 'บันทึกสำเร็จ']);
    }

}
