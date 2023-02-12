<div class="card">
    <h3 class="card-header">รายการแจ้งซ่อม</h3>
    <div class="card-table table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>เรื่อง</th>
                <th>สถานะ</th>
                <th>วันที่แจ้ง</th>
            </tr>
            </thead>
            <tbody>
            @forelse($repairs as $repair)
                <tr>
                    <td>
                        <a href="{{ route('admin.repairs.edit', ['repair' => $repair->id]) }}">
                            #{{ $repair->id }}
                        </a>
                    </td>
                    <td>
                        {{ $repair->subject }}
                    </td>
                    <td>
                        <span class="badge bg-{{ \App\Enums\RepairStatusEnum::getColor($repair->status) }}">
                            {{ \App\Enums\RepairStatusEnum::getLabel($repair->status) }}
                        </span>
                    </td>
                    <td>
                        {{ $repair->created_at }}
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
    <div class="card-footer text-center">
        <a href="#">ดูทั้งหมด</a>
    </div>
</div>
