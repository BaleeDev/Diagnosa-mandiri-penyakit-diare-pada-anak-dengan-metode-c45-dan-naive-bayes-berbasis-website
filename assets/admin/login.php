<?php
@session_start();

// memanggil koneksi ke database dari file database/db.php
include '../../database/db.php';
if (@$_SESSION['Admin'] || @$_SESSION['Pegawai']) {
    header("location: beranda.php");
} else {
    if (isset($_POST['bLogin'])) {
        $vEmail = $_POST['email'];
        // echo $vEmail;
        $vPw = $_POST['password'];
        if ($vEmail == "" || $vPw == "") {
?>
            <script type="text/javascript">
                alert("Email / Password Tidak Boleh Kosong");
            </script>
    <?php

        } else {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_pengguna where Email='$vEmail' && Password = '$vPw'");
            $CEK = mysqli_num_rows($tampil);
            $data = mysqli_fetch_array($tampil);
            if ($CEK > 0) {
                if ($data['Status'] == "Admin") {
                    @$_SESSION['Admin'] = $data['id'];
                } elseif ($data['Status'] == "Pegawai") {
                    @$_SESSION['Pegawai'] = $data['id'];
                }
                echo "<script>
alert('Login Berhasil');
document.location='index.php';
</script>";
            } else {
                echo "<script>
alert('Login Gagal');
</script>";
            }
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Diagnosa Mandiri - Login</title>

        <!-- Custom fonts for this template-->
        <link href="../../sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../sbAdmin/css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-2 d-none d-lg-block "></div>
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                            <p><i>Silahkan login terlebih dahulu untuk bisa masuk</i></p>
                                        </div>
                                        <form class="user" action="" method="POST">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <button name="bLogin" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../sbAdmin/vendor/jquery/jquery.min.js"></script>
        <script src="../../sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../sbAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../sbAdmin/js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php } ?>