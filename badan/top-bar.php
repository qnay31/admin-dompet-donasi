<?php

$query  = mysqli_query($conn, "SELECT * FROM akun_pengurus WHERE username = '$_SESSION[username]' ");
$data   = mysqli_fetch_assoc($query);
$nama   = $data['nama'];
$posisi = $data['posisi'];
$profil   = $data['profil'];

?>

<header class="pc-header ">
    <div class="header-wrapper">
        <div class="ml-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="http://localhost/admin_dompet/assets/images/user/<?= $profil ?>" alt="user-image"
                            class="user-avtar">
                        <span>
                            <span class="user-name"><?= $nama ?></span>
                            <span class="user-desc"><?= $posisi ?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <a href="../logout.php" class="dropdown-item">
                            <i class="material-icons-two-tone">account_circle</i>
                            <span>My Account</span>
                        </a>
                        <a href="../logout.php" class="dropdown-item">
                            <i class="material-icons-two-tone">settings</i>
                            <span>Settings</span>
                        </a>
                        <a href="../logout.php" class="dropdown-item">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>