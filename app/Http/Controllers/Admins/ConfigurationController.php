<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSettingRequest;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admins.configurations.index', [
            'configs' => Configuration::all(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admins.configurations.edit', [
            'config' => Configuration::findOrFail($id),
        ]);
    }

    /**
     * @param AdminSettingRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminSettingRequest $request, $id)
    {
        Configuration::where('id', $id)->update($request->validated());

        return back()->with(['success' => 'บันทึกสำเร็จ']);
    }

}
