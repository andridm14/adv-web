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

$datas = select("SELECT * FROM user WHERE user.role='2'");

$dataken = select("SELECT * FROM tb_kendaraan INNER JOIN user ON tb_kendaraan.id_user = user.id_user");

if (isset($_POST['tambahUser'])) {
    if (tambah_user($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='customer.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='customer.php';
        </script>";
    }
}
if (isset($_POST['tambahCar'])) {
    if (tambah_car($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Ditambah');
        document.location.href='customer.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambah');
        document.location.href='customer.php';
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
            <h6 class="mb-0">Data Customer</h6>
        </div>
        <div class="d-flex align-items-center mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Modaluser">
                <i class="fa fa-add"></i> <i class="fa fa-user"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-striped mt-3" id="serTable">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID User</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $d) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $d['id_user']; ?></td>
                            <td><?= $d['nm_user']; ?></td>
                            <td><?= $d['username']; ?></td>
                            <td><?= $d['password']; ?></td>
                            <td>
                            <button type="button" name="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#edit<?= $d['id_user']; ?>"><i class="fa fa-edit"></i></button>
                            
                            <button type="button" name="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $d['id_user']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><hr>

        <div class="d-flex align-items-center justify-content-between mb-2 mt-4">
            <h6 class="mb-0">Data Kendaraan</h6>
        </div>
        <div class="d-flex align-items-center mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#Modalcar">
                <i class="fa fa-add"></i> <i class="fa fa-car"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-striped mt-3" id="kenTable">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">ID User</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">No. STNK</th>
                        <th scope="col">Model Kendaraan</th>
                        <th scope="col">Warna Kendaraan</th>
                        <th scope="col">Tahun Kendaraan</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataken as $dk) : ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?= $dk['id_user']; ?></td>
                            <td><?= $dk['nm_user']; ?></td>
                            <td><?= $dk['stnk']; ?></td>
                            <td><?= $dk['model']; ?></td>
                            <td><?= $dk['warna']; ?></td>
                            <td><?= $dk['tahun']; ?></td>
                            <td>
                            <button type="button" name="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#edit<?= $dk['stnk']; ?>"><i class="fa fa-edit"></i></button>
                            
                            <button type="button" name="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $dk['stnk']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><hr>
    </div>
</div>
<!-- Recent End -->

<!-- Modal user-->
<div class="modal fade" id="Modaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="col-form-label">ID Customer</label>
                        <input type="text" class="form-control" name="id_user" id="id_user" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama Customer</label>
                        <input type="text" class="form-control" name="nm_user" id="nm_user">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"></label>
                        <input type="hidden" class="form-control" name="role" id="role" value="2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                        <button type="submit" name="tambahUser" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal kendaraan -->
<div class="modal fade" id="Modalcar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nomor STNK</label>
                        <input type="text" class="form-control" name="stnk" id="stnk">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">ID Customer</label>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm mb-3" name="id_user" id="id_user" aria-label=".form-select-sm example">
                                <option selected>--Pilih ID User--</option>
                                <?php
                                $data = mysqli_query($db, "SELECT * FROM user WHERE role='2'");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <option value="<?= $d['id_user']; ?>"><?= $d['id_user']; ?> - <?= $d['nm_user']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
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
                        <label class="col-form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" id="warna">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tahun</label>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm mb-3" name="tahun" id="tahun" aria-label=".form-select-sm example">
                                <option selected>--Pilih Tahun--</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-cancel"></i></button>
                        <button type="submit" name="tambahCar" class="btn btn-primary"><i class="fa fa-check"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'layout/footer.php';
?>