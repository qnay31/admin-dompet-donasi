<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Account - Dompet Donasi</title>
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
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets_form/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Create Account
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="post"
                    onsubmit="return validasi_create(this)" autocomplete="off">

                    <div class="wrap-input100 validate-input" data-validate="Masukkan Nama">
                        <input class="input100" type="text" name="nama" placeholder="Nama Lengkap" id="alpabet">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Masukkan Email">
                        <input class="input100" type="text" name="email" placeholder="Email" id="alpabet">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

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

                    <div class="wrap-input100 validate-input pw" data-validate="Konfirmasi password">
                        <span toggle="#password-field2" class="fa fa-fw fa-eye-slash toggle-password"></span>
                        <input class="input100" type="password" name="password2" placeholder="Konfirmasi Password"
                            id="password-field2">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <input type="submit" class="login100-form-btn" name="login" value="Create Account">
                    </div>

                    <hr>
                    <div class="create">
                        <span class="create_account">Sudah punya akun? <a class="btn-create" href="index.php">Login
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