    <!--  Header Start -->
    <header class="app-header w-100" style="height: 100px;">
        <div>
            <nav class="navbar navbar-expand-lg navbar-light py-1">
                <div class="navbar-collapse px-0" id="navbarNav">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle border-0 py-0" type="button" id="file" data-bs-toggle="dropdown" aria-expanded="false">
                            File
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="file">
                            <li><a class="dropdown-item py-1" href="../logout?first_name=<?= $firstName ?>&last_name=<?= $lastName ?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle border-0 py-0" type="button" id="tools" data-bs-toggle="dropdown" aria-expanded="false">
                            Tools
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="tools">
                            <li><a class="dropdown-item py-1" id="manageEmployee">Manage Employee</a></li>
                            <li><a class="dropdown-item py-1" id="manageDepartments">Manage Departments</a></li>
                            <li><a class="dropdown-item py-1" id="managePositions">Manage Positions</a></li>
                            <li><a class="dropdown-item py-1" id="manageServices">Manage Services</a></li>
                            <li><a class="dropdown-item py-1" id="manageIssues">Manage Issues</a></li>
                            <li><a class="dropdown-item py-1" id="manageMunicipality">Manage Municipality</a></li>
                            <li><a class="dropdown-item py-1" id="manageLGU">Manage LGU</a></li>
                            <li><a class="dropdown-item py-1" id="manageProjectType">Manage Project Type</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle border-0 py-0" type="button" id="plugins" data-bs-toggle="dropdown" aria-expanded="false">
                            Plugins
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="plugins">
                            <li><a class="dropdown-item py-1" id="fixedAssetInventory">Fixed Asset Inventory</a></li>
                            <li><a class="dropdown-item py-1" id="rfid">RFID Attendance System</a></li>
                            <li><a class="dropdown-item py-1" id="cts">Centro Ticketing System</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle border-0 py-0" type="button" id="reports" data-bs-toggle="dropdown" aria-expanded="false">
                            Reports
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="reports">
                            <li><a class="dropdown-item py-1" id="biddingReports">Bidding Reports</a></li>
                            <li><a class="dropdown-item py-1" id="POReports">PO Reports</a></li>
                            <li><a class="dropdown-item py-1" id="deliveryReports">Delivery Reports</a></li>
                            <li><a class="dropdown-item py-1" id="paymentReports">Payment Reports</a></li>
                            <li><a class="dropdown-item py-1" id="timestamp">Timestamp</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle border-0 py-0" type="button" id="charts" data-bs-toggle="dropdown" aria-expanded="false">
                            Charts
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="charts">
                            <li><a class="dropdown-item py-1" href="bidding-information">Bidding Chart</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="border-top border-bottom">
                <button class="btn border-0 border-start border-end" id="infoButton">
                    <img src=".././dist/icons/info.png" alt="" style="width: 40px;"> <br>
                    <small>Info</small>
                </button>
                <button class="btn border-0 border-end" id="loadDataButton">
                    <img src=".././dist/icons/refresh.png" alt="" style="width: 40px;"> <br>
                    <small>Refresh</small>
                </button>
                <button class="btn border-0 border-end" id="logButton">
                    <img src=".././dist/icons/log.png" alt="" style="width: 40px;"> <br>
                    <small>Log</small>
                </button>
            </div>
        </div>
    </header>
    <!--  Header End -->