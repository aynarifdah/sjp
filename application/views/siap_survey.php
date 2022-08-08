   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Survey</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <!-- <form class="form" > -->
            <div class="table-responsive">
              <form action="<?php echo base_url('Home/proses_survey/'.$id_sjp.'/'.$id_pengajuan);?>" method="POST">
                <?php foreach($pengajuan as $key => $value) { $id = $value->id_sjp;$id_pengajuan = $value->id_pengajuan; ?>
                <table class="table table-bordered table-striped col-12">
                  <tbody>
                    <tr>
                      <th scope="row" style="width: 50%;">
                        Nama Pasien
                      </th>
                      <td style="width: 50%;"><?php echo $value->nama_pasien; ?></td>
                    </tr>
                    <tr>
                      <th scope="row" style="width: 50%;">
                        Alamat Lengkap
                      </th>
                      <td style="width: 50%;"><?php echo $value->alamatpasien; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Tanggal Survey
                        </th>
                        <td><input type="date" class="form-control tanggal_survey" placeholder="Tanggal survey" name="tanggal_survey" required></td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Nama Surveyor
                        </th>
                        <td><input type="text" class="form-control surveyor" placeholder="Nama Surveyor" name="surveyor" required></td>
                      </tr>
                       <!--   <tr>
                          <th scope="row">
                            Hasil Rekomendasi
                          </th>
                          <td><input type="text" class="form-control" placeholder="Hasil Rekomendasi" name="hasilrekomendasi" readonly></td>
                        </tr> -->
                        <tr>
                          <th scope="row">Status Pengajuan</th>
                          <td>
                            <div class="row">
                              <div class="col-lg-7">
                                <select name="statussurvey" class="form-control statussurvey" required>
                                  <option value="">Pilih Status Pengajuan</option>
                                  <option value="4">Ajukan Kedinas</option>
                                  <option value="7">Tolak Pengajuan</option>
                                </select>
                              </div>
                              <!-- <div class="col-lg-5"> -->
                                <!-- <h5><strong>Hasil Survey : <span class="hasil"></span> -->
                                  <!-- <h5><strong>Hasil Survey : <span class="kethasilkemiskinan"></span>
                                	<span>/</span> -->
                                	<!-- <span class="persyaratan"></span> Kriteria -->
                                <!-- </strong></h5> -->
                                <!-- <h5><strong><span class="kethasil"></span>&nbsp;<i class="iconhasil"></i></strong></h5> -->
                              </div>
                            </div>
                          </td>
                        </tr>
                        <!-- <tr>
                          <th scope="row">Catatan Survey</th>
                          <td><textarea class="form-control catatan" name="catatan"></textarea></td>
                        </tr> -->

                      </tbody>
                    </table>
                </div>
                    <?php } ?>
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Variabel</th>
                            <th>Isi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($survey)){ $no =1; foreach ($survey as $key ){
                           ?>
                           <tr>
                            <td><?php echo $no++;?></td>
                            <td><input type="hidden" class="ceklist_survey" value="<?php echo $key->id_ceklist_survey?>" name="ceklist_survey[]"><?php echo $key->ceklist_survey?></td>
                            <td><fieldset class="form-group position-relative"> 
                              <select class="form-control opsi" name="opsi[]" data-index-ceklist="<?= $key->index_survey; ?>" data-bobot-ceklist="<?= $key->bobot_survey; ?>" data-indeks-akumulatif="0">
                                <option value="">Pilih Keterangan</option>
                                <?php if(!empty($opsi)){
                                  foreach ($opsi as $op ) {
                                    if ($op->id_ceklist_survey == $key->id_ceklist_survey) {
                                      ?> <option value="<?php echo $op->id_opsi_ceklist;?> "><?php echo $op->keterangan;?></option>

                                      <?php  } } }?>
                                    </select>
                                  </fieldset>
                                  <input type="hidden" name="bobot[]" value="0" class="bobot">
                                </td>
                                <?php } ?>
                              </tr>
                              <?php } ?>   
                              <tr>
                                <td colspan="2" class="text-center">Keterangan</td>
                                <td colspan="2" class="text-center"><span class="kethasilkemiskinan">Tidak Ditemukan</span> </td>
                                <input type="hidden" name="ket_miskin" class="kethasilkemiskinaninput">
                              </tr>
                              <tr>
                                <td colspan="2" class="text-center">Catatan Survey</td>
                                <td colspan="2" class="text-center"><textarea class="form-control catatan" name="catatan"></textarea></td>
                              </tr>
                            </tbody>
                          </table>
                        <!--   <table class="table table-bordered table-striped">
                            
                        </table> -->
                        <button type="submit" class="btn mr-1 mb-1 btn-primary btn-sm surveybtn confirm-survey"  style="float: right;">Submit</button>
                        <!-- <td><a><button type="button" class="btn mr-1 mb-1 btn-primary btn-sm surveybtn confirm-survey"  style="float: right;">Submit</button></td></a> -->
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



      <style>
      .active {
        border: 1px solid red !important;
      }
      .activegreen {
        border: 1px solid green !important;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>app-assets/vendors/css/extensions/sweetalert.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var bobot = [];
        $('.bobot').each(function(i, e) {
         var bobotval = $(this).val();
         bobot.push(+bobotval);
       });
        var countbobot =  bobot.reduce(myFunc);
        $('.hasil').html(countbobot);
        $('.persyaratan').html(bobot.length);

      });

      var indeksakumulatif;
  let indexsurvey = 0;
  let totalakumulatif = 0;
  // $('.hasil').html(totalakumulatif);

  function myFunc(total, num) {

    return total + num;
  }
  var countopsi = []; //menyiapkan tempat penyimpanan hasil opsi yg dipilih

  $('.opsi').each(function(index) {
    $('.opsi').eq(index).change(function() {

      var opsi = $(this).val();

      //console.log (opsi);
      $.ajax({
        url: "<?php echo base_url(); ?>Home/getbobot",
        method: "POST",
        dataType: "JSON",
        data: {
          idopsi: opsi
        },
        async: false,
        success: function(result) {

          console.log("getbobot", result)



          indexsurvey = $('.opsi').eq(index).data('index-ceklist');
          bobotsurvey = $('.opsi').eq(index).data('bobot-ceklist');
          indeksakumulatif = $('.opsi').eq(index);
          jumlahakumulatif = bobotsurvey * indexsurvey * result;
          jumlahakumulatif = jumlahakumulatif.toFixed(2);
          // indeksakumulatif.attr('indeks-akumulatif', jumlahakumulatif);

          $('.bobot').eq(index).val(jumlahakumulatif);
          // $('.indeks').eq(index).text(jumlahakumulatif);
          $('.bobot').trigger('change');

          // alert($('.opsi').eq(index).data('indeks-akumulatif'));
          // alert(jumlahakumulatif);


          if (result == 0) {
            $('.opsi').eq(index).removeClass('activegreen');
            // if ($('.opsi').eq(index).hasClass('active')) {
            //   $('.opsi').eq(index).removeClass('active');
            // } else {
            //   $('.opsi').eq(index).addClass('active');
            // }

          } else {
            $('.opsi').eq(index).removeClass('active');
            // if ($('.opsi').eq(index).hasClass('activegreen')) {
            //   $('.opsi').eq(index).removeClass('activegreen');
            // } else {
            //   $('.opsi').eq(index).addClass('activegreen');
            // }
          }
          countopsi.push(result);
          getKategoriPenerima();
        }

      });
    })
  })

  $('.bobot').change(function() {

    totalakumulatif = 0;


    $('.bobot').each(function() {
      indeksakumulatif = $(this).val();


      totalakumulatif += Number(indeksakumulatif);


    });

    $('.hasil').html(totalakumulatif.toFixed(2));
    $('.totalakumulatif').html(totalakumulatif.toFixed(2));
  });

  function getKategoriPenerima() {
    totalakumulatif = totalakumulatif.toFixed(2);
    alert(totalakumulatif);
    $.ajax({
      url: "<?php echo base_url(); ?>Home/getKategoriPenerima",
      method: "POST",
      dataType: "JSON",
      data: {
        totalakumulatif: totalakumulatif
      },
      async: false,
      success: function(result) {
        $('.kethasilkemiskinan').html(result);
        $('.kethasilkemiskinaninput').val(result);
        $('#kategori_penerima_survey').val(result);
        if (result == 'Sangat Miskin') {
          $('.catatan').html('Hasil survey Kriteria Sangat Miskin, Pasien dinyatakan LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
        }else if (result == 'Miskin') {
          $('.catatan').html('Hasil survey Kriteria Miskin, Pasien dinyatakan LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
        }else if (result == 'Rentan Miskin') {
          $('.catatan').html('Hasil survey Kriteria Rentan Miskin, Pasien dinyatakan LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
        }else if (result == 'Tidak Miskin'){
          $('.catatan').html('Hasil survey Kriteria Sangat Miskin, Pasien dinyatakan TIDAK LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
        }
      }
    });

  }
</script>

</body>
</html>