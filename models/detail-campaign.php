<?php

error_reporting(0);
session_start();

require '../function.php';

$id_campaign = $_GET['id_campaign'];

$query  = mysqli_query($conn, "SELECT*FROM campaign WHERE link = '$id_campaign' ");
$data   = mysqli_fetch_assoc($query);

$penggalang = $data['nama'];
$judul      = $data['judul'];
$target     = $data['target'];
$deskripsi  = $data['deskripsi'];
$deskripsi  = $data['deskripsi'];
$status     = $data['status'];
$foto       = $data['foto'];

$dateawal   = $data["dibuat"];
$dateakhir  = $data["berakhir"];

$awal       = new DateTime($dateakhir);
$akhir      = new DateTime($dateawal);

// die(var_dump($target));


$sisa       = $akhir->diff($awal);

if (isset($_POST["confirm"]) ) {

    if(konfirmasi_campaign($_POST) > 0 ) {
    echo "<script>
            alert('Campaign Terkonfimasi');
            document.location.href = 'check-campaign.php';
        </script>";
        
    } 
    else {
        echo mysqli_error($conn);
    }


}

$ind = date('Y-m-d');

$satu = date('Y-m-d',strtotime('+30 days',strtotime($ind)));
$dua  = date('Y-m-d',strtotime('+60 days',strtotime($ind)));
$tiga = date('Y-m-d',strtotime('+90 days',strtotime($ind)));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Checklist Campaign</title>
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

    <!-- font css -->
    <link rel="stylesheet" href="../assets/fonts/feather.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="../assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/breadcumb.css">
    <link rel="stylesheet" href="../assets/css/redactor.min.css">

    <style type="text/css">
    a.re-button.re-html.re-button-icon {
        display: none;
    }

    a.re-button.re-link.re-button-icon {
        display: none;
    }

    a.re-button.re-format.re-button-icon {
        display: none;
    }

    a.re-button.re-deleted.re-button-icon {
        display: none;
    }

    .redactor-styles address,
    .redactor-styles blockquote,
    .redactor-styles dl,
    .redactor-styles figure,
    .redactor-styles hr,
    .redactor-styles p,
    .redactor-styles pre,
    .redactor-styles table {
        font-size: 1em;
    }

    .redactor-styles address,
    .redactor-styles blockquote,
    .redactor-styles dl,
    .redactor-styles figure,
    .redactor-styles hr,
    .redactor-styles p,
    .redactor-styles pre,
    .redactor-styles table {
        font-size: 1.1em;
    }
    </style>
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
                                <li class="breadcrumb-item"><a href="check-campaign.php">Checklist Campaign</a></li>
                                <li class="breadcrumb-item">Konfirmasi Campaign</li>
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
                                        href="detail-campaign.php?id_campaign=<?= $id_campaign ?>"><small
                                            class=" text-white">Konfirmasi Campaign</small>
                                    </a></li>
                            </ul>
                        </div>

                        <div class="detail-campaign">
                            <div class="row justify-content-evenly">
                                <!-- large content -->
                                <div class="col-md-4 col-12">
                                    <div class="image-content">
                                        <img class="w-100" src="../assets/images/cover-campaign/<?= $foto ?>" alt="">
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">Penggalang Dana</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            value="<?= $penggalang ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Judul Campaign</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput2"
                                            value="<?= $judul ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Periode
                                            Campaign</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput3"
                                            value="<?= $sisa->days ?> Hari" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput4" class="form-label">Target Donasi</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput4"
                                            value="Rp. <?= number_format($target, 0, ".", ".") ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="detail-content">
                                        <form method="post" enctype="multipart/form-data" action="" id="postForm"
                                            onsubmit="return validasi_campaign(this)" autocomplete="off"
                                            name="buat_campaign">

                                            <label for="exampleFormControlInput3" class="form-label">
                                                <b>Cerita Campaign</b></label>
                                            <span class="deskripsi-detail">
                                                <?php echo htmlspecialchars_decode($deskripsi); ?>
                                            </span>
                                            <input type="hidden" name="link" value="<?= $id_campaign ?>">
                                            <?php if ($sisa->days == 90) { ?>
                                            <input type="hidden" name="periode" value="<?= $tiga ?>">
                                            <?php } elseif ($sisa->days == 60) { ?>
                                            <input type="hidden" name="periode" value="<?= $dua ?>">
                                            <?php } else { ?>
                                            <input type="hidden" name="periode" value="<?= $satu ?>">
                                            <?php } ?>
                                            <input type="hidden" name="judul" value="<?= $judul ?>">
                                            <div class="form-group" style="margin-bottom:10px;">
                                                <textarea id="deskripsi" name="deskripsi" placeholder="Ajakan Cerita"
                                                    rows="20">
                                                        <strong>Sahabat, Ayo kita ringankan beban Ibu Novi dalam merawat Farzhan, Dengan cara :</strong>
                                                            <ol>
                                                                <li><strong>Klik tombol “Donasi Sekarang”</strong></li>
                                                                <li><strong>Masukkan Data Diri</strong></li>
                                                                <li><strong>Masukkan Nominal Donasi</strong></li>
                                                                <li><strong>Pilih Metode Pembayaran</strong></li>
                                                                <li><strong>Donatur akan mendapat laporan via Whatsapp</strong>
                                                                </li>
                                                            </ol>
                                                        <p>Sahabat Baik Juga dapat membagian halaman galang dana ini agar lebih banyak lagi orang yang membantu Ibu Novi.</p>
                                                </textarea>
                                            </div>

                                            <input type="submit" name="confirm" class="btn btn-primary w-100"
                                                value="Konfirmasi">
                                        </form>
                                    </div>
                                </div>
                                <!-- mobile content -->
                                <div class="mobile-content"></div>
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
    <script src="../assets/js/redactor3.js"></script>
    <script src="../assets/js/imagemanager.js"></script>

    <script>
    $R('#deskripsi');
    </script>
</body>

</html>