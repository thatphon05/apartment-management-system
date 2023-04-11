<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            รายการแจ้งซ่อม
        </h3>
    </div>
    <div class="card-table table-responsive overflow-auto" style="max-height: 15rem">
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
                        <span class="badge bg-{{ RepairStatusEnum::getColor($repair->status) }}">
                            {{ RepairStatusEnum::getLabel($repair->status) }}
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
    <a class="card-btn text-primary bg-secondary-subtle"
       href="{{ route('admin.repairs.index', $parameters ?? []) }}">
        ดูทั้งหมด
    </a>
</div>
