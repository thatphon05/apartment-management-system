<?php

namespace App\Models;

use App\Enums\RepairStatusEnum;
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => RepairStatusEnum::class,
    ];

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
