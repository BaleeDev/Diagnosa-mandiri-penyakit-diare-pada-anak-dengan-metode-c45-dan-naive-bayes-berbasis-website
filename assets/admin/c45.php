<?php
// membuka sesi baru
@session_start();
// memanggil file koneksi ke database
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

    $NOD = 1;
    $vTampungNamaAtribut = [];
    $vTampungNamaClass = [];
    $vTampungIdGain = [];
    $vTampungGain = [];
    $tampungEntrhopy = [];
    $tampungTanpaDehidrasi = [];
    $tampungDehidrasiRingan = [];
    $tampungDehidrasiSedang = [];
    $tampungDehidrasiBerat = [];
    $vTampungSesuai = 0;
    $vTampungTidakSesuai = 0;
    $datatraining = 0;
    $vtdata = 0;
    //membuat fungsi untuk menampilkan data trainig
    function tampilData($limit, $urut, $NamaAtribut1, $NamaClass1, $NamaAtribut2, $NamaClass2)
    {
        global $koneksi;
        if ($limit != "" && $urut == "" && $NamaAtribut1 == "" && $NamaClass1 == "" && $NamaAtribut2 == "" && $NamaClass2 == "") {
            $tampil = mysqli_query($koneksi, "SELECT * FROM `tbl_semua_data` ORDER BY id ASC LIMIT $limit");
        } elseif ($urut != "" && $limit != "" && $NamaAtribut1 == "" && $NamaClass1 == "" && $NamaAtribut2 == "" && $NamaClass2 == "") {
            $tampil = mysqli_query($koneksi, "SELECT * FROM `tbl_semua_data` ORDER BY id DESC LIMIT $limit");
        } elseif ($NamaAtribut1 != "" && $NamaAtribut2 != "") {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $NamaAtribut1 ='$NamaClass1' && $NamaAtribut2='$NamaClass2'");
        } else {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $NamaAtribut1 ='$NamaClass1'");
        }
        return $tampil;
    }
    //membuat fungsi untuk menampilkan data atribut
    function tampilDataAtribut($NamaAtribut1, $NamaAtribut2)
    {
        global $koneksi;
        if ($NamaAtribut1 == "") {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_atribut WHERE Nama_atribut != 'Jenis_Kelamin' && Nama_atribut != 'Umur'");
        } elseif ($NamaAtribut1 != "" && $NamaAtribut2 != "") {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_atribut WHERE Nama_atribut != 'Jenis_Kelamin' && Nama_atribut != 'Umur' && Nama_atribut != '$NamaAtribut1' && Nama_atribut != '$NamaAtribut2'");
        } else {
            $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_atribut WHERE Nama_atribut != 'Jenis_Kelamin' && Nama_atribut != 'Umur' && Nama_atribut != '$NamaAtribut1'");
        }
        return $tampil;
    }
    // mebuat fungsi untuk menghitung jumlah data training
    function hitungDataTraining($hasil)
    {
        global $koneksi;
        if ($hasil == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training");
        } elseif ($hasil == "Tanpa Dehidrasi") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil='Tanpa Dehidrasi'");
        } elseif ($hasil == "Dehidrasi Ringan") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil='Dehidrasi Ringan'");
        } elseif ($hasil == "Dehidrasi Sedang") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil='Dehidrasi Sedang'");
        } elseif ($hasil == "Dehidrasi Berat") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE Hasil='Dehidrasi Berat'");
        }
        $jumlah_data = mysqli_num_rows($data);
        return $jumlah_data;
    }
    // membuat fungsi untuk menghitung entrhopy
    function hitungEntrhopy($NamaClass, $NOD, $NamaAtributs)
    {
        global $koneksi;
        // menampilkan jumlah berdasarkan nama class
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_c45 WHERE Nama_Class ='$NamaClass' && NOD='$NOD' && Nama_atribut ='$NamaAtributs'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // tampung data kedalam variabel
            $vJumlahAllData = $data['Jumlah'];
            $vTanpaDehidrasi = $data['Tanpa_Dehidrasi'];
            $vDehidrasiRingan = $data['Dehidrasi_Ringan'];
            $vDehidrasiSedang = $data['Dehidrasi_Sedang'];
            $vDehidrasiBerat = $data['Dehidrasi_Berat'];
        }


        if ($vTanpaDehidrasi == 0) {
            if ($vDehidrasiRingan == 0) {
                if ($vDehidrasiSedang == 0) {
                    $entrhopy = 0;
                } elseif ($vDehidrasiBerat == 0) {
                    $entrhopy = 0;
                } else {
                    // rumus
                    $entrhopy = ((-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
                }
            } elseif ($vDehidrasiSedang == 0) {
                if ($vDehidrasiBerat == 0) {
                    $entrhopy = 0;
                } else {
                    $entrhopy = ((-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
                }
            } elseif ($vDehidrasiBerat == 0) {
                $entrhopy = ((-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2));
            } else {
                // rumus
                $entrhopy = ((-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
            }
        } elseif ($vDehidrasiRingan == 0) {
            if ($vDehidrasiSedang == 0) {
                if ($vDehidrasiBerat == 0) {
                    $entrhopy = 0;
                } else {
                    $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
                }
            } elseif ($vDehidrasiBerat == 0) {
                $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2));
            } else {
                // rumus
                $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
            }
        } elseif ($vDehidrasiSedang == 0) {
            if ($vDehidrasiBerat == 0) {
                // rumus
                $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2));
            } else {
                // rumus
                $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
            }
        } elseif ($vDehidrasiBerat == 0) {
            // rumus
            $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2));
        } else {
            // rumus
            $entrhopy = ((-$vTanpaDehidrasi / $vJumlahAllData) * log($vTanpaDehidrasi / $vJumlahAllData, 2) + (-$vDehidrasiRingan / $vJumlahAllData) * log($vDehidrasiRingan / $vJumlahAllData, 2) + (-$vDehidrasiSedang / $vJumlahAllData) * log($vDehidrasiSedang / $vJumlahAllData, 2) + (-$vDehidrasiBerat / $vJumlahAllData) * log($vDehidrasiBerat / $vJumlahAllData, 2));
        }

        return $entrhopy;
    }
    // membuat fungsi untuk menampilkan data class
    function tampilDataClass($idAtribut)
    {
        global $koneksi;
        $data = mysqli_query($koneksi, "SELECT*FROM tbl_class WHERE id_atribut = '$idAtribut'");
        return $data;
    }
    // membuat fungsi untuk menghitung jumlah Data setiap Class
    function hitungDataClass($Atribut1, $NamaClass1, $Hasil, $Atribut2, $Class2, $Atribut3, $Class3)
    {
        global $koneksi;
        if ($Atribut2 == "" && $Atribut3 == "" && $Hasil == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' ");
        } elseif ($Atribut2 != "" && $Class2 != "" && $Atribut3 == "" && $Hasil == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' && $Atribut2 = '$Class2' ");
        } elseif ($Atribut2 != "" && $Atribut3 != "" && $Hasil == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' && $Atribut2 = '$Class2' && $Atribut3 = '$Class3' ");
        } elseif ($Atribut2 == "" && $Atribut3 == "") {
            if ($Hasil == "Tanpa Dehidrasi" || $Hasil == "Dehidrasi Ringan" || $Hasil == "Dehidrasi Sedang" || $Hasil == "Dehidrasi Berat") {
                $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' && Hasil = '$Hasil' ");
            }
        } elseif ($Atribut2 != "" && $Atribut3 == "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' && $Atribut2 = '$Class2' && Hasil = '$Hasil' ");
        } elseif ($Atribut1 != "" && $Atribut2 != "" && $Atribut3 != "") {
            $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $Atribut1 = '$NamaClass1' && $Atribut2 = '$Class2' && $Atribut3 = '$Class3' && Hasil = '$Hasil' ");
        }
        $jumlah_data = mysqli_num_rows($data);
        return $jumlah_data;
    }
    // simpan data perhitungan kedalam tabel c45
    function simpanDataC45($NOD, $vNamaAtribut, $vNamaClass, $vJumlahAllData, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat)
    {
        global $koneksi;

        $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_c45` (`id`, `NOD`, `Nama_atribut`, `Nama_Class`, `Jumlah`, `Tanpa_Dehidrasi`, `Dehidrasi_Ringan`, `Dehidrasi_Sedang`, `Dehidrasi_Berat`, `Entrhopy`) VALUES (NULL, '$NOD', '$vNamaAtribut', '$vNamaClass','$vJumlahAllData','$vJumlahDataTanpaDehidrasi','$vJumlahDataDehidrasiRingan','$vJumlahDataDehidrasiSedang','$vJumlahDataDehidrasiBerat','0')");

        return $simpan;
    }
    // tampilkan data pada tabel c45 dan return id
    function tampilC45($NOD, $NamaAtribut, $NamaClass)
    {
        global $koneksi;
        // menampilkan id berdasarkan NOD Nama Atribut dan nama class
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_c45 WHERE Nama_Class ='$NamaClass' && NOD='$NOD' && Nama_atribut ='$NamaAtribut'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // tampung data kedalam variabel
            $vId = $data['id'];
        }

        return $vId;
    }
    // update data tabel c45
    function updateDataC45($Entrhopy, $ID)
    {
        global $koneksi;
        $edit = mysqli_query($koneksi, "UPDATE tbl_c45 set Entrhopy = '$Entrhopy' WHERE id='$ID' ");
        return $edit;
    }
    // membuat fungsi untuk menghitung nilai gain
    function hitungGain($JumlahAll, $EntrhopyAll, $NOD, $NamaAtribut)
    {
        global $koneksi;
        $aJumlahClass = [];
        $aEntrhopyClass = [];
        $i = 1;
        // menampilkan nilai jumlah setiap class berdasarkan Nama Atribut
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_c45 WHERE NOD = '$NOD' && Nama_atribut = '$NamaAtribut'");
        if (mysqli_num_rows($tampil)) {
            while ($data = mysqli_fetch_array($tampil)) {
                $aJumlahClass[$i] = $data['Jumlah'];
                $aEntrhopyClass[$i] = $data['Entrhopy'];
                $i++;
            }
        }
        if ($i == 1) {
            // rumus gain
            $gain = ($EntrhopyAll) - (($aJumlahClass[1] / $JumlahAll) * $aEntrhopyClass[1]);
        } elseif ($i == 2) {
            $gain = ($EntrhopyAll) - (($aJumlahClass[1] / $JumlahAll) * $aEntrhopyClass[1]) - (($aJumlahClass[2] / $JumlahAll) * $aEntrhopyClass[2]);
        } elseif ($i == 3) {
            $gain = ($EntrhopyAll) - (($aJumlahClass[1] / $JumlahAll) * $aEntrhopyClass[1]) - (($aJumlahClass[2] / $JumlahAll) * $aEntrhopyClass[2]) - (($aJumlahClass[3] / $JumlahAll) * $aEntrhopyClass[3]);
        } elseif ($i == 4) {
            $gain = ($EntrhopyAll) - (($aJumlahClass[1] / $JumlahAll) * $aEntrhopyClass[1]) - (($aJumlahClass[2] / $JumlahAll) * $aEntrhopyClass[2]) - (($aJumlahClass[3] / $JumlahAll) * $aEntrhopyClass[3]) - (($aJumlahClass[4] / $JumlahAll) * $aEntrhopyClass[4]);
        } else {
            $gain = ($EntrhopyAll) - (($aJumlahClass[1] / $JumlahAll) * $aEntrhopyClass[1]) - (($aJumlahClass[2] / $JumlahAll) * $aEntrhopyClass[2]) - (($aJumlahClass[3] / $JumlahAll) * $aEntrhopyClass[3]) - (($aJumlahClass[4] / $JumlahAll) * $aEntrhopyClass[4]) - (($aJumlahClass[5] / $JumlahAll) * $aEntrhopyClass[5]);
        }
        return $gain;
    }
    // membuat fungsi untuk menyimpan nilai gain kedalam database tabel gain
    function simpanGain($NOD, $NamaAtribut, $Gain)
    {
        global $koneksi;

        $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_gain` (`id`, `NOD`, `Nama_atribut`, `Gain`) VALUES (NULL, '$NOD', '$NamaAtribut', '$Gain')");

        return $simpan;
    }
    // membuat fungsi untuk mengecek apakah perhitungan lanjut atau tidakdengan cara melihat nilai entrhopy != 0
    function cekEntrhopy($NOD, $NamaAtribut)
    {
        global $koneksi;
        global $vTampungNamaAtribut;
        global $vTampungNamaClass;
        $i = 1;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_c45 WHERE NOD='$NOD' && Nama_atribut='$NamaAtribut' && Entrhopy != 0");
        if (mysqli_num_rows($tampil)) {
            while ($data = mysqli_fetch_array($tampil)) {
                $vTampungNamaClass[$i] = $data['Nama_Class'];
                $vTampungNamaAtribut[$i] = $data['Nama_atribut'];

                // simpan rules
                simpanRules($NOD, $data['Nama_atribut'], $data['Nama_Class'], "Lanjut");
                $i++;
            }
        }
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_c45 WHERE NOD='$NOD' && Nama_atribut='$NamaAtribut' && Entrhopy = 0");
        if (mysqli_num_rows($tampil)) {
            while ($row = mysqli_fetch_array($tampil)) {
                $vTampungTanpaDehidrasi = $row['Tanpa_Dehidrasi'];
                $vTampungDehidrasiRingan = $row['Dehidrasi_Ringan'];
                $vTampungDehidrasiSedang = $row['Dehidrasi_Sedang'];
                $vTampungDehidrasiBerat = $row['Dehidrasi_Berat'];

                // cek nilai entrhopy dan tentukan hasilnya
                if ($vTampungTanpaDehidrasi > 0) {
                    // hasilnya Tanpa Dehidrasi
                    simpanRules($NOD, $row['Nama_atribut'], $row['Nama_Class'], "Tanpa Dehidrasi");
                } elseif ($vTampungDehidrasiRingan > 0) {
                    // hasilnya Dehidrasi Ringan
                    simpanRules($NOD, $row['Nama_atribut'], $row['Nama_Class'], "Dehidrasi Ringan");
                } elseif ($vTampungDehidrasiSedang > 0) {
                    // hasilnya Dehidrasi Sedang
                    simpanRules($NOD, $row['Nama_atribut'], $row['Nama_Class'], "Dehidrasi Sedang");
                } elseif ($vTampungDehidrasiBerat > 0) {
                    // hasilnya Dehidrasi Berat
                    simpanRules($NOD, $row['Nama_atribut'], $row['Nama_Class'], "Dehidrasi Berat");
                }
            }
        }
        return $i;
    }
    // membuat fungsi mencari nilai max gain dan menampilkan data bedasarkan nilai gain tertinggi
    function maxGain($NOD)
    {
        global $koneksi;
        global $vTampungGain;
        $i = 1;
        // cari nilai gain berdasarkan NOD 
        $tampil = mysqli_query($koneksi, "SELECT * FROM `tbl_gain` WHERE NOD = '$NOD'");
        if (mysqli_num_rows($tampil)) {
            while ($data = mysqli_fetch_array($tampil)) {
                $vTampungGain[$i] = $data['Gain'];
                $i++;
            }
        }
        // mencari nilai max gain
        $maxGain = max($vTampungGain);
        // menampilkan NOD, Nama Atribtu dari max gain
        $tampilmax = mysqli_query($koneksi, "SELECT * FROM `tbl_gain` WHERE NOD = '$NOD' && Gain='$maxGain'");
        $data = mysqli_fetch_array($tampilmax);
        if ($data) {
            $vNOD = $data['NOD'];
            $vNamaAtribut = $data['Nama_atribut'];
        }
        $vCek = cekEntrhopy($vNOD, $vNamaAtribut);
        return $vCek;
    }
    // simpan rules
    function simpanRules($NOD, $NamaAtribut, $NamaClass, $Hasil)
    {
        global $koneksi;

        $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_rules` (`id`, `NOD`, `Nama_atribut`, `Nama_Class`, `Hasil`) VALUES (NULL,'$NOD', '$NamaAtribut', '$NamaClass', '$Hasil')");

        return $simpan;
    }
    // tree
    function treeC45($NOD)
    {
        global $koneksi;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_rules WHERE NOD='$NOD'");
        return $tampil;
    }
    // tampil data training
    function tampilDataTraining()
    {
        global $koneksi;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_testing");
        return $tampil;
    }
    // membuat fungsi untuk melakukan testing data
    function cekRules($DerajatHaus, $KualitasDenyutNadi, $Palpebra, $FrekuensiDenyutJantung, $StatusMental)
    {
        if ($DerajatHaus == "Minum Normal") {
            if ($KualitasDenyutNadi == "Normal") {
                $Hasil = "Tanpa Dehidrasi";
            } elseif ($KualitasDenyutNadi == "Menurun") {
                $Hasil = "Tanpa Dehidrasi";
            } elseif ($KualitasDenyutNadi == "Lemah") {
                $Hasil = "Dehidrasi Ringan";
            }
        } elseif ($DerajatHaus == "Tampak Kehausan") {
            if ($Palpebra == "Sedikit Cekung") {
                if ($FrekuensiDenyutJantung == "Normal") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($FrekuensiDenyutJantung == "Meningkat") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($FrekuensiDenyutJantung == "Takikardia") {
                    $Hasil = "Dehidrasi Ringan";
                }
            } elseif ($Palpebra == "Normal") {
                $Hasil = "Dehidrasi Ringan";
            } elseif ($Palpebra == "Sangat Cekung") {
                $Hasil = "Dehidrasi Berat";
            }
        } elseif ($DerajatHaus == "Rasa Haus Berkurang") {
            if ($FrekuensiDenyutJantung == "Takikardia") {
                $Hasil = "Dehidrasi Berat";
            } elseif ($FrekuensiDenyutJantung == "Meningkat") {
                if ($StatusMental == "Gelisah") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($StatusMental == "Apatis") {
                    $Hasil = "Dehidrasi Berat";
                }
            }
        }
        return $Hasil;
    }
    // membuat fungsi untuk melakukan testing data
    function cekRules1($DerajatHaus, $Palpebra, $FrekuensiDenyutJantung, $KualitasDenyutNadi, $StatusMental)
    {
        if ($DerajatHaus == "Minum Normal") {
            if ($Palpebra == "Normal") {
                $Hasil = "Tanpa Dehidrasi";
            } elseif ($Palpebra == "Sedikit Cekung") {
                $Hasil = "Dehidrasi Ringan";
            }
        } elseif ($DerajatHaus == "Tampak Kehausan") {
            if ($Palpebra == "Sedikit Cekung") {
                if ($FrekuensiDenyutJantung == "Normal") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($FrekuensiDenyutJantung == "Meningkat") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($FrekuensiDenyutJantung == "Takikardia") {
                    $Hasil = "Dehidrasi Ringan";
                }
            } elseif ($Palpebra == "Normal") {
                $Hasil = "Dehidrasi Ringan";
            } elseif ($Palpebra == "Sangat Cekung") {
                $Hasil = "Dehidrasi Berat";
            }
        } elseif ($DerajatHaus == "Rasa Haus Berkurang") {
            if ($KualitasDenyutNadi == "Lemah") {
                $Hasil = "Dehidrasi Berat";
            } elseif ($KualitasDenyutNadi == "Menurun") {
                if ($StatusMental == "Gelisah") {
                    $Hasil = "Dehidrasi Sedang";
                } elseif ($StatusMental == "Apatis") {
                    $Hasil = "Dehidrasi Berat";
                }
            }
        }
        return $Hasil;
    }
    // membuat fungsi untuk hapus data
    function hapusData()
    {
        global $koneksi;
        $tampilC45 = mysqli_query($koneksi, "SELECT*FROM tbl_c45 ");
        if ($tampilC45) {
            if (mysqli_num_rows($tampilC45) > 0) {
                while ($rowC45 = mysqli_fetch_array($tampilC45)) {
                    $id = $rowC45['id'];
                    $hapusC45 = mysqli_query($koneksi, "DELETE FROM tbl_c45 WHERE `tbl_c45`.`id` = '$id'");
                }
            }
        }
        $tampilGain = mysqli_query($koneksi, "SELECT*FROM tbl_gain ");
        if ($tampilGain) {
            if (mysqli_num_rows($tampilGain) > 0) {
                while ($rowGain = mysqli_fetch_array($tampilGain)) {
                    $id = $rowGain['id'];
                    $hapusGain = mysqli_query($koneksi, "DELETE FROM tbl_gain WHERE `tbl_gain`.`id` = '$id'");
                }
            }
        }
        $tampilRules = mysqli_query($koneksi, "SELECT*FROM tbl_rules ");
        if ($tampilRules) {
            if (mysqli_num_rows($tampilRules) > 0) {
                while ($rowRules = mysqli_fetch_array($tampilRules)) {
                    $id = $rowRules['id'];
                    $hapusRules = mysqli_query($koneksi, "DELETE FROM tbl_rules WHERE `tbl_rules`.`id` = '$id'");
                }
            }
        }
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_testing ");
        if ($tampil) {
            if (mysqli_num_rows($tampil) > 0) {
                while ($row = mysqli_fetch_array($tampil)) {
                    $id = $row['id_testing'];
                    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_testing WHERE `tbl_testing`.`id_testing` = '$id'");
                }
            }
        }
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_training ");
        if ($tampil) {
            if (mysqli_num_rows($tampil) > 0) {
                while ($row = mysqli_fetch_array($tampil)) {
                    $id = $row['id_data'];
                    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_training WHERE `tbl_training`.`id_data` = '$id'");
                }
            }
        }
    }
    // membuat function untuk menyimpan data testing
    function simpanDataTesting($limit)
    {
        global $koneksi;
        $tampil = tampilData($limit, "urut", "", "", "", "");
        if ($tampil) {
            if (mysqli_num_rows($tampil) > 0) {
                while ($row = mysqli_fetch_array($tampil)) {
                    // simpan data kedalam data training
                    $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_testing` (`id_testing`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES (NULL, '$row[Jenis_Kelamin]', '$row[Umur]', '$row[Status_Mental]', '$row[Derajat_Haus]', '$row[Frekuensi_Denyut_Jantung]', '$row[Kualitas_Denyut_Nadi]', '$row[Pernapasan]', '$row[Palpebra]', '$row[Air_Mata]', '$row[Mulut_Dan_Lidah]', '$row[Turgor]', '$row[Capillary_Refill_Time]', '$row[Ekstremitas]', '$row[Produksi_Urin]', '$row[Hasil]')");
                }
            }
        }
        return $simpan;
    }
    // if (isset($_POST['Perhitungan'])) {
    //     hapusData();
    // }

    include 'Layout/header.php';
?>


    <!-- menampilkan data training -->
    <div class="container mt-5">
        <!-- mebuat tabel -->
        <h2>Data Training</h2>
        <?php
        $isidata = 67;
        $datatraining = 60;
        hapusData();
        simpanDataTesting($datatraining);
        ?>
        <div class="card-body table-responsive p-0" style="height: 450px;">
            <table class="table table-responsive table-head-fixed text-nowrap">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">NO</th>


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
                    // echo "isi Data = " . $isidata;

                    $tampil = tampilData($isidata, "", "", "", "", "");
                    // cek apakah ada data pada database tbl_training
                    if ($tampil) {
                        if (mysqli_num_rows($tampil) > 0) {
                            // lakukan perulangan selama data pada database tbl_data ada
                            while ($row = mysqli_fetch_array($tampil)) {
                                // simpan data kedalam data training
                                $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_training` (`id_data`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES (NULL, '$row[Jenis_Kelamin]', '$row[Umur]', '$row[Status_Mental]', '$row[Derajat_Haus]', '$row[Frekuensi_Denyut_Jantung]', '$row[Kualitas_Denyut_Nadi]', '$row[Pernapasan]', '$row[Palpebra]', '$row[Air_Mata]', '$row[Mulut_Dan_Lidah]', '$row[Turgor]', '$row[Capillary_Refill_Time]', '$row[Ekstremitas]', '$row[Produksi_Urin]', '$row[Hasil]')");
                    ?>
                                <tr>
                                    <th scope="row"><?= $nomor++ ?></th>



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
            <!-- end tabel -->
        </div>
        <div class="text-center mt-5 mb-3">
            <form action="#" method="post">
                <button type="submit" name="Perhitungan" class="btn btn-outline-primary">Perhitungan C4.5</button>
            </form>
        </div>
    </div>
    <!-- end menampilkan data -->
    <?php
    if (isset($_POST['Perhitungan'])) {
    ?>
        <!-- membuat tabel perhitungan C4.5 -->
        <div class="container mt-3">
            <h2>Tabel Perhitungan Metode C4.5</h2>
            <!-- membuat tabel perhitungan C4.5 -->
            <div class="card-body table-responsive p-0" style="height: 450px;">
                <table class="table table-responsive table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Jumlah (s)</th>
                            <th scope="col">Tanpa Dehidrasi</th>
                            <th scope="col">Dehidrasi Ringan</th>
                            <th scope="col">Dehidrasi Sedang</th>
                            <th scope="col">Dehidrasi Berat</th>
                            <th scope="col">Entrhopy</th>
                            <th scope="col">Gain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- perhitungan NOD1-->
                        <?php
                        $vJumlahAllData = hitungDataTraining("");
                        $vJumlahDataTanpaDehidrasi = hitungDataTraining("Tanpa Dehidrasi");
                        $vJumlahDataDehidrasiRingan = hitungDataTraining("Dehidrasi Ringan");
                        $vJumlahDataDehidrasiSedang = hitungDataTraining("Dehidrasi Sedang");
                        $vJumlahDataDehidrasiBerat = hitungDataTraining("Dehidrasi Berat");

                        // simpan hasil perhitungan kedalam database entrhopy
                        simpanDataC45($NOD, "Total", "All Total", $vJumlahAllData, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);


                        $vEntrhopyAll = hitungEntrhopy("All Total", $NOD, "Total");

                        // panggil fungsi tampil c45
                        $ID = tampilC45($NOD, "Total", "All Total");

                        // update tabel c45
                        updateDataC45($vEntrhopyAll, $ID);
                        ?>
                        <!-- end perhitungan -->
                        <tr>
                            <td scope="row">Total</td>
                            <td></td>
                            <td><?php echo $vJumlahAllData; ?></td>
                            <td><?php echo $vJumlahDataTanpaDehidrasi; ?></td>
                            <td><?php echo $vJumlahDataDehidrasiRingan; ?></td>
                            <td><?php echo $vJumlahDataDehidrasiSedang; ?></td>
                            <td><?php echo $vJumlahDataDehidrasiBerat; ?></td>
                            <td><?php echo round($vEntrhopyAll, 8); ?></td>
                            <td></td>
                        </tr>
                        <!-- memanggil fungsi tampildataatribut -->
                        <?php
                        $Entrhopy = 0;
                        $vTampilDataAtribut = tampilDataAtribut("", "");
                        if (mysqli_num_rows($vTampilDataAtribut)) {
                            while ($dAtribut = mysqli_fetch_array($vTampilDataAtribut)) {
                                // tampung id atribut, nama atribut
                                $vIdAtribut = $dAtribut['id_atribut'];
                                $vNamaAtribut = $dAtribut['Nama_atribut'];
                                // memanggil fungsi tampil class dengan parameter id atribut
                                $vTampilDataClass = tampilDataClass($vIdAtribut);
                                // hitung jumlah data yang ada pada tbl_class berdasarkan id atribut
                                $vBanyakData = mysqli_num_rows($vTampilDataClass);
                        ?>
                                <tr>
                                    <td rowspan="<?= $vBanyakData ?>"><?php echo $vNamaAtribut ?></td>
                                    <?php
                                    if (mysqli_num_rows($vTampilDataClass)) {
                                        while ($dClass = mysqli_fetch_array($vTampilDataClass)) {
                                            // tampung nama class
                                            $vNamaClass = $dClass['Nama_Class'];
                                            // panggil fungsi hitung jumlah data class
                                            $vJumlahAllDataClass = hitungDataClass($vNamaAtribut, $vNamaClass, "", "", "", "", "");
                                            $vJumlahDataTanpaDehidrasi = hitungDataClass($vNamaAtribut, $vNamaClass, "Tanpa Dehidrasi", "", "", "", "");
                                            $vJumlahDataDehidrasiRingan = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Ringan", "", "", "", "");
                                            $vJumlahDataDehidrasiSedang = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Sedang", "", "", "", "");
                                            $vJumlahDataDehidrasiBerat = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Berat", "", "", "", "");

                                            // simpan data kedalam database tabel c45
                                            simpanDataC45($NOD, $vNamaAtribut, $vNamaClass, $vJumlahAllDataClass, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);

                                            // hitung entrhopy
                                            $vEntrhopyClass = hitungEntrhopy($vNamaClass, $NOD, $vNamaAtribut);

                                            // panggil fungsi tampil c45
                                            $ID = tampilC45($NOD, $vNamaAtribut, $vNamaClass);

                                            // update tabel c45
                                            updateDataC45($vEntrhopyClass, $ID);
                                    ?>
                                            <td><?php echo $dClass['Nama_Class'] ?></td>
                                            <td><?= $vJumlahAllDataClass ?></td>
                                            <td><?= $vJumlahDataTanpaDehidrasi ?></td>
                                            <td><?= $vJumlahDataDehidrasiRingan ?></td>
                                            <td><?= $vJumlahDataDehidrasiSedang ?></td>
                                            <td><?= $vJumlahDataDehidrasiBerat ?></td>
                                            <td><?= round($vEntrhopyClass, 8) ?></td>
                                </tr>
                        <?php
                                        }
                                    }
                                    //    memanggil fungsi perhitungan gain
                                    $vGain = hitungGain($vJumlahAllData, $vEntrhopyAll, $NOD, $vNamaAtribut);
                                    // memanggil fungsi untuk menyimpan nilai gain kedalam database
                                    simpanGain($NOD, $vNamaAtribut, $vGain);
                        ?>
                        <tr>
                            <td colspan="9" class="text-right"><?= round($vGain, 6) ?></td>
                        </tr>
                <?php
                            }
                        }
                ?>
                <!-- end fungsi -->
                    </tbody>
                </table>
            </div>
            <!-- end tabel perhitungan C4.5 -->
        </div>
        <!-- end perhitungan C4.5 -->

        <!-- melakukan perhitungangain dengan perulangan sesuai dari nilai gain tertinggi -->
        <?php
        $vCek = maxGain($NOD);
        for ($a = 1; $a < $vCek; $a++) {
            $NOD = $a + 1;
        ?>
            <!-- tabel -->
            <div class="container mt-3">
                <h2>Tabel NOD <?= $a + 1 ?></h2>
                <p>Tabel dibawah ini Dengan Nama Atribut <?= $vTampungNamaAtribut[$a] ?> Dan Nama Class <i><?= $vTampungNamaClass[$a] ?></i></p>
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    <table class="table table-responsive table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
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
                            $tampil = tampilData("", "", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");
                            // cek apakah ada data pada database tbl_data
                            if ($tampil) {
                                if (mysqli_num_rows($tampil) > 0) {
                                    // lakukan perulangan selama data pada database tbl_data ada
                                    while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                        <tr>
                                            <th scope="row"><?= $nomor++ ?></th>
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
            <!-- end tabel -->
            <!-- tabel perhitungan -->
            <div class="container mt-3">
                <h2>Tabel Perhitungan Metode C4.5 NOD <?= $a + 1 ?></h2>
                <p><i>Lanjutkan perhitungan untuk mencari entrhopy dan gain dengan cara seperti diatas</i></p>
                <!-- membuat tabel perhitungan C4.5 -->
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    <table class="table table-responsive table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Jumlah (s)</th>
                                <th scope="col">Tanpa Dehidrasi</th>
                                <th scope="col">Dehidrasi Ringan</th>
                                <th scope="col">Dehidrasi Sedang</th>
                                <th scope="col">Dehidrasi Berat</th>
                                <th scope="col">Entrhopy</th>
                                <th scope="col">Gain</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- perhitungan NOD1-->
                            <?php
                            $vJumlahAllData = hitungDataTraining("");
                            $vJumlahDataTanpaDehidrasi = hitungDataTraining("Tanpa Dehidrasi");
                            $vJumlahDataDehidrasiRingan = hitungDataTraining("Dehidrasi Ringan");
                            $vJumlahDataDehidrasiSedang = hitungDataTraining("Dehidrasi Sedang");
                            $vJumlahDataDehidrasiBerat = hitungDataTraining("Dehidrasi Berat");

                            // simpan hasil perhitungan kedalam database entrhopy
                            simpanDataC45($NOD, "Total", "All Total", $vJumlahAllData, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);


                            $vEntrhopyAll = hitungEntrhopy("All Total", $NOD, "Total");

                            // panggil fungsi tampil c45
                            $ID = tampilC45($NOD, "Total", "All Total");

                            // update tabel c45
                            updateDataC45($vEntrhopyAll, $ID);
                            ?>
                            <!-- end perhitungan -->
                            <tr>
                                <td scope="row">Total</td>
                                <td></td>
                                <td><?php echo $vJumlahAllData; ?></td>
                                <td><?php echo $vJumlahDataTanpaDehidrasi; ?></td>
                                <td><?php echo $vJumlahDataDehidrasiRingan; ?></td>
                                <td><?php echo $vJumlahDataDehidrasiSedang; ?></td>
                                <td><?php echo $vJumlahDataDehidrasiBerat; ?></td>
                                <td><?php echo round($vEntrhopyAll, 8); ?></td>
                                <td></td>
                            </tr>
                            <!-- memanggil fungsi tampildataatribut -->
                            <?php
                            $Entrhopy = 0;
                            $vTampilDataAtribut = tampilDataAtribut($vTampungNamaAtribut[$a], "");
                            if (mysqli_num_rows($vTampilDataAtribut)) {
                                while ($dAtribut = mysqli_fetch_array($vTampilDataAtribut)) {
                                    // tampung id atribut, nama atribut
                                    $vIdAtribut = $dAtribut['id_atribut'];
                                    $vNamaAtribut = $dAtribut['Nama_atribut'];
                                    // memanggil fungsi tampil class dengan parameter id atribut
                                    $vTampilDataClass = tampilDataClass($vIdAtribut);
                                    // hitung jumlah data yang ada pada tbl_class berdasarkan id atribut
                                    $vBanyakData = mysqli_num_rows($vTampilDataClass);
                            ?>
                                    <tr>
                                        <td rowspan="<?= $vBanyakData ?>"><?php echo $vNamaAtribut ?></td>
                                        <?php
                                        if (mysqli_num_rows($vTampilDataClass)) {
                                            while ($dClass = mysqli_fetch_array($vTampilDataClass)) {
                                                // tampung nama class
                                                $vNamaClass = $dClass['Nama_Class'];
                                                // panggil fungsi hitung jumlah data class
                                                $vJumlahAllDataClass = hitungDataClass($vNamaAtribut, $vNamaClass, "", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");
                                                $vJumlahDataTanpaDehidrasi = hitungDataClass($vNamaAtribut, $vNamaClass, "Tanpa Dehidrasi", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");
                                                $vJumlahDataDehidrasiRingan = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Ringan", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");
                                                $vJumlahDataDehidrasiSedang = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Sedang", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");
                                                $vJumlahDataDehidrasiBerat = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Berat", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], "", "");

                                                // simpan data kedalam database tabel c45
                                                simpanDataC45($NOD, $vNamaAtribut, $vNamaClass, $vJumlahAllDataClass, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);

                                                // hitung entrhopy
                                                $vEntrhopyClass = hitungEntrhopy($vNamaClass, $NOD, $vNamaAtribut);

                                                // panggil fungsi tampil c45
                                                $ID = tampilC45($NOD, $vNamaAtribut, $vNamaClass);

                                                // update tabel c45
                                                updateDataC45($vEntrhopyClass, $ID);
                                        ?>
                                                <td><?php echo $dClass['Nama_Class'] ?></td>
                                                <td><?= $vJumlahAllDataClass ?></td>
                                                <td><?= $vJumlahDataTanpaDehidrasi ?></td>
                                                <td><?= $vJumlahDataDehidrasiRingan ?></td>
                                                <td><?= $vJumlahDataDehidrasiSedang ?></td>
                                                <td><?= $vJumlahDataDehidrasiBerat ?></td>
                                                <td><?= round($vEntrhopyClass, 8) ?></td>
                                    </tr>
                            <?php
                                            }
                                        }
                                        //    memanggil fungsi perhitungan gain
                                        $vGain = hitungGain($vJumlahAllData, $vEntrhopyAll, $NOD, $vNamaAtribut);
                                        // memanggil fungsi untuk menyimpan nilai gain kedalam database
                                        simpanGain($NOD, $vNamaAtribut, $vGain);
                            ?>
                            <tr>
                                <td colspan="9" class="text-right"><?= round($vGain, 6) ?></td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                    <!-- end fungsi -->
                        </tbody>
                    </table>
                </div>
                <!-- end tabel perhitungan C4.5 -->
            </div>
            <!-- end tabel perhitungan -->
            <?php
            $d = 0.1;
            $Cek = maxGain($NOD);
            if ($Cek == 1) {
                echo "Perhitungan Berhenti Karena Nilai Entrhopy = 0";
            } elseif ($Cek != 1) {
                for ($b = 1; $b < $Cek; $b++) {
                    $NOD = ($a + 1) + $d;
            ?>
                    <!-- tabel -->
                    <div class="container mt-3">
                        <h2>Tabel NOD <?= $NOD ?></h2>
                        <div class="card-body table-responsive p-0" style="height: 450px;">
                            <table class="table table-responsive table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
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

                                    $tampil = tampilData("", "", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);

                                    // cek apakah ada data pada database tbl_data
                                    if ($tampil) {
                                        if (mysqli_num_rows($tampil) > 0) {
                                            // lakukan perulangan selama data pada database tbl_data ada
                                            while ($row = mysqli_fetch_array($tampil)) {
                                    ?>
                                                <tr>
                                                    <th scope="row"><?= $nomor++ ?></th>
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
                    <!-- end tabel -->
                    <!-- tabel perhitungan -->
                    <div class="container mt-3">
                        <h2>Tabel Perhitungan Metode C4.5 NOD <?= $NOD ?></h2>
                        <!-- membuat tabel perhitungan C4.5 -->
                        <div class="card-body table-responsive p-0" style="height: 450px;">
                            <table class="table table-responsive table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Jumlah (s)</th>
                                        <th scope="col">Tanpa Dehidrasi</th>
                                        <th scope="col">Dehidrasi Ringan</th>
                                        <th scope="col">Dehidrasi Sedang</th>
                                        <th scope="col">Dehidrasi Berat</th>
                                        <th scope="col">Entrhopy</th>
                                        <th scope="col">Gain</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- perhitungan NOD1-->
                                    <?php

                                    $vJumlahAllData = hitungDataTraining("");
                                    $vJumlahDataTanpaDehidrasi = hitungDataTraining("Tanpa Dehidrasi");
                                    $vJumlahDataDehidrasiRingan = hitungDataTraining("Dehidrasi Ringan");
                                    $vJumlahDataDehidrasiSedang = hitungDataTraining("Dehidrasi Sedang");
                                    $vJumlahDataDehidrasiBerat = hitungDataTraining("Dehidrasi Berat");

                                    // simpan hasil perhitungan kedalam database entrhopy
                                    simpanDataC45($NOD, "Total", "All Total", $vJumlahAllData, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);


                                    $vEntrhopyAll = hitungEntrhopy("All Total", $NOD, "Total");

                                    // panggil fungsi tampil c45
                                    $ID = tampilC45($NOD, "Total", "All Total");

                                    // update tabel c45
                                    updateDataC45($vEntrhopyAll, $ID);
                                    ?>
                                    <!-- end perhitungan -->
                                    <tr>
                                        <td scope="row">Total</td>
                                        <td></td>
                                        <td><?php echo $vJumlahAllData; ?></td>
                                        <td><?php echo $vJumlahDataTanpaDehidrasi; ?></td>
                                        <td><?php echo $vJumlahDataDehidrasiRingan; ?></td>
                                        <td><?php echo $vJumlahDataDehidrasiSedang; ?></td>
                                        <td><?php echo $vJumlahDataDehidrasiBerat; ?></td>
                                        <td><?php echo round($vEntrhopyAll, 8); ?></td>
                                        <td></td>
                                    </tr>
                                    <!-- memanggil fungsi tampildataatribut -->
                                    <?php
                                    $Entrhopy = 0;
                                    $vTampilDataAtribut = tampilDataAtribut($vTampungNamaAtribut[$a], $vTampungNamaAtribut[$b]);
                                    if (mysqli_num_rows($vTampilDataAtribut)) {
                                        while ($dAtribut = mysqli_fetch_array($vTampilDataAtribut)) {
                                            // tampung id atribut, nama atribut
                                            $vIdAtribut = $dAtribut['id_atribut'];
                                            $vNamaAtribut = $dAtribut['Nama_atribut'];
                                            // memanggil fungsi tampil class dengan parameter id atribut
                                            $vTampilDataClass = tampilDataClass($vIdAtribut);
                                            // hitung jumlah data yang ada pada tbl_class berdasarkan id atribut
                                            $vBanyakData = mysqli_num_rows($vTampilDataClass);
                                    ?>
                                            <tr>
                                                <td rowspan="<?= $vBanyakData ?>"><?php echo $vNamaAtribut ?></td>
                                                <?php
                                                if (mysqli_num_rows($vTampilDataClass)) {
                                                    while ($dClass = mysqli_fetch_array($vTampilDataClass)) {
                                                        // tampung nama class
                                                        $vNamaClass = $dClass['Nama_Class'];
                                                        // panggil fungsi hitung jumlah data class
                                                        $vJumlahAllDataClass = hitungDataClass($vNamaAtribut, $vNamaClass, "", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);
                                                        $vJumlahDataTanpaDehidrasi = hitungDataClass($vNamaAtribut, $vNamaClass, "Tanpa Dehidrasi", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);
                                                        $vJumlahDataDehidrasiRingan = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Ringan", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);
                                                        $vJumlahDataDehidrasiSedang = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Sedang", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);
                                                        $vJumlahDataDehidrasiBerat = hitungDataClass($vNamaAtribut, $vNamaClass, "Dehidrasi Berat", $vTampungNamaAtribut[$a], $vTampungNamaClass[$a], $vTampungNamaAtribut[$b], $vTampungNamaClass[$b]);

                                                        // simpan data kedalam database tabel c45
                                                        simpanDataC45($NOD, $vNamaAtribut, $vNamaClass, $vJumlahAllDataClass, $vJumlahDataTanpaDehidrasi, $vJumlahDataDehidrasiRingan, $vJumlahDataDehidrasiSedang, $vJumlahDataDehidrasiBerat);

                                                        // hitung entrhopy
                                                        $vEntrhopyClass = hitungEntrhopy($vNamaClass, $NOD, $vNamaAtribut);

                                                        // panggil fungsi tampil c45
                                                        $ID = tampilC45($NOD, $vNamaAtribut, $vNamaClass);

                                                        // update tabel c45
                                                        updateDataC45($vEntrhopyClass, $ID);
                                                ?>
                                                        <td><?php echo $dClass['Nama_Class'] ?></td>
                                                        <td><?= $vJumlahAllDataClass ?></td>
                                                        <td><?= $vJumlahDataTanpaDehidrasi ?></td>
                                                        <td><?= $vJumlahDataDehidrasiRingan ?></td>
                                                        <td><?= $vJumlahDataDehidrasiSedang ?></td>
                                                        <td><?= $vJumlahDataDehidrasiBerat ?></td>
                                                        <td><?= round($vEntrhopyClass, 8) ?></td>
                                            </tr>
                                    <?php
                                                    }
                                                }
                                                //    memanggil fungsi perhitungan gain
                                                $vGain = hitungGain($vJumlahAllData, $vEntrhopyAll, $NOD, $vNamaAtribut);
                                                // memanggil fungsi untuk menyimpan nilai gain kedalam database
                                                simpanGain($NOD, $vNamaAtribut, $vGain);
                                    ?>
                                    <tr>
                                        <td colspan="9" class="text-right"><?= round($vGain, 6) ?></td>
                                    </tr>
                            <?php
                                        }
                                    }
                            ?>
                            <!-- end fungsi -->
                                </tbody>
                            </table>
                        </div>
                        <!-- end tabel perhitungan C4.5 -->
                    </div>
                    <!-- end tabel perhitungan -->
        <?php
                }
                $Cek = maxGain($NOD);
                if ($Cek == 1) {
                    echo "Perhitungan Berhenti Karena Nilai Entrhopy = 0";
                } elseif ($Cek != 1) {
                    echo "Lanjut";
                }
            }
        }
        ?>
        <!-- end perhitungan -->

        <!-- Tree C45 -->
        <div class="container mt-5 mb-4">
            <h2>Tree C45</h2>
            <hr>
            <?php
            $NOD = 1.0;
            $tampil = treeC45($NOD);
            if (mysqli_num_rows($tampil)) {
                while ($row1 = mysqli_fetch_array($tampil)) {
                    $vHasil = $row1['Hasil'];
            ?>
                    <p>* &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['Nama_atribut'] ?> : <?php echo $row1['Nama_Class'] ?></p>
                    <?php
                    if ($vHasil == "Lanjut") {
                        $NODE = $NOD + 1.0;
                        $tampil1 = treeC45($NODE);
                        if (mysqli_num_rows($tampil1)) {
                            while ($row2 = mysqli_fetch_array($tampil1)) {
                                $vHasil2 = $row2['Hasil'];
                                if ($vHasil2 != "Lanjut") {
                    ?>
                                    <p> &nbsp;&nbsp;&nbsp;&nbsp; | <?php echo $row2['Nama_atribut'] ?> : <?php echo $row2['Nama_Class'] ?> = <?= $vHasil2 ?></p>
                                <?php
                                } elseif ($vHasil2 == "Lanjut") {
                                ?>
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp; | * &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['Nama_atribut'] ?> : <?php echo $row2['Nama_Class'] ?> </p>
                                    <?php
                                    $NODL = $NODE + 0.1;
                                    $tampil2 = treeC45($NODL);
                                    if (mysqli_num_rows($tampil2)) {
                                        while ($row3 = mysqli_fetch_array($tampil2)) {
                                            $vHasil3 = $row3['Hasil'];
                                            if ($vHasil3 != "Lanjut") {
                                    ?>
                                                <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| <?php echo $row3['Nama_atribut'] ?> : <?php echo $row3['Nama_Class'] ?> = <?= $vHasil3 ?></p>
            <?php
                                            }
                                        }
                                    }
                                }
                                $NODE++;
                            }
                        }
                    }
                    $NOD++;
                }
            }
            ?>
        </div>
        <!-- end Tree -->

        <!-- Tes Data Training -->
        <div class="container mt-5">
            <!-- mebuat tabel -->
            <h2>Data Testing</h2>
            <div class="card-body table-responsive p-0" style="height: 450px;">
                <table class="table table-responsive table-head-fixed text-nowrap">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NO</th>
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
                            <th scope="col">KECOCOKAN</th>
                            <th scope="col">PREDIKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- memanggil fungsi tampil data -->
                        <?php
                        $nomor = 1;
                        $tampil = tampilDataTraining();
                        // cek apakah ada data pada database tbl_data
                        if ($tampil) {
                            if (mysqli_num_rows($tampil) > 0) {
                                // lakukan perulangan selama data pada database tbl_data ada
                                while ($row = mysqli_fetch_array($tampil)) {
                                    // echo "nilai : ".$vJumlahAllData;

                                    $vHasil = cekRules1($row['Derajat_Haus'], $row['Palpebra'], $row['Frekuensi_Denyut_Jantung'], $row['Kualitas_Denyut_Nadi'], $row['Status_Mental']);

                        ?>
                                    <tr>
                                        <th scope="row"><?= $nomor++ ?></th>
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
                                        <td><?php echo $row['Hasil'] ?></td>
                                        <?php
                                        // cek kecocokan
                                        if ($row['Hasil'] == $vHasil) {
                                            $vTampungSesuai += 1;
                                        ?>
                                            <td><span class="badge badge-success">Sesuai</span></td>
                                        <?php
                                        } elseif ($row['Hasil'] != $vHasil) {
                                            $vTampungTidakSesuai += 1;
                                        ?>
                                            <td><span class="badge badge-warning">Tidak Sesuai</span></td>
                                        <?php
                                        }
                                        if ($vHasil == "Tanpa Dehidrasi") {
                                        ?>
                                            <td><span class="badge badge-success"><?php echo $vHasil ?></span></td>
                                        <?php
                                        } elseif ($vHasil == "Dehidrasi Ringan") {
                                        ?>
                                            <td><span class="badge badge-info"><?php echo $vHasil ?></span></td>
                                        <?php
                                        } elseif ($vHasil == "Dehidrasi Sedang") {
                                        ?>
                                            <td><span class="badge badge-warning"><?php echo $vHasil ?></span></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><span class="badge badge-danger"><?php echo $vHasil ?></span></td>
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
                <!-- end tabel -->
            </div>
        </div>
        <!-- end tes -->

        <!-- Persentase Kecocokan -->
        <?php
        $vJumlahData = $vTampungSesuai + $vTampungTidakSesuai;
        $vPersentase = $vTampungSesuai / $vJumlahData * 100;

        ?>
        <div class="container">
            <p>Jumlah Data Total Data Testing : <?= $vJumlahData ?> Data</p>
            <p>Jumlah Data Yang Sesuai : <?= $vTampungSesuai ?> Data</p>
            <p>Jumlah Data Yang Tidak Sesuai : <?= $vTampungTidakSesuai ?> Data</p>
            <p class="text-center">Hasil Kecocokan Data Testing Dengan Metode C4.5 adalah : <?= round($vPersentase, 2) ?>%</p>
        </div>
        <!-- end -->
    <?php } ?>
    <!-- Optional JavaScript -->
<?php
    include 'Layout/footer.php';
} else {
    echo "<script>
       alert('Anda Belum login');
       document.location='login.php';
       </script>";
}
?>