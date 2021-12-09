<section id="number-tabs">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Edit User</h4>
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
            <form action="<?= base_url($controller.'UserManagement'); ?>" method="POST" class="wpcf7-form sjpform" id="sjpform">
              <input type="hidden" name="id_user" value="<?= $user[0]['id_user'] ?>">
              <!-- Step 1 -->
              <h4 class="text-left"><i class="ft-user"></i> <strong>Informasi User</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="namalengkap">Nama*</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control kontrakform" placeholder="Nama"
                    name="nama" id="nama" required value="<?= $user[0]['nama'] ?>"> 
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="notelp">Username*</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Username"
                    name="username" id="username" required value="<?= $user[0]['username'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="modal">Password* </label>
                  <div class="col-lg-9">
                    <input type="password" class="form-control" placeholder="Password"
                    name="password" id="password" required value="<?= $this->encryption->decrypt($user[0]['password']) ?>">
                  </div>
                </div>
                  <div class="form-group row">
                    <label class="col-lg-2 label-control" for="level">Level*</label>
                    <div class="col-lg-3">
                      <select class="select2 form-control block kecamatan" id="level" name="level" style="width: 100%" required>
                         <option value="">Pilih Level</option>
                         <?php if (!empty($level)): ?>
                            <?php foreach ($level as $l): ?>
                              <?php if($this->session->userdata('instansi') !=1 && $l['id_level'] == 2){ continue; } ?>
                              <option value="<?= $l['id_level'] ?>" <?= ($user[0]['level'] == $l['id_level'])? "selected": '' ?>><?= $l['nama_level']?></option>
                            <?php endforeach ?>
                          <?php endif ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                <?php if ($this->session->userdata('level') == 1 && ($this->session->userdata('instansi') == 1 || $this->session->userdata('instansi') == 2 || $this->session->userdata('instansi') == 3 ) || $this->session->userdata('instansi') == 6 ): ?>
                  <?php if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1): ?>
                    <label class="col-lg-2 label-control" for="level">Instansi*</label>
                    <div class="col-lg-3">
                      <select class="select2 form-control block kecamatan" id="instansi" name="instansi" style="width: 100%" required>
                         <option value="">Pilih Instansi</option>
                         <?php if (!empty($instansi)): ?>
                            <?php foreach ($instansi as $i): ?>
                              <option value="<?= $i['id_instansi'] ?>" <?= ($user[0]['id_instansi'] == $i['id_instansi'])? "selected": '' ?> ><?= $i['nama_instansi']?></option>
                            <?php endforeach ?>
                          <?php endif ?>
                      </select>
                    </div>
                  <?php else:  ?>
                    <label class="col-lg-2 label-control" for="id_join">Domisili*</label>
                    <input type="hidden" name="instansi" value="<?= $this->session->userdata('instansi') ?>">
                  <?php endif ?>
                    <div class="col-lg-3" id="id_join">
                      <?php if ($user[0]["id_instansi"] == 2 || $user[0]["id_instansi"] == 3 || $user[0]["id_instansi"] == 6 ): ?>
                        <select class="select2 form-control block kecamatan" id="idJoin" name="id_join" style="width: 100%" required>
                           <option value="">Pilih Domisili</option>
                           <?php if (!empty($nama_join)): ?>
                              <?php foreach ($nama_join as $nj): ?>
                                <option value="<?= $nj['id'] ?>" <?= ($user[0]['id_join'] == $nj['id'])? "selected": '' ?> ><?= $nj['nama']?></option>
                              <?php endforeach ?>
                            <?php endif ?>
                        </select>
                      <?php endif ?>
                    </div>
                <?php else :  ?>
                  <input type="hidden" name="instansi" value="<?= $this->session->userdata('instansi') ?>">
                  <input type="hidden" name="id_join" value="<?= $this->session->userdata('id_join') ?>">
                <?php endif  ?>
                  </div>

        </fieldset>
        <div class="row">
          <div class="col-md-3 offset-md-8">
            <a href="<?= base_url($controller.'UserManagement?delete=') . $user[0]['id_user'] ?>" onclick="return confirm('Yakin Hapus User ini?')" class="btn btn-danger btn-md">Hapus User ini</a>
            <button type="submit" class="btn btn-primary btn-md" id="simpanpengajuan" name="btnedit">
              <i class="ft-check-square"></i> Ubah
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

<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script>
<?php if ($this->session->userdata('level') == 1): ?>
  $("#instansi").on('change', function() {
    var instansi = $(this).val();
    var level = $("#level").val();
    var url     = "";
    var nama    = "";
    var optionV = "";
    var change  = false;
    if(instansi == 2){
      // Rumah Sakit
      change  = true;
      url     = "<?= base_url($controller);?>getRs";
      namaI   = "rs";
      optionV = '<option value="" selected>Pilih Rumah Sakit</option>';
    } else if(instansi == 3){
      // Pusekesmas
      change  = true;
      url     = "<?= base_url($controller);?>getPuskesmas";
      namaI   = "puskesmas";
      optionV = '<option value="" selected>Pilih Puskesmas</option>';
    }else if(instansi == 6){
      // Pusekesmas
      change  = true;
      url     = "<?= base_url($controller);?>getLurah";
      namaI   = "kelurahan";
      optionV = '<option value="" selected>Pilih Kelurahan</option>';
    } else {
      change  = false;
    }

    if(change && level !=1){
      $.ajax({
        url : url,
        method : "POST",
        data : {id: instansi},
        async : false,
        dataType : 'json',
        success: function(data){
          $('#id_join').html();
          var html = '<select class="select2 form-control block kecamatan" id="'+namaI+'" name="id_join" style="width:100%" required>';
          html += optionV;
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value = "'+data[i].id+'">'+data[i].nama+'</option>';
          }
          html += '</select>';
          $('#id_join').html(html);
        }
      });
    } else {
      $('#id_join').html('');
    }
  });

  $("#level").on('change', function() {
    var level = $("#level").val();
    if(level == 1){
      // $('#id_join').html('');
      // $('#idJoin').required = false;
      document.getElementById("idJoin").required = false;
    } else {
      document.getElementById("idJoin").required = true;
    }
  });
<?php endif ?>
</script>