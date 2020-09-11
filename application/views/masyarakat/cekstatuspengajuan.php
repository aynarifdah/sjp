<div class="container">
  <h2 class="text-center mt-4">CEK STATUS PENGAJUAN SJP</h2>
  <h4 class="text-center">Silahkan Isi Data Pasien</h4>

  <form class="mt-5 mb-5" id="cek">

    <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">NIK* (Nomor Induk Kependudukan)</label>
                  <div class="col-lg-9" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nomor Induk Kependudukan"
                    name="nik" id="nik"> 
                  </div>
                 
                </div>

             <!--    <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Tanggal Lahir</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="date" class="form-control kontrakform" placeholder=" ISIKAN NAMA LENGKAP"
                    name="nama_pemohon" id="namapemohon" required> 
                  </div>
                 
                </div> -->
  
   <!--  <div class="form-group row">
      <label class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
      <div class="col-sm-9">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
          </div>
          <input type="date" class="form-control">
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Jenis Bayar</label>
      <div class="col-sm-9">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fa fa-money" aria-hidden="true"></i>
            </div>
          </div>
          <select class="form-control" id="jenis_bayar">
            <option>-- Pilih Jenis Bayar --</option>
            <option value="Bayar">Bayar</option>
            <option value="BPJS">BPJS</option>
          </select>
        </div>
      </div>
    </div>
    <div id="jenis_bayar_value">
    </div> -->
    <button type="submit" class="btn btn-primary" name="button">Submit</button>
  </form>
   <div class="table-responsive">
        
      
        <section id="configuration" style="padding-top: 10px;">
        <table id="datatable" class="table table-bordered" style="width: 100%; ">
          <thead>
            <tr>
              <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
              <th style="color: #6B6F82!important;">Pemohon</th>
              <th style="color: #6B6F82!important;">Pasien</th>
              <th>Tanggal<br> Pengajuan</th>
             
              <th>Rumah <br>Sakit</th>
        
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Status <br>Pengajuan</th>
              
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        </section>
      </div>
</div>

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
        alert('Maaf')
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
    {data: "nama_pemohon", className : "text-info dt-head-center dt-body-right bodyclick"},
    {data: "nama_pasien", className : "text-info dt-head-center dt-body-right bodyclick"},
    {data: "tanggal_pengajuan", "render": function ( data, type, row, meta ) {
      var date = new Date(data);
      var year = date.getFullYear();
      var month = date.getMonth()+1;
      var dt = date.getDate();

      if (dt < 10) {
        dt = '0' + dt;
      }
      if (month < 10) {
        month = '0' + month;
      }

      var datenow = dt+'-' + month + '-'+year;
      return datenow;
    }, className: "dt-head-center dt-body-right bodyclick" },
    {data: "nm_rs", className : "dt-head-center dt-body-right bodyclick"},
    {data: "id_status_pengajuan", "render": function ( data, type, row, meta ) {
      if (data == 1) {
        //$('.statuspengajuan').addClass('bg-info');
        return '<div class="badge bg-blue-grey " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
        //return row.status_pengajuan;
      }else if (data == 2){
        // $('.statuspengajuan').addClass('bg-warning');
        // return row.status_pengajuan;
        return '<div class="badge bg-info " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      }else if (data == 3){
        // $('.statuspengajuan').addClass('bg-danger');
        // return row.status_pengajuan;
        return '<div class="badge bg-primary " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      }else if (data == 4){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-warning " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 5){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-warning " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 6){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-success " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } else if (data == 7){
        // $('.statuspengajuan').addClass('bg-success');
        // return row.status_pengajuan;
        return '<div class="badge bg-danger " style="font-size: 14px;">'+row.status_pengajuan+'</div>'
      } 

    },className : "dt-head-center dt-body-right bodyclick statuspengajuan text-white"},
  

  ],
  ajax: {
    url: ' <?php echo base_url("masyarakat/getstatus");?>',
    method: 'POST',
    "data": function(d) {
         
          d.nik       = $("#nik").val();
        }
      },
      lengthMenu :[[5, 10, 25 , 50, 100, 1000], [5, 10, 25, 50, 100, 1000]],
      pagingType: "simple_numbers",
      pageLength: 10,
    });
</script>
