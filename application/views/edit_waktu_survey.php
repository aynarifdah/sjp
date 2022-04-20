<section id="number-tabs">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Edit Waktu Survey</h4>
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
            <form action="<?= base_url('Dinkes/update_parameter_waktu_survey') ?>" method="POST" class="wpcf7-form sjpform" id="sjpform" enctype="multipart/form-data">
              <?php foreach ($waktu as $key): ?>
                <input type="hidden" name="id" value="<?= $key['id'] ?>">
                            <!-- Step 2 -->
                <!-- <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Informasi Pasien</strong></h4> -->
                <fieldset class="mt-2">
                  <div class="form-group row">
                    <label class="col-lg-3 label-control" for="waktu_buka">Waktu Buka</label>
                    <div class="col-lg-3">
                      <input type="time" class="form-control" placeholder="Waktu Buka" name="waktu_survey" id="waktu_buka" required value="<?= $key['waktu_survey'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 label-control" for="waktu_tutup">Waktu Tutup</label>
                    <div class="col-lg-3">
                      <input type="time" class="form-control" placeholder="Waktu Tutup" name="selesai_survey" id="waktu_tutup" required value="<?= $key['selesai_survey'] ?>">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-md" name="btnEditInfo" id="btnEditInfo" style="float: right;">
                    <i class="ft-check-square"></i> Update
                  </button>
                </fieldset>
              <?php endforeach; ?>
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
</script>

<script>
  $(document).ready(function() {
    //$('.js-example-basic-multiple').select2({placeholder: "Pilih Diagnosa"});
  });
</script>