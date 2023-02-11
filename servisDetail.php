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
WHERE tb_servis.id_servis='$id_servis'");

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

<?php
include 'layout/footer.php';
?>