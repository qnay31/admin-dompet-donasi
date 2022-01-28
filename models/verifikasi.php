<?php
error_reporting(0);
session_start();
require '../function.php';

$q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Pending' ORDER BY `dibuat` DESC");
$s = $q->num_rows;

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

    <!-- owl corousel -->
    <link rel="stylesheet" href="../owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../owlcarousel/assets/owl.theme.default.min.css">

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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item">Form Campaign</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center campain-create">
                <div class="box-white">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center" id="page">
                        <ul class="pagination shadow-lg">
                            <li class="page-item"><a class="page-link"
                                    href="input-campaign.php"><small>Pengajuan</small>
                                </a></li>
                            <li class="page-item active"><a class="page-link " href="verifikasi.php"></i><small
                                        class=" text-white">Verifikasi&nbsp;</small>
                                    <?php if ($s == 0) { ?>
                                    <?php } else { ?>
                                    <span class="badge text-white bg-danger"><?= $s ?></span>
                                    <?php } ?>
                                </a></li>
                            <li class="page-item"><a class="page-link " href="update-campaign.php"></i><small>Update
                                        Campaign&nbsp;</small>
                                </a></li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-data-campaign" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Target Donasi</th>
                                    <th scope="col">Periode Campaign</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($r = $q->fetch_assoc()) {
                                    $target     = $r["target"];
                                    ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?></td>
                                    <td><?= ucwords($r['nama']) ?></td>
                                    <td><?= $r['link'] ?></td>
                                    <td><?= ucwords($r['judul']) ?></td>
                                    <td>Rp. <?= number_format($target, 0, ".", ".") ?></td>
                                    <td style="text-align: center;">
                                        <?= date('d-m-Y', strtotime($r['berakhir'])); ?></td>
                                    <td style="text-align: center;"><input type="button" name="view" value="Lihat"
                                            data-id="<?= $r['id']  ?>" class="btn btn-danger btn-xs view_data_campaign">
                                    </td>
                                    <td style="text-align: center;"><b><?= ucwords($r['status']) ?></b></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div id="dataModal_campaign" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cover Campaign</h4>
                                    </div>
                                    <div class="modal-body" id="detail_user_campaign">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
    <!-- owl corosel -->
    <script src="../owlcarousel/owl.carousel.js"></script>
    <script>
    $(document).ready(function() {

        $('#tabel-data-campaign').DataTable({
            "scrollX": true,
            columnDefs: [{
                width: '20%',
                targets: 1
            }, {
                width: '20%',
                targets: 2
            }, {
                width: '20%',
                targets: 3
            }, {
                width: '20%',
                targets: 4
            }],
        });

        // modal 
        $('.view_data_campaign').click(function() {
            var data_id = $(this).data("id")
            $.ajax({
                url: "isi_campaign.php",
                method: "POST",
                data: {
                    data_id: data_id
                },
                success: function(data) {
                    $("#detail_user_campaign").html(data)
                    $("#dataModal_campaign").modal('show')
                }
            })
        })

    });
    </script>
</body>

</html>