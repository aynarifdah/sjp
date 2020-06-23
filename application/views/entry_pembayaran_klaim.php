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

      <form action="<?php echo base_url('Dinkes/proses_update_bayar'); ?>" method="POST" class="form form-horizontal">
       <div class="form-group row mt-2 mb-3">
        <label class="col-lg-3 label-control" for="">Tanggal Bayar</label>
        <div class="col-lg-3">
          <input type="date" class="form-control datepicker" placeholder="Tanggal Bayar"
          name="tanggalbayar" id="" required>
        </div>
      </div>
      <span class="ml-2">Anda Akan Mengupdate Status Pembayaran SJP :</span>
      <table id="datatable" class="table table-bordered" style="cursor:pointer;">
        <thead>
          <tr>
            <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
            <th>Nama</th>
            <th>Nomor SJP</th>
            <th>Rumah Sakit</th>
            <th>Diagnosa</th>
            <th>Nominal Pembiayaan</th>
            <!--             <th>Catatan</th> -->
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($dataklaim)) {
            foreach ($dataklaim as $key) {?> 
            <tr>
              <td><?php echo $key['nama_pasien']; ?><input type="hidden" name="id_sjp[]" value="<?php echo $key['id_sjp']?>"></td>
              <td><?php echo $key['nomor_surat']; ?></td>
              <td><?php echo $key['nm_rs']; ?></td>
              <td><?php if (!empty($penyakit)) {
                foreach ($penyakit as $keypenyakit) { 
                  if ($key['id_sjp'] == $keypenyakit['id_sjp']) {?>

                  <li>- <?php echo $keypenyakit['namadiag']; ?></li>

                  <?php } }
                } ?></td>
                <td><?= $key['nominal_pembiayaan'] ?></td>
              </tr>
              <?php }
            } ?> 

          </tbody>
        </table>

        <button type="submit" style="float: right;" class="btn btn-primary btn-sm mt-1 mb-1 mr-2" id="simpanklaim"></i>Simpan</button>
      </div>
    </form>
  </div>
</div>
</div>
<style>
#datatable_length{
  display: none;
}
</style>
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script>
  var dtable = $("#datatable").DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "bFilter": false,
  })
</script>
</body>
</html>