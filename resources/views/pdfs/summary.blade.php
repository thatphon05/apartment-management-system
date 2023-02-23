@extends('pdfs.layouts.layout')
@section('title', 'สรุปยอดประจำเดือน ' . $cycle_month)

@section('content')
    <div class="card-body">
        <div class="row text-center mb-3">
            <h1 class="bold heading">สรุปยอดประจำเดือน {{ $cycle_month }}</h1>
        </div>
        <div class="row">
            <div class="col-6">
                <h3 class="bold heading-2">โทพาซ</h3>
                <address>
                    20/20 ม.2 ถ.กิ่งแก้ว
                    ต.ราชาเทวะ อ.บางพลี
                    จ.สมุทรปราการ
                </address>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <td class="text-center pt-0" colspan="7">สรุปยอดรวมทั้งหมด (ทั้งหมด {{ $total_room }} ห้อง)</td>
            </tr>
            <tr>
                <td class="" style="width: 5%"></td>
                <td class="bold ps-1">รายการ</td>
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
                <td class="text-center">{{ number_format($water_unit_last) }}</td>
                <td class="text-center">{{ number_format($water_unit_later) }}</td>
                <td class="text-center">{{ number_format($water_unit) }}</td>
                <td class="text-center">{{ number_format($water_unit_price, 2) }}</td>
                <td class="text-end pe-1">{{ number_format($water_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าใช้จ่ายในการให้บริการน้ำ</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">{{ number_format($water_unit) }}</td>
                <td class="text-center">{{ number_format($water_unit_price, 2) }}</td>
                <td class="text-end pe-1">{{ number_format($water_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าไฟฟ้า</p>
                </td>
                <td class="text-center">{{ number_format($electric_unit_last) }}</td>
                <td class="text-center">{{ number_format($electric_unit_later) }}</td>
                <td class="text-center">{{ number_format($electric_unit) }}</td>
                <td class="text-center">{{ number_format($electric_unit_price, 2) }}</td>
                <td class="text-end pe-1">{{ number_format($electric_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าใช้จ่ายในการให้บริการไฟฟ้า</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">{{ number_format($electric_unit) }}</td>
                <td class="text-center">{{ number_format($electric_unit_price, 2) }}</td>
                <td class="text-end pe-1">{{ number_format($electric_total, 2) }}</td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td>
                    <p class="strong mb-1 ps-1">ค่าเช่าห้อง</p>
                </td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-end pe-1">{{ number_format($rent_total, 2) }}</td>
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
                <td class="text-end pe-1">{{ number_format($common_total, 2) }}</td>
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
                <td class="text-end pe-1">{{ number_format($parking_total, 2) }}</td>
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
                <td class="text-end pe-1">{{ number_format($overdue_total, 2) }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-end bold pe-1">รวมทั้งสิ้น</td>
                <td class="text-end pe-1">
                    {{ number_format($summary, 2) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
