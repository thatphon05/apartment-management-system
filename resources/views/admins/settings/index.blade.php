@extends('layouts.admin')
@section('title', 'การตั้งค่า')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        รายการการคั้งค่าธรรมเนียม
                    </h2>
                </div>
                <!-- Page title actions -->
                {{--                <div class="col-auto ms-auto d-print-none">--}}
                {{--                    <div class="btn-list">--}}
                {{--                        <a href="{{ route('admin.settings.edit', ['setting' => $config->id]) }}"--}}
                {{--                           class="btn btn-primary d-none d-sm-inline-block">--}}
                {{--                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->--}}
                {{--                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"--}}
                {{--                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"--}}
                {{--                                 stroke-linecap="round" stroke-linejoin="round">--}}
                {{--                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                {{--                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>--}}
                {{--                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>--}}
                {{--                                <path d="M16 5l3 3"></path>--}}
                {{--                            </svg>--}}
                {{--                            แก้ไข--}}
                {{--                        </a>--}}

                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    รายการการคั้งค่าธรรมเนียม
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ประเภทห้อง</th>
                            <th>ค่าห้อง</th>
                            <th>ค่าไฟ</th>
                            <th>ค่าน้ำ</th>
                            <th>ค่าที่จอดรถ</th>
                            <th>ค่าส่วนกลาง</th>
                            <th>ค่าเลยกำหนดชำระ</th>
                            <th>ค่ามัดจำ</th>
                            <th>วันเวลาที่แก้ไข</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($configs as $config)
                            <tr>
                                <td>{{ $config->id }}</td>
                                <td>{{ $config->name }}</td>
                                <td>{{ $config->rent_fee }}</td>
                                <td>{{ $config->electric_fee }}</td>
                                <td>{{ $config->water_fee }}</td>
                                <td>{{ $config->parking_fee }}</td>
                                <td>{{ $config->common_fee }}</td>
                                <td>{{ $config->overdue_fee }}</td>
                                <td>{{ $config->deposit }}</td>
                                <td>{{ $config->updated_at }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.settings.edit', ['setting' => $config->id]) }}"
                                       class="btn"
                                       role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-edit"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        แก้ไขข้อมูล
                                    </a>
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
                <div class="card-footer d-flex align-items-center">
                    <div class="m-0 ms-auto">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
