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
            'PENDING', InvoiceStatusEnum::PENDING => 'รอชำระเงิน',
            'COMPLETE', InvoiceStatusEnum::COMPLETE => 'ชำระเงินแล้ว',
            'OVERDUE', InvoiceStatusEnum::OVERDUE => 'เกินกำหนด',
            'CANCEL', InvoiceStatusEnum::CANCEL => 'ยกเลิก',
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'PENDING', InvoiceStatusEnum::PENDING => 'azure',
            'COMPLETE', InvoiceStatusEnum::COMPLETE => 'green',
            'OVERDUE', InvoiceStatusEnum::OVERDUE => 'orange',
            'CANCEL', InvoiceStatusEnum::CANCEL => '',
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
