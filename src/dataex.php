<?php 
  @session_start();   
  include '../database/db.php';

// array tampung jumlah
$jum = [];
// array tampung entrhopy
$en = [];
// array tampung gain
$ga = [];
// tampung id tahap
$id_tahap = [];


// tampung class smentara
$tampungclass = [];
  // ambil data 
$data = mysqli_query($conn, "SELECT*FROM tbl_dataex");


// hitung jumlah data 
$jumlah_data = mysqli_num_rows($data);

// hitung jumlah ya dan tidak
$data_tidak = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi='Tidak'");
$data_ya = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi='Ya'");
$jumlah_data_tidak = mysqli_num_rows($data_tidak);
$jumlah_data_ya = mysqli_num_rows($data_ya);

// hitung entrhopy
$entrhopy = ((-$jumlah_data_ya / $jumlah_data) * log($jumlah_data_ya / $jumlah_data, 2) + (-$jumlah_data_tidak / $jumlah_data) * log($jumlah_data_tidak / $jumlah_data, 2));

// hitung gain
// $gain = ($entrhopy) - (($jr / $jd) * $enr) - (($jc / $jd) * $enc) - (($jk / $jd) * $enk);


// fungsi untuk menghitung jumlah atribut kehadiran
function jumlahKehadiran ($class){

    // ambil data 
// $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Kehadiran = 'Rajin' ");


// hitung jumlah data 
// $jumlah_data = mysqli_num_rows($data);

// // hitung jumlah ya dan tidak
// $data_tidak = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi='Tidak'");
// $data_ya = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE Rekomendasi='Ya'");
// $jumlah_data_tidak = mysqli_num_rows($data_tidak);
// $jumlah_data_ya = mysqli_num_rows($data_ya);

// return $jumlah_data;
}

?>

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
  <section class="content">
    <div class="container-fluid">
    <!-- /.row -->
    <div class="row my-3">
        <div class="col-12">
          <div class="card">
            <h1>Tabel Data</h1>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kehadiran</th>
                    <th>Lingkungan</th>
                    <th>Kerjasama</th>
                    <th>Prakarsa</th>
                    <th>Rekomendasi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- @foreach ($barang as $item) -->
                  <?php 
                  $no = 1;
                  $tampil = mysqli_query($conn, "SELECT*FROM tbl_dataex ");
                  if(mysqli_num_rows($tampil)){
                    while($dat= mysqli_fetch_array($tampil)){
                  ?>
                  <tr>
                    <td><?= $no++?></td>
                    <td><?php echo $dat['Kehadiran']?></td>
                    <td><?php echo $dat['Lingkungan']?></td>
                    <td><?php echo $dat['Kerjasama']?></td>
                    <td><?php echo $dat['Prakarsa']?></td>
                    <td><?php echo $dat['Rekomendasi']?></td>
                  </tr>
                <?php } 
              }?>
                  <!-- @endforeach -->
                </tbody>
              </table>
              <!-- {{$barang->links()}} -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    <!-- /.row -->
    <div class="container-fluid mt-5">
    <h1>Tabel Perhitungan Entrhopy Dan Gain Tahap 1</h1>
    <div class="row my-3">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-bordered table-hover text-nowrap">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>Jumlah (s)</th>
                    <th>Ya (Si)</th>
                    <th>Tidak (Si)</th>
                    <th>Entrophy</th>
                    <th>Gain</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $noid = 1;
                  $cek = 1;
                  $i = 2;
                  $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut LIMIT 5");
                  if(mysqli_num_rows($tampil)){
                    while($dat= mysqli_fetch_array($tampil)){
                      if($dat['nama_atribut'] == "Total"){
                  ?>
                  <tr>
                    <td><?php echo $dat['nama_atribut']?></td>
                    <td></td>
                    <td><?= $jumlah_data?></td>
                    <td><?= $jumlah_data_ya?></td>
                    <td><?= $jumlah_data_tidak?></td>
                    <td><?= $entrhopy?></td>
                    <td><?= $gain?></td>
                </tr>
                
                <?php }else{ 
                  $id_at = $dat['id_atribut'];
                  $tampil1 = mysqli_query($conn, "SELECT*FROM tbl_class WHERE id_atribut = $id_at");
                  $banyak_data = mysqli_num_rows($tampil1);
                  $id_tahap[$noid++] = $i++;
                  ?>
                  <tr>
                  <td rowspan="<?= $banyak_data?>"><?php echo $dat['nama_atribut']?></td>
                  
                  <?php
                  $no = 1;
                  $noo = 1;
                  $nooo = 1;
                  
                  if(mysqli_num_rows($tampil1)){
                    while($dat1= mysqli_fetch_array($tampil1)){
                      $nama_class = $dat1['nama_class'];
                      $nama_atribut = $dat['nama_atribut'];
                      //menghitung jumlah data sesuai dengan class
                      $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' ");
                      $jumlah_dataclass = mysqli_num_rows($data);

                      // menghitung banyak data sesuai dengan ya tidak pada setiap class
                      $dataya = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' &&  Rekomendasi = 'Ya' ");
                      $jumlah_dataya = mysqli_num_rows($dataya);
                      // Tidak
                      $datatidak = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' &&  Rekomendasi = 'Tidak' ");
                      $jumlah_datatidak = mysqli_num_rows($datatidak);

                      // hitung entrhopy
                      $dataEntrhopy = ((-$jumlah_dataya / $jumlah_dataclass) * log($jumlah_dataya / $jumlah_dataclass, 2) + (-$jumlah_datatidak / $jumlah_dataclass) * log($jumlah_datatidak / $jumlah_dataclass, 2));
                      if(is_nan($dataEntrhopy)){
                        $dataEntrhopy = 0;
                      }
  
                  ?>
                  
                  <td><?php echo $dat1['nama_class']?></td>
                  <td><?= $jumlah_dataclass?></td>
                  <td><?= $jumlah_dataya?></td>
                  <td><?= $jumlah_datatidak?></td>
                  <td><?= $dataEntrhopy?></td>
                  
                  </tr>
                  <?php 
                  
                  // menambahkan data ke tbl entrhopy
        //           $simpan= mysqli_query($conn, "INSERT INTO tbl_entrhopy (id_atribut,nama_class,entrhopy)
        // VALUES ('$id_tahap[$cek]','$dat1[nama_class]','$dataEntrhopy')
        //     ");
                  $jum[$no++] = $jumlah_dataclass;
                  $en[$noo++] = $dataEntrhopy;
                  
                    }

                  }
                  // $cek++;
                  ?>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <?php
                  // menghitung gain
                  $gain = ($entrhopy) - (($jum[1] / $jumlah_data) * $en[1]) - (($jum[2] / $jumlah_data) * $en[2]) - (($jum[3] / $jumlah_data) * $en[3]);
                  $ga[$nooo++] = $gain;
                  // $simpan= mysqli_query($conn, "INSERT INTO tbl_gain (id_atribut,gain)
                  // VALUES ('$id_tahap[$cek]','$gain')
                  //   ");
                  ?>
                  <td><?= $gain?></td>
                </tr>
                <?php 
                $cek++;
                }
                
                    }
                    // echo max($ga)."<br>";
                    // echo $id_tahap[1];
                    // echo $id_tahap[2];
                    // echo $id_tahap[3];
                    // echo $id_tahap[4];
                    // echo $id_tahap[5];
                    
          }
          ?>
                </tbody>
              </table>
              <!-- {{$barang->links()}} -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->



    <!-- tabel data Tahap 2 -->
    <div class="container-fluid">
     <!-- /.row -->
     <div class="row my-3">
        <div class="col-12">
          <div class="card">
            <h1>Tabel Data Tahap 2</h1>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kehadiran</th>
                    <th>Lingkungan</th>
                    <th>Kerjasama</th>
                    <th>Prakarsa</th>
                    <th>Rekomendasi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- @foreach ($barang as $item) -->
                  <?php 
                  $no = 1;

                // menampilkan atribut dari nilai max
                $max = max($ga);
                $tampilmax = mysqli_query($conn, "SELECT*FROM tbl_gain WHERE gain = '$max' ");
                $datamax = mysqli_fetch_array($tampilmax);
                if($datamax)
                {
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
                    // echo $vnamaatribut;
                }
                // mengecek apakah ada nilai entrhopy = 0
                $tampungentrhopy = [];
                $a=1;
                $tampilentrhopy = mysqli_query($conn, "SELECT*FROM tbl_entrhopy WHERE id_atribut = '$vatribut' && entrhopy > 0");
                if(mysqli_num_rows($tampilentrhopy)){
                  while($dentrhopy= mysqli_fetch_array($tampilentrhopy)){
                    $tampungentrhopy[$a] = $dentrhopy['nama_class'];
                    $tampungclass[$a] = $dentrhopy['nama_class'];
                    $a++;
                  }
                }

                // menampilkan semua data dengan menggunakan perulangan
                for($i=0; $i < count($tampungentrhopy); $i++){
                  // echo $tampungentrhopy[$i]."<br>";
                  $tampildatabaru = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $vnamaatribut = '$tampungentrhopy[$i]' ");
                  if(mysqli_num_rows($tampildatabaru)){
                    while($databaru= mysqli_fetch_array($tampildatabaru)){
                  ?>
                  <tr>
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
                  <!-- @endforeach -->
                </tbody>
              </table>
              <!-- {{$barang->links()}} -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      <!-- tabel data tahap 2 -->

      <!-- tabel perhitungna tahap 2 -->
      <div class="container-fluid mt-5">
    <h1>Tabel Perhitungan Entrhopy Dan Gain Tahap 1.1</h1>
    <div class="row my-3">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-bordered table-hover text-nowrap">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>Jumlah (s)</th>
                    <th>Ya (Si)</th>
                    <th>Tidak (Si)</th>
                    <th>Entrophy</th>
                    <th>Gain</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $noid = 1;
                  $cek = 1;
                  $i = 2;
                  
                  $tampil = mysqli_query($conn, "SELECT*FROM tbl_atribut WHERE id_atribut != '5' LIMIT 4");
                  if(mysqli_num_rows($tampil)){
                    while($dat= mysqli_fetch_array($tampil)){
                      if($dat['nama_atribut'] == "Total"){
                        
                  ?>
                  <tr>
                    <td><?php echo $dat['nama_atribut']?></td>
                    <td></td>
                    <td><?= $jumlah_data?></td>
                    <td><?= $jumlah_data_ya?></td>
                    <td><?= $jumlah_data_tidak?></td>
                    <td><?= $entrhopy?></td>
                </tr>
                
                <?php }else{ 
                  $id_at = $dat['id_atribut'];
                  $tampil1 = mysqli_query($conn, "SELECT*FROM tbl_class WHERE id_atribut = $id_at");
                  $banyak_data = mysqli_num_rows($tampil1);
                  $id_tahap[$noid++] = $i++;
                  ?>
                  <tr>
                  <td rowspan="<?= $banyak_data?>"><?php echo $dat['nama_atribut']?></td>
                  
                  <?php
                  $no = 1;
                  $noo = 1;
                  $nooo = 1;
                  $i = 1;
                  if(mysqli_num_rows($tampil1)){
                    while($dat1= mysqli_fetch_array($tampil1)){
                      $nama_class = $dat1['nama_class'];
                      $nama_atribut = $dat['nama_atribut'];
                      //mtampungclassenghitung jumlah data sesuai dengan class
                      $data = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' && $vnamaatribut = '$tampungclass[$i]' ");
                      $jumlah_dataclass = mysqli_num_rows($data);
                      
                      // menghitung banyak data sesuai dengan ya tidak pada setiap class
                      $dataya = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' &&  Rekomendasi = 'Ya' && $vnamaatribut = '$tampungclass[$i]' ");
                      $jumlah_dataya = mysqli_num_rows($dataya);
                      // Tidak
                      $datatidak = mysqli_query($conn, "SELECT*FROM tbl_dataex WHERE $nama_atribut = '$nama_class' &&  Rekomendasi = 'Tidak' && $vnamaatribut = '$tampungclass[$i]' ");
                      $jumlah_datatidak = mysqli_num_rows($datatidak);

                      // hitung entrhopy
                      $dataEntrhopy = ((-$jumlah_dataya / $jumlah_dataclass) * log($jumlah_dataya / $jumlah_dataclass, 2) + (-$jumlah_datatidak / $jumlah_dataclass) * log($jumlah_datatidak / $jumlah_dataclass, 2));
                      if(is_nan($dataEntrhopy)){
                        $dataEntrhopy = 0;
                      }
  
                  ?>
                  
                  <td><?php echo $dat1['nama_class']?></td>
                  <td><?= $jumlah_dataclass?></td>
                  <td><?= $jumlah_dataya?></td>
                  <td><?= $jumlah_datatidak?></td>
                  <td><?= $dataEntrhopy?></td>
                  
                  </tr>
                  <?php 
                  
                  // menambahkan data ke tbl entrhopy
        //           $simpan= mysqli_query($conn, "INSERT INTO tbl_entrhopy (id_atribut,nama_class,entrhopy)
        // VALUES ('$id_tahap[$cek]','$dat1[nama_class]','$dataEntrhopy')
        //     ");
                  $jum[$no++] = $jumlah_dataclass;
                  $en[$noo++] = $dataEntrhopy;
                  
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
                  $gain = ($entrhopy) - (($jum[1] / $jumlah_data) * $en[1]) - (($jum[2] / $jumlah_data) * $en[2]) - (($jum[3] / $jumlah_data) * $en[3]);
                  $ga[$nooo++] = $gain;
                  // $simpan= mysqli_query($conn, "INSERT INTO tbl_gain (id_atribut,gain)
                  // VALUES ('$id_tahap[$cek]','$gain')
                  //   ");
                  ?>
                  <td><?= $gain?></td>
                </tr>
                <?php 
                $cek++;
                }
                
                    }
                    
          }
          ?>
                </tbody>
              </table>
              <!-- {{$barang->links()}} -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
      <!-- tabel perhitungan tahap 2 -->
</section>
<!-- /.content -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
