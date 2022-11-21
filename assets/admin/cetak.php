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
    if (isset($_GET['id'])) {
        // tampilkan data berdasarkan id yang dikirim
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_uji WHERE id='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vNama = $data['Nama_Anak'];
            $vJenisKelamin = $data['Jenis_Kelamin'];
            $vUmur = $data['Umur'];
            $vStatusMental = $data['Status_Mental'];
            $vDerajatHaus = $data['Derajat_Haus'];
            $vFrekuensiDenyutJantung = $data['Frekuensi_Denyut_Jantung'];
            $vDenyutNadi = $data['Kualitas_Denyut_Nadi'];
            $vPernapasan = $data['Pernapasan'];
            $vPalpebra = $data['Palpebra'];
            $vAirMata = $data['Air_Mata'];
            $vMulutDanLidah = $data['Mulut_Dan_Lidah'];
            $vTurgor = $data['Turgor'];
            $vCRT = $data['Capillary_Refill_Time'];
            $vEkstermitas = $data['Ekstremitas'];
            $vProduksiUrin = $data['Produksi_Urin'];
            $vHasil = $data['Hasil'];
            $vtgl = $data['tgl'];
        }
        include 'Layout/header.php';
?>


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-9">
                    <h3 class="text-center">Hasil Pemeriksaan Diagnosa Mandiri Penyakit Diare Pada Anak</h3>
                    <hr>
                    <p class="text-right">Tanggal : <?= $vtgl ?></p> <br>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 mt-3">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama </td>
                                    <td>: <?= $vNama ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: <?= $vJenisKelamin ?></td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>: <?= $vUmur ?> Tahun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- membuat tabel -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <label for="">Tabel Gejala</label>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $vStatusMental ?></td>
                                        <td><?= $vDerajatHaus ?></td>
                                        <td><?= $vFrekuensiDenyutJantung ?></td>
                                        <td><?= $vDenyutNadi ?></td>
                                        <td><?= $vPernapasan ?></td>
                                        <td><?= $vPalpebra ?></td>
                                        <td><?= $vAirMata ?></td>
                                        <td><?= $vMulutDanLidah ?></td>
                                        <td><?= $vTurgor ?></td>
                                        <td><?= $vCRT ?></td>
                                        <td><?= $vEkstermitas ?></td>
                                        <td><?= $vProduksiUrin ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end tabel -->
                    <p>Dari gejala yang dialami oleh anak anda atas nama <strong><i><?= $vNama ?></i></strong> yang tertera pada tabel diatas bahwa anak anda mengalami
                        penyakit <strong><i>Diare <?= $vHasil ?></i></strong>, Untuk pemeriksaan lebih lanjut sebaiknya anda segera membawa anak anda ke rumah sakit atau puskesmas terdekat.</p>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<script>
       alert('Anda Belum login');
       document.location='login.php';
       </script>";
}
// include 'Layout/footer.php';
?>