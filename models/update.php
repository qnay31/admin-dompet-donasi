<?php

error_reporting(0);
session_start();
require '../function.php';

if (isset($_POST["update"]) ) {
    $key   = $_GET["key"];
    if(update_campaign($_POST) > 0 ) {
    echo "<script>
            alert('Update Campaign Selesai');
            document.location.href = 'list_update-campaign.php?link=$key';
        </script>";
        
    } 
    else {
        echo mysqli_error($conn);
    }


}

$unik  = $_GET["id_unik"];
$key   = $_GET["key"];

$query  = mysqli_query($conn, "SELECT * FROM campaign WHERE link = '$key' AND id = '$unik' ");
$data   = mysqli_fetch_assoc($query);

$judul  = $data["judul"];

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
                                <li class="page-item active"><a class="page-link"
                                        href="update.php?id_unik=<?= $unik ?>&key=<?= $key ?>"><small
                                            class=" text-white">Update Campaign</small>
                                    </a></li>

                                <li class="page-item"><a class="page-link"
                                        href="list_update-campaign.php?link=<?= $key ?>"><small>List
                                            Update</small>
                                    </a></li>
                            </ul>
                        </div>

                        <form method="post" enctype="multipart/form-data" action="" id="postForm"
                            onsubmit="return validasi_update(this)" autocomplete="off" name="buat_campaign">

                            <div class="form-group" style="margin-bottom:10px;">
                                <input type="text" name="fix_judul" class="form-control" value="<?= ucwords($judul) ?>"
                                    readonly>
                                <input type="hidden" name="link" value="<?= $key ?>">
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Update" onKeyUp='Hitung()' maxlength='50'
                                    style="text-transform: capitalize;">
                                <p align='left' id='asalbagus'>
                                    Sisa Karakter : 50/50
                                </p>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label for="inputState" class="form-label">Update Cerita Penggalangan</label>
                                <textarea id="deskripsi" name="deskripsi" placeholder="Cerita Terbaru"
                                    rows="20"></textarea>
                                </select>
                            </div>

                            <input type="submit" name="update" class="btn btn-primary w-100" value="Update Campaign">
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
        imageUpload: 'update_img.php'
    });
    </script>
</body>

</html>