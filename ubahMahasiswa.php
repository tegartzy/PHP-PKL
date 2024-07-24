<?php 
$title = 'Tambah Mahasiswa';
include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])){
    if (update_mahasiswa($_POST) > 0){
        echo"<script>
                alert('data mahasiswa berhasil diubah');
                document.location.href = 'mahasiswa.php';
                </script>";
    } else  {
        echo"<script>
                alert('data mahasiswa gagal diubah');
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

}

$id_mahasiswa = (int)$_GET['id_mahasiswa'];
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5">
    <h1>Ubah mahasiswa</h1>
    <hr>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?php echo $mahasiswa['id_mahasiswa']; ?>" >
        <input type="hidden" name="fotolama" value="<?php echo $mahasiswa['foto']; ?>" >
        
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama"  placeholder="Nama Mahasiswa....." Required value="<?php echo $mahasiswa['nama'];?>">
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control" Required>
                    <?php $prodi = $mahasiswa['prodi']; ?>
                    <option value="Teknik Informatika" <?php echo $prodi == 'Teknik Informatika' ? 'selected' : null; ?>>--Teknik Informatika--</option>
                    <option value="Teknik Mesin" <?php echo $prodi == 'Teknik Mesin' ? 'selected' : null; ?>>--Teknik Mesin--</option>
                    <option value="Teknik Listrik" <?php echo $prodi == 'Teknik Listrik' ? 'selected' : null; ?>>--Teknik Listrik--</option>
                    <option value="Pernapasan api" <?php echo $prodi == 'Teknik Pernapasan api' ? 'selected' : null; ?>>--Pernapasan api--</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" Required>
                    <option value="">--Jenis Kelamin--</option>
                    <option value="Laki-Laki" <?php echo $mahasiswa['jk'] == 'Laki-Laki' ? 'selected' : null; ?>>--Laki-Laki--</option>
                    <option value="Perempuan" <?php echo $mahasiswa['jk'] == 'Perempuan' ? 'selected' : null; ?>>--Perempuan--</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon....." Required value="<?php echo $mahasiswa['telepon'];?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">alamat</label>
            <textarea name="alamat" id="alamat"><?= $mahasiswa['alamat'];?></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email....." Required value="<?php echo $mahasiswa['email'];?>">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto....." Required>
            <p>
                <small></small>
            </p>
            <img src="assets/img/<?php echo $mahasiswa['foto'];?>" alt="foto" width="100px">
        </div>
        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;"> <i class="fas fa-plus"></i> Tambah</button>
    </form>

</div>

<?php include 'layout/footer.php'; ?>