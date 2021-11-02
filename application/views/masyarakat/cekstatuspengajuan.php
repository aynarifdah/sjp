<main>
<div class="container" style="padding-top: 60px; padding-bottom: 50px;">

      <div class="main_title">
        <h2>Silahkan Cek <strong>Status Pengajuan Pasien</strong> dibawah ini</h2>
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
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Pemohon</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Pasien</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Tanggal<br> Pengajuan</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Rumah <br>Sakit</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Feedback</th>
              <th style="background: #fff !important; color: #6B6F82!important; text-align:  left !important;">Status <br>Pengajuan</th>
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
    "drawCallback": function(settings){
      $('.update').each(function(index) {
      $('.update:eq('+index+')').click(function(event) {
          var id = $(this).data("id");
          var pengajuan = $(this).data("idpengajuan");
          window.location.href = "update_datapasien/"+id+"/"+pengajuan;
        });
      });
       $('.detail').each(function(index) {
      $('.detail:eq('+index+')').click(function(event) {
          var id = $(this).data("id");
          var pengajuan = $(this).data("idpengajuan");
          window.location.href = "detail_pengajuan/"+id+"/"+pengajuan;
        });
      });
        $('.cetak').each(function(index) {
        $('.cetak:eq('+index+')').click(function(event) {
          var id = $(this).data("id");
          var pengajuan = $(this).data("idpengajuan");
          window.location.href = "detail_pengajuan/"+id+"/"+pengajuan;
        });
      });
    },
    columns: [
    {data: "nama_pemohon", className : "dt-head-center dt-body-right bodyclick"},
    {data: "nama_pasien", className : "dt-head-center dt-body-right bodyclick"},
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
    {data: "feedback", className : "dt-head-center dt-body-right bodyclick"},
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
    //   {data: "id_sjp", "render": function ( data, type, row, meta ) {
    //   return "<button type='button' class='btn btn-dark btn-sm mr-1 update' data-id='"
    //   +data+"' data-idpengajuan='"+row.id_pengajuan+"' >Update</button><button type='button' class='btn btn-dark btn-circle btn-sm detail' data-id='"
    //   +data+"' data-idpengajuan='"+row.id_pengajuan+"'>Detail</button> <button type='button' class='btn btn-dark btn-circle btn-sm'>Cetak</button>"
    // },className : "dt-head-center dt-body-right" },

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
  function update(id, column_name, value) {
    var update = {
    };
    console.log(update);
    $.ajax({
      type: 'POST',
      url: '<?=base_url();?>masyarakat/update_datapasien',
      dataType : 'json',
      data: {data : fasupdate},
      success: function(data) {
        alert('Data Pasien Berhasil di update!');
        dtable.ajax.reload(function(){},true);
      }
    });
  }

</script>
