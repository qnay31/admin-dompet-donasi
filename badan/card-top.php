<?php

if ($_SESSION['id_pengurus'] == 'admin_user') {
    $q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Berlangsung' ORDER BY `dibuat` DESC");
    $s = $q->num_rows;

    
    $i = 1;
    $sql = $q;
    while($r = mysqli_fetch_array($sql))
    {
        $terkumpul = $r['terkumpul'];
        $i++;
        $total_terkumpul[$i] = $terkumpul;
        
        $hasil_terkumpul = array_sum($total_terkumpul);
        
        // die(var_dump($hasil_terpakai));
    }
    
    $query = mysqli_query($conn, "SELECT * FROM data_dompet");
    $sql2 = $query;
    while($r2 = mysqli_fetch_array($sql2))
    {
        
        $visit = $r2['visitor'];
        $i++;
        $total_visit[$i] = $visit;

        $visitor = array_sum($total_visit);

        // die(var_dump($visitor));
    }

    $q_donasi = mysqli_query($conn, "SELECT * FROM donasi WHERE status = 'Terkonfirmasi' ORDER BY `dibuat` DESC");
    $donatur = $q_donasi->num_rows;
} elseif ($_SESSION['id_pengurus'] == 'ketua_user') {
    $q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Berlangsung' ORDER BY `dibuat` DESC");
    $s = $q->num_rows;

    
    $i = 1;
    $sql = $q;
    while($r = mysqli_fetch_array($sql))
    {
        $terkumpul = $r['terkumpul'];
        $i++;
        $total_terkumpul[$i] = $terkumpul;
        
        $hasil_terkumpul = array_sum($total_terkumpul);
        
        // die(var_dump($hasil_terpakai));
    }
    
    $query = mysqli_query($conn, "SELECT * FROM data_dompet");
    $sql2 = $query;
    while($r2 = mysqli_fetch_array($sql2))
    {
        
        $visit = $r2['visitor'];
        $i++;
        $total_visit[$i] = $visit;

        $visitor = array_sum($total_visit);

        // die(var_dump($visitor));
    }

    $q_donasi = mysqli_query($conn, "SELECT * FROM donasi WHERE status = 'Terkonfirmasi' ORDER BY `dibuat` DESC");
    $donatur = $q_donasi->num_rows;
    
} else {
    $q = mysqli_query($conn, "SELECT * FROM campaign WHERE status = 'Berlangsung' ORDER BY `dibuat` DESC");
    $s = $q->num_rows;

    $query = mysqli_query($conn, "SELECT * FROM campaign");
    $jumlah = $query->num_rows;

    $i = 1;
    $sql = $query;
    while($r = mysqli_fetch_array($sql))
    {
        
        $terkumpul = $r['terkumpul'];
        $i++;
        $total_terkumpul[$i] = $terkumpul;

        $hasil_terkumpul = array_sum($total_terkumpul);

        // die(var_dump($hasil_terpakai));
    }

    $q_donasi = mysqli_query($conn, "SELECT * FROM donasi WHERE status = 'Terkonfirmasi' ORDER BY `dibuat` DESC");
    $donatur = $q_donasi->num_rows;
}

?>
<div class="row">
    <div class="col-sm-3">
        <div class="card prod-p-card background-pattern">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5">Campaign Aktif</h6>
                        <?php if ($s == 0) { ?>
                        <h3 class="m-b-0">- Campaign</h3>
                        <?php } else { ?>
                        <h3 class="m-b-0"><?= $s ?> Campaign</h3>
                        <?php } ?>

                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-primary">campaign</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['id_pengurus'] == 'admin_user') { ?>
    <div class="col-sm-3">
        <div class="card prod-p-card bg-primary background-pattern-white">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Uang Masuk </h6>
                        <h3 class="m-b-0 text-white">Rp. <?= number_format($hasil_terkumpul, 0, ".", ".") ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-white">attach_money</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } elseif ($_SESSION['id_pengurus'] == 'ketua_user') { ?>
    <div class="col-sm-3">
        <div class="card prod-p-card background-pattern">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5">Visitor</h6>
                        <?php if ($visitor == 0) { ?>
                        <h3 class="m-b-0">- Orang</h3>
                        <?php } else { ?>
                        <h3 class="m-b-0"><?= $visitor ?> Orang</h3>
                        <?php } ?>
                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-primary">view_list</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-sm-3">
        <div class="card prod-p-card bg-primary background-pattern-white">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Terkumpul</h6>
                        <h3 class="m-b-0 text-white">Rp. <?= number_format($hasil_terkumpul, 0, ".", ".") ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-white">attach_money</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if ($_SESSION['id_pengurus'] == 'admin_user') { ?>
    <div class="col-sm-3">
        <div class="card prod-p-card background-pattern">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5">Visitor</h6>
                        <?php if ($visitor == 0) { ?>
                        <h3 class="m-b-0">- Orang</h3>
                        <?php } else { ?>
                        <h3 class="m-b-0"><?= $visitor ?> Orang</h3>
                        <?php } ?>
                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-primary">view_list</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-sm-3">
        <div class="card prod-p-card background-pattern">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5">Jumlah Campaign</h6>
                        <?php if ($jumlah == 0) { ?>
                        <h3 class="m-b-0">- Campaign</h3>
                        <?php } else { ?>
                        <h3 class="m-b-0"><?= $jumlah ?> Campaign</h3>
                        <?php } ?>
                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-primary">view_list</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>


    <div class="col-sm-3">
        <div class="card prod-p-card bg-primary background-pattern-white">
            <div class="card-body">
                <div class="row align-items-center m-b-0">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Donatur</h6>
                        <?php if ($donatur == 0) { ?>
                        <h3 class="m-b-0 text-white">- Donatur</h3>
                        <?php } else { ?>
                        <h3 class="m-b-0 text-white"><?= $donatur ?> Donatur</h3>
                        <?php } ?>

                    </div>
                    <div class="col-auto">
                        <i class="material-icons-two-tone text-white">people</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>