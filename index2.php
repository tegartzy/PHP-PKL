<?php
session_start();
//membatasi halaman sebelum login
if (!isset($_SESSION["login"])){
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
    </script>";
exit;
}

//membatasi halaman sesuai user login
if ($_SESSION["level"] !=1 and $_SESSION['level'] !=2){
    echo "<script>
        document.location.href = 'modal.php';
    </script>";
exit;
}


$title = 'Daftar Barang';
include 'layout/header.php';
$data_barang = select("SELECT * FROM barang ORDER BY id_barang ASC");


?>
    <div class="container mt-5">
        <h1> Data Barang</h1>
        <hr>

        <a href="tambah-barang.php" class="btn btn-primary mb-1"> <i class="fas fa-plus-circle"></i> Tambah</a>

        <table class="table table-bordered table-striped mt-3" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nama</th>
                    <th>jumlah</th>
                    <th>harga</th>
                    <th>Barcode</th>
                    <th>tanggal</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($data_barang as $barang) : ?>
                <tr>    
                <td><?= $no++; ?></td>
                <td><?= $barang['nama']; ?></td>
                <td><?= $barang['jumlah']; ?></td>
                <td>Rp. <?= number_format($barang['harga'],0,',','.'); ?></td>
                <td class="text-center">
                    <img alt="barcode" src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode'];?>&print=true"/> 
                </td>
                <td><?= date('d-m-Y|H:i:s',strtotime($barang['tanggal'])); ?></td>
                <td width="20%" class="text-center">
                    <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"> ubah</a>
                    <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger"></i> Hapus</a>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
<?php include 'layout/footer.php';?>