<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
$view = $_POST['view'];
if ($view == "reload") {
//    tampil();
    $sql = mysqli_query($conn, "SELECT * FROM kuitansi "
            . "INNER JOIN rumah ON rumah.idrumah = kuitansi.idrumah "
            . "INNER JOIN bulan ON bulan.idbulan = kuitansi.bulan "
            . "ORDER BY kuitansi.tahun, kuitansi.bulan, kuitansi.idrumah");
    $result = array();
    while ($row = mysqli_fetch_array($sql)) {
        $result[] = array(
            "idkuitansi" => $row['idkuitansi'],
//            "idrumah" => $row['idrumah'],
            "nama" => $row['nama'],
            "bulan" => $row['namabulan'],
            "tahun" => $row['tahun'],
//            "perawatanair" => $row['tarif_perawatanair'],
//            "tagihanair" => $row['tagihan_air'],
//            "iuransampah" => $row['iuran_sampah'],
//            "iurankeamanan" => $row['iuran_keamanan'],
//            "iurankebersihan" => $row['iuran_kebersihan'],
//            "iuranrw" => $row['iuran_rw'],
//            "iurankt" => $row['iuran_kt'],
//            "iuranmertideso" => $row['iuran_mertideso'],
            "tglbayar" => $row['tgl_bayar'],
//            "total" => $row['total'],
            "action" => '<td><button type="button" class=" me-2 btn buka-detail ps-2 pe-2 btn-sm btn-warning" '
            . 'data-bs-toggle="modal" data-bs-target="#detailTagihan" '
            . 'data-bs-id="' . $row['idkuitansi'] . '">'
            . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
            . 'Lihat Detail</button></td>'
        );
    }
    $dataset = array(
        "data" => $result
    );
echo json_encode($dataset);
}
if ($view == "detail") {
    $idkuitansi = $_POST['idkuitansi'];
    $sql = mysqli_query($conn, "SELECT * FROM kuitansi "
            . "INNER JOIN rumah ON rumah.idrumah = kuitansi.idrumah "
            . "INNER JOIN bulan ON bulan.idbulan = kuitansi.bulan "
            . "WHERE idkuitansi = '".$idkuitansi."'");
    $result = array();

    if (mysqli_num_rows($sql) < 1) {
        die("Gagal terhubung ke database : " . mysqli_error($conn));
    } else {
        while ($row = mysqli_fetch_array($sql)) {
            $tgl_bayar = date_format(date_create($row['tgl_bayar']), "d-m-Y");
            $result[] = array(
                "idkuitansi" => $row['idkuitansi'],
                "idrumah" => $row['idrumah'],
                "nama" => $row['nama'],
                "bulan" => $row['bulan'],
                "val_bulan" => $row['namabulan'],
                "tahun" => $row['tahun'],
                "perawatanair" => $row['tarif_perawatanair'],
                "tagihanair" => $row['tagihan_air'],
                "iuransampah" => $row['iuran_sampah'],
                "iurankeamanan" => $row['iuran_keamanan'],
                "iurankebersihan" => $row['iuran_kebersihan'],
                "iuranrw" => $row['iuran_rw'],
                "iurankt" => $row['iuran_kt'],
                "iuranmertideso" => $row['iuran_mertideso'],
                "tglbayar" => $row['tgl_bayar'],
                "display_tglbayar" => $tgl_bayar,
                "total" => $row['total']
            );
        }
    }
    
echo json_encode($result);
}