<?php

$title = 'Daftar Mahasiswa';


session_start();
if (!isset($_SESSION["login"])){
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
    </script>";
exit;
}

if ($_SESSION["level"] !=1 and $_SESSION['level'] !=3){
    echo "<script>
        document.location.href = 'modal.php';
    </script>";
exit;
}

include 'layout/header.php';
$data_mahasiswa=select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>



<div class="container mt-5">
        <h1> Data Mahasiswa</h1>
        <hr>

        <a href="tambahMahasiswa.php" class="btn btn-primary mb-1"> <i class="fas fa-plus-circle"></i> Tambah</a>
        <a href="mahasiswaExcel.php" class="btn btn-success mb-1"> <i class="fas fa-file-excel"></i> Download excel</a>
        <a href="mahasiswaPDF.php" class="btn btn-danger mb-1"> <i class="fas fa-file-pdf"></i> Download PDF</a>


        <table class="table table-bordered table-striped mt-3" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nama</th>
                    <th>Prodi</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($data_mahasiswa as $mahasiswa) : ?>
                <tr>    
                <td><?= $no++; ?></td>
                <td><?=$mahasiswa['nama']?></td>
                <td><?=$mahasiswa['prodi']?></td>
                <td><?=$mahasiswa['jk']?></td>
                <td><?=$mahasiswa['telepon']?></td>
                <td><?=$mahasiswa['alamat']?></td>
                <td class="text-center" width="15%">
                    <a href="detailMahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm">Detail</a>
                    <a href="ubahMahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-primary btn-sm">Ubah</a>
                    <a href="hapusMahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('yakin ingin menghapus data mahasiswa')" >Hapus</a>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <?php include 'layout/footer.php'; ?>