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
        $tampil = mysqli_query($koneksi, "SELECT*FROM tbl_user WHERE Status='Aktif'");
        return $tampil;
    }
    $tgl = date("Y-m-d");
    $jam = date("H:i:s");
    $vKode = "DM" . $tgl . $jam;

    include 'Layout/header.php';
?>
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>

            </div>
            <div class="card-body table-responsive">
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    <table class="table table-responsive table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NIK</th>
                                <th scope="col">NAMA PENGGUNA</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">TELEPON</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AKSI</th>


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
                                            <td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['alamat'] ?></td>
                                            <td><?php echo $row['telepon'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <?php
                                            if ($row['status'] == "Aktif") {
                                            ?>
                                                <td><span class="badge badge-success"><?php echo $row['status'] ?></span></td>
                                            <?php
                                            } elseif ($row['status'] == "Belum Aktif") {
                                            ?>
                                                <td><span class="badge badge-info"><?php echo $row['status'] ?></span></td>
                                            <?php
                                            }
                                            ?>
                                            <td>
                                                <?php
                                                if ($row['status'] != "Aktif") {
                                                ?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?= $row['telepon'] ?>&text=Untuk%20mengaktifikan%20akun%20anda%20silahkan%20kelik%20link%20berikut%20http://localhost/diagnosa/aktifasi.php?nik=<?= $row['nik'] ?>" class="badge badge-warning">Aktifkan</a>
                                                <?php } else { ?>
                                                    <a href="hapus_data_user.php?id=<?= $row['nik'] ?>" id="hapus" data-id="{{$item->id}}" data-token="{{csrf_token()}}" data-url="{{route('barang.destroy',[$item->id])}}" data-target="#delete" class="badge badge-danger">Hapus</a>
                                                <?php } ?>
                                            </td>

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