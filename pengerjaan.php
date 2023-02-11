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

$datap = select("SELECT * FROM tb_pengerjaan
INNER JOIN tb_servis ON tb_pengerjaan.id_Servis = tb_servis.id_servis
INNER JOIN tb_kendaraan ON tb_servis.stnk = tb_kendaraan.stnk");

// fun tambah
if (isset($_POST['tambahPgj'])) {
    if (tambahPgj($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='pengerjaan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='pengerjaan.php';
        </script>";
    }
}

// fun edit
if (isset($_POST['editPgj'])) {
    if (update_pgj($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href='pengerjaan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diupdate');
        document.location.href='pengerjaan.php';
        </script>";
    }
}

?>
<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="index.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Kelola Pengerjaan Service</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <button type="submit" name="tambahPgj" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPgj">Tambah Pengerjaan</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="tablePkb">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Nomor STNK</th>
                        <th scope="col">Pengerjaan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Estimasi</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datap as $d) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $d['id_pgj']; ?> - <?= $d['id_servis']; ?></td>
                            <td><?= $d['stnk']; ?></td>
                            <td><?= $d['pgj']; ?></td>
                            <td><?= $d['ket']; ?></td>
                            <td><?= $d['estimasi']; ?></td>
                            <td>
                                <button type="button" name="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#edit<?= $d['id_pgj']; ?>"><i class="fa fa-edit"></i></button>
                            
                                <button type="button" name="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $d['id_pgj']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent End -->

<!-- modal - tambah pengerjaan -->
<div class="modal fade" id="tambahPgj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengerjaan Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label class="col-form-label">ID Service</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="id_pgj" id="id_pgj">
                            <select class="form-select form-select-sm mb-3" name="id_servis" id="id_servis" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <?php
                                $data = mysqli_query($db, "SELECT * FROM tb_servis
                                INNER JOIN user ON tb_servis.id_user = user.id_user");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_servis']; ?>"><?= $d['id_servis']; ?> - <?= $d['stnk']; ?> - <?= $d['nm_user']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="col-form-label">Nomor STNK</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="id_servis" id="id_servis">
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
                    </div> -->
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pengerjaan Service</label>
                        <input type="text" class="form-control" name="pgj" id="pgj" placeholder="Pengerjaan">
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0">Keterangan Service</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ket" id="gridRadios1" value="Proses" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Proses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ket" id="gridRadios2" value="Selesai">
                                <label class="form-check-label" for="gridRadios2">
                                    Selesai
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Estimasi Service</label>
                        <input type="text" class="form-control" name="estimasi" id="estimasi" placeholder="Rp.">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                        <button type="submit" name="tambahPgj" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<?php foreach ($datap as $d) : ?>
    <div class="modal fade" id="edit<?= $d['id_pgj']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Pengerjaan Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">

                        <div class="mb-3">
                            <label class="col-form-label">ID Pengerjaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_pgj" id="id_pgj" value="<?= $d['id_pgj']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">ID Service</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_servis" id="id_servis" value="<?= $d['id_servis']; ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Pengerjaan Service</label>
                            <input type="text" class="form-control" name="pgj" id="pgj" value="<?= $d['pgj']; ?>">
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-4 pt-0">Keterangan Service</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ket" id="gridRadios1" value="Proses" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Proses
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ket" id="gridRadios2" value="Selesai">
                                    <label class="form-check-label" for="gridRadios2">
                                        Selesai
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Estimasi Service</label>
                            <input type="text" class="form-control" name="estimasi" id="estimasi" value="<?= $d['estimasi']; ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                            <button type="submit" name="editPgj" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="hapus<?= $d['id_pgj'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengerjaan Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <p>Yakin menghapus data pengerjaan : <?= $d['pgj'];?></p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                            <a href="pengerjaanDelete.php?id_pgj=<?= $d['id_pgj'];?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete Pengerjaan</a>
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