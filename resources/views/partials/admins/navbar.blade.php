<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('admin.dashboard.index') }}">
                <img src="{{ asset('/static/logo.svg') }}" width="110" height="32" alt="Tabler"
                     class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
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
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                       aria-label="Show notifications">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Last updates</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 1</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Change deprecated html tags to text decoration classes (#29604)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 2</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                justify-content:between ⇒ justify-content:space-between (#29734)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions show">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 3</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Update change-version.js (#29736)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-green d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 4</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Regenerate package-lock.json (#29730)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                          style="background-image: url({{ asset('/static/avatars/000m.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::guard('admin')->user()->name }}</div>
                        <div class="mt-1 small text-muted">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="./">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline
                              points="5 12 3 12 12 3 21 12 19 12"/><path
                              d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path
                              d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                    </span>
                            <span class="nav-link-title">
                      Home
                    </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline
                              points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"/><line x1="12" y1="12" x2="20"
                                                                                          y2="7.5"/><line x1="12"
                                                                                                          y1="12"
                                                                                                          x2="12"
                                                                                                          y2="21"/><line
                              x1="12" y1="12" x2="4" y2="7.5"/><line x1="16" y1="5.25" x2="8" y2="9.75"/></svg>
                    </span>
                            <span class="nav-link-title">
                      Interface
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./empty.html">
                                        Empty page
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Accordion
                                    </a>
                                    <a class="dropdown-item" href="./blank.html">
                                        Blank page
                                    </a>
                                    <a class="dropdown-item" href="./badges.html">
                                        Badges
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./buttons.html">
                                        Buttons
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards"
                                           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                           aria-expanded="false">
                                            Cards
                                            <span
                                                class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="./cards.html" class="dropdown-item">
                                                Sample cards
                                            </a>
                                            <a href="./card-actions.html" class="dropdown-item">
                                                Card actions
                                                <span
                                                    class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                            </a>
                                            <a href="./cards-masonry.html" class="dropdown-item">
                                                Cards Masonry
                                            </a>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="./colors.html">
                                        Colors
                                    </a>
                                    <a class="dropdown-item" href="./datagrid.html">
                                        Data grid
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./datatables.html">
                                        Datatables
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./dropdowns.html">
                                        Dropdowns
                                    </a>
                                    <a class="dropdown-item" href="./modals.html">
                                        Modals
                                    </a>
                                    <a class="dropdown-item" href="./maps.html">
                                        Maps
                                    </a>
                                    <a class="dropdown-item" href="./map-fullsize.html">
                                        Map fullsize
                                    </a>
                                    <a class="dropdown-item" href="./maps-vector.html">
                                        Vector maps
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./navigation.html">
                                        Navigation
                                    </a>
                                    <a class="dropdown-item" href="./charts.html">
                                        Charts
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./pagination.html">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/pie-chart -->
                                        Pagination
                                    </a>
                                    <a class="dropdown-item" href="./placeholder.html">
                                        Placeholder
                                    </a>
                                    <a class="dropdown-item" href="./steps.html">
                                        Steps
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./tabs.html">
                                        Tabs
                                    </a>
                                    <a class="dropdown-item" href="./tables.html">
                                        Tables
                                    </a>
                                    <a class="dropdown-item" href="./carousel.html">
                                        Carousel
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./lists.html">
                                        Lists
                                    </a>
                                    <a class="dropdown-item" href="./typography.html">
                                        Typography
                                    </a>
                                    <a class="dropdown-item" href="./offcanvas.html">
                                        Offcanvas
                                    </a>
                                    <a class="dropdown-item" href="./markdown.html">
                                        Markdown
                                    </a>
                                    <a class="dropdown-item" href="./dropzone.html">
                                        Dropzone
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./lightbox.html">
                                        Lightbox
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./tinymce.html">
                                        TinyMCE
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./inline-player.html">
                                        Inline player
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication"
                                           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                           aria-expanded="false">
                                            Authentication
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="./sign-in.html" class="dropdown-item">
                                                Sign in
                                            </a>
                                            <a href="./sign-in-illustration.html" class="dropdown-item">
                                                Sign in with illustration
                                            </a>
                                            <a href="./sign-in-cover.html" class="dropdown-item">
                                                Sign in with cover
                                            </a>
                                            <a href="./sign-up.html" class="dropdown-item">
                                                Sign up
                                            </a>
                                            <a href="./forgot-password.html" class="dropdown-item">
                                                Forgot password
                                            </a>
                                            <a href="./terms-of-service.html" class="dropdown-item">
                                                Terms of service
                                            </a>
                                            <a href="./auth-lock.html" class="dropdown-item">
                                                Lock screen
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-error"
                                           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                           aria-expanded="false">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/file-minus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1"
                                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                 stroke="currentColor" fill="none" stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                                                <line x1="9" y1="14" x2="15" y2="14"/>
                                            </svg>
                                            Error pages
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="./error-404.html" class="dropdown-item">
                                                404 page
                                            </a>
                                            <a href="./error-500.html" class="dropdown-item">
                                                500 page
                                            </a>
                                            <a href="./error-maintenance.html" class="dropdown-item">
                                                Maintenance page
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12"
                                                                                                              cy="12"
                                                                                                              r="4"/><circle
                              cx="12" cy="12" r="9"/><line x1="15" y1="15" x2="18.35" y2="18.35"/><line x1="9" y1="15"
                                                                                                        x2="5.65"
                                                                                                        y2="18.35"/><line
                              x1="5.65" y1="5.65" x2="9" y2="9"/><line x1="18.35" y1="5.65" x2="15" y2="9"/></svg>
                    </span>
                            <span class="nav-link-title">
                      Help
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./docs/">
                                Documentation
                            </a>
                            <a class="dropdown-item" href="./changelog.html">
                                Changelog
                            </a>
                            <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank"
                               rel="noopener">
                                Source code
                            </a>
                            <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm"
                               target="_blank" rel="noopener">
                                <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24"
                                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/>
                                </svg>
                                Sponsor project!
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="input-icon">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10"
                                                                                                              cy="10"
                                                                                                              r="7"/><line
                              x1="21" y1="21" x2="15" y2="15"/></svg>
                    </span>
                            <input type="text" value="" class="form-control" placeholder="Search…"
                                   aria-label="Search in website">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
