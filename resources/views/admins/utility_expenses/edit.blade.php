@extends('layouts.admin')
@section('title', 'แก้ไขรายการจดมิเตอร์ ประจำเดือน' . $utilityExpense->cycle_month)
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        แก้ไขรายการจดมิเตอร์
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2">
                        <form action="{{ route('admin.expenses.update', ['expense' => $utilityExpense->id ]) }}"
                              method="post">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">มิเตอร์น้ำ</label>
                                        <input value="{{ $utilityExpense->water_unit }}" name="water_unit" type="number"
                                               onchange="inputChange(event)"
                                               class="form-control  @error('water_unit') is-invalid @enderror"
                                               placeholder="มิเตอร์น้ำ">
                                        @error('water_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">มิเตอร์ไฟ</label>
                                        <input value="{{ $utilityExpense->electric_unit }}" name="electric_unit"
                                               type="number"
                                               onchange="inputChange(event)"
                                               class="form-control @error('electric_unit') is-invalid @enderror"
                                               placeholder="มิเตอร์ไฟ">
                                        @error('electric_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">จดประจำเดือน</label>
                                        <input value="{{ $utilityExpense->cycle_month }}"
                                               disabled
                                               onchange="inputChange(event)"
                                               class="form-control"
                                               placeholder="จดประจำเดือน">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-label required">ห้องพัก</div>
                                    <input
                                        value="อาคาร {{ $utilityExpense->room->floor->building->name }} ชั้น {{ $utilityExpense->room->floor->name }} ห้อง {{ $utilityExpense->room->name }}"
                                        disabled class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">แก้ไข</button>
                                <a href="{{ route('admin.expenses.index', ['room' => request()->query('roomId')]) }}"
                                   class="btn btn-ghost-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
