<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class FormatYearCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Carbon
    {
        // return convertDateToBE($value);
        return Carbon::parse($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): Carbon
    {
        return convertDateToAD($value);
    }
}
