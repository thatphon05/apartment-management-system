<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Repair extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'repairs';

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }

}
