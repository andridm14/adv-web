<?php
session_start();

//  block halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
    document.location.href = 'error.php';
    </script>";
    exit;
}
include 'layout/header.php';

$akun = select("SELECT * FROM user");

// update users
if (isset($_POST['editUser'])) {
    if (update_users($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href='account.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diupdate');
        document.location.href='account.php';
        </script>";
    }
}

// tambah users
if (isset($_POST['tambahUser'])) {
    if (tambah_user($_POST) > 0) {
        echo "<script>
        alert('Data user Berhasil Ditambah');
        document.location.href='account.php';
        </script>";
    } else {
        echo "<script>
        alert('Data user Gagal Ditambah');
        document.location.href='account.php';
        </script>";
    }
}

?>
<!-- Account Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="index.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
            <h6 class="mb-0">Data Users</h6>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fa fa-add"></i></button>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-striped mt-3" id="myTables">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID User</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($akun as $ac) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $ac['id_user']; ?></td>
                            <td><?= $ac['nm_user']; ?></td>
                            <td><?= $ac['username']; ?></td>
                            <td><?= $ac['password']; ?></td>
                            <td><?= $ac['role']; ?></td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $ac['id_user']; ?>">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $ac['id_user']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Index End -->

<!-- modal tambah user -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama User</label>
                            <input type="hidden" name="id_user" id="id_user">
                            <input type="text" class="form-control" name="nm_user" id="nm_user" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required minlength="5">
                        </div>
                        <div class=" mb-3">
                            <label for="recipient-name" class="col-form-label">Role</label>
                            <select id="jenis_servis" class="form-select" name="role" id="role">
                                <option selected>Pilih role user</option>
                                <option value="1">- Officers</option>
                                <option value="2">- Customers</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                            <button type="submit" name="tambahUser" class="btn btn-primary"><i class="fa fa-check"></i>Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- end -->

<?php foreach ($akun as $ac) : ?>
    <!-- Modal update-->
    <div class="modal fade" id="modalUbah<?= $ac['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ID User</label>
                            <input type="text" class="form-control" name="id_user" id="id_user" value="<?= $ac['id_user']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama User</label>
                            <input type="text" class="form-control" name="nm_user" id="nm_user" value="<?= $ac['nm_user']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?= $ac['username']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class=" mb-3">
                            <label for="recipient-name" class="col-form-label">Role</label>
                            <select id="jenis_servis" class="form-select" name="role" id="role">
                                <?php $role = $ac['role']; ?>
                                <option value="1" <?= $role == '1' ? 'selected' : null ?>>Officers</option>
                                <option value="2" <?= $role == '2' ? 'selected' : null ?>>Customers</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                            <button type="submit" name="editUser" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="modalHapus<?= $ac['id_user'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <p>Yakin akan menghapus data user : <?= $ac['nm_user'];?></p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                            <a href="accountDelete.php?id_user=<?= $ac['id_user'];?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete Users</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Recent End -->


<?php
include 'layout/footer.php';
?>