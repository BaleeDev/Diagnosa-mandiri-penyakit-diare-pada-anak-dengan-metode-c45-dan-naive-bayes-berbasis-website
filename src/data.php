<?php 
  @session_start();   
  include '../database/db.php';
?>

<section class="content">
    <div class="container-fluid">
    <!-- /.row -->
    <div class="row my-3">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
             <a href="tambah_barang.php" class="btn btn-outline-dark">Tambah Barang</a>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Rp.</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- @foreach ($barang as $item) -->
                  <?php 
                  $no = 1;
                  $tampil = mysqli_query($conn, "SELECT*FROM tbl_data order by id_data desc");
                  if(mysqli_num_rows($tampil)){
                    while($dat= mysqli_fetch_array($tampil)){
                  ?>
                  <tr>
                    <td><?= $no++?></td>
                    <td><?php echo $dat['jenis_kelamin']?></td>
                    <td>Rp. <?php echo $dat['usia']?></td>
                    <td><?php echo $dat['frekuensi_bab']?></td>
                    <td><?php echo $dat['konsisten_tinja']?></td>
                    <td><?php echo $dat['keadaan_mata']?></td>
                    <td><?php echo $dat['keadaan_turgor']?></td>
                    <td><?php echo $dat['keinginan_minum']?></td>
                    <td><?php echo $dat['keadaan_umum']?></td>
                    <td><?php echo $dat['hasil']?></td>
                    <td>
                      <a href="edit.php?id=<?=$dat['id']?>" class="badge badge-info">Edit</a>
                      <a href="hapus.php?id=<?=$dat['id']?>" id="hapus" data-id="{{$item->id}}" data-token="{{csrf_token()}}" data-url="{{route('barang.destroy',[$item->id])}}" data-target="#delete" class="badge badge-danger">Hapus</a>
                    </td>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->