<?php

namespace App\Enums;

enum InvoiceStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case OVERDUE = 2;
    case CANCEL = 3;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'PENDING', 0 => 'รอชำระเงิน',
            'COMPLETE', 1 => 'ชำระเงินแล้ว',
            'OVERDUE', 2 => 'เกินกำหนด',
            'CANCEL', 3 => 'ยกเลิก',
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
