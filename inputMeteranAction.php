<?php
include 'Config.php';
//if (isset($_POST['tambah'])){
    $meteran = $_POST['meteran'];
    $idrumah = $_POST['id_rumah'];
    $bulan = $_POST['bulan'];
//    switch ($bulan) {
//        case 1:
//            $bulan = "Januari";
//            break;
//        case 2:
//            $bulan = "Februari";
//            break;
//        case 3:
//            $bulan = "Maret";
//            break;
//        case 4:
//            $bulan = "April";
//            break;
//        case 5:
//            $bulan = "Mei";
//            break;
//        case 6:
//            $bulan = "Juni";
//            break;
//        case 7:
//            $bulan = "Juli";
//            break;
//        case 8:
//            $bulan = "Agustus";
//            break;
//        case 9:
//            $bulan = "September";
//            break;
//        case 10:
//            $bulan = "Oktober";
//            break;
//        case 11:
//            $bulan = "November";
//            break;
//        case 12:
//            $bulan = "Desember";
//            break;
//        default :
//            alert('Masukkan dengan benar!');
//    }
    $tahun = $_POST['tahun'];
    
    $sql_val = mysqli_query($conn, "SELECT * FROM meteran WHERE idrumah = '".$idrumah."' AND bulan='".$bulan."' AND tahun='".$tahun."'");
    
    if (mysqli_num_rows($sql_val) < 1) {
        $sql = "INSERT INTO meteran VALUES ('','$idrumah','$bulan','$tahun','$meteran')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $pesan = "Proses gagal: ".mysqli_errno($conn);
            $model = "danger";
//            echo '<script language="javascript">alert("Proses gagal!"); document.location="DataMeteran.php";</script>';
        } else {
            $pesan = "Proses berhasil";
            $model = "success";
//            echo '<script languange="javascript">alert("Proses berhasil"); document.location="DataMeteran.php";</script>';
        }
    } else {
        $pesan = "Proses gagal: Data sudah ada";
        $model = "warning";
//        echo '<script language="javascript">alert("Proses gagal! Data sudah ada!"); document.location="DataMeteran.php";</script>';
    }
    $data = array(
        "pesan" => $pesan,
        "model" => $model
    );
    echo json_encode($data);
//}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

