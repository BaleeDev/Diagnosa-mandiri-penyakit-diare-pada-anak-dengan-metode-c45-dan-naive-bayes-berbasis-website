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
    function tampilData()
    {
        global $koneksi;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_data");
        return $tampil;
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Training Penyakit Diare Pada Anak</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">JENIS KELAMIN</th>
                                <th scope="col">UMUR</th>
                                <th scope="col">STATUS MENTAL</th>
                                <th scope="col">DERAJAT HAUS</th>
                                <th scope="col">FREKUENSI DENYUT JANTUNG</th>
                                <th scope="col">KUALITAS DENYUT NADI</th>
                                <th scope="col">PERNAPASAN</th>
                                <th scope="col">PALPEBRA</th>
                                <th scope="col">AIR MATA</th>
                                <th scope="col">MULUT DAN LIDAH</th>
                                <th scope="col">TURGOR</th>
                                <th scope="col">CAPILLARY REFILL TIME (CRT)</th>
                                <th scope="col">EKSTREMITAS</th>
                                <th scope="col">PRODUKSI URIN</th>
                                <th scope="col">HASIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- memanggil fungsi tampil data -->
                            <?php
                            $nomor = 1;
                            $tampil = tampilData();
                            // cek apakah ada data pada database tbl_data
                            if ($tampil) {
                                if (mysqli_num_rows($tampil) > 0) {
                                    // lakukan perulangan selama data pada database tbl_data ada
                                    while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                        <tr>
                                            <th scope="row"><?= $nomor++ ?></th>
                                            <td><?php echo $row['Jenis_Kelamin'] ?></td>
                                            <td><?php echo $row['Umur'] ?></td>
                                            <td><?php echo $row['Status_Mental'] ?></td>
                                            <td><?php echo $row['Derajat_Haus'] ?></td>
                                            <td><?php echo $row['Frekuensi_Denyut_Jantung'] ?></td>
                                            <td><?php echo $row['Kualitas_Denyut_Nadi'] ?></td>
                                            <td><?php echo $row['Pernapasan'] ?></td>
                                            <td><?php echo $row['Palpebra'] ?></td>
                                            <td><?php echo $row['Air_Mata'] ?></td>
                                            <td><?php echo $row['Mulut_Dan_Lidah'] ?></td>
                                            <td><?php echo $row['Turgor'] ?></td>
                                            <td><?php echo $row['Capillary_Refill_Time'] ?></td>
                                            <td><?php echo $row['Ekstremitas'] ?></td>
                                            <td><?php echo $row['Produksi_Urin'] ?></td>
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