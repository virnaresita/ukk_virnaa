<?php 
require "../../config/config.php"; 

$id = $_GET["id"];
if(deleteAdmin($id) > 0) {
    echo "<script>
    alert('Admin/petugas berhasil dihapus!');
    document.location.href = 'user.php';
    </script>";
  }else {
    echo "<script>
    alert('Admin gagal dihapus!');
    document.location.href = 'user.php';
    </script>";
}
?>
