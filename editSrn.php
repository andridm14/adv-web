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

$id_saran = $_GET['id_saran'];
$saran = select("SELECT * FROM tb_saran WHERE id_saran=$id_saran")[0];

if (isset($_POST['editSaran'])) {
    if(update_saran($_POST) > 0){
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
        <h6 class="mb-4">Update Data Saran</h6>
        
        <form action="" method="post">
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">ID Saran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_saran" name="id_saran" value="<?= $saran['id_saran'];?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">ID Service</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $saran['id_servis'];?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">Saran Service</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="saran_at" name="saran_at" value="<?= $saran['saran_at'];?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="text" class="col-sm-2 col-form-label">Saran Berikut</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="saran_n" name="saran_n" value="<?= $saran['saran_n'];?>">
                </div>
            </div>
            <button type="submit" name="editSaran" class="btn btn-primary"><i class="fa fa-check"></i> Update Data</button>
            <a href="detService.php?id_servis=<?= $saran['id_servis']; ?>" class="btn btn-secondary"><i class="fa fa-cancel"></i></a>
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