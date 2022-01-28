<?php

error_reporting(0);
session_start();

require '../function.php';

$id_campaign = $_GET['linkid'];

$query  = mysqli_query($conn, "SELECT*FROM campaign WHERE link = '$id_campaign' ");
$data   = mysqli_fetch_assoc($query);

$judul      = $data['judul'];
$terkumpul  = $data['terkumpul'];
$status     = $data['status'];
$foto       = $data['foto'];

$dateawal   = date('Y-m-d');
$dateakhir  = $data["berakhir"];

$date_convert = convertDateDBtoIndo($dateakhir);

$awal       = new DateTime($dateakhir);
$akhir      = new DateTime($dateawal);

$sisa       = $akhir->diff($awal);

$q  = mysqli_query($conn, "SELECT*FROM donasi WHERE link = '$id_campaign' AND status = 'Terkonfirmasi' ORDER BY `dibuat` DESC ");
$donatur = $q->num_rows;




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Campaign</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="DashboardKit is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template">
    <meta name="author" content="DashboardKit ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/logo/logo_favicon.png" type="image/x-icon">

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />

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
                                <li class="breadcrumb-item"><a
                                        href="http://localhost/admin_dompet/user/<?= $_SESSION['username'] ?>.php">Home</a>
                                </li>
                                <li class="breadcrumb-item">Detail Campaign</li>
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
                                <li class="page-item active"><a class="page-link"
                                        href="detail-list_campaign.php?linkid=<?= $id_campaign ?>"><small
                                            class=" text-white">Detail Campaign</small>
                                    </a></li>
                            </ul>
                        </div>

                        <div class="detail-campaign">
                            <div class="row justify-content-center">
                                <!-- large content -->
                                <div class="col-md-4 col-12">
                                    <div class="image-content">
                                        <img class="w-100" src="../assets/images/cover-campaign/<?= $foto ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="detail-content">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label">Judul
                                                Campaign</label>
                                            <input type="email" class="form-control" id="exampleFormControlInput2"
                                                value="<?= ucwords($judul) ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Terkumpul</span>
                                            <input type="email" class="form-control" id="exampleFormControlInput4"
                                                value="Rp. <?= number_format($terkumpul, 0, ".", ".") ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="exampleFormControlInput4"
                                                value="<?= $sisa->days ?> Hari s/d <?= $date_convert ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="exampleFormControlInput4"
                                                value="<?= $donatur ?> Donatur" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Status Campaign : <span class="text-danger">*Sedang
                                                    <?= $status ?></span></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- mobile content -->
                                <div class="mobile-content">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Donatur <?= ucwords($judul) ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tabel-data_donatur"
                                                    class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th scope="col">No</th>
                                                            <th scope="col">Nama Donatur</th>
                                                            <th scope="col">No HP</th>
                                                            <th scope="col">Tanggal Donasi</th>
                                                            <th scope="col">Via</th>
                                                            <th scope="col">Donasi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        while ($r = $q->fetch_assoc()) {
                                                            $donasi   = $r["jumlah_donasi"];
                                                            $target      = $r["dibuat"];
                                                            $tgl_donasi  = date("d-m-Y", strtotime($target));

                                                            ?>
                                                        <tr>
                                                            <td style="text-align: center;"><?= $no++ ?></td>
                                                            <td><?= ucwords($r['nama_donatur']) ?></td>
                                                            <td><?= ucwords($r['no_hp']) ?></td>
                                                            <td style="text-align: center;"><?= $tgl_donasi ?></td>
                                                            <td style="text-align: center;">Bank
                                                                <?= ucwords($r['via']) ?></td>
                                                            <td>Rp.
                                                                <?= number_format($donasi, 0, ".", ".") ?></td>
                                                        </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr style="text-align: center;">
                                                            <th colspan="5">Total Donasi</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <!-- plugin datatables -->
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="../assets/js/table.js"></script>
</body>

</html>