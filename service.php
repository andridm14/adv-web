<?php
session_start();

//  block halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
    document.location.href = 'error.php;
    </script>";
    exit;
}
include 'layout/header.php';

$data = select("SELECT * FROM tb_servis INNER JOIN user ON tb_servis.id_user = user.id_user WHERE user.role='2' ORDER BY tb_servis.id_servis DESC");

if (isset($_POST['tambahData'])) {
    if (tambahData($_POST) > 0) {
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

<!-- Recent Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="index.php" class="btn btn-outline-danger"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Pendaftaran Service</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalq">
                <i class="fa fa-add"></i> Service
            </button>
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-striped mt-3" id="serTable">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID Service</th>
                        <th scope="col">Nomor STNK</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Model Kendaran</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Keluhan Customer</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $dt) : ?>
                        <tr>
                            <td><a class="btn btn-sm btn-outline-info" href="servisDetail.php?id_servis=<?= $dt['id_servis']; ?>"><i class="fa fa-search"></i></a></td>
                            <td><?= $dt['id_servis']; ?></td>
                            <td><?= $dt['stnk']; ?></td>
                            <td><?= $dt['nm_user']; ?></td>
                            <td><?= $dt['model']; ?></td>
                            <td><?= $dt['jenis_servis']; ?></td>
                            <td><?= $dt['keluhan']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning mb-2" href="servisEdit.php?id_servis=<?= $dt['id_servis']; ?>"><i class="fa fa-edit"></i></a>

                                <a class="btn btn-sm btn-danger" href="serviceDelete.php?id_servis=<?= $dt['id_servis']; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#a2d9ff" fill-opacity="1" d="M0,160L60,176C120,192,240,224,360,234.7C480,245,600,235,720,202.7C840,171,960,117,1080,101.3C1200,85,1320,107,1380,117.3L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
    </svg>
    </div>
</div>
<!-- Recent End -->

<!-- Modal -->
<div class="modal fade" id="exampleModalq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label class="col-form-label">ID Customer</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="id_servis" id="id_servis">
                            <select class="form-select form-select-sm mb-3" name="id_user" id="id_user" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <?php
                                $data = mysqli_query($db, "SELECT * FROM user WHERE role='2'");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_user']; ?>"><?= $d['nm_user']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nomor STNK</label>
                        <input type="text" class="form-control" name="stnk" id="stnk">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Model</label>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm mb-3" name="model" id="model" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <option value="Avanza">Avanza</option>
                                <option value="Veloz">Veloz</option>
                                <option value="Sienta">Sienta</option>
                                <option value="Calya">Calya</option>
                                <option value="Agya">Agya</option>
                                <option value="Raize">Raize</option>
                                <option value="Yaris">Yaris</option>
                                <option value="Rush">Rush</option>
                                <option value="Innova">Innova</option>
                                <option value="Venturer">Venturer</option>
                                <option value="Fortuner">Fortuner</option>
                                <option value="Land Cruiser">Land Cruiser</option>
                                <option value="Alphard">Alphard</option>
                                <option value="Camry">Camry</option>
                                <option value="Corolla">Corolla</option>
                                <option value="BZ4X">BZ4X</option>
                                <option value="Vios">Vios</option>
                                <option value="CHR">CHR</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Jenis Service</label>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm mb-3" name="jenis_servis" id="jenis_servis" aria-label=".form-select-sm example">
                                <option selected>--Pilih--</option>
                                <option value="Paket 1">Paket 1</option>
                                <option value="Paket 2">Paket 2</option>
                                <option value="Paket 3">Paket 3</option>
                                <option value="Paket 4">Paket 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Keluhan</label>
                        <input type="text" class="form-control" name="keluhan" id="keluhan" style="height: 120px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                        <button type="submit" name="tambahData" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include 'layout/footer.php';
?>