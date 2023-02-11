<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class FormatYearCast implements CastsAttributes
{
    /**
     * @param $model
     * @param $key
     * @param $value
     * @param $attributes
     * @return Carbon|mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        // return convertDateToBE($value);
        return Carbon::parse($value);
    }

    /**
     * @param $model
     * @param $key
     * @param $value
     * @param $attributes
     * @return Carbon|mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return convertDateToAD($value);
    }
}
