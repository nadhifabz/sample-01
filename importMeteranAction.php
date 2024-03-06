<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Config.php';
//if (isset($_POST['import'])) {
    $filename = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0) {
        $file = fopen($filename, "r");
        fgetcsv($file);
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE) {
            $idrumah = $getData[0];
            $bulan = $getData[1];
            $tahun = $getData[2];
            $angka = $getData[3];
//            $num = count($getData);
//            echo '<p>'.$num.' fields in line '.$row.': <br/></p>';
//            $row++;
//            for ($c=0;$c<$num;$c++) {
//                
//                switch ($c) {
//                    case 0:
//                        $idrumah = $getData[$c];
//                        break;
//                    case 1:
//                        $bulan = $getData[$c];
//                        break;
//                    case 2:
//                        $tahun = $getData[$c];
//                        break;
//                    case 3:
//                        $angka = $getData[$c];
//                        break;
//                    default:
//                        break;
//                }
//            }
//            echo 'ID Rumah: '.$idrumah."<br/>\n";
//            echo 'Bulan: '.$bulan."<br/>\n";
//            echo 'Tahun: '.$tahun."<br/>\n";
//            echo 'Angka: '.$angka."<br/>\n";
            $cekidrumah = mysqli_query($conn, "SELECT * FROM rumah "
                    . "WHERE idrumah = '".$idrumah."'");
            if (mysqli_num_rows($cekidrumah) < 1) {
                $pesan = "$idrumah tidak ditemukan. Proses berhenti";
                $model = "danger";
                break;
            }
            
            if (($bulan < 1) || ($bulan > 12)) {
                $pesan = "Bulan tidak valid (Pastikan 1 hingga 12)";
                $model = "danger";
                break;
            }
            
            $idkuitansi = "$idrumah-$bulan.$tahun";
            $cek_kuitansi = mysqli_query($conn, "SELECT * FROM kuitansi "
                    . "WHERE idkuitansi = '" . $idkuitansi . "'");
            if (mysqli_num_rows($cek_kuitansi) > 0) {
                $pesan = "Proses gagal: Data digunakan pada kuitansi" . mysqli_error($conn);
                $model = "danger";
                break;
            }
            
            $duplikasi = mysqli_query($conn, "SELECT * FROM meteran "
                    . "WHERE idrumah = '".$idrumah."' AND bulan = ".$bulan." AND tahun = '".$tahun."'");
            
            if (!$duplikasi) {
                echo mysqli_error($conn);
            }
            
            if (mysqli_num_rows($duplikasi) < 1 ) {
                $sql = "INSERT INTO meteran VALUES ('','$idrumah','$bulan','$tahun','$angka')";
                $result = mysqli_query($conn, $sql);
                $pesan = "Proses berhasil";
                $model = "success";
//                if (isset($result)) {
//                    echo '<script language="javascript"> '
//                    . 'alert("Pastikan file .csv!");</script>';
////                    . 'document.location = "DataMeteran.php"</script>';
//                } else {
//                    echo '<script language="javascript"> '
//                    . 'alert("Berhasil import file .csv!");</script>'
//                    . 'document.location = "DataMeteran.php"</script>';
////                    echo "$idrumah $bulan $tahun berhasil dimasukkan";
//                }
//            } else {
////                echo '<script language="javascript"> '
////                . 'alert("'.$idrumah.' '.$bulan.' '.$tahun.' sudah ada");</script>';
////                . 'document.location="DataMeteran.php"</script>';
////                echo "$idrumah $bulan $tahun sudah ada";
////                echo '<script language="javascript">alert("'.$idrumah.' '.$bulan.' '.$tahun.' sudah ada");</script>';
            } else {
                $sql = mysqli_query($conn, "UPDATE meteran SET angkameteran = $angka "
                        . "WHERE idrumah = '$idrumah' AND bulan = $bulan AND tahun = '$tahun'");
                if ($sql) {
                    $pesan = "Proses berhasil: Beberapa data di-update";
                    $model = "success";
                } else {
                    echo 'Error'. mysqli_error($conn);
                }
                
            }
            
            
        }
        
//        print_r(fstat($file));
        fclose($file);
    }
    $data = [];
    $data = array(
        "pesan" => $pesan,
        "model" => $model
    );
    echo json_encode($data);
//    echo '<script language="javascript">alert("Proses telah selesai");window.location="DataMeteran.php";</script>';
//}