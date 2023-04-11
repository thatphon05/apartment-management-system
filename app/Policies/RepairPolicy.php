<?php

namespace App\Policies;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RepairPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Repair $repair): Response
    {
        return $user->id === $repair->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Booking $booking): Response
    {
        return $user->id === $booking->user_id && $booking->status === BookingStatusEnum::ACTIVE
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
