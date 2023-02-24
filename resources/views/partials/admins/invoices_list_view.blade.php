<div class="card">
    <div class="card-header row align-items-center">
        <div class="col-auto fs-3">
            รายการใบแจ้งหนี้
        </div>
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
                        @if($invoice->is_due_date && $invoice->status == \App\Enums\InvoiceStatusEnum::PENDING)
                            <span class="badge bg-red">
                                {{ \App\Enums\InvoiceStatusEnum::getLabel(\App\Enums\InvoiceStatusEnum::OVERDUE) }}
                            </span>
                        @else
                            <span class="badge bg-{{ \App\Enums\InvoiceStatusEnum::getColor($invoice->status) }}">
                                {{ \App\Enums\InvoiceStatusEnum::getLabel($invoice->status) }}
                            </span>
                        @endif

                    </td>
                    <td>
                        {{ $invoice->cycle_date }}
                    </td>
                    <td>
                        {{ $invoice->due_date_format }}
                    </td>
                    <td class="text-{{ count($invoice->payments) < 1 ? 'red' : 'green' }}">
                        {{ count($invoice->payments) < 1 ? 'ยังไม่ได้แจ้งชำระเงิน' : 'แจ้งชำระเงินแล้ว' }}
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
        <div class="card-footer d-flex align-items-center">

            <div class="m-0 ms-auto">
                {{ $invoices->links() }}
            </div>


        </div>
    @else
        <div class="card-footer text-center">
            <a href="{{ route('admin.invoices.index', $parameters ?? []) }}">ดูทั้งหมด</a>
        </div>
    @endif
</div>
