<nav class="sidebar-nav scroll-sidebar">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="index" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu"><?= $department ?></span>
        </li>
        <!-- Admin, IT, HR View Start -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="users" aria-expanded="false">
                <span><i class="ti ti-users"></i></span>
                <span class="hide-menu">Users</span>
            </a>
        </li>
        <!-- Admin, IT, HR View End -->
        <!-- Administrator View Start -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="departments" aria-expanded="false">
                <span><i class="ti ti-door"></i></span>
                <span class="hide-menu">Departments</span>
            </a>
        </li>
        <!-- Administrator View End -->
    </ul>
</nav>