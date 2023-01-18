<?php

namespace App\Services;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @param Request $request
     * @return User[]|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_User_C
     */
    public function searchUser(Request $request)
    {

        // Get query parameter
        $search = $request->query('search', '');
        $searchLike = '%' . $search . '%';
        $status = $request->query('status', UserStatusEnum::cases());

        // find all users
        return User::orWhere(function ($query) use ($searchLike) {
            $query->orWhere('name', 'like', $searchLike)
                ->orWhere('surname', 'like', $searchLike)
                ->orWhere('telephone', 'like', $searchLike);
        })
            ->whereIn('status', $status)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }
}
