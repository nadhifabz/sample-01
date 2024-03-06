<?php
include 'Config.php';

$idrumah = $_POST['id_rumah'];
$blnini = $_POST['bulan'];
$tahun = $_POST['tahun'];
$totalair = $_POST['totalair'];
$d = mktime(0, 0, 0, $blnini, 30, $tahun);
$tgl = date("Y-m-t", $d);

if ($idrumah!=="0"){
    
    //Data Warga
    $query = mysqli_query($conn, "SELECT * "
            . "FROM rumah WHERE idrumah='".$idrumah."' ");
    $row = mysqli_fetch_array($query);
    
    $result = array();
    $result1 = array();
    
    $status = $row['status'];
    $blnlalu = intval($blnini)-1;
    $tahunlalu = strval((intval($tahun)-1));
    
//    switch ($bulan) {
//        case 1:
//            $blnini = "Januari";
//            $blnlalu = "Desember";
//            $tahunlalu = strval((intval($tahun)-1));
//            break;
//        case 2:
//            $blnini = "Februari";
//            $blnlalu = "Januari";
//            break;
//        case 3:
//            $blnini = "Maret";
//            $blnlalu = "Februari";
//            break;
//        case 4:
//            $blnini = "April";
//            $blnlalu = "Maret";
//            break;
//        case 5:
//            $blnini = "Mei";
//            $blnlalu = "April";
//            break;
//        case 6:
//            $blnini = "Juni";
//            $blnlalu = "Mei";
//            break;
//        case 7:
//            $blnini = "Juli";
//            $blnlalu = "Juni";
//            break;
//        case 8:
//            $blnini = "Agustus";
//            $blnlalu = "Juli";
//            break;
//        case 9:
//            $blnini = "September";
//            $blnlalu = "Agustus";
//            break;
//        case 10:
//            $blnini = "Oktober";
//            $blnlalu = "September";
//            break;
//        case 11:
//            $blnini = "November";
//            $blnlalu = "Oktober";
//            break;
//        case 12:
//            $blnini = "Desember";
//            $blnlalu = "November";
//            break;
//    }
    
    //Tarif Air
    $queryair = mysqli_query($conn, 
            "SELECT idtarifair, status, MONTH(tgl_mulai) AS bulan, "
            . "YEAR(tgl_mulai) AS tahun, tarif_awal, tarif_lebih, tgl_mulai "
            . "FROM tarif_air "
            . "WHERE status=" . $status );
    
    while ($rowair = mysqli_fetch_array($queryair)) {
        if ($tgl > $rowair['tgl_mulai']) {
            $tarifawal = $rowair['tarif_awal'];
            $tariflebih = $rowair['tarif_lebih'];
            $idair = $rowair['idtarifair'];
        }
//        if (intval($tahun) == $rowair['tahun']){
//            if ($bulan >= $rowair['bulan']){
//                $tarifawal = $rowair['tarif_awal'];
//                $tariflebih = $rowair['tarif_lebih'];
//                $idair = $rowair['idtarifair'];
//            }
//        } elseif (intval($tahun) > $rowair['tahun']) {
//            if ($bulan <= $rowair['bulan']) {
//                $tarifawal = $rowair['tarif_awal'];
//                $tariflebih = $rowair['tarif_lebih'];
//                $idair = $rowair['idtarifair'];
//            }
//        }
    }
    
    
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
    }
//perawatan air dan fasum
    if ($status == 5) {
        $perawatan_air = $tarifawal * 0.5;
    } else {
        $perawatan_air = $tarifawal;
    }

//Pemakaian air
    if ($totalair >= 10) {
        $tagihanair = ($totalair - 10) * $tariflebih;
    } else {
        $tagihanair = 0;
    }
    
    $queryiuran = mysqli_query($conn, "SELECT tarif_iuran.*, MONTH(tgl_mulai) AS bulan, "
            . "YEAR(tgl_mulai) AS tahun "
            . "FROM tarif_iuran");
    while ($rowiuran = mysqli_fetch_array($queryiuran)) {
//        if (intval($tahun) >= $rowiuran['tahun']) {
            if ($tgl > $rowiuran['tgl_mulai']) {
                $tarifsampah = $rowiuran['tarif_sampah'];
                $tarifkebersihan= $rowiuran['tarif_kebersihan'];
                $tarifkeamanan = $rowiuran['tarif_keamanan'];
                $tarifrw = $rowiuran['tarif_rw'];
                $tarifkt = $rowiuran['tarif_kt'];
                $tarifmertideso = $rowiuran['tarif_mertideso'];
                $idiuran = $rowiuran['idtarifiuran'];
            }
//        }
    }

//Iuran Sampah
//    $querysampah = mysqli_query($conn, 
//            "SELECT idtarifsampah, MONTH(tgl_mulai) AS bulan, "
//            . "YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_sampah ");
//    
//    while ($rowsampah = mysqli_fetch_array($querysampah)) {
//        
//        if (intval($tahun) >= $rowsampah['tahun']) {
//            if ($blnini >= $rowsampah['bulan']) {
//                $tarifsampah = $rowsampah['tarif'];
//                $idsampah = $rowsampah['idtarifsampah'];
//            }
//        }
//    }

    if ($status == 5) {
        $iuran_sampah = $tarifsampah * 0.5;
    } elseif ($status == 6 || $status == 7 || $status == 2) {
        $iuran_sampah = 0;
    } else {
        $iuran_sampah = $tarifsampah ;
    }

//Iuran Kebersihan
//    $querykebersihan = mysqli_query($conn, 
//            "SELECT idtarifkebersihan, MONTH(tgl_mulai) AS bulan, "
//            . "YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_kebersihan ");
//    
//    while ($rowkebersihan = mysqli_fetch_array($querykebersihan)) {
//        if (intval($tahun) >= $rowkebersihan['tahun']) {
//            if ($blnini >= $rowkebersihan['bulan']) {
//                $tarifkebersihan = $rowkebersihan['tarif'];
//                $idkebersihan = $rowkebersihan['idtarifkebersihan'];
//            }
//        }
//    }
    
    if ($status == 5) {
        $iuran_kebersihan = $tarifkebersihan * 0.5;
    } elseif ($status == 2 || $status == 7) {
        $iuran_kebersihan = 0;
    } else {
        $iuran_kebersihan = $tarifkebersihan;
    }

//Iuran Keamanan
//    $querykeamanan = mysqli_query($conn, 
//            "SELECT idtarifkeamanan, MONTH(tgl_mulai) AS bulan, "
//            . "YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_keamanan ");
//    
//    while ($rowkeamanan = mysqli_fetch_array($querykeamanan)) {
//        if (intval($tahun) >= $rowkeamanan['tahun']) {
//            if ($blnini >= $rowkeamanan['bulan']) {
//                $tarifkeamanan = $rowkeamanan['tarif'];
//                $idkeamanan = $rowkeamanan['idtarifkeamanan'];
//            }
//        }
//    }
    
    if ($status == 5) {
        $iuran_keamanan = $tarifkeamanan * 0.5;
    } elseif ($status == 2 || $status == 7 || $status == 6) {
        $iuran_keamanan = 0;
    } else {
        $iuran_keamanan = $tarifkeamanan;
    }

//Iuran RW
//    $queryrw = mysqli_query($conn, 
//            "SELECT idtarifrw, MONTH(tgl_mulai) AS bulan, YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_rw ");
//    
//    while ($rowrw = mysqli_fetch_array($queryrw)) {
//        if (intval($tahun) >= $rowrw['tahun']) {
//            if ($blnini >= $rowrw['bulan']) {
//                $tarifrw = $rowrw['tarif'];
//                $idrw = $rowrw['idtarifrw'];
//            }
//        }
//    }
    
    if ($status == 5) {
        $iuran_rw = $tarifrw * 0.5;
    } elseif ($status == 2 || $status == 7) {
        $iuran_rw = 0;
    } else {
        $iuran_rw = $tarifrw;
    }

//Iuran Karang Taruna
//    $querykt = mysqli_query($conn, 
//            "SELECT idtarifkt, MONTH(tgl_mulai) AS bulan, YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_kt ");
//    
//    while ($rowkt = mysqli_fetch_array($querykt)) {
//        if (intval($tahun) >= $rowkt['tahun']) {
//            if ($blnini >= $rowkt['bulan']) {
//                $tarifkt = $rowkt['tarif'];
//                $idkt = $rowkt['idtarifkt'];
//            }
//        }
//    }
    
    if ($status == 5) {
        $iuran_kt = $tarifkt * 0.5;
    } elseif ($status == 2 || $status == 7) {
        $iuran_kt = 0;
    } else {
        $iuran_kt = $tarifkt;
    }

//Iuran Mertideso
//    $querymertideso = mysqli_query($conn, 
//            "SELECT idtarifmertideso, MONTH(tgl_mulai) AS bulan, YEAR(tgl_mulai) AS tahun, tarif "
//            . "FROM tarif_mertideso ");
//    
//    while ($rowmertideso = mysqli_fetch_array($querymertideso)) {
//        if (intval($tahun) >= $rowmertideso['tahun']) {
//            if ($blnini >= $rowmertideso['bulan']) {
//                $idmertideso = $rowmertideso['idtarifmertideso'];
//                $tarifmertideso = $rowmertideso['tarif'];
//                
//            }
//            
//        }
//        
//    }
    
    if ($status == 5) {
        $iuran_mertideso = $tarifmertideso * 0.5;
    } elseif ($status == 2 || $status == 7) {
        $iuran_mertideso = 0;
    } else {
        $iuran_mertideso = $tarifmertideso;
    }
    
    if ($blnlalu == "Desember") {
        $sql = "SELECT * "
                . "FROM meteran "
                . "WHERE (idrumah='" . $idrumah . "' AND bulan='" . $blnini . "' AND tahun='" . $tahun . "') "
                . "OR (idrumah='" . $idrumah . "' AND bulan='" . $blnlalu . "' AND tahun='" . $tahunlalu . "') "
                . "ORDER BY tahun";
    } else {
        $sql = "SELECT * "
                . "FROM meteran "
                . "WHERE idrumah='" . $idrumah . "' "
                . "AND bulan IN ('" . $blnini . "','" . $blnlalu . "') "
                . "AND tahun='" . $tahun . "'";
    }
    $query1 = mysqli_query($conn, $sql);
    while ($row1 = mysqli_fetch_array($query1)) {
        $result1[] = array(
            "angkameteran" => $row1['angkameteran'],
            "bulan" => $row1['bulan']
        );
    }

    //simpan id tarif
    $idtarif = [];
    $idtarif = array(
        "idair" => $idair,
        "idiuran" => $idiuran
    );
    
}

$result[] = array(
    "nama" => $row['nama'],
    "status" => $namastatus,
    "perawatan_air" => $perawatan_air,
    "tagihan_air" => $tagihanair,
    "iuran_sampah" => $iuran_sampah,
    "iuran_kebersihan" => $iuran_kebersihan,
    "iuran_keamanan" => $iuran_keamanan,
    "iuran_rw" => $iuran_rw,
    "iuran_kt" => $iuran_kt,
    "iuran_mertideso" => $iuran_mertideso
);

$combine = array();
$combine['result'] = $result;
$combine['result1'] = $result1;
$combine['idtarif'] = $idtarif;




echo json_encode($combine);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

