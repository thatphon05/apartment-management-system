<?php

namespace App\Enums;

enum InvoiceStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case OVERDUE = 2;
    case CANCEL = 3;

    public static function getLabel(self|string $value): string
    {
        return match ($value) {
            'PENDING', self::PENDING => 'รอชำระเงิน',
            'COMPLETE', self::COMPLETE => 'ชำระเงินแล้ว',
            'OVERDUE', self::OVERDUE => 'เกินกำหนด',
            'CANCEL', self::CANCEL => 'ยกเลิก',
        };
    }

    public static function getColor(self|string $value): string
    {
        return match ($value) {
            'PENDING', self::PENDING => 'azure',
            'COMPLETE', self::COMPLETE => 'green',
            'OVERDUE', self::OVERDUE => 'orange',
            'CANCEL', self::CANCEL => '',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
