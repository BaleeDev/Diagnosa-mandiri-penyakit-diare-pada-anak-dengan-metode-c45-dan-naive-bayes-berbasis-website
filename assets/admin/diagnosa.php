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

    $tgl = date("Y-m-d");
    $jam = date("H:i:s");
    $vid = "P" . $tgl . $jam;
    $vTampungAtribut = [];
    $vTTanpaDehidrasi;
    $vTDehidrasiRingan;
    $vTDehidrasiSedang;
    $vTDehidrasiBerat;
    // membuat fungsi untuk menampung atribut
    function tampilAtribut()
    {
        global $koneksi;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_atribut ");
        return $tampil;
    }

    // membuat function hitung total data
    function hitungTotalData($hasil)
    {
        global $koneksi;
        if ($hasil == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training");
        } elseif ($hasil == "Tanpa Dehidrasi") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil ='Tanpa Dehidrasi' ");
        } elseif ($hasil == "Dehidrasi Ringan") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil ='Dehidrasi Ringan' ");
        } elseif ($hasil == "Dehidrasi Sedang") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil ='Dehidrasi Sedang' ");
        } elseif ($hasil == "Dehidrasi Berat") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil ='Dehidrasi Berat' ");
        }
        $jumlah_data = mysqli_num_rows($data);
        return $jumlah_data;
    }
    // hitung probailitas class 
    function hitungProbabilitasClass($NamaAtribut, $NamaClass, $hasil)
    {
        global $koneksi;
        if ($hasil == "Tanpa Dehidrasi" || $hasil == "Dehidrasi Ringan" || $hasil == "Dehidrasi Sedang" || $hasil == "Dehidrasi Berat") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $NamaAtribut ='$NamaClass' && Hasil ='$hasil' ");
        }
        $jumlah_data = mysqli_num_rows($data);
        return $jumlah_data;
    }
    // membuat fungsi untuk melakukan testing data
    function cekRules($JK, $U, $SM, $DH, $FDJ, $KDN, $Per, $Pal, $AM, $MDL, $T, $CRT, $E, $PU)
    {
        $a = 0;
        $tampilAtribut = tampilAtribut();
        if ($tampilAtribut) {
            if (mysqli_num_rows($tampilAtribut) > 0) {
                while ($row = mysqli_fetch_array($tampilAtribut)) {
                    $vTampungAtribut[$a] = $row['Nama_atribut'];
                    $a++;
                }
            }
        }

        $aTampungTesting[0] = $JK;
        $aTampungTesting[1] = $U;
        $aTampungTesting[2] = $SM;
        $aTampungTesting[3] = $DH;
        $aTampungTesting[4] = $FDJ;
        $aTampungTesting[5] = $KDN;
        $aTampungTesting[6] = $Per;
        $aTampungTesting[7] = $Pal;
        $aTampungTesting[8] = $AM;
        $aTampungTesting[9] = $MDL;
        $aTampungTesting[10] = $T;
        $aTampungTesting[11] = $CRT;
        $aTampungTesting[12] = $E;
        $aTampungTesting[13] = $PU;

        $vTotal = hitungTotalData("");
        $vTanpaDehidrasi = hitungTotalData("Tanpa Dehidrasi");
        $vDehidrasiRingan = hitungTotalData("Dehidrasi Ringan");
        $vDehidrasiSedang = hitungTotalData("Dehidrasi Sedang");
        $vDehidrasiBerat = hitungTotalData("Dehidrasi Berat");

        // menghitung nilai jumlah Tanpa Dehidrasi, Dehidrasi Ringan, Dehidrasi sedang dan Dehidrasi Berat
        $vTTanpaDehidrasi = round($vTanpaDehidrasi / $vTotal, 1);
        $vTDehidrasiRingan = round($vDehidrasiRingan / $vTotal, 1);
        $vTDehidrasiSedang = round($vDehidrasiSedang / $vTotal, 1);
        $vTDehidrasiBerat = round($vDehidrasiBerat / $vTotal, 1);

        $vCekTanpaDehidrasi = 0;
        $vCekDehidrasiRingan = 0;
        $vCekDehidrasiSedang = 0;
        $vCekDehidrasiBerat = 0;
        $vaTanpaDehidrasi = [];
        $vaDehidrasiRingan = [];
        $vaDehidrasiSedang = [];
        $vaDehidrasiBerat = [];

        for ($i = 0; $i <= 13; $i++) {
            $vnPTanpaDehidrasi = hitungProbabilitasClass($vTampungAtribut[$i], $aTampungTesting[$i], 'Tanpa Dehidrasi');
            $vnPDehidrasiRingan = hitungProbabilitasClass($vTampungAtribut[$i], $aTampungTesting[$i], 'Dehidrasi Ringan');
            $vnPDehidrasiSedang = hitungProbabilitasClass($vTampungAtribut[$i], $aTampungTesting[$i], 'Dehidrasi Sedang');
            $vnPDehidrasiBerat = hitungProbabilitasClass($vTampungAtribut[$i], $aTampungTesting[$i], 'Dehidrasi Berat');
            // cek apakah jumlahnya tidak sama dengan 0
            // untuk tanpa Dehidrasi
            if ($vnPTanpaDehidrasi == "0") {
                if ($vCekTanpaDehidrasi == "0") {
                    $vCekTanpaDehidrasi = 1;
                } elseif ($vCekTanpaDehidrasi == "1") {
                    $vCekTanpaDehidrasi = $vCekTanpaDehidrasi;
                }
                $vaTanpaDehidrasi[$i] = 0;
                // $vhitungTD[$i] = round($vnPTanpaDehidrasi / $vTanpaDehidrasi, 1);
            } elseif ($vnPTanpaDehidrasi != "0") {
                $vaTanpaDehidrasi[$i] = $vnPTanpaDehidrasi;
            }
            // untuk dehidrasi ringan
            if ($vnPDehidrasiRingan == "0") {
                if ($vCekDehidrasiRingan == "0") {
                    $vCekDehidrasiRingan = 1;
                } elseif ($vCekDehidrasiRingan == "1") {
                    $vCekDehidrasiRingan = $vCekDehidrasiRingan;
                }
                $vaDehidrasiRingan[$i] = 0;
                // $vhitungTR[$i] = round($vnPDehidrasiRingan / $vDehidrasiRingan, 1);
            } elseif ($vnPDehidrasiRingan != "0") {
                $vaDehidrasiRingan[$i] = $vnPDehidrasiRingan;
            }
            // untuk dehidrai sedang
            if ($vnPDehidrasiSedang == "0") {

                if ($vCekDehidrasiSedang == "0") {
                    $vCekDehidrasiSedang = 1;
                } elseif ($vCekDehidrasiSedang == "1") {
                    $vCekDehidrasiSedang = $vCekDehidrasiSedang;
                }
                $vaDehidrasiSedang[$i] = 0;
                // $vhitungTS[$i] = round($vnPDehidrasiSedang / $vDehidrasiSedang, 3);
            } elseif ($vnPDehidrasiSedang != "0") {
                $vaDehidrasiSedang[$i] = $vnPDehidrasiSedang;
            }
            // untuk dehidrari berat
            if ($vnPDehidrasiBerat == "0") {
                if ($vCekDehidrasiBerat == "0") {
                    $vCekDehidrasiBerat = 1;
                } elseif ($vCekDehidrasiBerat == "1") {
                    $vCekDehidrasiBerat = $vCekDehidrasiBerat;
                }
                $vaDehidrasiBerat[$i] = 0;
                // $vhitungTB[$i] = round($vnPDehidrasiBerat / $vDehidrasiBerat, 3);
            } elseif ($vnPDehidrasiBerat != "0") {
                $vaDehidrasiBerat[$i] = $vnPDehidrasiBerat;
            }

            if ($i == "13") {
                // untuk tanpa dehidrasi
                if ($vCekTanpaDehidrasi != "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        $vaTanpaDehidrasi[$j] += 1;
                        $vTanpaDehidrasi += $vTanpaDehidrasi;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTD[$j] = round($vaTanpaDehidrasi[$j] / $vTanpaDehidrasi, 3);
                        // echo $j . ". " . $vhitungTS[$j] . "<br>";
                        $vTanpaDehidrasi = hitungTotalData("Tanpa Dehidrasi");
                    }
                } elseif ($vCekTanpaDehidrasi == "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        // $vaDehidrasiSedang[$j] += 1;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTD[$j] = round($vaTanpaDehidrasi[$j] / $vTanpaDehidrasi, 3);
                        // echo $j . ". " . $vhitungTS[$j] . "<br>";
                    }
                }
                // end
                // untuk dehidrasi ringan
                if ($vCekDehidrasiRingan != "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiRingan[$j] . "<br>";
                        $vaDehidrasiRingan[$j] += 1;
                        $vDehidrasiRingan += $vDehidrasiRingan;
                        // echo $j . ". tambah :  " . $vaDehidrasiRingan[$j] . "<br>";
                        $vhitungTR[$j] = round($vaDehidrasiRingan[$j] / $vDehidrasiRingan, 3);
                        // echo $vNomor . ". " . $vhitungTR[$j] . "<br>";
                        $vDehidrasiRingan = hitungTotalData("Dehidrasi Ringan");
                    }
                } elseif ($vCekDehidrasiRingan == "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        // $vaDehidrasiSedang[$j] += 1;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTR[$j] = round($vaDehidrasiRingan[$j] / $vDehidrasiRingan, 3);
                        // echo $j . ". " . $vhitungTS[$j] . "<br>";
                    }
                }
                // end
                // untuk dehidrasi sedang
                if ($vCekDehidrasiSedang != "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        $vaDehidrasiSedang[$j] += 1;
                        $vDehidrasiSedang += $vDehidrasiSedang;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTS[$j] = round($vaDehidrasiSedang[$j] / $vDehidrasiSedang, 3);
                        // echo $j . ". " . $vDehidrasiSedang . "<br>";
                        // echo $vNomor . ". " . $vhitungTS[$j] . "<br>";
                        $vDehidrasiSedang = hitungTotalData("Dehidrasi Sedang");
                    }
                } elseif ($vCekDehidrasiSedang == "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        // $vaDehidrasiSedang[$j] += 1;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTS[$j] = round($vaDehidrasiSedang[$j] / $vDehidrasiSedang, 3);
                        // echo $vNomor . ". " . $vhitungTS[$j] . "<br>";
                    }
                }
                // end
                // untuk dehidrasi berat
                if ($vCekDehidrasiBerat != "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        $vaDehidrasiBerat[$j] += 1;
                        $vDehidrasiBerat += $vDehidrasiBerat;
                        // echo $j . ". tambah :  " . $vaDehidrasiBerat[$j] . "<br>";
                        $vhitungTB[$j] = round($vaDehidrasiBerat[$j] / $vDehidrasiBerat, 3);
                        // echo $j . ". " . $vhitungTS[$j] . "<br>";
                        $vDehidrasiBerat = hitungTotalData("Dehidrasi Berat");
                    }
                } elseif ($vCekDehidrasiBerat == "0") {
                    for ($j = 0; $j <= 13; $j++) {
                        // echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                        // $vaDehidrasiSedang[$j] += 1;
                        // echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                        $vhitungTB[$j] = round($vaDehidrasiBerat[$j] / $vDehidrasiBerat, 3);
                        // echo $j . ". " . $vhitungTS[$j] . "<br>";
                    }
                }

                $vhasilTD =  $vhitungTD[0] * $vhitungTD[1] * $vhitungTD[2] * $vhitungTD[3] * $vhitungTD[4] * $vhitungTD[5] * $vhitungTD[6] * $vhitungTD[7] * $vhitungTD[8] * $vhitungTD[9] * $vhitungTD[10] * $vhitungTD[11] * $vhitungTD[12] * $vhitungTD[13] * $vTTanpaDehidrasi;
                $vhasilTR =  $vhitungTR[0] * $vhitungTR[1] * $vhitungTR[2] * $vhitungTR[3] * $vhitungTR[4] * $vhitungTR[5] * $vhitungTR[6] * $vhitungTR[7] * $vhitungTR[8] * $vhitungTR[9] * $vhitungTR[10] * $vhitungTR[11] * $vhitungTR[12] * $vhitungTR[13] * $vTDehidrasiRingan;
                $vhasilTS =  $vhitungTS[0] * $vhitungTS[1] * $vhitungTS[2] * $vhitungTS[3] * $vhitungTS[4] * $vhitungTS[5] * $vhitungTS[6] * $vhitungTS[7] * $vhitungTS[8] * $vhitungTS[9] * $vhitungTS[10] * $vhitungTS[11] * $vhitungTS[12] * $vhitungTS[13] * $vTDehidrasiSedang;
                $vhasilTB =  $vhitungTB[0] * $vhitungTB[1] * $vhitungTB[2] * $vhitungTB[3] * $vhitungTB[4] * $vhitungTB[5] * $vhitungTB[6] * $vhitungTB[7] * $vhitungTB[8] * $vhitungTB[9] * $vhitungTB[10] * $vhitungTB[11] * $vhitungTB[12] * $vhitungTB[13] * $vTDehidrasiBerat;
            }
        }

        // cek hasil
        if ($vhasilTD > $vhasilTR && $vhasilTD > $vhasilTS && $vhasilTD > $vhasilTB) {
            $hasil = "Tanpa Dehidrasi";
        } elseif ($vhasilTD < $vhasilTR && $vhasilTR > $vhasilTS && $vhasilTR > $vhasilTB) {
            $hasil = "Dehidrasi Ringan";
        } elseif ($vhasilTD < $vhasilTS && $vhasilTR < $vhasilTS && $vhasilTS > $vhasilTB) {
            $hasil = "Dehidrasi Sedang";
        } elseif ($vhasilTD < $vhasilTB && $vhasilTR < $vhasilTB && $vhasilTS < $vhasilTB) {
            $hasil = "Dehidrasi Berat";
        }

        return $hasil;
    }

    // jika button kirim ditekan
    if (isset($_POST['Kirim'])) {

        // cek hasil data uji
        $vHasil = cekRules($_POST['jeniskelamin'], $_POST['umur'], $_POST['statusmental'], $_POST['derajathaus'], $_POST['denyutjantung'], $_POST['denyutnadi'], $_POST['pernapasan'], $_POST['palpebra'], $_POST['airmata'], $_POST['mulutdanlidah'], $_POST['turgor'], $_POST['crt'], $_POST['ekstremitas'], $_POST['urin']);

        // menyimpan data 
        $vSimpan = mysqli_query($koneksi, "INSERT INTO tbl_uji (id,Nama_Anak,Jenis_Kelamin,Umur,Status_Mental,Derajat_Haus,Frekuensi_Denyut_Jantung,Kualitas_Denyut_Nadi,Pernapasan,Palpebra,Air_Mata,Mulut_Dan_Lidah,Turgor,Capillary_Refill_Time,Ekstremitas,Produksi_Urin,Hasil,tgl) VALUES ('$vid','$_POST[nama]','$_POST[jeniskelamin]','$_POST[umur]','$_POST[statusmental]','$_POST[derajathaus]','$_POST[denyutjantung]','$_POST[denyutnadi]','$_POST[pernapasan]','$_POST[palpebra]','$_POST[airmata]','$_POST[mulutdanlidah]','$_POST[turgor]','$_POST[crt]','$_POST[ekstremitas]','$_POST[urin]','$vHasil','$tgl')");

        if ($vSimpan) {
            echo "<script>
        document.location='data_hasil.php';
        </script>";
        } else {
            echo "<script>
        document.location='diagnosa.php';
        </script>";
        }
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Diagnosa Mandiri Penyakit Diare Pada Anak</h6>
            </div>
            <div class="container mt-2">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10 mb-3 mb-sm-0">
                            <input type="text" name="nama" value="<?= @$vNamaPengguna ?>" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Pengguna">
                        </div>
                    </div>
                    <div class="form-group row mb-3 mt-2 ">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10 ">
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
                    <div class="text-center">
                        <button type="submit" name="Kirim" class="btn btn-outline-primary">Diagnosa</button>
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