<div class="container">
  <h2 class="text-center mt-4">Pendaftaran Online SJP Kota Depok</h2>
  <h4 class="text-center">Silahkan Isi Data Pasien</h4>
<hr>
   <div class="card-body">
            <form action="<?php echo base_url('masyarakat/input_pasien'); ?>" method="POST" enctype="multipart/form-data" class="wpcf7-form sjpform" id="sjpform">
               <!-- ////////////////////INPUTAN DATA PEMOHON /////////////////////////-->
               <!-- ////////////////////INPUTAN DATA PEMOHON /////////////////////////--> 
                <div class="form-group row">
                 <label class="col-lg-3 label-control" for="namalengkap">NIK Pasien</label>
                  <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Isikan Nomor Induk Kependudukan"
                    name="nik" id="nik" required> 
                  </div>
                  <input type="hidden" id="idsjp"> <!-- add id sjp jika nik ditemukan -->
                <input type="hidden" id="statussjp"> <!-- jangan dihapus untuk membedakan sjp lama dan baru dari hasil cek nik -->
                </div>
              <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Informasi Pemohon</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Nama Lengkap*</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nama Lengkap"
                    name="namalengkappemohon" id="namalengkappemohon" required> 
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="jeniskelaminpemohon" id="jeniskelaminpemohon" class="form-control" required>
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Perempuan">Perempuan</option>
                      <option value="Laki-Laki">Laki - Laki</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="notelp">Informasi Kontak*</label>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Telp"
                    name="teleponpemohon" id="teleponpemohon" required>
                  </div>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Whatsapp"
                    name="whatsapppemohon" id="whatsapppemohon">
                  </div>
                  <div class="col-lg-4" style="padding: 0px 15px 5px 15px;">
                    <input type="email" class="form-control" placeholder="Email"
                    name="emailpemohon" id="emailpemohon">
                  </div>
                </div>
                  <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Status Hubungan Dengan Pasien*</label>
                 
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="statushubungan" id="statushubungan" class="form-control" required>
                      <option value="">Pilih Status</option>
                      <option value="Anak">Anak</option>
                      <option value="Istri">Istri</option>
                      <option value="Suami">Suami</option>
                      <option value="Keluarga Lain">Keluarga Lain</option>
                    </select>
                  </div>
                </div>
     
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="alamat_pemohon">Alamat/Rt/Rw*</label>
                  <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Alamat"
                    name="alamatpemohon" id="alamatpemohon" required>
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rt"
                    name="rtpemohon" id="rtpemohon" required>
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rw"
                    name="rwpemohon" id="rwpemohon" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="tempat">Kec/Kel</label>

                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block kecamatan" id="kecamatanpemohon" name="kecamatanpemohon" style="width: 100%">
                     <option>Pilih Kecamatan</option>
                     <?php if (!empty($kecamatan)) {
                      foreach ($kecamatan as $key) {?>
                      <option value="<?= $key['kecamatan'] ?>"><?= $key['kecamatan'] ?></option>
                      <?php }
                    } ?>
                  </select>
                </div>
                <div class="col-lg-3" style="padding: 0px 15px 5px 15px;"> 
                  <select class="select2 form-control block kelurahan" id="kelurahanpemohon" name="kelurahanpemohon" style="width: 100%">
                   <option>Pilih Kelurahan</option>

                 </select>
               </div>
             </div>
        </fieldset>
        <!-- ////////////////////INPUTAN DATA PEMOHON /////////////////////////-->
        <!-- ////////////////////INPUTAN DATA PEMOHON /////////////////////////-->

        <!-- ////////////////////INPUTAN DATA PASIEN /////////////////////////-->
        <!-- ////////////////////INPUTAN DATA PASIEN /////////////////////////-->
        <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Informasi Pasien</strong></h4>
        <fieldset class="mt-2">
          <div class="form-group row">
            <label class="col-lg-3 label-control" for="notelp">Jenis Jaminan*</label>
            <div class="col-lg-6">                        
              <select name="jenisjaminan" id="jenisjaminan" class="form-control" required>
                <option value="">Pilih Jenis Jaminan</option>
                <?php if (!empty($jenisjaminan)) {
                  foreach ($jenisjaminan as $key) {?>
                  <option value="<?= $key['id_jenissjp'] ?>"><?= $key['nama_jenis'] ?></option>
                  <?php }
                } ?>
              </select>
            </div>
          </div>
    <!--       <div class="form-group row">
            <label class="col-lg-3 label-control" for="nik">NIK*</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" placeholder="NIK"
              name="nik" id="nikpasien" required>
            </div>
          </div> -->
          <div class="form-group row">
            <label class="col-lg-3 label-control" for="namalengkap">Nama Lengkap*</label>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control kontrakform" placeholder="Nama Lengkap"
              name="namalengkap" id="namalengkap" required> 
            </div>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <select name="jeniskelamin" id="jeniskelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Laki-Laki">Laki - Laki</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 label-control" for="tempat">Tempat/ Tanggal Lahir*</label>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control" placeholder="Tempat Lahir"
              name="tempatlahir" id="tempatlahir" required>
            </div>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <input type="date" class="form-control" placeholder="Tanggal Lahir"
              name="tanggallahir" id="tanggallahir" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 label-control" for="tempat">Pekerjaan/ Gol Darah</label>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control" placeholder="Pekerjaan"
              name="pekerjaan" id="pekerjaan">
            </div>
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <select class="select2 form-control block" id="golongandarah" name="golongandarah" style="width: 100%">
                <option value="">Pilih Golongan Darah</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 label-control" for="alamat_pasien">Alamat/Rt/Rw*</label>
            <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control" placeholder="Alamat"
              name="alamat" id="alamat" required>
            </div>
            <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control" placeholder="Rt"
              name="rt" id="rt" required>
            </div>
            <div class="col-lg-1  " style="padding: 0px 15px 5px 15px;">
              <input type="text" class="form-control" placeholder="Rw"
              name="rw" id="rw" required>
            </div>
          </div>
       <div class="form-group row">
            <label class="col-lg-3 label-control" for="tempat">Kec/Kel</label>
            
            <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
              <select class="select2 form-control block kecamatan" id="kecamatan" name="kecamatan" style="width: 100%">
               <option>Pilih Kecamatan</option>
               <?php if (!empty($kecamatan)) {
                foreach ($kecamatan as $key) {?>
                <option value="<?= $key['kecamatan'] ?>"><?= $key['kecamatan'] ?></option>
                <?php }
              } ?>
            </select>
          </div>
          <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
            <select class="select2 form-control block kelurahan" id="kelurahan" name="kelurahan" style="width: 100%">
              <option>Pilih Kelurahan</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-3 label-control" for="notelp">Informasi Kontak</label>
          <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
            <input type="text" class="form-control" placeholder="No Telp"
            name="telepon" id="telepon">
          </div>
          <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
            <input type="text" class="form-control" placeholder="No Whatsapp"
            name="whatsapp" id="whatsapp">
          </div>
          <div class="col-lg-5" style="padding: 0px 15px 5px 15px;">
            <input type="email" class="form-control" placeholder="Email"
            name="email" id="email">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-3 label-control" for="notelp">Informasi Sakit</label>
          <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">                        
            <select name="rumahsakit" id="rumahsakit" class="select2 form-control" required>
             <option value="">Pilih Rumah Sakit</option>
             <?php if (!empty($rumahsakit)) {
              foreach ($rumahsakit as $key) {?>
              <option value="<?= $key['id_rumah_sakit'] ?>"><?= $key['nama_rumah_sakit'] ?></option>
              <?php }
            } ?> 
          </select>
        </div>
        <div class="col-lg-3" style="padding: 0px 15px 5px 15px;"> 
          <select name="jenis_rawat" id="jenisrawat" class="form-control" style="width: 100%" required>
            <option value="">Pilih Jenis Rawat</option>
            <option value="Rawat Inap">Rawat Inap</option>
            <option value="Rawat Jalan">Rawat Jalan</option>
          </select>
        </div>
        <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
          <select name="kelas_rawat" id="kelas_rawat" class="form-control" style="width: 100%">
            <option value="">Pilih Kelas Rawat</option>
            <?php if (!empty($kelas_rawat)) {
              foreach ($kelas_rawat as $key) {?>
              <option value="<?= $key['id_kelas'] ?>"><?= $key['nama_kelas'] ?></option>
              <?php }
            } ?> 
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 label-control" for="notelp">Mulai/Akhir Rawat</label>
        <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">                        
          <input type="date" class="form-control" placeholder="Tanggal Mulai Rawat" name="mulairawat" id="mulairawat">
        </div>
        <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">                        
          <input type="date" class="form-control" placeholder="Tanggal Akhir Rawat" name="akhirrawat" name="akhirrawat">
        </div>

      </div>

      <div class="form-group row">
        <label class="col-lg-3 label-control" for="">Diagnosa</label>
        <div class="col-lg-9  mb-2 contact-repeater">
          <div data-repeater-list="repeater-group">
            <div class="input-group mb-1 diagnosapenyakit" data-repeater-item="">
              <select class="js-example-basic-multiple kd_topik multiple" id="kd_topik" name="kd_topik"  style="width: 30%">
               <option>Pilih Topik</option>
               <?php if (!empty($topik)) {
                foreach ($topik as $key) {?>
                <option value="<?= $key['topik'] ?>"><?= $key['topik'] ?></option>
                <?php }
              } ?>
            </select>
            <select class="js-example-basic-multiple kd_diagnosa multiple sjpform" id="kd_diagnosa"  name="diagnosa" style="width: 60%">
              <option>Pilih Diagnosa</option>
              <?php if (!empty($diagnosa)) {
                foreach ($diagnosa as $key) {?>
                <option value="<?= $key['namadiag'] ?>"><?= $key['namadiag'] ?></option>
                <?php }
              } ?>
            </select>

            


            <span class="input-group-append" id="button-addon2">
              <button class="btn btn-danger" type="submit" data-repeater-delete=""><i class="ft-x"></i></button>
            </span>
            <br>
            <div class="row" style="width: 100%;">
              <!-- <div class="col-lg-12">
                <div class="skin skin-polaris"><input type="checkbox" class="checkbox">Lainnya</div>
              </div> -->
              <div class="col-lg-12 diagnosalainnya mt-1">
                <input type="text" class="form-control" placeholder="Masukkan Diagnosa Lainnya" name="diagnosalainnya">
              </div>
            </div>
          </div>

        </div>
        <a data-repeater-create="" class="btn btn-primary btn-sm add" style="color: white;">
          <i class="ft-plus"></i> Tambah
        </a>
      </div>
    </div> 
    <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Dokumen Persyaratan (berupa foto)</strong></h4>
    <?php if (!empty($dokumen)) {
      foreach ($dokumen as $key) {?>
      <div class="form-group row" id="modalwal">
        <label class="col-lg-3 label-control" for="modal"><?= $key['nama_persyaratan'] ?></label>
        <div class="col-lg-9"> 
          <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="nama_persyaratan[]" style="height: 40px;" >
          <input type="file" id="dokumen" class="form-control" name="dokumen[]" style="height: 40px;" >
        </div>
      </div>


      <?php }
    } ?>
   <div class="form-group row">
                <label class="col-lg-3 label-control" for="namalengkap">Feedback</label>
            <div class="col-lg-9">
                <textarea class="ckeditor" id="ckedtor" name="feedback"></textarea>
            </div>
  </div>
 
    <button type="submit" class="btn btn-primary btn-md" id="simpanpengajuan" style="float: right;">
      <i class="ft-check-square"></i> Submit
    </button>
  </fieldset>
  <!-- ////////////////////INPUTAN DATA PASIEN /////////////////////////-->
  <!-- ////////////////////INPUTAN DATA PASIEN /////////////////////////-->



</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
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
  $(".select2").select2();
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
      url : "<?= base_url();?>/masyarakat/getKelurahan",
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
      url : "<?= base_url();?>/masyarakat/getDiagnosa",
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
        url : "<?= base_url();?>/masyarakat/getDiagnosa",
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
        url : "<?= base_url();?>/masyarakat/getKelurahan",
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
   $('#nik').blur(function(event) {
      var nik = $(this).val();
      $.ajax({
        url: '../ceknik',
        type: 'POST',
        dataType: 'json',
        data: {nik: nik},
        success : function(datasjp) {
          var data = datasjp[0];
          if (datasjp.length > 0) {
            $('#statussjp').val('Lama'); //jika nik ditemukan di db maka sjp lama
            $('#idsjp').val(data.Id);

            // alert(JSON.parse(datasjp).length)
          $('.datasjp');

          // data pasien
          $('#jenisjaminan').val(data.nama_jenis);
          $('#namalengkap').val(data.nama_pasien);
          $('#jeniskelamin option[value='+data.jenis_kelamin+']').attr('selected','selected');
          $('#tempatlahir').val(data.tempat_lahir);
          $('#tanggallahir').val(data.tanggal_lahir);
          $('#pekerjaan').val(data.pekerjaan);
          $('#golongandarah').val(data.golongan_darah);
          $('#alamat').val(data.alamat);
          $('#rw').val(data.rw);
          $("#rt").val(data.rw).trigger('change');
          $("#kecamatan").val(data.kd_kecamatan).trigger('change');
          $("#kelurahan").val(data.kd_kelurahan).trigger('change');
          $('#telepon').val(data.telepon);
          $('#whatsapp').val(data.whatsapp);
          $('#email').val(data.email);
          $("#rumahsakit").val(data.nama_rumah_sakit).trigger('change');
          $('#mulairawat').val(data.mulai_rawat);
           $('#akhirrawat').val(data.selesai_rawat);
          if (data.Foto != null) {
            $('#showq').attr('src', '<?= base_url();?>'+data.Foto);
          }
          }else{
            $('#statussjp').val('Baru'); //jika nik tidak ditemukan di db maka sjp Baru
          }
          // $('#').val(data.);

        }
      })
      // .done(function() {
      //  console.log("success");
      // })
      // .fail(function() {
      //  console.log("error");
      // })
      // .always(function() {
      //  console.log("complete");
      // });
      
   });
  </script>

  <script>
   $(document).ready(function() {
    //$('.js-example-basic-multiple').select2({placeholder: "Pilih Diagnosa"});
  });
</script>