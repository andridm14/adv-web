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

$data = select("SELECT * FROM tb_servis 
INNER JOIN user ON tb_servis.id_user = user.id_user
INNER JOIN tb_kendaraan ON tb_servis.stnk = tb_kendaraan.stnk
INNER JOIN tb_pengerjaan ON tb_servis.id_servis = tb_pengerjaan.id_servis");

?>

<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="laporan.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Laporan Service</h6>
        </div>
        <!-- Card Start -->
        <?php foreach ($data as $dat) : ?>
            <div class="card-group mb-3">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">Data Service Customer</h5>
                        <hr>
                        <p class="card-text">Nama : <?= $dat['nm_user']; ?></p>
                        <p class="card-text">Nomor STNK : <?= $dat['stnk']; ?></p>
                        <p class="card-text">Model Kendaraan : <?= $dat['model']; ?></p>
                        <p class="card-text">Jenis Service : <?= $dat['jenis_servis']; ?></p>
                        <p class="card-text">Keluhan : <?= $dat['keluhan']; ?></p>
                        <p class="card-text">Tanggal : <?= $dat['tgl']; ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">Data Pengerjaan</h5>
                        <hr>
                        <p class="card-text">Pengerjaan : <?= $dat['pgj']; ?></p>
                        <p class="card-text">Keterangan : <?= $dat['ket']; ?></p>
                        <p class="card-text">Estimasi : <?= $dat['estimasi']; ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Recent End -->

<?php
include 'layout/footer.php';
?>