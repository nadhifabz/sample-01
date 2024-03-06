<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
$nama = $_POST['nama'];
$idrumah = $_POST['idrumah'];
$status = $_POST['status'];
$notelp = $_POST['notelp'];
if ($_POST['tombol'] == 'Simpan'){
    $sql = mysqli_query($conn, "UPDATE rumah "
            . "SET nama = '".$nama."', status = ".$status.", no_telp = '".$notelp."' "
            . "WHERE idrumah = '".$idrumah."' ");
    if ($sql) {
        $pesan = "Data berhasil diperbaharui";
        $model = "success";
    } else {
        $pesan = "Proses gagal: " . mysqli_errno($conn);
        $model = "danger";
    }
}

if ($_POST['tombol'] == 'Hapus') {
    $idkuitansi = "$idrumah-$bulan.$tahun";
    $sql_val = mysqli_query($conn, "SELECT FROM kuitansi WHERE idkuitansi = '" . $idkuitansi . "'");
    if (mysqli_num_rows($sql_val) < 1) {
        echo '<script languange="javascript">alert("Proses gagal: Data digunakan pada kuitansi"); document.location="../DataWarga.php";</script>';
    } else {
        $sql = mysqli_query($conn, "DELETE FROM rumah "
                . "WHERE idrumah = '" . $idrumah . "'");
        if ($sql) {
            $pesan = "Data berhasil diperbaharui";
            $model = "success";
        } else {
            $pesan = "Proses gagal: " . mysqli_errno($conn);
            $model = "danger";
        }
    }
    
}

$data = array(
    "pesan" => $pesan,
    "model" => $model
);
echo json_encode($data);