<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'cycle_month' => 'date',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    protected function cycleMonth(): Attribute
    {
        $value = $this->cycle->translatedFormat('F Y');

        return new Attribute(
            get: fn() => $value,
        );
    }
}
