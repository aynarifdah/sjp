<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>Halaman Waktu Survey</title>
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
            <h4 class="card-title">Waktu Survey</h4>
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

                <!-- <a href="<?php echo base_url('Exportexcel/pengajuan_sjp_baru') ?>"><button id="btnSearchDrop2" type="button" aria-expanded="true" class="btn btn-primary btn-sm" style="border-radius: 8px; border: none;"> <i class="ft-printer"></i>Export Excel</button></a> -->

              </div>
            </div>
          </div>
          <div class="row mb-1" style="padding-left: 15px; padding-right: 15px;" id="advancedfilterform">

          </div>
          <section id="configuration" style="padding: 10px;">
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered" style="width: 100%;">
                <thead>
                  <tr>
                    <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
                    <th style="width: 10px !important; color: #6B6F82!important;">No</th>
                    <th style="width: 10px !important; color: #6B6F82!important;">Waktu Survey</th>
                    <th style="width: 30px; color: #6B6F82!important;">Selesai Survey</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
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
  </style>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">

  <script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>

  <script src="<?= base_url() ?>app-assets/js/scripts/tables/datatables/date-eu.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/responsive.bootstrap.min.css">

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css"> -->
  <!-- <script src="http://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script> -->
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
      "processing": true,
      "paging": true,
      "ordering": false,
      "info": true,
      "bFilter": false,
      "columnDefs": [{
        "targets": 2,
        "type": "date-eu"
      }],
      columns: [{
            data: "no",
            className: " dt-head-center dt-body-center bodyclick",
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },{
          data: "waktu_survey",
          className: "text-info dt-head-center dt-body-right bodyclick"
        },
        {
          data: "selesai_survey",
          className: "text-info dt-head-center dt-body-right bodyclick"
        }
      ],
      ajax: {
        url: ' <?php echo base_url("Dinkes/parameter_waktu_survey"); ?>',
        method: 'POST',
        // "data": function(d) {
        //   d.puskesmas = $("#puskesmas").val();
        //   d.mulai = $("#mulai").val();
        //   d.rs = $("#rs").val();
        //   d.status = 4;
        //   d.cari = $("#cari").val();
        //   // console.log(d);
        // }
      },
      lengthMenu: [
        [5, 10, 25, 50, 100, 1000],
        [5, 10, 25, 50, 100, 1000]
      ],
      pagingType: "simple_numbers",
      pageLength: 10,
    });

    dtable
      .order([2, 'desc'])
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
      var id = data.id;
      window.location.href = "<?php echo base_url('Dinkes/edit_parameter_waktu_survey/'); ?>" + id;
    })
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
    $("#bayar").on("click", function() {
      $("#content").load("<?= base_url(); ?>Home/bayarkontrak");
    });
    $("#btlkontrak").on("click", function() {
      $("#content").load("<?= base_url(); ?>Home/putuskontrak");
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

  <!-- ////////////////////////////////////////////////////////////////////////////-->

</body>

</html>