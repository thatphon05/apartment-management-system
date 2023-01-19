<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return User::with(['bookings' => function ($query) {
            $query->with(['room' => function ($query) {
                $query->with(['floor' => function ($query) {
                    $query->with('building');
                }]);
            }])
                ->where('status', BookingStatusEnum::ACTIVE)
                ->latest()->get('id');
        }])
            ->orWhere(function ($query) use ($searchLike) {
                $query->orWhere('name', 'like', $searchLike)
                    ->orWhere('surname', 'like', $searchLike)
                    ->orWhere('telephone', 'like', $searchLike);
            })
            ->whereIn('status', $status)
            ->orderBy('id', 'desc')
            ->paginate(40);
    }

    /**
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request): User
    {
        $filename = Str::uuid() . '.pdf';

        return User::create([
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => bcrypt($request->password),
            'id_card' => $request->id_card,
            'birthdate' => $request->birthdate,
            'religion' => $request->religion,
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'id_card_copy' => $filename,
            'copy_house_registration' => $filename,
            'status' => UserStatusEnum::ACTIVE,
        ]);
    }

    /**
     * @param Request $request
     * @param $filename
     * @return void
     */
    public function uploadDocs(Request $request, $filename): void
    {
        $request->file('id_card_copy')->storeAs(
            'id_card_copy', $filename
        );
        $request->file('copy_house_registration')->storeAs(
            'copy_house_registration', $filename
        );
    }

}
