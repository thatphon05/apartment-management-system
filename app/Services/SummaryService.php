<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Http\Requests\ExportSummaryMonthRequest;
use App\Http\Requests\ExportSummaryOverdueRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SummaryService
{
    public function getSummaryMonth(ExportSummaryMonthRequest $request): array
    {
        $cycle = Carbon::parse($request->cycle);

        $invoice = Invoice::where('status', InvoiceStatusEnum::COMPLETE)
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->get();

        $summary['cycle_month'] = $invoice->first()->cycle_month; // ประจำเดือน
        $summary['total_room'] = $invoice->count(); // จำนวนห้องที่ใช้ออกรายงาน

        $summary['water_unit_last'] = $invoice->sum('water_unit_last'); // จดน้ำครั้งก่อน
        $summary['water_unit_later'] = $invoice->sum('water_unit_later'); // จดน้ำครั้งหลัง
        $summary['water_unit'] = $invoice->sum('water_unit'); // หน่วยน้ำที่ใช้
        $summary['water_unit_price'] = $invoice->sum('water_unit_price'); // ค่าน้ำต่อหน่วย
        $summary['water_total'] = $invoice->sum('water_total_divided'); // รวมค่าน้ำ

        $summary['electric_unit_last'] = $invoice->sum('electric_unit_last'); // จดไฟครั้งก่อน
        $summary['electric_unit_later'] = $invoice->sum('electric_unit_later'); // จดไฟครั้งหลัง
        $summary['electric_unit'] = $invoice->sum('electric_unit'); // หน่วยไฟที่ใช้
        $summary['electric_unit_price'] = $invoice->sum('electric_unit_price'); // ค่าไฟต่อหน่วย
        $summary['electric_total'] = $invoice->sum('electric_total_divided'); // รวมค่าไฟ

        $summary['rent_total'] = $invoice->sum('rent_total'); // ค่าเช่าห้อง
        $summary['parking_total'] = $invoice->sum('parking_total'); // ค่าจอดรถ
        $summary['common_total'] = $invoice->sum('common_total'); // ค่าส่วนกลาง
        $summary['overdue_total'] = $invoice->sum('overdue_total'); // ค่าปรับชำระเลยกำหนด
        $summary['summary'] = $invoice->sum('summary'); // รวมทั้งสิ้น

        return $summary;
    }

    public function getSummaryOverdue(ExportSummaryOverdueRequest $request): Collection
    {
        $cycle = Carbon::parse($request->cycle);

        return Invoice::with(['user', 'room.floor.building', 'room.configuration'])
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            // Query OVERDUE
            ->whereDate('last_date', '<', today())
            ->where('status', InvoiceStatusEnum::PENDING)
            ->oldest('room_id')
            ->get();
    }
}
