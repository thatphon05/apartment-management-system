<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminConfigurationRequest;
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

    public function update(AdminConfigurationRequest $request, string $id): RedirectResponse
    {
        Configuration::findOrFail($id)->update($request->validated());

        return back()->with(['success' => 'แก้ไขราคาห้องสำเร็จ']);
    }

    public function create(): View
    {
        return view('admins.configurations.create');
    }

    public function store(AdminConfigurationRequest $request): RedirectResponse
    {
        Configuration::create($request->validated());

        return back()->with(['success' => 'เพิ่มราคาห้องสำเร็จ']);
    }
}
