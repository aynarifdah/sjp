<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Halaman pengajuan SJP</title>
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">


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
          <h4 class="card-title">Data Semua Pengajuan</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="card-content">
    <div class="card-body">
      <div class="table-responsive">
        <div class="row">
          <div class="col-lg-12">
            <div class="element mb-1 p-r-15">

              <a href="<?php echo base_url('Home/permohonan_sjp')?>"><button id="btnSearchDrop2" type="button" aria-expanded="true" class="btn btn-primary btn-sm" style="border-radius: 8px; border: none;"> <i class="ft-plus"></i>Tambah Pengajuan</button></a>

            </div>
          </div>
        </div>
        <div class="row mb-1" style="padding-left: 15px; padding-right: 15px;" id="advancedfilterform">

        </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
       <!--    <?php if ($this->session->userdata('level')==1): ?>
            <div class="col-lg-3 filter">
              <select name="puskesmas" id="puskesmas" class="form-control" style="width: 100%">
                <option value="" selected>Semua Puskesmas</option>
                <?php if (!empty($puskesmas)): ?>
                  <?php foreach ($puskesmas as $puskes): ?>
                    <option value="<?= $puskes['id_puskesmas'] ?>" ><?= $puskes['nama_puskesmas']?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
          <?php endif ?> -->
          <div class="col-lg-3 filter">
            <select name="rs" id="rs" class="form-control">
              <option value="" selected>Semua Rumah Sakit</option>
              <?php if (!empty($rs)): ?>
                <?php foreach ($rs as $rsu): ?>
                  <option value="<?= $rsu['id_rumah_sakit'] ?>" ><?= $rsu['nama_rumah_sakit']?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>
          <div class="col-lg-3 filter">
            <select name="status" id="status" class="form-control">
              <option value="" selected>Semua Status</option>
              <?php if (!empty($statuspengajuan)): ?>
                <?php foreach ($statuspengajuan as $sp): ?>
                  <option value="<?= $sp['id_statuspengajuan'] ?>" ><?= $sp['status_pengajuan']?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>
          <div class="col-lg-3 filter">
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" id="cari" placeholder="Cari Nama Pasien, Pemohon, Rumah sakit, Status Pengajuan">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
        </div>
        <section id="configuration" style="padding-top: 10px;">
        <table id="datatable" class="table table-bordered" style="width: 100%;">
          <thead>
            <tr>
              <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
              <th style="color: #6B6F82!important;">Pemohon</th>
              <th style="color: #6B6F82!important;">Pasien</th>
              <th>Tanggal<br> Pengajuan</th>
              <!-- <th>Lama Pengajuan</th> -->
              <!-- <th>Puskesmas</th> -->
              <th>Rumah <br>Sakit</th>
              <!-- <th>Diagnosa</th> -->
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Status <br>Pengajuan</th>
              <th>Survey</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        </section>
      </div>
    </div>
  </div>
</div>
<style>
.action-menu {
  width: 200px !important;
  height: auto;
}
/*#datatable_length{
  display: none;
}*/
.p-l-15{
  padding-left: 15px;
}
.p-r-15{
  padding-right: 15px;
}
.filter{
  padding-right: 0px;
}
/*.table-responsive{
  overflow-x: hidden;
}*/
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
 <script src="<?= base_url()?>app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
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
    "bFilter": false,
    columns: [
    {data: "nama_pemohon", className : "text-info dt-head-center dt-body-right bodyclick"},
    {data: "nama_pasien", className : "text-info dt-head-center dt-body-right bodyclick"},
    {data: "tanggal_pengajuan", "render": function ( data, type, row, meta ) {
      var date = new Date(data);
      var year = date.getFullYear();
      var month = date.getMonth()+1;
      var dt = date.getDate();

      if (dt < 10) {
        dt = '0' + dt;
      }
      if (month < 10) {
        month = '0' + month;
      }

      var datenow = dt+'-' + month + '-'+year;
      return datenow;
    }, className: "dt-head-center dt-body-right bodyclick" },
    {data: "nm_rs", className : "dt-head-center dt-body-right bodyclick"},
    {data: "id_status_pengajuan", "render": function ( data, type, row, meta ) {
      if (data == 1) {
        //$('.statuspengajuan').addClass('bg-info');
        return '<div class="badge bg-blue-grey " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
        //return row.status_pengajuan;
      }else if (data == 2){
        // $('.statuspengajuan').addClass('bg-warning');
        // return row.status_pengajuan;
        return '<div class="badge bg-info " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      }else if (data == 3){
        // $('.statuspengajuan').addClass('bg-danger');
        // return row.status_pengajuan;
        return '<div class="badge bg-primary " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      }else if (data == 4){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-warning " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 5){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-warning " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 6){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-success " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 7){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-danger " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } 

    },className : "dt-head-center dt-body-right bodyclick statuspengajuan text-white"},
    {data: "tanggal_survey", "render": function ( data, type, row, meta ) {
     if (data == '' || data == null) {
      return '<a class="btn btn-secondary btn-sm" href="<?php echo base_url(); ?>Home/siap_survey/'+row.id_sjp+'/'+row.id_pengajuan+'"><i class="ft-zoom-in"></i>Survey Tempat Tinggal</a>';
    }else{
      return '<button class="btn btn-secondary btn-sm" style=" color: #fff" disabled="disabled"><i class="ft-check-circle"></i>Sudah Survey </button>'
    }

  }, className: "dt-head-center dt-body-right bodyclick" },
  {data: "id_sjp", "render": function ( data, type, row, meta ) {
      return `<a href="<?php echo base_url('/Home/hapussjp/'); ?>`+row.id_sjp+`" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus pengajuan ini?');"><i class="ft-trash"></i></a>`


    },className : "dt-head-center dt-body-right"},

  ],
  ajax: {
    url: ' <?php echo base_url("Home/getalldatapermohonan");?>',
    method: 'POST',
    "data": function(d) {
         
            d.puskesmas  = <?= $this->session->userdata('id_join') ?>;

          
          d.rs         = $("#rs").val();
          d.status     = $("#status").val();
          d.cari       = $("#cari").val();
        }
      },
      lengthMenu :[[5, 10, 25 , 50, 100, 1000], [5, 10, 25, 50, 100, 1000]],
      pagingType: "simple_numbers",
      pageLength: 10,
    });


  $(".filter").on('change', function() {
    dtable.ajax.reload();
  });

  $('.filter > #cari').keypress(function (e) {
    if (e.which == 13) {
      dtable.ajax.reload();
      return false;
    }
  });






  $('#datatable').on('click','tr', function(){
    var data= dtable.row(this).data();
    var id_sjp = data.id_sjp;
    var id_pengajuan = data.id_pengajuan;
      //console.log(data.id);
      //console.log("<?php echo base_url('Html/detail_harga/'); ?>" + komoditi);
      window.location.href = "<?php echo base_url('Home/detail_pengajuan/'); ?>" + id_sjp+"/"+id_pengajuan;
    })
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

<!-- ////////////////////////////////////////////////////////////////////////////-->

</body>
</html>