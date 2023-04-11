<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Models\Invoice;
use App\Models\UtilityExpense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartService
{
    public function getIncomeMonth(): array
    {
        $invoiceSum = Invoice::select([
            DB::raw('DATE(cycle) as cycle'),
            DB::raw('SUM(water_total) as water_total'),
            DB::raw('SUM(electric_total) as electric_total'),
            DB::raw('SUM(rent_total) as rent_total'),
            DB::raw('SUM(parking_total) as parking_total'),
            DB::raw('SUM(common_total) as common_total'),
            DB::raw('SUM(overdue_total) as overdue_total'),
        ])
            ->whereBetween('cycle', [
                Carbon::today()->setDays(1)->subMonths(12), Carbon::today()->setDay(1),
            ])
            ->where('status', InvoiceStatusEnum::COMPLETE)
            ->groupBy('cycle')
            ->get();

        return [
            'categories' => $invoiceSum->pluck('cycle_month'),
            'series' => [
                $this->createSeriesData('ค่าน้ำประปา', $invoiceSum->pluck('water_total_divided')->toArray()),
                $this->createSeriesData('ค่าใช้จ่ายในการให้บริการน้ำ', $invoiceSum->pluck('water_total_divided')->toArray()),
                $this->createSeriesData('ค่าไฟฟ้า', $invoiceSum->pluck('electric_total_divided')->toArray()),
                $this->createSeriesData('ค่าใช้จ่ายในการให้บริการไฟฟ้า', $invoiceSum->pluck('electric_total_divided')->toArray()),
                $this->createSeriesData('ค่าเช่าห้อง', $invoiceSum->pluck('rent_total')->toArray()),
                $this->createSeriesData('ค่าส่วนกลาง', $invoiceSum->pluck('common_total')->toArray()),
                $this->createSeriesData('ค่าจอดรถ', $invoiceSum->pluck('parking_total')->toArray()),
                $this->createSeriesData('ค่าปรับชำระเลยกำหนด', $invoiceSum->pluck('overdue_total')->toArray()),
            ],
        ];
    }

    public function getIncomeSummary(): array
    {
        $invoiceSum = Invoice::select([
            DB::raw('SUM(water_total) as water_total'),
            DB::raw('SUM(electric_total) as electric_total'),
            DB::raw('SUM(rent_total) as rent_total'),
            DB::raw('SUM(parking_total) as parking_total'),
            DB::raw('SUM(common_total) as common_total'),
            DB::raw('SUM(overdue_total) as overdue_total'),
            DB::raw('SUM(summary) as summary'),
        ])
            ->where('status', InvoiceStatusEnum::COMPLETE)
            ->get();

        return [
            'labels' => [
                'ค่าน้ำประปา', 'ค่าใช้จ่ายในการให้บริการน้ำ', 'ค่าไฟฟ้า', 'ค่าใช้จ่ายในการให้บริการไฟฟ้า',
                'ค่าเช่าห้อง', 'ค่าส่วนกลาง', 'ค่าจอดรถ', 'ค่าปรับชำระเลยกำหนด',
            ],
            'series' => [
                (int)$invoiceSum->pluck('water_total')[0] / 2,
                (int)$invoiceSum->pluck('water_total')[0] / 2,
                (int)$invoiceSum->pluck('electric_total')[0] / 2,
                (int)$invoiceSum->pluck('electric_total')[0] / 2,
                (int)$invoiceSum->pluck('rent_total')[0],
                (int)$invoiceSum->pluck('parking_total')[0],
                (int)$invoiceSum->pluck('common_total')[0],
                (int)$invoiceSum->pluck('overdue_total')[0],
            ],
        ];
    }

    public function getUtilityExpenseConsumedSummary(): array
    {
        $utilityExpenseSum = UtilityExpense::select([
            DB::raw('DATE(cycle) as cycle'),
            DB::raw('SUM(water_consumed) as water_consumed'),
            DB::raw('SUM(electric_consumed) as electric_consumed'),
        ])
            ->whereBetween('cycle', [
                Carbon::today()->setDays(1)->subMonths(12),
                Carbon::today(),
            ])
            ->groupBy('cycle')
            ->get();

        $waterConsumed = $utilityExpenseSum->pluck('water_consumed')->toArray();
        $electricConsumed = $utilityExpenseSum->pluck('electric_consumed')->toArray();

        // Set first unit
        $waterConsumed[0] = 0;
        $electricConsumed[0] = 0;

        return [
            'categories' => $utilityExpenseSum->pluck('cycle_month'),
            'series' => [
                'water' => [$this->createSeriesData('หน่วยน้ำที่ใช้', $waterConsumed)],
                'electric' => [$this->createSeriesData('หน่วยไฟประปาที่ใช้', $electricConsumed)],
            ],
        ];
    }

    private function createSeriesData(string $name, array $data = []): array
    {
        return [
            'name' => $name,
            'data' => $data,
        ];
    }
}
