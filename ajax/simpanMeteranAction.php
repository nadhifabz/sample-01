<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
$meteran = $_POST['meteran'];
$idrumah = $_POST['idrumah'];
$bulan = $_POST['val_bulan'];
$tahun = $_POST['tahun'];
if ($_POST['tombol'] == 'Simpan'){
    $idkuitansi = "$idrumah-$bulan.$tahun";
    $sql_val = mysqli_query($conn, "SELECT * FROM kuitansi "
            . "WHERE idkuitansi = '".$idkuitansi."'");
    if (mysqli_num_rows($sql_val) > 0) {
        $pesan = "Proses gagal: Data digunakan pada kuitansi" . mysqli_error($conn);
        $model = "danger";
    } else {
        $sql = mysqli_query($conn, "UPDATE meteran "
                . "SET angkameteran = " . $meteran . " "
                . "WHERE idrumah = '" . $idrumah . "' AND bulan = " . $bulan . " AND tahun = '" . $tahun . "'");
        if ($sql) {
            $pesan = "Data berhasil diperbaharui";
            $model = "success";
        } else {
            $pesan = "Proses gagal: " . mysqli_errno($conn);
            $model = "danger";
        }
    }
    
}

if ($_POST['tombol'] == 'Hapus') {
    $idkuitansi = "$idrumah-$bulan.$tahun";
    $sql_val = mysqli_query($conn, "SELECT * FROM kuitansi "
            . "WHERE idkuitansi = '".$idkuitansi."'");
    $n = mysqli_num_rows($sql_val);
    if (mysqli_num_rows($sql_val) > 0) {
        $pesan = "Proses gagal: Data digunakan pada kuitansi". mysqli_error($conn);
        $model = "danger";
    } else {
        $sql = mysqli_query($conn, "DELETE FROM meteran "
                . "WHERE idrumah = '" . $idrumah . "' AND bulan = '" . $bulan . "' AND tahun = '" . $tahun . "'");
        if ($sql) {
            $pesan = "Data berhasil dihapus";
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