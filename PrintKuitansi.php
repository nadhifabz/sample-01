<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Print Kuitansi</title>
        <script type="text/javascript" src="asset/jquery/jquery-3.6.3.min.js"></script>
        <script type="text/javascript" src="asset/jquery/jquery-ui.js"></script>
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            @media print {
                @page { 
                    size: landscape;
                }
                body {
                    size: A4;
                }
            }
            @media screen {
                body {
                    size: A4;
                }
            }
            
            
            .line {
                border-bottom-style: double;
            }
            
        </style>
    </head>
    <body>
        <?php
        include 'Config.php';
        if (isset($_POST['cetak'])) {
            if (!isset($_POST['idkuitansi'])) {
                echo '<script>'
                    . 'alert("Data kuitansi tidak ditemukan: Pilih kuitansi yang akan dicetak!");'
                    . 'window.close();'
                    . '</script>';
            }
            $array_idkuitansi = $_POST['idkuitansi'];
            foreach ($array_idkuitansi as $id) {
                $sql = mysqli_query($conn, "SELECT * FROM kuitansi k "
                    . "INNER JOIN rumah r "
                    . "on r.idrumah = k.idrumah "
                    . "INNER JOIN status s "
                    . "on s.idstatus = r.status "
                    . "where idkuitansi='" . $id . "'");
                while ($row = mysqli_fetch_array($sql)) {
                    $totalmet = $row['met_ini']-$row['met_lalu'];
                    switch ($row['bulan']) {
                    case 1:
                        $blnini = "Januari";
                        $blnlalu = "Desember";
//                        $tahunlalu = strval((intval($tahun) - 1));
                        break;
                    case 2:
                        $blnini = "Februari";
                        $blnlalu = "Januari";
                        break;
                    case 3:
                        $blnini = "Maret";
                        $blnlalu = "Februari";
                        break;
                    case 4:
                        $blnini = "April";
                        $blnlalu = "Maret";
                        break;
                    case 5:
                        $blnini = "Mei";
                        $blnlalu = "April";
                        break;
                    case 6:
                        $blnini = "Juni";
                        $blnlalu = "Mei";
                        break;
                    case 7:
                        $blnini = "Juli";
                        $blnlalu = "Juni";
                        break;
                    case 8:
                        $blnini = "Agustus";
                        $blnlalu = "Juli";
                        break;
                    case 9:
                        $blnini = "September";
                        $blnlalu = "Agustus";
                        break;
                    case 10:
                        $blnini = "Oktober";
                        $blnlalu = "September";
                        break;
                    case 11:
                        $blnini = "November";
                        $blnlalu = "Oktober";
                        break;
                    case 12:
                        $blnini = "Desember";
                        $blnlalu = "November";
                        break;
                    }
                    $array_kuitansi[] = array(
                        "idrumah" => $row['idrumah'],
                        "nama" => $row['nama'],
                        "bulan" => $blnini,
                        "blnlalu" => $blnlalu,
                        "tahun" => $row['tahun'],
                        "status" => $row['namastatus'],
                        "perawatanair" => $row['tarif_perawatanair'],
                        "tagihanair" => $row['tagihan_air'],
                        "sampah" => $row['iuran_sampah'],
                        "keamanan" => $row['iuran_keamanan'],
                        "kebersihan" => $row['iuran_kebersihan'],
                        "rw" => $row['iuran_rw'],
                        "kt" => $row['iuran_kt'],
                        "mertideso" => $row['iuran_mertideso'],
                        "total" => $row['total'],
                        "metini" => $row['met_ini'],
                        "metlalu" => $row['met_lalu'],
                        "totalmet" => $totalmet,
                    );
                }
                
            }
        } else {
            $idkuitansi = $_GET['idkuitansi'];
            $sql = mysqli_query($conn, "SELECT * FROM kuitansi k "
                    . "INNER JOIN rumah r "
                    . "on r.idrumah = k.idrumah "
                    . "INNER JOIN status s "
                    . "on s.idstatus = r.status "
                    . "where idkuitansi='" . $idkuitansi . "'");
            if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_array($sql)) {
                    $totalmet = $row['met_ini'] - $row['met_lalu'];
                    switch ($row['bulan']) {
                        case 1:
                            $blnini = "Januari";
                            $blnlalu = "Desember";
        //                        $tahunlalu = strval((intval($tahun) - 1));
                            break;
                        case 2:
                            $blnini = "Februari";
                            $blnlalu = "Januari";
                            break;
                        case 3:
                            $blnini = "Maret";
                            $blnlalu = "Februari";
                            break;
                        case 4:
                            $blnini = "April";
                            $blnlalu = "Maret";
                            break;
                        case 5:
                            $blnini = "Mei";
                            $blnlalu = "April";
                            break;
                        case 6:
                            $blnini = "Juni";
                            $blnlalu = "Mei";
                            break;
                        case 7:
                            $blnini = "Juli";
                            $blnlalu = "Juni";
                            break;
                        case 8:
                            $blnini = "Agustus";
                            $blnlalu = "Juli";
                            break;
                        case 9:
                            $blnini = "September";
                            $blnlalu = "Agustus";
                            break;
                        case 10:
                            $blnini = "Oktober";
                            $blnlalu = "September";
                            break;
                        case 11:
                            $blnini = "November";
                            $blnlalu = "Oktober";
                            break;
                        case 12:
                            $blnini = "Desember";
                            $blnlalu = "November";
                            break;
                    }
                    $array_kuitansi[] = array(
                        "idrumah" => $row['idrumah'],
                        "nama" => $row['nama'],
                        "bulan" => $blnini,
                        "blnlalu" => $blnlalu,
                        "tahun" => $row['tahun'],
                        "status" => $row['namastatus'],
                        "perawatanair" => $row['tarif_perawatanair'],
                        "tagihanair" => $row['tagihan_air'],
                        "sampah" => $row['iuran_sampah'],
                        "keamanan" => $row['iuran_keamanan'],
                        "kebersihan" => $row['iuran_kebersihan'],
                        "rw" => $row['iuran_rw'],
                        "kt" => $row['iuran_kt'],
                        "mertideso" => $row['iuran_mertideso'],
                        "total" => $row['total'],
                        "metini" => $row['met_ini'],
                        "metlalu" => $row['met_lalu'],
                        "totalmet" => $totalmet,
                    );
                }
            } else {
                echo '<script>'
                    . 'alert("Data kuitansi tidak ditemukan: Belum melakukan pembayaran!");'
                    . 'window.close();'
                    . '</script>';
                }
        }
//        if (isset($_POST['cetak'])) {
//            $array_idkuitansi = $_POST['id'];
//            foreach ($array_idkuitansi as $id) {
//                $sql_all = mysqli_query($conn, "SELECT * FROM kuitansi k "
//                        . "INNER JOIN rumah r "
//                        . "on r.idrumah = k.idrumah "
//                        . "INNER JOIN status s "
//                        . "on s.idstatus = r.status "
//                        . "where idkuitansi='" . $id . "'");
//                
//            }
//        } else {
//            $idrumah = $_GET['idrumah'];
//                $bulan = $_GET['bulan'];
//                $tahun = $_GET['tahun'];
//                $idkuitansi = "$idrumah-$bulan.$tahun";
//
//                switch ($bulan) {
//                    case 1:
//                        $blnini = "Januari";
//                        $blnlalu = "Desember";
//                        $tahunlalu = strval((intval($tahun) - 1));
//                        break;
//                    case 2:
//                        $blnini = "Februari";
//                        $blnlalu = "Januari";
//                        break;
//                    case 3:
//                        $blnini = "Maret";
//                        $blnlalu = "Februari";
//                        break;
//                    case 4:
//                        $blnini = "April";
//                        $blnlalu = "Maret";
//                        break;
//                    case 5:
//                        $blnini = "Mei";
//                        $blnlalu = "April";
//                        break;
//                    case 6:
//                        $blnini = "Juni";
//                        $blnlalu = "Mei";
//                        break;
//                    case 7:
//                        $blnini = "Juli";
//                        $blnlalu = "Juni";
//                        break;
//                    case 8:
//                        $blnini = "Agustus";
//                        $blnlalu = "Juli";
//                        break;
//                    case 9:
//                        $blnini = "September";
//                        $blnlalu = "Agustus";
//                        break;
//                    case 10:
//                        $blnini = "Oktober";
//                        $blnlalu = "September";
//                        break;
//                    case 11:
//                        $blnini = "November";
//                        $blnlalu = "Oktober";
//                        break;
//                    case 12:
//                        $blnini = "Desember";
//                        $blnlalu = "November";
//                        break;
//                }
//
//                if ($blnlalu == "Desember") {
//                    $sql_m = "SELECT * "
//                            . "FROM meteran "
//                            . "WHERE (idrumah='" . $idrumah . "' AND bulan='" . $blnini . "' AND tahun='" . $tahun . "') "
//                            . "OR (idrumah='" . $idrumah . "' AND bulan='" . $blnlalu . "' AND tahun='" . $tahunlalu . "') "
//                            . "ORDER BY tahun";
//                } else {
//                    $sql_m = "SELECT * "
//                            . "FROM meteran "
//                            . "WHERE idrumah='" . $idrumah . "' "
//                            . "AND bulan IN ('" . $blnini . "','" . $blnlalu . "') "
//                            . "AND tahun='" . $tahun . "'";
//                }
//                $meteran = array();
//                $result_m = mysqli_query($conn, $sql_m);
//                while ($row = mysqli_fetch_array($result_m)) {
//                    $meteran[] = array(
//                        "meteran" => $row['angkameteran']
//                    );
//                }
//                $met_array = json_encode($meteran);
//                $sql_all = mysqli_query($conn, "SELECT * FROM kuitansi k "
//                        . "INNER JOIN rumah r "
//                        . "on r.idrumah = k.idrumah "
//                        . "INNER JOIN status s "
//                        . "on s.idstatus = r.status "
//                        . "where idkuitansi='" . $idkuitansi . "'");
//
//
//                if (mysqli_num_rows($sql_all) > 0) {
//                    $result_all = mysqli_fetch_array($sql_all);
//                    $idkuitansi = $result_all['idkuitansi'];
//                    $idrumah = $result_all['idrumah'];
//                    $nama = $result_all['nama'];
//                    $status = $result_all['namastatus'];
//                    $metini = number_format($meteran[1]['meteran'], 0, ",", ".");
//                    $metlalu = number_format($meteran[0]['meteran'], 0, ",", ".");
//                    $val_metini = $meteran[1]['meteran'];
//                    $val_metlalu = $meteran[0]['meteran'];
//                    $tahun = $result_all['tahun'];
//                    $instalasiair = number_format($result_all['tarif_perawatanair'], 0, ",", ".");
//                    $tagihanair = number_format($result_all['tagihan_air'], 0, ",", ".");
//                    $sampah = number_format($result_all['iuran_sampah'], 0, ",", ".");
//                    $keamanan = number_format($result_all['iuran_keamanan'], 0, ",", ".");
//                    $kebersihan = number_format($result_all['iuran_kebersihan'], 0, ",", ".");
//                    $rw = number_format($result_all['iuran_rw'], 0, ",", ".");
//                    $kt = number_format($result_all['iuran_kt'], 0, ",", ".");
//                    $mertideso = number_format($result_all['iuran_mertideso'], 0, ",", ".");
//                    $total = number_format($result_all['total'], 0, ",", ".");
//                    $totalair = $val_metini - $val_metlalu;
//                    $array_kuitansi[] = array(
//                        "idkuitansi" => $idkuitansi,
//                        "idrumah" => $idrumah,
//                        "nama" => $nama,
//                        "status" => $status,
//                        "metini" => $metini,
//                        "metlalu" => $metlalu,
//                        "val_metini" => $val_metini,
//                        "val_metlalu" => $val_metlalu,
//                        "tahun" => $tahun,
//                        "bulan" => $blnini,
//                        "instalasiair" => $instalasiair,
//                        "tagihanair" => $tagihanair,
//                        "sampah" => $sampah,
//                        "keamanan" => $keamanan,
//                        "kebersihan" => $kebersihan,
//                        "rw" => $rw,
//                        "kt" => $kt,
//                        "mertideso" => $mertideso,
//                        "total" => $total,
//                        "totalair" => $totalair
//                    );
//                } else {
//                    echo '<script>'
//                    . 'alert("Data kuitansi tidak ditemukan: Belum melakukan pembayaran\nMengalihkan ke menu pembayaran");'
//                    . 'window.close();'
//                    . '</script>';
//                }
//            }
        ?>
        <script>
            
        </script>
        <div class="container-fluid">
            <div class="col text-center" style="margin: 20px">
                <a class="btn btn-primary btn-lg" id="print" >
                    Cetak!
                </a>
            </div>
            <div class="container-fluid" id="printable">
            <?php foreach ($array_kuitansi as $v) { ?>
                <input type="text" id="<?php echo $v['idrumah']; ?>" value="<?php echo $v['idrumah']; ?> " hidden>
                
                    <div class="col text-center">
                        <h2>KUITANSI PEMBAYARAN</h2>
                        <div class="col text-center col-form-label">
                            <h6>Tanggal Cetak: <?php echo date("d/m/Y H:i:s"); ?></h6>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col">
                        <div class="row d-flex justify-content-start">
                            <div class="col-1"></div>
                            <div class="col-2 text-start col-form-label" >
                                <label style="font-weight: bold">NO RUMAH</label>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control-plaintext text-end" style="font-weight: bold" id="idrumah" disabled="" value="<?php echo $v['idrumah']; ?>">
                            </div>
                            <div class="col-3 text-start col-form-label">
                                <label style="font-weight: bold">TAHUN</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control-plaintext text-end" style="font-weight: bold" disabled="" value="<?php echo $v['tahun']; ?>">
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-1"></div>
                            <div class="col-2 text-start col-form-label line">
                                <label style="font-weight: bold">NAMA</label>
                            </div>
                            <div class="col-3 line">
                                <input type="text" class="form-control-plaintext text-end" style="font-weight: bold" disabled="" value="<?php echo $v['nama']; ?>">
                            </div>
                            <div class="col-3 text-start col-form-label line">
                                <label style="font-weight: bold">BULAN</label>
                            </div>
                            <div class="col-2 line">
                                <input type="text" class="form-control-plaintext text-end" style="font-weight: bold" disabled="" value="<?php echo $v['bulan']; ?>">
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="col" style="margin-top: 10px">
                                <div class="row d-flex justify-content-start">
                                    <div class="col-2"></div>
                                    <div class="col-4 text-start col-form-label">
                                        <label style="font-style: italic">KATEGORI</label>
                                    </div>
                                    <div class="col-6">
                                        <input style="font-style: italic" type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo $v['status']; ?>">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-3"></div>
                                    <div class="col-5 text-start col-form-label">
                                        <label>Perawatan Instalasi Air</label>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-start col-form-label">
                                        <label>< 10 m3</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['perawatanair'], 0,",","."); ?>">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-start col-form-label">
                                        <label>> 10 m3</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['tagihanair'], 0, ",", "."); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row d-flex justify-content-start">
                                    <div class="col-3"></div>
                                    <div class="col-5 col-form-label">
                                        <label>Pemakaian Air</label>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-4"></div>
                                    <div class="col-4 col-form-label">
                                        <label><?php echo $v['bulan']; ?></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['metini'],0,",","."); ?>">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-4"></div>
                                    <div class="col-4 col-form-label">
                                        <label><?php echo $v['blnlalu']; ?></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['metlalu'],0,",","."); ?>">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-4"></div>
                                    <div class="col-4 col-form-label">
                                        <label>Total Pemakaian</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['totalmet'],0,",","."); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="">
                            <div class="row d-flex justify-content-end" style="margin-top: 10px">
                                <div class="col-6 text-start col-form-label">
                                    <label>Perawatan Instalasi Air dan Fasum</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['perawatanair'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-6 text-start col-form-label">
                                    <label>Biaya Pemakaian Air</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['tagihanair'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran Sampah</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['sampah'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran Kebersihan</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['kebersihan'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran Keamanan</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['keamanan'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran RW</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['rw'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran Karang Taruna</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['kt'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-6 text-start col-form-label">
                                    <label>Iuran Sedekah Bumi/Mertideso</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['mertideso'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row justify-content-md-center" style="font-weight: bold">
                                <div class="col-6 text-start col-form-label">
                                    <label>Total Tagihan</label>
                                </div>
                                <div class="col-1 col-form-label text-end">Rp.</div>
                                <div class="col-3">
                                    <input style="font-weight: bold" type="text" class="form-control-plaintext text-end" disabled="" value="<?php echo number_format($v['total'],0,",","."); ?>">
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col text-center" style="margin-top:10px; border-top-style: solid">
                            <i>Call Center: 0895-3216-42031</i><br>
                            <i>Rek. paguyuban: 7722666601 (BSI) Paguyuban GTR Al Muttaqiin</i>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="display" id="break_page" style="page-break-after: always"></div>

                
                
            <?php }?>
            </div>
            
            
            




        </div>
    </body>

    <script type="text/javascript" src="asset/jquery/printThis.js"></script>
    <script>
        $(document).ready(function () {
            $('#print').click(function () {
                $('#printable').printThis({
                    loadCSS: "PembayaranAir/asset/bootstrap/css/bootstrap.min.css",
                    debug: true
                });
            });
//            console.log(<?php echo json_encode($array_kuitansi);?>);
        });
    </script>
</html>
