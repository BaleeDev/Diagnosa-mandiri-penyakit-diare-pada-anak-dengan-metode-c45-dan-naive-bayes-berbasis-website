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

    // menampilkan data berdasarkan id yang dikirim
    if (isset($_GET['id'])) {
        $vId = $_GET['id'];
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_semua_data WHERE id='$vId'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vJK = $data['Jenis_Kelamin'];
            $vU = $data['Umur'];
            $vSM = $data['Status_Mental'];
            $vDH = $data['Derajat_Haus'];
            $vFDJ = $data['Frekuensi_Denyut_Jantung'];
            $vKDN = $data['Kualitas_Denyut_Nadi'];
            $vP = $data['Pernapasan'];
            $vPB = $data['Palpebra'];
            $vAM = $data['Air_Mata'];
            $vMDL = $data['Mulut_Dan_Lidah'];
            $vT = $data['Turgor'];
            $vCRT = $data['Capillary_Refill_Time'];
            $vE = $data['Ekstremitas'];
            $vPU = $data['Produksi_Urin'];
            $vH = $data['Hasil'];
        }
    }
    if (isset($_POST['Kirim'])) {
        $edit = mysqli_query($koneksi, "UPDATE tbl_semua_data set Jenis_Kelamin = '$_POST[jeniskelamin]', Umur = '$_POST[umur]', Status_Mental = '$_POST[statusmental]', Derajat_Haus = '$_POST[derajathaus]', Frekuensi_Denyut_Jantung = '$_POST[denyutjantung]', Kualitas_Denyut_Nadi = '$_POST[denyutnadi]', Pernapasan = '$_POST[pernapasan]', Palpebra = '$_POST[palpebra]', Air_Mata = '$_POST[airmata]', Mulut_Dan_Lidah = '$_POST[mulutdanlidah]', Turgor = '$_POST[turgor]', Capillary_Refill_Time = '$_POST[crt]', Ekstremitas = '$_POST[ekstremitas]', Produksi_Urin = '$_POST[urin]', Hasil = '$_POST[hasil]' WHERE id='$vId' ");
        if ($edit) {
            echo "<script>
        alert('Edit berhasil');
        document.location='semua_data.php';
        </script>";
        } else {
            echo "<script>
        alert('Edit gagal');
        document.location='edit_data.php';
        </script>";
        }
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Data !</h1>
                        </div>
                        <form action="" method="post">
                            <div class="form-group row mb-3 mt-2">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jeniskelamin" required>
                                        <!-- <option>Pilih Jenis Kelamin</option> -->
                                        <option value="<?= $vJK ?>"><?= $vJK ?></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Umur (Tahun)</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="umur">
                                        <!-- <option>Pilih Umur (Tahun)</option> -->
                                        <option value="<?= $vU ?>"><?= $vU ?></option>
                                        <option value="0 - < 1">0 - < 1</option>
                                        <option value="1 - < 5">1 - < 5</option>
                                        <option value="5 - < 6">5 - < 6</option>
                                        <option value="6 - < 10">6 - < 10</option>
                                        <option value="10 - < 13">10 - < 13</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Status Mental</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="statusmental">
                                        <!-- <option>Pilih Satus Mental</option> -->
                                        <option value="<?= $vSM ?>"><?= $vSM ?></option>
                                        <option value="Sadar">Sadar</option>
                                        <option value="Gelisah">Gelisah</option>
                                        <option value="Apatis">Apatis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Derajat Haus</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="derajathaus">
                                        <!-- <option>Pilih Derajat Haus</option> -->
                                        <option value="<?= $vDH ?>"><?= $vDH ?></option>
                                        <option value="Minum Normal">Minum Normal</option>
                                        <option value="Tampak Kehausan">Tampak Kehausan</option>
                                        <option value="Rasa Haus Berkurang">Rasa Haus Berkurang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Frekuensi Denyut Jantung</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="denyutjantung">
                                        <!-- <option>Pilih Frekuensi Denyut Jantung</option> -->
                                        <option value="<?= $vFDJ ?>"><?= $vFDJ ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Meningkat">Meningkat</option>
                                        <option value="Takikardia">Takikardia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kualitas Denyut Nadi</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="denyutnadi">
                                        <!-- <option>Pilih Kualitas Denyut Nadi</option> -->
                                        <option value="<?= $vKDN ?>"><?= $vKDN ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Menurun">Menurun</option>
                                        <option value="Lemah">Lemah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Pernapasan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="pernapasan">
                                        <!-- <option>Pilih Pernapasan</option> -->
                                        <option value="<?= $vP ?>"><?= $vP ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Cepat">Cepat</option>
                                        <option value="Dalam">Dalam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Palpebra</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="palpebra">
                                        <!-- <option>Pilih Palpebra</option> -->
                                        <option value="<?= $vPB ?>"><?= $vPB ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Sedikit Cekung">Sedikit Cekung</option>
                                        <option value="Sangat Cekung">Sangat Cekung</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Air Mata</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="airmata">
                                        <!-- <option>Pilih Air Mata</option> -->
                                        <option value="<?= $vAM ?>"><?= $vAM ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Berkurang">Berkurang</option>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Mulut Dan Lidah</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="mulutdanlidah">
                                        <!-- <option>Pilih Mulut Dan Lidah</option> -->
                                        <option value="<?= $vMDL ?>"><?= $vMDL ?></option>
                                        <option value="Lembab">Lembab</option>
                                        <option value="Kering">Kering</option>
                                        <option value="Sangat Kering">Sangat Kering</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Turgor</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="turgor">
                                        <!-- <option>Pilih Turgor</option> -->
                                        <option value="<?= $vT ?>"><?= $vT ?></option>
                                        <option value="Rekoil Cepat">Rekoil Cepat</option>
                                        <option value="Rekoil < 2 Detik">Rekoil < 2 Detik</option>
                                        <option value="Rekoil > 2 Detik">Rekoil > 2 Detik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Capillary Refill Time (CRT)</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="crt">
                                        <!-- <option>Pilih Capillary Refill Time (CRT)</option> -->
                                        <option value="<?= $vCRT ?>"><?= $vCRT ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Memanjang">Memanjang</option>
                                        <option value="Minimal">Minimal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Ekstremitas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="ekstremitas">
                                        <!-- <option>Pilih Ekstremitas</option> -->
                                        <option value="<?= $vE ?>"><?= $vE ?></option>
                                        <option value="Hangat">Hangat</option>
                                        <option value="Dingin">Dingin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Produksi Urin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="urin">
                                        <!-- <option>Pilih Produksi Urin</option> -->
                                        <option value="<?= $vPU ?>"><?= $vPU ?></option>
                                        <option value="Normal">Normal</option>
                                        <option value="Menurun">Menurun</option>
                                        <option value="Minimal">Minimal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Hasil</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="hasil">
                                        <!-- <option>Pilih Hasil</option> -->
                                        <option value="<?= $vH ?>"><?= $vH ?></option>
                                        <option value="Tanpa Dehidrasi">Tanpa Dehidrasi</option>
                                        <option value="Dehidrasi Ringan">Dehidrasi Ringan</option>
                                        <option value="Dehidrasi Sedang">Dehidrasi Sedang</option>
                                        <option value="Dehidrasi Berat">Dehidrasi Berat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="Kirim" class="btn btn-outline-primary">Edit</button>
                            </div>
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