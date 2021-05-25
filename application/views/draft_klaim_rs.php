
<head>
  <title>Halaman pengajuan SJP</title>
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">


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
            <h4 class="card-title">Data SJP yang belum diajukan klaim</h4>
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
                <!-- <button type="button" class="btn bg-success bg-darken-4 btn-sm text-white" id="export"><i class="icon-cloud-download"></i>&nbsp; Eksport ke Excel</button> -->
                <button type="button" id="entryklaim" aria-expanded="true" class="btn btn-primary btn-sm"><i class="ft-plus"></i>Entry Klaim</button>
                <!-- <a href="<?php echo base_url('Rs/permohonan_sjp') ?>"><button id="btnSearchDrop2" type="button" aria-expanded="true" class="btn btn-primary btn-sm"> <i class="ft-plus"></i>Tambah Pengajuan</button></a> -->

              </div>
            </div>
          </div>
          <div class="row" style="padding-left: 15px; padding-right: 15px;">
            <div class="col-lg-3 filter">
              <label>Tanggal Pengajuan :</label>
              <input type="date" name="mulai" id="mulai" class="form-control" placeholder="Tanggal Mulai Referensi">
            </div>
            <!-- <div class="col-lg-3 filter">
            <label>Tanggal akhir :</label>
            <input type="date" name="akhir" id="akhir" class="form-control" placeholder="Tanggal Akhir Referensi">
          </div> -->
            <!--  <?php if ($status_klaim <= 0) : ?>
            <div class="col-lg-3 filter">
              <label>Status Klaim</label>
              <select name="status" id="status" class="form-control">
                <option value="" selected>Semua Status</option>
                <?php if (!empty($statusklaim)) : ?>
                  <?php foreach ($statusklaim as $sk) : ?>
                    <option value="<?= $sk['id_statusklaim'] ?>" ><?= $sk['nama_statusklaim'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
          <?php else : ?> -->
            <input type="hidden" name="status" id="status" value="">
          <?php endif ?>
          <?php if ($this->session->userdata('level') == 1) : ?>
            <!-- <div class="col-lg-3 filter">
              <label>Rumah Sakit</label>
              <select name="rs" id="rs" class="form-control">
                <option value="" selected>Semua Rumah Sakit</option>
                <?php if (!empty($rs)) : ?>
                  <?php foreach ($rs as $rsu) : ?>
                    <option value="<?= $rsu['id_rumah_sakit'] ?>" ><?= $rsu['nama_rumah_sakit'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div> -->
          <?php else : ?>
            <input type="hidden" id="rs" name="rs" value="<?= $this->session->userdata('id_join'); ?>">
          <?php endif ?>
          <div class="col-lg-3 filter">
            <label>Cari</label>
            <div class="position-relative has-icon-left">
              <input type="text" class="form-control" name="cari" id="cari" placeholder="Cari Nama Pasien, Pemohon, No Surat">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </div>
          </div>
          </div>
          <!-- <section id="configuration" style="padding: 10px;"> -->
          <table id="datatable" class="table table-bordered" style="width: 100%;">
            <thead>
              <tr>
                <th>
                  <div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div>
                </th>
                <th style="width: 10px !important; color: #6B6F82!important;">Pasien</th>
                <th style="width: 30px; color: #6B6F82!important;">Pemohon</th>
                <th style="width: 30px;">Nomor<br> Surat</th>
                <th style="width: 30px;">Tanggal <br>Pengajuan</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <!-- </section> -->
        </div>
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
    .p-l-15 {
      padding-left: 15px;
    }

    .p-r-15 {
      padding-right: 15px;
    }

    .filter {
      padding-right: 0px;
    }

    /*.table-responsive{
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

    @import url("<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css");
    @import url("<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css");
  </style>

  <script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

  <!-- tambahan -->
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/dataTables.fixedHeader.min.js"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/responsive.bootstrap.min.js"></script>
  <script src="<?= base_url() ?>app-assets/js/scripts/tables/datatables/date-eu.js" type="text/javascript"></script>

  <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/responsive.bootstrap.min.css">
 
  <script>
    $('#entryklaim').click(function(event) {
      // console.log($(".check:checked").val());
      var id_sjp = [];
      $("input.check:checked").each(function(e) {
        id_sjp[e] = $(this).val();
        console.log(id_sjp);
      });
      // console.log(id_sjp);
      var url = "entry_klaim?get=" + encodeURIComponent(id_sjp);
      window.location.href = url;
    });
    // Polaris Checkbox & Radio
    $('.skin-polaris input').iCheck({
      checkboxClass: 'icheckbox_polaris',
      increaseArea: '-10%'
    });
    $(".select2").select2();
    var dtable = $("#datatable").DataTable({
      // "responsive": true,
      "processing": true,
      "paging": true,
      "ordering": false,
      "info": true,
      "bFilter": false,
      "columnDefs": [{
        "targets": 4,
        "type": "date-eu"
      }],
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
          data: "nama_pasien",
          className: "text-info dt-head-center dt-body-right bodyclick"
        },
        {
          data: "nama_pemohon",
          className: "text-info dt-head-center dt-body-right bodyclick"
        },
        {
          data: "nomor_surat",
          className: "dt-head-center dt-body-right bodyclick"
        },
        {
          data: "tanggal_pengajuan",
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
        // {data: "id_penyakit33", className : "dt-head-center dt-body-right bodyclick"},

      ],
      ajax: {
        url: ' <?php echo base_url("Rs/view_permohonanklaim_rs"); ?>',
        method: 'POST',
        "data": function(d) {

          // d.rumahsakit  = <?= $this->session->userdata('id_join') ?>;
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

    dtable
      .order([4, 'desc'])
      .draw();

    $(".filter").on('change', function() {
      dtable.ajax.reload();
    });

    $('.filter > #cari').keypress(function(e) {
      if (e.which == 13) {
        dtable.ajax.reload();
        return false;
      }
    });
    $('#datatable').on('click', 'tr', function() {
      var data = dtable.row(this).data();
      var id_sjp = data.id_sjp;
      var id_pengajuan = data.id_pengajuan;
      var id_puskesmas = data.id_puskesmas;
      //console.log(data.id);
      //console.log("<?php echo base_url('Html/detail_harga/'); ?>" + komoditi);
      window.location.href = "<?php echo base_url('Rs/detail_pengajuan/'); ?>" + id_sjp + "/" + id_pengajuan + "/" + id_puskesmas;
    });
    $(document).ready(function() {
      $('#advancedfilterform').hide();
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
    $(document).ready(function() {
      $('#advancedfilterform').hide();
    });
    $('#advancedfilterbtn').on("click", function() {
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('#advancedfilterform').hide();
      } else {
        $(this).addClass('active');
        $('#advancedfilterform').show();
      }
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

  </script>

