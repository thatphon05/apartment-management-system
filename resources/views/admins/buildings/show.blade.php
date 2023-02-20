@extends('layouts.admin')
@section('title', 'จัดการห้องพักอาคาร ' . $building->name)
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        ห้องทั้งหมดของอาคาร {{ $building->name }}
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                <tr>
                                    <th>ชื่อห้อง</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                                </thead>

                                @php
                                    $availableCount = 0;
                                    $bookingCount = 0;
                                @endphp
                                @forelse($building->floors as $floor)
                                    <tr>
                                        <th class="bg-lime-lt" colspan="5">ชั้น: {{ $floor->name }}</th>
                                    </tr>
                                    <tbody>
                                    @forelse($floor->rooms as $room)
                                        <tr>
                                            <td>ห้อง: {{ $room->name }}</td>
                                            <td class="text-muted">
                                                     <span
                                                         class="badge bg-{{
                                                                $room->bookings->isEmpty()
                                                                ? 'green'
                                                                : 'danger'
                                                     }}">
                                                         @if ($room->bookings->isEmpty())
                                                             {{ config('custom.labels.room_available') }}
                                                             @php($availableCount += 1)
                                                         @else
                                                             {{ config('custom.labels.room_booking') }}
                                                             @php($bookingCount += 1)
                                                         @endif
                                                     </span>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <div class="dropdown d-inline">
                                                        <button type="button" class="btn dropdown-toggle btn-info"
                                                                data-bs-toggle="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-eye" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round"
                                                                 stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                      fill="none"></path>
                                                                <circle cx="12" cy="12" r="2"></circle>
                                                                <path
                                                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                            </svg>
                                                            ดู
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.rooms.show', ['room' => $room->id]) }}">
                                                                ดูข้อมูลห้องพัก
                                                            </a>
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.expenses.index', ['room' => $room->id]) }}">
                                                                ดูค่าน้ำค่าไฟ
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}"
                                                       class="btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-edit" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        แก้ไข
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        ไม่พบห้อง
                                    @endforelse
                                    </tbody>
                                @empty
                                    ไม่พบชั้น
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>สถานะ</h2>
                        </div>
                        <div class="card-stamp">
                            <div class="card-stamp-icon bg-yellow">
                                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item list-group-item-action">
                                ห้องพักที่ว่าง {{ $availableCount }}

                            </div>
                            <div class="list-group-item list-group-item-action">
                                ห้องพักที่ไม่ว่าง {{ $bookingCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
