<div class="container">
  <h2 class="text-center mt-4">Pendaftaran Online SJP Kota Depok</h2>
  <h4 class="text-center">Silahkan Isi Data Pasien</h4>
  <div class="alert alert-info mt-5" role="alert" >
    <p style="color: white;">Contoh No. NIK 0101xxxxxxxxxxxxx31</p> 
  </div>
  <form class="mt-5 mb-5">

    <div class="form-group row">
                 <label class="col-lg-3 label-control" for="namalengkap">NIK* (Nomor Induk Kependudukan)</label>
                  <div class="col-lg-9" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nomor Induk Kependudukan"
                    name="nama_pemohon" id="namapemohon" required> 
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
          <select name="jenisrawat" id="jenisrawat" class="form-control" style="width: 100%" required>
            <option value="">Pilih Jenis Rawat</option>
            <option value="Rawat Inap">Rawat Inap</option>
            <option value="Rawat Jalan">Rawat Jalan</option>
          </select>
        </div>
        <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
          <select name="kelasrawat" id="kelasrawat" class="form-control" style="width: 100%">
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
              <select class="js-example-basic-multiple kd_topik multiple" id="topik" name="topik"  style="width: 30%">
               <option>Pilih Topik</option>
               <?php if (!empty($topik)) {
                foreach ($topik as $key) {?>
                <option value="<?= $key['topik'] ?>"><?= $key['topik'] ?></option>
                <?php }
              } ?>
            </select>
            <select class="js-example-basic-multiple kd_diagnosa multiple sjpform" id="diagnosa"  name="diagnosa" style="width: 60%">
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

    <button type="button" class="btn btn-primary" name="button">Submit</button>
  </form>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">

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
          $('#jenisjaminan option[value='+data.id_jenissjp+']').attr('selected','selected');
          $('#namalengkap').val(data.nama_pasien);
          $('#jeniskelamin option[value='+data.jenis_kelamin+']').attr('selected','selected');
          $('#tempatlahir').val(data.tempat_lahir);
          $('#tanggallahir').val(data.tanggal_lahir);
          $('#pekerjaan').val(data.pekerjaan);
          $('#golongandarah option[value='+data.golongan_darah+']').attr('selected','selected');
          $('#alamat').val(data.alamat);
          $('#rw').val(data.rw);
          $("#rt").val(data.rw).trigger('change');
          $("#kecamatan").val(data.kd_kecamatan).trigger('change');
          $("#kelurahan").val(data.kd_kelurahan).trigger('change');
          $('#telepon').val(data.telepon);
          $('#whatsapp').val(data.whatsapp);
          $('#email').val(data.email);
          $("#rumahsakit").val(data.id_rumah_sakit).trigger('change');
          $('#jenisrawat option[value='+data.jenis_rawat+']').attr('selected','selected');
          $("#kelasrawat").val(data.id_kelas).trigger('change');
          $('#mulairawat').val(data.mulai_rawat);
          $('#akhirrawat').val(data.selesai_rawat);
          $('#topik option[value='+data.topik+']').attr('selected','selected');
          $('#diagnosa option[value='+data.namadiag+']').attr('selected','selected');
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

  })
</script>
