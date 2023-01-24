<?php

namespace App\Models;

use App\Enums\InvoiceStatusEnum;
use Carbon\Carbon;
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
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'cycle_date',
        'due_date',
        'due_date_status',
        'due_date_format',
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
        $cycle = Carbon::parse($this->cycle);

        return $cycle->translatedFormat('F Y');
    }

    /**
     * Use for calculate due date
     * @return Carbon
     */
    public function getDueDateAttribute(): Carbon
    {
        return Carbon::parse($this->cycle)->setDay(config('custom.due_date'))->setTime(0, 0, 0)->addMonth();
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
    public function getDueDateStatusAttribute(): bool
    {
        return $this->due_date->lt(now());
    }

}
