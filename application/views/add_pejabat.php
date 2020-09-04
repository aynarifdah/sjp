<section id="number-tabs">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Tambah Pejabat</h4>
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
            <form action="<?= base_url('Dinkes/tambah_pejabat'); ?>" method="POST" class="wpcf7-form sjpform" id="sjpform">
              <!-- Step 1 -->
              <h4 class="text-left"><i class="ft-user"></i> <strong>Informasi Pejabat</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="namalengkap">NIP</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control kontrakform" placeholder="NIP"
                    name="nip" id="nip" required> 
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="notelp">Nama Pejabat</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Nama Pejabat"
                    name="nama_pejabat" id="nama_pejabat" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="modal">Jabatan </label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Jabatan"
                    name="jabatan" id="jabatan" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="modal">Instansi </label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="instansi"
                    name="instansi" id="instansi" required>
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-lg-2 label-control" for="modal">Tanda Tangan </label>
              <div class="col-lg-9">
                    <input type="file" class="form-control"
                    name="tanda_tangan" id="tanda_tangan" required>
                  </div>
             </div>
        </fieldset>
        <div class="row">
          <div class="col-md-3 offset-md-10">
            <button type="submit" class="btn btn-primary btn-md" id="simpanpengajuan" name="btntambah">
              <i class="ft-check-square"></i> Tambah
            </button>
            
          </div>
        </div>
      </div>
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

<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
