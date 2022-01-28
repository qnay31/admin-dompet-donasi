<?php
session_start();
error_reporting(0);
require '../../function.php';
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
    <link rel="icon" href="../../assets/images/favicon.svg" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="../../assets/fonts/feather.css">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="../../assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="../../assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

</head>

<style>
button.btn-pratinjau {
    background-color: #369b7e;
    font-size: 16px;
    font-weight: bold;
    color: white;
    width: 100%;
    border-radius: 20px;
    padding: 12px;
    margin-top: 10px;
}

.card h2 {
    text-align: center;
    font-family: cursive;
}

.card hr {
    text-align: center;
    border-bottom: 4px solid black;
    width: 20%;
    margin: auto;
}

#cek {
    display: none;
}

.cek label {
    font-size: 22px;
    font-weight: bold;
    margin-left: 20px;
    cursor: pointer;

}

.cek input {
    margin-top: 20px;
}

.cek label span {
    margin-left: 20px;
    margin-top: -10px !important;
}

#image {
    margin-top: 20px;
}

input#enabled.cagree {
    width: 20px !important;
    height: 20px !important;
}

.posisi {
    display: flex;
    justify-content: center;
}

.btn-gambar {
    background-color: #297761;
    font-size: 16px;
    font-weight: bold;
    color: white;
    width: 100%;
    border-radius: 20px;
    padding: 12px;
    margin-top: 10px;
}

.btn-gambar:disabled {
    background-color: #b3b3b3;
    cursor: not-allowed;
}

.btn.disabled,
.btn:disabled {
    background-color: #b3b3b3;
    cursor: not-allowed;
}
</style>

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="pc-container">
        <div class="pcoded-content">
            <div class="row justify-content-center campain-create">
                <div class="col-lg-6 col-12">
                    <div class="box-white">
                        <div class="card shadow-sm"
                            style="border:none; padding:25px; border-radius:15px; margin-top:20px;">
                            <h2>Upload Foto Campaign Kamu</h2>
                            <hr>
                            <div class="card-body">
                                <p style="margin-top:20px; margin-bottom:10px;">Sesuaikan ukuran cover campaign kamu :
                                    <span class="text-danger">*ukuran foto360px X 220px</span>
                                </p>
                                <div class="posisi">
                                    <div id="upload-demo"
                                        style="background:#b3b3b3;width:360px;height:220px; margin-top:10px; background-style:cover;">
                                    </div>
                                </div>
                                <div class="upload-image" style="margin-top:5%">
                                    <input type="file" id="image" accept="image/*">
                                </div>

                                <div id="button-show">
                                    <button class="btn btn-pratinjau btn-block btn-upload-image"
                                        style="margin-top:2%; font-weight:bold; font-size: 1em;" id="button-upload"
                                        disabled>UPLOAD
                                        GAMBAR</button>
                                    <p style="margin-top:25px; margin-bottom:10px; color:red; font-size:16px;">*Cover
                                        campaign
                                        penggalangan dana kamu :</p>
                                    <div class="posisi">
                                        <div id="preview-crop-image"
                                            style="background:#b3b3b3;width:360px;height:220px;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="cek" id="cek">
                                <label><input type="checkbox" id="check" name="enabled" class="cagree"><span>Saya
                                        membuat Campaign
                                        ini</span></label>
                                <a href="../verifikasi.php"><input type="button" value="Buat Campaign Baru"
                                        name="buat_campaign" class="btn btn-gambar" id="submit-button" disabled
                                        onclick="myFunction()"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/vendor-all.min.js"></script>
    <script src="../../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/feather.min.js"></script>
    <script src="../../assets/js/pcoded.min.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <script>
    function myFunction() {
        alert("Mohon Menunggu, Admin akan mengkonfirmasi penggalangan dana kamu");
    }
    </script>

    <script type="text/javascript">
    var resize = $('#upload-demo').croppie({
        enableOrientation: true,
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 360,
            height: 220,
            type: 'box' //square
        },
        boundary: {
            width: 360,
            height: 220,
        }
    });


    $('#image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            resize.croppie('bind', {
                url: e.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });


    $('.btn-upload-image').on('click', function(ev) {
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(img) {
            $.ajax({
                url: "croppie.php",
                type: "POST",
                data: {
                    "image": img
                },
                success: function(data) {
                    html = '<img src="' + img + '" />';
                    $("#preview-crop-image").html(html);
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $("#image").change(function(evt) {
            window.selectedFile = evt.target.files[0];
            var terms = $('#check').is(":checked");
            if (window.selectedFile && terms) {
                $('#submit-button').prop("disabled", false);
            } else {
                $('#submit-button').prop("disabled", true);
            }
            //convertToExcel(); 
            return false;
        });

        $('#check').change(function() {
            var terms = $('#check').is(":checked");
            if (window.selectedFile && terms) {
                $('#submit-button').prop("disabled", false);
            } else {
                $('#submit-button').prop("disabled", true);
            }
            //convertToExcel(); 
            return false;
        })

        $("#image").change(function(evt) {
            window.selectedFile = evt.target.files[0];
            if (window.selectedFile) {
                $('#button-upload').prop("disabled", false);
            } else {
                $('#button-upload').prop("disabled", true);
            }
            //convertToExcel(); 
            return false;
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#button-show").click(function() {
            $("#cek").toggle('slow');
        });
    });
    </script>
</body>

</html>