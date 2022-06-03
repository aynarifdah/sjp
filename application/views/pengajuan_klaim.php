<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>Halaman utama</title>
</head>

<style type="text/css">
  .table th {
    width: 10%;
  }

  .table th,
  .table td {
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
          <h4 class="card-title">Data Pengajuan Klaim</h4>
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
              <?php if ($this->uri->segment(3) == '') : ?>
                <a href="<?php echo base_url('Exportexcel/pengajuan_klaim') ?>" class="btn btn-primary btn-sm"><i class="ft-printer"></i> Export Excel</a>
              <?php elseif ($this->uri->segment(3) == 2) : ?>
                <a href="<?php echo base_url('Exportexcel/persetujuan_klaim') ?>" class="btn btn-primary btn-sm"><i class="ft-printer"></i> Export Excel</a>
              <?php elseif ($this->uri->segment(3) == 3) : ?>
                <a href="<?php echo base_url('Exportexcel/pembayaran_klaim') ?>" class="btn btn-primary btn-sm"><i class="ft-printer"></i> Export Excel</a>
              <?php elseif ($this->uri->segment(3) == 4) : ?>
                <a href="<?php echo base_url('Exportexcel/sudah_bayar_klaim') ?>" class="btn btn-primary btn-sm"><i class="ft-printer"></i> Export Excel</a>
              <?php endif; ?>


              <?php if ($status_klaim == 3) { ?>
                <button type="button" class="btn btn-secondary btn-sm" id="updatestatbayar"><i class="ft-credit-card"></i>&nbsp; Update Status Bayar</button>
              <?php } ?>

            </div>
          </div>
        </div>

        <div class="row" style="padding-left: 15px; padding-right: 15px;">
          <div class="col-lg-2 filter">
            <label>Tanggal mulai :</label>
            <input type="date" name="mulai" id="mulai" class="form-control" placeholder="Tanggal Mulai Referensi">
          </div>
          <div class="col-lg-2 filter">
            <label>Tanggal akhir :</label>
            <input type="date" name="akhir" id="akhir" class="form-control" placeholder="Tanggal Akhir Referensi">
          </div>
          <?php if ($status_klaim <= 0) : ?>
            <div class="col-lg-2 filter">
              <label>Status Klaim</label>
              <select name="status" id="status" class="form-control">
                <option value="" selected>Semua Status</option>
                <?php if (!empty($statusklaim)) : ?>
                  <?php foreach ($statusklaim as $sk) : ?>
                    <option value="<?= $sk['id_statusklaim'] ?>"><?= $sk['nama_statusklaim'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
          <?php else : ?>
            <input type="hidden" name="status" id="status" value="">
          <?php endif ?>
          <div class="col-lg-3 filter">
            <label>Rumah Sakit</label>
            <select name="rs" id="rs" class="form-control">
              <option value="" selected>Semua Rumah Sakit</option>
              <?php if (!empty($rs)) : ?>
                <?php foreach ($rs as $rsu) : ?>
                  <option value="<?= $rsu['id_rumah_sakit'] ?>"><?= $rsu['nama_rumah_sakit'] ?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>
          <div class="col-lg-3 filter">
            <label>Cari</label>
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" name="cari" id="cari" placeholder="Cari Nama, No Referensi, No SJP">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
        </div>

        <!--    <div class="row mt-2">
          <div class="col-lg-3 offset-lg-9">
            <?php if ($this->uri->segment(3) == '') : ?>
              <a href="<?php echo base_url('Exportexcel/pengajuan_klaim') ?>" class="btn btn-primary" style="width: 100%;"><i class="ft-printer"></i> Excel</a>
            <?php elseif ($this->uri->segment(3) == 2) : ?>
              <a href="<?php echo base_url('Exportexcel/persetujuan_klaim') ?>" class="btn btn-primary" style="width: 100%;"><i class="ft-printer"></i> Excel</a>
            <?php elseif ($this->uri->segment(3) == 3) : ?>
              <a href="<?php echo base_url('Exportexcel/pembayaran_klaim') ?>" class="btn btn-primary" style="width: 100%;"><i class="ft-printer"></i> Excel</a>
            <?php elseif ($this->uri->segment(3) == 4) : ?>
              <a href="<?php echo base_url('Exportexcel/sudah_bayar_klaim') ?>" class="btn btn-primary" style="width: 100%;"><i class="ft-printer"></i> Excel</a>
            <?php endif; ?>
          </div>
        </div> -->

        <section id="configuration" style="padding: 10px;">
          <table id="datatable" class="table table-bordered" style="width: 100%;">
            <thead>
              <tr>
                <th>
                  <div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div>
                </th>
                <th>No</th>
                <th style="color: #6B6F82 !important;">Nama</th>
                <th>Nomor SJP</th>
                <th>Rumah Sakit</th>
                <th>Jenis Rawat</th>
                <th>Tanggal <br>Tagihan</th>
                <th>Nominal <br>Pengajuan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </section>
        <!--  -->
      </div>
    </div>
  </div>
</div>
<style>
  .action-menu {
    width: 200px !important;
    height: auto;
  }

  /*  #datatable_length{
    display: none;
  }*/
  .p-l-15 {
    padding-left: 15px;
  }

  .p-r-15 {
    padding-right: 15px;
  }

  .filter {
    padding-right: 0px;
  }

  /* .table-responsive{
    overflow-x: hidden;
  }*/
  .card-body {
    padding-top: 0px;
  }

  .picker__nav--prev:before {
    content: '<' !important;
  }

  .picker__nav--next:before {
    content: '>' !important;
  }

  @media (min-width: 992px) {
    .element {
      float: right !important;
    }
  }

  @media (max-width: 575.98px) {
    .element {
      text-align: center !important;
      padding-right: 0px;
    }

    .filter {
      padding-right: 15px;
      padding-bottom: 5px;
    }
  }
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">

<script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

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
  $('#updatestatbayar').click(function(event) {
    var id_sjp = [];
    $(".check:checked").each(function(index) {
      id_sjp[index] = $(this).val();
    });
    var url = "<?php echo base_url(); ?>/Dinkes/updatestatbayar?get=" + encodeURIComponent(id_sjp);
    window.location.href = url;
    // console.log(kontrakid);
  });
  // Polaris Checkbox & Radio
  $('.skin-polaris input').iCheck({
    checkboxClass: 'icheckbox_polaris',
    increaseArea: '-10%'
  });
  $(".select2").select2();
  var dtable = $("#datatable").DataTable({
    // "responsive": true,
    "paging": true,
    "ordering": true,
    "info": true,
    "bFilter": false,
    "drawCallback": function(settings) {
      //iCheck for checkbox and radio inputs
      $('.skin-polaris input').iCheck({
        checkboxClass: 'icheckbox_polaris',
        increaseArea: '-10%'
      });
      var triggeredByChild = false;
      $('#check-all').on('ifChecked', function(event) {
        $('.check').iCheck('check');
        triggeredByChild = false;
      });

      $('#check-all').on('ifUnchecked', function(event) {
        if (!triggeredByChild) {
          $('.check').iCheck('uncheck');
        }
        triggeredByChild = false;
      });
      // Removed the checked state from "All" if any checkbox is unchecked
      $('.check').on('ifUnchecked', function(event) {
        triggeredByChild = true;
        $('#check-all').iCheck('uncheck');
      });

      $('.check').on('ifChecked', function(event) {
        if ($('.check').filter(':checked').length == $('.check').length) {
          $('#check-all').iCheck('check');
        }
      });
    },
    columns: [{
        data: "id_sjp",
        "render": function(data, type, row, meta) {
          return '<div class="skin skin-polaris"><input type="checkbox" id="input-21" class="check" value="' + data + '"></div>';
        },
        className: "dt-head-center dt-body-right"
      },
      {
          data: "no",
          className: " dt-head-center dt-body-center bodyclick",
          render: function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
          }
      },
      {
        data: "nama_pasien",
        className: "text-info dt-head-center dt-body-right bodyclick"
      },
      {
        data: "nomor_surat",
        className: "dt-head-center dt-body-right bodyclick"
      },
      {
        data: "nm_rs",
        className: "dt-head-center dt-body-right bodyclick"
      },
      {
        data: "jenis_rawat",
        className: "dt-head-center dt-body-right bodyclick"
      },
      {
        data: "tanggal_tagihan",
        "render": function(data, type, row, meta) {
          var date = new Date(data);
          var year = date.getFullYear();
          var month = date.getMonth() + 1;
          var dt = date.getDate();

          if (dt < 10) {
            dt = '0' + dt;
          }
          if (month < 10) {
            month = '0' + month;
          }

          var datenow = dt + '-' + month + '-' + year;
          return datenow;
        },
        className: "dt-head-center dt-body-right bodyclick"
      },
      // {data: "nomor_tagihan", className : "dt-head-center dt-body-right bodyclick"},
      {
        data: "nominal_klaim",
        className: "dt-head-center dt-body-right bodyclick"
      },
      {
        data: "status_klaim",
        "render": function(data, type, row, meta) {
          if (data == 1) {
            //$('.statuspengajuan').addClass('bg-info');
            return '<div class="badge bg-blue-grey " style="font-size: 14px;">' + row.nama_statusklaim + '</div>'
            //return row.status_pengajuan;
          } else if (data == 2) {
            // $('.statuspengajuan').addClass('bg-warning');
            // return row.status_pengajuan;
            return '<div class="badge bg-info " style="font-size: 14px;">' + row.nama_statusklaim + '</div>'
          } else if (data == 3) {
            // $('.statuspengajuan').addClass('bg-danger');
            // return row.status_pengajuan;
            return '<div class="badge bg-warning " style="font-size: 14px;">' + row.nama_statusklaim + '</div>'
          } else if (data == 4) {
            // $('.statuspengajuan').addClass('bg-success');
            // return row.status_pengajuan;
            return '<div class="badge bg-success" style="font-size: 14px;">' + row.nama_statusklaim + '</div>'
          }

        },
        className: "dt-head-center dt-body-right bodyclick statuspengajuan"
      },
    ],
    ajax: {
      url: ' <?php echo base_url("Dinkes/getdatapengajuanklaim"); ?>',
      method: 'POST',
      "data": function(d) {
        d.status_klaim = '<?php echo $status_klaim ?>';
        d.mulai = $("#mulai").val();
        d.akhir = $("#akhir").val();
        d.rs = $("#rs").val();
        d.status = $("#status").val();
        d.cari = $("#cari").val();
      }
    },
    lengthMenu: [
      [5, 10, 25, 50, 100, 1000],
      [5, 10, 25, 50, 100, 1000]
    ],
    pagingType: "simple_numbers",
    pageLength: 10,
  });


  $(".filter").on('change', function() {
    dtable.ajax.reload();
  });

  $('.filter > #cari').keypress(function(e) {
    if (e.which == 13) {
      dtable.ajax.reload();
      return false;
    }
  });


  $(document).ready(function() {
    $('#advancedfilterform').hide();
  });
  $('#datatable').on('click', 'tr', function() {
    var data = dtable.row(this).data();
    var id_sjp = data.id_sjp;
    var id_pengajuan = data.id_pengajuan;
    //console.log(data.id);
    //console.log("<?php echo base_url('Html/detail_harga/'); ?>" + komoditi);
    window.location.href = "<?php echo base_url('Dinkes/detail_pengajuan/'); ?>" + id_sjp + "/" + id_pengajuan;
  })
  $('#advancedfilterbtn').on("click", function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#advancedfilterform').hide();
    } else {
      $(this).addClass('active');
      $('#advancedfilterform').show();
    }
  });
  $(".tambahkontrak").on("click", function() {
    var tipe = $(this).attr("id");
    var title = $(this).attr("value");
    var data = {
      tipe: tipe,
      title: title
    };
    // alert(tipe);
    $("#content").load("<?= base_url(); ?>Home/KontrakAdd", data);
  });
  $('.detail').on("click", function() {
    $("#content").load("<?= base_url(); ?>Home/Halaman_detail_pengajuan");
  });
  $('#putuskontrak').on("click", function() {
    $("#content").load("<?= base_url(); ?>Home/putuskontrak");
  });

  $("#bayar").on("click", function() {
    $("#content").load("<?= base_url(); ?>Home/bayarkontrak");
  });
  $("#btlkontrak").on("click", function() {
    $("#content").load("<?= base_url(); ?>Home/putuskontrak");
  });


  var triggeredByChild = false;
  $('#check-all').on('ifChecked', function(event) {
    $('.check').iCheck('check');
    triggeredByChild = false;
  });

  $('#check-all').on('ifUnchecked', function(event) {
    if (!triggeredByChild) {
      $('.check').iCheck('uncheck');
    }
    triggeredByChild = false;
  });
  // Removed the checked state from "All" if any checkbox is unchecked
  $('.check').on('ifUnchecked', function(event) {
    triggeredByChild = true;
    $('#check-all').iCheck('uncheck');
  });

  $('.check').on('ifChecked', function(event) {
    if ($('.check').filter(':checked').length == $('.check').length) {
      $('#check-all').iCheck('check');
    }
  });
</script>


</body>

</html>