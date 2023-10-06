<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>Halaman utama</title>
</head>
<div class="card">
  <div class="card-header">
    <h4 class="card-title" id="title">Pengajuan Klaim</h4>
    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
    <div class="heading-elements">
      <ul class="list-inline mb-0">
        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
        <li><a data-action="close"><i class="ft-x"></i></a></li>
      </ul>
    </div>
  </div>
  <div class="card-content collapse show">
    <div class="card-body">
      <?php if (!empty($dataklaim)) {
        foreach ($dataklaim as $key) { ?>
          <form action="<?php echo base_url('Rs/proses_entry_klaim'); ?>" method="POST" enctype="multipart/form-data" class="form form-horizontal">
            <div class="form-group row mt-2">
              <label class="col-lg-3 label-control" for="">Tanggal Tagihan</label>
              <div class="col-lg-3">
                <input type="date" class="form-control datepicker" placeholder="Tanggal Tagihan" name="tanggal_tagihan" id="tanggal_tagihan" required value="<?= $key['tanggal_tagihan']; ?>">
              </div>
            </div>
            <div class="form-group row mt-2">
              <label class="col-lg-3 label-control" for="nik">Nomor Tagihan</label>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="Nomor Tagihan" name="nomor_tagihan" id="nomor_tagihan" value="<?= $key['nomor_tagihan']; ?>" required>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
        <div id='loader' style='display: none; width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;'>
          <img src='<?= base_url('assets/images/') ?>spinner.gif' width='100%' height='auto'><br>
          <p>Mohon Tunggu...</p>
        </div>
        <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-responsive" style="width: 100%;">
            <thead>
              <tr>
                <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
                <th>Nama Pasien</th>
                <th>Nomor SJP</th>
                <th>Diagnosa</th>
                <th>Nominal Pengajuan</th>
                <th>Dokumen INA CBG</th>
                <th>Dokumen Resume Medis</th>
                <th>Dokumen tambahan</th>
                <th>Lembar Keterangan Pasien</th>
                <th>Catatan Pengajuan Klaim</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($dataklaim)) {
                foreach ($dataklaim as $key) { ?>
                  <tr>
                    <td>
                      <!-- <a href="<?php echo base_url('Rs/detail_pengajuan/' . $key['id_sjp']); ?>"> -->
                      <?php echo $key['nama_pasien']; ?></a> <input type="hidden" name="id_sjp[]" value="<?php echo $key['id_sjp'] ?>">
                    </td>
                    <td><?php echo $key['nomor_surat']; ?></td>
                    <td><?php if (!empty($penyakit)) {
                          foreach ($penyakit as $keypenyakit) {
                            if ($key['id_sjp'] == $keypenyakit['id_sjp']) { ?>

                            <li>- <?php echo $keypenyakit['namadiag']; ?></li>

                      <?php }
                          }
                        } ?>
                        <?php if (!empty($penyakit)) {
                          foreach ($penyakit as $keypenyakit) {
                            if ($key['id_sjp'] == $keypenyakit['id_sjp']) { ?>

                            <li>- <?php echo $keypenyakit['penyakit']; ?></li>

                      <?php }
                          }
                        } ?>
                    </td>
                    <td><input type="text" class="form-control" name="nominal_klaim[]" id="nominal_klaim" placeholder="Nominal" value="<?= $key['nominal_klaim']; ?>" required></td>
                    <td><input type="file" class="form-control dok1" name="dokumen[]" id="dokumen" required /></td>
                    <td><input type="file" class="form-control" name="dokumen[]" id="dokumen" /></td>
                    <td><input type="file" class="form-control" name="dokumen[]" id="dokumen" /></td>
                    <td><input type="file" class="form-control" name="dokumen[]" id="dokumen" /></td>
                    <td><textarea type="text" class="form-control" cols="20" rows="3" name="catatan_klaim[]" placeholder="Catatan" id="catatan_klaim" value="<?= $key['catatan_klaim']; ?>"></textarea> </td>
                    <?php if (!empty($dataklaim)) : ?>
                      <input id="dokumen_hidden" type="hidden" name="dokumen_hidden" value="<?= $key['namafile'] ?>">
                    <?php endif; ?>
                  </tr>
              <?php }
              } ?>


            </tbody>
          </table>
        </div>

        <button type="submit" style="float: right; margin: 10px;" class="btn btn-primary btn-sm"></i>Ajukan Klaim</button></a>
    </div>
    </form>

    <button id="editklaim" style="float: right; margin: 10px; display: none;" class="btn btn-success btn-sm"><i class="ft-save"></i> Simpan</button>

  </div>
</div>


<style>
  .card {
    position: relative;
  }

  #editklaim {
    position: absolute;
    bottom: 0;
    right: 130px;
  }
</style>

<script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

</body>

</html>
<script type="text/javascript">
  // function saveClaim() {
  // $(document).ready(function() {
  //   var halo = $('#dokumen_hidden').val();
  //   alert(halo);
  // });
  $('#editklaim').on('click', function() {

    var url = window.location.href.split('/');
    var parameter_one = url[url.length - 1].split('=');
    var result = parameter_one[1].split('%2C');
    var tanggal_tagihan = $('#tanggal_tagihan').val();
    var nomor_tagihan = $("#nomor_tagihan").val();
    var nominal_klaim = $("input[id='nominal_klaim']").map(function() {
      return $(this).val();
    }).get();
    var catatan_klaim = $("input[id='catatan_klaim']").map(function() {
      return $(this).val();
    }).get();



    var files = $('#dokumen')[0].files;
    // var files = $('#dokumen').prop('files')[0];


    // var dok1 = $('#dok1').val();



    var error = '';
    var form_data = new FormData();
    console.log(files);

    for (var count = 0; count < files.length; count++) {
      var name = files[count].name;
      console.log(files[count]);
      var extension = name.split('.').pop().toLowerCase();
      if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
        error += "Invalid " + count + " Image File"
      } else {
        form_data.append("files[]", files[count]);
      }
    }

    // form_data.append('doc', files);
    form_data.append('result', result);
    form_data.append('tanggal_tagihan', tanggal_tagihan);
    form_data.append('nomor_tagihan', nomor_tagihan);
    form_data.append('nominal_klaim', nominal_klaim);
    form_data.append('catatan_klaim', catatan_klaim);

    // if (tanggal_tagihan == '') {
    //   alert("Anda Belum Mengisi Tanggal Tagihan")
    //   return false
    // } else if (nomor_tagihan == '') {
    //   alert("Anda Belum Mengisi Nomor Tagihan")
    //   return false
    // } else if (nominal_klaim == '') {
    //   alert("Anda Belum Mengisi Nominal Pengajuan")
    //   return false
    // } else if (catatan_klaim == '') {
    //   alert("Anda Belum Mengisi Catatan")
    //   return false
    // } else if (dok1 == '') {
    //   alert("Anda Belum Mengupload File Inacbg")
    //   return false
    // } else {

    $.ajax({
      url: '<?= base_url() ?>Rs/edit_claim',
      type: 'post',
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      // dataType: 'json',
      beforeSend: function() {
        $("#loader").show();
      },
      success: function() {

      },
      complete: function(data) {
        $("#loader").hide();
      }
    });

    // }


  })
  // }
</script>
