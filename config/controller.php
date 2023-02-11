<?php

//function menampilkan data
function select($query)
{
    //panggil koneksi db
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

//Tambah data user 0 /ok
function tambah_user($post)
{

    global $db;

    $nm_user    = $post['nm_user'];
    $username   = $post['username'];
    $password   = $post['password'];
    $role       = $post['role'];
    
    //query add
    $query = "INSERT INTO user VALUES(null, '$nm_user', '$username', '$password', '$role')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function tambah_car($post)
{

    global $db;

    $stnk       = $post['stnk'];
    $id_user    = $post['id_user'];
    $model      = $post['model'];
    $warna      = $post['warna'];
    $tahun      = $post['tahun'];
    
    //query add
    $query = "INSERT INTO tb_kendaraan VALUES('$stnk', '$id_user', '$model', '$warna', '$tahun')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
//Tambah servis customer 1 /ok
function tambahData($post)
{

    global $db;

    $id_user        = $post['id_user'];
    $stnk           = $post['stnk'];
    $model          = $post['model'];
    $jenis_servis   = $post['jenis_servis'];
    $keluhan        = $post['keluhan'];
    
    //query add
    $query = "INSERT INTO tb_servis VALUES(null, '$id_user', '$stnk', '$model', '$jenis_servis', '$keluhan', CURRENT_TIMESTAMP()";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
//Tambah saran 2 /ok
function tambahSrn($post)
{

    global $db;

    $id_servis   = $post['id_servis'];
    $stnk        = $post['stnk'];
    $saran       = $post['saran'];
    
    //query add
    $query = "INSERT INTO tb_saran VALUES (null, '$id_servis', $stnk , '$saran')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
//Tambah pengerjaan 3 /ok
function tambahPgj($post)
{

    global $db;

    $id_servis      = $post['id_servis'];
    $pgj            = $post['pgj'];
    $ket            = $post['ket'];
    $estimasi       = $post['estimasi'];
    
    //query add
    $query = "INSERT INTO tb_pengerjaan VALUES (null, '$id_servis', '$pgj', '$ket', '$estimasi')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//delete 0 data saran /
function delete_saran($id_saran) 
{
    global $db;

    //query
    $query = "DELETE FROM tb_saran WHERE id_saran=$id_saran";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
//delete 1 data pgj /
function delete_pgj($id_pgj) 
{
    global $db;

    //query
    $query = "DELETE FROM tb_pengerjaan WHERE id_pgj=$id_pgj";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//update 0 data users /ok
function update_users($post)
{
    global $db;

    $id_user       = $post['id_user'];
    $nm_user       = $post['nm_user'];
    $username      = $post['username'];
    $password      = $post['password'];
    $role          = $post['role'];

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //query update
    $query = "UPDATE user SET nm_user='$nm_user', username='$username', password='$password', role='$role' WHERE id_user = $id_user";
    
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
//update 1 data servis /ok
function update_servis($post)
{
    global $db;

    $id_servis     = $post['id_servis'];
    $id_user       = $post['id_user'];
    $stnk          = $post['stnk'];
    $model         = $post['model'];
    $jenis_servis  = $post['jenis_servis'];
    $keluhan       = $post['keluhan'];

    //query update
    $query = "UPDATE tb_servis SET id_user='$id_user', stnk='$stnk', model='$model', jenis_servis='$jenis_servis', keluhan='$keluhan' WHERE id_servis = $id_servis";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
//update 2 saran /ok
function update_saran($post)
{
    global $db;

    $id_saran       = $post['id_saran'];
    $id_servis      = $post['id_servis'];
    $stnk           = $post['stnk'];
    $saran          = $post['saran'];

    //query update
    $query = "UPDATE tb_saran SET id_servis='$id_servis', stnk='$stnk', saran='$saran' WHERE id_saran = $id_saran";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
//update 3 pengerjaan /ok
function update_pgj($post)
{
    global $db;

    $id_pgj         = $post['id_pgj'];
    $id_servis      = $post['id_servis'];
    $pgj            = $post['pgj'];
    $ket            = $post['ket'];
    $estimasi       = $post['estimasi'];

    //query update
    $query = "UPDATE tb_pengerjaan SET id_servis='$id_servis', pgj='$pgj', ket='$ket', estimasi='$estimasi' WHERE id_pgj = $id_pgj";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

