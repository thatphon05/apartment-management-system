@extends('layouts.admin')
@section('title', 'จัดการผู้เช่า')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        จัดการผู้เช่า
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            เพิ่มผู้เช่า
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                           data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </a>
                    </div>
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
                        <div class="card-body">
                            <form action="{{route('admin.users.index')}}" method="get">
                                <div class="mb-3">
                                    <label class="form-label">ค้นหา</label>
                                    <div class="input-icon mb-3">
                                        <input type="text" name="search"
                                               value="{{ request()->query('search') }}"
                                               class="form-control" placeholder="ชื่อ นามสกุล เบอร์มือถือ">
                                        <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <circle cx="10" cy="10" r="7"/>
                                            <line x1="21" y1="21" x2="15" y2="15"/>
                                        </svg>
                                    </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">สถานะผู้เช่า</div>
                                    @foreach(\App\Enums\UserStatusEnum::values() as $key => $value)
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" name="status[]" type="checkbox"
                                                   value="{{ $key }}"
                                                   @if ((is_array(request()->query('status'))
                                                        && in_array($key, request()->query('status'))
                                                   || !request()->has('status'))
                                                   )
                                                       checked
                                                @endif
                                            />
                                            <span
                                                class="form-check-label">{{ \App\Enums\UserStatusEnum::getLabel($value) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn btn-primary" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                    ค้นหา
                                </button>
                                @if (request()->has('search') || request()->has('status'))
                                    <a href="{{ route('admin.users.index') }}" class="btn btn btn-danger" role="button">ยกเลิกการค้นหา</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            รายการผู้เช่า
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>สถานะ</th>
                                    <th>ห้องที่เช่า</th>
                                    <th>วันที่แก้ไขล่าสุด</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td><span class="text-muted">{{ $user->id }}</span></td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->telephone }}</td>
                                        <td>
                                            <span
                                                class="badge {{ \App\Enums\UserStatusEnum::getClass($user->status) }}">
                                                {{ \App\Enums\UserStatusEnum::getLabel($user->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if (isset($user->bookings->first()->room))
                                                <a href="#">
                                                    ตึก {{ $user->bookings->first()->room->floor->building->name ?? '' }}
                                                    ชั้น {{ $user->bookings->first()->room->floor->name ?? '' }}
                                                    ห้อง {{ $user->bookings->first()->room->name ?? '' }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.users.show', ['user' => 1]) }}"
                                               class="btn btn-primary"
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
                                            <a href="{{ route('admin.users.edit', ['user' => 1]) }}" class="btn"
                                               role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
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
                                            <div class="empty">
                                                <div class="empty-icon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/mood-sad -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                         height="24" viewBox="0 0 24 24" stroke-width="2"
                                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <circle cx="12" cy="12" r="9"/>
                                                        <line x1="9" y1="10" x2="9.01" y2="10"/>
                                                        <line x1="15" y1="10" x2="15.01" y2="10"/>
                                                        <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0"/>
                                                    </svg>
                                                </div>
                                                <p class="empty-title">ไม่พบรายการ</p>
                                                <p class="empty-subtitle text-muted">
                                                    โปรดตรวจสอบรายที่ป้อนเข้ามาใหม่อีกครั้ง
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <div class="m-0 ms-auto">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
