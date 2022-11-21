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

    //membuat fungsi untuk menampilkan data trainig
    function tampilData()
    {
        global $koneksi;
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_pengguna WHERE Status='Pegawai'");
        return $tampil;
    }

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>

            </div>
            <div class="card-body table-responsive">
                <?php
                if (@$_SESSION['Admin']) {
                ?>
                    <a href="tambah_data_pengguna.php" class="btn btn-outline-primary text-right">Tambah Data</a>
                <?php
                }
                ?>
                <div class="card-body table-responsive p-5" style="height: 450px;">
                    <table class="table table-responsive table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA PENGGUNA</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">TELEPON</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">STATUS</th>
                                <?php
                                if (@$_SESSION['Admin']) {
                                ?>
                                    <th scope="col">AKSI</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- memanggil fungsi tampil data -->
                            <?php
                            $nomor = 1;
                            $tampil = tampilData();
                            // cek apakah ada data pada database tbl_data
                            if ($tampil) {
                                if (mysqli_num_rows($tampil) > 0) {
                                    // lakukan perulangan selama data pada database tbl_data ada
                                    while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                        <tr>
                                            <th scope="row"><?= $nomor++ ?></th>
                                            <td><?php echo $row['Nama_Pengguna'] ?></td>
                                            <td><?php echo $row['Alamat'] ?></td>
                                            <td><?php echo $row['telepon'] ?></td>
                                            <td><?php echo $row['Email'] ?></td>
                                            <?php
                                            if ($row['Status'] == "Admin") {
                                            ?>
                                                <td><span class="badge badge-success"><?php echo $row['Status'] ?></span></td>
                                            <?php
                                            } elseif ($row['Status'] == "Pegawai") {
                                            ?>
                                                <td><span class="badge badge-info"><?php echo $row['Status'] ?></span></td>
                                            <?php
                                            }
                                            if (@$_SESSION['Admin']) {
                                            ?>
                                                <td>
                                                    <a href="edit_data_pengguna.php?id=<?= $row['id'] ?>" class="badge badge-warning">Edit</a>
                                                    <a href="hapus_data_pengguna.php?id=<?= $row['id'] ?>" id="hapus" data-id="{{$item->id}}" data-token="{{csrf_token()}}" data-url="{{route('barang.destroy',[$item->id])}}" data-target="#delete" class="badge badge-danger">Hapus</a>
                                                </td>
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