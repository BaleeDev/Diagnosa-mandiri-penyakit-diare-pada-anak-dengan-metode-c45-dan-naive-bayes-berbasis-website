<?php
@session_start();

// memanggil koneksi ke database dari file database/db.php
include '../../database/db.php';

if (@$_SESSION['Admin'] || @$_SESSION['Pegawai']) {
    if (@$_SESSION['Admin']) {
        $vid = $_SESSION['Admin'];
    } elseif (@$_SESSION['Pegawai']) {
        $vid = $_SESSION['Pegawai'];
    }
    // membuat fungsi untuk menampilkan pengguna
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_pengguna WHERE id='$vid'");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
        $vNama = $data['Nama_Pengguna'];
        $vEmail = $data['Email'];
        $vPw = $data['Password'];
        $vStatus = $data['Status'];
    }

    // menampilkan data berdasarkan id yang dikirim
    if (isset($_GET['id'])) {
        $vId = $_GET['id'];
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_pengguna WHERE id='$vId'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vNama = $data['Nama_Pengguna'];
            $vEmail = $data['Email'];
            $vPw = $data['Password'];
            $vStatus = $data['Status'];
            $vTelepon = $data['telepon'];
            $vAlamat = $data['Alamat'];
        }
    }
    if (isset($_POST['bEdit'])) {
        $edit = mysqli_query($koneksi, "UPDATE tbl_pengguna set Nama_Pengguna = '$_POST[nama]', Email = '$_POST[email]', Password = '$_POST[password]', Status = '$_POST[status]', Alamat = '$_POST[alamat]', telepon = '$_POST[telepon]' WHERE id='$vId' ");
        if ($edit) {
            echo "<script>
        alert('Edit berhasil');
        document.location='data_pengguna.php';
        </script>";
        } else {
            echo "<script>
        alert('Edit gagal');
        document.location='edit_data_pengguna.php';
        </script>";
        }
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-lg-2 d-none d-lg-block "></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Data Pegawai !</h1>
                        </div>
                        <form class="user" action="" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="nama" value="<?= @$vNama ?>" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Pengguna">
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="telepon" value="<?= @$vTelepon ?>" class="form-control form-control-user" id="exampleFirstName" placeholder="Telepon">
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <input type="email" name="email" value="<?= @$vEmail ?>" class="form-control form-control-user" id="exampleLastName" placeholder="Email">
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <select class="form-control" name="status">
                                        <!-- <option value="">Pilih Status</option> -->
                                        <option value="<?= $vStatus ?>"><?= $vStatus ?></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Pegawai">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat ..."><?= $vAlamat ?></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" value="<?= @$vPw ?>" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                            </div>
                            <button name="bEdit" class="btn btn-primary btn-user btn-block">
                                Edit Data Pengguna
                            </button>
                            <hr>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    include 'Layout/footer.php';
} else {
    echo "<script>
       alert('Anda Belum login');
       document.location='login.php';
       </script>";
}
?>