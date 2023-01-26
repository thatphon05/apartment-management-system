<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;

class RepairController extends Controller
{
    public function index()
    {
        return view('admins.repairs.index', [

        ]);
    }

    public function edit($id)
    {
        return view('admins.repairs.edit', [

        ]);
    }

    public function update(AdminEditRepairRequest $request, $id)
    {
    }

}
