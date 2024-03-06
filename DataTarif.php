<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'Config.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Data Tarif</title>
        <script src="asset/jquery/jquery-3.6.3.min.js"></script>
        <script src="asset/dataTables/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="asset/jquery/jquery-ui.css">
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="asset/dashboard/navbar.css">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/dataTables.bootstrap5.min.css">
        <style>
                .sidebar {
                    min-width: 200px;
                }
                #data_tabel_air, #data_tabel_iuran {
                    min-width: 1000px;
                }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light border-5 border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="d-inline-flex align-items-center gap-lg-3">
                        <!--<div class="col-sm-2">-->
                        <img src="asset/img/Home.png" alt="Logo" width="60" height="60" class="">
                        <!--</div>-->
                        <!--<div class="col-sm-5">-->
                        <h1 class="text-black">PERUMAHAN ABC</h1>
                        <!--</div>-->
                    </div>
                </a>
                <div class="dropdown">
                    <a class="btn btn-sm btn-light float-end toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="asset/img/bell-regular.svg" width="25" height="25">
                        <span class="badge text-bg-info count position-absolute top-0 start-100 translate-middle rounded-pill"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end"></ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-2 mx-auto sidebar" style="padding-top: 10px">
                    <div class="list-group flex-column sticky-top">
                        <!--<a class="list-group-item list-group-item-action" style="text-align: left" href="Index.php">Home</a>-->
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="Pembayaran.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action list-active" style="text-align: left" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#air">Tarif Air</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#sampah">Tarif Iuran</a>
<!--                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#kebersihan">Tarif Kebersihan</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#keamanan">Tarif Keamanan</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#rw">Tarif RW</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#kt">Tarif Karang Taruna</a>
                        <a class="list-group-item list-group-item-action px-5" style="text-align: left" href="#mertideso">Tarif Mertideso</a>-->
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <div class="col" style="margin-top: 10px">
                    <div class="placeholder col-12 align-items-center justify-content-center" id="spinner">
                        <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="alertPlaceholder" style="">
                    </div>
                    <!--<div class="card card-body" >-->
                    <h2>Tambah Data Tarif</h2>
                    <form id="input_tarif">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <!--<div class="col-sm-8">-->
                                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" required="">
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="air" id="check_tarifair" name="check_tarifair">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Klik centang untuk tidak menambahkan tarif air
                                    </label>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="status" id="status">
                                            <!--<option id="disabledSelect" value="" disabled="" selected="">Disabled</option>-->
                                            <?php
                                            $status_sql = mysqli_query($conn, "SELECT * FROM status");
                                            while ($row = mysqli_fetch_array($status_sql)) {
                                                echo '<option value=' . $row["idstatus"] . '>' . $row["namastatus"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label">Tarif Perawatan Air</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" name="tarif_awalair" id="tarif_awalair" required="">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label">Tarif Tagihan Air</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" name="tarif_lebihair" id="tarif_lebihair" required="">
                                    </div>
                                </div>
                                <div class="mb-1 row d-inline-block">
                                    <div class="col-sm-12 d-inline-block"> </div>
                                    <div class="col-sm-12 d-inline-block"></div>
                                    <div class="col-sm-12 d-inline-block"></div>
                                    <div class="col-sm-12 d-inline-block"></div>
                                    <div class="col-sm-12 d-inline-block"></div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="iuran" id="check_iuran" name="check_iuran">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Klik centang untuk tidak menambahkan tarif iuran lainnya
                                    </label>
                                </div>
                                <div id="iuran">
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif Sampah</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="tarif_sampah" id="tarif_sampah" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif Kebersihan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="tarif_kebersihan" id="tarif_kebersihan" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif Keamanan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="tarif_keamanan" id="tarif_keamanan" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif RW</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="tarif_rw" id="tarif_rw" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif Karang Taruna</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="tarif_kt" id="tarif_kt" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-4 col-form-label">Tarif Mertideso</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="tarif_mertideso" id="tarif_mertideso" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="col-md-12 d-flex justify-content-end">
                                <input class="btn btn-primary btn-add" type="submit" name="submit_tarifbaru" value="Tambah">
                            </div>
                        </div>
                    </form>
                    <!--<for id="input_tarif">-->
                        <!--<div class="col-sm-8 d-flex mb-2">-->
                            <!--<label class="col-sm-2 col-form-label">No </label>-->
                        <!--</div>-->
                    <!--</for>-->
                        <!--AIR-->
                        <div class="d-grid rounded" style="margin-top: 10px">
                            <button type="button" class="d-flex justify-content-between btn btn-info bg-gradient border border-5 border-primary border-top-0 border-end-0 border-bottom-0" data-bs-toggle="collapse" data-bs-target="#aircollapse" aria-expanded="true" aria-controls="aircollapse">
                                <h3 id="air">DATA TARIF AIR</h3>
                                <img src="asset/img/caret-down-solid.svg" width="30" height="30"></img>
                            </button>

                        </div>
                        <?php
                        

                        $query = "SELECT * FROM tarif_air "
                                . "INNER JOIN status ON tarif_air.status = status.idstatus "
                                . "ORDER BY tgl_mulai, status";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Gagal terhubung ke database : " . mysqli_error($conn));
                        }
//                        $data = mysqli_fetch_all($result);
                        $data = $result->fetch_all(MYSQLI_ASSOC);
//                        echo '<script>console.log('.json_encode($data).');</script>';
                        ?>
                        <div class="collapse show" id="aircollapse">
                            <div class="card card-body border border-5 p-2">
<!--                                <form action="inputTarifAction.php" method="post">
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="date" name="tgl_mulai_air" id="tgl_mulai_air" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-5">
                                            <select class="form-select" name="status" id="status">
                                                <?php
                                                $status_sql = mysqli_query($conn, "SELECT * FROM status");
                                                while ($row = mysqli_fetch_array($status_sql)) {
                                                    echo '<option value=' . $row["idstatus"] . '>' . $row["namastatus"] . '</option>';
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tarif Awal</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" name="tarif_awalair" id="tarif_awalair" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tarif Lebih</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" name="tarif_lebihair" id="tarif_lebihair" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-7 d-grid justify-content-end">
                                        <input class="btn btn-primary btn-add" type="submit" name="submit_air" value="Tambah">

                                    </div>

                                </form>-->

                                <div class="table-responsive">
                                    <table class="table table-light table-striped table-hover" id="data_tabel_air">
                                        <thead class="">
                                            <tr>
                                                <!--<th>No.</th>-->
                                                <th>Status Warga</th>
                                                <th>Tgl Mulai</th>
                                                <th>Tarif Awal</th>
                                                <th>Tarif Lebih</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
//                                            $i = 1;
//                                            foreach ($data as $datas) {
//                                                $tgl_mulai = date_create($datas['tgl_mulai']);
//                                                echo '<tr>';
//                                                echo '<td>' . $i++;
//                                                '</td>';
//                                                echo '<td>' . $datas['namastatus'];
//                                                '</td>';
//                                                echo '<td>' . date_format($tgl_mulai, "d-m-Y");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_awal'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_lebih'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-warning btn-sm buka-detail"'
//                                                . 'data-bs-toggle="modal" data-bs-target="#detailTarif" '
//                                                . 'data-bs-id={"id":"' . $datas['idtarifair'] . '","kategori":"air"}>'
//                                                . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
//                                                . 'Lihat Detail</button>'
//                                                . '</td>';
//                                                echo '</tr>';
//                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--AIR END-->

                        <!--SAMPAH-->
                        <?php
                        $sampah = mysqli_query($conn, "SELECT * FROM tarif_iuran");
                        $data = $sampah->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <div class="d-grid " style="margin-top: 10px">
                            <button type="button" class="d-flex justify-content-between btn btn-info bg-gradient border border-5 border-primary border-top-0 border-end-0 border-bottom-0" data-bs-toggle="collapse" data-bs-target="#sampahcollapse" aria-pressed="true" aria-expanded="false" aria-controls="aircollapse">
                                <h3 id="sampah">DATA TARIF IURAN</h3>
                                <img src="asset/img/caret-down-solid.svg" width="30" height="30"></img>
                            </button>
                        </div>
                        <div class="collapse show" id="sampahcollapse">
                            <div class="card card-body border border-5">
<!--                                <form action="inputTarifAction.php" method="post">
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="date" name="tgl_mulai_sampah" id="tgl_mulai_sampah" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tarif</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="number" name="tarif_sampah" id="tarif_sampah" required="">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-4 d-grid justify-content-end">
                                        <input class="btn btn-primary " type="submit" name="submit_sampah" value="Tambah">
                                    </div>
                                </form>-->

                                <div class="table-responsive">
                                    <table class="table table-light table-striped table-hover" id="data_tabel_iuran">
                                        <thead class="">
<!--                                            <tr>
                                                <th rowspan="2">No.</th>
                                                <th rowspan="2">Tgl Mulai</th>
                                                <th colspan="6">Tarif</th>
                                                <th rowspan="2">Action</th>
                                            </tr>-->
                                            <tr>
                                                <!--<th>No.</th>-->
                                                <th>Tgl Mulai</th>
                                                <th>Sampah</th>
                                                <th>Kebersihan</th>
                                                <th>Keamanan</th>
                                                <th>RW</th>
                                                <th>Karang Taruna</th>
                                                <th>Mertideso</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            <?php
//                                            $i = 1;
//                                            foreach ($data as $datas) {
//                                                $tgl_mulai = date_create($datas['tgl_mulai']);
//                                                echo '<tr>';
//                                                echo '<td>' . $i++;
//                                                '</td>';
//                                                echo '<td>' . date_format($tgl_mulai, "d-m-Y");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_sampah'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_kebersihan'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_keamanan'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_rw'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_kt'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td> Rp. ' . number_format($datas['tarif_mertideso'], 0, ",", ".");
//                                                '</td>';
//                                                echo '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm btn-warning buka-detail" '
//                                                . 'data-bs-toggle="modal" data-bs-target="#detailTarif" '
//                                                . 'data-bs-id={"id":"' . $datas['idtarifiuran'] . '","kategori":"iuran"}>'
//                                                . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
//                                                . 'Lihat Detail</button>'
//                                                . '</td>';
//                                                echo '</tr>';
//                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--SAMPAH END-->

                        
                    
                <!--</div>-->
            </div>
        </div>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="detailTarif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailMeteranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Tarif</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="simpan_tarif" action="ajax/simpanTarifAction.php" method="post">
                        <div class="modal-body">
                            <div class="placeholder bg-light justify-content-center align-items-center" id="spinnerModal">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                                    <!--<p class="">Loading...</p>-->
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Tarif</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="kategori" id="kategori" readonly="">
                                    <input class="form-control-plaintext" type="text" name="idtarif" id="idtarif" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_iuran">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="status" id="status" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Tgl Mulai</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="type" name="tgl_mulai" id="tgl_mulai" readonly="">
                                    <input class="form-control-plaintext" type="date" name="val_tgl_mulai" id="val_tgl_mulai" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_iuran">
                                <label class="col-sm-4 col-form-label" for="tarif">Tarif Awal</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_awal" id="tarif_awal">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_iuran">
                                <label class="col-sm-4 col-form-label">Tarif Lebih</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_lebih" id="tarif_lebih">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif Sampah</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_sampah" id="tarif_sampah">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif Kebersihan</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_kebersihan" id="tarif_kebersihan">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif Keamanan</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_keamanan" id="tarif_keamanan">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif RW</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_rw" id="tarif_rw">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif Karang Taruna</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_kt" id="tarif_kt">
                                </div>
                            </div>
                            <div class="row mb-2" name="remove_air">
                                <label class="col-sm-4 col-form-label">Tarif Mertideso</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="tarif_mertideso" id="tarif_mertideso">
                                </div>
                            </div>
                            <div id="alertPlaceholderUpdate" style=""></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary pe-2 ps-2" id="simpan" name="simpan" value="Simpan">
                            <input type="submit" class="btn btn-danger pe-2 ps-2" id="hapus" name="hapus" value="Hapus">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/jquery.dataTables.js"></script>
        <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="asset/jquery/jquery-ui.js"></script>
    </body>
</html>

<script>
    $(document).ready( function () {
        var tabel_air = $('#data_tabel_air').DataTable({
            scrolX: true,
            processing: true,
            autoWidth: false,
            ajax: {
                url:'ajax/tampiltarif.php',
                data:{view:'reload',kategori:'air'},
                type:'post'
            },
            columns:[
//                {data:'no'},
                {data:'status'},
                {data:'tgl'},
                {data:'tarifawal'},
                {data:'tariflebih'},
                {data:'action'}
            ],
            order:[]
        });
        
        var tabel_iuran = $('#data_tabel_iuran').DataTable({
            scrolX: true,
            processing: true,
            autoWidth: false,
            ajax: {
                url:'ajax/tampiltarif.php',
                data:{view:'reload',kategori:'iuran'},
                type:'post'
            },
            columns:[
//                {data:'no'},
                {data:'tgl'},
                {data:'sampah'},
                {data:'kebersihan'},
                {data:'keamanan'},
                {data:'rw'},
                {data:'kt'},
                {data:'mertideso'},
                {data:'action'}
            ],
            order:[]
        });
        
        tabel_air.columns.adjust().draw();
        tabel_iuran.columns.adjust().draw();
        
        function load_unseen_notif(view = '') {
            $.ajax({
                url:'ajax/fetch.php',
                method:'post',
                data:{view:view},
                dataType:'json',
                success:function(data){
//                    console.log(data);
                    $('.dropdown-menu').html(data.notif);
                    if (data.unseen_notif > 0) {
                        $('.count').html(data.unseen_notif);
                    } else {
                        $('.count').html('');
                    }
                },
                error:function(data,status,err){
                    var a = JSON.stringify(data);
                    console.log(a);
                    console.log(status);
                    console.log(err);
                }
            });
        }
        
        function tampil_alert (pesan, model, id) {
            $('#alertPlaceholder'+id).append('<div class="alert alert-dismissible alert-'+model+' d-flex align-items-center gap-2 fade show" role="alert">\n\
                <img src="asset/img/warning.png" width="15" height="15">\n\
                '+pesan+'\n\
                <buttton type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
        
        load_unseen_notif();
        
        $(document).on('click','.toggle',function(){
//            $('.count').html('');
            load_unseen_notif('yes');
        });
        
        setInterval(function(){
            load_unseen_notif();
        }, 10000);
        
        $("#detailTarif").on('show.bs.modal',function(e){
            $('#simpan, #hapus').removeClass('disabled');
            $('.alert').remove();
            var idtarif = $(e.relatedTarget).data('bs-id').id;
            var kategori = $(e.relatedTarget).data('bs-id').kategori;
//            console.log(idtarif+'   '+kategori);
            $.ajax({
                url:'ajax/tampiltarif.php',
                type:'post',
                data:{idtarif:idtarif,kategori:kategori,view:'detail'},
                dataType:'json',
                success:function(data){
//                    console.log(data);
                    $('#detailTagihan').find('.modal-header').html("Detail Tarif");
                    if (kategori == "air") {
                        $('#detailTarif').find('.modal-body div[name="remove_iuran"]').show();
                        $('#detailTarif').find('.modal-body input[id="kategori"]').val(kategori.toUpperCase());
                        $('#detailTarif').find('.modal-body input[id="idtarif"]').val(data.air.id);
                        $('#detailTarif').find('.modal-body input[id="status"]').val(data.air.status);
                        $('#detailTarif').find('.modal-body input[id="tgl_mulai"]').val(data.air.tgl);
                        $('#detailTarif').find('.modal-body input[id="val_tgl_mulai"]').val(data.air.val_tgl);
                        $('#detailTarif').find('.modal-body input[id="tarif_awal"]').val(data.air.tarif_awal);
                        $('#detailTarif').find('.modal-body input[id="tarif_lebih"]').val(data.air.tarif_lebih);
                        $('#detailTarif').find('.modal-body div[name="remove_air"]').hide();
                    } else {
                        $('#detailTarif').find('.modal-body div[name="remove_air"]').show();
                        $('#detailTarif').find('.modal-body input[id="kategori"]').val(kategori.toUpperCase());
                        $('#detailTarif').find('.modal-body input[id="idtarif"]').val(data.iuran.id);
                        $('#detailTarif').find('.modal-body input[id="tgl_mulai"]').val(data.iuran.tgl);
                        $('#detailTarif').find('.modal-body input[id="val_tgl_mulai"]').val(data.iuran.val_tgl);
                        $('#detailTarif').find('.modal-body input[id="tarif_sampah"]').val(data.iuran.tarif_sampah);
                        $('#detailTarif').find('.modal-body input[id="tarif_kebersihan"]').val(data.iuran.tarif_kebersihan);
                        $('#detailTarif').find('.modal-body input[id="tarif_keamanan"]').val(data.iuran.tarif_keamanan);
                        $('#detailTarif').find('.modal-body input[id="tarif_rw"]').val(data.iuran.tarif_rw);
                        $('#detailTarif').find('.modal-body input[id="tarif_kt"]').val(data.iuran.tarif_kt);
                        $('#detailTarif').find('.modal-body input[id="tarif_mertideso"]').val(data.iuran.tarif_mertideso);
                        $('#detailTarif').find('.modal-body div[name="remove_iuran"]').hide();
                        $('#detailTarif').find('.modal-body label[for="tarif"]').html('Tarif');
                        
                    }
                    
                },
                error:function(data,status,err){
                    console.log(status);
                    console.log(err);
                }
            });
        });
        
        $('#input_tarif').submit(function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
//            console.log(form_data);
            $.ajax({
                url:'ajax/inputTarifAction.php',
                type:'post',
                data:form_data,
                dataType:'json',
                encode:true,
                beforeSend:function(){
                    $('#spinner').css('display', 'flex');
                },
                success:function(data){
//                    $('.alert').fadeOut();
                    $('.alert').remove();
                    console.log(data);
                    if ($('#check_tarifair').prop('checked')) {
                        if (!data.success.iuran) {
                            tampil_alert(data.pesan.iuran,'warning','');
                        } else {
                            tampil_alert(data.pesan.iuran,'success','');
                        }
                    }
                    
                    if ($('#check_iuran').prop('checked')) {
                        if (!data.success.air) {
                            tampil_alert(data.pesan.air,'warning','');
                        } else {
                            tampil_alert(data.pesan.air, 'success','')
                        }
                    }
                    
                    if ($('#check_tarifair').not(':checked').length && $('#check_iuran').not(':checked').length) {
                        $('.alert').remove();
                        if (!data.success.iuran) {
                            tampil_alert(data.pesan.iuran,'warning','');
                        } else {
                            tampil_alert(data.pesan.iuran,'success','');
                        }
                        if (!data.success.air) {
                            tampil_alert(data.pesan.air,'warning','');
                        } else {
                            tampil_alert(data.pesan.air, 'success','')
                        }
                    }
                    
                },
                error:function(data,err,status){
                    console.log(data);
                    console.log(status);
                    console.log(err);
                },
                complete:function(){
                    setTimeout(function(){
                        tabel_air.ajax.reload();
                        tabel_iuran.ajax.reload();
                        $("#spinner").hide();
                    }, 1000);
                    
                }
            });
        });
        
        $('#simpan_tarif').submit(function(e){
            e.preventDefault();
            var tombol = event.submitter.value;
            var formData = $(this).serialize()+"&tombol="+tombol;
//            console.log(formData);
            $.ajax({
                url:'ajax/simpanTarifAction.php',
                type:'post',
                data:formData,
                dataType:'json',
                beforeSend:function(){
                    $('#detailTarif').find('.modal-body div[id="spinnerModal"]').css('display','flex');
                    $('#simpan, #hapus').addClass('disabled');
                },
                success:function(data){
                    $('.alert').remove();
                    console.log(data);
                    tampil_alert(data.pesan,data.model,'Update');
                },
                error:function(data,err,status){
                    console.log(err);
                    console.log(status);
                    console.log(data);
                },
                complete:function(){
                    setTimeout(function(){
                        $('#detailTarif').find('.modal-body div[id="spinnerModal"]').hide();
                        tabel_air.ajax.reload();
                        tabel_iuran.ajax.reload();
                        if (tombol == 'Simpan') {
                            $('#simpan,#hapus').removeClass('disabled');
                        }
                    },1000);
                }
            });
        });
        
        $('#check_tarifair, #check_iuran').change(function(){
            if ($('#check_tarifair').prop('checked')) {
                $('select[name=status]').prop('disabled',true);
//                $('select #disabledSelect').prop('seelcted',true);
                $('input[name=tarif_awalair]').prop('disabled',true).attr('placeholder','');
                $('input[name=tarif_lebihair]').prop('disabled',true).attr('placeholder','');
            } else {
                $('select[name=status]').prop('disabled',false);
                $('input[name=tarif_awalair]').prop('disabled',false);
                $('input[name=tarif_lebihair]').prop('disabled',false);
            }
            
            if ($('#check_iuran').prop('checked')) {
                $('#iuran input').prop('disabled',true);
            } else {
                $('#iuran input').prop('disabled',false);
            }
            
            if ($('#check_tarifair').prop('checked') && $('#check_iuran').prop('checked')) {
//                alert('aaa');
                $('input[name=submit_tarifbaru]').addClass('disabled');
            } else {
                $('input[name=submit_tarifbaru]').removeClass('disabled');
            }
        });
    });
</script>