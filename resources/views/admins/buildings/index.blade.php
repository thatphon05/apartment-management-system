@extends('layouts.admin')
@section('title', 'อาคารทั้งหมด')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        อาคารทั้งหมด
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        {{--                        <a href=""--}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                @forelse($buildings as $building)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-success">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-building-community" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8m0 -14l0 .01m4 -.01l0 .01m0 3.99l0 .01m0 3.99l0 .01"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title">อาคาร {{ $building->name }}</h3>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer">
                                <a href="{{ route('admin.buildings.show', ['building' => $building->id]) }}"
                                   class="btn btn-primary">จัดการห้องพัก</a>
                            </div>
                        </div>
                    </div>
                @empty
                    ไม่พบอาคาร
                @endforelse
            </div>
        </div>
    </div>
@endsection
