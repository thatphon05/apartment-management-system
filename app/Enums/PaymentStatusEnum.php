<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case CANCEL = 2;

    public static function getLabel(self|string $value): string
    {
        return match ($value) {
            'PENDING', self::PENDING => 'รอตรวจสอบ',
            'COMPLETE', self::COMPLETE => 'ชำระเงินแล้ว',
            'CANCEL', self::CANCEL => 'ยกเลิก',
        };
    }

    public static function getColor(self|string $value): string
    {
        return match ($value) {
            'PENDING', self::PENDING => 'azure',
            'COMPLETE', self::COMPLETE => 'green',
            'CANCEL', self::CANCEL => 'secondary',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
