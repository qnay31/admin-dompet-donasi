<?php

$q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Berlangsung' ORDER BY `dibuat` DESC");
$s = $q->num_rows;

?>
<div class="col-xl-12 col-md-12 pb-5">
    <div class="card">
        <div class="card-header">
            <h5>Data Campaign Aktif</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-data_campaign" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Judul Campaign</th>
                            <th scope="col">Sisa Periode</th>
                            <th scope="col">Target Donasi</th>
                            <th scope="col">Donasi Terkumpul</th>
                            <th scope="col">Penggunaan Dana</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                while ($r = $q->fetch_assoc()) {
                                    $terkumpul   = $r["terkumpul"];
                                    $terpakai    = $r["penggunaan_dana"];
                                    $target      = $r["target"];
                                    $dateawal    = date("Y-m-d");
                                    $dateakhir   = $r["berakhir"];

                                    $awal        = new DateTime($dateakhir);
                                    $akhir       = new DateTime($dateawal);
                                    $sisa        = $akhir->diff($awal);
                                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= ucwords($r['nama']) ?></td>
                            <td><a
                                    href="models/detail-list_campaign.php?linkid=<?= $r['link'] ?>"><?= ucwords($r['judul']) ?></a>
                            </td>
                            <td style="text-align: center;">
                                <?= $sisa->days ?> Hari</td>
                            <td style="text-align: center;">Rp. <?= number_format($target, 0, ".", ".") ?></td>
                            <td style="text-align: center;">Rp. <?= number_format($terkumpul, 0, ".", ".") ?></td>
                            <td style="text-align: center;">Rp. <?= number_format($terpakai, 0, ".", ".") ?></td>
                            <td style="text-align: center;"><b><?= ucwords($r['status']) ?></b></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th colspan="4">Total Keseluruhan</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>