<?php

include 'config/app.php';

// menerima di_barang yang dipilih pengguna
$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0){
    echo"<script>
            alert('data akun berhasil dihapus');
            document.location.href = 'modal.php';
          </script>";
} else  {
    echo"<script>
            alert('data akun gagal dihapus');
            document.location.href = 'modal.php';
         </script>";
}


