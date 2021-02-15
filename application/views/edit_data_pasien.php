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
            <form action="<?= base_url($controller . 'detail_pengajuan/' . $detail[0]['id_sjp'] . '/' . $id_pengajuan); ?>" method="POST" class="wpcf7-form sjpform" id="sjpform">
              <input type="hidden" name="id_sjp" value="<?= $detail[0]['id_sjp'] ?>">
              <input type="hidden" name="id_pp" value="<?= $this->uri->segment(4) ?>">
              <!-- Step 1 -->
              <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Informasi Pemohon</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Nama Lengkap*</label>
                  <div class="col-lg-5" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nama" name="nama_pemohon" id="nama_pemohon" required value="<?= $detail[0]['nama_pemohon'] ?>">
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="jenis_kelamin_pemohon" id="jeniskelaminkpemohon" class="form-control" required>
                      <option value="">Jenis Kelamin</option>
                      <option value="Perempuan" <?= ($detail[0]['jkpemohon'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                      <option value="Laki-Laki" <?= ($detail[0]['jkpemohon'] == 'Laki-laki') ? 'selected' : '' ?>>Laki - Laki</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="notelp">Informasi Kontak*</label>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Telp" name="teleponpemohon" id="telepon_pemohon" required value="<?= $detail[0]['telpemohon'] ?>">
                  </div>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Whatsapp" name="whatsappemohon" id="Whatsapp_pemohon" required value="<?= $detail[0]['wapemohon'] ?>">
                  </div>
                  <div class="col-lg-4">
                    <input type="email" class="form-control" placeholder="Email" name="emailpemohon" id="emailpemohon" required value="<?= $detail[0]['emailpemohon'] ?>">
                  </div>
                </div>
                <div class="form-group row" id="modalwal">
                  <label class="col-lg-3 label-control" for="modal">Status Hubungan Dengan Pasien* </label>
                  <div class="col-lg-3">

                    <select name="status_hubungan" id="status_hubungan" class="form-control" style="width: 100%" required>
                      <option value="">Pilih Status</option>

                      <option value="Anak" <?= $detail[0]['status_hubungan'] == "Anak" ? 'selected' : '' ?>>Anak</option>
                      <option value="Istri" <?= $detail[0]['status_hubungan'] == "Istri" ? 'selected' : '' ?>>Istri</option>
                      <option value="Suami" <?= $detail[0]['status_hubungan'] == "Suami" ? 'selected' : '' ?>>Suami</option>
                      <option value="Keluarga Lain" <?= $detail[0]['status_hubungan'] == "Keluarga Lain" ? 'selected' : '' ?>>Keluarga Lain</option>
                    </select>

                    <!-- <input type="status" class="form-control" placeholder="Status Hubungan" name="status_hubungan" id="status_hubungan" required value="<?= $detail[0]['status_hubungan'] ?>"> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="alamat_pemohon">Alamat/Rt/Rw</label>
                  <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Alamat" name="alamatpemohon" id="alamatpemohon" required value="<?= $detail[0]['alamatpemohon'] ?>">
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rt" name="rtpemohon" id="rtpemohon" required value="<?= $detail[0]['rtpemohon'] ?>">
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rw" name="rwpemohon" id="rwpemohon" required value="<?= $detail[0]['rwpemohon'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="tempat">Kec/Kel</label>

                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block kecamatan" id="kd_kecamatanpemohon" name="kd_kecamatanpemohon" style="width: 100%">
                      <option>Pilih Kecamatan</option>
                      <?php if (!empty($kecamatan)) : $i = 0; ?>
                        <?php foreach ($kecamatan as $key) : ?>
                          <option value="<?= $key['kecamatan'] ?>" <?= ($key['kecamatan'] == $detail[0]["kecpemohon"]) ? 'selected' : '' ?>><?= $key['kecamatan'] ?></option>
                        <?php endforeach ?>
                      <?php endif ?>
                    </select>
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block kelurahan" id="kd_kelurahanpemohon" name="kd_kelurahanpemohon" style="width: 100%">
                      <option>Pilih Kelurahan</option>

                    </select>
                  </div>
                </div>

              </fieldset>
              <!-- Step 2 -->
              <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Informasi Pasien</strong></h4>
              <fieldset class="mt-2">
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="nik">NIK</label>
                  <div class="col-lg-3">
                    <input type="text" class="form-control" placeholder="NIK" name="nikpasien" id="nikpasien" required value="<?= $detail[0]['nik'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Nama Lengkap</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nama Lengkap" name="nama_pasien" id="namapasien" required value="<?= $detail[0]['nama_pasien'] ?>">
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="jenis_kelamin_pasien" id="" name="jenis_kelamin_pasien" class="form-control" required>
                      <option value="">Jenis Kelamin</option>
                      <option value="Perempuan" <?= $detail[0]['jenis_kelamin'] == "Perempuan" ? 'selected' : '' ?>>Perempuan</option>
                      <option value="Laki-Laki" <?= $detail[0]['jenis_kelamin'] == "Laki-Laki" ? 'selected' : '' ?>>Laki - Laki</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="tempat">Tempat/ Tanggal Lahir</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir_pasien" id="tempatlahirpasien" required value="<?= $detail[0]['tempat_lahir'] ?>">
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <?php
                    $tanggal_lahir_pasien =  $detail[0]['tanggal_lahir'];
                    $new_date = date_format(date_create($tanggal_lahir_pasien), "d-m-Y");
                    ?>
                    <input type="text" class="form-control datepicker" placeholder="Tanggal Lahir" name="tanggal_lahir_pasien" id="tanggallahirpasien" required value="<?= $new_date ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="tempat">Pekerjaan/ Gol Darah</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaanpasien" id="pekerjaanpasien" required value="<?= $detail[0]['pekerjaan'] ?>">
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block" id="golongandarah" name="golongan_darah_pasien" style="width: 100%">
                      <option value="">Golongan Darah</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                      <option value="O">O</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="alamat_pasien">Alamat/Rt/Rw</label>
                  <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Alamat" name="alamatpasien" id="alamatpasien" required value="<?= $detail[0]['alamat'] ?>">
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rt" name="rtpasien" id="rtpasien" required value="<?= $detail[0]['rt'] ?>">
                  </div>
                  <div class="col-lg-1" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="Rw" name="rwpasien" id="rwpasien" required value="<?= $detail[0]['rw'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="tempat">Kec/Kel</label>

                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block kecamatan" id="kd_kecamatanpasien" name="kd_kecamatanpasien" style="width: 100%">
                      <option>Pilih Kecamatan</option>
                      <?php if (!empty($kecamatan)) {
                        foreach ($kecamatan as $key) { ?>
                          <option value="<?= $key['kecamatan'] ?>" <?= ($key['kecamatan'] == $detail[0]["kd_kecamatan"]) ? 'selected' : '' ?>><?= $key['kecamatan'] ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select class="select2 form-control block kelurahan" id="kd_kelurahanpasien" name="kd_kelurahanpasien" style="width: 100%">
                      <option>Pilih Kelurahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="notelp">Informasi Kontak</label>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Telp" name="teleponpasien" id="teleponpasien" required value="<?= $detail[0]['telepon'] ?>">
                  </div>
                  <div class="col-lg-2" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control" placeholder="No Whatsapp" name="whatsappasien" id="whatsapppasien" required value="<?= $detail[0]['whatsapp'] ?>">
                  </div>
                  <div class="col-lg-5" style="padding: 0px 15px 5px 15px;">
                    <input type="email" class="form-control" placeholder="Email" name="emailpasien" id="emailpasien" required value="<?= $detail[0]['email'] ?>">
                  </div>
                </div>

                <!-- INFORMASI SAKIT -->
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="notelp">Informasi Sakit</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="nama_rumah_sakit" id="nama_rumahsakit" class="select2 form-control" required style="width: 100%">
                      <option value="">Pilih Rumah Sakit</option>

                      <?php if (!empty($rumahsakit)) {
                        foreach ($rumahsakit as $key) { ?>
                          <option value="<?= $key['id_rumah_sakit'] ?>" <?= $key['nama_rumah_sakit'] == $detail[0]['nm_rs'] ? 'selected' : '' ?>><?= $key['nama_rumah_sakit'] ?></option>
                      <?php }
                      } ?>

                    </select>
                  </div>

                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="jenis_rawat" id="jenisrawat" class="form-control" style="width: 100%" required>
                      <option value="">Pilih Jenis Rawat</option>

                      <option value="Rawat Inap" <?= $detail[0]['jenis_rawat'] == "Rawat Inap" ? 'selected' : '' ?>>Rawat Inap</option>
                      <option value="Rawat Jalan" <?= $detail[0]['jenis_rawat'] == "Rawat Jalan" ? 'selected' : '' ?>>Rawat Jalan</option>
                    </select>
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <select name="kelas_rawat" id="kelas_rawat" class="form-control" style="width: 100%">
                      <option value="">Pilih Kelas Rawat</option>
                      <?php if (!empty($kelas_rawat)) {
                        foreach ($kelas_rawat as $key) { ?>
                          <option value="<?= $key['id_kelas'] ?>" <?= $key['id_kelas'] == $detail[0]['kelas_rawat'] ? 'selected' : '' ?>><?= $key['nama_kelas']; ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>
                </div>
                <!-- INFORMASI SAKIT -->

                <!-- MULAI/AKHIR RAWAT -->
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="notelp">Mulai/Akhir Rawat</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <?php
                    $tgl_mulai_rawat =  $detail[0]['mulai_rawat'];
                    $new_mulai_rawat = date_format(date_create($tgl_mulai_rawat), "d-m-Y");
                    ?>
                    <input type="text" class="form-control datepicker" placeholder="Tanggal Mulai Rawat" name="mulairawat" id="mulairawat" required value="<?= $new_mulai_rawat ?>">
                  </div>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <?php
                    $tgl_selesai_rawat =  $detail[0]['selesai_rawat'];
                    $new_selesai_rawat = date_format(date_create($tgl_selesai_rawat), "d-m-Y");
                    ?>
                    <input type="text" class="form-control datepicker" placeholder="Tanggal Akhir Rawat" name="akhirrawat" id="akhirrawat" required value="<?= $new_selesai_rawat ?>">
                  </div>

                </div>
                <!-- MULAI/AKHIR RAWAT -->

                <!-- DIAGNOSA -->
                <!-- <div class="form-group row">
                  <label class="col-lg-3 label-control" for="">Diagnosa</label>
                  <div class="col-lg-9  mb-2 contact-repeater">
                    <div data-repeater-list="repeater-group">
                      <div class="input-group mb-1 diagnosapenyakit" data-repeater-item="">
                        <select class="js-example-basic-multiple kd_topik multiple" id="kd_topik" name="kd_topik" style="width: 100%; padding: 10px; ">
                          <option>Pilih Topik</option>
                          <?php if (!empty($topik)) {
                            foreach ($topik as $key) { ?>
                              <option value="<?= $key['topik'] ?>" <?= $key['topik'] ? 'selected' : ''; ?>><?= $key['topik'] ?></option>
                          <?php }
                          } ?>
                        </select>
                        <select class="js-example-basic-multiple kd_diagnosa multiple sjpform" id="kd_diagnosa" name="diagnosa" style="width: 85%; ">
                          <option>Pilih Diagnosa</option>
                          <?php if (!empty($diagnosa)) {
                            foreach ($diagnosa as $key) { ?>
                              <option value="<?= $key['nama_diag'] ?>" <?= $key['nama_diag'] ? 'selected' : ''; ?>><?= $key['nama_diag'] ?></option>
                          <?php }
                          } ?>
                        </select>

                        <span class="input-group-append" id="button-addon2">
                          <button class="btn btn-danger" type="submit" data-repeater-delete=""><i class="ft-x"></i></button>
                        </span>
                        <br>
                        <div class="row" style="width: 100%;"> -->
                <!-- <div class="col-lg-12">
                <div class="skin skin-polaris"><input type="checkbox" class="checkbox">Lainnya</div>
              </div> -->
                <!-- <div class="col-lg-12 diagnosalainnya mt-1">
                            <input type="text" class="form-control" placeholder="Masukkan Diagnosa Lainnya" name="diagnosalainnya">
                          </div>
                        </div>
                      </div>

                    </div>
                    <a data-repeater-create="" class="btn btn-primary btn-sm add" style="color: white;">
                      <i class="ft-plus"></i> Tambah
                    </a>
                  </div>
                </div> -->
                <!-- DIAGNOSA -->

                <!-- DOKUMEN PERSYARATAN -->
                <h4 class="text-left ml-3"><i class="ft-user"></i> <strong>Dokumen Persyaratan (berupa foto)</strong></h4>
                <?php if (!empty($dokumen)) {
                  foreach ($dokumen as $key) { ?>
                    <div class="form-group row" id="modalwal">
                      <label class="col-lg-3 label-control" for="modal"><?= $key['nama_persyaratan'] ?></label>
                      <div class="col-lg-9">
                        <?php if ($key["id_persyaratan"] == 6 || $key["id_persyaratan"] == 7 && 8 || $key["id_persyaratan"] == 10  && 8 || $key["id_persyaratan"] == 3) { ?>
                          <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="nama_persyaratan[]" style="height: 40px;">
                          <input type="file" id="dokumen" class="form-control" name="dokumen[]" style="height: 40px;">
                        <?php } else { ?>
                          <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="nama_persyaratan[]" style="height: 40px;" required>
                          <input type="file" id="dokumen" class="form-control" name="dokumen[]" style="height: 40px;" required>
                        <?php }
                        ?>
                      </div>
                    </div>


                <?php }
                } ?>


                <!-- DOKUMEN PERSYARATAN -->

                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Feedback Dokumen</label>
                  <div class="col-lg-5">
                    <input type="text" class="form-control kontrakform" placeholder="Feedback" name="feedback" id="feedback" value="<?= $detail[0]['feedback'] ?>">
                  </div>
                </div>

                <!-- <div class="form-group row">
          <label class="col-lg-3 label-control" for="notelp">Informasi Sakit</label>
          <div class="col-lg-3">                        
            <select name="nama_rumah_sakit" id="nama_rumahsakit" class="form-control">
             <option value="">Rumah Sakit</option>
             <?php if (!empty($rumahsakit)) {
                foreach ($rumahsakit as $key) { ?>
              <option value="<?= $key['id_rumah_sakit'] ?>"><?= $key['nama_rumah_sakit'] ?></option>
              <?php }
              } ?> 
          </select>
        </div>
        <div class="col-lg-3">
          <select name="jenis_rawat" id="jenisrawat" class="form-control" style="width: 100%">
            <option value="">Jenis Rawat</option>
            <option value="Rawat Inap">Rawat Inap</option>
            <option value="Rawat Jalan">Rawat Jalan</option>
          </select>
        </div>
        <div class="col-lg-3">
          <select name="kelas_rawat" id="kelas_rawat" class="form-control" style="width: 100%">
            <option value="">Kelas Rawat</option>
            <?php if (!empty($kelas_rawat)) {
              foreach ($kelas_rawat as $key) { ?>
              <option value="<?= $key['id_kelas'] ?>"><?= $key['nama_kelas'] ?></option>
              <?php }
            } ?> 
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 label-control" for="notelp">Mulai/Akhir Rawat</label>
        <div class="col-lg-3">                        
          <input type="date" class="form-control" placeholder="Tanggal Mulai Rawat" name="mulairawat">
        </div>
        <div class="col-lg-3">                        
          <input type="date" class="form-control" placeholder="Tanggal Akhir Rawat" name="akhirrawat">
        </div>

      </div>

      <div class="form-group row">
        <label class="col-lg-3 label-control" for="">Diagnosa</label>
        <div class="col-lg-9  mb-2 contact-repeater">
          <div data-repeater-list="repeater-group">
            <div class="input-group mb-1 diagnosapenyakit" data-repeater-item="">
              <select class="js-example-basic-multiple kd_topik multiple" id="kd_topik" name="kd_topik"  style="width: 30%" >
               <option>Pilih Topik</option>
               <?php if (!empty($topik)) {
                  foreach ($topik as $key) { ?>
                <option value="<?= $key['topik'] ?>"><?= $key['topik'] ?></option>
                <?php }
                } ?>
            </select>
            <select class="js-example-basic-multiple kd_diagnosa multiple sjpform" id="kd_diagnosa"  name="diagnosa" style="width: 60%" >
              <option>Pilih Diagnosa</option>
              <?php if (!empty($diagnosa)) {
                foreach ($diagnosa as $key) { ?>
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
                <!--  <div class="col-lg-12 diagnosalainnya mt-1">
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
      foreach ($dokumen as $key) { ?>
      <div class="form-group row" id="modalwal">
        <label class="col-lg-3 label-control" for="modal"><?= $key['nama_persyaratan'] ?></label>
        <div class="col-lg-9"> 
          <input type="hidden" value="<?= $key['id_persyaratan'] ?>" class="form-control" name="nama_persyaratan[]" style="height: 40px;" >
          <input type="file" id="dokumen" class="form-control" name="dokumen[]" style="height: 40px;" >
        </div>
      </div>
      <?php }
    } ?>  -->
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

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
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
        for (i = 0; i < data.length; i++) {
          html += '<option value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
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
  $('#tanggallahirpasien').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      format: 'DD-MM-YYYY'
    }
  });
  $('.datepicker').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    // startDate: moment(date).add(1, 'days'),
    // endDate: moment(date).add(2, 'days'),
    locale: {
      format: 'DD-MM-YYYY'
    }
  });

  $("select#jenisrawat").change(function() {
    var selected = $(this).children("option:selected").val();
    if (selected == 'Rawat Inap') {
      getEndedInap();
    } else {
      getEndedJalan();
    }
  });



  function getEndedJalan() {
    // $('#akhirrawat').daterangepicker({
    //   singleDatePicker: true,
    //   showDropdowns: true,
    //   startDate: moment().add(14, 'day'),
    //   minDate: moment(),
    //   locale: {
    //     format: 'DD-MM-YYYY'
    //   }
    // });
  }

  // function getEndedInap() {
  //   $('#akhirrawat').daterangepicker({
  //     singleDatePicker: true,
  //     showDropdowns: true,
  //     startDate: moment().add(30, 'day'),
  //     minDate: moment(),
  //     locale: {
  //       format: 'DD-MM-YYYY'
  //     }
  //   });
  // }
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