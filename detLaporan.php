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

$id_pgj = (int)$_GET['id_pgj'];
$data = select("SELECT * FROM tb_pengerjaan");

?>

<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light vh-100 text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="laporan.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Laporan Service</h6>
        </div>
        <!-- Card Start -->
        <div class="card-group mb-3">
            <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">Data Service Customer</h5>
                    <hr>
                    <p class="card-text">Nama : <?= $data['id_pgj']; ?></p>
                    <p class="card-text">Nomor STNK : <?= $data['stnk']; ?></p>
                    <p class="card-text">Model Kendaraan : <?= $data['model']; ?></p>
                    <p class="card-text">Jenis Service : <?= $data['jenis_servis']; ?></p>
                    <p class="card-text">Tanggal : <?= $data['tgl']; ?></p>
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
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent End -->


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