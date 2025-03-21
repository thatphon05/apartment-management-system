<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $fillable = [
        'configuration_id',
    ];

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'room_id');
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class, 'room_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'room_id');
    }

    public function utilityExpenses(): HasMany
    {
        return $this->hasMany(UtilityExpense::class, 'room_id');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class, 'configuration_id');
    }
}
