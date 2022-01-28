<nav class="pc-sidebar ">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="http://localhost/admin_dompet/user/<?= $_SESSION['username'] ?>.php" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="http://localhost/admin_dompet/assets/images/logo.svg" alt="" class="logo logo-lg">
                <img src="http://localhost/admin_dompet/assets/images/logo-sm.svg" alt="" class="logo logo-sm">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item">
                    <a href="http://localhost/admin_dompet/user/<?= $_SESSION['username'] ?>.php" class="pc-link "><span
                            class="pc-micon"><i class="material-icons-two-tone">home</i></span><span
                            class="pc-mtext">Dashboard</span></a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Forms</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link "><span class="pc-micon"><i
                                class="material-icons-two-tone">edit</i></span><span class="pc-mtext">Forms
                        </span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <?php if ($_SESSION['id_pengurus'] == 'admin_user') { ?>
                        <li class="pc-item"><a class="pc-link"
                                href="http://localhost/admin_dompet/models/check-campaign.php">Checlist Campaign</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="http://localhost/admin_dompet/models/check-donasi.php">Checklist Donasi</a></li>
                        <?php } else { ?>
                        <li class="pc-item"><a class="pc-link"
                                href="http://localhost/admin_dompet/models/input-campaign.php">Form Campaign</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="form2_input_group.html">Form Pencairan Dana</a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>