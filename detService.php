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

// query detail service
$id_servis = $_GET['id_servis'];
$data = select("SELECT * FROM tb_servis 
INNER JOIN user ON tb_servis.id_user = user.id_user
INNER JOIN tb_saran ON tb_servis.id_servis = tb_saran.id_saran
WHERE tb_servis.id_servis='$id_servis'");

// query pengerjaan
$pgj = select("SELECT * FROM tb_pengerjaan 
INNER JOIN tb_servis ON tb_pengerjaan.id_servis = tb_servis.id_servis 
WHERE tb_servis.id_servis=$id_servis");

// BUTTON tambah pengerjaan
if (isset($_POST['tambahPgj'])) {
    if (tambahPgj($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='service.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='service.php';
        </script>";
    }
}

// BUTTON tambah pengerjaan
if (isset($_POST['tambahSrn'])) {
    if (tambahSrn($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='service.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='service.php';
        </script>";
    }
}

?>

<!-- Recent tabel detail servis Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="service.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Service Customer</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="tableDetail">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Nomor STNK</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Model</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $dt) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $dt['id_servis']; ?></td>
                            <td><?= $dt['stnk']; ?></td>
                            <td><?= $dt['nm_user']; ?></td>
                            <td><?= $dt['model']; ?></td>
                            <td><?= $dt['jenis_servis']; ?></td>
                            <td><?= $dt['keluhan']; ?></td>
                            <td><?= date('d/m/Y', strtotime($dt['tgl'])); ?></td>
                            <td>
                                <a class="btn btn-sm btn-dark" href=""><i class="fa fa-gear"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent detail servis End -->

<!-- Recent tabel pengerjaan Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Pengerjaan</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-add"></i> Service
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="TablePgj">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Pengerjaan</th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Pengerjaan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Estimasi</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pgj as $p) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $p['id_pgj']; ?></td>
                            <td><?= $p['id_servis']; ?></td>
                            <td><?= $p['pgj']; ?></td>
                            <td><?= $p['ket']; ?></td>
                            <td>Rp. <?= number_format($p['estimasi'], 0, ',', '.'); ?></td>
                            <td>
                                <a class="btn btn-warning" href="editPgj.php?id_pgj=<?= $p['id_pgj']; ?>"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent pengerjaan End -->

<!-- Recent tabel Saran Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Advisor</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa fa-add"></i> Advice
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="TableSaran">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Saran</th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Saran Service</th>
                        <th scope="col">Saran Service Berikutnya</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $s) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $s['id_saran']; ?></td>
                            <td><?= $s['id_servis']; ?></td>
                            <td><?= $s['saran_at']; ?></td>
                            <td><?= $s['saran_n']; ?></td>
                            <td>
                                <a class="btn btn-warning" href="editSrn.php?id_saran=<?= $s['id_saran']; ?>"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Saran End -->

<!-- Modal Tambah Pengerjaan-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengerjaan</h5>
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
                                $id_servis = $_GET['id_servis'];
                                $data = mysqli_query($db, "SELECT * FROM tb_servis WHERE id_servis=$id_servis");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_servis']; ?>"><?= $d['id_servis']; ?> - <?= $d['stnk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pengerjaan</label>
                        <input type="text" class="form-control" name="pgj" id="pgj">
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0">Keterangan</legend>
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
                        <label for="recipient-name" class="col-form-label">Estimasi</label>
                        <input type="text" class="form-control" name="estimasi" id="estimasi">
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

<!-- Modal Tambah Saran-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Berikan Saran Service</h5>
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
                                $id_servis = $_GET['id_servis'];
                                $data = mysqli_query($db, "SELECT * FROM tb_servis WHERE id_servis=$id_servis");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_servis']; ?>"><?= $d['id_servis']; ?> - <?= $d['stnk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Saran Service</label>
                        <input type="text" class="form-control" name="saran_at" id="saran_at">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Saran Service Berikutnya</label>
                        <input type="text" class="form-control" name="saran_n" id="saran_n">
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

<?php
include 'layout/footer.php';
?>