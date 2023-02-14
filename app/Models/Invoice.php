<?php

namespace App\Models;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * @var string[]
     */
    protected $fillable = [
        'status',
        'overdue_total',
        'summary',
    ];

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
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    /**
     * @return Attribute
     */
    protected function cycleDate(): Attribute
    {
        $value = $this->cycle->translatedFormat('F Y');

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function dueDateFormat(): Attribute
    {
        $value = $this->due_date->translatedFormat('d F Y');

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function isDueDate(): Attribute
    {
        $value = $this->due_date->lt(now());

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function waterTotalDivided(): Attribute
    {
        $value = (float)$this->water_total / 2;

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function electricTotalDivided(): Attribute
    {
        $value = (float)$this->electric_total / 2;

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function dynamicOverdueTotal(): Attribute
    {
        $value = 0;

        if ($this->is_due_date) {

            $payWithinDay = config('custom.pay_within_day');

            $overdue_fee = $this->room->configuration->overdue_fee;

            $dayOfDue = $this->due_date->diff(now())->days;

            $value = (float)$dayOfDue <= $payWithinDay ? $dayOfDue * $overdue_fee : $payWithinDay * $overdue_fee;
        }

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function electricUnitPriceDivide(): Attribute
    {
        $value = (float)$this->electric_unit_price / 2;

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function waterUnitPriceDivide(): Attribute
    {
        $value = (float)$this->water_unit_price / 2;

        return new Attribute(
            get: fn() => $value,
        );
    }

    /**
     * @return Attribute
     */
    protected function dynamicSummary(): Attribute
    {
        $value = (float)$this->rent_total + $this->electric_total + $this->water_total
            + $this->parking_total + $this->common_total + $this->dynamic_overdue_total;

        return new Attribute(
            get: fn() => $value,
        );
    }

}
