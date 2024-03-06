<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';

if ($_POST['view'] == 'reload') {
    $sql = mysqli_query($conn, "SELECT * FROM rumah "
            . "INNER JOIN status ON status.idstatus = rumah.status");
    while ($row = mysqli_fetch_array($sql)) {
        $result[] = array(
            "idrumah" => $row['idrumah'],
            "nama" => $row['nama'],
            "status" => $row['namastatus'],
            "notelp" => $row['no_telp'],
            "action" => '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm buka-detail btn-warning" '
                . 'data-bs-toggle="modal" data-bs-target="#detailWarga" '
                . 'data-bs-id="' . $row['idrumah'] . '"><img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>Lihat Detail</button>'
                . '</td>'
        );
    }
    $dataset = array(
        "data" => $result
    );
    echo json_encode($dataset);
}

if ($_POST['view'] == 'detail') {
    $idrumah = $_POST['idrumah'];
    $sql = mysqli_query($conn, "SELECT * FROM rumah "
            . "INNER JOIN status ON rumah.status = status.idstatus "
            . "WHERE idrumah = '" . $idrumah . "'");

    $result = array();
    while ($row = mysqli_fetch_array($sql)) {
        $result[] = array(
            "id" => $row['idrumah'],
            "nama" => $row['nama'],
            "status" => $row['namastatus'],
            "idstatus" => $row['idstatus'],
            "notelp" => $row['no_telp']
        );
    }
    echo json_encode($result);
}

