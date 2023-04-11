<div class="row text-end mb-2">
    <p class="fs-1">ใบแจ้งหนี้ #{{ $invoice->id }}</p>
</div>
<div class="row">
    <div class="col-6">
        <p class="h3">{{ config('custom.address.name') }}</p>
        <address>
            {{ config('custom.address.line1') }}<br>
            {{ config('custom.address.line2') }}<br>
            {{ config('custom.address.line3') }}
        </address>
    </div>
    <div class="col-6 text-end">
        <p class="h3">ผู้เช่า</p>
        <address>
            {{ $invoice->user->full_name }} <br>
            {{ $invoice->user->full_address }}
        </address>
    </div>
    <div class="mb-4 d-flex justify-content-between border-top p-3 border-bottom">
        <div class="mb-sm-3">
            โอนเงินที่<br>
            ธนาคาร {{ config('custom.banking_account.bank_name') }}<br>
            เลขบัญชี {{ config('custom.banking_account.number') }}<br>
            นาย {{ config('custom.banking_account.name') }}<br>
        </div>
        <div class="text-end mt-md-0 mt-sm-2">
            <h4>
                สถานะ: <span
                    class="badge bg-{{ InvoiceStatusEnum::getColor($invoice->status) }}">
                                                {{ InvoiceStatusEnum::getLabel($invoice->status) }}
                                        </span>
            </h4>
            <h4>
                อาคาร: {{ $invoice->room->floor->building->name ?? '' }}
                ชั้น: {{ $invoice->room->floor->name ?? '' }}
                ห้อง: {{ $invoice->room->name ?? '' }}
            </h4>
            <h4>
                วันที่สร้าง: {{ $invoice->created_at->translatedFormat('d F Y') }}
            </h4>
            <h4>
                ประจำเดือน: {{ $invoice->cycle_month }}
            </h4>
            <h4>
                ครบกำหนดชำระ: {{ $invoice->due_date_format }}
            </h4>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table border">
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
            <td class="text-center">{{ $invoice->water_unit_price }}</td>
            <td class="text-end">{{ number_format($invoice->water_total_divided, 2) }}</td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>
                <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการน้ำ</p>
            </td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center">{{ $invoice->water_unit }}</td>
            <td class="text-center">{{ $invoice->water_unit_price }}</td>
            <td class="text-end">{{ number_format($invoice->water_total_divided, 2) }}</td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>
                <p class="strong mb-1">ค่าไฟฟ้า</p>
            </td>
            <td class="text-center">{{ $invoice->electric_unit_last }}</td>
            <td class="text-center">{{ $invoice->electric_unit_later }}</td>
            <td class="text-center">{{ $invoice->electric_unit }}</td>
            <td class="text-center">{{ $invoice->electric_unit_price }}</td>
            <td class="text-end">{{ number_format($invoice->electric_total_divided, 2) }}</td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>
                <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการไฟฟ้า</p>
            </td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center">{{ $invoice->electric_unit }}</td>
            <td class="text-center">{{ $invoice->electric_unit_price }}</td>
            <td class="text-end">{{ number_format($invoice->electric_total_divided, 2) }}</td>
        </tr>
        <tr>
            <td class="text-center">5</td>
            <td>
                <p class="strong mb-1">ค่าเช่าห้อง ({{ $invoice->cycle_month }})</p>
            </td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-end">{{ number_format($invoice->rent_total, 2) }}</td>
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
            <td class="text-end">{{ number_format($invoice->common_total, 2) }}</td>
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
            <td class="text-end">{{ number_format($invoice->parking_total, 2) }}</td>
        </tr>
        <tr>
            <td class="text-center">8</td>
            <td>
                <p class="strong mb-1">ค่าปรับชำระเลยกำหนด</p>
                <div class="text-muted">หากชำระเงินเกินวันที่ {{ $invoice->due_date_format }}
                    จะเสียค่าปรับวันละ {{ number_format($invoice->room->configuration->overdue_fee) }}
                    บาท
                    แต่ปรับไม่เกินวันที่ {{ $invoice->last_date->translatedFormat('d F Y') }}
                </div>
            </td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-end">
                @if ($invoice->status === InvoiceStatusEnum::COMPLETE)
                    {{ number_format($invoice->overdue_total, 2) }}
                @else
                    {{ number_format($invoice->summary <= 0 ? $invoice->dynamic_overdue_total : $invoice->overdue_total, 2) }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="6" class="strong text-end">รวมทั้งสิ้น</td>
            <td class="text-end">
                {{ number_format($invoice->summary <= 0 ? $invoice->dynamic_summary : $invoice->summary, 2) }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
