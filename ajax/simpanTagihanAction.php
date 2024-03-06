<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Config.php';
$nama = $_POST['nama'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$idkuitansi = $_POST['idkuitansi'];
if ($_POST['tombol'] == 'Hapus') {
    $sql = mysqli_query($conn, "DELETE FROM kuitansi "
            . "WHERE idkuitansi = '".$idkuitansi."'");
    if ($sql) {
        $pesan = "Data berhasil dihapus";
        $model = "success";
    } else {
        $pesan = "Proses gagal: " . mysqli_errno($conn);
        $model = "danger";
    }
}

$data = array(
    "pesan" => $pesan,
    "model" => $model
);
echo json_encode($data);