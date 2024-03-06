<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'Config.php';
if ($_POST['view'] == 'detail') {
    $idmeteran = $_POST['idmeteran'];
    $sql = mysqli_query($conn, "SELECT meteran.idrumah, meteran.bulan, meteran.tahun, "
            . "meteran.angkameteran, rumah.nama, bulan.namabulan "
            . "FROM meteran INNER JOIN rumah ON rumah.idrumah = meteran.idrumah "
            . "INNER JOIN bulan ON bulan.idbulan = meteran.bulan "
            . "WHERE meteran.idmeteran=" . $idmeteran);
    $result = array();
    while ($row = mysqli_fetch_array($sql)) {
        $result[] = array(
            "nama" => $row['nama'],
            "idrumah" => $row['idrumah'],
            "namabulan" => $row['namabulan'],
            "bulan" => $row['bulan'],
            "tahun" => $row['tahun'],
            "meteran" => $row['angkameteran']
        );
    }
    echo json_encode($result);
}

if ($_POST['view'] == 'reload') {
    $meteran = mysqli_query($conn, "SELECT meteran.idmeteran, meteran.idrumah, meteran.bulan, "
            . "meteran.tahun, meteran.angkameteran, rumah.nama, bulan.namabulan "
            . "FROM meteran "
            . "INNER JOIN bulan ON bulan.idbulan = meteran.bulan "
            . "INNER JOIN rumah ON rumah.idrumah = meteran.idrumah "
            . "ORDER BY idrumah, tahun, STR_TO_DATE(CONCAT(tahun,enbulan,'01'),'%Y %M %d') "
            . "");
    while ($row = mysqli_fetch_array($meteran)) {
        $result[] = array(
            "idrumah" => $row['idrumah'],
            "nama" => $row['nama'],
            "bulan" => $row['namabulan'],
            "tahun" => $row['tahun'],
            "meteran" => $row['angkameteran'],
            "action" => '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm buka-detail btn-warning " '
                        . 'data-bs-toggle="modal" data-bs-target="#detailMeteran" '
                        . 'data-bs-id=' . $row['idmeteran'] . '>'
                        . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
                        . 'Lihat Detail</button>'
        );
    }
    $dataset = array(
        "data" => $result
    );
    echo json_encode($dataset);
}

