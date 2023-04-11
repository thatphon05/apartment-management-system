@extends('pdfs.layouts.layout')
@section('title', 'ใบเสร็จรับเงิน ' . $invoice->cycle_month)

@section('content')
    <div class="card-body">
        <div class="row text-end mb-3">
            <h2 class="bold heading">ใบเสร็จรับเงิน #{{ $invoice->id }}</h2>
        </div>
        <table style="border:none; width: 100%" class="mt-4">
            <tr style="border:none;">
                <td style=" border:none;">
                    <p class="bold">{{ config('custom.address.name') }}</p>
                    <address>
                        {{ config('custom.address.line1') }}
                        {{ config('custom.address.line2') }}<br>
                        {{ config('custom.address.line3') }}
                    </address>
                </td>
                <td style="border:none;" class="text-end">
                    <p class="bold">ผู้เช่า</p>
                    <address>
                        {{ $invoice->user->full_name }} <br>
                        {{ $invoice->user->full_address }}
                    </address>
                </td>
            </tr>
        </table>
        <table style="border:none; width: 100%;" class="mt-4 mb-4">
            <tr style="border:none;">
                <td style="border:none;" class="text-end">
                    <p style="font-size:18px;">
                        สถานะ: {{ InvoiceStatusEnum::getLabel($invoice->status) }}<br>
                        อาคาร: {{ $invoice->room->floor->building->name ?? '' }}
                        ชั้น: {{ $invoice->room->floor->name ?? '' }}
                        ห้อง: {{ $invoice->room->name ?? '' }}<br>
                        วันที่สร้าง: {{ $invoice->created_at->translatedFormat('d F Y') }}<br>
                        ประจำเดือน: {{ $invoice->cycle_month }}<br>
                        วันที่ออกใบเสร็จ: {{ $invoice->updated_at->translatedFormat('d F Y') }}
                    </p>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
            <tr>
                <td class="text-center" style="width: 5%"></td>
                <td class="bold ps-1 ps-1">รายการ</td>
                <td class="text-center bold" style="width: 12%">เลขครั้งก่อน</td>
                <td class="text-center bold" style="width: 12%">เลขครั้งหลัง</td>
                <td class="text-center bold" style="width: 12%">หน่วย</td>
                <td class="text-center bold" style="width: 12%">หน่วยละ</td>
                <td class="text-center bold" style="width: 12%">จำนวนเงิน</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าน้ำประปา</p>
                </td>
                <td class="text-center">{{ $invoice->water_unit_last }}</td>
                <td class="text-center">{{ $invoice->water_unit_later }}</td>
                <td class="text-center">{{ $invoice->water_unit }}</td>
                <td class="text-center">{{ $invoice->water_unit_price }}</td>
                <td class="text-end pe-1">{{ number_format($invoice->water_total_divided, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าใช้จ่ายในการให้บริการน้ำ</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">{{ $invoice->water_unit }}</td>
                <td class="text-center">{{ $invoice->water_unit_price }}</td>
                <td class="text-end pe-1">{{ number_format($invoice->water_total_divided, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าไฟฟ้า</p>
                </td>
                <td class="text-center">{{ $invoice->electric_unit_last }}</td>
                <td class="text-center">{{ $invoice->electric_unit_later }}</td>
                <td class="text-center">{{ $invoice->electric_unit }}</td>
                <td class="text-center">{{ $invoice->electric_unit_price }}</td>
                <td class="text-end pe-1">{{ number_format($invoice->electric_total_divided, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าใช้จ่ายในการให้บริการไฟฟ้า</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">{{ $invoice->electric_unit }}</td>
                <td class="text-center">{{ $invoice->electric_unit_price }}</td>
                <td class="text-end pe-1">{{ number_format($invoice->electric_total_divided, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าเช่าห้อง ({{ $invoice->cycle_month }})</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-end pe-1">{{ number_format($invoice->rent_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าส่วนกลาง</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-end pe-1">{{ number_format($invoice->common_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">7</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าจอดรถ</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-end pe-1">{{ number_format($invoice->parking_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">8</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าปรับชำระเลยกำหนด</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-end pe-1">
                    {{ number_format($invoice->overdue_total <= 0 ? $invoice->dynamic_overdue_total : $invoice->overdue_total, 2) }}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="strong text-end pe-1">รวมทั้งสิ้น</td>
                <td class="text-end pe-1">
                    {{ number_format($invoice->summary <= 0 ? $invoice->dynamic_summary : $invoice->summary, 2) }}
                </td>
            </tr>
            </tbody>
        </table>
        <table style="border:none; width: 100%;" class="mt-4 mb-4">
            <tr style=" border:none;">
                <td style="width: 50%; border:none;"></td>
                <td style="width: 50%;" class="ps-2">
                    ผู้รับเงิน
                </td>
            </tr>
        </table>
    </div>
@endsection
