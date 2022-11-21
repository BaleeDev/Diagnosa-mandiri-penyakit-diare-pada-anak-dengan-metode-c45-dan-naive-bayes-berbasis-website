<?php
@session_start();
include '../../database/db.php';
$delet = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE id='$_GET[id]'");
if ($delet) {
    echo "<script>
       alert('Hapus berhasil');
       document.location='data_pengguna.php';
       </script>";
} else {
    echo "<script>
       alert('Hapus gagal');
       document.location='data_pengguna.php';
       </script>";
}
