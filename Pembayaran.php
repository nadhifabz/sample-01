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
        <title>Bayar</title>
        <script src="asset/jquery/jquery-3.6.3.min.js"></script>
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="asset/dashboard/navbar.css" rel="stylesheet">
        <link href="asset/dataTables/jquery.dataTables.css" rel="stylesheet">
        <style>
            .sidebar {
                min-width: 200px;
            }
            .form-disabled {
                background-color: #cccccc !important;
                background: transparent;
            }
        </style>
    </head>
    <body>
        
        <!-- Sidebar  -->
        <nav class="navbar navbar-expand-lg bg-light border-5 border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="d-inline-flex align-items-center gap-lg-3">
                        <!--<div class="col-sm-2">-->
                        <img src="asset/img/Home.png" alt="Logo" width="60" height="60" class="">
                        <!--</div>-->
                        <!--<div class="col-sm-5">-->
                        <h1 class="text-black">PERUMAHAN ABC <?php echo $_SERVER['HTTPS'] ?></h1>
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
                        <a class="list-group-item list-group-item-action list-active" style="text-align: left;" href="Pembayaran.php">Pembayaran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left;" href="CekTagihan.php">Cek Tagihan</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataMeteran.php">Data Meteran</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTarif.php">Data Tarif</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataWarga.php">Data Warga</a>
                        <a class="list-group-item list-group-item-action" style="text-align: left" href="DataTagihan.php">Data Tagihan</a>
                    </div>
                </div>
                <div class="col-10 mx-auto" style="margin-top: 10px">
                    <div class="placeholder justify-content-center align-items-center" id="spinner">
                        <div class="spinner-border text-primary " style="width: 5rem; height: 5rem"  role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <!--<div class="col" style="margin-top: 30px">-->
                    <div class="card card-body position-relative overflow-hidden border-0" style="padding: 20px">
                        <h2 class="d-flex justify-content-center">Catat Pembayaran</h2>
                        <form id="bayar_form" action="" method="post" class="">
                            <div class="mb-1 row d-flex justify-content-center">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-4">
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
                            <div class="mb-1 row d-flex justify-content-center">
                                <label class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="bulan" id="bulan">
                                        <option id="default_bulan" value="0" selected hidden readonly>Pilih bulan</option>

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
                            <div class="mb-1 row d-flex justify-content-center">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label">No Rumah</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="id_rumah" id="selected_id">
                                        <option value="0" selected hidden>Pilih Nomor Rumah</option>
                                        <?php
                                        while ($get_id_rumah = mysqli_fetch_assoc($result)) {
                                            $i = 1;
                                            ?>
                                            <option value="<?php echo $get_id_rumah['idrumah'] ?>" id="<?php echo 'rumah' . $i; ?>">
                                                <?php echo $get_id_rumah['idrumah'] . " - " . $get_id_rumah['nama']; ?></option>
                                            <?php
                                            $i = $i + 1;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="mb-1 row d-flex justify-content-center">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-4">
                                    <input class="form-control-plaintext" type="text" name="nama" id="nama" readonly="">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="mb-1 row d-flex justify-content-center">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-4">
                                    <input class="form-control-plaintext" type="text" name="status" id="status" readonly="">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>


                            <br>
                            <div class="col  d-flex justify-content-start">
                                <div class="col-sm-3"></div>
                                <h5 class="col-form-label">Pemakaian Air</h5>
                            </div>

                            <div class="mb-1 row d-flex justify-content-start">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label" for="bulan-ini">Bulan ini

                                </label>

                                <div class="col-sm-4">
                                    <input class="form-control-plaintext" type="text" name="bulanini" id="bulanini" hidden="" readonly="">
                                    <input class="form-control" type="text" name="val_bulanini" id="val_bulanini" readonly="">
                                </div>
                                <div class="col-sm-3">
                                    <span id="bulanini_kosong" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Data meteran kosong">
                                        <img src="asset/img/exclamation-mark.png" width="15" height="15">
                                    </span>
                                </div>
                            </div>
                            <div class="mb-1 row d-flex justify-content-start">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label" for="bulan-lalu">Bulan lalu

                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control-plaintext" type="text" name="bulanlalu" id="bulanlalu" hidden="" readonly="">
                                    <input class="form-control" type="text" name="val_bulanlalu" id="val_bulanlalu" readonly="">
                                </div>
                                <div class="col-sm-3">
                                    <span id="bulanlalu_kosong" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Data meteran kosong">
                                        <img src="asset/img/exclamation-mark.png" width="15" height="15">
                                    </span>
                                </div>
                            </div>
                            <div class="mb-1 row d-flex justify-content-start">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-2 col-form-label">Total Pemakaian</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="total_pemakaian" id="total_pemakaian" readonly="">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>


                            <br>    


<!--<input type="text" id="cek_diskon"><br>-->
                            <div class="card card-body bg-light border border-3">
                                <h4 class="d-flex justify-content-center">TOTAL PEMBAYARAN</h4>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Perawatan Instalasi Air dan Fasum</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="instalasi_air" id="instalasi_air" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_pemeliharaanair" hidden="" readonly="">
                                        <input type="text" id="val_pemeliharaanair" name="val_pemeliharaanair" hidden="" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Biaya Pemakaian Air</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="tagihan_air" id="tagihan_air" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_air" hidden="" readonly="">
                                        <input type="text" id="val_air" name="val_air" hidden="" readonly="">
                                        <input type="text" name="idair" id="tmp_idair" hidden="" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Iuran Sampah</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_sampah" id="iuran_sampah" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_sampah" hidden="" readonly="">
                                        <input type="text" id="val_sampah" name="val_sampah" hidden="" readonly="">
                                        <input type="text" name="idiuran" id="tmp_idiuran" hidden="" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Iuran Kebersihan</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_kebersihan" id="iuran_kebersihan" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_kebersihan" hidden="" readonly="">
                                        <input type="text" id="val_kebersihan" name="val_kebersihan" hidden="" readonly="">
                                        <!--<input type="text" name="idkebersihan" id="tmp_idkebersihan" hidden="" readonly="">-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Iuran Keamanan</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_keamanan" id="iuran_keamanan" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_keamanan" hidden="" readonly="">
                                        <input type="text" id="val_keamanan" name="val_keamanan" hidden="" readonly="">
                                        <!--<input type="text" name="idkeamanan" id="tmp_idkeamanan" hidden="" readonly="">-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Iuran RW</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_rw" id="iuran_rw" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_rw" hidden="" readonly="">
                                        <input type="text" id="val_rw" name="val_rw" hidden="" readonly="">
                                        <!--<input type="text" name="idrw" id="tmp_idrw" hidden=""  readonly="">-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Iuran Karang Taruna</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_kt" id="iuran_kt" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_kt" hidden="" readonly="">
                                        <input type="text" id="val_kt" name="val_kt" hidden="" readonly="">
                                        <!--<input type="text" name="idkt" id="tmp_idkt" hidden=""  readonly="">-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-1">
                                    <label class="col-sm-3 col-form-label">Sedekah Bumi/Mertideso</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end" type="text" name="iuran_mertideso" id="iuran_mertideso" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="tmp_mertideso" hidden=""readonly="">
                                        <input type="text" id="val_mertideso" name="val_mertideso" hidden=""readonly="">
                                        <!--<input type="text" name="idmertideso" id="tmp_idmertideso" hidden="" readonly="">-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center fw-bolder mb-1">
                                    <label class="col-sm-3 col-form-label ">TOTAL TAGIHAN</label>
                                    <label class="col-sm-1 col-form-label text-end">Rp.</label>
                                    <div class="col-sm-2 ps-1">
                                        <input class="form-control text-end fw-bolder"  type="text" name="total_pembayaran" id="total_pembayaran" placeholder="Pilih no rumah" readonly="">
                                        <input type="text" id="val_total" name="val_total" hidden=""readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-6" id="alertPlaceholder" style=""></div>
                                </div>
                                
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-6 d-inline-flex justify-content-end gap-2">
                                        <input class="btn btn-primary" type="submit" id="bayar" name="bayar" value="Bayar!">
                                        <!--<input class="btn btn-primary" type="submit" name="cetak_kuitansi" value="Cetak Kuitansi">-->
                                        <a type="submit" name="cetak_kuitansi" id="cetak" value="Cetak Kuitansi" class="btn btn-success" >
                                            Cetak Kuitansi
                                        </a>

                                    </div>

                                </div>
                            </div>

                            <!--                            <br>
                                                        DISKON
                                                        <input type="radio" id="pemutihan" name="diskon" value=100>
                                                        <label for="html">Pemutihan</label><br>
                                                        <input type="radio" id="diskon75" name="diskon" value=75>
                                                        <label for="css">Diskon 75%</label><br>
                                                        <input type="radio" id="diskon50" name="diskon" value=50>
                                                        <label for="javascript">Diskon 50%</label><br>
                                                        <input type="radio" id="diskon25" name="diskon" value=25>
                                                        <label for="">Diskon 25%</label><br>
                                                        <input type="radio" id="normal" name="diskon" value=0 checked="checked">
                                                        <label for="">Normal</label><br>
                            
                            
                                                        <br>
                                                        <label>Tanpa Iuran Sampah</label>
                                                        <input type="checkbox" name="tanpa_iuran" id="tanpa_sampah"><br>
                                                        <label>Tanpa Iuran Kebersihan</label>
                                                        <input type="checkbox" name="tanpa_iuran" id="tanpa_kebersihan"><br>-->




                        </form>
                        <br>
                    </div>
            
            
                    </div>

                <!--</div>-->
            </div>
        </div>
        
        <div class="container-fluid bg-gradient">
            
                
            </div>
        <script type="text/javascript" src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<script>
    //$('body').on('change','#selected_id', function(){
    //   $('#nama').val($('#selected_id option:selected').val()); 
    //});-->
    $(document).ready(function(){
        $("[data-bs-toggle=popover]").popover();
        
        function tampil_bayar (idrumah,bulan,tahun) {
            console.log(bulan);
            $.ajax({
                url:'hitungmeteran.php',
                type:'post',
                data:{bulan:bulan,idrumah:idrumah,tahun:tahun},
                dataType:'json',
//                beforeSend: function () {
//                    $('#spinner').css('display', 'flex');
//                },
                success:function(data){
                    var len = data.length;
                    var angkameteranini = 0;
                    var angkameteranlalu = 0;

                    if (len > 1){
                        angkameteranini = parseInt(data[1]['angkameteran']);
                        angkameteranlalu = parseInt(data[0]['angkameteran']);
                    }
                    if (len == 1){
                         angkameteranlalu = parseInt(data[0]['angkameteran']);
                    }

                    $('#bulanini').val(angkameteranini);
                    $('#bulanlalu').val(angkameteranlalu);
                    $('#val_bulanini').val(angkameteranini.toLocaleString('id'));
                    $('#val_bulanlalu').val(angkameteranlalu.toLocaleString('id'));

                    if (angkameteranini == 0 || angkameteranlalu == 0) {
                        var totalair = 0;
//                        $('#bayar').prop('disabled','true');
//                        $('#cetak').addClass('disabled');
                    } else {
                        var totalair = angkameteranini - angkameteranlalu;
//                        $('#bayar').removeAttr('disabled');
//                        $('#cetak').removeClass('disabled');
                    }
                    meteran_nol(angkameteranini, angkameteranlalu);

                    $('#total_pemakaian').val(totalair.toLocaleString('id'));

                    $('label[for="bulan-lalu"]').html(data[0]['bulan']);
                    $('label[for="bulan-ini"]').html(data[1]['bulan']);

                    var e = JSON.stringify(data);
                    console.log(e);


                    $.ajax({
                        url:'namarumah.php',
                        type:'post',
                        data:{id_rumah:idrumah,bulan:bulan,totalair:totalair,tahun:tahun},
                        dataType:'JSON',
                        success:function(data){

                            var biaya = data.result;
                            var nama = biaya[0]['nama'];
                            var status = biaya[0]['status'];
                            var idtarif = data.idtarif;

                            //data rumah
                            $('#nama').val(nama);
                            $('#status').val(status);

                            //biaya
                            var instalasi = parseInt(biaya[0]['perawatan_air']);
                            var air = parseInt(biaya[0]['tagihan_air']);
                            var sampah = parseInt(biaya[0]['iuran_sampah']);
                            var kebersihan = parseInt(biaya[0]['iuran_kebersihan']);
                            var keamanan = parseInt(biaya[0]['iuran_keamanan']);
                            var rw = parseInt(biaya[0]['iuran_rw']);
                            var kt = parseInt(biaya[0]['iuran_kt']);
                            var mertideso = parseInt(biaya[0]['iuran_mertideso']);
                            $('#tmp_sampah').val(sampah);
                            $('#tmp_kebersihan').val(kebersihan);
                            $('#tmp_air').val(air);

                            //set id rumah
                            var idair = idtarif.idair;
                            var idiuran = idtarif.idiuran;
                            $('#tmp_idiuran').val(idiuran);
                            $('#tmp_idair').val(idair);
//                            var idkeamanan = idtarif[0]['idkeamanan'];
//                            var idkebersihan = idtarif[0]['idkebersihan'];
//                            var idrw = idtarif[0]['idrw'];
//                            var idkt = idtarif[0]['idkt'];
//                            var idmertideso = idtarif[0]['idmertideso'];
//                            set_tmp_idtarif(idair,idsampah,idkeamanan,idkebersihan,idrw,idkt,idmertideso);

                            if ($('#tanpa_kebersihan').prop("checked")){
                                kebersihan = 0;
                            }
                            if ($('#tanpa_sampah').prop("checked")){
                                sampah = 0;
                            }

                            var total = total_pembayaran(instalasi,air,sampah,keamanan,kebersihan,rw,kt,mertideso);
                            $('#total_pembayaran').val(total.toLocaleString('id'));
                            $('#val_total').val(total);
                        },
                        error:function(data,err,status){
                            var a = JSON.stringify(data);
                            console.log(a);
                            console.log(status);
                            console.log(err);
                        }
                 });

                },
                error:function(data,err,status){
                    var a = JSON.stringify(data);
                    console.log(a);
                    console.log(status);
                    console.log(err);
                },
                complete: function(){
//                    setTimeout(function(){
//                        $("#spinner").hide();
//                    }, 100);
                }
            });
        }
        
        function set_tmp_idtarif (air,sampah,keamanan,kebersihan,rw,kt,mertideso) {
            $('#tmp_idair').val(air);
            $('#tmp_idsampah').val(sampah);
            $('#tmp_idkeamanan').val(keamanan);
            $('#tmp_idkebersihan').val(kebersihan);
            $('#tmp_idrw').val(rw);
            $('#tmp_idkt').val(kt);
            $('#tmp_idmertideso').val(mertideso);
        }
        
        function total_pembayaran (instalasi,air,sampah,keamanan,kebersihan,rw,kt,mertideso) {
            $('#val_pemeliharaanair').val(instalasi);
            $('#val_air').val(air);
            $('#val_sampah').val(sampah);
            $('#val_keamanan').val(keamanan);
            $('#val_kebersihan').val(kebersihan);
            $('#val_rw').val(rw);
            $('#val_kt').val(kt);
            $('#val_mertideso').val(mertideso);
            
            
            $('#instalasi_air').val(instalasi.toLocaleString('id'));
            $('#iuran_sampah').val(sampah.toLocaleString('id'));
            $('#iuran_kebersihan').val(kebersihan.toLocaleString('id'));
            $('#iuran_keamanan').val(keamanan.toLocaleString('id'));
            $('#iuran_rw').val(rw.toLocaleString('id'));
            $('#iuran_kt').val(kt.toLocaleString('id'));
            $('#iuran_mertideso').val(mertideso.toLocaleString('id'));
            $('#tagihan_air').val(air.toLocaleString('id'));
            var total = instalasi + air + sampah + kebersihan + keamanan + rw + kt + mertideso;
            return total;            
        }
        
        function meteran_nol (angkameteranini, angkameteranlalu) {
            if (angkameteranini == 0) {
                $('#bulanini_kosong').show();
            } else {
                $('#bulanini_kosong').hide();
            }
            if (angkameteranlalu == 0) {
                $('#bulanlalu_kosong').show();
            } else {
                $('#bulanlalu_kosong').hide();
            }
        }
        
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
        
        $('#rumah1').prop("selected",true);
        var bulan = $('#bulan').val();
        var idrumah = $('#selected_id').val();
        var tahun = $('#tahun').val();
        $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idkuitansi="+idrumah+"-"+bulan+"."+tahun+"')");
        
        tampil_bayar(idrumah,bulan, tahun);
        
        $('#bayar_form').change(function(){
            var bulan = $('#bulan').val();
            var idrumah = $('#selected_id').val();
            var tahun = $('#tahun').val();
            $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idkuitansi="+idrumah+"-"+bulan+"."+tahun+"')");
            tampil_bayar(idrumah,bulan,tahun);
//            var form_data = $(this).serialize();
//            console.log(form_data);
        });
        
        function tampil_alert (pesan, model) {
            $('#alertPlaceholder').append('<div class="alert alert-dismissible alert-'+model+' d-flex align-items-center gap-2 fade show" role="alert">\n\
                <img src="asset/img/warning.png" width="15" height="15">\n\
                '+pesan+'\n\
                <buttton type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
        
        $('#bayar_form').submit(function(e){
            var form_data = $(this).serialize();
            console.log(form_data);
            e.preventDefault();
            $.ajax({
                url:'ajax/bayarAction.php',
                method:'post',
                data:form_data,
                dataType:'json',
                encode:true,
                beforeSend:function(){
                    $('#spinner').css('display', 'flex');
                    $('.btn').addClass('disabled');
                    $('.alert').remove();
                },
                success:function(data){
                    console.log(data);
                    $('.alert').remove();
                    tampil_alert(data.pesan,data.model);
                },
                error:function(data,status,err){
                    console.log(data);
                    console.log(status);
                    console.log(err);
                },
                complete:function(){
                    setTimeout(function(){
                        $("#spinner").hide();
                        $('.btn').removeClass('disabled');
                    }, 1000);
                    
                }
            });
        });
//        $.ajax({
//            url:'hitungmeteran.php',
//            type:'post',
//            data:{bulan:bulan,idrumah:idrumah,tahun:tahun},
//            dataType:'json',
//            beforeSend: function () {
//                $('#spinner').css('display', 'flex');
//            },
//            success:function(data){
//                var len = data.length;
//                var angkameteranini = 0;
//                var angkameteranlalu = 0;
//                
//                if (len > 1){
//                    angkameteranini = parseInt(data[1]['angkameteran']);
//                    angkameteranlalu = parseInt(data[0]['angkameteran']);
//                }
//                if (len == 1){
//                     angkameteranlalu = parseInt(data[0]['angkameteran']);
//                }
//                
//                $('#bulanini').val(angkameteranini);
//                $('#bulanlalu').val(angkameteranlalu);
//                $('#val_bulanini').val(angkameteranini.toLocaleString('id'));
//                $('#val_bulanlalu').val(angkameteranlalu.toLocaleString('id'));
//                
//                if (angkameteranini == 0 || angkameteranlalu == 0) {
//                    var totalair = 0;
//                    $('#bayar').prop('disabled','true');
//                    $('#cetak').addClass('disabled');
//                } else {
//                    var totalair = angkameteranini - angkameteranlalu;
//                    $('#bayar').removeAttr('disabled');
//                    $('#cetak').removeClass('disabled');
//                }
//                meteran_nol(angkameteranini, angkameteranlalu);
//                
//                $('#total_pemakaian').val(totalair.toLocaleString('id'));
//                
//                $('label[for="bulan-lalu"]').html(data[0]['bulan']);
//                $('label[for="bulan-ini"]').html(data[1]['bulan']);
//                
//                var e = JSON.stringify(data);
//                console.log(e);
//                
//                
//                $.ajax({
//                    url:'namarumah.php',
//                    type:'post',
//                    data:{id_rumah:idrumah,bulan:bulan,totalair:totalair,tahun:tahun},
//                    dataType:'JSON',
//                    success:function(data){
//                        
//                        var biaya = data.result;
//                        var nama = biaya[0]['nama'];
//                        var status = biaya[0]['status'];
//                        var idtarif = data.idtarif;
//
//                        //data rumah
//                        $('#nama').val(nama);
//                        $('#status').val(status);
//
//                        //biaya
//                        var instalasi = parseInt(biaya[0]['perawatan_air']);
//                        var air = parseInt(biaya[0]['tagihan_air']);
//                        var sampah = parseInt(biaya[0]['iuran_sampah']);
//                        var kebersihan = parseInt(biaya[0]['iuran_kebersihan']);
//                        var keamanan = parseInt(biaya[0]['iuran_keamanan']);
//                        var rw = parseInt(biaya[0]['iuran_rw']);
//                        var kt = parseInt(biaya[0]['iuran_kt']);
//                        var mertideso = parseInt(biaya[0]['iuran_mertideso']);
//                        $('#tmp_sampah').val(sampah);
//                        $('#tmp_kebersihan').val(kebersihan);
//                        $('#tmp_air').val(air);
//                        
//                        //set id rumah
//                        var idair = idtarif[0]['idair'];
//                        var idsampah = idtarif[0]['idsampah'];
//                        var idkeamanan = idtarif[0]['idkeamanan'];
//                        var idkebersihan = idtarif[0]['idkebersihan'];
//                        var idrw = idtarif[0]['idrw'];
//                        var idkt = idtarif[0]['idkt'];
//                        var idmertideso = idtarif[0]['idmertideso'];
//                        set_tmp_idtarif(idair,idsampah,idkeamanan,idkebersihan,idrw,idkt,idmertideso);
//                        
//                        if ($('#tanpa_kebersihan').prop("checked")){
//                            kebersihan = 0;
//                        }
//                        if ($('#tanpa_sampah').prop("checked")){
//                            sampah = 0;
//                        }
//
//                        var total = total_pembayaran(instalasi,air,sampah,keamanan,kebersihan,rw,kt,mertideso);
//                        $('#total_pembayaran').val(total.toLocaleString('id'));
//                        $('#val_total').val(total);
//                    },
//                    error:function(data,err,status){
//                        var a = JSON.stringify(data);
//                        console.log(a);
//                        console.log(status);
//                        console.log(err);
//                    }
//             });
//                
//            },
//            error:function(data,err,status){
//                var a = JSON.stringify(data);
//                console.log(a);
//                console.log(status);
//                console.log(err);
//            },
//            complete: function(){
//                setTimeout(function(){
//                    $("#spinner").hide();
//                }, 100);
//            }
//        });
        
        
//        $('#bulan, #tahun').change(function(){
//            
//            $('#normal').prop("checked",true);
//            
//            var bulan = $('#bulan').val();
//            var idrumah = $('#selected_id').val();
//            var tahun = $('#tahun').val();
//            $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idrumah="+idrumah+"&bulan="+bulan+"&tahun="+tahun+"')");
//            if (idrumah == "0") {
//                alert('Pilih Nomor Rumah!');
//                $('#default_bulan').prop("selected",true);
//            } else {
//                $.ajax({
//                    url:'hitungmeteran.php',
//                    type:'post',
//                    data:{bulan:bulan,idrumah:idrumah,tahun:tahun},
//                    dataType:'json',
//                    success:function(data){
//                        //var blnini = data[1]['bulan'];
//                        //var blnlalu = data[0]['bulan'];
//                        var len = data.length;
//
//                        var angkameteranini = 0;
//                        var angkameteranlalu = 0;
////                        console.log(bulan+' = '+data[0]['bulan']+' atau '+data[0]['bln']);
//                        
//                        if (len > 1){
//                            angkameteranini = parseInt(data[1]['angkameteran']);
//                            angkameteranlalu = parseInt(data[0]['angkameteran']);
//                        }
//                        if (len == 1){
//                             angkameteranlalu = parseInt(data[0]['angkameteran']);
//                        }
//                        console.log(data);
//                        
//                        $('#bulanini').val(angkameteranini);
//                        $('#bulanlalu').val(angkameteranlalu);
//                        $('#val_bulanini').val(angkameteranini.toLocaleString('id'));
//                        $('#val_bulanlalu').val(angkameteranlalu.toLocaleString('id'));
//                        if (angkameteranini == 0 || angkameteranlalu == 0) {
//                            var totalair = 0;
//                            $('#bayar').prop('disabled','true');
//                            $('#cetak').addClass('disabled');
//                        } else {
//                            var totalair = angkameteranini - angkameteranlalu;
//                            $('#bayar').removeAttr('disabled');
//                            $('#cetak').removeClass('disabled');
//                        }
//                        
//                        meteran_nol(angkameteranini, angkameteranlalu);
//                        $('#total_pemakaian').val(totalair.toLocaleString('id'));
//                        
//                        $('label[for="bulan-lalu"]').html(data[0]['bulan']);
//                        $('label[for="bulan-ini"]').html(data[1]['bulan']);
//
//                        $.ajax({
//                            url:'namarumah.php',
//                            type:'post',
//                            data:{id_rumah:idrumah,bulan:bulan,totalair:totalair,tahun:tahun},
//                            dataType:'JSON',
//                            success:function(data){
//                                var biaya = data.result;
//                                var nama = biaya[0]['nama'];
//                                var status = biaya[0]['status'];
//                                var idtarif = data.idtarif;
//
//                                //data rumah
//                                $('#nama').val(nama);
//                                $('#status').val(status);
//
//                                //biaya
//                                var instalasi = parseInt(biaya[0]['perawatan_air']);
//                                var air = parseInt(biaya[0]['tagihan_air']);
//                                var sampah = parseInt(biaya[0]['iuran_sampah']);
//                                var kebersihan = parseInt(biaya[0]['iuran_kebersihan']);
//                                var keamanan = parseInt(biaya[0]['iuran_keamanan']);
//                                var rw = parseInt(biaya[0]['iuran_rw']);
//                                var kt = parseInt(biaya[0]['iuran_kt']);
//                                var mertideso = parseInt(biaya[0]['iuran_mertideso']);
//                                $('#tmp_sampah').val(sampah);
//                                $('#tmp_kebersihan').val(kebersihan);
//                                $('#tmp_air').val(air);
//
//                                //set id rumah
//                                var idair = idtarif[0]['idair'];
//                                var idsampah = idtarif[0]['idsampah'];
//                                var idkeamanan = idtarif[0]['idkeamanan'];
//                                var idkebersihan = idtarif[0]['idkebersihan'];
//                                var idrw = idtarif[0]['idrw'];
//                                var idkt = idtarif[0]['idkt'];
//                                var idmertideso = idtarif[0]['idmertideso'];
//                                set_tmp_idtarif(idair,idsampah,idkeamanan,idkebersihan,idrw,idkt,idmertideso);
//
//                                if ($('#tanpa_kebersihan').prop("checked")){
//                                    kebersihan = 0;
//                                }
//                                if ($('#tanpa_sampah').prop("checked")){
//                                    sampah = 0;
//                                }
//
//                                var total = total_pembayaran(instalasi,air,sampah,keamanan,kebersihan,rw,kt,mertideso);
//                                $('#total_pembayaran').val(total.toLocaleString('id'));
//                                $('#val_total').val(total);
//                            }
//                     });
//                    }
//                    
//                });
//            }
//            
//            
//            
//        });     
        
//        $('#selected_id').change(function(){
//            //default value
//            $('#normal').prop("checked",true);
//            //$('#bulan').val(2);
//            
//            
//            var idrumah = $(this).val();
//            var bulan = $('#bulan').val();
//            var tahun = $('#tahun').val();
//            //var totalair = $('#total_pemakaian').val();
//            $('#cetak').attr("onclick","window.open('PrintKuitansi.php?idrumah="+idrumah+"&bulan="+bulan+"&tahun="+tahun+"')");
//            //$('#tanpa_kebersihan').prop("checked",false);
//            //$('#tanpa_sampah').prop("checked",false);
//            
//            $.ajax({
//            url:'hitungmeteran.php',
//            type:'post',
//            data:{bulan:bulan,idrumah:idrumah,tahun:tahun},
//            dataType:'json',
//            success:function(data){
//                var len = data.length;
//                var angkameteranini = 0;
//                var angkameteranlalu = 0;
//                
//                if (len > 1){
//                    angkameteranini = parseInt(data[1]['angkameteran']);
//                    angkameteranlalu = parseInt(data[0]['angkameteran']);
//                }
//                if (len == 1){
//                     angkameteranlalu = parseInt(data[0]['angkameteran']);
//                }
//                
//                $('#bulanini').val(angkameteranini);
//                $('#bulanlalu').val(angkameteranlalu);
//                $('#val_bulanini').val(angkameteranini.toLocaleString('id'));
//                $('#val_bulanlalu').val(angkameteranlalu.toLocaleString('id'));
//                
//                if (angkameteranini == 0 || angkameteranlalu == 0) {
//                    $('#bayar').prop('disabled','true');
//                    $('#cetak').addClass('disabled');
//                    var totalair = 0;
//                } else {
//                    var totalair = angkameteranini - angkameteranlalu;
//                    $('#bayar').removeAttr('disabled');
//                    $('#cetak').removeClass('disabled');
//                }
//                
//                meteran_nol(angkameteranini, angkameteranlalu);
//                $('#total_pemakaian').val(totalair.toLocaleString('id'));
//                $('label[for="bulan-lalu"]').html(data[0]['bulan']);
//                $('label[for="bulan-ini"]').html(data[1]['bulan']);
//                
//                $.ajax({
//                    url:'namarumah.php',
//                    type:'post',
//                    data:{id_rumah:idrumah,bulan:bulan,totalair:totalair,tahun:tahun},
//                    dataType:'JSON',
//                    success:function(data){
//                        var biaya = data.result;
//                        var nama = biaya[0]['nama'];
//                        var status = biaya[0]['status'];
//                        var idtarif = data.idtarif;
//
//                        //data rumah
//                        $('#nama').val(nama);
//                        $('#status').val(status);
//
//                        //biaya
//                        var instalasi = parseInt(biaya[0]['perawatan_air']);
//                        var air = parseInt(biaya[0]['tagihan_air']);
//                        var sampah = parseInt(biaya[0]['iuran_sampah']);
//                        var kebersihan = parseInt(biaya[0]['iuran_kebersihan']);
//                        var keamanan = parseInt(biaya[0]['iuran_keamanan']);
//                        var rw = parseInt(biaya[0]['iuran_rw']);
//                        var kt = parseInt(biaya[0]['iuran_kt']);
//                        var mertideso = parseInt(biaya[0]['iuran_mertideso']);
//                        $('#tmp_sampah').val(sampah);
//                        $('#tmp_kebersihan').val(kebersihan);
//                        $('#tmp_air').val(air);
//                        
//                        //set id rumah
//                        var idair = idtarif[0]['idair'];
//                        var idsampah = idtarif[0]['idsampah'];
//                        var idkeamanan = idtarif[0]['idkeamanan'];
//                        var idkebersihan = idtarif[0]['idkebersihan'];
//                        var idrw = idtarif[0]['idrw'];
//                        var idkt = idtarif[0]['idkt'];
//                        var idmertideso = idtarif[0]['idmertideso'];
//                        set_tmp_idtarif(idair,idsampah,idkeamanan,idkebersihan,idrw,idkt,idmertideso);
//                        
//                        if ($('#tanpa_kebersihan').prop("checked")){
//                            kebersihan = 0;
//                        }
//                        if ($('#tanpa_sampah').prop("checked")){
//                            sampah = 0;
//                        }
//
//                        var total = total_pembayaran(instalasi,air,sampah,keamanan,kebersihan,rw,kt,mertideso);
//                        $('#total_pembayaran').val(total.toLocaleString('id'));
//                        $('#val_total').val(total);
//                    }
//             });
//                
//            }
//        });
//            
//            
//        }); 
        
//        $('[name="diskon"]').change(function(){
//                var diskon = $(this).val();
//                var status = $('#status').val();
//                var biayaair = $('#tmp_air').val();
//            
//                $.ajax({
//                    url:'hitungdiskon.php',
//                    type:'post',
//                    data:{diskon:diskon,status:status,biayaair:biayaair},
//                    dataType:'json',
//                    success:function(data){
//                        var instalasi_air = parseFloat(data[0]['perawatan_air']);
//                        var tagihan_air = data[0]['tagihan_air'];
//                        var iuran_sampah = data[0]['iuran_sampah'];
//                        var iuran_kebersihan = data[0]['iuran_kebersihan'];
//                        var iuran_keamanan = data[0]['iuran_keamanan'];
//                        var iuran_rw = data[0]['iuran_rw'];
//                        var iuran_kt = data[0]['iuran_kt'];
//                        var iuran_mertideso = data[0]['iuran_mertideso'];
//                        
//                        $('#tmp_sampah').val(iuran_sampah);
//                        $('#tmp_kebersihan').val(iuran_kebersihan);
//                        
//                        if ($('#tanpa_kebersihan').prop("checked")){
//                            iuran_kebersihan = 0;
//                        }
//                        if ($('#tanpa_sampah').prop("checked")){
//                            iuran_sampah = 0;
//                        }
//                        $('#instalasi_air').val(instalasi_air);
//                        $('#iuran_sampah').val(iuran_sampah);
//                        $('#iuran_kebersihan').val(iuran_kebersihan);
//                        $('#iuran_keamanan').val(iuran_keamanan);
//                        $('#iuran_rw').val(iuran_rw);
//                        $('#iuran_kt').val(iuran_kt);
//                        $('#iuran_mertideso').val(iuran_mertideso);
//                        $('#tagihan_air').val(tagihan_air);
//                        
//                        var instalasi = parseFloat($('#instalasi_air').val());
//                        var air = parseFloat($('#tagihan_air').val());
//                        var sampah = parseFloat($('#iuran_sampah').val());
//                        var kebersihan = parseFloat($('#iuran_kebersihan').val());
//                        var keamanan = parseFloat($('#iuran_keamanan').val());
//                        var rw = parseFloat($('#iuran_rw').val());
//                        var kt = parseFloat($('#iuran_kt').val());
//                        var mertideso = parseFloat($('#iuran_mertideso').val());
//
//                        var total = instalasi + air + sampah + kebersihan + keamanan + rw + kt + mertideso;
//                        $('#total_pembayaran').val(total);
//                    }
//                });
//            });
//        
//        $('#tanpa_sampah').change(function(){
//            var tmpsampah = $('#tmp_sampah').val();
//            if ($(this).prop("checked")) {
//                $('#iuran_sampah').val(0);
//            } else {
//                $('#iuran_sampah').val(tmpsampah);
//            }
//            var instalasi = parseFloat($('#instalasi_air').val());
//            var air = parseFloat($('#tagihan_air').val());
//            var sampah = parseFloat($('#iuran_sampah').val());
//            var kebersihan = parseFloat($('#iuran_kebersihan').val());
//            var keamanan = parseFloat($('#iuran_keamanan').val());
//            var rw = parseFloat($('#iuran_rw').val());
//            var kt = parseFloat($('#iuran_kt').val());
//            var mertideso = parseFloat($('#iuran_mertideso').val());
//            var total = instalasi + air + sampah + kebersihan + keamanan + rw + kt + mertideso;
//            $('#total_pembayaran').val(total);
//        });
//        
//        $('#tanpa_kebersihan').change(function(){
//            var tmpkebersihan = $('#tmp_kebersihan').val();
//            if ($(this).prop("checked")) {
//                $('#iuran_kebersihan').val(0);
//                
//                
//            } else {
//                $('#iuran_kebersihan').val(tmpkebersihan);
//            }
//            var instalasi = parseFloat($('#instalasi_air').val());
//            var air = parseFloat($('#tagihan_air').val());
//            var sampah = parseFloat($('#iuran_sampah').val());
//            var kebersihan = parseFloat($('#iuran_kebersihan').val());
//            var keamanan = parseFloat($('#iuran_keamanan').val());
//            var rw = parseFloat($('#iuran_rw').val());
//            var kt = parseFloat($('#iuran_kt').val());
//            var mertideso = parseFloat($('#iuran_mertideso').val());
//            var total = instalasi + air + sampah + kebersihan + keamanan + rw + kt + mertideso;
//            $('#total_pembayaran').val(total);
//        });
        
    });
</script>
