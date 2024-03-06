<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
if (isset($_POST['idrumah'])) {
    $idrumah = mysqli_real_escape_string($conn, $_POST['idrumah']);
//    $bulan = mysqli_real_escape_string($conn, $_POST['bulan']);
//    $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
    $tgl_sekarang = date_create(date('Y-m-t'));
    $tgl_mulai = date_create('2021-1-1');
    
    //tiap bulan
    $interval = new DateInterval('P1M');
    $date_range = new DatePeriod($tgl_mulai, $interval, $tgl_sekarang);
    
    
    $result_rumah_all = mysqli_query($conn, "SELECT nama, idrumah FROM rumah");
    $nama_all = $result_rumah_all->fetch_all(MYSQLI_ASSOC);
    
    $result_rumah = mysqli_query($conn, "SELECT nama FROM rumah "
            . "WHERE idrumah = '" . $idrumah . "'");
    $nama = mysqli_fetch_array($result_rumah);
    $data = array();
    $arr = array();
    foreach ($date_range as $date) {
        $bln_cek = date("m", strtotime(date_format($date, 'Y-m-d')));
        $tahun_cek = date("Y", strtotime(date_format($date, 'Y-m-d')));
        $idkuitansi = $idrumah."-".$bln_cek.".".$tahun_cek;
        $sql = "SELECT * FROM kuitansi k "
                    . "INNER JOIN rumah r "
                    . "ON r.idrumah = k.idrumah "
                    . "INNER JOIN bulan b "
                    . "ON b.idbulan = k.bulan "
//                . "WHERE idrumah = '" . $idrumah . "' "
                    . "WHERE bulan = " . $bln_cek . " AND tahun = " . $tahun_cek . " ";
        if ($idrumah != "0") {
            $sql .= "AND k.idrumah = '" . $idrumah . "' ";
//                    . "ORDER BY k.tahun";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) < 1) {
                $result_bulan = mysqli_query($conn, "SELECT namabulan FROM bulan "
                        . "WHERE idbulan = $bln_cek");
                $bulan = mysqli_fetch_array($result_bulan);
                $data[] = array(
                    "nama" => $nama['nama'],
                    "bulan" => $bulan['namabulan'],
                    "tahun" => $tahun_cek
                );
            }
            if (!$result) {
                echo mysqli_error($conn);
            }
        } else {
            $i=0;
            foreach ($nama_all as $value) {
                $sql .= "AND k.idrumah = '" . $value['idrumah'] . "' ";
//                        . "ORDER BY k.tahun";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) < 1) {
                    $result_bulan = mysqli_query($conn, "SELECT namabulan FROM bulan "
                            . "WHERE idbulan = $bln_cek");
                    $bulan = mysqli_fetch_array($result_bulan);
                    $data[] = array(
                        "nama" => $value['nama'],
                        "bulan" => $bulan['namabulan'],
                        "tahun" => $tahun_cek,
                    );
                }
                $i++;
            }
        }
    }
    $dataset = array(
        "data" => $data
    );
    echo json_encode($dataset);
}else{
    echo $_POST['idrumah'];
}
