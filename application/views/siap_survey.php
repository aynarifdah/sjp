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
                              <div class="col-lg-5">
                                <h5><strong>Hasil Survey : <span class="hasil"></span>
                                	<span>/</span>
                                	<span class="persyaratan"></span> Kriteria
                                </strong></h5>
                                <h5><strong><span class="kethasil"></span>&nbsp;<i class="iconhasil"></i></strong></h5>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Catatan Survey</th>
                          <td><textarea class="form-control catatan" name="catatan"></textarea></td>
                        </tr>

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
                              <select class="form-control opsi"  name="opsi[]">
                                <option value="0">Pilih Keterangan</option>
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
              method : "POST",
              dataType : "JSON",
              data : {idopsi : opsi},
              async : false,
              success: function(result){
                console.log("getbobot",result)
                $('.bobot').eq(index).val(result);
                if (result == 0) {
                 $('.opsi').eq(index).removeClass('activegreen');
                 if ($('.opsi').eq(index).hasClass('active')) {
                  $('.opsi').eq(index).removeClass('active');
                }else{
                  $('.opsi').eq(index).addClass('active');
                }

              }else{
                $('.opsi').eq(index).removeClass('active');
                if ($('.opsi').eq(index).hasClass('activegreen')) {
                  $('.opsi').eq(index).removeClass('activegreen');
                }else{
                  $('.opsi').eq(index).addClass('activegreen');
                }
              }
          //  countopsi.push(result);
        }

      });    
            var bobotisi = $('.bobot').eq(index).val();
            //console.log(bobotisi);
            if (bobotisi != '') {
              countopsi.push(bobotisi);

            }
      // console.log(countopsi);
       // 
        var bobot = 0;
        var jumlahbobot = 0;
         $('.bobot').each(function(i, e) {
           var bobotval = $(this).val();
            console.log(bobotval);
      //     bobot.push(+bobotval);

             bobot +=parseInt(bobotval);
             jumlahbobot++;
         });
         // console.log(bobot);
         var countbobot =  bobot;
         $('.hasil').html(countbobot);
         $('.persyaratan').html(bobot.length);
         if (countbobot >= 11) {
          $('.catatan').html('Hasil survey '+countbobot+'/'+jumlahbobot+' Kriteria, Pasien dinyatakan LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
          $('.kethasil').html('LAYAK');
          $('.iconhasil').removeClass('ft-user-x text-danger');
          $('.kethasil').removeClass('text-danger');
          if ($('.iconhasil').hasClass('ft-user-x')) {
            $('.iconhasil').removeClass('ft-user-x text-danger');
            $('.kethasil').removeClass('text-danger');
          }else{
            $('.iconhasil').addClass('ft-user-check text-success');
            $('.kethasil').addClass('text-success');
          }
        }else{
           $('.catatan').html('Hasil survey '+countbobot+'/'+jumlahbobot+' Kriteria, Pasien dinyatakan TIDAK LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
          $('.kethasil').html('TIDAK LAYAK');
          $('.kethasil').removeClass('text-success');
          $('.iconhasil').removeClass('ft-user-check text-success');
          if ($('.iconhasil').hasClass('ft-user-check  text-success')) {
            $('.iconhasil').removeClass('ft-user-check text-success');
          }else{
            $('.iconhasil').addClass('ft-user-x text-danger');
            $('.kethasil').addClass('text-danger');
          }
        } 
     })
        })
      //   $('.opsi').change(function(event) {
      //    var bobot = [];
      //    $('.bobot').each(function(i, e) {
      //      var bobotval = $(this).val();
      //       console.log(bobotval);
      // //     bobot.push(+bobotval);
      //        bobot +=bobotval;
      //    });
      //    // console.log(bobot);
      //    var countbobot =  bobot;
      //    $('.hasil').html(countbobot);
      //    $('.persyaratan').html(bobot.length);
      //    if (countbobot >= 11) {
      //     $('.catatan').html('Hasil survey '+countbobot+'/'+bobot.length+' Kriteria, Pasien dinyatakan LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
      //     $('.kethasil').html('LAYAK');
      //     $('.iconhasil').removeClass('ft-user-x text-danger');
      //     $('.kethasil').removeClass('text-danger');
      //     if ($('.iconhasil').hasClass('ft-user-x')) {
      //       $('.iconhasil').removeClass('ft-user-x text-danger');
      //       $('.kethasil').removeClass('text-danger');
      //     }else{
      //       $('.iconhasil').addClass('ft-user-check text-success');
      //       $('.kethasil').addClass('text-success');
      //     }
      //   }else{
      //      $('.catatan').html('Hasil survey '+countbobot+'/'+bobot.length+' Kriteria, Pasien dinyatakan TIDAK LAYAK mendapatkan Pembiayaan Bantuan Sosial diluar Kuota PBI');
      //     $('.kethasil').html('TIDAK LAYAK');
      //     $('.kethasil').removeClass('text-success');
      //     $('.iconhasil').removeClass('ft-user-check text-success');
      //     if ($('.iconhasil').hasClass('ft-user-check  text-success')) {
      //       $('.iconhasil').removeClass('ft-user-check text-success');
      //     }else{
      //       $('.iconhasil').addClass('ft-user-x text-danger');
      //       $('.kethasil').addClass('text-danger');
      //     }
      //   }
      //   // alert(countbobot);
      // });

  //  console.log(countopsi);
 //  $('.surveybtn').click(function(event) {
 //   var bobot = [];
 //   var opsival = [];
 //   var ceklist_survey = [];
 //   var tanggal_survey = $('.tanggal_survey').val();
 //   var surveyor = $('.surveyor').val();
 //   var catatan =  $('.catatan').val();
 //   $('.bobot').each(function(i, e) {
 //    bobot.push($(this).val());
 //    opsival.push($('.opsi').eq(i).val());
 //    ceklist_survey.push($('.ceklist_survey').eq(i).val());
 //  });
 //   var form_data = {
 //     tanggal_survey : tanggal_survey,
 //     surveyor : surveyor,
 //     catatan : catatan,
 //     opsi : opsival,
 //     ceklist_survey : ceklist_survey,
 //     bobot : bobot
 //   }
 //   console.log(form_data);
 // });
//  $('.confirm-survey').on('click',function(){
//    var bobot = [];
//    var opsival = [];
//    var ceklist_survey = [];
//   //  var resultbobot = bobot.map(function (x) { 
//   //   return parseInt(x, 10); 
//   // });
//   var tanggal_survey = $('.tanggal_survey').val();
//   var surveyor = $('.surveyor').val();
//   var catatan =  $('.catatan').val();
//   $('.bobot').each(function(i, e) {
//     var bobotval = $(this).val();
//     bobot.push(+bobotval);
//     opsival.push($('.opsi').eq(i).val());
//     ceklist_survey.push($('.ceklist_survey').eq(i).val());
//   });
//   var form_data = {
//    tanggal_survey : tanggal_survey,
//    surveyor : surveyor,
//    catatan : catatan,
//    opsi : opsival,
//    ceklist_survey : ceklist_survey,
//    bobot : bobot
//  }
//  var countbobot =  bobot.reduce(myFunc);
//  console.log(countbobot);
//  if (countbobot < 12) {
//    var title = "Hasil Survey "+countbobot+" Kurang dari kriteria yang direkomendasikan";
//  }else{
//    var title = "Hasil Survey "+countbobot+" Kurang dari kriteria yang direkomendasikan";
//  }
// });
</script>

</body>
</html>