<?php

namespace App\Models;

use Carbon\Carbon;
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
     * @var string[]
     */
    protected $appends = [
        'cycle_month',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'water_unit',
        'electric_unit',
        'cycle',
        'room_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'cycle' => 'date',
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
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * @return string
     */
    public function getCycleMonthAttribute(): string
    {
        $cycle = Carbon::parse($this->cycle);

        return $cycle->translatedFormat('F Y');
    }
}
