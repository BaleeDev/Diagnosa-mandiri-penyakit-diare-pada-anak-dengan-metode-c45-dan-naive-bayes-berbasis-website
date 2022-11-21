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
    };


    if (isset($_POST['bTambah'])) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_pengguna` (`Nama_Pengguna`, `Email`, `Password`, `Status`, `Alamat`, `telepon`) VALUES ('$_POST[nama]', '$_POST[email]', '$_POST[password]','$_POST[status]','$_POST[alamat]','$_POST[telepon]')");
        if ($simpan) {
            echo "<script>
        alert('Simpan berhasil');
        document.location='data_pengguna.php';
        </script>";
        } else {
            echo "<script>
        alert('Simpan gagal');
        document.location='tambah_data_pengguna.php';
        </script>";
        }
    }
    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-block "></div>
                    <div class="col-lg-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tambah Data Pegawai !</h1>
                            </div>
                            <form class="user" action="" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="nama" value="<?= @$vNamaPengguna ?>" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Pengguna">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="telepon" value="<?= @$vTelepon ?>" class="form-control form-control-user" id="exampleFirstName" placeholder="Telepon">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <input type="email" name="email" value="<?= @$vEmailPengguna ?>" class="form-control form-control-user" id="exampleLastName" placeholder="Email">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <select class="form-control" name="status">
                                            <option value="">Pilih Status</option>
                                            <!-- <option value="<?= $vStatus ?>"><?= $vStatus ?></option> -->
                                            <option value="Admin">Admin</option>
                                            <option value="Pegawai">Pegawai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat ..."></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" value="<?= @$vPwPengguna ?>" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                </div>
                                <button name="bTambah" class="btn btn-primary btn-user btn-block">
                                    Tambah Data Pengguna
                                </button>
                                <hr>

                            </form>

                        </div>
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