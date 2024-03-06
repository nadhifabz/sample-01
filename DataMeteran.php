<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<?php
include 'Config.php';

$query = "SELECT * FROM rumah";
$result = mysqli_query($conn, $query);
if(!$result){
    die("Gagal terhubung ke database : ".mysqli_error($conn));
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="asset/jquery/jquery-3.6.3.min.js"></script>
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="asset/dashboard/navbar.css">
        <link rel="stylesheet" type="text/css" href="asset/jquery/jquery-ui.css">
        <script type="text/javascript" charset="utf8" src="asset/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="asset/jquery/jquery-ui.js"></script>
        <style>
                .sidebar {
                    min-width: 200px;
                }
                #data_tabel {
                    min-width: 1000px;
                }
        </style>
        
    </head>
    <body class="" style="">
        
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
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="Pembayaran.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action list-active" style="text-align: left" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <div class="col-10 mx-auto" style="margin-top: 10px">
                    <!--progress-->
<!--                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="progressToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <img src="..." class="rounded me-2" alt="...">
                                <strong class="me-auto">Bootstrap</strong>
                                <small>11 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Hello, world! This is a toast message.
                            </div>
                        </div>
                    </div>-->
                    
                    <!--alert-->
                    <div class="placeholder col-12 align-items-center justify-content-center" id="spinner" style="display: flex;">
                        <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <div class="card position-relative overflow-hidden border-0" id="content">
                        <div class="card-body">
                            <div id="alertPlaceholder" style=""></div>
                            <h2>Masukkan Meteran</h2>
                            <form id="input_meteran" action="inputMeteranAction.php" method="post">
                                <div class="col-md-8 ps-5">
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Tahun</label>
                                        <div class="col-sm">
                                            <select class="form-select" name="tahun" id="tahun">
                                                <?php
                                                $tahun = date("Y");
                                                for ($i = 2021; $i <= $tahun; $i++) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Bulan</label>
                                        <div class="col-sm">
                                            <select class="form-select" name="bulan" id="bulan">
                                                <!--<option id="default_bulan" value="0" selected hidden readonly>Pilih bulan</option>
                                                -->
                                                <option value=1 id="default_bulan" selected>Januari</option>
                                                <option value=2>Februari</option>
                                                <option value=3>Maret</option>
                                                <option value=4>April</option>
                                                <option value=5>Mei</option>
                                                <option value=6>Juni</option>
                                                <option value=7>Juli</option>
                                                <option value=8>Agustus</option>
                                                <option value=9>September</option>
                                                <option value=10>Oktober</option>
                                                <option value=11>November</option>
                                                <option value=12>Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">No Rumah</label>
                                        <div class="col-sm">
                                            <select class="form-select" name="id_rumah" id="selected_id">
                                                <option value="0" selected hidden>Pilih Nomor Rumah</option>
                                                <?php
                                                while ($get_id_rumah = mysqli_fetch_assoc($result)) {
                                                    $i = 1;
                                                    ?>
                                                    <option value="<?php echo $get_id_rumah['idrumah'] ?>" id="<?php echo 'rumah' . $i; ?>">
                                                        <?php echo $get_id_rumah['idrumah']." - ".$get_id_rumah['nama']; ?></option>
                                                    <?php
                                                    $i = $i + 1;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm">
                                            <input class="form-control-plaintext" type="text" name="nama" id="nama" readonly="">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm">
                                            <input class="form-control-plaintext" type="text" name="status" id="status" readonly="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Meteran</label>
                                        <div class="col-sm">
                                            <input class="form-control" type="number" name="meteran" id="meteran" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 gap-5 d-inline-flex align-items-end justify-content-end">
                                        <a class="btn btn-light" href="#" data-bs-toggle="modal" data-bs-target="#importMeteran" style="text-decoration: #000;">Import CSV</a>
                                        <input class="btn btn-primary" type="submit" name="tambah" value="Tambah">
                                    </div>
                                </div>
                            </form>
                            <br>

                            <div class="table-responsive">
                                <h1>DATA METERAN</h1>
                                <?php
//                                $meteran = mysqli_query($conn, "SELECT meteran.idmeteran, meteran.idrumah, meteran.bulan, "
//                                        . "meteran.tahun, meteran.angkameteran, rumah.nama, bulan.namabulan "
//                                        . "FROM meteran "
//                                        . "INNER JOIN bulan ON bulan.idbulan = meteran.bulan "
//                                        . "INNER JOIN rumah ON rumah.idrumah = meteran.idrumah "
//                                        . "ORDER BY idrumah, tahun, STR_TO_DATE(CONCAT(tahun,enbulan,'01'),'%Y %M %d')");
                                ?>
                                <table class="table table-light table-hover" id="data_tabel">

                                    <thead>
                                        <tr>
                                            <th>No. Rumah</th>
                                            <th>Nama</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Meteran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
//                                        while ($row = mysqli_fetch_assoc($meteran)) {
//                                            echo '<tr>';
//                                            echo '<td>' . $row['idrumah'];
//                                            '</td>';
//                                            echo '<td>' . $row['nama'];
//                                            '</td>';
//                                            echo '<td>' . $row['namabulan'];
//                                            '</td>';
//                                            echo '<td>' . $row['tahun'];
//                                            '</td>';
//                                            echo '<td>' . number_format($row['angkameteran'], 0, "'", ".") . '</td>';
//                                            echo '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm buka-detail btn-warning " '
//                                            . 'data-bs-toggle="modal" data-bs-target="#detailMeteran" '
//                                            . 'data-bs-id=' . $row['idmeteran'] . '>'
//                                            . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
//                                            . 'Lihat Detail</button>';
//                                            echo '</tr>';
//                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. Rumah</th>
                                            <th>Nama</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Meteran</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="importMeteran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importMeteranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">IMPORT DENGAN CSV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="" action="" method="post" id="upload_excel" name="upload_excel" enctype="multipart/form-data">
                        
                        <div class="modal-body">
                            <div class="placeholder bg-light justify-content-center align-items-center" id="spinnerModal">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                                    <!--<p class="">Loading...</p>-->
                                </div>
                            </div>
                            <div class="container-fluid d-flex justify-content-center">
                                <div class="row">
                                    <fieldset>

                                        <h5>Perhatikan format berkas .csv</h5>
                                        <ul>
                                            <li>Header pada Baris 1</li>
                                            <li>Data dimulai pada Baris 2, Kolom A</li>
                                            <li>Kolom A : No. Rumah</li>
                                            <li>Kolom B : Bulan dalam angka</li>
                                            <li>Kolom C : Tahun</li>
                                            <li>Kolom D : Angka Meteran</li>
                                            <li>Duplikasi data berarti menimpa data yang tersimpan</li>
                                        </ul>
                                        <div class="d-flex w-100 h-auto justify-content-center">
                                            <img src="asset/img/contoh-csv.png" width="300" height="300">
                                        </div>
                                        <!-- File Button -->
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-form-label" for="filebutton">Pilih Berkas</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="file" name="file" id="file" class="input-large" accept=".csv" required="">
                                            </div>
                                        </div>
                                        <div id="alertPlaceholderCSV" style=""></div>
<!--                                        <div class="row mb-3">
                                            <label class="col-md-4 col-form-label" for="singlebutton">Import data</label>
                                            <div class="col-md-4">
                                                <button type="submit" id="submit" name="import" class="btn btn-primary button-loading" data-loading-text="Loading..."></button>
                                            </div>
                                        </div>-->
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
<!--                            <div class="progress w-100">
                                <div class="progress-bar" id="progressbar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-label">Loading...</div>
                                </div>
                            </div>-->
                            <input type="submit" class="btn btn-primary pe-2 ps-2" id="submit" name="import" value="Import" data-loading-text="Loading...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="detailMeteran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailMeteranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Meteran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="simpan_meteran" action="ajax/simpanMeteranAction.php" method="post">
                        <div class="modal-body">
                            <div class="placeholder bg-light justify-content-center align-items-center" id="spinnerModal">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                                    <!--<p class="">Loading...</p>-->
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">No Rumah</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="idrumah" id="idrumah" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="nama" id="nama" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Bulan</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="bulan" id="bulan" readonly="">
                                    <input class="form-control-plaintext" type="text" name="val_bulan" id="val_bulan" readonly="" hidden="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Tahun</label>
                                <div class="col-sm">
                                    <input class="form-control-plaintext" type="text" name="tahun" id="tahun" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Meteran</label>
                                <div class="col-sm">
                                    <input class="form-control" type="number" name="meteran" id="meteran">
                                </div>
                            </div>
                            <div id="alertPlaceholderUpdate" style=""></div>
                        </div>
                        
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary pe-2 ps-2" id="simpan" name="tombol" value="Simpan">
                            <input type="submit" class="btn btn-danger pe-2 ps-2" id="hapus" name="tombol" value="Hapus">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/dataTables.fixedHeader.min.js"></script>
    </body>
</html>

<script>
    //$('body').on('change','#selected_id', function(){
    //   $('#nama').val($('#selected_id option:selected').val()); 
    //});-->
    $(document).ready(function(){
        $('#rumah1').prop("selected",true);
        var bulan = $('#bulan').val();
        var idrumah = $('#selected_id').val();
        var tahun = $('#tahun').val();
        
        const ptogressTrigger = $('#progressToast');
        var progressbar = $( "#progressbar" ), progressLabel = $( ".progress-label" );
        
        var tabel = $('#data_tabel').DataTable({
            scrolX: true,
            processing: true,
            autoWidth: false,
            ajax: {
                url:'tampilmeteran.php',
                data:{view:'reload'},
                type:'post'
            },
            columns:[
                {data:'idrumah'},
                {data:'nama'},
                {data:'bulan'},
                {data:'tahun'},
                {data:'meteran'},
                {data:'action'}
            ],
            fixedHeader: {
                footer: true
            }
        });
        $("#detailMeteran").on('show.bs.modal', function(e) {
            $('#simpan, #hapus').removeClass('disabled');
            $('.alert').remove();
            var idmeteran = $(e.relatedTarget).data('bs-id');
            $(e.currentTarget).find('input[name="idrumah"]').val(idmeteran);
            $.ajax({
                url:'tampilmeteran.php',
                type:'post',
                data:{idmeteran:idmeteran,view:'detail'},
                dataType:'json',
                success:function(data){
                    $('#detailMeteran').find('.modal-body input[id="nama"]').val(data[0]['nama']);
                    $('#detailMeteran').find('.modal-body input[id="idrumah"]').val(data[0]['idrumah']);
                    $('#detailMeteran').find('.modal-body input[id="bulan"]').val(data[0]['namabulan']);
                    $('#detailMeteran').find('.modal-body input[id="val_bulan"]').val(data[0]['bulan']);
                    $('#detailMeteran').find('.modal-body input[id="tahun"]').val(data[0]['tahun']);
                    $('#detailMeteran').find('.modal-body input[id="meteran"]').val(data[0]['meteran']);
                    
                },
                error:function(data,status,err){
                    var meteran = JSON.stringify(data);
                    console.log(meteran);
                    console.log(status);
                }
            });
        });
        
        function load_unseen_notif(view = '') {
            $.ajax({
                url:'ajax/fetch.php',
                method:'post',
                data:{view:view},
                dataType:'json',
                success:function(data){
                    console.log(data);
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
        
        load_unseen_notif();
        
        $(document).on('click','.toggle',function(){
//            $('.count').html('');
            load_unseen_notif('yes');
        });
        
        setInterval(function(){
            load_unseen_notif();
        }, 10000);
        
        function tampil_alert (pesan, model, id) {
            $('#alertPlaceholder'+id).append('<div class="alert alert-dismissible alert-'+model+' d-flex align-items-center gap-2 fade show" role="alert">\n\
                <img src="asset/img/warning.png" width="15" height="15">\n\
                '+pesan+'\n\
                <buttton type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
        
        function get_data_rumah (idrumah,bulan,tahun) { 
        
                $.ajax({
                    url:'namarumah.php',
                    type:'post',
                    data:{id_rumah:idrumah,bulan:bulan,totalair:0,tahun:tahun},
                    dataType:'JSON',
                    beforeSend: function () {
                        $('#spinner').css('display', 'flex');
                    },
                    success:function(data){
                        var jsonResult = $.parseJSON;
                        var biaya = data.result;
                        var meteran = data.result1;
                        var nama = biaya[0]['nama'];
                        var status = biaya[0]['status'];
                        var idtarif = data.idtarif;

                        //data rumah
                        $('#nama').val(nama);
                        $('#status').val(status);
                    },
                    complete: function(){
                        setTimeout(function(){
                            $("#spinner").hide();
                        }, 50);
                        
                    }
             });
        }
        
        get_data_rumah(idrumah,bulan,tahun);
        
        $('#input_meteran').change(function(){
            var bulan = $('#bulan').val();
            var idrumah = $('#selected_id').val();
            var tahun = $('#tahun').val();
            get_data_rumah(idrumah,bulan,tahun);
            
        });
        
        $('#input_meteran').submit(function(e){
            e.preventDefault();
            var inputData = $(this).serialize();
//            console.log(inputData);
            $.ajax({
                url:'inputMeteranAction.php',
                type:'post',
                data:inputData,
                dataType:'json',
                beforeSend:function(){
                    $('#spinner').css('display', 'flex');
                },
                success:function(data){
                    $('.alert').remove();
                    console.log(data);
                    tampil_alert(data.pesan,data.model,'');
                },
                error:function(data,err,status){
                    console.log(err);
                    console.log(status);
                    console.log(data);
                },
                complete:function(){
                    setTimeout(function(){
                        $("#spinner").hide();
                        tabel.ajax.reload();
                    }, 1000);
                }
            });
        });
        
        var form_detail = $('#simpan_meteran');
        
        form_detail.submit(function(e){
            e.preventDefault();
            var tombol = event.submitter.value;
            var formData = form_detail.serialize()+"&tombol="+tombol;
            $.ajax({
                url:'ajax/simpanMeteranAction.php',
                type:'post',
                data:formData,
                dataType:'json',
                beforeSend:function(){
                    $('#detailMeteran').find('.modal-body div[id="spinnerModal"]').css('display','flex');
                    $('#simpan, #hapus').addClass('disabled');
                    console.log(formData);
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
                        $('#detailMeteran').find('.modal-body div[id="spinnerModal"]').hide();
                        tabel.ajax.reload();
                        if (tombol == 'Simpan') {
                            $('#simpan, #hapus').removeClass('disabled');
                        }
                    }, 1000);
                }
            });
        });
        
        $('#upload_excel').submit(function(e){
            e.preventDefault();
            if (window.FormData) {
                var formData = new FormData(this);
//                console.log(formData.get("file"));
            }
//            console.log(formData);
            var submit = $('#submit').val();
//            progressbar.progressbar({
//                        value: false,
//                        change: function() {
//                            progressLabel.text(progressbar.progressbar('value')+"%");
//                        },
//                        complete: function() {
//                            progressLabel.text('Proses Selesai');
//                        }
//                    });
//                    
//                    function progress() {
//            var val = progressbar.progressbar( "value" ) || 0;
//            progressbar.progressbar( "value", val + 2 );
//            if ( val < 99 ) {
//                setTimeout( progress, 10 );
//            }
//        }
//        setTimeout( progress, 1000 );

            $.ajax({
                url:'importMeteranAction.php',
                type:'post',
                data:formData,
                contentType:false,
                cache:false,
                processData:false,
                dataType:'json',
                beforeSend:function(){
//                    const toast = new bootstrap.Toast(progressToast);
//                    toast.show();
                    $('#spinnerModal').css('display', 'flex');
                    $('.btn').addClass('disabled');
                },
                success:function(data){
                    console.log(data);
                    $('.alert').remove();
                    tampil_alert(data.pesan,data.model,'CSV');
                },
                error:function(data,err,status){
                    console.log(err);
                    console.log(status);
                    console.log(data);
                },
                complete:function(){
                    setTimeout(function(){
                        $("#spinnerModal").hide();
//                        progressLabel.text('Proses Selesai');
                        $('.btn').removeClass('disabled');
                        tabel.ajax.reload();
                    }, 1000);
                }
            });
        });
        
        
    });
</script>
