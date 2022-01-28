<?php

error_reporting(0);
session_start();

if (!isset($_SESSION["halaman_utama"])) {
    header("Location: ../index.php?pesan=gagal");
    exit;
}

require '../function.php';
$q = mysqli_query($conn, "SELECT * FROM donasi WHERE status = 'Pending' ORDER BY `dibuat` DESC");
$s = $q->num_rows;

if (isset($_POST["konfirmasi"]) ) {
    if(konfirmasi_donasi($_POST) > 0 ) {
            echo "<script>
                    alert('Donasi Berhasil dikonfirmasi');
                    document.location.href = 'check-donasi.php';
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
    <title>Dashboard Checklist Donasi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="refresh" content="300" />
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
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
                                <li class="breadcrumb-item">Checklist Donasi</li>
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
                                <li class="page-item active"><a class="page-link" href="check-donasi.php"><small
                                            class=" text-white">Donasi Check</small>
                                        <?php if ($s == 0) { ?>
                                        <?php } else { ?>
                                        <span class="badge text-white bg-danger"><?= $s ?></span>
                                        <?php } ?>
                                    </a></li>
                                <li class="page-item"><a class="page-link "
                                        href="pencairan-dana.php"></i><small>Pencairan
                                            Dana&nbsp;</small>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="card support-bar">
                            <div class="card-header">
                                <h5>Donasi Pending</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="tabel-data-donasi" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th scope="col">No</th>
                                            <th scope="col">Campaign</th>
                                            <th scope="col">Nama Donatur</th>
                                            <th scope="col">Nama Yang Tampil</th>
                                            <th scope="col">Tanggal Donasi</th>
                                            <th scope="col">No Handphone</th>
                                            <th scope="col">Doa</th>
                                            <th scope="col">Donasi</th>
                                            <th scope="col">Kode Unik</th>
                                            <th scope="col">Jumlah Donasi</th>
                                            <th scope="col">Via Bank</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                $no = 1;
                                while ($r = $q->fetch_assoc()) {
                                    $tanggal = $r["dibuat"];
                                    $tgl    = date("d-m-Y", strtotime($tanggal));
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++ ?></td>
                                            <td><?= ucwords($r['jenis']) ?></td>
                                            <td><?= ucwords($r['nama_donatur']) ?></td>
                                            <td><?php if ($r['nama_tampil'] == "") {?>
                                                <?= ucwords($r['nama_donatur']) ?>
                                                <?php } else { ?>
                                                <?= ucwords($r['nama_tampil']) ?>
                                                <?php } ?></td>
                                            <td style="text-align: center;"><?= $tgl ?></td>
                                            <td><?= ucwords($r['no_hp']) ?></td>
                                            <td><?php if ($r['doa'] == "") { ?>
                                                -
                                                <?php } else { ?>
                                                <?= ucwords($r['doa']) ?>
                                                <?php } ?></td>
                                            <td style="text-align: center;">
                                                Rp. <?= number_format($r['donasi'], 0, ".", ".") ?></td>
                                            <td style="text-align: center;"><?= $r['kode_unik'] ?></td>
                                            <td style="text-align: center;">
                                                Rp. <?= number_format($r['jumlah_donasi'], 0, ".", ".") ?></td>
                                            <td style="text-align: center;"><?= ucwords($r['via']) ?></td>
                                            <td style="text-align: center;"><b><?= ucwords($r['status']) ?></b></td>
                                            <td style="text-align: center;"><input type="button" name="view"
                                                    value="Cek Donasi" data-id="<?= $r['id']  ?>"
                                                    data-cek="<?= $r['id'] ?>"
                                                    class="btn btn-danger btn-xs view_data_donasi">
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- Modal -->
                                <div id="dataModal_donasi" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi Donasi</h4>
                                            </div>
                                            <div class="modal-body" id="detail_user_donasi">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">kembali</button>
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
    <script>
    $(document).ready(function() {
        $('.view_data_donasi').click(function() {
            var data_id = $(this).data("id")
            $.ajax({
                url: "cek-donasi.php",
                method: "POST",
                data: {
                    data_id: data_id
                },
                success: function(data) {
                    $("#detail_user_donasi").html(data)
                    $("#dataModal_donasi").modal('show')
                }
            })
        })

        $('#tabel-data-donasi').DataTable({
            "scrollX": true
        });


    });
    </script>
</body>

</html>