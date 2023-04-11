<div class="card">
    <div class="card-header row align-items-center">
        <h3 class="card-title col-auto fs-3">
            รายการใบแจ้งหนี้
        </h3>

        @unless(request()->routeIs('admin.invoices.*'))
            <div class="col-auto ms-auto">
                <a href="{{ route('admin.invoices.create', $parameters ?? []) }}"
                   class="btn btn-outline-success btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    สร้างใบแจ้งหนี้
                </a>
            </div>
        @endif

    </div>
    <div class="card-table table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#ใบแจ้งหนี้</th>
                <th>ห้อง</th>
                <th>สถานะ</th>
                <th>ประจำเดือน</th>
                <th>วันครบกำหนดชำระ</th>
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
                            <span class="badge bg-{{ InvoiceStatusEnum::getColor($invoice->status) }}">
                                {{ InvoiceStatusEnum::getLabel($invoice->status) }}
                            </span>
                        @endif

                    </td>
                    <td>
                        {{ $invoice->cycle_month }}
                    </td>
                    <td>
                        {{ $invoice->due_date_format }}
                    </td>
                    @php
                        $statusColor = '';
                        if ($invoice->status === InvoiceStatusEnum::COMPLETE)
                           $statusColor = PaymentStatusEnum::getColor(PaymentStatusEnum::COMPLETE);
                        else if($invoice->payment === null)
                            $statusColor = 'red';
                        else
                            $statusColor = PaymentStatusEnum::getColor($invoice->payment->status);
                    @endphp
                    <td class="text-{{ $statusColor }}">
                        @if ($invoice->status === InvoiceStatusEnum::COMPLETE)
                            {{ PaymentStatusEnum::getLabel(PaymentStatusEnum::COMPLETE) }}
                        @elseif($invoice->payment === null)
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
    @if(isset($usePagination))
        <div class="card-footer pb-0">
            <div class="m-0 ms-auto">
                {{ $invoices->links() }}
            </div>
        </div>
    @else
        <a class="card-btn text-primary bg-secondary-subtle"
           href="{{ route('admin.invoices.index', $parameters ?? []) }}">
            ดูทั้งหมด
        </a>
    @endif
</div>
