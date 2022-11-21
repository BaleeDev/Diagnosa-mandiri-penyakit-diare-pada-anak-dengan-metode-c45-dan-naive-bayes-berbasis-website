<!-- Code PHP -->
<?php
// sesion start
@session_start(); 
// memanggil fungsi koneksi ke database dari file db.php yang ada pada folder database  
include '../database/db.php';

// membuat fungsi unutk menampilkan semua data kedalam tabel
function tampilData($pTahap,$pMax,$pIdAtribut,$pNamaAtribut){
    global $conn;
    // lakukan pengecekan jika parameter yang di kirim bernilai kosong
    if($pTahap == "" ){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_dataex ");
    }
    elseif($pIdAtribut != ""){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $pTahap = '$pMax' && $pIdAtribut = '$pNamaAtribut' ");
    }
    elseif($pTahap == "Kehadiran" || $pTahap == "Lingkungan" || $pTahap == "Kerjasama" || $pTahap == "Prakarsa" ){
            $tampil = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $pTahap = '$pMax' ");
    }
    elseif($pTahap == "1"){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_gain WHERE gain = '$pMax' ");
    }
    elseif($pTahap == "2"){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_gain WHERE gain = '$pMax' ");
    }
    return $tampil;
}

// membuat fungsi untuk menampilkan data atribut
function tampilDataAtrribut($pIdAtribut,$pCek){
    global $conn;
    // inisialisasi parameter
    $vpIdAtribut = $pIdAtribut;
    $vpCek = $pCek;
    // mengecek apakah ada id atribut yang dikirim 
    if($vpIdAtribut == "" && $vpCek == ""){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut LIMIT 5");
    }elseif($vpCek == "1"){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut != '$vpIdAtribut' ");
    }elseif($vpCek == "2"){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut != '$vpIdAtribut' LIMIT 3");
    }
    return $tampil;
}
// end fungsi

// membuat fungsi perhitungan jumlah data total
function hitungJumlahTotal($pAtribut,$pClass,$pTampungClass,$pNamaAtribut,$pTahap,$pNamaAtribut1,$pNamaClass){
    global $conn;
    // inisialisasi parameter
    $vpAtribut = $pAtribut;
    $vpClass = $pClass;
    $vpTampungClass = $pTampungClass;
    $vpNamaAtribut = $pNamaAtribut;
    $vpNamaAtribut1 = $pNamaAtribut1;
    $vpNamaClass = $pNamaClass;
    $vpTahap = $pTahap;
    // lakukan pengecekan jika parameter yang di kirim bernilai kosong
    if($vpAtribut == "" && $vpClass == "" && $vpTampungClass == "" && $vpNamaAtribut == "" && $vpTahap == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex");
    // untuk data NOD 1
    
    }
    elseif($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' ");
    }
    
    // untuk data NOD 1.1
    if($vpTahap == "1.1"){
        if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
            $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' && $vpNamaAtribut = '$vpTampungClass' ");
        }
    }
    // end data NOD 1.1

    // untuk data NOD 1.2
    if($vpTahap == "1.2"){
        if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
            $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' && $vpNamaAtribut = '$vpTampungClass' && $vpNamaAtribut1 = '$vpNamaClass' ");
        }
    }
    // end data NOD 1.2

    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi

// membuat fungsi perhitungan total jumlah data ya
function hitungJumlahYa($pAtribut,$pClass,$pTampungClass,$pNamaAtribut){
    global $conn;
    // inisialisasi parameter
    $vpAtribut = $pAtribut;
    $vpClass = $pClass;
    $vpTampungClass = $pTampungClass;
    $vpNamaAtribut = $pNamaAtribut;
    // lakukan pengecekan jika parameter yang di kirim bernilai kosong
    if($vpAtribut == "" && $vpClass == "" && $vpTampungClass == "" && $vpNamaAtribut == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi = 'Ya' ");
    }
    if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' &&  Rekomendasi = 'Ya' ");
    }
    // untuk data NOD 1.1
    if($vpTampungClass != ""){
        if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
            $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' && $vpNamaAtribut = '$vpTampungClass' &&  Rekomendasi = 'Ya' ");
        }
    }
    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi

// membuat fungsi perhitungan total jumlah data tidak
function hitungJumlahTidak($pAtribut,$pClass,$pTampungClass,$pNamaAtribut){
    global $conn;
    // inisialisasi parameter
    $vpAtribut = $pAtribut;
    $vpClass = $pClass;
    $vpTampungClass = $pTampungClass;
    $vpNamaAtribut = $pNamaAtribut;
    // lakukan pengecekan jika parameter yang di kirim bernilai kosong
    if($vpAtribut == "" && $vpClass == "" && $vpTampungClass == "" && $vpNamaAtribut == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi = 'Tidak' ");
    }
    if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' &&  Rekomendasi = 'Tidak' ");
    }
    // untuk data NOD 1.1
    if($vpTampungClass != ""){
        if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
            $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vpAtribut = '$vpClass' && $vpNamaAtribut = '$vpTampungClass' &&  Rekomendasi = 'Tidak' ");
        }
    }
    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi

// membuat fungsi perhitungan entrhopy
function hitungEntrhopy($pAtribut,$pClass,$pTampungClass,$pNamaAtribut){
    global $conn;
    // inisialisasi parameter kedalam variabel
    $vpAtribut = $pAtribut;
    $vpClass = $pClass;
    $vpTampungClass = $pTampungClass;
    $vpNamaAtribut = $pNamaAtribut;
    // lakukan pengecekan jika parameter yang di kirim bernilai kosong
    if($vpAtribut == "" ){
        $jumlah_data_ya = hitungJumlahYa("","","","");
        $jumlah_data_tidak = hitungJumlahTidak("","","","");
        $jumlah_data = hitungJumlahTotal("","","","","","","");
    }
    if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
        $jumlah_data_ya = hitungJumlahYa("$vpAtribut","$vpClass","","");
        $jumlah_data_tidak = hitungJumlahTidak("$vpAtribut","$vpClass","","");
        $jumlah_data = hitungJumlahTotal("$vpAtribut","$vpClass","","","","","");
    }
    // untuk data NOD 1.1
    if($vpTampungClass != ""){
        if($vpAtribut == "Kehadiran" || $vpAtribut == "Lingkungan" || $vpAtribut == "Kerjasama" || $vpAtribut == "Prakarsa" ){
            $jumlah_data_ya = hitungJumlahYa("$vpAtribut","$vpClass","$vpTampungClass","$vpNamaAtribut");
            $jumlah_data_tidak = hitungJumlahTidak("$vpAtribut","$vpClass","$vpTampungClass","$vpNamaAtribut");
            $jumlah_data = hitungJumlahTotal("$vpAtribut","$vpClass","$vpTampungClass","$vpNamaAtribut","1.1","","");
        }
    }
    $entrhopy = ((-$jumlah_data_ya / $jumlah_data) * log($jumlah_data_ya / $jumlah_data, 2) + (-$jumlah_data_tidak / $jumlah_data) * log($jumlah_data_tidak / $jumlah_data, 2));
    return $entrhopy;
}
// end fungsi

// membuat fungsi untuk menampilkan nama-nama class 
    function tampilDataClass($idAtribut){
        global $conn;
        $vIdAtribut = $idAtribut;
        $tampilData = mysqli_query($conn, "SELECT*FROM tbl_class WHERE id_atribut = $vIdAtribut");
        return $tampilData;
    }
// end fungsi

// membuat fungsi untuk menympan hasil perhitungan Gain kedalam database Gain
function simpanDataGain($pTahap,$pIdAtribut,$pGain){
    global $conn;
    // inisialisasi parameter
    $vpTahap = $pTahap;
    $vpIdAtribut = $pIdAtribut;
    $vpGain = $pGain;
    $simpan= mysqli_query($conn, "INSERT INTO tbl_gain (tahap,id_atribut,gain)
                  VALUES ('$vpTahap','$vpIdAtribut','$vpGain')
                    ");
    return $simpan;
}

// end fungsi
// membuat fungsi untuk menympan hasil perhitungan Gain kedalam database Gain
function simpanDataEntrhopy($pTahap,$pIdAtribut,$pNamaClass,$pEntrhopy){
    global $conn;
    // inisialisasi parameter
    $vpTahap = $pTahap;
    $vpIdAtribut = $pIdAtribut;
    $vpNamaClass = $pNamaClass;
    $vpEntrhopy = $pEntrhopy;
    $simpan= mysqli_query($conn, "INSERT INTO tbl_entrhopy (tahap,id_atribut,nama_class,entrhopy) 
    VALUES ('$vpTahap','$vpIdAtribut','$vpNamaClass','$vpEntrhopy')  ");
    return $simpan;
}
function simpanDataPerhitungan($pTahap,$pkehadiran,$plingkungan,$pkerjasama,$pprakarsa,$prekomendasi){
    global $conn;

    $simpan= mysqli_query($conn, "INSERT INTO tbl_perhitungan (tahap,kehadiran,lingkungan,kerjasama,prakarsa,rekomendasi) 
    VALUES ('$pTahap','$pkehadiran','$plingkungan','$pkerjasama','$pprakarsa','$prekomendasi')  ");
    return $simpan;
}

// end fungsi

// membuat fungsi untuk menampilkan id atribut berdasarkan nilai gain max yang ada pada database gain
function tampilDataMaxGain($pTahap){
    global $conn;
    // inisialisasi parameter
    $vpTahap = $pTahap;
    $tampil = mysqli_query($conn, "SELECT*FROM tbl_gain WHERE tahap = '$vpTahap' ");
    while($row= mysqli_fetch_array($tampil)){
        $gain[] = $row['gain'];
    }
    return max($gain);
}
// end fungsi 

// array tampung jumlah
$jum = [];
// array tampung entrhopy
$en = [];
// array tampung gain
$ga1 = [];

// menampung id atribut
$vtIdAtribut="";
$cek = 1;
$vTahap = 1;        
$noid = 1;
$i = 2;

$tampungIdentrhopy = [];
$tampungentrhopy = [];
$tampungNamaClass = [];
?>
<!-- end code PHP -->

<!-- html -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
 <!-- membuat tabel -->
    <div class="container mt-5">
        <h2>Tabel Data</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">NO</th>
      <th scope="col">KEHADIRAN</th>
      <th scope="col">LINGKUNGAN</th>
      <th scope="col">KERJASAMA</th>
      <th scope="col">PRAKARSA</th>
      <th scope="col">REKOMENDASI</th>
    </tr>
  </thead>
  <tbody>
      <!-- memanggil fungsi tampilData -->
      <!-- siyntak php -->
      <?php 
    //   membuat variable unutk nomor
    $no = 1;
        // panggil fungsi tampilData dan simpan kedalam variabel
        $tampil = tampilData("","","","");
        // mengecek apakah ada data yang tersimpan didalam variabel tampil
        if($tampil){
            if(mysqli_num_rows($tampil)>0){
                while($row=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <th scope="row"><?= $no++?></th>
                        <td><?php echo $row['Kehadiran']?></td>
                        <td><?php echo $row['Lingkungan']?></td>
                        <td><?php echo $row['Kerjasama']?></td>
                        <td><?php echo $row['Prakarsa']?></td>
                        <td><?php echo $row['Rekomendasi']?></td>
                        </tr>
               <?php 
            }
            $no++;   
            }
        }
      
      ?>
      <!-- end php -->
    <!-- end fungsi tampilData -->
  </tbody>
</table>
    </div>
<!-- end tabel -->
<!-- membuat tabel perhitungan Entrhopy dan Gain NODE 1 -->
    <div class="container mt-3">
        <h2>Tabel Perhitungan Entrhopy Dan Gain NODE 1</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">JUMLAH (S)</th>
      <th scope="col">YA (S)</th>
      <th scope="col">TIDAK (S)</th>
      <th scope="col">ENTRHOPY</th>
      <th scope="col">GAIN</th>
    </tr>
  </thead>
  <tbody>
      <!-- menampilkan data atribut dan perhitungan entrhopy beserta gainnya -->
      <!-- siyntak PHP -->
      <?php
    //   menampung data atribut dari fungsi tampilDataAtribut kedalam variabel
        $vTampil = tampilDataAtrribut("","");
        $vJumlahData = hitungJumlahTotal("","","","","","","");
        $vJumlahYa = hitungJumlahYa("","","","");
        $vJumlahTidak = hitungJumlahTidak("","","","");
        $vEntrhopy = hitungEntrhopy("","","","");
        // mengecek apakah ada data 
            if(mysqli_num_rows($vTampil)){
                while($dat=mysqli_fetch_array($vTampil)){
                    // mengecek apakah nama atribut = Total
                    if($dat['nama_atribut'] == "Total"){
                        // maka langsung tampilkan hasil perhitungan dari total data baik Entrhopynya
                       ?>
                    <tr>
                        <td><?php echo $dat['nama_atribut']?></td>
                        <td></td>
                        <td><?= $vJumlahData?></td>
                        <td><?= $vJumlahYa?></td>
                        <td><?= $vJumlahTidak?></td>
                        <td><?= $vEntrhopy?></td>
                    </tr>
               <?php
                    }else{
                        $id_tahap[$noid++] = $i++;
                        // tampung id atribut kedalam variabel
                        $IdAtribut = $dat['id_atribut'];
                        // memanggil fungsi tampilDataClass
                        $vAtribut = tampilDataClass($IdAtribut);
                        $vbanyak_data = mysqli_num_rows($vAtribut);
                        ?>
                        <tr>
                             <td rowspan="<?= $vbanyak_data?>"><?php echo $dat['nama_atribut']?></td>
                <?php
                    $vJum = 1;
                    $vEn = 1;
                    $nooo = 1;
                     if(mysqli_num_rows($vAtribut)){
                        while($dat1= mysqli_fetch_array($vAtribut)){  
                            //menampung nama class kedalam variabel
                            $nama_class = $dat1['nama_class'];
                            // menampung nama atribut kedalm variabel
                            $nama_atribut = $dat['nama_atribut']; 
                            //menghitung jumlah data sesuai dengan class dengan memanggil fungsi hitungJumlahTotal
                            $jumlah_dataclass = hitungJumlahTotal("$nama_atribut","$nama_class","","","","","");
                            // menghitung banyak data sesuai dengan ya tidak pada setiap class
                            $jumlah_dataya = hitungJumlahYa("$nama_atribut","$nama_class","","");
                            // Tidak
                            $jumlah_datatidak = hitungJumlahTidak("$nama_atribut","$nama_class","","");

                            // hitung entrhopy
                            $dataEntrhopy = hitungEntrhopy("$nama_atribut","$nama_class","","");
                            // mengubah nilai data NAN menjadi 0
                            if(is_nan($dataEntrhopy)){
                                $dataEntrhopy = 0;
                              }
                            // end
                            ?>
                            <td><?php echo $dat1['nama_class']?></td>
                            <td><?= $jumlah_dataclass?></td>
                            <td><?= $jumlah_dataya?></td>
                            <td><?= $jumlah_datatidak?></td>
                            <td><?= $dataEntrhopy?></td>
                        </tr>
                        <?php
                        // simpan nilai entrhopy kedalam database entrhopy
                        // simpanDataEntrhopy('1',$id_tahap[$cek],$dat1['nama_class'],$dataEntrhopy);
                            // menyimpan sementara data entrhopy dan gain kedalam array
                            $jum[$vJum++] = $jumlah_dataclass;
                            $en[$vEn++] = $dataEntrhopy;
                        }
                    }
                    ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php
                     // menghitung gain
                        $gain = ($vEntrhopy) - (($jum[1] / $vJumlahData) * $en[1]) - (($jum[2] / $vJumlahData) * $en[2]) - (($jum[3] / $vJumlahData) * $en[3]);
                        // menyimpan data hasil perhitungan kedalam database gain
                        // simpanDataGain($vTahap,$id_tahap[$cek],$gain);
                    ?>
                    <td><?= $gain?></td>
                </tr>
               <?php 
               $cek++;    
                }
                }
            }
      ?>
      <!-- end PHP -->
      <!-- end perhitungan -->
  </tbody>
</table>
    </div>
<!-- end tabel perhitungan -->

<!-- membuat tabel Data Tahap 2 -->
<div class="container mt-5">
        <h2>Tabel Data Tahap 2</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">NO</th>
      <th scope="col">KEHADIRAN</th>
      <th scope="col">LINGKUNGAN</th>
      <th scope="col">KERJASAMA</th>
      <th scope="col">PRAKARSA</th>
      <th scope="col">REKOMENDASI</th>
    </tr>
  </thead>
  <tbody>
      <!-- memanggil fungsi tampilData -->
      <!-- siyntak php -->
      <?php 
    //   membuat variable unutk nomor
    $no = 1;
        // panggil fungsi nilai max pada gain
        $vmax = tampilDataMaxGain('1');
        // mengecek apakah ada data yang ada pada database Gain
        $tampilTahap2 = tampilData("1","$vmax","","");
        // mengambil id atribut
        $datamax = mysqli_fetch_array($tampilTahap2);
        if($datamax){
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vatribut = $datamax['id_atribut']; 
           // echo $vatribut;
        }
        // menampilkan nama atribut berdasarkan nilai max gain
        $tampilatribut = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut = '$vatribut' ");
        $dataatribut = mysqli_fetch_array($tampilatribut);
        if($dataatribut)
        {
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vnamaatribut = $dataatribut['nama_atribut'];
            $vtIdAtribut = $dataatribut['id_atribut'];
        }
        // menampilkan data entrhopy berdasarkan atribut nilai max dan nilai entrhopy lebih besar atau tidak sama dengan 0
        $a=1;
        $tampilentrhopy = mysqli_query($conn, "SELECT*FROM tbl_entrhopy WHERE id_atribut = '$vatribut' && entrhopy > 0 && tahap = 1");
        if(mysqli_num_rows($tampilentrhopy)){
          while($dentrhopy= mysqli_fetch_array($tampilentrhopy)){
            $tampungentrhopy[$a] = $dentrhopy['nama_class'];
            $tampungclass[$a] = $dentrhopy['nama_class'];
            $tampungIdentrhopy[$a] = $dentrhopy['id_atribut'];
            $a++;
          }
        }

        // menampilkan semua data dengan menggunakan perulangan berdasarkan data atribut nilai max yang pertama
        $pTahap = 1;
        for($i=0; $i <= count($tampungentrhopy); $i++){
            
            $tampungNamaClass[$i] = $tampungentrhopy[$i];
            $tampildatabaru = tampilData("$vnamaatribut","$tampungentrhopy[$i]","","");
          if(mysqli_num_rows($tampildatabaru)){
            while($databaru= mysqli_fetch_array($tampildatabaru)){
                // simpanDataPerhitungan($pTahap,$databaru['Kehadiran'],$databaru['Lingkungan'],$databaru['Kerjasama'],$databaru['Prakarsa'],$databaru['Rekomendasi']);
          ?><tr>
          <td><?= $no++?></td>
          <td><?php echo $databaru['Kehadiran']?></td>
          <td><?php echo $databaru['Lingkungan']?></td>
          <td><?php echo $databaru['Kerjasama']?></td>
          <td><?php echo $databaru['Prakarsa']?></td>
          <td><?php echo $databaru['Rekomendasi']?></td>
        </tr>
      <?php } 
    }
  }?>
      <!-- end php -->
    <!-- end fungsi tampilData -->
  </tbody>
</table>
    </div>
<!-- end tabel tahap 2 -->

<!-- membuat tabel perhitungan Entrhopy dan Gain NODE 1.1-->
<div class="container mt-3">
        <h2>Tabel Perhitungan Entrhopy Dan Gain NODE 1.1</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">JUMLAH (S)</th>
      <th scope="col">YA (S)</th>
      <th scope="col">TIDAK (S)</th>
      <th scope="col">ENTRHOPY</th>
      <th scope="col">GAIN</th>
    </tr>
  </thead>
  <tbody>
      <!-- menampilkan data atribut dan perhitungan entrhopy beserta gainnya -->
      <!-- siyntak PHP -->
      <?php
    //   menampung data atribut dari fungsi tampilDataAtribut kedalam variabel
        $vTampil = tampilDataAtrribut("$vtIdAtribut","1");
        $vJumlahData = hitungJumlahTotal("","","","","","","");
        $vJumlahYa = hitungJumlahYa("","","","");
        $vJumlahTidak = hitungJumlahTidak("","","","");
        $vEntrhopy = hitungEntrhopy("","","","");
        $cek = 1;
        // mengecek apakah ada data 
            if(mysqli_num_rows($vTampil)){
                while($dat=mysqli_fetch_array($vTampil)){
                    // mengecek apakah nama atribut = Total
                    if($dat['nama_atribut'] == "Total"){
                        // maka langsung tampilkan hasil perhitungan dari total data baik Entrhopynya
                       ?>
                    <tr>
                        <td><?php echo $dat['nama_atribut']?></td>
                        <td></td>
                        <td><?= $vJumlahData?></td>
                        <td><?= $vJumlahYa?></td>
                        <td><?= $vJumlahTidak?></td>
                        <td><?= $vEntrhopy?></td>
                    </tr>
               <?php
                    }else{
                        $id_tahap[$noid++] = $i++;
                        // tampung id atribut kedalam variabel
                        $IdAtribut = $dat['id_atribut'];
                        // memanggil fungsi tampilDataClass
                        $vAtribut = tampilDataClass($IdAtribut);
                        $vbanyak_data = mysqli_num_rows($vAtribut);
                        ?>
                        <tr>
                             <td rowspan="<?= $vbanyak_data?>"><?php echo $dat['nama_atribut']?></td>
                <?php
                    $vJum = 1;
                    $vEn = 1;
                    $nooo1 = 1;
                    $i = 1;
                     if(mysqli_num_rows($vAtribut)){
                        while($dat1= mysqli_fetch_array($vAtribut)){  
                            //menampung nama class kedalam variabel
                            $nama_class = $dat1['nama_class'];
                            // menampung nama atribut kedalm variabel
                            $nama_atribut = $dat['nama_atribut']; 
                            //menghitung jumlah data sesuai dengan class dengan memanggil fungsi hitungJumlahTotal
                            $jumlah_dataclass = hitungJumlahTotal("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut","1.1","","");
                            // menghitung banyak data sesuai dengan ya tidak pada setiap class
                            $jumlah_dataya = hitungJumlahYa("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");
                            // Tidak
                            $jumlah_datatidak = hitungJumlahTidak("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");

                            // hitung entrhopy
                            $dataEntrhopy = hitungEntrhopy("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");
                            // mengubah nilai data NAN menjadi 0
                            if(is_nan($dataEntrhopy)){
                                $dataEntrhopy = 0;
                              }
                            // end
                            ?>
                            <td><?php echo $dat1['nama_class']?></td>
                            <td><?= $jumlah_dataclass?></td>
                            <td><?= $jumlah_dataya?></td>
                            <td><?= $jumlah_datatidak?></td>
                            <td><?= $dataEntrhopy?></td>
                        </tr>
                        <?php
                        // simpan nilai entrhopy kedalam database entrhopy
                        // simpanDataEntrhopy('2',$id_tahap[$cek],$dat1['nama_class'],$dataEntrhopy);
                            // menyimpan sementara data entrhopy dan gain kedalam array
                            $jum[$vJum++] = $jumlah_dataclass;
                            $en[$vEn++] = $dataEntrhopy;
                        }
                    }
                    ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php
                     // menghitung gain
                        $gain1 = ($vEntrhopy) - (($jum[1] / $vJumlahData) * $en[1]) - (($jum[2] / $vJumlahData) * $en[2]) - (($jum[3] / $vJumlahData) * $en[3]);
                        // menyimpan data hasil perhitungan kedalam database gain
                        // simpanDataGain('2',$id_tahap[$cek],$gain1);
                    ?>
                    <td><?= $gain1?></td>
                </tr>
               <?php 
               $cek++;    
                }
                }
            }
      ?>
      <!-- end PHP -->
      <!-- end perhitungan -->
  </tbody>
</table>
    </div>
<!-- end tabel perhitungan -->

<!-- membuat tabel Data Tahap 2.1 -->
<div class="container mt-5">
        <h2>Tabel Data Tahap 2.1</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">NO</th>
      <th scope="col">KEHADIRAN</th>
      <th scope="col">LINGKUNGAN</th>
      <th scope="col">KERJASAMA</th>
      <th scope="col">PRAKARSA</th>
      <th scope="col">REKOMENDASI</th>
    </tr>
  </thead>
  <tbody>
      <!-- memanggil fungsi tampilData -->
      <!-- siyntak php -->
      <?php 
    //   membuat variable unutk nomor
    $no = 1;
        // panggil fungsi nilai max pada gain
        $vmax = tampilDataMaxGain('2');
        $tampilTahap2 = tampilData("2","$vmax","","");
        // mengambil id atribut
        $datamax = mysqli_fetch_array($tampilTahap2);
        if($datamax){
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vatribut = $datamax['id_atribut']; 
        }
        // menampilkan nama atribut berdasarkan nilai max gain
        $tampilatribut = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut = '$vatribut' ");
        $dataatribut = mysqli_fetch_array($tampilatribut);
        if($dataatribut)
        {
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vnamaatribut = $dataatribut['nama_atribut'];
            $vtIdAtribut = $dataatribut['id_atribut'];
        }
        // menampilkan data entrhopy berdasarkan atribut nilai max dan nilai entrhopy lebih besar atau tidak sama dengan 0
        $tampungentrhopy = [];
        $a=1;
        $tampilentrhopy = mysqli_query($conn, "SELECT*FROM tbl_entrhopy WHERE id_atribut = '$vatribut' && entrhopy > 0 && tahap = 2 ");
        if(mysqli_num_rows($tampilentrhopy)){
          while($dentrhopy= mysqli_fetch_array($tampilentrhopy)){
            $tampungentrhopy[$a] = $dentrhopy['nama_class'];
            $tampungclass[$a] = $dentrhopy['nama_class'];
            $a++;
          }
        }
        // menampilkan semua data dengan menggunakan perulangan berdasarkan data atribut nilai max yang pertama
        for($i=0; $i <= count($tampungentrhopy); $i++){
            // memanggil nama atribut dari data perhitungan pertama yaitu prakarsa
        $tampilatribut = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut = '$tampungIdentrhopy[$i]' ");
        $dataatribut = mysqli_fetch_array($tampilatribut);
        if($dataatribut)
        {
            //jika data ditemukan maka data di tampung dulu ke variabel
            $vnamaatribut1 = $dataatribut['nama_atribut'];
        }
            $tampildatabaru = tampilData("$vnamaatribut","$tampungentrhopy[$i]","$vnamaatribut1","$tampungNamaClass[$i]");
            // $tampildatabaru = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vnamaatribut = '$tampungentrhopy[$i]' && Prakarsa = 'Kurang Inisiatif' ");
          if(mysqli_num_rows($tampildatabaru)){
            while($databaru= mysqli_fetch_array($tampildatabaru)){
          ?><tr>
          <td><?= $no++?></td>
          <td><?php echo $databaru['Kehadiran']?></td>
          <td><?php echo $databaru['Lingkungan']?></td>
          <td><?php echo $databaru['Kerjasama']?></td>
          <td><?php echo $databaru['Prakarsa']?></td>
          <td><?php echo $databaru['Rekomendasi']?></td>
        </tr>
      <?php } 
    }
  }?>
      <!-- end php -->
    <!-- end fungsi tampilData -->
  </tbody>
</table>
    </div>
<!-- end tabel tahap 2.1 -->

<!-- membuat tabel perhitungan Entrhopy dan Gain NODE 1.2-->
<div class="container mt-3">
        <h2>Tabel Perhitungan Entrhopy Dan Gain NODE 1.2</h2>
    <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">JUMLAH (S)</th>
      <th scope="col">YA (S)</th>
      <th scope="col">TIDAK (S)</th>
      <th scope="col">ENTRHOPY</th>
      <th scope="col">GAIN</th>
    </tr>
  </thead>
  <tbody>
      <!-- menampilkan data atribut dan perhitungan entrhopy beserta gainnya -->
      <!-- siyntak PHP -->
      <?php
    //   menampung data atribut dari fungsi tampilDataAtribut kedalam variabel
        $vTampil = tampilDataAtrribut("$vtIdAtribut","2");
        $vJumlahData = hitungJumlahTotal("","","","","","","");
        $vJumlahYa = hitungJumlahYa("","","","");
        $vJumlahTidak = hitungJumlahTidak("","","","");
        $vEntrhopy = hitungEntrhopy("","","","");
        $cek = 1;
        // mengecek apakah ada data 
            if(mysqli_num_rows($vTampil)){
                while($dat=mysqli_fetch_array($vTampil)){
                    // mengecek apakah nama atribut = Total
                    if($dat['nama_atribut'] == "Total"){
                        // maka langsung tampilkan hasil perhitungan dari total data baik Entrhopynya
                       ?>
                    <tr>
                        <td><?php echo $dat['nama_atribut']?></td>
                        <td></td>
                        <td><?= $vJumlahData?></td>
                        <td><?= $vJumlahYa?></td>
                        <td><?= $vJumlahTidak?></td>
                        <td><?= $vEntrhopy?></td>
                    </tr>
               <?php
                    }else{
                        $id_tahap[$noid++] = $i++;
                        // tampung id atribut kedalam variabel
                        $IdAtribut = $dat['id_atribut'];
                        // memanggil fungsi tampilDataClass
                        $vAtribut = tampilDataClass($IdAtribut);
                        $vbanyak_data = mysqli_num_rows($vAtribut);
                        ?>
                        <tr>
                             <td rowspan="<?= $vbanyak_data?>"><?php echo $dat['nama_atribut']?></td>
                <?php
                    $vJum = 1;
                    $vEn = 1;
                    $nooo1 = 1;
                    $i = 1;
                     if(mysqli_num_rows($vAtribut)){
                        while($dat1= mysqli_fetch_array($vAtribut)){  
                             // memanggil nama atribut dari data perhitungan pertama yaitu prakarsa
                            $tampilatribut = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut = '$tampungIdentrhopy[$i]' ");
                            $dataatribut = mysqli_fetch_array($tampilatribut);
                            if($dataatribut)
                            {
                                //jika data ditemukan maka data di tampung dulu ke variabel
                                $vnamaatribut1 = $dataatribut['nama_atribut'];
                            }
                            //menampung nama class kedalam variabel
                            $nama_class = $dat1['nama_class'];
                            // menampung nama atribut kedalm variabel
                            $nama_atribut = $dat['nama_atribut']; 
                            //menghitung jumlah data sesuai dengan class dengan memanggil fungsi hitungJumlahTotal
                            $jumlah_dataclass = hitungJumlahTotal("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut","1.2","$vnamaatribut1","$tampungNamaClass[$i]");
                            // menghitung banyak data sesuai dengan ya tidak pada setiap class
                            $jumlah_dataya = hitungJumlahYa("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");
                            // Tidak
                            $jumlah_datatidak = hitungJumlahTidak("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");

                            // hitung entrhopy
                            $dataEntrhopy = hitungEntrhopy("$nama_atribut","$nama_class","$tampungclass[$i]","$vnamaatribut");
                            // mengubah nilai data NAN menjadi 0
                            if(is_nan($dataEntrhopy)){
                                $dataEntrhopy = 0;
                              }
                            // end
                            ?>
                            <td><?php echo $dat1['nama_class']?></td>
                            <td><?= $jumlah_dataclass?></td>
                            <td><?= $jumlah_dataya?></td>
                            <td><?= $jumlah_datatidak?></td>
                            <td><?= $dataEntrhopy?></td>
                        </tr>
                        <?php
                        // simpan nilai entrhopy kedalam database entrhopy
                        // simpanDataEntrhopy('2',$id_tahap[$cek],$dat1['nama_class'],$dataEntrhopy);
                            // menyimpan sementara data entrhopy dan gain kedalam array
                            $jum[$vJum++] = $jumlah_dataclass;
                            $en[$vEn++] = $dataEntrhopy;
                        }
                    }
                    ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php
                     // menghitung gain
                        $gain1 = ($vEntrhopy) - (($jum[1] / $vJumlahData) * $en[1]) - (($jum[2] / $vJumlahData) * $en[2]) - (($jum[3] / $vJumlahData) * $en[3]);
                        // menyimpan data hasil perhitungan kedalam database gain
                        // simpanDataGain('2',$id_tahap[$cek],$gain1);
                    ?>
                    <td><?= $gain1?></td>
                </tr>
               <?php 
               $cek++;    
                }
                }
            }
      ?>
      <!-- end PHP -->
      <!-- end perhitungan -->
  </tbody>
</table>
    </div>
<!-- end tabel perhitungan -->

<!-- java Script -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<!-- end html -->