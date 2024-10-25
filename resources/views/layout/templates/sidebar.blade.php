<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link @if ($menu != 'Master') {{ 'collapsed' }} @endif" data-bs-target="#tables-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Master</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav"
                class="nav-content collapse @if ($menu == 'Master') {{ 'show' }} @endif"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/user" class="@if ($submenu == 'Menu User') {{ 'active' }} @endif">
                        <i class="bi bi-circle"></i><span>Master User</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->


        <li class="nav-heading">Pengaturan</li>

        <li class="nav-item">
            <a class="nav-link @if ($submenu != 'Profile') {{ 'collapsed' }} @endif"
                href="{{ route('user.profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
