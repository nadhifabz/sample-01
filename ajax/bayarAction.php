<?php
include '../Config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idrumah = mysqli_real_escape_string($conn, $_POST['id_rumah']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$tgl_bayar = date("Y-m-d H:i:s");
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

switch ($bulan) {
    case 1:
        $bulanini = "Januari";
        $blnlalu = "Desember";
        break;
    case 2:
        $bulanini = "Februari";
        $blnlalu = "Januari";
        break;
    case 3:
        $bulanini = "Maret";
        $blnlalu = "Februari";
        break;
    case 4:
        $bulanini = "April";
        $blnlalu = "Maret";
        break;
    case 5:
        $bulanini = "Mei";
        $blnlalu = "April";
        break;
    case 6:
        $bulanini = "Juni";
        $blnlalu = "Mei";
        break;
    case 7:
        $bulanini = "Juli";
        $blnlalu = "Juni";
        break;
    case 8:
        $bulanini = "Agustus";
        $blnlalu = "Juli";
        break;
    case 9:
        $bulanini = "September";
        $blnlalu = "Agustus";
        break;
    case 10:
        $bulanini = "Oktober";
        $blnlalu = "September";
        break;
    case 11:
        $bulanini = "November";
        $blnlalu = "Oktober";
        break;
    case 12:
        $bulanini = "Desember";
        $blnlalu = "November";
        break;
}
$status = $_POST['status'];
$metini = $_POST['bulanini'];
$metlalu = $_POST['bulanlalu'];
$totalair = $_POST['total_pemakaian'];

$instalasiair = $_POST['val_pemeliharaanair'];
$tagihanair = $_POST['val_air'];
$sampah = $_POST['val_sampah'];
$keamanan = $_POST['val_keamanan'];
$kebersihan = $_POST['val_kebersihan'];
$rw = $_POST['val_rw'];
$kt = $_POST['val_kt'];
$mertideso = $_POST['val_mertideso'];
$total = $_POST['val_total'];

$idair = $_POST['idair'];
$idiuran = $_POST['idiuran'];
//$idsampah = $_POST['idsampah'];
//$idkebersihan = $_POST['idkebersihan'];
//$idkeamanan = $_POST['idkeamanan'];
//$idrw = $_POST['idrw'];
//$idkt = $_POST['idkt'];
//$idmertideso = $_POST['idmertideso'];

$idkuitansi = "$idrumah-$bulan.$tahun";
//if (isset($_POST['bayar'])) {
//cek data tagihan

$data = [];
$querycekdata = mysqli_query($conn, "SELECT * "
        . "FROM kuitansi "
        . "WHERE idkuitansi='$idkuitansi'");
if (mysqli_num_rows($querycekdata) < 1) {
    //simpan data pembayaran
    //$sql = "INSERT INTO kuitansi VALUES ('','A.1','Maret','2022',1,18500,0,1,22500,1,22500,1,50000,1,3000,1,2000,1,5000,'2022-03-01',1,123500);";
    $sql = "INSERT INTO kuitansi VALUES ('$idkuitansi','$idrumah','$bulan','$tahun',$idair,$instalasiair,"
            . "$tagihanair,$idiuran,$sampah,$keamanan,"
            . "$kebersihan,$rw,$kt,$mertideso,'$tgl_bayar',0,$total,$metini,$metlalu);";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        $data['pesan'] = 'Proses Gagal: '. mysqli_error($conn);
        $data['model'] = 'danger';
    } else {
        $data['pesan'] = 'Proses Berhasil: Pembayaran berhasil dicatat';
        $data['model'] = 'success';
    }
} else {
    $data['pesan'] = 'Proses Gagal: Pembayaran sudah tercatat sebelumnya';
    $data['model'] = 'warning';
}
echo json_encode($data);    
    
//}

