<div class="card">
    <h3 class="card-header">รายการใบแจ้งหนี้</h3>
    <div class="card-table table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>ห้อง</th>
                <th>สถานะ</th>
                <th>ประจำเดือน</th>
                <th>วันครบกำหนดชำระ</th>
            </tr>
            </thead>
            <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>
                        <a href="#">
                            #{{ $invoice->id }}
                        </a>

                    </td>
                    <td>
                        อาคาร {{ $invoice->booking->room->floor->building->name }}
                        ชั้น {{ $invoice->booking->room->floor->name }}
                        ห้อง {{ $invoice->booking->room->name }}
                    </td>
                    <td>
                        @if ($invoice->is_due_date && $invoice->status == \App\Enums\InvoiceStatusEnum::PENDING)
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
</div>
