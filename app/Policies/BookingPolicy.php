<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): Response
    {
        return $user->id === $booking->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can download rental contract.
     */
    public function downloadRentalContract(User $user, Booking $booking): Response
    {
        return $user->id === $booking->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
