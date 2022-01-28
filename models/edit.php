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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="update-campaign.php">Form Campaign</a></li>
                                <li class="breadcrumb-item active">Edit Campaign</li>
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
                                <li class="page-item active"><a class="page-link" href="input-campaign.php"><small
                                            class=" text-white">Edit Campaign</small>
                                    </a></li>
                            </ul>
                        </div>

                        <form method="post" enctype="multipart/form-data" action="" id="postForm"
                            onsubmit="return validasi_campaign(this)" autocomplete="off" name="buat_campaign">

                            <div class="form-group" style="margin-bottom:10px;">
                                <input type="text" class="form-control" name="nama" placeholder="Penggalang Campaign"
                                    maxlength='50' style="text-transform: capitalize;">
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Campaign" onKeyUp='Hitung()' maxlength='50'
                                    style="text-transform: capitalize;">
                                <p align='left' id='asalbagus'>
                                    Sisa Karakter : 50/50
                                </p>
                            </div>

                            <div class="input-group" style="margin-bottom:10px;">
                                <div class="input-group-text" id="basic-addon3">dompetdonasi.com/</div>
                                <input type="text" class="form-control" name="link_donasi" id="tanpaspasi"
                                    placeholder="Contoh : bantuyatim">
                            </div>

                            <div class="input-group" style="margin-bottom: 20px;">
                                <div class="input-group-text" id="basic-addon3">Rp</div>
                                <input type="text" class="form-control" name="target" maxlength="12" id="rupiah"
                                    placeholder="Target Donasi" onkeypress="return hanyaAngka(event)">
                                <input type="hidden" class="form-control" name="donasi" value="0">
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="inputState" class="form-label">Batas Waktu Penggalangan Dana</label>
                                <select id="inputState" name="periode" class="form-control">
                                    <option selected value="">- Jumlah Hari -</option>
                                    <option value="<?php echo $satu; ?>">30 Hari</option>
                                    <option value="<?php echo $dua; ?>">60 Hari</option>
                                    <option value="<?php echo $tiga; ?>">90 Hari</option>
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label for="inputState" class="form-label">Masukkan Cerita Penggalangan Dana
                                    Kamu</label>
                                <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan Cerita Kamu"
                                    rows="20"></textarea>
                                </select>
                            </div>

                            <input type="submit" name="create" class="btn btn-primary w-100" value="Selanjutnya">
                        </form>
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
    $R('#deskripsi', {
        plugins: ['imagemanager'],
        imageUpload: 'upload_img.php'
    });
    </script>
</body>

</html>