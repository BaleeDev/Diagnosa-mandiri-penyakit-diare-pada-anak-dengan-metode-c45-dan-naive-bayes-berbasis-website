<?php
// sesion start
@session_start(); 
// memanggil fungsi koneksi ke database dari file db.php yang ada pada folder database  
include '../database/db.php';


// membuat fungsi untuk menampilkan data
function tampilData($pCek){
    global $conn;
    // mengecek kondisi untuk menampilkan data 
    if($pCek == ""){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_dataex ");
    }
    return $tampil;
}
// end fungsi
// membuat fungsi untuk menampilkan data atribut
function tampilDataAtrribut($pIdAtribut,$pCek){
    global $conn;
    // mengecek apakah ada id atribut yang dikirim 
    if($pIdAtribut == ""){
        $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut LIMIT 5");
    }elseif($pIdAtribut != ""){
        if($pCek == "1"){
            $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut != '$pIdAtribut' LIMIT 4");
        }elseif($pCek == "2"){
            $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut != '$pIdAtribut' LIMIT 3");
        }
    }
    return $tampil;
}
// end fungsi
// membuat fungsi untuk menghitung jumlah
function hitungJumlahTotal($pAtribut,$pClass,$pCek){
    global $conn;
    if($pCek == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex");
    }elseif($pCek == "1"){
        if($pAtribut == "Kehadiran" || $pAtribut == "Lingkungan" || $pAtribut == "Kerjasama" || $pAtribut == "Prakarsa" ){
            $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $pAtribut = '$pClass' ");
        }
    } 
    
    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi
// membuat fungsi untuk menghitung jumlah Ya
function hitungJumlahYa($pCek){
    global $conn;
    if($pCek == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi = 'Ya' ");
    }
    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi

// membuat fungsi untuk menghitung jumlah tidak
function hitungJumlahTidak($pCek){
    global $conn;
    if($pCek == ""){
        // ambil semua data yang ada pada database data
        $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi = 'Tidak' ");
    }
    // lakukan perhitungan data 
    $jumlah_data = mysqli_num_rows($data);
    return $jumlah_data;
}
// end fungsi
// membuat fungsi perhitungan entrhopy
function hitungEntrhopy($pCek){
    global $conn;
    if($pCek == ""){
        $jumlah_data_ya = hitungJumlahYa("");
        $jumlah_data_tidak = hitungJumlahTidak("");
        $jumlah_data = hitungJumlahTotal("","","");
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
?>

<!-- html -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Data</title>
  </head>
  <body>
    
    <!-- tabel Data-->
    <div class="container mt-3">
    <table class="table table-bordered">
    <thead>
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
            <?php
                // panggil fungsi tampilData dan simpan kedalam variabel
                //   membuat variable unutk nomor
                $no = 1;
                $tampil = tampilData("");
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

    <!--Tabel Perhitungan  -->
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
        $vJumlahData = hitungJumlahTotal("","","");
        $vJumlahYa = hitungJumlahYa("");
        $vJumlahTidak = hitungJumlahTidak("");
        $vEntrhopy = hitungEntrhopy("");
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
                            $jumlah_dataclass = hitungJumlahTotal("$nama_atribut","$nama_class","1");
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
    <!-- end perhitungan -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<!-- end html -->