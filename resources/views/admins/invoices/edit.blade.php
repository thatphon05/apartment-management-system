@extends('layouts.admin')
@section('title', 'ใบแจ้งหนี้ #' . $invoice->id)
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            ใบแจ้งหนี้ #{{ $invoice->id }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">โทพาซ</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ltd@example.com
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <p class="h3">Client</p>
                                <address>
                                    {{ $invoice->user->full_name }} <br>
                                    {{ $invoice->user->full_address }}
                                </address>
                            </div>
                            <div class="col-12 my-5">
                                <h1>
                                    อาคาร {{ $invoice->room->floor->building->name ?? '' }}
                                    ชั้น {{ $invoice->room->floor->name ?? '' }}
                                    ห้อง {{ $invoice->room->name ?? '' }}
                                </h1>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>รายการ</th>
                                <th class="text-center" style="width: 1%">เลขครั้งก่อน</th>
                                <th class="text-end" style="width: 1%">เลขครั้งหลัง</th>
                                <th class="text-end" style="width: 1%">หน่วย</th>
                                <th class="text-end" style="width: 1%">หน่วยละ</th>
                                <th class="text-end" style="width: 1%">จำนวนเงิน (บาท)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="strong mb-1">ค่าน้ำประปา</p>
                                </td>
                                <td class="text-center">{{ $invoice->water_unit_last }}</td>
                                <td class="text-center">{{ $invoice->water_unit_later }}</td>
                                <td class="text-center">{{ $invoice->water_unit }}</td>
                                <td class="text-center">{{ $invoice->water_unit_price_divide }}</td>
                                <td class="text-end">{{ $invoice->water_total_divided }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการน้ำ</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $invoice->water_unit }}</td>
                                <td class="text-center">{{ $invoice->water_unit_price_divide }}</td>
                                <td class="text-end">{{ $invoice->water_total_divided }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="strong mb-1">ค่าไฟฟ้า</p>
                                </td>
                                <td class="text-center">{{ $invoice->electric_unit_last }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_later }}</td>
                                <td class="text-center">{{ $invoice->electric_unit }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_price_divide }}</td>
                                <td class="text-end">{{ $invoice->electric_total_divided }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการไฟฟ้า</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $invoice->electric_unit }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_price_divide }}</td>
                                <td class="text-end">{{ $invoice->electric_total_divided }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <p class="strong mb-1">ค่าเช่าห้อง</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ $invoice->rent_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <p class="strong mb-1">ค่าส่วนกลาง</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ $invoice->common_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>
                                    <p class="strong mb-1">ค่าจอดรถ</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ $invoice->parking_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td>
                                    <p class="strong mb-1">ค่าปรับชำระเลยกำหนด</p>
                                    <div class="text-muted">หากชำระเงินเกินวันที่ {{ $invoice->due_date_format }}
                                        จะเสียค่าปรับวันละ 50 บาท
                                        แต่ปรับไม่เกิน 15 วัน
                                    </div>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ $invoice->overdue_total <= 0 ? $invoice->dynamic_overdue_total : $invoice->overdue_total }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="strong text-end">รวมทั้งสิ้น</td>
                                <td class="text-end">{{ $invoice->summary <= 0 ? $invoice->dynamic_summary : $invoice->summary }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look
                            forward
                            to working with
                            you again!</p>
                    </div>
                </div>
            </div>

        </div>
@endsection


