<?php

// error_reporting(0);
session_start();
require '../function.php';


$link  = $_GET["link"];

$query  = mysqli_query($conn, "SELECT * FROM campaign WHERE link = '$link'");
$data   = mysqli_fetch_assoc($query);
$id     = $data["id"];

// looping update

$q     = mysqli_query($conn, "SELECT * FROM update_campaign WHERE link = '$link' ORDER BY `tanggal` DESC");
$s     = $q->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Form Campaign</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="DashboardKit is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template">
    <meta name="author" content="DashboardKit ">


    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/logo/logo_favicon.png" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="../assets/fonts/feather.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="../assets/fonts/material.css">

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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="update-campaign.php">Form Campaign</a></li>
                                <li class="breadcrumb-item active">Update Campaign</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center campain-create">
                <div class="col-lg-6 col-12">
                    <div class="box-white">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center"
                            id="page">
                            <ul class="pagination shadow-lg">
                                <li class="page-item"><a class="page-link"
                                        href="update.php?id_unik=<?= $id ?>&key=<?= $link ?>"><small>Update
                                            Campaign</small>
                                    </a></li>

                                <li class="page-item active"><a class="page-link"
                                        href="list_update-campaign.phplink=<?= $key ?>"><small class=" text-white">List
                                            Update</small>
                                    </a></li>
                            </ul>
                        </div>

                        <div class="list-update">
                            <?php if ($s == 0) {?>
                            <h2 class="text-center">Belum Ada Info Terbaru</h2>
                            <?php } else { ?>
                            <div class="accordion" id="accordionExample">
                                <?php
                                $no = 1;
                                while ($r = $q->fetch_assoc()) {
                                    ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $r['id'] ?>">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse<?= $r['id'] ?>"
                                            aria-expanded="false" aria-controls="collapse<?= $r['id'] ?>">
                                            <b><?= ucwords($r["judul_update"]) ?></b>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $r['id'] ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading<?= $r['id'] ?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?= htmlspecialchars_decode($r["update_cerita"]) ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>


</body>

</html>