<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case FAILED = 2;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'PENDING', 0 => 'รอชำระเงิน',
            'COMPLETE', 1 => 'ชำระเงินแล้ว',
            'FAILED', 2 => 'ผิดพลาด',
        };
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
