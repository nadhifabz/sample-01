<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
$kategori = strtolower($_POST['kategori']);
$tgl = $_POST['val_tgl_mulai'];
$id = $_POST['idtarif'];
if ($_POST['tombol'] == 'Simpan') {
    if ($kategori == "air") {
        $tarif_awal = $_POST['tarif_awal'];
        $tarif_lebih = $_POST['tarif_lebih'];
        $sql = mysqli_query($conn, "UPDATE tarif_air "
                . "SET tarif_awal = ".$tarif_awal.", tarif_lebih = ".$tarif_lebih." "
                . "WHERE idtarifair = ".$id);
    } else {
        $tarif_sampah = $_POST['tarif_sampah'];
        $tarif_kebersihan = $_POST['tarif_kebersihan'];
        $tarif_keamanan = $_POST['tarif_keamanan'];
        $tarif_rw = $_POST['tarif_rw'];
        $tarif_kt = $_POST['tarif_kt'];
        $tarif_mertideso = $_POST['tarif_mertideso'];
        $sql = mysqli_query($conn, "UPDATE tarif_".$kategori. " "
                . "SET tarif_sampah = " . $tarif_sampah . ", tarif_kebersihan=$tarif_kebersihan, "
                . "tarif_keamanan=$tarif_keamanan, tarif_rw=$tarif_rw, tarif_kt=$tarif_kt, "
                . "tarif_mertideso=$tarif_mertideso "
                . "WHERE idtarif".$kategori." = " . $id."");
    }
    if ($sql) {
        $pesan = "Data berhasil diperbaharui";
        $model = "success";
    } else {
        $pesan = "Proess gagal: " . mysqli_errno($conn);
        $model = "danger";
    }
}
if ($_POST['tombol'] == 'Hapus') {
    $sql = mysqli_query($conn, "DELETE FROM tarif_$kategori "
            . "WHERE idtarif$kategori = " . $id);
    if ($sql) {
        $pesan = "Data berhasil dihapus";
        $model = "success";
    } else {
        $pesan = "Proses gagal: ".mysqli_errno($conn);
        $model = "danger";
    }
}
$data = array(
    "pesan" => $pesan,
    "model" => $model
);
echo json_encode($data);