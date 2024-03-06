<?php
include 'Config.php';

$blnini = $_POST['bulan'];
$idrumah = $_POST['idrumah'];
$tahun = $_POST['tahun'];
if ($blnini == 1) {
    $blnlalu = 12;
} else {
    $blnlalu = intval($blnini) - 1;
}

$tahunlalu = strval((intval($tahun)-1));
switch ($blnini) {
    case 1:
        $blnini_n = "Januari";
        $blnlalu_n = "Desember";
//        $tahunlalu = strval((intval($tahun)-1));
        break;
    case 2:
        $blnini_n = "Februari";
        $blnlalu_n = "Januari";
        break;
    case 3:
        $blnini_n = "Maret";
        $blnlalu_n = "Februari";
        break;
    case 4:
        $blnini_n = "April";
        $blnlalu_n = "Maret";
        break;
    case 5:
        $blnini_n = "Mei";
        $blnlalu_n = "April";
        break;
    case 6:
        $blnini_n = "Juni";
        $blnlalu_n = "Mei";
        break;
    case 7:
        $blnini_n = "Juli";
        $blnlalu_n = "Juni";
        break;
    case 8:
        $blnini_n = "Agustus";
        $blnlalu_n = "Juli";
        break;
    case 9:
        $blnini_n = "September";
        $blnlalu_n = "Agustus";
        break;
    case 10:
        $blnini_n = "Oktober";
        $blnlalu_n = "September";
        break;
    case 11:
        $blnini_n = "November";
        $blnlalu_n = "Oktober";
        break;
    case 12:
        $blnini_n = "Desember";
        $blnlalu_n = "November";
        break;
}

if ($blnlalu == 12) {
    $sql = "SELECT * "
            . "FROM meteran "
            . "INNER JOIN bulan ON meteran.bulan = bulan.idbulan "
            . "WHERE (idrumah='" . $idrumah . "' AND bulan='" . $blnini . "' AND tahun='" . $tahun . "') "
            . "OR (idrumah='" . $idrumah . "' AND bulan='" . $blnlalu . "' AND tahun='" . $tahunlalu . "') "
            . "ORDER BY tahun";
} else {
    $sql = "SELECT * "
            . "FROM meteran "
            . "INNER JOIN bulan ON meteran.bulan = bulan.idbulan "
            . "WHERE idrumah='" . $idrumah . "' "
            . "AND bulan IN ('" . $blnini . "','" . $blnlalu . "') "
            . "AND tahun='" . $tahun . "' "
            . "ORDER BY bulan";
}

$query = mysqli_query($conn, $sql);
$result = array();

while ($row = mysqli_fetch_array($query)) {
    $result[] = array(
        "angkameteran" => $row['angkameteran'],
        "bulan" => $row['namabulan']
    );
    $bln = $row['bulan'];
}
$meteran_nol = array();
if (mysqli_num_rows($query) == 1) {
    if ($bln == $blnini) {
        $meteran_nol[1] = array(
            "angkameteran" => 0,
            "bulan" => $blnlalu_n
        );
        $result = array_merge($meteran_nol, $result);
    } else {
        $meteran_nol[0] = array(
            "angkameteran" => 0,
            "bulan" => $blnini_n
        );
        $result = array_merge($result, $meteran_nol);
    }
}

if (mysqli_num_rows($query) == 0) {
    $result[0] = array(
        "angkameteran" => 0,
        "bulan" => $blnlalu_n
    );
    $result[1] = array(
        "angkameteran" => 0,
        "bulan" => $blnini_n
    );
}

echo json_encode($result);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

