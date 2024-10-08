<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                    class="dark-logo" width="180" alt="" />
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg"
                    class="light-logo" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('employee.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Dasbor</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('project.user') }}" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-category"></i>
                        </span>
                        <span class="hide-menu">Proyek Saya</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('attendance.user') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-clipboard-data"></i>
                        </span>
                        <span class="hide-menu">Absensi</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a href="{{ route('notifications.index') }}" class="sidebar-link d-flex align-items-center">
                        <span>
                            <i class="ti ti-inbox"></i>
                        </span>
                        <span class="hide-menu">Kotak Masuk</span>
                        @if (isset($newNotificationCount) && $newNotificationCount > 0)
                            <span class="badge bg-danger text-sm  rounded-pill ms-auto p-1">
                                {{ $newNotificationCount }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
