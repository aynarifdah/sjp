<main>
<div class="container" style="padding-top: 60px; padding-bottom: 50px;">

  <div class="main_title">
    <h2>Silahkan Cek <strong>KDS</strong> dibawah ini</h2>
    <!-- <p>Sistem Pendaftaran Online SJP Kota Depok.</p> -->
  </div>

      <div class="card" style="padding: 20px;">
        <div class="card-content collapse show">
          <div class="card-body">
  
  <form class="mt-5 mb-5" id="cek">
 <h4 class="text-left ml-3"><i class="ft-file"></i> <strong>NIK</strong></h4>
    <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">NIK* (Nomor Induk Kependudukan)</label>
                  <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nomor Induk Kependudukan"
                    name="nik" id="nik"> 
                  </div>
                 
                </div>

    <button type="submit" class="btn btn-primary btn-md" name="button" style="float: right;">Cari</button>
  </form>

   <div class="table-responsive">
        
      
        <section id="configuration" style="padding-top: 10px;">
        <table id="datatable" class="table table-bordered" style="width: 100%; ">
          <thead>
            <tr>
              <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Nama</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Alamat</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">RT</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">RW</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Kecamatan</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Kelurahan</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Layanan</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Status</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Tanggal <br>Pengajuan</th>
              <!-- <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Aksi</th> -->
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        </section>
      </div>
</div>
</div>
</div>
</div>

<!-- Home -->
    <p class="text-center"><a href="<?php echo site_url('Masyarakat/index') ?>" class="btn_1 medium">Sebelumnya</a></p>
    
</main>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url()?>app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

<script type="text/javascript">
$('#cek').on("submit", function(e){
      e.preventDefault();
      var nik = $('#nik').val();
      if (nik=='') {
        alert('Maaf Anda Belum Memasukan Nomor NIK')
      }
      else{
        loaddata(nik);
        dtable.ajax.reload();
      }
     
       
      })
  $(document).ready(function() {
    $("#datatable_wrapper").hide();
  });
function loaddata(nik){
  $("#datatable_wrapper").show();
}
 var dtable = $("#datatable").DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "bFilter": false,
    columns: [
    {data: "nama", className : "dt-head-center dt-body-right bodyclick"},
    {data: "alamat", className : "dt-head-center dt-body-right bodyclick"},
    {data: "rt", className : "dt-head-center dt-body-right bodyclick"},
    {data: "rw", className : "dt-head-center dt-body-right bodyclick"},
    {data: "kecamatan", className : "dt-head-center dt-body-right bodyclick"},
    {data: "kelurahan", className : "dt-head-center dt-body-right bodyclick"},
    {data: "layanan", className : "dt-head-center dt-body-right bodyclick"},
    {data: "status", className : "dt-head-center dt-body-right bodyclick"},
    {data: "tanggal_pengajuan", className : "dt-head-center dt-body-right bodyclick"},
  ],
  ajax: {
    url: '<?php echo base_url("masyarakat/getkds");?>',
    method: 'POST',
    "data": function(d) {
        d.nik = $("#nik").val();
      }
    },
    lengthMenu :[[5, 10, 25 , 50, 100, 1000], [5, 10, 25, 50, 100, 1000]],
    pagingType: "simple_numbers",
    pageLength: 10,
  });

</script>
