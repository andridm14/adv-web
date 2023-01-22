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

$id_pgj = $_GET['id_pgj'];
$pgj = select("SELECT * FROM tb_pengerjaan WHERE id_pgj=$id_pgj")[0];


if (isset($_POST['editPgj'])) {
    if(update_pgj($_POST) > 0){
        echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href='service.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Gagal Diupdate');
        document.location.href='service.php';
        </script>";
    }
}

?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Data Pengerjaan</h6>
        <form action="" method="post">
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">ID Pengerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_pgj" name="id_pgj" value="<?= $pgj['id_pgj'];?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">ID Service</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $pgj['id_servis'];?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">Pengerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pgj" name="pgj" value="<?= $pgj['pgj'];?>">
                </div>
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
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">Input Estimasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="estimasi" name="estimasi" value="<?= $pgj['estimasi'];?>">
                </div>
            </div>
            <button type="submit" name="editPgj" class="btn btn-primary"><i class="fa fa-check"></i> Update Data</button>
            <a href="detService.php?id_servis=<?= $pgj['id_servis']; ?>" class="btn btn-secondary"><i class="fa fa-cancel"></i></a>
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