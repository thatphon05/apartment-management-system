<?php

namespace App\Models;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => InvoiceStatusEnum::class,
        'due_date' => 'date',
        'cycle' => 'date',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'cycle_date',
        'is_due_date',
        'due_date_format',
        'water_total_divided',
        'electric_total_divided',
        'dynamic_summary',
        'dynamic_overdue_total',
        'electric_unit_price_divide',
        'water_unit_price_divide',
    ];

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * @return HasMany
     */
    public function utilExpenses(): HasMany
    {
        return $this->hasMany(UtilityExpense::class, 'util_expense_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }

    /**
     * @return string
     */
    public function getCycleDateAttribute(): string
    {
        return $this->cycle->translatedFormat('F Y');
    }

    /**
     * @return string
     */
    public function getDueDateFormatAttribute(): string
    {
        return $this->due_date->translatedFormat('d F Y');
    }

    /**
     * @return string
     */
    public function getIsDueDateAttribute(): bool
    {
        return $this->due_date->lt(now());
    }

    /**
     * @return float
     */
    public function getWaterTotalDividedAttribute(): float
    {
        return (float)$this->water_total / 2;
    }

    /**
     * @return float
     */
    public function getElectricTotalDividedAttribute(): float
    {
        return (float)$this->electric_total / 2;
    }

    /**
     * @return float
     */
    public function getDynamicOverdueTotalAttribute(): float
    {
        if ($this->is_due_date) {

            $payWithinDay = config('custom.pay_within_day');

            $overdue_fee = $this->room->configuration->overdue_fee;

            $dayOfDue = $this->due_date->diff(now())->days;

            return (float)$dayOfDue <= $payWithinDay ? $dayOfDue * $overdue_fee : $payWithinDay * $overdue_fee;
        }

        return 0;
    }

    /**
     * @return float
     */
    public function getElectricUnitPriceDivideAttribute(): float
    {
        return (float)$this->electric_unit_price / 2;
    }

    /**
     * @return float
     */
    public function getWaterUnitPriceDivideAttribute(): float
    {
        return (float)$this->water_unit_price / 2;
    }

    /**
     * @return float
     */
    public function getDynamicSummaryAttribute(): float
    {
        return (float)$this->rent_total + $this->electric_total + $this->water_total
            + $this->parking_total + $this->common_total + $this->dynamic_overdue_total;
    }

}
