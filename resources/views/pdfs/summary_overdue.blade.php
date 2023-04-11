@extends('pdfs.layouts.layout')
@section('title', 'สรุปยอดค้างชำระเดือน ' . $invoices->pluck('cycle_month')[0])

@section('content')
    <div class="card-body">
        <div class="row text-center mb-3">
            <h1 class="bold heading">สรุปยอดค้างชำระเดือน {{ $invoices->pluck('cycle_month')[0] }}</h1>
        </div>
        <div class="row">
            <div class="col-6">
                <h3 class="bold heading-2">{{ config('custom.address.name') }}</h3>
                <address>
                    {{ config('custom.address.line1') }}
                    {{ config('custom.address.line2') }}
                    {{ config('custom.address.line3') }}
                </address>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <td class="text-center pt-0" colspan="6">สรุปยอดค้างชำระรวมทั้งหมด (ทั้งหมด {{ $invoices->count() }}
                    ห้อง)
                </td>
            </tr>
            <tr>
                <td class="text-center bold" style="width: 10%">ใบแจ้งหนี้</td>
                <td class="text-center bold">ห้อง</td>
                <td class="text-center bold">ผู้เช่า</td>
                <td class="text-center bold" style="width: 12%">เบอร์ติดต่อ</td>
                <td class="text-center bold" style="width: 12%">วันที่ต้องชำระเงินวันสุดท้าย</td>
                <td class="text-center bold" style="width: 11%">ยอดค้างชำระ</td>
            </tr>
            </thead>
            <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($invoices as $invoice)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        อาคาร {{ $invoice->room->floor->building->name }}
                        ชั้น {{ $invoice->room->floor->name }}
                        ห้อง {{ $invoice->room->name }}
                    </td>
                    <td class="text-center">{{ $invoice->user->full_name }}</td>
                    <td class="text-center">{{ $invoice->user->telephone }}</td>
                    <td class="text-center">{{ $invoice->last_date->translatedFormat('d F Y') }}</td>
                    <td class="text-end pe-1">{{ number_format($invoice->dynamic_summary, 2) }}</td>
                </tr>
                @php
                    $total += $invoice->dynamic_summary
                @endphp
            @endforeach
            <tr>
                <td colspan="5" class="text-end bold pe-1">รวมทั้งสิ้น</td>
                <td class="text-end pe-1">
                    {{ number_format($total, 2) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
