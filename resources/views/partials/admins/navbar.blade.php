<div class="sticky-top">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('admin.dashboard.index') }}">
                    <img src="{{ asset('/static/logo.svg') }}" width="110" height="32"
                         class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex">
                    <a class="nav-link px-0 hide-theme-light" title="Enable light mode"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="4"/>
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"/>
                        </svg>
                    </a>
                </div>
                <div class="nav-item dropdown @navactive('admin.profile.*')">
                    <a class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu" href="">
                    <span class="avatar avatar-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <circle cx="12" cy="7" r="4"></circle>
                           <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                    </span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->guard('admin')->user()->name }}</div>
                            <div class="mt-1 small text-muted">ผู้ดูแล</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('admin.profile.change-password.get') }}" class="dropdown-item">
                            เปลี่ยนรหัสผ่าน
                        </a>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item @navactive('admin.dashboard.index')">
                            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <polyline
                                            points="5 12 3 12 12 3 21 12 19 12"/>
                                        <path
                                            d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                                        <path
                                            d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                หน้าแรก
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown @navactive('admin.users.*') @navactive('admin.booking.create')">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <circle cx="12" cy="7" r="4"></circle>
                                       <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                จัดการผู้เช่า
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    ดูผู้เช่าทั้งหมด
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.users.create') }}">
                                    เพิ่มผู้เช่า
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown @navactive('admin.buildings.*') @navactive('admin.rooms.*') @navactive('admin.booking.show')">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-building-community" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path
                                           d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                       <line x1="13" y1="7" x2="13" y2="7.01"></line>
                                       <line x1="17" y1="7" x2="17" y2="7.01"></line>
                                       <line x1="17" y1="11" x2="17" y2="11.01"></line>
                                       <line x1="17" y1="15" x2="17" y2="15.01"></line>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    จัดการห้องพัก
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                @foreach ($navBuildingList as $building)
                                    <a class="dropdown-item"
                                       href="{{ route('admin.buildings.show', ['building' => $building->id]) }}">
                                        อาคาร {{ $building->name }}
                                    </a>
                                @endforeach

                                <a class="dropdown-item" href="{{ route('admin.buildings.index') }}">
                                    ดูทั้งหมด
                                </a>
                            </div>
                        </li>
                        <li class="nav-item @navactive('admin.repairs.*')">
                            <a class="nav-link" href="{{ route('admin.repairs.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hammer"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path
                                           d="M11.414 10l-7.383 7.418a2.091 2.091 0 0 0 0 2.967a2.11 2.11 0 0 0 2.976 0l7.407 -7.385"></path>
                                       <path
                                           d="M18.121 15.293l2.586 -2.586a1 1 0 0 0 0 -1.414l-7.586 -7.586a1 1 0 0 0 -1.414 0l-2.586 2.586a1 1 0 0 0 0 1.414l7.586 7.586a1 1 0 0 0 1.414 0z"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                รายการแจ้งซ่อม
                                </span>
                            </a>
                        </li>
                        <li class="nav-item @navactive('admin.expenses.*')">
                            <a class="nav-link" href="{{ route('admin.expenses.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-engine"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M3 10v6"></path>
                                       <path d="M12 5v3"></path>
                                       <path d="M10 5h4"></path>
                                       <path d="M5 13h-2"></path>
                                       <path
                                           d="M6 10h2l2 -2h3.382a1 1 0 0 1 .894 .553l1.448 2.894a1 1 0 0 0 .894 .553h1.382v-2h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2v-2h-3v2a1 1 0 0 1 -1 1h-3.465a1 1 0 0 1 -.832 -.445l-1.703 -2.555h-2v-6z"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                รายการจดมิเตอร์
                                </span>
                            </a>
                        </li>
                        <li class="nav-item @navactive('admin.invoices.*')">
                            <a class="nav-link" href="{{ route('admin.invoices.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-file-invoice" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                       <path
                                           d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                       <path d="M9 7l1 0"></path>
                                       <path d="M9 13l6 0"></path>
                                       <path d="M13 17l2 0"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    รายการใบแจ้งหนี้
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown @navactive('admin.summary.*')">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-report-money" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path
                                           d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                       <path
                                           d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                       <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                       <path d="M12 17v1m0 -8v1"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    สรุปยอด
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.summary.summary-month') }}">
                                    สรุปยอดประจำเดือน
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.summary.summary-overdue') }}">
                                    สรุปยอดค้างชำระเกินกำหนด
                                </a>
                            </div>
                        </li>
                        <li class="nav-item @navactive('admin.configurations.*')">
                            <a class="nav-link" href="{{ route('admin.configurations.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24"
                                         height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <circle cx="14" cy="6" r="2"></circle>
                                       <line x1="4" y1="6" x2="12" y2="6"></line>
                                       <line x1="16" y1="6" x2="20" y2="6"></line>
                                       <circle cx="8" cy="12" r="2"></circle>
                                       <line x1="4" y1="12" x2="6" y2="12"></line>
                                       <line x1="10" y1="12" x2="20" y2="12"></line>
                                       <circle cx="17" cy="18" r="2"></circle>
                                       <line x1="4" y1="18" x2="15" y2="18"></line>
                                       <line x1="19" y1="18" x2="20" y2="18"></line>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    การตั้งค่าบริการ
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
