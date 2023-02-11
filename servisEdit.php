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

$id_servis = $_GET['id_servis'];
$data = select("SELECT * FROM tb_servis WHERE id_servis=$id_servis")[0];

if (isset($_POST['editServis'])) {
    if (update_servis($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href='service.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diupdate');
        document.location.href='service.php';
        </script>";
    }
}

?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Update Data Service Customer</h6>
        <form action="" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">ID Service</label>
                <input type="email" class="form-control" id="id_servis" name="id_servis" value="<?= $data['id_servis']; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">ID Customer</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $data['id_user']; ?>" readonly>
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Nomor STNK</label>
                <input type="text" class="form-control" id="stnk" name="stnk" value="<?= $data['stnk']; ?>">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Model Kendaraan</label>
                <select id="model" class="form-select" name="model">
                    <option selected><?= $data['model']; ?></option>
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
            <div class="col-md-6">
                <label for="inputState" class="form-label">Jenis Service</label>
                <select id="jenis_servis" class="form-select" name="jenis_servis">
                    <option selected><?= $data['jenis_servis']; ?></option>
                    <option value="Paket 1">Paket 1</option>
                    <option value="Paket 2">Paket 2</option>
                    <option value="Paket 3">Paket 3</option>
                    <option value="Paket 4">Paket 4</option>
                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Keluhan</label>
                <input type="text" class="form-control" id="keluhan" name="keluhan" value="<?= $data['keluhan']; ?>">
            </div>
            <div class="col-12">
                <button type="submit" name="editServis" class="btn btn-primary"><i class="fa fa-check"></i> Update Data</button>
                <a href="service.php?id_servis=<?= $data['id_servis']; ?>" class="btn btn-secondary"><i class="fa fa-cancel"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Blank Start -->
<!-- <div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center">
            <h3></h3>
        </div>
    </div>
</div> -->
<!-- Blank End -->

<?php
include 'layout/footer.php';
?>