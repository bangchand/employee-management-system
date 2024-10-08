<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Mordenize</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Select to --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">

    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />

    {{-- BoxIcons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

    {{-- Multi Select --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>

    {{-- APEX Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('style')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        @if (Auth::user()->hasRole('manager'))
            @include('dashboard.layouts.sidebar')
        @else
            @include('dashboard.layouts.sidebar-user')
        @endif

        {{-- @include('dashboard.layouts.sidebar-user', ['newNotificationCount' => $newNotificationCount]) --}}


        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="d-block d-lg-none">
                        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                            class="dark-logo" width="180" alt="" />
                        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg"
                            class="light-logo" width="180" alt="" />
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="p-2">
                            <i class="ti ti-dots fs-7"></i>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <i class="ti ti-align-justified fs-7"></i>
                            </a>
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                {{-- Menampilkan notifikasi pada dashboard --}}
                                @php
                                    $notifications = auth()->user()->unreadNotifications()->take(10)->get(); // Maksimal 10 notifikasi belum dibaca
                                    $unreadCount = $notifications->count(); // Hitung notifikasi belum dibaca
                                @endphp


                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover position-relative" href="#"
                                        id="notificationDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="ti ti-bell-ringing"></i>
                                        @if ($unreadCount > 0)
                                            <span class="badge bg-danger position-absolute fs-1 rounded-circle"
                                                style="top: 15px; right: 10px; transform: translate(50%, -50%);">
                                                {{ $unreadCount }}
                                            </span>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-0 shadow-lg"
                                        aria-labelledby="notificationDropdown" style="width: 300px;">
                                        <li
                                            class="dropdown-header bg-light fw-bold p-3 d-flex justify-content-between align-items-center">
                                            <span>Notifications</span>

                                            {{-- Tombol "View All" --}}
                                            <a href="{{ route('notifications.index') }}"
                                                class="btn btn-link text-decoration-none">
                                                View All
                                            </a>
                                        </li>

                                        @if ($notifications->isEmpty())
                                            <li class="dropdown-item text-center py-3">No new notifications</li>
                                        @else
                                            @foreach ($notifications as $notification)
                                                <li class="dropdown-item border-bottom">
                                                    <a href="{{ $notification->data['url'] ?? '#' }}"
                                                        class="d-flex align-items-start text-decoration-none">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1 text-truncate"
                                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                                {{ $notification->data['title'] ?? 'Untitled' }}
                                                            </h6>
                                                            <p class="mb-0 text-muted small"
                                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                                {{ $notification->data['message'] ?? 'No message available' }}
                                                            </p>
                                                        </div>
                                                        <small class="text-muted ms-3"
                                                            style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </small>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif

                                        <li class="dropdown-divider my-0"></li>

                                        {{-- Tombol "Tandai Semua Sebagai Dibaca" --}}
                                        @if ($unreadCount > 0)
                                            <li class="text-center py-3">
                                                <form action="{{ route('notifications.readAll') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-link text-decoration-none text-primary">
                                                        Tandai Telah Dibaca
                                                        {{-- <span class="badge bg-danger">{{ $unreadCount }}</span> --}}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </li>




                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="user-profile-img">
                                                @if (Auth::user()->hasRole('manager'))
                                                    <img src="
                                                        @if (Auth::user()->hasRole('manager')) {{ asset('dist/images/profile/user-4.jpg') }}
                                                        @else
                                                            {{ asset('assets/images/no-profile.jpeg') }} @endif"
                                                        class="rounded-circle" width="35" height="35"
                                                        alt="" />
                                                @else
                                                    <img src="
                                                        @if (Auth::user()->employee_detail->gender == 'male') {{ asset('dist/images/profile/user-1.jpg') }}

                                                        @elseif (Auth::user()->employee_detail->gender == 'female')
                                                            {{ asset('dist/images/profile/user-2.jpg') }}

                                                        @elseif (Auth::user()->hasRole('manager'))
                                                            {{ asset('dist/images/profile/user-4.jpg') }}

                                                        @else
                                                            {{ asset('assets/images/no-profile.jpeg') }} @endif"
                                                        class="rounded-circle" width="35" height="35"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop1">
                                        <div class="profile-dropdown position-relative" data-simplebar>
                                            <div class="py-3 px-7 pb-0">
                                                <h5 class="mb-0 fs-5 fw-semibold">Profil Pengguna</h5>
                                            </div>
                                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                @if (Auth::user()->hasRole('manager'))
                                                    <img src="
                                                        @if (Auth::user()->hasRole('manager')) {{ asset('dist/images/profile/user-4.jpg') }}
                                                        @else
                                                            {{ asset('assets/images/no-profile.jpeg') }} @endif"
                                                        class="rounded-circle" width="80" height="80"
                                                        alt="" />
                                                @else
                                                    <img src="
                                                        @if (Auth::user()->employee_detail->gender == 'male') {{ asset('dist/images/profile/user-1.jpg') }}

                                                        @elseif (Auth::user()->employee_detail->gender == 'female')
                                                            {{ asset('dist/images/profile/user-2.jpg') }}

                                                        @elseif (Auth::user()->hasRole('manager'))
                                                            {{ asset('dist/images/profile/user-4.jpg') }}

                                                        @else
                                                            {{ asset('assets/images/no-profile.jpeg') }} @endif"
                                                        class="rounded-circle" width="80       " height="80"
                                                        alt="" />
                                                @endif
                                                <div class="ms-3">
                                                    <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                                    <span
                                                        class="mb-1 d-block text-dark">{{ Auth::user()->getRoleNames()->implode(',') }}</span>
                                                    <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                        <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                                    </p>
                                                    <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                        <i class="ti ti-building fs-4"></i>
                                                        {{ Auth::user()->company->name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                <a href="/manager/profile"
                                                    class="py-8 px-7 mt-8 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg"
                                                            alt="" width="24" height="24">
                                                    </span>
                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 bg-hover-primary fw-semibold"> Profil
                                                        </h6>
                                                        <span class="d-block text-dark">Pengaturan Akun</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="py-4 px-7 pt-8">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf

                                                    <button type="submit"
                                                        class="btn btn-outline-primary col-12">Keluar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!--  Customizer -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <!--  Import Js Files -->

    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('dist/js/datatable/datatable-basic.init.js') }}"></script>
    <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!--  core files -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <!--  current page js files -->
    <script src="{{ asset('dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/dashboard.js') }}"></script>
    <script src="{{ asset('dist/libs/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('dist/js/apps/calendar-init.js') }}"></script>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        @if (session('success'))
            iziToast.success({
                title: 'Sukses!',
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        @endif
        @if (session('danger'))
            iziToast.error({
                title: 'Error!',
                message: "{{ session('danger') }}",
                position: 'topRight'
            });
        @endif
        @if (session('info'))
            iziToast.info({
                title: 'Info!',
                message: "{{ session('info') }}",
                position: 'topRight'
            });
        @endif

        @if ($errors->any())
            iziToast.error({
                title: 'Erorr!',
                message: "{{ $errors->first() }}",
                position: 'topRight'
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            // Show the clear button only if there's input
            $('.search-input').on('input', function() {
                if ($(this).val().length > 0) {
                    $(this).siblings('.clear-search').show();
                } else {
                    $(this).siblings('.clear-search').hide();
                }
            });

            $('.search-input').trigger('input');
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("[data-provider='flatpickr']", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: true,
            });
        });
    </script>



</body>

</html>
