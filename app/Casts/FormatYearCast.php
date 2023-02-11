<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class FormatYearCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        // return convertDateToBE($value);
        return Carbon::parse($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        return convertDateToAD($value);
    }
}
