<?php
include '../Config.php';

//if (isset($_POST['submit_tarif'])) {
$tgl = $_POST['tgl_mulai'];

$tgl_val = date_create($tgl);
$bulan_val = date_format($tgl_val, "m");
$tahun_val = date_format($tgl_val, "Y");

$tgl_val = date_format(date_create($tgl), "d-m-Y");
$data = [];

$sql_bulan = mysqli_query($conn, "SELECT * FROM bulan WHERE idbulan = $bulan_val");
$namabulan = mysqli_fetch_array($sql_bulan);




//air
if (!isset($_POST['check_tarifair'])) {
    $status = $_POST['status'];
    $tarifawal = $_POST['tarif_awalair'];
    $tariflebih = $_POST['tarif_lebihair'];
    
    //
    $sql_air_val = mysqli_query($conn, "SELECT * FROM tarif_air "
            . "INNER JOIN status ON status.idstatus = tarif_air.status "
//        . "INNER JOIN bulan on bulan.idbulan = tarif_air.MONTH(tgl_mulai) "
            . "WHERE status = " . $status . " AND MONTH(tgl_mulai) = " . $bulan_val . " AND YEAR(tgl_mulai) = " . $tahun_val);

    if (mysqli_num_rows($sql_air_val) > 0) {
        $air = mysqli_fetch_array($sql_air_val);
        $success['air'] = false;
        $pesan['air'] = "Tarif air mulai bulan " . $namabulan['namabulan'] . " " . $tahun_val . " untuk " . $air['namastatus'] . " sudah ada";
    }

    $sql_air = "INSERT INTO tarif_air VALUES ('','$status','$tgl',$tarifawal,$tariflebih)";
    if (!isset($success['air'])) {
        $result_air = mysqli_query($conn, $sql_air);
        if ($result_air) {
            $pesan['air'] = "Data berhasil ditambahkan";
            $success['air'] = true;
        } else {
            $pesan['gagal'] = "Tidak dapat akses database: " . mysqli_error($conn);
            $success['air'] = false;
        }
    }
}

//iuran
if (!isset($_POST['check_iuran'])) {
    $tarif_sampah = $_POST['tarif_sampah'];
    $tarif_keamanan = $_POST['tarif_keamanan'];
    $tarif_kebersihan = $_POST['tarif_kebersihan'];
    $tarif_rw = $_POST['tarif_rw'];
    $tarif_kt = $_POST['tarif_kt'];
    $tarif_mertideso = $_POST['tarif_mertideso'];
    
    $sql_iuran_val = mysqli_query($conn, "SELECT * "
            . "FROM tarif_iuran "
//        . "INNER JOIN bulan on bulan.idbulan = tarif.MONTH(tgl_mulai) "
            . "WHERE MONTH(tgl_mulai) = " . $bulan_val . " AND YEAR(tgl_mulai) = " . $tahun_val);

    if (mysqli_num_rows($sql_iuran_val) > 0) {
//    $iuran = mysqli_fetch_array($sql_iuran_val);
        $success['iuran'] = false;
        $pesan['iuran'] = "Tarif iuran mulai bulan " . $namabulan['namabulan'] . " " . $tahun_val . " sudah ada";
    }

    $sql_iuran = "INSERT INTO tarif_iuran VALUES ('','$tgl','$tarif_sampah','$tarif_keamanan',"
            . "'$tarif_kebersihan','$tarif_rw','$tarif_kt','$tarif_mertideso')";
    if (!isset($success['iuran'])) {
        $result_iuran = mysqli_query($conn, $sql_iuran);
        if ($result_iuran) {
            $pesan['iuran'] = "Data berhasil ditambahkan";
            $success['iuran'] = true;
        } else {
            $pesan['gagal'] = "Tidak dapat akses database: " . mysqli_error($conn);
            $success['iuran'] = false;
        }
    }
}





$data['pesan'] = $pesan;
$data['success'] = $success;
echo json_encode($data);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

