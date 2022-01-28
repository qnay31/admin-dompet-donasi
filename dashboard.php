<?php
error_reporting(0);
session_start();

if (!isset($_SESSION["halaman_utama"])) {
    header("Location: ../index.php?pesan=gagal");
    exit;
}

require 'function.php';

$query  = mysqli_query($conn, "SELECT * FROM akun_pengurus WHERE username = '$_SESSION[username]' ");
$data   = mysqli_fetch_assoc($query);
$nama   = $data['nama'];
$posisi = $data['posisi'];
$profil   = $data['profil'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Campaign</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="DashboardKit is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template">
    <meta name="author" content="DashboardKit ">


    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/logo/logo_favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick/slick-theme.css" />
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="pc-mob-header pc-header">
        <div class="pcm-logo">
            <img src="assets/images/logo.svg" alt="" class="logo logo-lg">
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="pc-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <a href="#!" class="pc-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    <!-- [ Mobile header ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pc-sidebar ">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="http://localhost/admin_dompet/" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo.svg" alt="" class="logo logo-lg">
                    <img src="assets/images/logo-sm.svg" alt="" class="logo logo-sm">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="pc-item">
                        <a href="http://localhost/admin_dompet/" class="pc-link "><span class="pc-micon"><i
                                    class="material-icons-two-tone">home</i></span><span
                                class="pc-mtext">Dashboard</span></a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Forms</label>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link "><span class="pc-micon"><i
                                    class="material-icons-two-tone">edit</i></span><span class="pc-mtext">Forms
                            </span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <?php if ($_SESSION['id_pengurus'] == 'admin_user') { ?>
                            <li class="pc-item"><a class="pc-link" href="models/check-campaign.php">Checklist
                                    Campaign</a>
                            </li>
                            <li class="pc-item"><a class="pc-link" href="models/check-donasi.php">Checklist Donasi</a>
                            </li>
                            <?php } else { ?>
                            <li class="pc-item"><a class="pc-link" href="models/input-campaign.php">Form Campaign</a>
                            </li>
                            <li class="pc-item"><a class="pc-link" href="form2_input_group.html">Form Pencairan Dana</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="pc-header ">
        <div class="header-wrapper">
            <div class="ml-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/user/<?= $profil ?>" alt="user-image" class="user-avtar">
                            <span>
                                <span class="user-name"><?= ucwords($nama) ?></span>
                                <span class="user-desc"><?= ucwords($posisi) ?></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                            <a href="auth-signin.html" class="dropdown-item">
                                <i class="material-icons-two-tone">account_circle</i>
                                <span>My Account</span>
                            </a>
                            <a href="auth-signin.html" class="dropdown-item">
                                <i class="material-icons-two-tone">settings</i>
                                <span>Settings</span>
                            </a>
                            <a href="logout.php" class="dropdown-item">
                                <i class="material-icons-two-tone">chrome_reader_mode</i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <!-- card top -->
                    <?php include 'badan/card-top.php'; ?>
                    <!-- end card top -->
                </div>
                <!-- customer-section end -->
            </div>

            <!-- all campaign -->
            <?php if ($_SESSION["id_pengurus"] == "admin_user") { ?>

            <?php 
            include 'badan/chart_dashboard.php';
            include 'badan/table-list_campaign.php'; ?>

            <?php } elseif ($_SESSION["id_pengurus"] == "ketua_user") { ?>

            <?php include 'badan/chart_dashboard.php';
            include 'badan/table-list_campaign.php'; ?>

            <?php } else { ?>

            <?php include 'badan/campaign-list.php'; ?>

            <?php } ?>
            <!-- end all campaign -->
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/chart.js"></script>
    <!-- datatable -->

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="slick/slick/slick.min.js"></script>
    <script src="assets/js/slider-campaign.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <script src="assets/js/table.js"></script>
</body>

</html>