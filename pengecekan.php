<?php
session_start();

//  block halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
    document.locatin.href = 'error.php';
    </script>";
    exit;
}

include 'layout/header.php';

$data = select("SELECT * FROM tb_saran 
INNER JOIN tb_servis ON tb_saran.id_servis = tb_servis.id_servis
INNER JOIN user ON tb_servis.id_user = user.id_user");

// fun tambah
if (isset($_POST['tambahSrn'])) {
    if (tambahSrn($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='pengecekan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='pengecekan.php';
        </script>";
    }
}

// fun edit
if (isset($_POST['editSaran'])) {
    if (update_saran($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href='pengecekan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diupdate');
        document.location.href='pengecekan.php';
        </script>";
    }
}
?>

<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <a href="index.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="mb-0">Kelola Pengecekan</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <button type="submit" name="tambah" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fa fa-add"></i> Saran</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="tablePkb">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">Nomor STNK</th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Saran</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $d['stnk']; ?></td>
                            <td><?= $d['id_servis']; ?> | <?= $d['nm_user']; ?></td>
                            <td><?= $d['jenis_servis']; ?></td>
                            <td><?= $d['keluhan']; ?></td>
                            <td><?= $d['saran']; ?></td>
                            <td>
                                <button type="button" name="button" class="btn btn-outline-info mb-2" data-bs-toggle="modal" data-bs-target="#edit<?= $d['id_saran']; ?>"><i class="fa fa-edit"></i></button>

                                <button type="button" name="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $d['id_saran']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent End -->

<!-- modal - tambah saran -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Saran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label class="col-form-label">ID Service</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="id_saran" id="id_saran">
                            <select class="form-select form-select-sm mb-3" name="id_servis" id="id_servis" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <?php
                                $data = mysqli_query($db, "SELECT * FROM tb_saran
                                INNER JOIN tb_servis ON tb_saran.id_servis = tb_servis.id_servis
                                INNER JOIN user ON tb_servis.id_user = user.id_user");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_servis']; ?>"><?= $d['id_servis']; ?> - <?= $d['nm_user']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Nomor STNK</label>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm mb-3" name="stnk" id="stnk" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <?php
                                $data = mysqli_query($db, "SELECT * FROM tb_saran");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['stnk']; ?>"><?= $d['stnk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Saran Service</label>
                        <input type="text" class="form-control" name="saran" id="saran" style="height: 120px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                        <button type="submit" name="tambahSrn" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal - edit saran -->
<?php foreach ($data as $d) : ?>
    <div class="modal fade" id="edit<?= $d['id_saran']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Saran Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="" method="post">

                        <div class="mb-3">
                            <label class="col-form-label">ID Saran</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_saran" id="id_saran" value="<?= $d['id_saran']; ?>" readonly>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Nomor STNK</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="stnk" id="stnk" value="<?= $d['stnk']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">ID Service</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_servis" id="id_servis" value="<?= $d['id_servis']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Saran Service</label>
                            <input type="text" class="form-control" name="saran" id="saran" style="height: 120px;" value="<?= $d['saran']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                            <button type="submit" name="editSaran" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal delete -->
    <div class="modal fade" id="hapus<?= $d['id_saran']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Saran Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <p>Yakin menghapus : <?= $d['saran']; ?></p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                            <a href="pengecekanDelete.php?id_saran=<?= $d['id_saran']; ?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete Pengecekan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
include 'layout/footer.php';
?>