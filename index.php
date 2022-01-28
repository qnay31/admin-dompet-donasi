<?php 
session_start();
error_reporting(0);
require 'function.php';

$date   = date("Y-m-d H:i:s");
$ip     = get_client_ip();

if (isset($_POST["login"]) ) {

    $username = $_POST ["username"];
    $password = $_POST ["password"];

    $result = mysqli_query($conn, "SELECT * FROM akun_pengurus WHERE username = '$username' " );
//cek username database
        // die(var_dump($username));
        if (mysqli_num_rows($result) === 1 ) {


          // cek password database

        $row = mysqli_fetch_assoc($result);
    // die(var_dump($row));

        
        if (password_verify($password, $row["password"]) ) {

          // set session

            if($row['username'] == "$username"){
            $_SESSION["halaman_utama"]      = true ;
        
            // buat session login dan username ADMIN
            $_SESSION["id"]           = $row["id"];
            $_SESSION["id_pengurus"]  = $row["id_pengurus"];
            $_SESSION["nama"]         = $row["nama"];
            $_SESSION["email"]        = $row["email"];
            $_SESSION["username"]     = $row["username"];
            $_SESSION["profil"]       = $row["profil"];
            $_SESSION["password"]     = $row["password"];
            $_SESSION["posisi"]       = $row["posisi"];

            // die(var_dump($data));

            mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$_SESSION[nama]', '$ip', '$date', '$_SESSION[nama] Telah Login Halaman Dashboard')");
            header("Location: user/$_SESSION[username].php");

        }


        exit; 
        }


    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Dompet Donasi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets_form/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets_form/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets_form/css/main.css">
    <!--===============================================================================================-->
    <style>
    .alert {
        background: #e44e4e;
        color: white;
        text-align: center;
        border: 1px solid #b32929;
        position: fixed;
        width: 100%;
        z-index: 5;
    }
    </style>
</head>
<?php 
if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
        echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
    }
}
?>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets_form/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Login
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="post"
                    onsubmit="return validasi_login(this)" autocomplete="off">

                    <div class="wrap-input100 validate-input" data-validate="Masukkan username">
                        <input class="input100" type="text" name="username" placeholder="User name" id="alpabet">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input pw" data-validate="Masukkan password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye-slash toggle-password"></span>
                        <input class="input100" type="password" name="password" placeholder="Password"
                            id="password-field">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <?php if (isset ($error) ) : ?>
                    <p style="color: red; font-style: italic;padding-left:35px">Username/Password salah!</p>
                    <?php endif ?>

                    <div class="container-login100-form-btn m-t-32">
                        <input type="submit" class="login100-form-btn" name="login" value="Login">
                    </div>

                    <hr>
                    <div class="create">
                        <span class="create_account">Belum punya akun? <a class="btn-create" href="register.php">Buat
                                Sekarang!</a></span>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="assets_form/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/vendor/bootstrap/js/popper.js"></script>
    <script src="assets_form/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets_form/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="assets_form/js/main.js"></script>

</body>

</html>