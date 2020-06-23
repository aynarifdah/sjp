<section id="number-tabs">
  <div class="row">
    <div class="col-12">

      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Entry User Baru</h4>
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
              <!-- Step 1 -->
              <h4 class="text-left"><i class="ft-user"></i> <strong>Informasi User</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="namalengkap">Nama*</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control kontrakform" placeholder="Nama"
                    name="nama" id="nama" required> 
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="notelp">Username*</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Username"
                    name="username" id="username" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 label-control" for="modal">Password* </label>
                  <div class="col-lg-9">
                    <input type="password" class="form-control" placeholder="Password"
                    name="password" id="password" required>
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
                            <option value="<?= $l['id_level'] ?>" ><?= $l['nama_level']?></option>
                          <?php endforeach ?>
                        <?php endif ?>
                    </select>
                  </div>
                </div>
                  <div class="form-group row">
                <?php if ($this->session->userdata('level') == 1 && ($this->session->userdata('instansi') == 1 || $this->session->userdata('instansi') == 2 || $this->session->userdata('instansi') == 3 )): ?>

                  <?php if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1): ?>
                    <label class="col-lg-2 label-control" for="level">Instansi*</label>
                    <div class="col-lg-3">
                      <select class="select2 form-control block kecamatan" id="instansi" name="instansi" style="width: 100%" required>
                         <option value="">Pilih Instansi</option>
                         <?php if (!empty($instansi)): ?>
                            <?php foreach ($instansi as $i): ?>
                              <option value="<?= $i['id_instansi'] ?>" ><?= $i['nama_instansi']?></option>
                            <?php endforeach ?>
                          <?php endif ?>
                      </select>
                    </div>
                  <?php else:  ?>
                    <label class="col-lg-2 label-control" for="id_join">Domisili*</label>
                    <input type="hidden" name="instansi" value="<?= $this->session->userdata('instansi') ?>">
                  <?php endif ?>

                    <div class="col-lg-3" id="id_join">
                      <?php if ($user[0]["id_instansi"] == 2 || $user[0]["id_instansi"] == 3): ?>
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
                  <!-- <input type="hidden" name="level" value="<?= $this->session->userdata('level') ?>"> -->
                  <input type="hidden" name="instansi" value="<?= $this->session->userdata('instansi') ?>">
                  <input type="hidden" name="id_join" value="<?= $this->session->userdata('id_join') ?>">
                <?php endif  ?>
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

<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script type="text/javascript">

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
    } else {
      change  = false;
    }

    if(change && level != 1){
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
      // $('#idJoin').required = false;
      document.getElementById("idJoin").required = false;
    } else {
      // $('#idJoin').required = true;
      document.getElementById("idJoin").required = true;
    }
  });
<?php endif ?>

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
  $(document).ready(function(){
      //getkelurahan();
      diagnosapenyakit();
      diagnosa2();
     // $('.diagnosalainnya').hide();
    });
  $('#kd_kecamatanpemohon').change(function(){
    getkelurahan();
  })
  function getkelurahan() {
    var data = $('#kd_kecamatanpemohon').val();
    $.ajax({
      url : "<?= base_url();?>/Home/getKelurahan",
      method : "POST",
      data : {id: data},
      async : false,
      dataType : 'json',
      success: function(data){
        var html = '<option>Pilih Kelurahan</option>';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value = "'+data[i].kelurahan+'">'+data[i].kelurahan+'</option>';
        }
        $('#kd_kelurahanpemohon').html(html);

      }
    });
  }
  // $('.checkbox').on('ifChecked', function (event) {
  //   $('.diagnosalainnya').show();
  // });

  // $('.checkbox').on('ifUnchecked', function (event) {
  //   $('.diagnosalainnya').hide();
  // });
  $('.add').click(function (argument) {
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
   }).eq(index).on('select2:select', function (evt) {
    var data = $(this).val();
    $.ajax({
      url : "<?= base_url();?>/Home/getDiagnosa",
      method : "POST",
      data : {id: data},
      async : false,
      dataType : 'json',
      success: function(data){
        var html = '<option>Pilih Diagnosa</option>';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value = "'+data[i].namadiag+'">'+data[i].namadiag+'</option>';
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
        url : "<?= base_url();?>/Home/getDiagnosa",
        method : "POST",
        data : {id: data},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option>Pilih Diagnosa</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value = "'+data[i].namadiag+'">'+data[i].namadiag+'</option>';
          }
          $('#kd_diagnosa').html(html);

        }
      });
    }
    $('#kd_kecamatanpasien').change(function(){
      getkelurahanpasien();
    })
    function getkelurahanpasien() {
      var data = $('#kd_kecamatanpasien').val();
      $.ajax({
        url : "<?= base_url();?>/Home/getKelurahan",
        method : "POST",
        data : {id: data},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option>Pilih Kelurahan</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value = "'+data[i].kelurahan+'">'+data[i].kelurahan+'</option>';
          }
          $('#kd_kelurahanpasien').html(html);

        }
      });
    }
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