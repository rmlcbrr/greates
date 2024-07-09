<?php

header('Access-Control-Allow-Origin: *');
header('X-FRAME-OPTIONS: deny');
header("Content-Security-Policy: frame-ancestors 'none';");
?>

<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
}
if (empty($_SESSION['u_id'])) {
    header("location:../../index");
}
?>

<style>
    .main {
        overflow: scroll !important;
        height: 100vh !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 42%;
  top: 40%;
  background-position: center;
z-index: 999999">
        <img src="../../dist/img/loader.gif" style=" width: 250px;" alt="loading...">
    </div>
</div>
<div class="wrapper">
    <!-- Side nav -->
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar" style="background-color: #1F3B48;">
            <div class="text-center mt-3">
                <img class="img-fluid" src="../../assets/systech.png" style="max-width: 161px;">
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-header fs-5" data-bs-toggle="collapse" href="#dashboard-collapse">

                    <i class="material-icons align-middle">dashboard</i>
                    Dashboard
                    <i class="material-icons align-middle">expand_more</i>
                </li>
                <div class="collapse show text-success" id="dashboard-collapse">
                    <?php if ((strtolower($_SESSION['u_account_type'])) === "admin") {     ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../dashboard/index.php" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle">admin_panel_settings</i>
                                <span class="align-middle">Admin Dashboard</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../dashboard/client.php" style="background-color: #1F3B48;">
                            <i class="material-icons align-middle">group</i>
                            <span class="align-middle">Client Dashboard</span>
                        </a>
                    </li>
                </div>

                <li class="sidebar-header fs-5" data-bs-toggle="collapse" href="#charts-collapse">
                    <i class="material-icons align-middle">settings</i>
                    Settings
                    <i class="material-icons align-middle">expand_more</i>
                </li>
                <div class="collapse show" id="charts-collapse">
                    <?php
                    if ((strtolower($_SESSION['u_account_type'])) === "admin") {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../settings/clinics.php" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle">emergency</i>
                                <span class="align-middle">Clinics</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../settings/doctor.php" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle"><span class="material-symbols-outlined">
                                        health_and_safety
                                    </span></i>
                                <span class="align-middle">Doctor</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../settings/users.php" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle">person</i>
                                <span class="align-middle">Users</span>
                            </a>
                        </li>

                    <?php } ?>
                    <!--              <li class="sidebar-item">
                            <a class="sidebar-link" href="billing.html" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle">sell</i>
                                <span class="align-middle">Billing</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="on_process.html" style="background-color: #1F3B48;">
                                <i class="material-icons align-middle">account_tree</i>
                                <span class="align-middle">On Process</span>
                            </a>
                        </li> -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../settings/reports.php" style="background-color: #1F3B48;">
                            <i class="material-icons align-middle">report</i>
                            <span class="align-middle">Reports</span>
                        </a>
                    </li>
                </div>
                <li class="sidebar-header fs-5">
                    <i class="material-icons align-middle">medical_services</i>
                    <a href="../medical/index.php" class="text-decoration-none" style="color: #CED4DA;">Medical
                        Examination</a>
                </li>
                <li class="sidebar-header fs-5">
                    <i class="material-icons align-middle">money</i>
                    <a href="../billing/index.php" class="text-decoration-none" style="color: #CED4DA;">Billing</a>
                </li>

                </li>
                <?php if ((strtolower($_SESSION['u_account_type'])) === "admin") { ?>
                    <li class="sidebar-header fs-5">
                        <i class="material-icons align-middle">settings</i>
                        <a href="../logs/logs.php" class="text-decoration-none" style="color: #CED4DA;"> System Logs</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="main">
        <!-- Top nav -->
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-link d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <i class="material-icons align-middle mb-1 fs-3">account_circle</i>
                            <span class="text-dark fw-bold">Client<i class="material-icons align-middle">expand_more</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="../includes/logout.php" class="dropdown-item"></i> Log out</a>
                        </div>

                    </li>
                </ul>
            </div>
        </nav>


        <div style="padding-left:10px; padding-right: 10px;">