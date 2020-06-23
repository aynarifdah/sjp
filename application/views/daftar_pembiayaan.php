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
          <h4 class="card-title">Daftar Pembiayaan</h4>
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
              
              <a href="<?php echo base_url('Dinkes/export_excel_pembiayaan') ?>"><button type="button" id="entryklaim" aria-expanded="true" class="btn btn-primary btn-sm"><i class="ft-printer"></i>Export ke Excel</button></a>
          
            </div>
          </div>
        </div>
       
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
         
          <div class="col-lg-3 filter">
            <select name="rs" id="rs" class="form-control">
              <option value="">Rumah Sakit</option>
              <?php if (!empty($rs)): ?>
                <?php foreach ($rs as $r): ?>
                  <option value="<?= $r['id_rumah_sakit']?>"><?= $r["nama_rumah_sakit"] ?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>
          
          <div class="col-lg-3 filter">
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" id="cari" placeholder="Cari Nama, No Referensi, No SJP">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
        </div>

       <section id="configuration">
        <table id="datatable" class="table table-bordered" style="cursor:pointer;">
          <thead>
            <tr>
              <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
              <th>No</th>
              <th>Nama Pasien</th>
              <th>NIK</th>
              <th style="width: 50px;">Alamat Lengkap</th>
              <th>Fasilitas <br>Kesehatan</th>
              <th>Diagnosa</th>
              <th>Jumlah (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($dataklaim)) {
              $no = 1;
              foreach ($dataklaim as $key) {?> 
            <tr>
              <td><?php echo $no; ?>.</td>
              <td><?php echo $key['nama_pasien']; ?></td>
               <td><?php echo $key['nik']; ?></td>
              <td><?php echo $key['alamatpasien']; ?>
                
              </td>
              <td><?php echo $key['nm_rs']; ?></td>
              <td><?php if (!empty($penyakit)) {
                    foreach ($penyakit as $keypenyakit) { 
                      if ($key['id_sjp'] == $keypenyakit['id_sjp']) {?>
                      
                        <li>- <?php echo $keypenyakit['namadiag']; ?></li>
                     
                    <?php } }
                  } ?></td>
              <td><?php echo $key['nominal_klaim']; ?></td>
            </tr>
            <?php $no++; }
            } ?> 
          </tbody>
        </table>
        <section id="configuration">
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

<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">

<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>

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
 
  var dtable = $("#datatable").DataTable({
    // "responsive": true,
    "paging":   true,
    "ordering": true,
    "info":     true,
    "bFilter": false
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
 

  $('#entryklaim').click(function(event) {
  var id_sjp = [];
  $(".check:checked").each(function(index){
    id_sjp[index] = $(this).val();
  });
  console.log(id_sjp);
  var url = "entry_klaim?get=" + encodeURIComponent(id_sjp);
  window.location.href = url;
  // console.log(kontrakid);
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
