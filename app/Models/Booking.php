<?php

namespace App\Models;

use App\Casts\FormatYearCast;
use App\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => BookingStatusEnum::class,
        'arrival_date' => FormatYearCast::class,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'rental_contract',
        'contract_start',
        'deposit',
        'status',
        'parking_amount',
        'arrival_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class, 'booking_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'room_id');
    }

}
