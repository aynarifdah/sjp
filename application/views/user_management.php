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
          <h4 class="card-title">Management User</h4>
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
              <?php if ($this->session->userdata('level') == 1 && $this->session->userdata('instansi')==1): ?>
                <a href="#" aria-expanded="true" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalLevel"><i class="ft-plus"> </i>Tambah Level</a>
                <a href="#" aria-expanded="true" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalInstansi"><i class="ft-plus"> </i>Tambah Instansi</a>
                 <a href="<?= base_url('Dinkes/AddPejabat')?>"><button id="btnSearchDrop2" type="button" aria-expanded="true" class="btn btn-secondary btn-sm"> <i class="ft-plus"> </i>Tambah Pejabat</button></a>
              <?php endif ?>
              <a href="<?= base_url($controller.'AddUser')?>"><button id="btnSearchDrop2" type="button" aria-expanded="true" class="btn btn-primary btn-sm"> <i class="ft-plus"> </i>Tambah User</button></a>
            </div>
          </div>
        </div>
        <div class="row mb-1" style="padding-left: 15px; padding-right: 15px;" id="advancedfilterform">

        </div>
        <?php if ($this->session->userdata('instansi') == 1): ?>
          <div class="row" style="padding-left: 15px; padding-right: 15px;">
            <div class="col-lg-3 filter">
              <select name="level" id="level" class="form-control" style="width: 100%">
                <option value="" selected>Semua Level</option>
                <?php if (!empty($level)): ?>
                  <?php foreach ($level as $l): ?>
                    <?php if($this->session->userdata('instansi') !=1 && $l['id_level'] == 2){ continue; } ?>
                    <option value="<?= $l['id_level'] ?>" ><?= $l['nama_level']?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
            <div class="col-lg-3 filter">
              <select name="instansi" id="instansi" class="form-control">
                <option value="" selected>Semua Instansi</option>
                <?php if (!empty($instansi)): ?>
                  <?php foreach ($instansi as $ins): ?>
                    <option value="<?= $ins['id_instansi'] ?>" ><?= $ins['nama_instansi']?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
            <input type="hidden" class="form-control" id="level" value="">
            <input type="hidden" class="form-control" id="instansi" value="<?= $this->session->userdata('instansi'); ?>">
            <input type="hidden" class="form-control" id="status" value="">
          <?php endif ?>

          <div class="col-lg-3 filter">
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" id="cari" placeholder="Cari Nama, Username">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
          <?= $this->session->flashdata('message'); ?>
        </div>
        <section id="configuration">
        <table id="datatable" class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px !important; color: #6B6F82!important;">Nama</th>
              <th style="width: 30px; color: #6B6F82!important;">Username</th>
              <!-- <th style="width: 30px;max-width: 50px; color: #6B6F82!important;">Password</th> -->
                <th style="width: 30px;color: #6B6F82!important;">Level</th>
              <?php if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1): ?>
                <th style="width: 30px;color: #6B6F82!important;">Instansi</th>
              <?php endif ?>
              <?php if (($this->session->userdata('instansi') == 2) || ($this->session->userdata('instansi') == 3) || ($this->session->userdata('instansi') == 1)): ?>
                <th style="width: 30px;color: #6B6F82!important;">Domisili</th>
              <?php endif ?>
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

<!-- Modal -->
<?php if ($this->session->userdata('instansi') == 1): ?>
  <!-- Level -->
  <div class="modal fade text-left" id="modalLevel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Tambah Level</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form class="form" action="<?= base_url($controller.'UserManagement') ?>" method="POST">
                  <div class="modal-body">
                    <div class="form-group row">
                      <label class="col-lg-2 label-control" for="notelp">Level*</label>
                      <div class="col-lg-9">
                                           
                        <input type="text" class="form-control" placeholder="Nama Level"
                        name="level" id="level" required>
                      </div>
                    </div>
                    <button type="button" class="btn-sm btn grey" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-sm btn btn-primary" name="btnTambahLevel" onclick="return confirm('Anda yakin akan menambahkan Level ? ')">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Instansi -->
  <div class="modal fade text-left" id="modalInstansi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Tambah Instansi</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form class="form" action="<?= base_url($controller.'UserManagement') ?>" method="POST">
                  <div class="modal-body">
                    <div class="form-group row">
                      <label class="col-lg-2 label-control" for="notelp">Intansi*</label>
                      <div class="col-lg-9">
                                  
                        <input type="text" class="form-control" placeholder="Nama Instansi"
                        name="instansi" id="instansi" required>
                      </div>
                    </div>
                    <button type="button" class="btn-sm btn grey" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-sm btn btn-primary" name="btnTambahInstansi" onclick="return confirm('Anda yakin akan menambahkan Instansi ? ')">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  
  
<?php endif ?>


<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

<!-- <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script> -->

<script>
  // Polaris Checkbox & Radio
  $('.skin-polaris input').iCheck({
    checkboxClass: 'icheckbox_polaris',
    increaseArea: '-10%'
  });
  $(".select2").select2();
  var dtable = $("#datatable").DataTable({
   // "responsive": true,
    "paging":   true,
    "ordering": true,
    "info":     true,
    "bFilter": false,
    columns: [
      {data: "nama", className : "text-info dt-head-center dt-body-right bodyclick"},
      {data: "username", className : "text-info dt-head-center dt-body-right bodyclick"},
      {data: "nama_level", className : "text-info dt-head-center dt-body-right bodyclick"}
      // {data: "password", className : "text-info dt-head-center dt-body-right bodyclick"}
      <?php if (($this->session->userdata('instansi') == 1) && ($this->session->userdata('level') == 1)): ?>
        ,{data: "nama_instansi", className : "text-info dt-head-center dt-body-right bodyclick"}
      <?php endif ?>
      <?php if (($this->session->userdata('instansi') == 2) || ($this->session->userdata('instansi') == 3) || ($this->session->userdata('instansi') == 1)): ?>
        ,{data: "nama_join", className : "text-info dt-head-center dt-body-right bodyclick"}
      <?php endif ?>
    ],
  ajax: {



    <?php if($this->session->userdata('level') == 1):?>
      url: " <?= base_url($controller.'getDataUserDinkes') ?>",
    <?php else : ?>
      url: " <?= base_url($controller.'getDataUser?instansi=') . $this->session->userdata('instansi') ?>",
    <?php endif ?>
    method: 'POST',
    "data": function(d) {
          d.level      = $("#level").val();
          d.instansi   = $("#instansi").val();
          d.status     = $("#status").val();
          d.cari       = $("#cari").val();
          // console.log(d);
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
      // alert("ok");
      dtable.ajax.reload();
      return false;
    }
  });





  $('#datatable').on('click','tr', function(){
    var data= dtable.row(this).data();
    var id_user = data.id_user;
    // var id_pengajuan = data.id_pengajuan;
      //console.log(data.id);
      //console.log("<?php echo base_url('Html/detail_harga/'); ?>" + komoditi);
      window.location.href = "<?= base_url($controller.'editUser/'); ?>" + id_user;
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
    $("#content").load("<?=base_url($controller);?>KontrakAdd", data);
  });
  $('.detail').on("click", function() {
    $("#content").load("<?=base_url($controller);?>Halaman_detail_pengajuan");
  });
  $('#putuskontrak').on("click", function() {
    $("#content").load("<?=base_url($controller);?>putuskontrak");
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
    $("#content").load("<?=base_url($controller);?>bayarkontrak");
  });
  $("#btlkontrak").on("click", function(){
    $("#content").load("<?=base_url($controller);?>putuskontrak");
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