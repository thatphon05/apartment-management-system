<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\FormatYearCast;
use App\Enums\UserStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'email',
        'telephone',
        'password',
        'id_card_number',
        'birthdate',
        'religion',
        'name',
        'surname',
        'address',
        'subdistrict',
        'district',
        'province',
        'postal_code',
        'id_card_copy',
        'copy_house_registration',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => UserStatusEnum::class,
        'birthdate' => FormatYearCast::class,
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'full_name',
        'full_address',
        'birth_date_format',
        'age',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class, 'user_id');
    }

    /**
     * Hash the user's password.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(mixed $value) => bcrypt($value),
        );
    }

    protected function fullName(): Attribute
    {
        $value = $this->name . ' ' . $this->surname;

        return new Attribute(
            get: fn() => $value,
        );
    }

    protected function fullAddress(): Attribute
    {
        $value = $this->address . ' ต.' . $this->subdistrict . ' อ.' . $this->district . ' จ.' .
            $this->province . ' ' . $this->postal_code;

        return new Attribute(
            get: fn() => $value,
        );
    }

    protected function birthDateFormat(): Attribute
    {
        $value = $this->birthdate->translatedFormat('l j F Y');

        return new Attribute(
            get: fn() => $value,
        );
    }

    protected function age(): Attribute
    {
        $value = $this->birthdate->diff(Carbon::now())->format('%y ปี, %m เดือน, %d วัน');

        return new Attribute(
            get: fn() => $value,
        );
    }
}
