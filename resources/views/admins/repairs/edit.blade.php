@extends('layouts.admin')
@section('title', 'แก้ไขการแจ้งซ่อม')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            แก้ไขการแจ้งซ่อม
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">รายละเอียดแจ้งซ่อม</h4>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-3">หมายเลขแจ้งซ่อม</dt>
                                    <dd class="col-9">{{$repair->id}}</dd>
                                    <dt class="col-3">ห้อง</dt>
                                    <dd class="col-9">อาคาร {{$repair->room->floor->building->name}}
                                        ชั้น {{$repair->room->floor->name}}
                                        ห้อง {{$repair->room->name}}</dd>
                                    <dt class="col-3">วันที่แจ้ง</dt>
                                    <dd class="col-9">{{$repair->created_at}}</dd>
                                    <dt class="col-3">ชื่อผู้แจ้ง</dt>
                                    <dd class="col-9">{{$repair->user->full_name}}</dd>
                                    <dt class="col-3">สถานะ</dt>
                                    <dd class="col-9">
                                        <span
                                            class="badge bg-{{ \App\Enums\RepairStatusEnum::getColor($repair->status) }}">
                                                {{ \App\Enums\RepairStatusEnum::getLabel($repair->status) }}
                                        </span>
                                    </dd>
                                    <dt class="col-3">เรื่องที่แจ้ง</dt>
                                    <dd class="col-9">{{$repair->subject}}</dd>
                                    <dt class="col-3">รายละเอียด:</dt>
                                    <dd class="col-9">
                                        {{$repair->description}}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.repairs.update', ['repair' => $repair->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card mt-2">
                                <div class="card-header">
                                    <h4 class="card-title">ปรับสถานะ</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">กำหนดวันที่เข้าซ่อม</label>
                                            <input
                                                value="{{ old('repair_date') ?? $repair->repair_date }}"
                                                name="repair_date"
                                                type="datetime-local"
                                                onchange="inputChange(event)"
                                                class="form-control @error('repair_date') is-invalid @enderror"
                                                placeholder="เลือกเวลาเข้าซ่อม">
                                            @error('repair_date')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">รายละเอียดเพิ่มเติม</label>
                                            <textarea name="note" type="text"
                                                      onchange="inputChange(event)"
                                                      class="form-control @error('note') is-invalid @enderror"
                                                      placeholder="รายละเอียดเพิ่มเติม">{{ old('note') ?? $repair->note }}</textarea>
                                            @error('note')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">ปรับสถานะ</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            @foreach(\App\Enums\RepairStatusEnum::values() as $key => $value)
                                                <option
                                                    value="{{ $key }}" @selected(\App\Enums\RepairStatusEnum::from($key) === $repair->status)>
                                                    {{ \App\Enums\RepairStatusEnum::getLabel($value) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                    <a href="{{ route('admin.repairs.index') }}"
                                       class="btn btn-ghost-secondary">ย้อนกลับ</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


