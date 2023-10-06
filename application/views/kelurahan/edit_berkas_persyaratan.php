<section id="number-tabs">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Edit Data Pasien</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <form action="<?= base_url($controller . 'aksi_edit_berkas_persyaratan'); ?>" method="POST" class="wpcf7-form sjpform" id="sjpform" enctype="multipart/form-data">
              <input type="hidden" name="id_sjp" value="<?= $detail[0]['id_sjp'] ?>">
              <input type="hidden" name="id_pp" value="<?= $this->uri->segment(4) ?>">
              <input type="hidden" class="form-control" placeholder="NIK" name="nikpasien" id="nikpasien" required value="<?= $detail[0]['nik'] ?>" readonly>
              <input type="hidden" class="form-control kontrakform" placeholder="Nama Lengkap" name="nama_pasien" id="namapasien" required value="<?= $detail[0]['nama_pasien'] ?>" readonly>
              <fieldset class="mt-2">
                <!-- DOKUMEN PERSYARATAN -->

                <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Dokumen Persyaratan (berupa foto)</strong></h4>
                <?php if (!empty($getForUpdateFile)) {
                  foreach ($getForUpdateFile as $key) { ?>
                    <div class="form-group row" id="modalwal">
                      <label class="col-lg-3 label-control" for="modal"><?= $key['nama_persyaratan'] ?></label>
                      <div class="col-lg-9">
                        <?php $extensions = pathinfo(base_url('uploads/dokumen/') . $key['attachment'], PATHINFO_EXTENSION); ?>
                        <?php if ($key["id_persyaratan"] == 6 || $key["id_persyaratan"] == 7 && 8 || $key["id_persyaratan"] == 10  && 8 || $key["id_persyaratan"] == 3  || $key["id_persyaratan"] == 21) { ?>
                          <?php if ($extensions == "pdf") : ?>
                            <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="id_persyaratan[]" style="height: 40px;">
                            <img id="old" name="old" class="old" src="<?php echo base_url() ?>assets/images/pdf.png" width="100" height="auto">
                            <small class="text-sm"><?= $key['attachment']; ?></small>
                            <input type="file" id="dokumen" class="form-control mt-2 filedokumen" name="dokumen[]" style="height: 40px;" value="<?= base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>">
                          <?php endif; ?>

                          <?php if ($extensions !== "pdf") : ?>
                            <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="id_persyaratan[]" style="height: 40px;">
                            <img id="old" name="old" class="old" src="<?php echo base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>" width="100" height="auto">

                            <input type="file" id="dokumen" class="form-control mt-2 filedokumen" name="dokumen[]" style="height: 40px;" value="<?= base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>">
                          <?php endif; ?>

                        <?php } else { ?>
                          <?php if ($extensions == "pdf") : ?>
                            <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="id_persyaratan[]" style="height: 40px;" required>
                            <img id="old" name="old" class="old" src="<?php echo base_url() ?>assets/images/pdf.png" width="100" height="auto">
                            <small class="text-sm"><?= $key['attachment']; ?></small>
                            <input type="file" id="dokumen" class="form-control mt-2 filedokumen" name="dokumen[]" style="height: 40px;" value="<?= base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>">
                          <?php endif; ?>

                          <?php if ($extensions !== "pdf") : ?>
                            <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="id_persyaratan[]" style="height: 40px;" required>
                            <img id="old" name="old" class="old" src="<?php echo base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>" width="100" height="auto">

                            <input type="file" id="dokumen" class="form-control mt-2 filedokumen" name="dokumen[]" style="height: 40px;" value="<?= base_url() ?>uploads/dokumen/<?php echo $key['attachment'] ?>">
                          <?php endif; ?>

                        <?php }
                        ?>
                      </div>
                    </div>
                <?php }
                }  ?>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="feedback">Feedback Dokumen</label>
                  <div class="col-lg-9">
                    <!-- <input type="text" class="form-control kontrakform" placeholder="Feedback" name="feedback" id="feedback" value="<?= $detail[0]['feedback'] ?>"> -->
                    <textarea class="ckeditor" id="ckedtor" name="feedback"><?= $detail[0]['feedback'] ?></textarea>
                  </div>
                </div>


                <button type="submit" class="btn btn-primary btn-md" name="btnEditInfo" id="btnEditInfo" style="float: right;">
                  <i class="ft-check-square"></i> Update
                </button>
              </fieldset>
              <!-- Step 3 -->



            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<script type="text/javascript">
  // $('.datepicker').daterangepicker({
  //   singleDatePicker: true,
  //   showDropdowns: true,
  //   locale: {
  //     format: 'DD-MM-YYYY'
  //   }
  // });

  $('.skin-polaris input').iCheck({
    checkboxClass: 'icheckbox_polaris',
    increaseArea: '-10%'
  });
  // Multiple Select Placeholder
  function diagnosa2() {
    $('.kd_diagnosa').select2({
      placeholder: "Pilih penyakit",
    });
  }
  $(document).ready(function() {
    //getkelurahan();
    diagnosapenyakit();
    diagnosa2();
    // $('.diagnosalainnya').hide();
  });

  // $('.checkbox').on('ifChecked', function (event) {
  //   $('.diagnosalainnya').show();
  // });

  // $('.checkbox').on('ifUnchecked', function (event) {
  //   $('.diagnosalainnya').hide();
  // });
  $('.add').click(function(argument) {
    diagnosapenyakit();
    diagnosa2();
    $('.skin-polaris input').iCheck({
      checkboxClass: 'icheckbox_polaris',
      increaseArea: '-10%'
    });
  });

  function diagnosapenyakit() {
    $('.diagnosapenyakit').each(function(index) {
      $('.kd_topik').select2({
        placeholder: "Pilih Topik"
      }).eq(index).on('select2:select', function(evt) {
        var data = $(this).val();
        $.ajax({
          url: "<?= base_url($controller); ?>getDiagnosa",
          method: "POST",
          data: {
            id: data
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '<option>Pilih Diagnosa</option>';
            var i;
            for (i = 0; i < data.length; i++) {
              html += '<option value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
            }
            $('.kd_diagnosa').eq(index).html(html);

          }
        });
      });
    });
  }
  //  $('.add').click(function() {
  //       $('.kd_topik').each(function(index) {
  //         //console.log(index)
  //   $('.kd_topik').eq(index).change(function(){

  // })
  // })
  //  })


  function getdiagnosa() {
    var data = $('#kd_topik').val();
    $.ajax({
      url: "<?= base_url($controller); ?>getDiagnosa",
      method: "POST",
      data: {
        id: data
      },
      async: false,
      dataType: 'json',
      success: function(data) {
        var html = '<option>Pilih Diagnosa</option>';
        var i;
        var diagnosa = '<?php if (!empty($testDiagnosa[0]['id_penyakit'])) {
                          echo $testDiagnosa[0]['id_penyakit'];
                        } ?>';
        for (i = 0; i < data.length; i++) {
          if (data[i].namadiag == diagnosa) {
            html += '<option selected value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
          } else {
            html += '<option value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
          }
        }
        $('#kd_diagnosa').html(html);

      }
    });
  }

  $(document).ready(function() {
    getkelurahan();
    getkelurahanpasien();
    getdiagnosa();
  });

  $('#kd_kecamatanpemohon').change(function() {
    getkelurahan();
  })

  function getkelurahan() {
    var data = $('#kd_kecamatanpemohon').val();
    var selectedData = '<?= $detail[0]["kecpemohon"] ?>';
    $.ajax({
      url: "<?= base_url($controller); ?>getKelurahan",
      method: "POST",
      data: {
        id: data
      },
      async: false,
      dataType: 'json',
      success: function(data) {
        var html = '<option>Pilih Kelurahan</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value = "' + data[i].kelurahan + '" ';
          if (data[i].kelurahan == selectedData) {
            html += "selected";
          }
          html += '>' + data[i].kelurahan + '</option>';
        }
        $('#kd_kelurahanpemohon').html(html);

      }
    });
  }


  $('#kd_kecamatanpasien').change(function() {
    getkelurahanpasien();
  })

  function getkelurahanpasien() {
    var data = $('#kd_kecamatanpasien').val();
    var selectedData = '<?= $detail[0]["kd_kecamatan"] ?>';
    $.ajax({
      url: "<?= base_url($controller); ?>getKelurahan",
      method: "POST",
      data: {
        id: data
      },
      async: false,
      dataType: 'json',
      success: function(data) {
        var html = '<option>Pilih Kelurahan</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value = "' + data[i].kelurahan + '" ';
          if (data[i].kelurahan == selectedData) {
            html += "selected";
          }
          html += '>' + data[i].kelurahan + '</option>';
        }
        $('#kd_kelurahanpasien').html(html);

      }
    });
  }

  // TEST

  // TANGGAL LAHIR PASIEN
  $('#tanggallahirpasien').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    maxYear: parseInt(moment().format('YYYY'), 10),
    locale: {
      format: 'DD-MM-YYYY'
    }
  });
  // TANGGAL LAHIR PASIEN
  $('.datepicker').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2000,
    locale: {
      format: 'DD-MM-YYYY'
    }
  });


  $("select#jenisrawat").change(function() {
    var selected = $(this).children("option:selected").val();
    // console.log(selected);
    if (selected == 'Rawat Inap') {

      $('#mulairawat').on("change", function() {
        var mulairawat = $("#mulairawat").val().split("-");
        var d = new Date(mulairawat[2], mulairawat[1] - 1, mulairawat[0]);
        d.setDate(d.getDate() + 30);
        var endDateStr = ("0" + d.getDate()).slice(-2) + '-' + (d.getMonth() + 1) + '-' + (d.getYear() + 1900);
        console.log(endDateStr);
        var akhirrawat = $('#akhirrawat').val(endDateStr);

      });

    } else {

      $('#mulairawat').on("change", function() {
        var mulairawat = $("#mulairawat").val().split("-");
        var d = new Date(mulairawat[2], mulairawat[1] - 1, mulairawat[0]);
        d.setDate(d.getDate() + 14);
        var endDateStr = ("0" + d.getDate()).slice(-2) + '-' + (d.getMonth() + 1) + '-' + (d.getYear() + 1900);
        console.log(endDateStr);
        var akhirrawat = $('#akhirrawat').val(endDateStr);
      });

    }
  });


  // TEST



  // $('#simpanpengajuan').click(function() {
  //   var tes = $('.sjpform').serialize();
  //   console.log(decodeURIComponent(tes));
  // })
</script>

<script>
  $(document).ready(function() {
    //$('.js-example-basic-multiple').select2({placeholder: "Pilih Diagnosa"});
  });
</script>