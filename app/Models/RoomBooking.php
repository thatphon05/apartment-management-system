<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomBooking extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'room_bookings';

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * @return HasMany
     */
    public function utilytyExpenses(): HasMany
    {
        return $this->hasMany(UtilitiesExpense::class, 'booking_id');
    }

    /**
     * @return HasMany
     */
    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class, 'booking_id');
    }

}
