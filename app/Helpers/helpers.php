<?php

use Carbon\Carbon;


if (!function_exists('convertDateToAD')) {
    /**
     * Convert B.E. to A.D.
     * @param $date
     * @return Carbon
     */
    function convertDateToAD($date): Carbon
    {
        $parse = Carbon::parse($date);

        if ($parse->year > 2400) {
            return $parse->subYears(543);
        }

        return $parse;
    }
}

if (!function_exists('convertDateToBE')) {
    /**
     * Convert to B.E.
     * @param $date
     * @return Carbon
     */
    function convertDateToBE($date): Carbon
    {
        return Carbon::parse($date)->addYears(543);
    }
}

if (!function_exists('getAllMonth')) {
    /**
     * get all month available
     * @return string[]
     */
    function getAllMonth(): array
    {
        return [
            'มกราคม',
            'กุมภาพันธ์',
            'มีนาคม',
            'เมษายน',
            'พฤษภาคม',
            'มิถุนายน',
            'กรกฎาคม',
            'สิงหาคม',
            'กันยายน',
            'ตุลาคม',
            'พฤศจิกายน',
            'ธันวาคม',
        ];
    }
}
