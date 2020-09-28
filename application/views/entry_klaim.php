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
      
      <form action="<?php echo base_url('Rs/proses_entry_klaim'); ?>" method="POST" enctype="multipart/form-data" class="form form-horizontal">
       <div class="form-group row mt-2">
        <label class="col-lg-3 label-control" for="">Tanggal Tagihan</label>
        <div class="col-lg-3">
          <input type="date" class="form-control datepicker" placeholder="Tanggal Tagihan"
          name="tanggal_tagihan" id="" required>
        </div>
      </div>
      <div class="form-group row mt-2">
        <label class="col-lg-3 label-control" for="nik">Nomor Tagihan</label>
        <div class="col-lg-3">
          <input type="text" class="form-control" placeholder="Nomor Tagihan"
          name="nomor_tagihan" id="" required>
        </div>
      </div>

      <div class="table-responsive">
      <table id="datatable" class="table table-bordered" style="width: 100%;">
        <thead>
          <tr>
            <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
            <th>Nama</th>
            <th>Nomor SJP</th>
            <th>Diagnosa</th>
            <th>Nominal Pengajuan</th>
            <th>Upload Bukti</th>
            <th>Catatan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($dataklaim)) {
            foreach ($dataklaim as $key) {?> 
            <tr>
              <td><!-- <a href="<?php echo base_url('Rs/detail_pengajuan/'.$key['id_sjp']);?>"> -->
                <?php echo $key['nama_pasien']; ?></a>  <input type="hidden" name="id_sjp[]" value="<?php echo $key['id_sjp']?>"></td>
                <td><?php echo $key['nomor_surat']; ?></td>
                <td><?php if (!empty($penyakit)) {
                  foreach ($penyakit as $keypenyakit) { 
                    if ($key['id_sjp'] == $keypenyakit['id_sjp']) {?>
                    
                    <li>- <?php echo $keypenyakit['namadiag']; ?></li>
                    
                    <?php } }
                  } ?></td>
                  <td><input type="text" class="form-control" name="nominal_klaim[]" id="" placeholder="Nominal"></td>
                 <td><input type="file" class="form-control" name="dokumen[]" placeholder=""></td>
                  <td><input type="textarea" class="form-control" name="catatan_klaim[]" placeholder="Catatan"></td>
                </tr>
                <?php }
              } ?> 
              
            </tbody>
          </table>
          </div>
          
         <!--  <button type="button" style="float: right;  margin-left: 5px;" class="btn btn-danger btn-sm" id=""></i>Batal</button>&nbsp;&nbsp;&nbsp;
          <button type="button" style="float: right; margin-left: 5px;" class="btn btn-warning btn-sm" id=""></i>Simpan Sebagai Draft</button>&nbsp;&nbsp;&nbsp; -->
          <button type="submit" style="float: right; margin: 10px;" class="btn btn-primary btn-sm" id="simpanklaim"></i>Ajukan Klaim</button></a>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript">
   $("#inputimages").change(function () {
   readURL(this);
 });
</script>