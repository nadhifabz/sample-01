<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';

if ($_POST['view'] == 'reload') {
    $kategori = $_POST['kategori'];
    $result = array();
    $i=1;
    if ($kategori == "air") {
        $sql = mysqli_query($conn, "SELECT * FROM tarif_" . $kategori . " "
                . "INNER JOIN status ON status.idstatus = tarif_air.status "
                . "ORDER BY tgl_mulai, idstatus");
        
        while ($row = mysqli_fetch_array($sql)) {
            $result[] = array(
                "no" => $i++,
                "status" => $row['namastatus'],
                "tgl" => $row['tgl_mulai'],
                "tarifawal" => $row['tarif_awal'],
                "tariflebih" => $row['tarif_lebih'],
                "action" => '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-warning btn-sm buka-detail"'
                        . 'data-bs-toggle="modal" data-bs-target="#detailTarif" '
                        . 'data-bs-id={"id":"' . $row['idtarifair'] . '","kategori":"air"}>'
                        . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
                        . 'Lihat Detail</button>'
                        . '</td>'
            );
        }
    }
    
    if ($kategori == "iuran") {
        $sql = mysqli_query($conn, "SELECT * FROM tarif_iuran "
                . "ORDER BY tgl_mulai");
        while ($row = mysqli_fetch_array($sql)) {
            $result[] = array(
                "no" => $i++,
                "tgl" => $row['tgl_mulai'],
                "sampah" => $row['tarif_sampah'],
                "kebersihan" => $row['tarif_kebersihan'],
                "keamanan" => $row['tarif_keamanan'],
                "rw" => $row['tarif_rw'],
                "kt" => $row['tarif_kt'],
                "mertideso" => $row['tarif_mertideso'],
                "action" => '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm btn-warning buka-detail" '
                    . 'data-bs-toggle="modal" data-bs-target="#detailTarif" '
                    . 'data-bs-id={"id":"' . $row['idtarifiuran'] . '","kategori":"iuran"}>'
                    . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
                    . 'Lihat Detail</button>'
                    . '</td>',
            );
        }
    }
    $dataset = array(
        "data" => $result
    );
    echo json_encode($dataset);
}

if ($_POST['view'] == 'detail') {
    $idtarif = $_POST['idtarif'];
    $kategori = $_POST['kategori'];
    $sql = mysqli_query($conn, "SELECT *  FROM tarif_" . $kategori . " "
            . "WHERE idtarif$kategori = " . $idtarif);
    $row = mysqli_fetch_array($sql);
    $result = array();
    if ($kategori == "air") {
        $status = $row['status'];
        $tarif_awal = $row['tarif_awal'];
        $tarif_lebih = $row['tarif_lebih'];
        switch ($status) {
            case 1:
                $namastatus = "WARGA";
                break;
            case 2:
                $namastatus = "WARGA2";
                break;
            case 3:
                $namastatus = "KONTRAK";
                break;
            case 4:
                $namastatus = "KOS";
                break;
            case 5:
                $namastatus = "KOSONG";
                break;
            case 6:
                $namastatus = "ISTIMEWA1";
                break;
            case 7:
                $namastatus = "ISTIMEWA2";
                break;
            default :
                $namastatus = NULL;
                break;
        }
        $result['air'] = array(
            "id" => $row['idtarif' . $kategori],
            "status" => $namastatus,
            "tgl" => date_format(date_create($row['tgl_mulai']), "d-m-Y"),
            "val_tgl" => $row['tgl_mulai'],
            "tarif_awal" => $tarif_awal,
            "tarif_lebih" => $tarif_lebih
        );
    } else {
        $tarif_sampah = $row['tarif_sampah'];
        $tarif_kebersihan = $row['tarif_kebersihan'];
        $tarif_keamanan = $row['tarif_keamanan'];
        $tarif_rw = $row['tarif_rw'];
        $tarif_kt = $row['tarif_kt'];
        $tarif_mertideso = $row['tarif_mertideso'];
        $result['iuran'] = array(
            "id" => $row['idtarif' . $kategori],
            "tgl" => date_format(date_create($row['tgl_mulai']), "d-m-Y"),
            "val_tgl" => $row['tgl_mulai'],
            "tarif_sampah" => $tarif_sampah,
            "tarif_kebersihan" => $tarif_kebersihan,
            "tarif_keamanan" => $tarif_keamanan,
            "tarif_rw" => $tarif_rw,
            "tarif_kt" => $tarif_kt,
            "tarif_mertideso" => $tarif_mertideso
        );
    }
    echo json_encode($result);
}