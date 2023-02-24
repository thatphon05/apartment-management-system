<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RepairController extends Controller
{
    public function index(): View
    {
        return view('users.repairs.index');
    }

    public function create(): View
    {
        return view('users.repairs.create');
    }

    public function store(): RedirectResponse
    {
        return to_route('repair');
    }
}
