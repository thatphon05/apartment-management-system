@extends('layouts.admin')
@section('title', 'แก้ไขการห้อง ' . $room->name)
@section('breadcrumb', Breadcrumbs::render('admin.room-edit', $room))
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            แก้ไขการตั้งค่า อาคาร {{ $room->floor->building->name }} ชั้น {{ $room->floor->name }}
                            ห้อง {{ $room->name }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <form action="{{ route('admin.rooms.update' , ['room' => $room->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label required">เลือกราคาห้อง</label>
                                            <select name="configuration_id"
                                                    class="form-select @error('configuration_id') is-invalid @enderror">
                                                @foreach($configurations as $configuration)
                                                    <option
                                                        value="{{ $configuration->id }}"
                                                        @selected($configuration->id == $room->configuration_id)
                                                        @selected(old('configuration_id') == $room->configuration_id)
                                                    >
                                                        {{ $configuration->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('configuration_id')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-start">
                                <button type="submit" class="btn btn-primary">แก้ไข</button>
                                <a href="{{ route('admin.buildings.show', ['building' => $room->floor->building_id]) }}"
                                   class="btn btn-ghost-secondary">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

