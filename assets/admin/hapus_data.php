<?php
@session_start();
include '../../database/db.php';
$delet = mysqli_query($koneksi, "DELETE FROM tbl_semua_data WHERE id='$_GET[id]'");
if ($delet) {
    echo "<script>
       alert('Hapus berhasil');
       document.location='semua_data.php';
       </script>";
} else {
    echo "<script>
       alert('Hapus gagal');
       document.location='semua_data.php';
       </script>";
}
