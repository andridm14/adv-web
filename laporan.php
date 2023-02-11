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
INNER JOIN tb_pengerjaan ON tb_servis.id_servis = tb_pengerjaan.id_servis 
INNER JOIN user ON tb_servis.id_user = user.id_user
");

?>

<!-- Recent tabel Laporan -> tabel pengerjaan Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Laporan Service Customer</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="TablePgj">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Customer</th>
                        <th scope="col">No. STNK</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Pengerjaan</th>
                        <th scope="col">Estimasi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $lp) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $lp['id_servis']; ?></td>
                            <td><?= $lp['nm_user']; ?></td>
                            <td><?= $lp['stnk']; ?></td>
                            <td><?= $lp['jenis_servis']; ?></td>
                            <td><?= $lp['pgj']; ?></td>
                            <td>Rp. <?= number_format($lp['estimasi'], 0, ',', '.'); ?></td>
                            <td><?= date('d-m-Y', strtotime($lp['tgl'])); ?></td>
                            <td>
                                <a class="btn btn-outline-info" href="laporanDetail.php?id_servis=<?= $lp['id_servis']; ?>"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent pengerjaan End -->


<?php
include 'layout/footer.php';
?>