<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
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

        // filter all users and room information
        return User::with(['bookings' => function ($query) {
            $query->with(['room.floor.building'])
                ->where('status', BookingStatusEnum::ACTIVE)
                ->latest('id')
                ->get(['id', 'room_id']);
        }])
            ->whereIn('status', $status)
            ->when($search != '', function ($query) use ($searchLike) {
                $query->Where('name', 'like', $searchLike)
                    ->orWhere('surname', 'like', $searchLike)
                    ->orWhere('telephone', 'like', $searchLike);
            })
            ->latest('id')
            ->paginate(40);
    }

    /**
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request): User
    {
        return User::create([
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password,
            'id_card_number' => $request->id_card,
            'birthdate' => $request->birthdate,
            'religion' => $request->religion,
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'subdistrict' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'id_card_copy' => $request->file('id_card_copy')->hashName(),
            'copy_house_registration' => $request->file('copy_house_registration')->hashName(),
            'status' => UserStatusEnum::ACTIVE,
        ]);
    }

    /**
     * @param Request $request
     * @param $filename
     * @return void
     */
    public function uploadIdCardDoc(Request $request, $filename): void
    {
        $request->file('id_card_copy')->storeAs(
            config('custom.id_card_copy_path'), $filename
        );
    }

    /**
     * @param Request $request
     * @param $filename
     * @return void
     */
    public function uploadCopyHouseDoc(Request $request, $filename): void
    {
        $request->file('copy_house_registration')->storeAs(
            config('custom.copy_house_registration_path'), $filename
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return User
     */
    public function updateUser(Request $request, $id): User
    {

        $user = User::findOrFail($id);

        $user->telephone = $request->telephone;
        $user->id_card_number = $request->id_card;
        $user->birthdate = $request->birthdate;
        $user->religion = $request->religion;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->address = $request->address;
        $user->subdistrict = $request->sub_district;
        $user->district = $request->district;
        $user->province = $request->province;
        $user->postal_code = $request->postal_code;

        if ($request->password) {
            $user->password = $request->password;
        }

        if ($request->hasFile('id_card_copy')) {
            $user->id_card_copy = $request->file('id_card_copy')->hashName();
            $this->uploadIdCardDoc($request, $user->id_card_copy);
        }

        if ($request->hasFile('copy_house_registration')) {
            $user->copy_house_registration = $request->file('copy_house_registration')->hashName();
            $this->uploadCopyHouseDoc($request, $user->copy_house_registration);
        }

        $user->save();

        return $user;
    }

}
