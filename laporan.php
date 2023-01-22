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


$data = select("SELECT * FROM tb_pengerjaan 
INNER JOIN tb_servis ON tb_pengerjaan.id_servis = tb_servis.id_servis 
INNER JOIN user ON tb_servis.id_user = user.id_user
ORDER BY user.nm_user ASC");

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
                        <th scope="col">Nama Customer</th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Pengerjaan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Estimasi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $lp) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $lp['nm_user']; ?></td>
                            <td><?= $lp['id_servis']; ?></td>
                            <td><?= $lp['pgj']; ?></td>
                            <td><?= $lp['ket']; ?></td>
                            <td>Rp. <?= number_format($lp['estimasi'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= date('d m Y', strtotime($lp['tgl'])); ?></td>
                            <td>
                                <a class="btn btn-info" href="detLaporan.php?id_pgj=<?= $lp['id_pgj']; ?>"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent pengerjaan End -->

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Edit
                                </button> -->
<!-- Modal -->
<!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Input Date</label>
                        <input type="date" class="form-control" name="tgl_n" id="message-text"></input>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Input Date</label>
                        <input type="date" class="form-control" name="tgl_n" id="message-text"></input>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Input Date</label>
                        <input type="date" class="form-control" name="tgl_n" id="message-text"></input>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Input Date</label>
                        <input type="date" class="form-control" name="tgl_n" id="message-text"></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- End Modal -->

<?php
include 'layout/footer.php';
?>