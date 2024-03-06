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
        <title>Data Tagihan</title>
        
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="asset/dataTables/dataTables.checkboxes.css">
        <link href="asset/dashboard/navbar.css" rel="stylesheet">
        <script type="text/javascript" src="asset/jquery/jquery-3.6.3.min.js"></script>
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
                <div class="col-2 mx-auto sidebar" style="margin-top: 10px">
                    <div class="list-group flex-column sticky-top">
                        <!--<a class="list-group-item list-group-item-action" style="text-align: left" href="Index.php">Home</a>-->
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="Pembayaran.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action list-active" style="text-align: left" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <?php
                $sql_kuitansi = mysqli_query($conn, "SELECT * FROM kuitansi "
                        . "INNER JOIN rumah ON rumah.idrumah = kuitansi.idrumah "
                        . "INNER JOIN bulan ON bulan.idbulan = kuitansi.bulan "
                        . "ORDER BY idkuitansi");
                
                ?>
                <div class="col-10 mx-auto" style="margin-top: 10px;">
                    <!--<div class="card card-body vh-100">-->
                        <div class="table-responsive">
                        <h3>Data Tagihan Warga</h3>
                        
                        <hr>
                        <form id="frm-example" action="PrintKuitansi.php" target="_blank" method="POST">
                            
                            <div class="d-inline-flex align-items-center gap-5">
                                <h6>Cetak Kuitansi yang dipilih:</h6>
                                <input class="btn btn-sm btn-primary" type="submit" name="cetak" id="cetak_multi" value="Cetak">
                                    <!--<img src="asset/img/printer.png" width="20" height="20">-->
                            </div>
                            <table class="table table-light table-hover" id="data_tabel" >
                                <thead>
                                    <tr>
                                        <th style="width: 1%; white-space: nowrap;"></th>
                                        <th>No. Kuitansi</th>
                                        <th>Nama</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Tgl bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//                                    $i = 1;
//                                    while ($row = mysqli_fetch_array($sql_kuitansi)) {
//
//                                        $tgl_bayar = date_create($row['tgl_bayar']);
//                                        echo '<tr>';
//                                        echo '<td>' . $row['idkuitansi'] . '</td>';
//                                        echo '<td>' . $row['idkuitansi'] . '</td>';
//                                        echo '<td>' . $row['nama'] . '</td>';
//                                        echo '<td>' . $row['namabulan'] . '</td>';
//                                        echo '<td>' . $row['tahun'] . '</td>';
//                                        echo '<td>' . date_format($tgl_bayar, "d-m-Y") . '</td>';
//                                        echo '<td><button type="button" class=" me-2 btn buka-detail ps-2 pe-2 btn-sm btn-warning" '
//                                        . 'data-bs-toggle="modal" data-bs-target="#detailTagihan" '
//                                        . 'data-bs-id="' . $row['idkuitansi'] . '">'
//                                        . '<img class="p-1" src="asset/img/edit.svg" width="20" height="20"></img>'
//                                        . 'Lihat Detail</button>';
//                                        echo '</tr>';
//                                        $i = $i + 1;
//                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </form>
                        </div>
                    <!--</div>-->
                    
                </div>
            </div>
        </div>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="detailTagihan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailTagihanLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Tagihan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form_tagihan" action="" method="post">
                        <div class="modal-body">
                            <div class="placeholder bg-light justify-content-center align-items-center" id="spinnerModal">
                                <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                                    <!--<p class="">Loading...</p>-->
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label">No Kuitansi</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="idkuitansi" id="idkuitansi" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="nama" id="nama" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label">Bulan</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="val_bulan" id="val_bulan" readonly="">
                                    <input class="form-control" type="text" name="bulan" id="bulan" readonly="" hidden="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label">Tahun</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="tahun" id="tahun" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-5 col-form-label">Tgl Bayar</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="tgl" id="tgl" readonly="">
                                    <input class="form-control" type="text" name="val_tgl" id="val_tgl" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Perawatan Air</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="perawatanair" id="perawatanair" readonly="">
                                    <input type="text" id="val_pemeliharaanair" name="val_pemeliharaanair" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Tagihan Air</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="tagihanair" id="tagihanair" readonly="">
                                    <input type="text" id="val_air" name="val_air" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Sampah</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="sampah" id="sampah" readonly="">
                                    <input type="text" id="val_sampah" name="val_sampah" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Keamanan</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="keamanan" id="keamanan" readonly="">
                                    <input type="text" id="val_keamanan" name="val_keamanan" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Kebersihan</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="kebersihan" id="kebersihan" readonly="">
                                    <input type="text" id="val_kebersihan" name="val_kebersihan" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">RW</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="rw" id="rw" readonly="">
                                    <input type="text" id="val_rw" name="val_rw" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Karang Taruna</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="kt" id="kt" readonly="">
                                    <input type="text" id="val_kt" name="val_kt" hidden="" readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Mertideso</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="mertideso" id="mertideso" readonly="">
                                    <input type="text" id="val_mertideso" name="val_mertideso" hidden=""readonly="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4 col-form-label">Total</label>
                                <label class="col-sm-1 col-form-label">Rp. </label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="total" id="total" readonly="">
                                    <input type="text" id="val_total" name="val_total" hidden=""readonly="">
                                </div>
                            </div>
                            <div id="alertPlaceholderUpdate" style=""></div>
                        </div>
                        <div class="modal-footer">
                            <a type="submit" id="cetak" name="cetak_kuitansi" value="Cetak Kuitansi" class="btn btn-primary">
                                Cetak Kuitansi
                            </a>
                            <input class="btn btn-danger pe-2 ps-2" type="submit" id="hapus" name="tombol" value="Hapus">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="asset/dataTables/dataTables.checkboxes.min.js"></script>
        <script type="text/javascript" charset="utf8" src="asset/dataTables/dataTables.fixedHeader.min.js"></script>
    </body>
</html>

<script>
$(document).ready(function() {
    
    var table = $('#data_tabel').DataTable({
        scrolX: true,
        autoWidth: false,
        ajax: {
            url:'ajax/tampiltagihan.php',
            data:{view:'reload'},
            type:'post'
        },
        columns:[
            {data:'idkuitansi'},
            {data:'idkuitansi'},
            {data:'nama'},
            {data:'bulan'},
            {data:'tahun'},
            {data:'tglbayar'},
            {data:'action'}
        ],
        columnDefs: [{
                targets: 0,
                checkboxes: {
                    selectRow: true
                }
        }],
        select: {
            style: 'multi'
        },
        order: [
//            [1, 'asc']
        ]
    });
    
    //NOTIFIKASI
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
//        $('.count').html('');
          load_unseen_notif('yes');
      });
      setInterval(function(){
          load_unseen_notif();
      }, 10000);
    //NOTIFIKASI-END
    
    $('#frm-example').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();
      $('input[name="idkuitansi\[\]"]', form).remove();
      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'idkuitansi[]')
                .val(rowId)
         );
         
      });
   });
//    $.ajax({
//        url:'tampiltagihan.php',
//        type:'post',
//        data:{action:'list'},
//        dataType:'JSON',
//        success:function(data){
//            var tagihan = JSON.stringify(data);
//            $(function () {
//                
//                $.each(data, function (i, item) {
//                   $('<tr>').append(
//                   $('<td>').text(i+1),
//                   $('<td>').text(item.idrumah),
//                   $('<td>').text(item.nama),
//                   $('<td>').text(item.bulan),
//                   $('<td>').text(item.tahun),
//                   $('<td>').text(item.tglbayar),
//                   $('<td>').append('<button type="button" class="btn btn-primary buka-detail" data-bs-toggle="modal" data-bs-target="#detailTagihan" data-bs-id="'+item.idtagihan+'">Detail</button>\n\
//               <button>Hapus</button>')).appendTo('#tabel_tagihan');
//               });
//            });
//            console.log(data);
//            console.log(tagihan);
//        },
//        error: function (data, status, err) {
//            console.log('Something went wrong', data, status, err);
//        }
//    });
    
    function tampil_alert (pesan, model, id) {
            $('#alertPlaceholder'+id).append('<div class="alert alert-dismissible alert-'+model+' d-flex align-items-center gap-2 fade show" role="alert">\n\
                <img src="asset/img/warning.png" width="15" height="15">\n\
                '+pesan+'\n\
                <buttton type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
    
    $("#detailTagihan").on('show.bs.modal', function(e) {
        $('#cetak, #hapus').removeClass('disabled');
        $('.alert').remove();
        var idkuitansi = $(e.relatedTarget).data('bs-id');
        $.ajax({
            url:'ajax/tampiltagihan.php',
            type:'post',
            data:{view:'detail',idkuitansi:idkuitansi},
            dataType:'JSON',
            success:function (data){
                $(data[0]).each(function(i,item){
                    var perawatanair = item.perawatanair;
                    $('#detailTagihan').find('.modal-body input[id="idkuitansi"]').val(item.idkuitansi);
                    $('#detailTagihan').find('.modal-body input[id="nama"]').val(item.nama);
                    $('#detailTagihan').find('.modal-body input[id="bulan"]').val(item.bulan);
                    $('#detailTagihan').find('.modal-body input[id="val_bulan"]').val(item.val_bulan);
                    $('#detailTagihan').find('.modal-body input[id="tahun"]').val(item.tahun);
                    $('#detailTagihan').find('.modal-body input[id="perawatanair"]').val(parseInt(perawatanair).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="tagihanair"]').val(parseInt(item.tagihanair).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="sampah"]').val(parseInt(item.iuransampah).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="keamanan"]').val(parseInt(item.iurankeamanan).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="kebersihan"]').val(parseInt(item.iurankebersihan).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="rw"]').val(parseInt(item.iuranrw).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="kt"]').val(parseInt(item.iurankt).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="mertideso"]').val(parseInt(item.iuranmertideso).toLocaleString('id'));
                    $('#detailTagihan').find('.modal-body input[id="tgl"]').val(item.display_tglbayar);
                    $('#detailTagihan').find('.modal-body input[id="total"]').val(parseInt(item.total).toLocaleString('id'));
                    
                    $('#detailTagihan').find('.modal-body input[id="val_pemeliharaanair"]').val(parseInt(perawatanair));
                    $('#detailTagihan').find('.modal-body input[id="val_air"]').val(parseInt(item.tagihanair));
                    $('#detailTagihan').find('.modal-body input[id="val_sampah"]').val(parseInt(item.iuransampah));
                    $('#detailTagihan').find('.modal-body input[id="val_keamanan"]').val(parseInt(item.iurankeamanan));
                    $('#detailTagihan').find('.modal-body input[id="val_kebersihan"]').val(parseInt(item.iurankebersihan));
                    $('#detailTagihan').find('.modal-body input[id="val_rw"]').val(parseInt(item.iuranrw));
                    $('#detailTagihan').find('.modal-body input[id="val_kt"]').val(parseInt(item.iurankt));
                    $('#detailTagihan').find('.modal-body input[id="val_mertideso"]').val(parseInt(item.iuranmertideso));
                    $('#detailTagihan').find('.modal-body input[id="val_tgl"]').val(item.tglbayar);
                    $('#detailTagihan').find('.modal-body input[id="val_total"]').val(parseInt(item.total));
                    
                    $('#'+item.bulan).prop("selected",true);
                    var bln = $('#'+item.bulan).val();
                    $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idkuitansi="+item.idrumah+"-"+item.bulan+"."+item.tahun+"')");
//                    $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idrumah="+item.idrumah+"&bulan="+bln+"&tahun="+item.tahun+"')");
                });
            },
            error: function (data, status, err) {
                console.log(data);
                console.log(status);
                console.log(err);
            }
        });
        
    });
    
    $('#form_tagihan').submit(function(e){
        e.preventDefault();
        var tombol = event.submitter.value;
        var formData = $(this).serialize()+"&tombol="+tombol;
        console.log(formData);
        $.ajax({
            url:'ajax/simpanTagihanAction.php',
            type:'post',
            data:formData,
            dataType:'json',
            beforeSend:function(){
                $('#detailTagihan').find('.modal-body div[id="spinnerModal"]').css('display','flex');
                $('#cetak, #hapus').addClass('disabled');
            },
            success:function(data){
                $('.alert').remove();
                console.log(data);
                tampil_alert(data.pesan,data.model,'Update');
            },
            error:function(data,status,err){
                console.log(err);
                    console.log(status);
                    console.log(data);
            },
            complete:function(){
                setTimeout(function(){
                        $('#detailTagihan').find('.modal-body div[id="spinnerModal"]').hide();
//                        $('#cetak, #hapus').removeClass('disabled');
                        table.ajax.reload();
                    }, 1000);
            }
        });
    });
});
</script>