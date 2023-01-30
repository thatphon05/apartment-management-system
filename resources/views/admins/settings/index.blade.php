@extends('layouts.admin')
@section('title', 'การตั้งค่า')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        การตั้งค่า
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.settings.edit', ['setting' => $config->id]) }}"
                           class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            แก้ไข
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายละเอียด</h3>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าเช่าห้อง</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ number_format($config->rent_price, 2) }} / เดือน</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าไฟฟ้า</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->electric_price }} / หน่วย</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าน้ำประปา</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->water_price }} / หน่วย</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าที่จอดรถ</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->parking_price }} / คัน</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าส่วนกลาง</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->common_fee }} / เดือน</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่าปรับชำระเลยกำหนด</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->damages_price }} / วัน</div>
                            </span>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">ค่ามัดจำ</div>
                            <span class="status status-green">
                                <div class="datagrid-content">{{ $config->deposit }} บาท</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
