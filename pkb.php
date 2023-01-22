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

$data = select("SELECT * FROM tb_servis ORDER BY id_servis DESC");
?>

<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="index.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Perintah Kerja Bengkel</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3" id="tablePkb">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">Kode PKB</th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Nomor STNK</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $no++; ?></td>
                            <td><?= $d['id_servis']; ?></td>
                            <td><?= $d['stnk']; ?></td>
                            <td><?= $d['jenis_servis']; ?></td>
                            <td><?= $d['keluhan']; ?></td>
                            <td><?= date('d-m-Y', strtotime($d['tgl'])); ?></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href=""><i class="fa fa-send"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent End -->

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center">
            <h3></h3>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include 'layout/footer.php';
?>