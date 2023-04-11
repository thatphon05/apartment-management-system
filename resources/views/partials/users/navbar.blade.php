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
                <div class="nav-item dropdown @navactive('user.profile.*')">
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
                            <div>{{ auth()->user()->full_name }}</div>
                            <div class="mt-1 small text-muted">ผู้เช่า</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('user.profile.change-password.get') }}" class="dropdown-item">
                            เปลี่ยนรหัสผ่าน
                        </a>
                        <a href="{{ route('user.logout') }}" class="dropdown-item">ออกจากระบบ</a>
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
                        <li class="nav-item @navactive('user.dashboard.index')">
                            <a class="nav-link" href="{{ route('user.dashboard.index') }}">
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
                        <li class="nav-item @navactive('user.invoices.*')">
                            <a class="nav-link" href="{{ route('user.invoices.index') }}">
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
                        <li class="nav-item @navactive('user.repairs.*')">
                            <a class="nav-link" href="{{ route('user.repairs.index') }}">
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
