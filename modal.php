<?php
session_start();
if (!isset($_SESSION["login"])){
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
    </script>";
exit;
}


$title = 'Daftar akun';
include 'layout/header.php';
$data_akun = select("SELECT * FROM akun");

$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");


if (isset($_POST['tambah'])){
    if (create_akun($_POST) > 0){
        echo"<script>
                alert('data akun berhasil ditambahkan');
                document.location.href = 'modal.php';
                </script>";
    } else  {
        echo"<script>
                alert('data akun gagal ditambahkan');
                document.location.href = 'modal.php';
                </script>";
    }
}
if (isset($_POST['ubah'])){
    if (ubah_akun($_POST) > 0){
        echo"<script>
                alert('data akun berhasil diubah');
                document.location.href = 'modal.php';
                </script>";
    } else  {
        echo"<script>
                alert('data akun gagal diubah');
                document.location.href = 'modal.php';
                </script>";
    }
}
?>


    <div class="container mt-5">
        <h1> Data akun</h1>
        <hr>

        <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal"
        data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i>Tambah</button>
        <?php endif; ?>  

        <table class="table table-bordered table-striped mt-3" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; ?>
            <?php if ($_SESSION['level'] == 1) : ?>
                <?php foreach($data_akun as $akun) : ?>
                <tr>    
                <td><?= $no++; ?></td>
                <td><?=$akun['nama'];?></td>
                <td><?=$akun['username'];?></td>
                <td><?=$akun['email'];?></td>
                <td>Password ter-enkripsi</td>
                <td class="text-center" width="15%">
                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?=$akun['id_akun'];?>">Ubah</button>
                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?=$akun['id_akun'];?>" onclick="return confirm('Yakin ingin menghapus')"> Hapus </button>
                </td>
                </tr>
                <?php endforeach;?>
                <?php else : ?>
                  <?php foreach($data_bylogin as $akun) : ?>
                <tr>    
                <td><?= $no++; ?></td>
                <td><?=$akun['nama'];?></td>
                <td><?=$akun['username'];?></td>
                <td><?=$akun['email'];?></td>
                <td>Password ter-enkripsi</td>
                <td class="text-center" width="15%">
                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?=$akun['id_akun'];?>">Ubah</button>

                </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>

        </table>
    </div>



<!-- Untuk Menambah data -->
<div class="modal fade" id="modalTambah" tabindex="-1" 
aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Tambah akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" Required>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" Required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" Required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" Required minlength="6">
          </div>

          <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select id="level" name="level" class="form-control" Required>
              <option value="">Pilih Opsi</option>
              <option value="1">Admin</option>
              <option value="2">Operator barang</option>
              <option value="3">Operator mahasiswa</option>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Untuk menghapus data -->
<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data akun: <?= $akun['nama']; ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <a href="hapusAkun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- untuk mengubah barang -->
<?php foreach ($data_akun as $akun) :?>
<div class="modal fade" id="modalUbah<?=$akun['id_akun'];?>" tabindex="-1" 
aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">ubah akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" name="id_akun" value="<?=$akun['id_akun'];?>">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" Required value="<?=$akun['nama'];?>">
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" Required value="<?=$akun['username'];?>">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" Required value="<?=$akun['email'];?>">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password<small> (masukan password baru/lama)</small></label>
            <input type="password" id="password" name="password" class="form-control" Required minlength="6">
          </div>

        <?php if ($_SESSION['level'] == 1) : ?>
          <div class="mb-3">
            <label for="level">Level</label>
            <select id="level" name="level" class="form-control" Required>
              <?php $level = $akun['level'];?>
              <option value="1" <?= $akun['level'] == '1' ? 'selected' : null?>>admin</option>
              <option value="2" <?= $akun['level'] == '2' ? 'selected' : null?>>operator barang</option>
              <option value="3" <?= $akun['level'] == '3' ? 'selected' : null?>>operator operator mahasiswa</option>
            </select>
          </div>
          <?php else : ?>
            <input type="hidden" name="level" value="<?= $akun['level']?>">
          <?php endif; ?>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" name="ubah" class="btn btn-primary">hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>

    
<?php include 'layout/footer.php';?>