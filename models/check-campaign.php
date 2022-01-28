<?php

error_reporting(0);
session_start();

require '../function.php';

if (isset($_POST["create"]) ) {

    if(buat_campaign($_POST) > 0 ) {
    echo "<script>
            alert('Langkah Terakhir');
            document.location.href = 'upload_img/';
        </script>";
        
    } 
    else {
        echo mysqli_error($conn);
    }


}

$q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Pending' ORDER BY `dibuat` DESC");
$s = $q->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Checklist Campaign</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="refresh" content="30" />
    <meta name="description"
        content="DashboardKit is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template">
    <meta name="author" content="DashboardKit ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/logo/logo_favicon.png" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="../assets/fonts/feather.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="../assets/fonts/material.css">

    <link rel="stylesheet" type="text/css" href="../slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../slick/slick/slick-theme.css" />

    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/breadcumb.css">
</head>

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <?php include '../badan/mobile-header.php' ?>
    <?php include '../badan/sidebar.php' ?>
    <?php include '../badan/top-bar.php' ?>
    <div class="pc-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="http://localhost/admin_dompet/user/<?= $_SESSION['username'] ?>.php">Home</a>
                                </li>
                                <li class="breadcrumb-item">Checklist Campaign</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center campain-create">
                <div class="col-lg-12 col-12">
                    <div class="box-white">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center"
                            id="page">
                            <ul class="pagination shadow-lg">
                                <li class="page-item active"><a class="page-link" href="input-campaign.php"><small
                                            class=" text-white">Campaign Pending</small>
                                        <?php if ($s == 0) { ?>
                                        <?php } else { ?>
                                        <span class="badge text-white bg-danger"><?= $s ?></span>
                                        <?php } ?>
                                    </a></li>
                                <li class="page-item"><a class="page-link " href="verifikasi.php"></i><small>Update
                                            List&nbsp;</small>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="card support-bar">
                            <div class="card-header">
                                <h5>Campaign Pending</h5>
                            </div>
                            <main>
                                <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                                    <div class="row slider-admin">
                                        <?php
                                        $no = 1;
                                        while ($r = $q->fetch_assoc()) {
                                            $terkumpul      = $r["terkumpul"];
                                            $new_terkumpul  = (int) $terkumpul;

                                            $target     = $r["target"];
                                            $new_target = (int) $target;

                                            $persen  = round($new_terkumpul/$new_target * 100,2);

                                            $dateawal = $r["dibuat"];
                                            $dateakhir = $r["berakhir"];

                                            $awal = new DateTime($dateakhir);
                                            $akhir = new DateTime($dateawal);

                                            // die(var_dump($target));


                                            $sisa = $akhir->diff($awal);
                                            
                                            ?>
                                        <div class="col">
                                            <div class="card shadow-sm">
                                                <a href="detail-campaign.php?id_campaign=<?= $r["link"] ?>">
                                                    <img data-lazy="../assets/images/cover-campaign/<?= $r["foto"] ?>"
                                                        class="card-img-top" alt="...">
                                                    <div class="label-top shadow-sm pending"><?= $r["status"] ?></div>
                                                    <div class="card-body">
                                                        <h5 class="card-title"> <?= ucwords($r["judul"]) ?></h5>
                                                        <p class="name-galang"><?= ucwords($r["nama"]) ?> <span
                                                                class="material-icons-two-tone text-success icon-sukses">
                                                                verified
                                                            </span></p>
                                                        <hr>
                                                        <div class="clearfix">
                                                            <span class="float-start price-hp">Sisa Waktu</span>
                                                            <span class="float-end price-hp">Terkumpul</span>
                                                        </div>
                                                        <div class="clearfix mb-3">
                                                            <span class="float-start"><b><?= $sisa->days ?>
                                                                    Hari</b></span>
                                                            <span class="float-end"><b>Rp.
                                                                    <?= number_format($terkumpul, 0, ".", ".") ?></b></span>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped"
                                                                role="progressbar" style="width: <?= $persen ?>%"
                                                                aria-valuenow="10" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript" src="../slick/slick/slick.min.js"></script>
    <script src="../assets/js/slider-campaign.js"></script>
</body>

</html>