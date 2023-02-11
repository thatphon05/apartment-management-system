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
            'PENDING', self::PENDING => 'รอชำระเงิน',
            'COMPLETE', self::COMPLETE => 'ชำระเงินแล้ว',
            'OVERDUE', self::OVERDUE => 'เกินกำหนด',
            'CANCEL', self::CANCEL => 'ยกเลิก',
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'PENDING', self::PENDING => 'azure',
            'COMPLETE', self::COMPLETE => 'green',
            'OVERDUE', self::OVERDUE => 'orange',
            'CANCEL', self::CANCEL => '',
        };
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        $listOfEnum = array_column(self::cases(), 'name', 'value');

        unset($listOfEnum[self::OVERDUE->value]);

        return $listOfEnum;
    }

}
