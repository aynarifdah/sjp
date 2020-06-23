<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Halaman persetujuan SJP</title>
</head>

<style type="text/css">
.table th{
  width: 10%;
  }
.table th, .table td {
  padding-top: 0.75rem;
  padding-right: 2rem;
  padding-bottom: 0.75rem;
  padding-left: 20px;
}
th {
  white-space: pre-wrap;
}
</style>

  
<div class="card">
  <div class="card-head">
    <div class="card-header">
      <h4 class="card-title">Rekapitulasi Persetujuan Dana SJP</h4>
    </div>
  </div>
  <div class="card-content">
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="element mb-1 p-r-15">
            <button type="button" class="btn btn-info btn-sm" id="advancedfilterbtn"><i class="ft-filter"></i>&nbsp; Filter</button>
            <!-- <button type="button" class="btn btn-primary btn-sm" id="bayar"><i class="ft-plus"></i>&nbsp; Bayar</button> -->
            <button type="button" class="btn btn-primary btn-sm"><i class="ft-printer"></i> Cetak</button>
            <!-- <span class="dropdown"><button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i> &nbsp; Aksi</button>
              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right action-menu">
                <a href="#" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                <a href="#" class="dropdown-item"><i class="ft-trash-2"></i> Hapus</a>
                <a href="#" class="dropdown-item cetakpedagang"><i class="ft-printer"></i> Kwitansi Pembayaran</a>
                <a href="#" class="dropdown-item cetaklist"><i class="ft-printer"></i> Daftar Pembayaran</a>
              </span>
            </span> -->
          </div>
        </div>
      </div>
      <div class="row mb-1" style="padding-left: 15px; padding-right: 15px;" id="advancedfilterform">
          <div class="col-lg-3 filter">
          <div class="position-relative has-icon-left">
            <input type="text" class="form-control" placeholder="Cari">
            <div class="form-control-position">
              <i class="ft-search"></i>
            </div>
          </div>
        </div>
         <div class="col-lg-3 filter">
          <select class="select2 form-control" style="width: 100%">
            <option value="">-Diagnosa-</option>
            <option value="">Radang</option>
            <option value="">Hepatitis</option>
            <option value="">Asam Lambung</option>
          </select>
        </div>
      </div>
      <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-lg-3 filter">
          <div class="form-group">
            <div class="btn-group" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-outline-light text-muted">Harian</button>
              <button type="button" class="btn btn-outline-light text-muted">Bulanan</button>
              <button type="button" class="btn btn-outline-light text-muted">Tahunan</button>
            </div>
          </div>
        </div>
        <div class="col-lg-3 filter">
          <select class="select2 form-control" style="width: 100%">
            <option value="">-Kecamatan-</option>
            <option value="">Beji</option>
            <option value="">Bojongsari</option>
            <option value="">Cilodong</option>
            <option value="">Cimanggis</option>
            <option value="">Cinere</option>
            <option value="">Cipayung</option>
            <option value="">Limo</option>
            <option value="">Pancoran Mas</option>
            <option value="">Sawangan</option>
            <option value="">Sukmajaya</option>
            <option value="">Tapos</option>
          </select>
        </div>
        <div class="col-lg-3 filter">
          <select name="" id="" class="form-control">
            <option value="">-Kelurahan-</option>
            <option value="">Beji</option>
            <option value="">Beji Timur</option>
            <option value="">Kemirimuka</option>
            <option value="">Kukusan</option>
            <option value="">Pondok Cina</option>
            <option value="">Tanah Baru</option>
            <option value="">Bojongsari Baru</option>
            <option value="">Bojongsari Lama</option>
            <option value="">Curug</option>
            <option value="">Duren Mekar</option>
            <option value="">Duren Seribu</option>
            <option value="">Pondok Petir</option>
            <option value="">Serua</option>
            <option value="">Cilodong</option>
            <option value="">Jatimulya</option>
            <option value="">Kalibaru</option>
            <option value="">Kalimulya</option>
            <option value="">Sukamaju</option>
            <option value="">Cisalak Pasar</option>
            <option value="">Curug</option>
            <option value="">Harjamukti</option>
            <option value="">Mekarsari</option>
            <option value="">Pasir Gunung Selatan</option>
            <option value="">Tugu</option>
            <option value="">Cinere</option>
            <option value="">Gandul</option>
            <option value="">Pangkalan Jati</option>
            <option value="">Pangkalan Jati Baru</option>
            <option value="">Bojong Pondok Terong</option>
            <option value="">Cipayung</option>
            <option value="">Cipayung Jaya</option>
            <option value="">Ratujaya</option>
            <option value="">Grogol</option>
            <option value="">Krukut</option>
            <option value="">Limo</option>
            <option value="">Meruyung</option>
            <option value="">Depok</option>
            <option value="">Depok Jaya</option>
            <option value="">Mampang</option>
            <option value="">Pancoran Mas</option>
            <option value="">Rangkapan Jaya</option>
            <option value="">Rangkapan Jaya Baru</option>
            <option value="">Bedahan</option>
            <option value="">Cinangka</option>
            <option value="">Kedaung</option>
            <option value="">Pasir Putih</option>
            <option value="">Pengasinan</option>
            <option value="">Sawangan Baru</option>
            <option value="">Sawangan Lama</option>
            <option value="">Abadijaya</option>
            <option value="">Bakti Jaya</option>
            <option value="">Cisalak</option>
            <option value="">Mekar Jaya</option>
            <option value="">Sukmajaya</option>
            <option value="">Tirtajaya</option>
            <option value="">Cilangkap</option>
            <option value="">Cimpaeun</option>
            <option value="">Jatijjar</option>
            <option value="">Leuwinanggung</option>
            <option value="">Sukamaju Baru</option>
            <option value="">Sukatani</option>
            <option value="">Tapos</option>
          </select>
        </div>
        <div class="col-lg-3 filter">
          <select class="select2 form-control" style="width: 100%">
            <option value="">-Rumah Sakit-</option>
            <option value="">RSUD Kota Depok</option>
              <option value="">RS Bhayangkara Brimob</option>
              <option value="">RSU Hermina Depok</option>
              <option value="">RSU Puri Cinere</option>
              <option value="">RSU Sentra Medika</option>
              <option value="">RSU Meilia</option>
              <option value="">RSU Bunda Margonda</option>
              <option value="">RSU Grha Permata Ibu</option>
              <option value="">RSU Permata Depok</option>
              <option value="">RSU Tugu Ibu</option>
              <option value="">RSIA Tumbuh Kembang</option>
              <option value="">RSU Citra Medika Depok</option>
              <option value="">RSU Bhakti Yudha</option>
              <option value="">RSU Mitra Keluarga Depok</option>
              <option value="">RSIA Asyifa Depok</option>
              <option value="">RSU Hasanah Graha Afiah</option>
              <option value="">RSIA Setya Bhakti</option>
              <option value="">RSU Simpangan Depok</option>
              <option value="">RSU Harapan Depok</option>
              <option value="">RS Khusus Jantung Diagram</option>
              <option value="">RSIA Citra Arafiq</option>
              <option value="">RSIA Bunda Aliyah</option>
              <option value="">RSIA Brawijaya</option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table id="datatable" class="table table-bordered">
          <thead>
            <tr>
              <th>Tanggal</th>
              <!--  <th>Blok</th> -->
              <th class="text-right">Total Dana</th>
              <!-- <th class="text-right">Total Piutang</th> -->
              <!-- <th>Aksi</th> -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>30-11-2019</td>
              <td class="text-right">100.000.000</td>
             <!--  <td class="text-right">0</td> -->
            </tr>
            <tr>
              <td>26-11-2019</td>

              <td class="text-right">150.000.000</td>
              <!-- <td class="text-right">0</td> -->
            </tr>
            <tr>
              <td>29-12-2019</td>
              <td class="text-right">120.000.000</td>
              <!-- <td class="text-right">0</td> -->
            </tr>
            <tr>
              <td>31-12-2019</td>
              <td class="text-right">200.000.000</td>
              <!-- <td class="text-right">4.876.000</td> -->
            </tr>
            <tr>
              <td>01-01-2018</td>
              <td class="text-right">150.000.000</td>
              <!-- <td class="text-right">0</td> -->
            </tr>
            <tr>
              <td>02-01-2018</td>
              <td class="text-right">190.000.000</td>
              <!-- <td class="text-right">0</td> -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<style>
.action-menu {
  width: 200px !important;
  height: auto;
}
#datatable_length{
  display: none;
}
.p-l-15{
  padding-left: 15px;
}
.p-r-15{
  padding-right: 15px;
}
.filter{
  padding-right: 0px;
}
.table-responsive{
  overflow-x: hidden;
}
.card-body{
  padding-top: 0px;
}
.picker__nav--prev:before {
  content: '<' !important;
}
.picker__nav--next:before {
  content: '>' !important;
}
@media (min-width: 992px) {
  .element{
    float: right !important;
  }
}
@media (max-width: 575.98px) {
  .element{
    text-align: center !important;
    padding-right: 0px;
  }
  .filter{
    padding-right: 15px;
    padding-bottom: 5px;
  }
}
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
<script>
 var dtable = $("#datatable").DataTable({
  "paging":   true,
  "ordering": true,
  "info":     true,
  "bFilter": false
});
 $("#bayar").on("click", function(){
  $("#content").load("<?=base_url();?>Home/bayarkontrak");
});
 $(document).ready(function() {
  $('#advancedfilterform').hide();
  $(".select2").select2();
});
 $('#advancedfilterbtn').on("click",function() {
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $('#advancedfilterform').hide();
  }else{
    $(this).addClass('active');
    $('#advancedfilterform').show();
  }
});
</script>

  
  
</body>
</html>