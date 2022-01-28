<?php

$q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Berlangsung' ORDER BY `id` DESC");
$s = $q->num_rows;

$q2 = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Pending' ORDER BY `dibuat` DESC");

?>

<div class="row">
    <div class="col-md-6">
        <div class="card support-bar">
            <div class="card-header">
                <h5>Campaign Aktif</h5>
            </div>
            <main>
                <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                    <div class="row slider">
                        <?php
                        $no = 1;
                        while ($r = $q->fetch_assoc()) {
                            $terkumpul      = $r["terkumpul"];
                            $new_terkumpul  = (int) $terkumpul;

                            $target     = $r["target"];
                            $new_target = (int) $target;

                            $persen  = round($new_terkumpul/$new_target * 100,2);

                            $dateawal = date("Y-m-d");
                            $dateakhir = $r["berakhir"];

                            $awal = new DateTime($dateakhir);
                            $akhir = new DateTime($dateawal);

                            // die(var_dump($target));


                            $sisa = $akhir->diff($awal);
                            
                            ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <a href="http://localhost/new_dompet/<?= $r["link"] ?>.php" target="_blank">
                                    <img data-lazy="assets/images/cover-campaign/<?= $r["foto"] ?>" class="card-img-top"
                                        alt="...">
                                    <div class="label-top shadow-sm"><?= $r["status"] ?></div>
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
                                            <span class="float-start"><b><?= $sisa->days ?> Hari</b></span>
                                            <span class="float-end"><b>Rp.
                                                    <?= number_format($terkumpul, 0, ".", ".") ?></b></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                                style="width: <?= $persen ?>%" aria-valuenow="10" aria-valuemin="0"
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
    <div class="col-md-6">
        <div class="card support-bar">
            <div class="card-header">
                <h5>Campaign Pending</h5>
            </div>
            <main>
                <div class="container-fluid bg-trasparent my-4 p-3">
                    <div class="row slider">
                        <?php
                        $no = 1;
                        while ($r = $q2->fetch_assoc()) {
                            $terkumpul      = $r["terkumpul"];
                            $new_terkumpul  = (int) $terkumpul;

                            $target     = $r["target"];
                            $new_target = (int) $target;

                            $persen  = round($new_terkumpul/$new_target * 100,2);

                            $dateawal = date("Y-m-d");
                            $dateakhir = $r["berakhir"];

                            $awal = new DateTime($dateakhir);
                            $akhir = new DateTime($dateawal);

                            // die(var_dump($target));


                            $sisa = $akhir->diff($awal);
                            
                            ?>
                        <div class="col">
                            <div class="card shadow-sm disabled"> <img
                                    data-lazy="assets/images/cover-campaign/<?= $r["foto"] ?>" class="card-img-top"
                                    alt="...">
                                <div class="label-top shadow-sm pending"><?= $r["status"] ?></div>
                                <div class="card-body disable">
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
                                        <span class="float-start"><b><?= $sisa->days ?> Hari</b></span>
                                        <span class="float-end"><b>Rp.
                                                <?= number_format($terkumpul, 0, ".", ".") ?></b></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar"
                                            style="width: <?= $persen ?>%" aria-valuenow="10" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>