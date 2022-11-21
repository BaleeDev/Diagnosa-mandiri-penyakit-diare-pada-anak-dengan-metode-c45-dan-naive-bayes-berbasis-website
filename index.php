<?php

// membuka sesi baru
@session_start();
// memanggil file koneksi ke database
include 'database/db.php';

$tgl = date("Y-m-d");
$jam = date("H:i:s");
$vid = "P" . $tgl . $jam;
// membuat fungsi untuk menyimpan data uji

// membuat fungsi untuk melakukan testing data
function cekRules($DerajatHaus, $KualitasDenyutNadi, $Palpebra, $FrekuensiDenyutJantung, $StatusMental)
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

// jika button kirim ditekan
if (isset($_POST['Kirim'])) {

  // cek hasil data uji
  $vHasil = cekRules($_POST['derajathaus'], $_POST['denyutnadi'], $_POST['palpebra'], $_POST['denyutjantung'], $_POST['statusmental']);

  // menyimpan data 
  $vSimpan = mysqli_query($koneksi, "INSERT INTO tbl_uji (id,Nama_Anak,Jenis_Kelamin,Umur,Status_Mental,Derajat_Haus,Frekuensi_Denyut_Jantung,Kualitas_Denyut_Nadi,Pernapasan,Palpebra,Air_Mata,Mulut_Dan_Lidah,Turgor,Capillary_Refill_Time,Ekstremitas,Produksi_Urin,Hasil,tgl) VALUES ('$vid','$_POST[nama]','$_POST[jeniskelamin]','$_POST[umur]','$_POST[statusmental]','$_POST[derajathaus]','$_POST[denyutjantung]','$_POST[denyutnadi]','$_POST[pernapasan]','$_POST[palpebra]','$_POST[airmata]','$_POST[mulutdanlidah]','$_POST[turgor]','$_POST[crt]','$_POST[ekstremitas]','$_POST[urin]','$vHasil','$tgl')");
}
if (isset($_POST['daftar'])) {

  // menyimpan data 
  $vSimpan = mysqli_query($koneksi, "INSERT INTO `tbl_user` (`nik`, `nama`, `jeniskelamain`, `alamat`, `telepon`, `email`, `password`, `status`) VALUES ('$_POST[nik]', '$_POST[nama]', '$_POST[alamat]', '$_POST[jeniskelamin]', '$_POST[telepon]', '$_POST[email]', '$_POST[password]', 'Belum Aktif')");
  if ($vSimpan) {
    echo "<script>
alert('Daftar berhasil, silahkan menunggu akun anda aktif dalam kurang dari 24 jam ');

</script>";
  } else {
    echo "<script>
alert('Daftar gagal');
</script>";
  }
}

if (isset($_POST['login'])) {
  $vEmail = $_POST['email'];
  $vPw = $_POST['password'];
  if ($vEmail == "" || $vPw == "") {
?>
    <script type="text/javascript">
      alert("Email / Password Tidak Boleh Kosong");
    </script>
    <?php

  } else {
    $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_user where Email='$vEmail' && Password = '$vPw'");
    $CEK = mysqli_num_rows($tampil);
    $data = mysqli_fetch_array($tampil);
    if ($CEK > 0) {
      if ($data['status'] == "Belum Aktif") {
    ?>
        <script type="text/javascript">
          alert("Akun anda belum diaktifkan, silahkan menunggu akun anda di aktifkan. jika akun adan belum aktif selama lebih dari 24 jam hubungi Kontak Kami yang berada pada halaman Kontak");
        </script>
<?php
        echo "<script>
  document.location='index.php';
  </script>";
      } elseif ($data['status'] == "Aktif") {

        @$_SESSION['User'] = $data['nik'];
        echo "<script>
  alert('Login Berhasil');
  </script>";
      } else {
        echo "<script>
  alert('Login Gagal');
  </script>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Diagnosa Penyakit Diare - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr - v4.7.0
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html">Diagnosa Mandiri</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <?php
          if (@$_SESSION['User']) { ?>
            <li><a class="nav-link scrollto " href="#diagnosa">Diagnosa</a></li>
          <?php } ?>
          <li><a class="nav-link scrollto" href="#services">Info Penyakit</a></li>
          <li><a class="nav-link scrollto " href="#gejala">Gejala</a></li>
          <?php
          if (!@$_SESSION['User']) { ?>
            <li><a class="nav-link scrollto " href="#daftar">Daftar</a></li>
            <li><a class="nav-link scrollto " href="#login">Login</a></li>
          <?php } else { ?>
            <li><a class="nav-link scrollto " href="logouti.php">Log Out</a></li>
          <?php } ?>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Diagnosa Mandiri Penyakit Diare Pada Anak</h1>
          <?php
          if (@$_SESSION['User']) { ?>
            <div data-aos="fade-up" data-aos-delay="800">
              <a href="#diagnosa" class="btn-get-started scrollto">Ayo Mulai</a>
            </div>
          <?php } ?>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Contact Section ======= -->
    <?php
    if (@$_SESSION['User']) { ?>
      <section id="diagnosa" class="contact">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>Diagnosa Mandiri</h2>
          </div>

          <div class="row">

            <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100">
              <div class="contact-about">
                <h3>Diagnosa Mandiri Penyakit Diare Pada Anak Anda</h3>
                <p><i>Silahkan memilih gejala dengan cara mengisi dan memilih beberapa pilihan dibawah ini sesuai dengan gejala
                    yang anak anda alami.</i></p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="300">
              <form action="#counts" method="post">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Anak</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="<?= @$_POST['nama'] ?>" placeholder="Masukkan Nama Anak" required>
                  </div>
                </div>
                <div class="form-group row mb-3 mt-2">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jeniskelamin" required>
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Umur (Tahun)</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="umur" required>
                      <option value="">Pilih Umur (Tahun)</option>
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
                    <select class="form-control" name="statusmental" required>
                      <option value="">Pilih Satus Mental</option>
                      <option value="Sadar">Sadar</option>
                      <option value="Gelisah">Gelisah</option>
                      <option value="Apatis">Apatis</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Derajat Haus</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="derajathaus" required>
                      <option value="">Pilih Derajat Haus</option>
                      <option value="Minum Normal">Minum Normal</option>
                      <option value="Tampak Kehausan">Tampak Kehausan</option>
                      <option value="Rasa Haus Berkurang">Rasa Haus Berkurang</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Frekuensi Denyut Jantung</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="denyutjantung" required>
                      <option value="">Pilih Frekuensi Denyut Jantung</option>
                      <option value="Normal">Normal</option>
                      <option value="Meningkat">Meningkat</option>
                      <option value="Takikardia">Takikardia</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Kualitas Denyut Nadi</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="denyutnadi" required>
                      <option value="">Pilih Kualitas Denyut Nadi</option>
                      <option value="Normal">Normal</option>
                      <option value="Menurun">Menurun</option>
                      <option value="Lemah">Lemah</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Pernapasan</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="pernapasan" required>
                      <option value="">Pilih Pernapasan</option>
                      <option value="Normal">Normal</option>
                      <option value="Cepat">Cepat</option>
                      <option value="Dalam">Dalam</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Palpebra</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="palpebra" required>
                      <option value="">Pilih Palpebra</option>
                      <option value="Normal">Normal</option>
                      <option value="Sedikit Cekung">Sedikit Cekung</option>
                      <option value="Sangat Cekung">Sangat Cekung</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Air Mata</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="airmata" required>
                      <option value="">Pilih Air Mata</option>
                      <option value="Normal">Normal</option>
                      <option value="Berkurang">Berkurang</option>
                      <option value="Tidak Ada">Tidak Ada</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Mulut Dan Lidah</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="mulutdanlidah" required>
                      <option value="">Pilih Mulut Dan Lidah</option>
                      <option value="Lembab">Lembab</option>
                      <option value="Kering">Kering</option>
                      <option value="Sangat Kering">Sangat Kering</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Turgor</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="turgor" required>
                      <option value="">Pilih Turgor</option>
                      <option value="Rekoil Cepat">Rekoil Cepat</option>
                      <option value="Rekoil < 2 Detik">Rekoil < 2 Detik</option>
                      <option value="Rekoil > 2 Detik">Rekoil > 2 Detik</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Capillary Refill Time (CRT)</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="crt" required>
                      <option value="">Pilih Capillary Refill Time (CRT)</option>
                      <option value="Normal">Normal</option>
                      <option value="Memanjang">Memanjang</option>
                      <option value="Minimal">Minimal</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Ekstremitas</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="ekstremitas" required>
                      <option value="">Pilih Ekstremitas</option>
                      <option value="Hangat">Hangat</option>
                      <option value="Dingin">Dingin</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Produksi Urin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="urin" required>
                      <option value="">Pilih Produksi Urin</option>
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
        <!-- ======= Counts Section ======= -->
        <?php
        if (isset($_POST['Kirim'])) {
        ?>
          <section id="counts" class="counts">
            <div class="container">

              <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                  <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
                    <img src="assets/img/counts-img.svg" alt="" class="img-fluid text-center">
                  </div>
                </div>
              </div>

            </div>
          </section>

          <!-- End Counts Section -->
          <!-- ======= More Services Section ======= -->
          <section id="more-services" class="more-services">
            <div class="container">

              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 d-flex align-items-stretch">
                  <div class="card" style='background-image: url("assets/img/more-services-1.jpg");' data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body">
                      <h5 class="card-title"><a href="">Kesimpulan</a></h5>
                      <p class="card-text">Hasil dari pemeriksaan sistem diagnosa mandiri bahwa anak anda atas nama <?= $_POST['nama'] ?> telah mengalamai gejala penyakit <strong>Diare <i><?= $vHasil ?></i> </strong>, Segera lakukan pemeriksaan lanjut ke puskesmas atau rumah sakit terdekat. </p>
                      <a href="pages/cetak.php?id=<?= @$vid ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                  </div>
                </div>

              </div>
          </section>
        <?php
        }
        ?>
        <!-- End More Services Section -->
      </section>
    <?php } ?>
    <!-- End Contact Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Penyakit Diare</h2>
          <p>Diare adalah penyakit yang membuat penderitanya menjadi sering buang air besar dengan kondisi tinja
            yang encer atau berair. Diare umumnya terjadi akibat mengonsumsi makanan dan minuman yang terkontaminasi
            virus,
            bakteri, atau parasit.</p>
          <p>Diare dapat menyebabkan dehidrasi bahkan kematian. Kenali jenis-jenis diare agar Anda lebih waspada.</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Diare Tanpa Dehidrasi</a></h4>
              <p class="description">Kondisi dimana anak mengalami penyakit diare tidak disertai dehidrasi. </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Diare Dehidrasi Ringan</a></h4>
              <p class="description">Kondisi dimana anak mengalamai penyakit diare yang di sertai dehidrasi ringan.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Diare Dehidrasi Sedang</a></h4>
              <p class="description">Kondisi dimana anak mengalamai penyakit diare yang di sertai dehidrasi sedang.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Diare Dehidrasi Berat</a></h4>
              <p class="description">Kondisi dimana anak mengalamai penyakit diare yang di sertai dehidrasi berat.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->
    <!-- ======= Services Section ======= -->
    <section id="daftar" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Daftar</h2>
          <p>Jika anda belum mempunyai akun silahkan daftar dulu: </p>
          <div class="row">
            <form action="#login" method="post">
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nik" value="<?= @$_POST['nik'] ?>" placeholder="Masukkan nomor NIK " required>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" value="<?= @$_POST['namalengkap'] ?>" placeholder="Masukkan Nama Lengkap Anda sesuai pada KTP" required>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="alamat" value="<?= @$_POST['alamat'] ?>" placeholder="Masukkan alamat sesuai dengan ktp anda" required>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">No Telepon (62)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="telepon" value="<?= @$_POST['telepon'] ?>" placeholder="Masukkan no telepon atau no whatsaap anda" required>
                </div>
              </div>
              <div class="form-group row mb-3 mt-2">
                <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-control" name="jeniskelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" value="<?= @$_POST['email'] ?>" placeholder="Masukkan email anda" required>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" value="<?= @$_POST['email'] ?>" placeholder="Masukkan password anda" required>
                </div>
              </div>
              <div class="text-center mt-2">
                <button type="submit" name="daftar" class="btn btn-outline-primary">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->
    <section id="login" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Login</h2>
          <p>Jika anda belum mempunyai akun silahkan daftar dulu pada halaman daftar: </p>
          <div class="row">
            <form action="" method="post">
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" placeholder="Masukkan email anda" required>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="Masukkan password anda" required>
                </div>
              </div>
              <div class="text-center mt-2">
                <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->
    <!-- ======= Services Section ======= -->
    <section id="gejala" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gejala Diare</h2>
          <p>Gejala diare dan cara mengetahuinnya : </p>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Status Mental Pada Anak</strong></p>
              <p class="description">Status mental pada anak bisa dilihat dari si anak, ada pun beberapa Status mental pada anak : <br>
                <strong>1. </strong> Sadar (Keadaan anak masih sadar ) <br>
                <strong>2. </strong> Gelisah (Keadaan anak terlihat gelisah ) <br>
                <strong>3. </strong> Apatis (Dimana keadaan anak sudah terlihat tidak bersemangat atau pasrah akan penyakit yg dialaminya) <br>
              </p> <br>
              <p><strong>Derajat Haus</strong></p>
              <p class="description">Derajat haus bisa dilihat dari tingkat rasa ingin minum si anak. <br>
                <strong>1. </strong> Minum Normal (Dimana pada keadaan ini si anak masih memiliki keinginan untuk minum seperti biasa) <br>
                <strong>2. </strong> Tampak Kehausan (Dimana pada keadaan ini si anak merasa ingin minum terus) <br>
                <strong>3. </strong> Rasa Haus Berkurang (Dimana pada keadaan ini si anak memiliki nafsu minum yg berkurang) <br>
              </p> <br>
              <p><strong>Frekuensi Denyut Jantung</strong></p>
              <p class="description">Cara untuk mengetahui frekuensi denyut jantung anak adalah dengan cara : <br>
                <strong>- </strong> Tempatkan ujung telunjuk dan jari tengah anda ke bagian rahang bawah anak di salah satu sisi tenggorokan anak anda, anda akan merasakan denyut (detak) dibagian tersebut, lalu hitung berapa kali berdetak. <br>
                <strong>1. </strong>Normalnya, jantung berdetak 60–100 kali per menit <br>
                <strong>2. </strong>Meningkat, dentak jantung meningkat dari biasanya <br>
                <strong>3. </strong>Takikardia, jantung berdetak melebihi normal <br>
              </p> <br>
              <p><strong>Kualitasa Denyut Nadi</strong></p>
              <p class="description">Cara untuk mengetahui denyut nadi anak anda dengan cara : balikan telapak tangan anak anda (sehingga telapak tangan anak anda menghadap ke atas), lalu tempatkan ujung telunjuk dan jari tengah dan taruh tepat di pergelangan tangan anak anda (tepat di bawah pangkal jempol)<br>
                <strong>1. </strong>Normalnya, nadi berdetak 60–100 kali per menit <br>
                <strong>2. </strong>Menurun, dentak nadi menurun dari normal <br>
                <strong>3. </strong>Lemah, nadi berdetak sangat lemah <br>
              </p> <br>
              <p><strong>Turgor</strong></p>
              <p class="description">Cara mengecek turgor anak, dengan cara mencubit bagian punggung tangan anak Anda menggunakan ibu jari dan telunjuk Anda. Tahan selama beberapa detik dan kemudian lepaskan<br>
                <strong>1. </strong>Rekoil Cepat, kulit yang di cubit kembali dengan cepat<br>
                <strong>2. </strong>Rekoil < 2 Detik, kulit yang di cubit kembali dalam kurang dari 2 detik <br>
                  <strong>3. </strong>Rekoil > 2 Detik, kulit yang di cubit kembali dalam Lebih dari 2 detik <br>
              </p> <br>
              <p><strong>Capillary Refill Time</strong></p>
              <p class="description">Cara mengecek Capillary Refill Time anak, dengan cara Tekan kuku atau ujung jari selama beberapa detik, hal ini menyebabkan kulit di nail bed menjadi lebih putih. Setelah itu tekanan dilepaskan. <br>
                <strong>1. </strong>Normal, warna pink akan kembali normal dalam 2-3 detik<br>
                <strong>2. </strong>Memanjang, warna pink akan kembali normal kurang 2 detik <br>
                <strong>3. </strong>Minimal, warna pink akan kembali normal minimal 2 detik <br>
              </p> <br>
            </div>
            <div class="col-md-6">
              <p><strong>Pernapasan</strong></p>
              <p class="description">Cara mengetahui pernapasan anak: Posisikan anak serileks mungkin (Lebih baik dilakukan saat duduk di kursi atau berbaring di tempat tidur), Lalu, hitung berapa kali anak bernafas dengan cara melihat dada atau perut mengembang dalam satu menit. : <br>
                <strong>1. </strong> Normal (12 - 20 permenit ) <br>
                <strong>2. </strong> Cepat (lebih banyak atau lebih cepat dari normal ) <br>
                <strong>3. </strong> Dalam (dimana pada kondisi ini saat anak melakukan pernapasan anak melakukan pernapasan dengan cara menghirup oksigen dalam-dalam (kesusahan)) <br>
              </p> <br>
              <p><strong>Palpebra</strong></p>
              <p class="description">Untuk bisa mengetahui palpebra (kelopak mata) pada anak, lihat pada bagian mata anak (tepatnya pada bagian kelopak mata anak). <br>
                <strong>1. </strong>Normal (kelopak mata anak tidak cekung ) <br>
                <strong>2. </strong> Sedikit Cekung (Kelopak mata anak sedikit cekung) <br>
                <strong>3. </strong> Sangat Cekung (Kelopak mata anak sangat cekung) <br>
              </p> <br>
              <p><strong>Air Mata</strong></p>
              <p class="description">
                <strong>1. </strong>Normal <br>
                <strong>2. </strong>Berkurang<br>
                <strong>3. </strong>Tidak Ada<br>
              </p> <br>
              <p><strong>Mulut Dan Lidah</strong></p>
              <p class="description">Untuk mulut dan lidah, periksa pada bagian mulut dan lidah anak anda, apakah :<br>
                <strong>1. </strong>Lembab<br>
                <strong>2. </strong>Kering<br>
                <strong>3. </strong>Sangat Kering<br>
              </p> <br>
              <p><strong>Ekstremitas</strong></p>
              <p class="description">Cara mengetahui Ekstremitas pada anak dengan cara menyentuh bagian tangan dan kakinya :<br>
                <strong>1. </strong>Hangat, (terasa hangat apabila disentuh)<br>
                <strong>2. </strong>Dingin, (terasa dingin apabila disentu)<br>
              </p> <br>
              <p><strong>Produksi Urin</strong></p>
              <p class="description">Produksi Urin (air kecing) :<br>
                <strong>1. </strong>Normal<br>
                <strong>2. </strong>Menurun<br>
                <strong>3. </strong>Minimal<br>
              </p> <br>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Tentang Kami</h2>
        </div>

        <div class="row content">
          <div class="col-md-1"></div>
          <div class="col-md-9" data-aos="fade-up" data-aos-delay="150">
            <p>
              <strong><i>Diganosa Mandiri</i></strong> Sebuah website yang akan membantu para orang tua untuk mengetahui
              atau memantau kesehatan anak-anaknya terutama dalam penyakit diare yang kerap menyerang anak-anak, Dimana
              pada website ini para orang tua hanya perlu melakukan diagnosa secara mandiri yang ada pada menu
              <i>Diagnosa</i>, hanya dengan menjawab (mengisi) pertanyaan-pertanyaan (gejala-gejala) sesuai dengan kondisi yang dialami oleh anak,
              maka secara otomatis sistem akan mengeluarkan hasil diagnosa dan adapun hasil diagnosa bisa di download atau
              di cetak untuk menujukan langsung kepada dokter sehingga dokter akan langsung tahu dan memeriksa lebih
              lanjut untuk penyakit diare anak anda.
            </p> <br>
          </div>
        </div>
        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients clients">
          <div class="container">

            <div class="row">
              <div class="col-lg-4 col-md-4 col-4">
                <img src="assets/img/clients/rsi.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="200">
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <img src="assets/img/clients/kemkes.png" class="img-fluid" alt="" data-aos="zoom-in">
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <img src="assets/img/clients/pkm.jpg" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
              </div>
            </div>

          </div>
        </section><!-- End Clients Section -->
      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kontak Kami</h2>
        </div>

        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about">
              <h3>Diagnosa Mandiri</h3>
              <p> Sebuah website untuk melakukan diagnosa mandiri terhadap penyakit diare pada anak. </p>
              <div class="social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-5 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>Puskesmas Gangga<br>Kecamatan Gangga, Kabupaten Lombok Utara</p>
              </div>

              <div>
                <i class="ri-mail-send-line"></i>
                <p>iqballelouch9@gmail.com</p>
              </div>

              <div>
                <i class="ri-phone-line"></i>
                <p>+6283129108638</p>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-12 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>BaleeDev</strong>. All Rights Reserved
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>