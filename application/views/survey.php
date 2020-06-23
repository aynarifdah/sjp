<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Halaman utama</title>
</head>

<style type="text/css">
.table th{
  width: 10%;
  }
.table th, .table td {
  padding-top: 0.75rem;
  padding-right: 2rem;
  padding-bottom: 0.75rem;
  padding-left: 20px;
}
th {
  white-space: pre-wrap;
}
</style>


 
  <div class="card">
  <div class="card-head">
    <div class="card-header">
      <div class="row">
        <div class="col-lg-12">
          <h4 class="card-title">Data Pengajuan SJP</h4>
        </div>
      </div>
      <!--  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a> -->
    </div>
  </div>
  <div class="card-content">
    <div class="card-body">
      <div class="table-responsive">
        <div class="row">
          <div class="col-lg-12">
            <div class="element mb-1 p-r-15">
              <!-- <button type="button" class="btn btn-info btn-sm" id="advancedfilterbtn"><i class="ft-filter"></i>&nbsp; Filter</button> -->
              <button type="button" class="btn bg-success bg-darken-4 btn-sm text-white" id="export"><i class="icon-cloud-download"></i>&nbsp; Excel</button>
            <!--   <span class="dropdown">
                <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right btn-sm"><i class="ft-plus"></i> Tambah</button>
                <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                  <a class="dropdown-item tambahkontrak" id="Baru" value="Tambah Kontrak"><i class="ft-file-plus"></i> Kontrak Baru</a>
                  <a class="dropdown-item tambahkontrak" id="Perpanjangan" value="Perpanjangan Kontrak"><i class="ft-file-text"></i> Perpanjangan</a>
                </span>
              </span> -->
              <span class="dropdown"><button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary btn-sm dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i> Aksi</button>
                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right action-menu">
                  <a href="#" class="dropdown-item tambahkontrak" id="Baru" value="Tambah Kontrak"><i class="ft-file-plus"></i> Approve</a>
                  <a href="#" class="dropdown-item tambahkontrak" id="Baru" value="Tambah Kontrak"><i class="ft-x"></i> Reject</a>
                   <a href="<?php echo base_url('Home/persetujuan_sjp');?>" class="dropdown-item tambahkontrak" id="Perpanjangan" value="Perpanjangan Kontrak"><i class="ft-file-text"></i> Daftar SJP</a>
                  <!--<a href="#" class="dropdown-item" id="bayar"><i class="icon-credit-card"></i> Bayar</a>
                  <a href="#" class="dropdown-item" id="btlkontrak"><i class="icon-close"></i> Pembatalan Kontrak</a>
                  <a href="#" class="dropdown-item tambahkontrak" value="Perubahan Data" id="ubahdata"><i class="ft-edit-2"></i> Perubahan Data</a>
                  <a href="#" class="dropdown-item cetakpedagang"><i class="ft-printer"></i> Kartu Pedagang</a>
                  <a href="#" class="dropdown-item cetakkontrak"><i class="ft-printer"></i> Daftar Kontrak</a> -->
                </span>
              </span>
            </div>
          </div>
        </div>
        <div class="row mb-1" style="padding-left: 15px; padding-right: 15px;" id="advancedfilterform">
 
        </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
          <div class="col-lg-3 filter">
            <select name="" id="" class="form-control" style="width: 100%">
              <option value="">Semua Puskesmas</option>
              <option value="">Puskesmas Sawangan</option>
              <option value="">Puskesmas Pasir Putih</option>
              <option value="">Puskesmas Kedaung</option>
              <option value="">Puskesmas Pengasinan</option>
              <option value="">Puskesmas Bojong Sari</option>
              <option value="">Puskesmas Duren Seribu</option>
              <option value="">Puskesmas Pancoran Mas</option>
              <option value="">Puskesmas Depok Jaya</option>
              <option value="">Puskesmas Rangkapan Jaya Baru</option>
              <option value="">Puskesmas Cipayung</option>
              <option value="">Puskesmas Raju Jaya</option>
              <option value="">Puskesmas Sukmajaya</option>
              <option value="">Puskesmas Abadi Jaya</option>
              <option value="">Puskesmas Bakti Jaya</option>
              <option value="">Puskesmas Pondok Sukmajaya</option>
              <option value="">Puskesmas Cilodong</option>
              <option value="">Puskesmas Villa Pertiwi</option>
              <option value="">Puskesmas Kalimulya</option>
              <option value="">Puskesmas Cimanggis</option>
              <option value="">Puskesmas Tugu</option>
              <option value="">Puskesmas Harjamukti</option>
              <option value="">Puskesmas Pasir Gunung Selatan</option>
              <option value="">Puskesmas Mekarsari</option>
              <option value="">Puskesmas Cisalak Pasar</option>
              <option value="">Puskesmas Tapos</option>
              <option value="">Puskesmas Sukatani</option>
              <option value="">Puskesmas Jatijajar</option>
              <option value="">Puskesmas Cilangkap</option>
              <option value="">Puskesmas Cimpaeun</option>
              <option value="">Puskesmas Sukamaju Baru</option>
              <option value="">Puskesmas Beji</option>
              <option value="">Puskesmas Tanah Baru</option>
              <option value="">Puskesmas Kemiri Muka</option>
              <option value="">Puskesmas Limo</option>
              <option value="">Puskesmas Cinere</option>
            </select>
          </div>
          <div class="col-lg-3 filter">
            <select name="" id="" class="form-control">
              <option value="">Semua Rumah Sakit</option>
              <option value="">RSUD Kota Depok</option>
              <option value="">RS Bhayangkara Brimob</option>
              <option value="">RSU Hermina Depok</option>
              <option value="">RSU Puri Cinere</option>
              <option value="">RSU Sentra Medika</option>
              <option value="">RSU Meilia</option>
              <option value="">RSU Bunda Margonda</option>
              <option value="">RSU Grha Permata Ibu</option>
              <option value="">RSU Permata Depok</option>
              <option value="">RSU Tugu Ibu</option>
              <option value="">RSIA Tumbuh Kembang</option>
              <option value="">RSU Citra Medika Depok</option>
              <option value="">RSU Bhakti Yudha</option>
              <option value="">RSU Mitra Keluarga Depok</option>
              <option value="">RSIA Asyifa Depok</option>
              <option value="">RSU Hasanah Graha Afiah</option>
              <option value="">RSIA Setya Bhakti</option>
              <option value="">RSU Simpangan Depok</option>
              <option value="">RSU Harapan Depok</option>
              <option value="">RS Khusus Jantung Diagram</option>
              <option value="">RSIA Citra Arafiq</option>
              <option value="">RSIA Bunda Aliyah</option>
              <option value="">RSIA Brawijaya</option>
            </select>
          </div>
          
          <div class="col-lg-3">
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" placeholder="Cari NIK, Nama Pasien">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
        </div>
        <table id="datatable" class="table table-bordered" style="cursor:pointer">
          <thead>
            <tr>
              <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th>
              <th>Pemohon</th>
              <th>Pasien</th>
              <th>Tanggal Pengajuan</th>
              <!-- <th>Lama Pengajuan</th> -->
              <!-- <th>Puskesmas</th> -->
              <th>Rumah Sakit</th>
              <!-- <th>Diagnosa</th> -->
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($datapermohonan)) {
              foreach ($datapermohonan as $key) {?> 
                  <tr>
              <td><div class="skin skin-polaris"><input type="checkbox" id="input-21" class="check"></div></td>
              <td><a href="<?php echo base_url('Home/detail_pengajuan/'.$key['id_sjp']);?>">
              <?php echo $key['nama_pemohon']; ?></a></td>
              <td><a href="<?php echo base_url('Home/detail_pengajuan/'.$key['id_sjp']);?>">
              <?php echo $key['nama_pasien']; ?></a></td>
              <td><?php echo date_format(date_create($key['tanggal_pengajuan']),"d-m-Y") ?></td>
              <!-- <td>1 Hari</td> -->
              <td><?php echo $key['nama_rumah_sakit']; ?></td>
             <!--  <td>Asam Lambung</td> -->
             <td><?php if ($key['id_status_pengajuan'] == '3') {
               echo '<div class="badge bg-warning round" style="font-size: 14px;">'.$key['status_pengajuan'].' <i class="ft-check-circle"></i></div>';
              }elseif($key['id_status_pengajuan'] == '1'){
                echo '<div class="badge bg-success bg-darken-1 round" style="font-size: 14px;">'.$key['status_pengajuan'].' <i class="ft-cast"></i></div>';
              } ?></td>
            </tr>
              <?php }
            } ?> 
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<style>
.action-menu {
  width: 200px !important;
  height: auto;
}
#datatable_length{
  display: none;
}
.p-l-15{
  padding-left: 15px;
}
.p-r-15{
  padding-right: 15px;
}
.filter{
  padding-right: 0px;
}
.table-responsive{
  overflow-x: hidden;
}
.card-body{
  padding-top: 0px;
}
.picker__nav--prev:before {
  content: '<' !important;
}
.picker__nav--next:before {
  content: '>' !important;
}
@media (min-width: 992px) {
  .element{
    float: right !important;
  }
}
@media (max-width: 575.98px) {
  .element{
    text-align: center !important;
    padding-right: 0px;
  }
  .filter{
    padding-right: 15px;
    padding-bottom: 5px;
  }
}
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">

<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script>
  // Polaris Checkbox & Radio
  $('.skin-polaris input').iCheck({
    checkboxClass: 'icheckbox_polaris',
    increaseArea: '-10%'
  });
  $(".select2").select2();
  var dtable = $("#datatable").DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "search" : true,
    "bFilter": false
  });
  $(document).ready(function() {
    $('#advancedfilterform').hide();
  });
  $('#advancedfilterbtn').on("click",function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#advancedfilterform').hide();
    }else{
      $(this).addClass('active');
      $('#advancedfilterform').show();
    }
  });
  $(".tambahkontrak").on("click", function(){
    var tipe = $(this).attr("id");
    var title = $(this).attr("value");
    var data = {tipe: tipe, title: title};
    // alert(tipe);
    $("#content").load("<?=base_url();?>Home/KontrakAdd", data);
  });
  $('.detail').on("click", function() {
    $("#content").load("<?=base_url();?>Home/Halaman_detail_pengajuan");
  });
  $('#putuskontrak').on("click", function() {
    $("#content").load("<?=base_url();?>Home/putuskontrak");
  });
    // // Date Range from & to
    // var from_$input = $('#picker_from').pickadate(),
    // from_picker = from_$input.pickadate('picker');

    // var to_$input = $('#picker_to').pickadate(),
    // to_picker = to_$input.pickadate('picker');


  // // Check if there’s a “from” or “to” date to start with.
  // if ( from_picker.get('value') ) {
  //   to_picker.set('min', from_picker.get('select'));
  // }
  // if ( to_picker.get('value') ) {
  //   from_picker.set('max', to_picker.get('select'));
  // }

  // // When something is selected, update the “from” and “to” limits.
  // from_picker.on('set', function(event) {
  //   if ( event.select ) {
  //     to_picker.set('min', from_picker.get('select'));
  //   }
  //   else if ( 'clear' in event ) {
  //     to_picker.set('min', false);
  //   }
  // });
  // to_picker.on('set', function(event) {
  //   if ( event.select ) {
  //     from_picker.set('max', to_picker.get('select'));
  //   }
  //   else if ( 'clear' in event ) {
  //     from_picker.set('max', false);
  //   }
  // });
  $("#bayar").on("click", function(){
    $("#content").load("<?=base_url();?>Home/bayarkontrak");
  });
  $("#btlkontrak").on("click", function(){
    $("#content").load("<?=base_url();?>Home/putuskontrak");
  });

//   $('.check').on('ifUnchecked', function (event) {
//     $('#check-all').iCheck('uncheck');
//   });

// // Make "All" checked if all checkboxes are checked
// $('.check').on('ifChecked', function (event) {
//   if ($('.check').filter(':checked').length == $('.check').length) {
//     $('#check-all').iCheck('checked');
//   }
// });
var triggeredByChild = false;
$('#check-all').on('ifChecked', function (event) {
  $('.check').iCheck('check');
  triggeredByChild = false;
});

$('#check-all').on('ifUnchecked', function (event) {
  if (!triggeredByChild) {
    $('.check').iCheck('uncheck');
  }
  triggeredByChild = false;
});
// Removed the checked state from "All" if any checkbox is unchecked
$('.check').on('ifUnchecked', function (event) {
  triggeredByChild = true;
  $('#check-all').iCheck('uncheck');
});

$('.check').on('ifChecked', function (event) {
  if ($('.check').filter(':checked').length == $('.check').length) {
    $('#check-all').iCheck('check');
  }
});
</script>

  
 
</body>
</html>