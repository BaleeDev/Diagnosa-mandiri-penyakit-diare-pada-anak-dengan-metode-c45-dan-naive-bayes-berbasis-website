<!-- php -->
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

  // tampung nilai jumlah probabilitas hasil
  $vTTanpaDehidrasi;
  $vTDehidrasiRingan;
  $vTDehidrasiSedang;
  $vTDehidrasiBerat;
  $vTampungAtribut = [];
  $vTampungSesuai = 0;
  $vTampungTidakSesuai = 0;
  $vhitungTD = [];
  $vhitungTR = [];
  $vhitungTS = [];
  $vhitungTB = [];
  $datatraining = 0;
  // membuat fungsi untuk menampilkan semua data training yang ada pada database
  function tampilData($limit, $urtu)
  {
    global $koneksi;
    if ($urtu == "") {
      $tampil = mysqli_query($koneksi, "SELECT * FROM `tbl_semua_data` ORDER BY id ASC LIMIT $limit");
    } elseif ($urtu != "") {
      $tampil = mysqli_query($koneksi, "SELECT * FROM `tbl_semua_data` ORDER BY id DESC LIMIT $limit");
    }
    return $tampil;
  }
  // membuat fungsi untuk menampilkan semua data atribut
  function tampilAtribut()
  {
    global $koneksi;
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_atribut ");
    return $tampil;
  }
  // membuat fungsi untuk menampilkan semua data class
  function tampilClass($idAtribut)
  {
    global $koneksi;
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_class WHERE id_atribut = '$idAtribut' ");
    return $tampil;
  }
  // memubuat fungsi untuk memanggil jumlah class
  function hitungJumlahClass($NamaAtribut, $NamaClas)
  {
    global $koneksi;
    $data = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $NamaAtribut = '$NamaClas'");
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
  }
  // membuat fungsi untuk menghitung jumlah total data
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

  // membuat fungsi untuk menyimpan hasil perhitungan probabilitas kedalam tbl_probabilitas
  function simpanProbabilitas($vNamaAtribut, $NamaClas, $TanpaDehidrasi, $DehidrasiRingan, $DehidrasiSedang, $DehidrasiBerat)
  {
    global $koneksi;
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_probabilitas (Nama_atribut, Nama_Class, Tanpa_Dehidrasi, Dehidrasi_Ringan, Dehidrasi_Sedang,Dehidrasi_Berat)
        VALUES ('$vNamaAtribut','$NamaClas','$TanpaDehidrasi' ,'$DehidrasiRingan' , '$DehidrasiSedang' ,'$DehidrasiBerat')
            ");
    return $simpan;
  }
  // membuat function untuk menyimpan data testing
  function simpanDataTesting($limit)
  {
    global $koneksi;
    $tampil = tampilData($limit, "urut");
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
  // membuat fungsi untuk menampilkan isi data testing
  function tampilDataTesting()
  {
    global $koneksi;


    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_testing LIMIT 60");
    return $tampil;
  }
  function hapusData()
  {
    global $koneksi;
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_training ");
    if ($tampil) {
      if (mysqli_num_rows($tampil) > 0) {
        while ($row = mysqli_fetch_array($tampil)) {
          $id = $row['id_data'];
          $hapus = mysqli_query($koneksi, "DELETE FROM tbl_training WHERE `tbl_training`.`id_data` = '$id'");
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
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_probabilitas ");
    if ($tampil) {
      if (mysqli_num_rows($tampil) > 0) {
        while ($row = mysqli_fetch_array($tampil)) {
          $id = $row['id_probabilitas'];
          $hapus = mysqli_query($koneksi, "DELETE FROM tbl_probabilitas WHERE `tbl_probabilitas`.`id_probabilitas` = '$id'");
        }
      }
    }
  }
  // function hitung jumlah
  function hitungJumlah($atribut, $class)
  {
    global $koneksi;
    $tampilP = mysqli_query($koneksi, "SELECT*FROM tbl_training WHERE $atribut='$class' ");

    return $tampilP;
  }



  include 'Layout/header.php';
?>
  <!-- end php -->
  <!-- html -->

  <!-- menampilkan data training kedalam tabel -->
  <div class="container mt-5">
    <h2 for="">Tabel Data Training</h2>
    <form method="POST" action="">
      <div class="row">
        <div class="col">
          <select class="form-control" name="pdata">
            <?php
            if (isset($_POST['btampil'])) {
              $isidata = $_POST['pdata'];
              $datatraining = 127 - $isidata;
            ?>
              <option><?= $isidata ?> Data Training</option>
            <?php } ?>
            <option>Pilih Jumlah Data Training </option>
            <option value="30">30 Data Training</option>
            <option value="50">50 Data Training</option>
          </select>
        </div>
        <div class="col">
          <button type="submit" name="btampil" class="btn btn-primary mb-2">Tampil</button>
        </div>
      </div>
    </form>

    <!-- jika tombol tampil di tekan  -->
    <?php
    if (isset($_POST['btampil'])) {
      hapusData();
      simpanDataTesting($datatraining);
    ?>
      <div class="card-body table-responsive p-0" style="height: 450px;">
        <table class="table table-responsive table-head-fixed text-nowrap">
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
            <!-- memangil fungsi tampil data trainig yang ada pada data base -->
            <?php
            $vNomor = 1;
            // memanggil fungsi tampil data training
            $tampil = tampilData($_POST['pdata'], "");
            // mengecek apakah ada data yang tersimpan pada tabel data
            if ($tampil) {
              if (mysqli_num_rows($tampil) > 0) {
                while ($row = mysqli_fetch_array($tampil)) {
                  // simpan data kedalam data training
                  $simpan = mysqli_query($koneksi, "INSERT INTO `tbl_training` (`id_data`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES (NULL, '$row[Jenis_Kelamin]', '$row[Umur]', '$row[Status_Mental]', '$row[Derajat_Haus]', '$row[Frekuensi_Denyut_Jantung]', '$row[Kualitas_Denyut_Nadi]', '$row[Pernapasan]', '$row[Palpebra]', '$row[Air_Mata]', '$row[Mulut_Dan_Lidah]', '$row[Turgor]', '$row[Capillary_Refill_Time]', '$row[Ekstremitas]', '$row[Produksi_Urin]', '$row[Hasil]')");
            ?>
                  <tr>
                    <th scope="row"><?= $vNomor++ ?></th>
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
                $vNomor++;
              }
            }

            ?>
            <!-- end -->
          </tbody>
          <!-- tabel jumlah -->
        </table>
      </div>
      <div class="text-center mt-5 mb-3">
        <form action="#" method="post">
          <button type="submit" name="Perhitungan" class="btn btn-outline-primary">Perhitungan Naive Bayes</button>
        </form>
      </div>
    <?php } ?>
    <hr>
    <?php
    if (isset($_POST['Perhitungan'])) {
      $vTotal = hitungTotalData("");
      $vTanpaDehidrasi = hitungTotalData("Tanpa Dehidrasi");
      $vDehidrasiRingan = hitungTotalData("Dehidrasi Ringan");
      $vDehidrasiSedang = hitungTotalData("Dehidrasi Sedang");
      $vDehidrasiBerat = hitungTotalData("Dehidrasi Berat");
      // menghitung nilai jumlah Tanpa Dehidrasi, Dehidrasi Ringan, Dehidrasi sedang dan Dehidrasi Berat
      $vTTanpaDehidrasi = round($vTanpaDehidrasi / $vTotal, 2);
      $vTDehidrasiRingan = round($vDehidrasiRingan / $vTotal, 2);
      $vTDehidrasiSedang = round($vDehidrasiSedang / $vTotal, 2);
      $vTDehidrasiBerat = round($vDehidrasiBerat / $vTotal, 2);
    ?>
      <h3>Perhitungan Dengan Metode Naive Bayes</h3>
      <hr>
      <div class="col-md5">
        <div class="container">
          <div class="card-body table-responsive p-0" style="height: 450px;">
            <table class="table table-responsive table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Probabilitas</th>
                  <th scope="col">Persentase</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Tanpa Dehidrasi</th>
                  <td><?php echo $vTanpaDehidrasi; ?></td>
                  <td><?php echo $vTTanpaDehidrasi; ?></td>
                  <td><?php echo round($vTanpaDehidrasi / $vTotal * 100, 0); ?>%</td>
                </tr>
                <tr>
                  <th scope="row">Dehidrasi Ringan</th>
                  <td><?php echo $vDehidrasiRingan; ?></td>
                  <td><?php echo $vTDehidrasiRingan; ?></td>
                  <td><?php echo round($vDehidrasiRingan / $vTotal * 100, 0); ?>%</td>
                </tr>
                <tr>
                  <th scope="row">Dehidrasi Sedang</th>
                  <td><?php echo $vDehidrasiSedang; ?></td>
                  <td><?php echo $vTDehidrasiSedang; ?></td>
                  <td><?php echo round($vDehidrasiSedang / $vTotal * 100, 0); ?>%</td>
                </tr>
                <tr>
                  <th scope="row">Dehidrasi Berat</th>
                  <td><?php echo $vDehidrasiBerat; ?></td>
                  <td><?php echo $vTDehidrasiBerat; ?></td>
                  <td><?php echo round($vDehidrasiBerat / $vTotal * 100, 0); ?>%</td>
                </tr>
                <tr>
                  <th scope="row">Total</th>
                  <td><?php echo $vDehidrasiBerat + $vTanpaDehidrasi + $vDehidrasiRingan + $vDehidrasiSedang; ?></td>
                  <td></td>
                  <td><?php echo round(($vDehidrasiBerat / $vTotal * 100) + ($vDehidrasiSedang / $vTotal * 100) + ($vDehidrasiRingan / $vTotal * 100) + ($vTanpaDehidrasi / $vTotal * 100), 0); ?>%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
  <!-- end tampil data -->
  <!-- tabel probabilitas  -->
  <div class="container mt-2">
    <hr>
    <h2>Perhitungan Probabilitas Dari Setiap Atribut</h2>
    <hr>

    <!-- menapilkan data atribut -->
    <?php
      $a = 0;
      $tampilAtribut = tampilAtribut();
      if ($tampilAtribut) {
        if (mysqli_num_rows($tampilAtribut) > 0) {
          while ($row = mysqli_fetch_array($tampilAtribut)) {
            $vTampungAtribut[$a] = $row['Nama_atribut'];
    ?>
          <div class="col-md-12">
            <table class="table table-responsive table-sm table-dark">
              <thead>
                <tr>
                  <th scope="col">P | <?php echo $row['Nama_atribut'] ?></th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Tanpa Dehidrasi</th>
                  <th scope="col">Dehidrasi Ringan</th>
                  <th scope="col">Dehidrasi Sedang</th>
                  <th scope="col">Dehidrasi Berat</th>
                </tr>
              </thead>
              <tbody>
                <!-- menampilkan data class berdasarkan id_atribut -->
                <?php
                $vIdAtribut = $row['id_atribut'];
                $vNamaAtribut = $row['Nama_atribut'];
                // simpan nama atribut kedalam array
                $tampilClass = tampilClass($vIdAtribut);
                if ($tampilClass) {
                  if (mysqli_num_rows($tampilClass) > 0) {
                    while ($data = mysqli_fetch_array($tampilClass)) {
                      $vNamaClass = $data['Nama_Class'];
                      $vJumlahClas = hitungJumlahClass($vNamaAtribut, $vNamaClass);
                      $vPTanpaDehidrasi = hitungProbabilitasClass($vNamaAtribut, $vNamaClass, 'Tanpa Dehidrasi');
                      $vPDehidrasiRingan = hitungProbabilitasClass($vNamaAtribut, $vNamaClass, 'Dehidrasi Ringan');
                      $vPDehidrasiSedang = hitungProbabilitasClass($vNamaAtribut, $vNamaClass, 'Dehidrasi Sedang');
                      $vPDehidrasiBerat = hitungProbabilitasClass($vNamaAtribut, $vNamaClass, 'Dehidrasi Berat');

                      // simpan sementara probabilitas
                      $PTD = round($vPTanpaDehidrasi / $vTanpaDehidrasi, 1);
                      $PDR = round($vPDehidrasiRingan / $vDehidrasiRingan, 1);
                      $PDS = round($vPDehidrasiSedang / $vDehidrasiSedang, 3);
                      $PDB = round($vPDehidrasiBerat / $vDehidrasiBerat, 3);

                      simpanProbabilitas($vNamaAtribut, $vNamaClass, $PTD, $PDR, $PDS, $PDB);
                ?>
                      <tr>
                        <th scope="row"><?php echo $data['Nama_Class'] ?></th>
                        <td><?php echo $vJumlahClas; ?></td>
                        <td><?php echo $PTD; ?></td>
                        <td><?php echo $PDR; ?></td>
                        <td><?php echo $PDS; ?></td>
                        <td><?php echo $PDB; ?></td>
                      </tr>
                <?php

                    }
                  }
                }
                ?>
              </tbody>
        <?php
            $a++;
          }
        }
      }
        ?>
        <!-- end -->


            </table>
          </div>
  </div>
  <!-- end tabel -->

  <!-- tabel data testing -->
  <div class="container mt-5">
    <h2 for="">Tabel Data Testing</h2>
    <div class="card-body table-responsive p-0" style="height: 450px;">
      <table class="table table-responsive table-head-fixed text-nowrap">
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
            <th scope="col">KECOCOKAN</th>
            <th scope="col">Prediksi</th>
            <th scope="col">Tanpa Dehidrasi</th>
            <th scope="col">Dehidrasi Ringan</th>
            <th scope="col">Dehidrasi Sedang</th>
            <th scope="col">Dehidrasi Berat</th>
          </tr>
        </thead>
        <tbody>
          <!-- memangil fungsi tampil data trainig yang ada pada data base -->
          <?php
          $vNomor = 1;
          $aTampungTesting = [];
          // memanggil fungsi untuk menampilkan data testing
          $tampil = tampilDataTesting();
          // mengecek apakah ada data yang tersimpan pada tabel data
          if ($tampil) {
            if (mysqli_num_rows($tampil) > 0) {
              while ($row = mysqli_fetch_array($tampil)) {
                // tampung kedalam array
                $aTampungTesting[0] = $row['Jenis_Kelamin'];
                $aTampungTesting[1] = $row['Umur'];
                $aTampungTesting[2] = $row['Status_Mental'];
                $aTampungTesting[3] = $row['Derajat_Haus'];
                $aTampungTesting[4] = $row['Frekuensi_Denyut_Jantung'];
                $aTampungTesting[5] = $row['Kualitas_Denyut_Nadi'];
                $aTampungTesting[6] = $row['Pernapasan'];
                $aTampungTesting[7] = $row['Palpebra'];
                $aTampungTesting[8] = $row['Air_Mata'];
                $aTampungTesting[9] = $row['Mulut_Dan_Lidah'];
                $aTampungTesting[10] = $row['Turgor'];
                $aTampungTesting[11] = $row['Capillary_Refill_Time'];
                $aTampungTesting[12] = $row['Ekstremitas'];
                $aTampungTesting[13] = $row['Produksi_Urin'];

                $vTanpaDehidrasi = hitungTotalData("Tanpa Dehidrasi");
                $vDehidrasiRingan = hitungTotalData("Dehidrasi Ringan");
                $vDehidrasiSedang = hitungTotalData("Dehidrasi Sedang");
                $vDehidrasiBerat = hitungTotalData("Dehidrasi Berat");

                $vCekTanpaDehidrasi = 0;
                $vCekDehidrasiRingan = 0;
                $vCekDehidrasiSedang = 0;
                $vCekDehidrasiBerat = 0;
                $vaTanpaDehidrasi = [];
                $vaDehidrasiRingan = [];
                $vaDehidrasiSedang = [];
                $vaDehidrasiBerat = [];
                // lakukan pengecekan dan perhitungan naive bayes
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
                    // echo $vNomor . ". " . $vhasilTD . "<br>";
                    // echo $vNomor . ". " . $vhasilTR . "<br>";
                    // echo $vNomor . ". " . $vhasilTS . "<br>";
                    // echo $vNomor . ". " . $vhasilTB . "<br>";
                  }

                  // echo $i . ". " . $vnPTanpaDehidrasi . "<br>";
                  // echo $i . ". " . $vnPDehidrasiRingan . "<br>";
                  // echo $i . ". " . $vnPDehidrasiSedang . "<br>";
                  // echo $i . ". " . $vnPDehidrasiBerat . "<br>";

                  // echo $i . ". " . $vTanpaDehidrasi . "<br>";
                  // echo $i . ". " . $vDehidrasiRingan . "<br>";
                  // echo $i . ". " . $vDehidrasiSedang . "<br>";
                  // echo $i . ". " . $vDehidrasiBerat . "<br>";
                  // echo $i . ". " . $vaDehidrasiSedang[$i] . "<br>";

                  // // simpan sementara probabilitas
                  // $vhitungTD[$i] = round($vnPTanpaDehidrasi / $vTanpaDehidrasi, 3);
                  // $vhitungTR[$i] = round($vnPDehidrasiRingan / $vDehidrasiRingan, 3);
                  // $vhitungTS[$i] = round($vnPDehidrasiSedang / $vDehidrasiSedang, 3);
                  // $vhitungTB[$i] = round($vnPDehidrasiBerat / $vDehidrasiBerat, 3);

                  // echo $i . ". " . $vhitungTD[$i] . "<br>";
                  // echo $i . ". " . $vhitungTR[$i] . "<br>";
                  // echo $i . ". " . $vhitungTS[$i] . "<br>";
                  // echo $i . ". " . $vhitungTB[$i] . "<br>";
                  // mengecek apakah ada nilai 0 dan mengatasinya dengan laplaction correction
                  // if ($vTD[0] == 0) {

                  // // }
                  // $vhitungTD = $vTD[0] * $vTD[1] * $vTD[2] * $vTD[3] * $vTD[4] * $vTD[5] * $vTD[6] * $vTD[7] * $vTD[8] * $vTD[9] * $vTD[10] * $vTD[11] * $vTD[12] * $vTD[13] * 0.3;
                  // // echo $vNomor." ". round($vhitungTD,7)."<br/>";
                  // $vhitungTR = $vDR[0] * $vDR[1] * $vDR[2] * $vDR[3] * $vDR[4] * $vDR[5] * $vDR[6] * $vDR[7] * $vDR[8] * $vDR[9] * $vDR[10] * $vDR[11] * $vDR[12] * $vDR[13] * 0.2;
                  // // echo round($vhitungTR,7)."<br/>";
                  // $vhitungTS = $vDS[0] * $vDS[1] * $vDS[2] * $vDS[3] * $vDS[4] * $vDS[5] * $vDS[6] * $vDS[7] * $vDS[8] * $vDS[9] * $vDS[10] * $vDS[11] * $vDS[12] * $vDS[13] * 0.27;
                  // // echo round($vhitungTS,7)."<br/>";

                  // $vhitungTB = $vDB[0] * $vDB[1] * $vDB[2] * $vDB[3] * $vDB[4] * $vDB[5] * $vDB[6] * $vDB[7] * $vDB[8] * $vDB[9] * $vDB[10] * $vDB[11] * $vDB[12] * $vDB[13] * 0.23;
                  // echo round($vhitungTB,7)."<br/>";


                  // kembalikan nilai 
                  // $vTanpaDehidrasi = 9;
                  // $vDehidrasiRingan = 6;
                  // $vDehidrasiSedang = 8;
                  // $vDehidrasiBerat = 7;
                  // $vhasilTD =  $vhitungTD[0] * $vhitungTD[1] * $vhitungTD[2] * $vhitungTD[3] * $vhitungTD[4] * $vhitungTD[5] * $vhitungTD[6] * $vhitungTD[7] * $vhitungTD[8] * $vhitungTD[9] * $vhitungTD[10] * $vhitungTD[11] * $vhitungTD[12] * $vhitungTD[13] * $vTTanpaDehidrasi;
                  // $vhasilTR =  $vhitungTR[0] * $vhitungTR[1] * $vhitungTR[2] * $vhitungTR[3] * $vhitungTR[4] * $vhitungTR[5] * $vhitungTR[6] * $vhitungTR[7] * $vhitungTR[8] * $vhitungTR[9] * $vhitungTR[10] * $vhitungTR[11] * $vhitungTR[12] * $vhitungTR[13] * $vTDehidrasiRingan;
                  // $vhasilTS =  $vhitungTS[0] * $vhitungTS[1] * $vhitungTS[2] * $vhitungTS[3] * $vhitungTS[4] * $vhitungTS[5] * $vhitungTS[6] * $vhitungTS[7] * $vhitungTS[8] * $vhitungTS[9] * $vhitungTS[10] * $vhitungTS[11] * $vhitungTS[12] * $vhitungTS[13] * $vTDehidrasiSedang;
                  // $vhasilTB =  $vhitungTB[0] * $vhitungTB[1] * $vhitungTB[2] * $vhitungTB[3] * $vhitungTB[4] * $vhitungTB[5] * $vhitungTB[6] * $vhitungTB[7] * $vhitungTB[8] * $vhitungTB[9] * $vhitungTB[10] * $vhitungTB[11] * $vhitungTB[12] * $vhitungTB[13] * $vTDehidrasiBerat;
                }
                // var_dump($vaDehidrasiSedang);
                // pengecekan data 0

                // echo $vCekDehidrasiSedang . "n";
                // if ($vCekDehidrasiSedang != "0") {
                //   for ($j = 0; $j <= 13; $j++) {
                //     echo $j . ".asli  : " . $vaDehidrasiSedang[$j] . "<br>";
                //     $vaDehidrasiSedang[$j] += 1;
                //     echo $j . ". tambah :  " . $vaDehidrasiSedang[$j] . "<br>";
                //     $vhitungTS[$j] = round($vaDehidrasiSedang[$j] / 16, 3);
                //     // echo $j . ". " . $vhitungTS[$j] . "<br>";
                //   }
                // }

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
                // echo $vNomor . ". " . $vhasilTR . "<br>";
          ?>

                <tr>
                  <th scope="row"><?= $vNomor++ ?></th>
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
                  <td><?php echo $row['Hasil'] ?></td>
                  <?php
                  if ($row['Hasil'] == $hasil) {
                    $vTampungSesuai += 1;
                  ?>
                    <td><span class="badge badge-success">Sesuai</span></td>
                  <?php
                  } elseif ($row['Hasil'] != $hasil) {
                    $vTampungTidakSesuai += 1;
                  ?>
                    <td><span class="badge badge-warning">Tidak Sesuai</span></td>
                  <?php
                  }
                  ?>
                  <td><?= $hasil ?></td>
                  <td><?= $vhasilTD ?></td>
                  <td><?= $vhasilTR ?></td>
                  <td><?= $vhasilTS ?></td>
                  <td><?= $vhasilTB ?></td>
                </tr>
          <?php
              }
              $vNomor++;
            }
          }

          ?>
          <!-- end -->
        </tbody>
      </table>
    </div>
  </div>
  <!-- end tabel -->

  <!-- Persentase Kecocokan -->
  <?php
      $vJumlahData = $vTampungSesuai + $vTampungTidakSesuai;
      $vPersentase = $vTampungSesuai / $vJumlahData * 100;

  ?>
  <div class="container">
    <p>Jumlah Data Total Data Testing : <?= $vJumlahData ?> Data</p>
    <p>Jumlah Data Yang Sesuai : <?= $vTampungSesuai ?> Data</p>
    <p>Jumlah Data Yang Tidak Sesuai : <?= $vTampungTidakSesuai ?> Data</p>
    <p class="text-center">Hasil Kecocokan Data Testing Dengan Metode Naive Bayes adalah : <?= round($vPersentase, 2) ?>%</p>
  </div>
  <!-- end -->
<?php
    }
    include 'Layout/footer.php';
  } else {
    echo "<script>
     alert('Anda Belum login');
     document.location='login.php';
     </script>";
  }
?>