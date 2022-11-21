<?php 
  @session_start();   
  include '../database/db.php';

// ambil data 
$data = mysqli_query($conn, "SELECT*FROM tbl_data");


// hitung jumlah data 
$jumlah_data = mysqli_num_rows($data);


// hitung jumlah ya dan tidak
$data_tidak = mysqli_query($conn, "SELECT*FROM tbl_data WHERE hasil='Tidak'");
$data_ya = mysqli_query($conn, "SELECT*FROM tbl_data WHERE hasil='Ya'");
$jumlah_data_tidak = mysqli_num_rows($data_tidak);
$jumlah_data_ya = mysqli_num_rows($data_tidak);

// hitung entrhopy
$entrhopy = ((-$jumlah_data_ya / $jumlah_data) * log($jumlah_data_ya / $jumlah_data, 2) + (-$jumlah_data_tidak / $jumlah_data) * log($jumlah_data_tidak / $jumlah_data, 2));


// contoh 
$ent = 0.940285959;
$enr = 0.811278124;
$enc = 0.811278124;
$enk = 0;
$jr = 8;
$jc = 4;
$jk = 2;
$jd = 14;
// 


// hitung gain
$gain = ($ent) - (($jr / $jd) * $enr) - (($jc / $jd) * $enc) - (($jk / $jd) * $enk);

// cek banyak class dari setiap atribut


// hitung jumlah setiap class



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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
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
                  <!-- @foreach ($barang as $item) -->
                  <tr>
                    <td rowspan="2">Total</td>
                    <td></td>
                    <td><?= $jumlah_data?></td>
                    <td><?= $jumlah_data_ya?></td>
                    <td><?= $jumlah_data_tidak?></td>
                    <td><?= $entrhopy?></td>
                    <td><?= $gain?></td>
                    
                </tr>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>