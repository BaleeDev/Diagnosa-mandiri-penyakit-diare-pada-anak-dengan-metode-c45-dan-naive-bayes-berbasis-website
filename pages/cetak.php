<?php
// membuka sesi baru
@session_start();
// memanggil file koneksi ke database
include '../database/db.php';
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
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hasil Pemeriksaan Diagnosa Mandiri - <?= $vNama ?></title>

    <!-- Custom fonts for this template-->
    <link href="../sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../sbAdmin/css/sb-admin-2.min.css" rel="stylesheet">

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
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="table-responsive">
                            <label for=""><strong>Gejala Yang Di Alami :</strong></label>
                            <table class="table table-borderless" width="100%" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td>Status Mental</td>
                                        <td>: <i><?= $vStatusMental ?></i></td>
                                    </tr>
                                    <tr>
                                        <td>Derajat Haus</td>
                                        <td>: <i><?= $vDerajatHaus ?></i></td>
                                    </tr>
                                    <tr>
                                        <td>Frekuensi Denyut Jantung</td>
                                        <td>: <i><?= $vFrekuensiDenyutJantung ?></i></td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas Denyut Nadi</td>
                                        <td>: <i><?= $vDenyutNadi ?></i></td>
                                    </tr>
                                    <tr>
                                        <td>Pernapasan</td>
                                        <td>: <i><?= $vPernapasan ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Palpebra</td>
                                        <td>: <i><?= $vPalpebra ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Air Mata</td>
                                        <td>: <i><?= $vAirMata ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Mulut Dan Lidah</td>
                                        <td>: <i><?= $vMulutDanLidah ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Turgor</td>
                                        <td>: <i><?= $vTurgor ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Capillary Refill Time</td>
                                        <td>: <i><?= $vCRT ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Ekstremitas</td>
                                        <td>: <i><?= $vEkstermitas ?></i> </td>
                                    </tr>
                                    <tr>
                                        <td>Produksi Urin</td>
                                        <td>: <i><?= $vProduksiUrin ?></i> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end tabel -->
                <p>Dari gejala yang dialami oleh anak anda atas nama <strong><i><?= $vNama ?></i></strong> yang tertera pada tabel diatas bahwa anak anda mengalami
                    penyakit <strong><i>Diare <?= $vHasil ?></i></strong>, Untuk pemeriksaan lebih lanjut sebaiknya anda segera membawa anak anda ke rumah sakit atau puskesmas terdekat.</p>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("load", window.print());
    </script>
<?php
}
// include 'Layout/footer.php';
?>