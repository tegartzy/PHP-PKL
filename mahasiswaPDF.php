<?php

session_start();
//Membatasi halaman sebelum login
if(!isset($_SESSION["login"])){
    echo "<script>
    alert('anda belum login');
    document.location.href = 'login.php';
    </script>
    ";
    exit;
}
// membatasi halaman sesuai user login
if($_SESSION["level"] != 1 and $_SESSION["level"] != 3){
    echo "<script>
    alert('anda tidak memiliki hak akses');
    document.location.href = 'crud-modal.php';
    </script>
    ";
    exit;
}

require __DIR__.'vendor/autoload.php';

require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;


$data_barang = select("SELECT * From barang");

$content .= '<style type="text/css>
    .gambar (
        width: 50px;
    )
</style>';

$content .= '
<page>
    <table border="1" align="center">
    <tr>
        <th>No<th>
        <th>Nama<th>
        <th>program studi<th>
        <th>Jenis kelamin<th>
        <th>Telepon<th>
        <th>Email<th>
        <th>Foto<th>
        </tr>';

        $no=1;
        foreach ($data_barang as $barang){
            $content .='
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$barang['nama'].'</td>
                    <td>'.$barang['prodi'].'</td>
                    <td>'.$barang['jk'].'</td>
                    <td>'.$barang['telepon'].'</td>
                    <td>'.$barang['email'].'</td>
                    <td><img src="assets/img/assets/img/'.$barang['foto'].'"class="gambar"></td>
                <tr>
                ';
}

$content .='
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('Laporan-Mahasiswa.pdf');
