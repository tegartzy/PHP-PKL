<?php
include 'layout/header.php';
?>

<?php
$id_barang = (int)$_GET['id_barang'];
$barang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang =  $id_barang");
while($data = mysqli_fetch_array($barang)){
    $id = $data['id_barang'];
    $nama = $data['nama'];
    $harga = $data['harga'];
    $jumlah = $data['jumlah'];
}
if (isset($_POST['tambah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
            alert('data barang berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('data barang gagal diubah');
            document.location.href = 'index.php';
        </script>";
    }
}

session_start();
if (!isset($_SESSION["login"])){
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
    </script>";
exit;
}
?>

<div class="container mt-5">
    <h1>Ubah Barang</h1>
    <hr>
    <form method="post" action=""> 
        <input type="hidden" name="id_barang" value="<?= $id; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama barang</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Nama barang..." required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" placeholder="Jumlah barang..." required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga barang</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" placeholder="Harga barang..." required>
        </div>
        <input type="submit" class="btn btn-primary" name="tambah" value="update" style="float: right ;" >
    </form>
</div>

<?php include 'layout/footer.php'; ?>