<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'Config.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cek Tagihan Warga</title>
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/dataTables.checkboxes.css">
        <link href="asset/dashboard/navbar.css" rel="stylesheet">
        <script type="text/javascript" src="asset/jquery/jquery-3.6.3.min.js"></script>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/jquery.dataTables.js"></script>
        <style>
            .sidebar {
                min-width: 200px;
            }
            #data_tabel {
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
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="Pembayaran.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action list-active" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <div class="col mx-auto" style="margin-top: 10px">
                    <?php
                    $sql_rumah = mysqli_query($conn, "SELECT idrumah, nama FROM rumah");
                    ?>
                    <h2>Cek Tagihan Warga</h2>
                    <form id="cek_tagihan" action="" method="post">
                        <!--<div class="row">-->
                            <div class="col-sm-8 d-flex">
                                <!--<input class="col-sm-1 form-check-input" type="checkbox" id="filter_rumah" value="no_rumah">-->
                                <label class="col-sm-2 col-form-label">No Rumah</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="idrumah" id="idrumah">
                                        <!--<option value="0" hidden="">Semua</option>-->
                                        <?php
                                        while ($row = mysqli_fetch_array($sql_rumah)) {
                                            echo '<option value="' . $row['idrumah'] . '">' . $row['idrumah'] . " - " . $row['nama'] . '</option>';
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-sm-8 d-flex gap-2 mb-2">
                                <input class="col-sm-1 form-check-input" type="checkbox" id="filter_tahun" value="tahun">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="tahun" id="tahun" disabled="">
                                        <option id="default_tahun" value="2021">Semua</option>
                                        <?php
                                        $tahun = date("Y");
                                        for ($i = 2021; $i <= $tahun; $i++) {
                                            echo '<option value="' . $i . '" id="'.$i.'">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8 d-flex gap-2 mb-2">
                                <input class="col-sm-1 form-check-input" type="checkbox" id="filter_bulan" value="bulan">
                                <label class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="bulan" id="bulan" disabled="">
                                        <option id="default_bulan" value="0">Semua</option>
                                        <option value=1>Januari</option>
                                        <option value=2>Februari</option>
                                        <option value=3>Maret</option>
                                        <option value=4 selected="">April</option>
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
                            <input type="submit" value="submit" name="submit" hidden="">-->
                        <!--</div>-->
                        <hr>
                    </form>
                    <h6>Tagihan yang belum dibayar:</h6>

                    <div class="table-responsive">
                        <table id="data_tabel" class="table table-light table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th style="width: 300px">Bulan</th>
                                    <th style="width: 300px">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                    <tr>
                                    <td colspan="3" class="text-center">~ Data tidak ditemukan ~</td>
                                </tr>-->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
<!--                    <form action="" method="post">
                        <small>Pilih menggunakan bulan dan tahun:</small>
                        <div class="row">
                            <label class="col-sm-1 col-form-label">No Rumah</label>
                            <div class="col-sm-2">
                                <select class="form-select" name="id_rumah" id="selected_id">
                                    <option value="0">Pilih Nomor Rumah</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($sql_rumah)) {
                                        echo '<option value="' . $row['idrumah'] . '">' . $row['idrumah'] . " - " . $row['nama'] . '</option>';
                                    }
                                    ?>    
                                </select>
                            </div>
                            <input type="submit" value="submit" name="submit" hidden="">
                        </div>
                        <div class="table-responsive d-flex justify-content-center">
                            <table class="table table-light w-auto">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>-->
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/dataTables.fixedHeader.min.js"></script>
        <script type="text/javascript" src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<script>
$(document).ready(function(){
    
//    console.log(form_data);
    var tabel = $('#data_tabel').DataTable({
        scrolX: true,
        processing: true,
        autoWidth: false,
        fixedHeader: {
            footer: true
        },
//        aoColumns: [
//            {sWidth: '10%'},
//            {sWidth: '10%'},
//            {sWidth: '10%'}
//        ],
        ajax: {
            url:'ajax/tampilCekTagihan.php',
            data:function(d){
                var form_data = $('#cek_tagihan').serializeArray();
                $.each(form_data,function(key,val){
                    d[val.name] = val.value;
                });
            },
            type:'post'
//            dataSrc:'data'
//            success:function(data){
//                console.log(data);
//            },
//            error:function(data,err,status){
//                console.log(err);
//                console.log(status);
//                console.log(data);
//            }
        },
        columns:[
            {data:'nama'},
            {data:'bulan'},
            {data:'tahun'}
        ]
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
        
    function isiDataTabel(data) {    
        $.each(JSON.parse(data), function(index,value){
            tabel.row.add([
                value.nama,
                value.bulan,
                value.tahun
            ]).draw(false);
        });
    }
    
//    function getTagihan(form_data) {
//        
//        $.ajax({
//            url:'ajax/tampilCekTagihan.php',
//            type:'post',
//            data:form_data,
////            dataType:'dataString',
//            success:function(data){
////                alert(data);
//                console.log(data);
//                isiDataTabel(data);
//            },
//            error: function (data, status, err) {
//                console.log(data);
//                console.log(status);
//                console.log(err);
//            }
//        });
//    }
    
//    getTagihan(form_data);
    $('#cek_tagihan').change(function(){
        var idrumah = $('#idrumah').val();
        var tahun = $('#tahun').val();
        var bulan = $('#bulan').val();
        var form_data = $('#cek_tagihan').serialize();
        
        
        tabel.clear().draw();
        tabel.ajax.reload();
    });
    
    
});
</script>