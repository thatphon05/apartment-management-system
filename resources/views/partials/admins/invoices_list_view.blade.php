<div class="card">
    <h3 class="card-header">รายการใบแจ้งหนี้</h3>
    <div class="card-table table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#เลขใบแจ้งหนี้</th>
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
                            <a href="{{ route('admin.invoices.edit', ['invoice' => $invoice->id]) }}">
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
                    <td>
                        {{ count($invoice->payments) < 1 ? 'ยังไม่ได้แจ้งชำระ' : 'ชำระแล้ว' }}
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
    @endif
</div>
