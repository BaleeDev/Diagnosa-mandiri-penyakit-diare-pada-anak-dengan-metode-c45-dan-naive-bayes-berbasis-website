<?php
@session_start();
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
    // membuat fungsi untuk menampilkan jumlah total data
    function TotalData($data)
    {
        global $koneksi;
        if ($data == "All Data") {
            // menampilkan data berdasarkan data yang ada di database
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_semua_data");
        } elseif ($data == "Data Training") {
            // menampilkan data berdasarkan data yang ada di database
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE Status='Aktif'");
        } elseif ($data == "Data Testing") {
            // menampilkan data berdasarkan data yang ada di database
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE Status='Belum Aktif'");
        } elseif ($data == "Data Pengguna") {
            // menampilkan data berdasarkan data yang ada di database
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengguna WHERE Status ='Pegawai'");
        }
        // mengambil jumlah total data 
        $jumlah_data = mysqli_num_rows($tampil);
        return $jumlah_data;
    }
    include 'Layout/header.php';
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="semua_data.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Data

                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= TotalData("All Data") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a href="data_user.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Data User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= TotalData("Data Training") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <a href="daftar_user.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Data User Daftar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= TotalData("Data Testing") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="data_pengguna.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Data Pegawai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= TotalData("Data Pengguna") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <!-- Content Row -->

<?php
    include 'Layout/footer.php';
} else {
    echo "<script>
       alert('Anda Belum login');
       document.location='login.php';
       </script>";
}
?>