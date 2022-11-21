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
    if (isset($_POST['Kirim'])) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_semua_data` (`id`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES (NULL, '$_POST[jeniskelamin]', '$_POST[umur]', '$_POST[statusmental]', '$_POST[derajathaus]', '$_POST[denyutjantung]', '$_POST[denyutnadi]', '$_POST[pernapasan]', '$_POST[palpebra]', '$_POST[airmata]', '$_POST[mulutdanlidah]', '$_POST[turgor]', '$_POST[crt]', '$_POST[ekstremitas]', '$_POST[urin]', '$_POST[hasil]')");
        if ($simpan) {
            echo "<script>
        alert('Simpan berhasil');
        document.location='semua_data.php';
        </script>";
        } else {
            echo "<script>
        alert('Simpan gagal');
        document.location='tambah_data.php';
        </script>";
        }
    }
    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Penyakit Diare Pada Anak</h6>
            </div>
            <div class="container mt-2">
                <form action="" method="post">
                    <div class="form-group row mb-3 mt-2">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jeniskelamin" required>
                                <option>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Umur (Tahun)</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="umur">
                                <option>Pilih Umur (Tahun)</option>
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
                                <option>Pilih Satus Mental</option>
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
                                <option>Pilih Derajat Haus</option>
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
                                <option>Pilih Frekuensi Denyut Jantung</option>
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
                                <option>Pilih Kualitas Denyut Nadi</option>
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
                                <option>Pilih Pernapasan</option>
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
                                <option>Pilih Palpebra</option>
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
                                <option>Pilih Air Mata</option>
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
                                <option>Pilih Mulut Dan Lidah</option>
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
                                <option>Pilih Turgor</option>
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
                                <option>Pilih Capillary Refill Time (CRT)</option>
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
                                <option>Pilih Ekstremitas</option>
                                <option value="Hangat">Hangat</option>
                                <option value="Dingin">Dingin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Produksi Urin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="urin">
                                <option>Pilih Produksi Urin</option>
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
                                <option>Pilih Hasil</option>
                                <option value="Tanpa Dehidrasi">Tanpa Dehidrasi</option>
                                <option value="Dehidrasi Ringan">Dehidrasi Ringan</option>
                                <option value="Dehidrasi Sedang">Dehidrasi Sedang</option>
                                <option value="Dehidrasi Berat">Dehidrasi Berat</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="Kirim" class="btn btn-outline-primary">Tambah</button>
                    </div>
                </form>
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