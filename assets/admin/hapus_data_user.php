<?php
@session_start();
include '../../database/db.php';
$delet = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE nik='$_GET[id]'");
if ($delet) {
    echo "<script>
       alert('Hapus berhasil');
       document.location='data_user.php';
       </script>";
} else {
    echo "<script>
       alert('Hapus gagal');
       document.location='data_user.php';
       </script>";
}
