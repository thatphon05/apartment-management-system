<?php

namespace App\Http\Controllers\Admins;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get query parameter
        $search = request()->query('search', '');
        $searchLike = '%' . $search . '%';
        $status = request()->query('status', UserStatusEnum::cases());

        // find all users
        $users = User::orWhere(function ($query) use ($searchLike) {
            $query->orWhere('name', 'like', $searchLike)
                ->orWhere('surname', 'like', $searchLike)
                ->orWhere('telephone', 'like', $searchLike);
        })
            ->whereIn('status', $status)
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admins.users.index', ['users' => $users]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
