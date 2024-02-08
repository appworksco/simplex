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
        <li class="sidebar-item">
            <a class="sidebar-link" href="municipality" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Municipality</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="lgu" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">LGU</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="project-type" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Project Type</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="bidding-information" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Bidding Information</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="purchase-order" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Purchase Order</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu"><?= $department ?></span>
        </li>

        <!-- Admin, ICT, HR View Start -->
        <?php if ($department == 'HR') { ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="employee" aria-expanded="false">
                    <span><i class="ti ti-users"></i></span>
                    <span class="hide-menu">Employee</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="timestamp" aria-expanded="false">
                    <span><i class="ti ti-clock"></i></span>
                    <span class="hide-menu">Timestamp</span>
                </a>
            </li>
        <?php } ?>
        <!-- Admin, ICT, HR View End -->

        <!-- ICT View Start -->
        <?php if ($department == 'ICT') { ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="employee" aria-expanded="false">
                    <span><i class="ti ti-users"></i></span>
                    <span class="hide-menu">Employee</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="departments" aria-expanded="false">
                    <span><i class="ti ti-door"></i></span>
                    <span class="hide-menu">Departments</span>
                </a>
            </li>
            <?php if ($userRole == 1) { ?>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="positions" aria-expanded="false">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">Positions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="services" aria-expanded="false">
                        <span><i class="ti ti-clipboard"></i></span>
                        <span class="hide-menu">Services</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="issues" aria-expanded="false">
                        <span><i class="ti ti-star"></i></span>
                        <span class="hide-menu">Issues</span>
                    </a>
                </li>
        <?php }
        } ?>
        <!-- ICT View End -->
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Modules</span>
        </li>
        <!-- ICT View Start -->
        <?php if ($department == 'ICT') { ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="fixed-asset-inventory" aria-expanded="false">
                    <span><i class="ti ti-archive"></i></span>
                    <span class="hide-menu">Fixed Asset Inventory</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="../rfid" target="_blank" aria-expanded="false">
                    <span><i class="ti ti-archive"></i></span>
                    <span class="hide-menu">RFID Attendance System</span>
                </a>
            </li>
        <?php } ?>
        <!-- ICT View End -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="cts" aria-expanded="false">
                <span><i class="ti ti-archive"></i></span>
                <span class="hide-menu">Centro Ticketing System</span>
            </a>
        </li>
        <!-- ICT View Start -->
        <?php if ($department == 'ICT') { ?>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Integration</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="https://support.iripple.com/login" target="_blank" aria-expanded="false">
                    <span><i class="ti ti-archive"></i></span>
                    <span class="hide-menu">Iripple Ticketing System</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="http://192.168.0.230:81/barterwebmodules/login.php" target="_blank" aria-expanded="false">
                    <span><i class="ti ti-archive"></i></span>
                    <span class="hide-menu">Barter CLP</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="http://192.168.0.230:8080/jdigistore/login.action" target="_blank" aria-expanded="false">
                    <span><i class="ti ti-archive"></i></span>
                    <span class="hide-menu">Label Lite</span>
                </a>
            </li>
        <?php } ?>
        <!-- ICT View End -->
    </ul>
</nav>