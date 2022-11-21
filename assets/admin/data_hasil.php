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

    //membuat fungsi untuk menampilkan data trainig
    function tampilData($cari)
    {
        global $koneksi;
        if ($cari == "") {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_uji ORDER BY id Desc");
        } elseif ($cari != "") {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_uji WHERE Nama_Anak LIKE '%" . $cari . "%'");
        }
        return $tampil;
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Hasil Diagnosa Penyakit Diare Pada Anak</h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 text-right">
                        <!-- SEARCH FORM -->
                        <form class="form-inline ml-0 ml-md-3" action="data_hasil.php" method="POST">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" value="<?= @$_POST['cari'] ?>" name="cari" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" name="bCari" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-5" style="height: 450px;">
                    <table class="table table-responsive table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">TANGGAL</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">JENIS KELAMIN</th>
                                <th scope="col">UMUR</th>
                                <th scope="col">HASIL</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- memanggil fungsi tampil data -->
                            <?php
                            $nomor = 1;

                            if (isset($_POST['bCari'])) {
                                $vCari = $_POST['cari'];
                                $tampil = tampilData($vCari);
                            } elseif (!isset($_POST['bCari'])) {
                                $tampil = tampilData("");
                            }
                            // cek apakah ada data pada database tbl_data
                            if ($tampil) {
                                if (mysqli_num_rows($tampil) > 0) {
                                    // lakukan perulangan selama data pada database tbl_data ada
                                    while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                        <tr>
                                            <th scope="row"><?= $nomor++ ?></th>
                                            <td><?php echo $row['tgl'] ?></td>
                                            <td><?php echo $row['Nama_Anak'] ?></td>
                                            <td><?php echo $row['Jenis_Kelamin'] ?></td>
                                            <td><?php echo $row['Umur'] ?></td>
                                            <?php
                                            if ($row['Hasil'] == "Tanpa Dehidrasi") {
                                            ?>
                                                <td><span class="badge badge-success"><?php echo $row['Hasil'] ?></span></td>
                                            <?php
                                            } elseif ($row['Hasil'] == "Dehidrasi Ringan") {
                                            ?>
                                                <td><span class="badge badge-info"><?php echo $row['Hasil'] ?></span></td>
                                            <?php
                                            } elseif ($row['Hasil'] == "Dehidrasi Sedang") {
                                            ?>
                                                <td><span class="badge badge-warning"><?php echo $row['Hasil'] ?></span></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><span class="badge badge-danger"><?php echo $row['Hasil'] ?></span></td>
                                            <?php
                                            }
                                            ?>
                                            <td>
                                                <a href="../../pages/cetak.php?id=<?= $row['id'] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Cetak</a>
                                                <?php
                                                if (@$_SESSION['Admin']) {
                                                ?>
                                                    <a href="hapus_hasil.php?id=<?= $row['id'] ?>" id="hapus" class="badge badge-danger">Hapus</a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <!-- end fungsi tampil data -->
                        </tbody>
                    </table>
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