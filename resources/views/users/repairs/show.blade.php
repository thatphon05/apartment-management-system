@extends('layouts.user')
@section('title', 'ดูการแจ้งซ่อม')
@section('breadcrumb', Breadcrumbs::render('user.repair-show', $repair))
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            ดูการแจ้งซ่อม
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
                                    <dt class="col-3">หมายเลขแจ้งซ่อม:</dt>
                                    <dd class="col-9">#{{$repair->id}}</dd>
                                    <dt class="col-3">ห้อง:</dt>
                                    <dd class="col-9">
                                        <a href="{{ route('user.bookings.show', ['booking' => $repair->booking_id]) }}">
                                            อาคาร {{$repair->room->floor->building->name}}
                                            ชั้น {{$repair->room->floor->name}}
                                            ห้อง {{$repair->room->name}}
                                        </a>
                                    </dd>
                                    <dt class="col-3">วันที่แจ้ง:</dt>
                                    <dd class="col-9">{{$repair->created_at}}</dd>
                                    <dt class="col-3">ชื่อผู้แจ้ง:</dt>
                                    <dd class="col-9">{{ $repair->user->full_name }}
                                    </dd>
                                    <dt class="col-3">สถานะ:</dt>
                                    <dd class="col-9">
                                        <span
                                            class="badge bg-{{ \App\Enums\RepairStatusEnum::getColor($repair->status) }}">
                                                {{ \App\Enums\RepairStatusEnum::getLabel($repair->status) }}
                                        </span>
                                    </dd>
                                    <dt class="col-3">เรื่องที่แจ้ง:</dt>
                                    <dd class="col-9">{{$repair->subject}}</dd>
                                    <dt class="col-3">รายละเอียด:</dt>
                                    <dd class="col-9">
                                        {{$repair->description}}
                                    </dd>
                                    <hr class="mt-3 mb-3">
                                    <h3 class="fw-bold mb-3">รายละเอียดเพิ่มเติมจากผู้ดูแล</h3>
                                    <dt class="col-3">วันที่เข้าซ่อม:</dt>
                                    <dd class="col-9">{{$repair->repair_date ?? 'ยังไม่กำหนดวันเข้าซ่อม'}}</dd>
                                    <dt class="col-3">รายละเอียดเพิ่มเติม:</dt>
                                    <dd class="col-9">{{$repair->note ?? 'ยังไม่ระบุ'}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


