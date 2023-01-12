<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtilityExpense extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'utilities_expenses';

    /**
     * @return BelongsTo
     */
    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

}
