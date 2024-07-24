<?php

include 'config/app.php';

// menerima di_barang yang dipilih pengguna
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

if (delete_mahasiswa($id_mahasiswa) > 0){
    echo"<script>
            alert('data mahasiswa berhasil dihapus');
            document.location.href = 'mahasiswa.php';
          </script>";
} else  {
    echo"<script>
            alert('data mahasiswa gagal dihapus');
            document.location.href = 'mahasiswa.php';
         </script>";
}

session_start();
if (!isset($_SESSION["login"])){
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
    </script>";
exit;
}