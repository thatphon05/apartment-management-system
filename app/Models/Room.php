<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @return HasOne
     */
    public function floor(): HasOne
    {
        return $this->hasOne(Floor::class, 'floor_id');
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(RoomBooking::class, 'room_id');
    }

}
