@extends('layouts.admin')
@section('title', 'รายการจดมิเตอร์')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายการจดมิเตอร์
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row align-items-center">
                            <div class="col-auto fs-3">
                                <a class="btn btn-white"
                                   href="{{ route('admin.rooms.show', ['room' => $roomId]) }}">
                                    ย้อนกลับ
                                </a>
                            </div>
                            <div class="col-auto ms-auto">
                                <a href="{{ route('admin.expenses.create', ['roomId' => $roomId]) }}"
                                   class="btn btn-azure">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    เพิ่มรายการ
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ประจำเดือน</th>
                                    <th>ห้อง</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td>
                                            <span class="text-muted">
                                            <a href="">
                                                    #{{ $expense->id }}
                                            </a>
                                            </span>
                                        </td>
                                        <td><span class="text-muted">{{ $expense->cycle_month }}</span></td>
                                        <td>
                                            <span class="text-muted">
                                                <a href="#">
                                                    อาคาร {{ $expense->room->building->name ?? '' }}
                                                    ชั้น {{ $expense->room->floor->name ?? '' }}
                                                    ห้อง {{ $expense->room->name ?? '' }}
                                                </a>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href=""
                                               class="btn"
                                               role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="2"></circle>
                                                    <path
                                                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                </svg>
                                                ดูข้อมูล
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
                                {{ $expenses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
