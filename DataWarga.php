<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'Config.php';

$query = "SELECT * FROM rumah "
        . "INNER JOIN status ON rumah.status = status.idstatus";
$result = mysqli_query($conn, $query);
if(!$result){
    die("Gagal terhubung ke database : ".mysqli_error($conn));
}
$data = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Data Warga</title>
        
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/jquery.dataTables.css">
        <link href="asset/dashboard/navbar.css" rel="stylesheet">
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
                        <a class="list-group-item list-group-item-action" href="Index.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action list-active" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <div class="col-10 mx-auto" style="margin-top: 10px">
                    <!--<div class="card card-body vh-100">-->
                        <div class="table-responsive">
                            <h3>DATA WARGA</h3>
                            
                            <table class="table table-light table-hover" id="data_tabel">
                                <thead>
                                    <tr>
                                        <th>No. Rumah</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>No. Telp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
//                                    foreach ($data as $row) {
//                                        echo '<tr>';
//                                        echo '<td>' . $row['idrumah'];
//                                        '</td>';
//                                        echo '<td>' . $row['nama'];
//                                        '</td>';
//                                        echo '<td>' . $row['namastatus'];
//                                        '</td>';
//                                        echo '<td>' . $row['no_telp'] . '</td>';
//                                        echo '<td class="gap-2"><button class="me-1 ps-2 pe-2  btn btn-sm buka-detail btn-warning" '
//                                        . 'data-bs-toggle="modal" data-bs-target="#detailWarga" '
//                                        . 'data-bs-id="' . $row['idrumah'] . '"><img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>Lihat Detail</button>'
//                                        . '</td>';
//                                        echo '</tr>';
//                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No. Rumah</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>No. Telp</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="detailWarga" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailMeteranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Warga</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="simpan_warga" action="ajax/simpanRumahAction.php" method="post">
                        <div class="modal-body">
                            <div class="placeholder bg-light justify-content-center align-items-center" id="spinnerModal">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                                    <!--<p class="">Loading...</p>-->
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">No. Rumah</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="idrumah" id="idrumah" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="nama" id="nama">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm">
                                    <select class="form-select" name="status" id="status">
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM status");
                                        $data = $query->fetch_all(MYSQLI_ASSOC);
                                        foreach ($data as $datas) {
                                            echo '<option value=' . $datas["idstatus"] . ' id='.$datas["idstatus"].'>' . $datas["namastatus"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">No Telp</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="notelp" id="notelp">
                                </div>
                            </div>
                            <div id="alertPlaceholderUpdate" style=""></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary pe-2 ps-2" id="simpan" name="tombol" value="Simpan">
                            <!--<input type="submit" class="btn btn-danger pe-2 ps-2" id="hapus" name="hapus" value="Hapus">-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="asset/jquery/jquery-3.6.3.min.js"></script>
    <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="asset/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="asset/dataTables/dataTables.fixedHeader.min.js"></script>
</html>
<script>
    $(document).ready(function(){
        
        var tabel = $('#data_tabel').DataTable({
            scrolX: true,
            processing: true,
            autoWidth: false,
            ajax: {
                url:'ajax/tampilwarga.php',
                data:{view:'reload'},
                type:'post'
            },
            columns:[
                {data:'idrumah'},
                {data:'nama'},
                {data:'status'},
                {data:'notelp'},
                {data:'action'}
            ],
            fixedHeader: {
                footer: true
            }
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
        }, 5000);
        
        function tampil_alert (pesan, model, id) {
            $('#alertPlaceholder'+id).append('<div class="alert alert-dismissible alert-'+model+' d-flex align-items-center gap-2 fade show" role="alert">\n\
                <img src="asset/img/warning.png" width="15" height="15">\n\
                '+pesan+'\n\
                <buttton type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
        
        $('#detailWarga').on('show.bs.modal',function(e){
            $('.alert').remove();
            var idrumah = $(e.relatedTarget).data('bs-id');
            $.ajax({
                url:'ajax/tampilwarga.php',
                type:'post',
                data:{idrumah:idrumah,view:'detail'},
                dataType:'json',
                success:function(data){
                    var idstatus = data[0]['idstatus'];
                    $('#detailWarga').find('.modal-body input[id="idrumah"]').val(data[0]['id']);
                    $('#detailWarga').find('#'+idstatus+'').prop('selected',true);
//                    $('#detailWarga').find('.modal-body input[id="status"]').val(data[0]['status']);
                    $('#detailWarga').find('.modal-body input[id="nama"]').val(data[0]['nama']);
                    $('#detailWarga').find('.modal-body input[id="notelp"]').val(data[0]['notelp']);
                },
                error:function(data,status,err){
                    console.log(data);
                    console.log(status);
                    console.log(err);
                }
            });
        });
        
        $('#simpan_warga').submit(function(e){
            e.preventDefault();
            var tombol = event.submitter.value;
            var formData = $(this).serialize()+"&tombol="+tombol;
            console.log(formData);
            $.ajax({
                url:'ajax/simpanRumahAction.php',
                type:'post',
                data:formData,
                dataType:'json',
                beforeSend:function(){
                    $('#detailWarga').find('.modal-body div[id="spinnerModal"]').css('display','flex');
                    $('#simpan').addClass('disabled');
                },
                success:function(data){
                    $('.alert').remove();
                    tampil_alert(data.pesan,data.model,'Update');
                },
                error:function(data,err,status){
                    console.log(err);
                    console.log(status);
                    console.log(data);
                },
                complete:function(){
                    setTimeout(function(){
                        $('#detailWarga').find('.modal-body div[id="spinnerModal"]').hide();
                        $('#simpan').removeClass('disabled');
                        tabel.ajax.reload();
                    }, 1000);
                }
            });
        });
    });
</script>
