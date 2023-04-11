@extends('layouts.admin')
@section('title', 'หน้าแรก')
@section('breadcrumb', Breadcrumbs::render('admin.dashboard'))
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Notification -->
            <div class="col-12">
                <h2 class="page-title mb-3">
                    สรุป
                </h2>
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                  <svg xmlns="http://www.w3.org/2000/svg"
                                       class="icon icon-tabler icon-tabler-building-community" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path
                                           d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                       <path d="M13 7l0 .01"></path>
                                       <path d="M17 7l0 .01"></path>
                                       <path d="M17 11l0 .01"></path>
                                       <path d="M17 15l0 .01"></path>
                                    </svg>
                                </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            ห้องทั้งหมด {{ $totalRoom }}
                                        </div>
                                        <div class="text-muted">
                                            ห้องว่าง {{ $availableRoom }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.buildings.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l14 0"></path>
                                                <path d="M13 18l6 -6"></path>
                                                <path d="M13 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                      <svg xmlns="http://www.w3.org/2000/svg"
                                           class="icon icon-tabler icon-tabler-file-invoice"
                                           width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                           stroke="currentColor"
                                           fill="none" stroke-linecap="round" stroke-linejoin="round">
                                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                           <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                           <path
                                               d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                           <path d="M9 7l1 0"></path>
                                           <path d="M9 13l6 0"></path>
                                           <path d="M13 17l2 0"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            ใบแจ้งหนี้ {{ $totalInvoice }}
                                        </div>
                                        <div class="text-muted">
                                            {{ InvoiceStatusEnum::getLabel(InvoiceStatusEnum::PENDING) }}
                                            {{ $totalInvoicePending }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.invoices.index', [
                                                    'status[0]' => InvoiceStatusEnum::PENDING,
                                                    'status[1]' => InvoiceStatusEnum::OVERDUE
                                                    ])
                                                 }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l14 0"></path>
                                                <path d="M13 18l6 -6"></path>
                                                <path d="M13 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                    <span class="bg-red text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-hammer"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                           <path
                                               d="M11.414 10l-7.383 7.418a2.091 2.091 0 0 0 0 2.967a2.11 2.11 0 0 0 2.976 0l7.407 -7.385"></path>
                                           <path
                                               d="M18.121 15.293l2.586 -2.586a1 1 0 0 0 0 -1.414l-7.586 -7.586a1 1 0 0 0 -1.414 0l-2.586 2.586a1 1 0 0 0 0 1.414l7.586 7.586a1 1 0 0 0 1.414 0z"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            รายการแจ้งซ่อม {{ $totalRepair }}
                                        </div>
                                        <div class="text-muted">
                                            แจ้งซ่อมใหม่ {{ $totalRepairNew }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.repairs.index', ['status[]' => RepairStatusEnum::NEW]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l14 0"></path>
                                                <path d="M13 18l6 -6"></path>
                                                <path d="M13 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                    <span class="bg-warning text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-user"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            ผู้เช่า {{ $totalUser }}
                                        </div>
                                        <div class="text-muted">
                                            ใช้งานได้ {{ $totalUserActive }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.users.index', ['status[]' => UserStatusEnum::ACTIVE]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l14 0"></path>
                                                <path d="M13 18l6 -6"></path>
                                                <path d="M13 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Notification -->
            <div class="col-12">
                <h2 class="page-title mb-3 mt-4">
                    รายการใหม่
                </h2>
                <div class="row">
                    <!-- New payment notification -->
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    รายการแจ้งชำระเงินล่าสุด
                                </h3>
                            </div>
                            <div class="card-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#ใบแจ้งหนี้</th>
                                        <th>ห้อง</th>
                                        <th>สถานะใบแจ้งหนี้</th>
                                        <th>ประจำเดือน</th>
                                        <th>การแจ้งชำระเงิน</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($invoices as $invoice)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <a href="{{ route('admin.invoices.show', ['invoice' => $invoice->id]) }}">
                                                        #{{ $invoice->id }}
                                                    </a>
                                                </a>
                                            </td>
                                            <td>
                                                อาคาร {{ $invoice->room->floor->building->name }}
                                                ชั้น {{ $invoice->room->floor->name }}
                                                ห้อง {{ $invoice->room->name }}
                                            </td>
                                            <td>
                                                @if($invoice->is_due_date && $invoice->status == InvoiceStatusEnum::PENDING)
                                                    <span class="badge bg-red">
                                {{ InvoiceStatusEnum::getLabel(InvoiceStatusEnum::OVERDUE) }}
                            </span>
                                                @else
                                                    <span
                                                        class="badge bg-{{ InvoiceStatusEnum::getColor($invoice->status) }}">
                                {{ InvoiceStatusEnum::getLabel($invoice->status) }}
                            </span>
                                                @endif

                                            </td>
                                            <td>
                                                {{ $invoice->cycle_month }}
                                            </td>
                                            <td class="text-{{ $invoice->payment === null
                                                    ? 'red'
                                                    : PaymentStatusEnum::getColor($invoice->payment->status)
                                                    }}
                                        ">
                                                @if($invoice->payment === null)
                                                    ยังไม่ได้แจ้งชำระเงิน
                                                @else
                                                    {{ PaymentStatusEnum::getLabel($invoice->payment->status) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                @include('partials.empty')
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <a class="card-btn text-primary bg-secondary-subtle"
                               href="{{ route('admin.invoices.index', $parameters ?? []) }}">
                                ดูทั้งหมด
                            </a>
                        </div>
                    </div>
                    <!--/ New payment notification -->

                    <!-- repair must do today -->
                    <div class="col-md-6 mt-2">
                        @include('partials.admins.repair_list_view', ['repairs' => $repairs])
                    </div>
                    <!--/ repair must do today -->
                </div>
            </div>
            <!-- Income section -->
            <div class="col-12">
                <div class="row card-group">
                    <!-- Show all income -->
                    <div class="col-md-3 mt-4">
                        @include('partials.admins.charts.income_summary', [
                            'chartIncomeSummary' => $chartIncomeSummary
                        ])
                    </div>
                    <!--/ Show all income -->
                    <!-- Show income chart -->
                    <div class="col-md-9 mt-4">
                        @include('partials.admins.charts.income_month', [
                            'chartIncomeMonth' => $chartIncomeMonth
                        ])
                    </div>
                    <!--/ Show income chart -->
                </div>
            </div>
            <!--/ Income section -->
            <!-- Utility Expense section -->
            <div class="col-12">
                <div class="row">
                    <!-- Show Water -->
                    <div class="col-md-6 mt-4">
                        @include('partials.admins.charts.expense_water_summary', [
                            'chartUtilityExpense' => $chartUtilityExpense
                        ])
                    </div>
                    <!--/ Show all income -->
                    <!-- Show income chart -->
                    <div class="col-md-6 mt-4">
                        @include('partials.admins.charts.expense_electric_summary', [
                            'chartUtilityExpense' => $chartUtilityExpense
                        ])
                    </div>
                    <!--/ Show Eletric -->
                </div>
            </div>
            <!--/ Utility Expense section -->
        </div>
    </div>
@endsection
