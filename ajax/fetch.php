<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Config.php';
if (isset($_POST['view'])) {
    if ($_POST['view'] != '') {
        $update_query = "UPDATE kuitansi SET status_bayar = 1 WHERE status_bayar = 0";
        mysqli_query($conn, $update_query);
    }
    $hariini_bawah = date("Y-m-d 00:00:00");
    $hariini_atas = date("Y-m-d 23:59:59");
    $queryhariini = "SELECT * FROM kuitansi "
            . "INNER JOIN rumah "
            . "ON kuitansi.idrumah = rumah.idrumah "
            . "INNER JOIN bulan ON bulan.idbulan = kuitansi.bulan "
            . "WHERE status_bayar = 1 AND "
            . "tgl_bayar BETWEEN '".$hariini_bawah."' AND '".$hariini_atas."' "
            . "ORDER BY tgl_bayar DESC LIMIT 5";
    $resulthariini = mysqli_query($conn, $queryhariini);
    $output = '<li><h6 class="dropdown-header">Hari Ini</h6></li>';
    if (mysqli_num_rows($resulthariini) > 0) {
        while ($row = mysqli_fetch_array($resulthariini)) {
            $tgl = date_format(date_create($row['tgl_bayar']), "d-m-Y H:m:s");
            $output .= '<li><div class="dropdown-item border border-1 mb-1">'
                    . '<strong>' . $row["nama"] . '</strong><br/>'
                    . '<small>Tagihan: '.$row['namabulan'].' '.$row['tahun'].'</small></br>'
                    . '<small class="fst-italic">Tgl Bayar ' . $tgl . '</small><br/>'
                    . '</div>'
                    . '</li>';
        }
    } else {
        $output .= '<li><a href="#" class="fst-italic dropdown-item mb-1"><small>Tidak ada kuitansi baru hari ini</small></a></li>';
    }
    $output .= '<li><hr class="dropdown-divider"></li>';

    $query = "SELECT * FROM kuitansi "
            . "INNER JOIN rumah "
            . "ON kuitansi.idrumah = rumah.idrumah "
            . "INNER JOIN bulan ON bulan.idbulan = kuitansi.bulan "
            . "WHERE status_bayar = 1 "
            . "AND DATE(tgl_bayar) < CURDATE() "
            . "ORDER BY tgl_bayar DESC LIMIT 5";
    $result = mysqli_query($conn, $query);
    $output .= '<li><h6 class="dropdown-header">Sebelumnya</h6></li>';
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $tgl = date_format(date_create($row['tgl_bayar']), "d-m-Y H:m:s");
            $output .= '</i><div class="dropdown-item border border-1 mb-1">'
                    . '<strong>'.$row["nama"].'</strong><br/>'
                    . '<small>Tagihan: '.$row['namabulan'].' '.$row['tahun'].'</small></br>'
                    . '<small class="fst-italic">Tgl Bayar '.$tgl.'</small><br/>'
                    . '</div>'
                    . '</li>';
        }
    } else {
        $output .='<li><a href="#" class="fst-italic dropdown-item mb-1"><small>Tidak ada kuitansi baru</small></a></li>';
    }
    
    $status_query = "SELECT * FROM kuitansi WHERE status_bayar = 0";
    $result_query = mysqli_query($conn, $status_query);
    $count = mysqli_num_rows($result_query);
    
    $data = array(
        'notif' => $output,
        'unseen_notif' => $count
    );
    
    echo json_encode($data);
}