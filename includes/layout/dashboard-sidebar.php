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

        <!-- Admin, ICT, HR View Start -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="users" aria-expanded="false">
                <span><i class="ti ti-users"></i></span>
                <span class="hide-menu">Users</span>
            </a>
        </li>
        <!-- Admin, ICT, HR View End -->

        <!-- ICT View Start -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="departments" aria-expanded="false">
                <span><i class="ti ti-door"></i></span>
                <span class="hide-menu">Departments</span>
            </a>
        </li>
        <?php if ($department == 'ICT') { ?>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Others</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="fixed-asset-inventory" aria-expanded="false">
                <span><i class="ti ti-archive"></i></span>
                <span class="hide-menu">Fixed Asset Inventory</span>
            </a>
        </li>
        <?php } ?>
        <!-- ICT View End -->
    </ul>
</nav>