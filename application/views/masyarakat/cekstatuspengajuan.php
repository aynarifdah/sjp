<div class="container">
  <h2 class="text-center mt-4">CEK STATUS PENGAJUAN SJP</h2>
  <h4 class="text-center">Silahkan Isi Data Pasien</h4>
  <div class="alert alert-info mt-5" role="alert"><p style="color: white;">Contoh No. NIK 0101xxxxxxxxxxxxx31</p> 
  </div>
  <form class="mt-5 mb-5">

    <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">NIK* (Nomor Induk Kependudukan)</label>
                  <div class="col-lg-9" style="padding: 0px 15px 5px 15px;">
                    <input type="text" class="form-control kontrakform" placeholder="Nomor Induk Kependudukan"
                    name="nama_pemohon" id="namapemohon" required> 
                  </div>
                 
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 label-control" for="namalengkap">Tanggal Lahir</label>
                  <div class="col-lg-3" style="padding: 0px 15px 5px 15px;">
                    <input type="date" class="form-control kontrakform" placeholder=" ISIKAN NAMA LENGKAP"
                    name="nama_pemohon" id="namapemohon" required> 
                  </div>
                 
                </div>
  
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
    <button type="button" class="btn btn-primary" name="button">Submit</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">
  var bpjs = '';
  bpjs += '<div class="form-group row jenis_bayar_value">';
  bpjs += '<label class="col-sm-3 col-form-label">No BPJS</label>';
  bpjs += '<div class="col-sm-9">';
  bpjs += '<div class="input-group mb-2">';
  bpjs += '<div class="input-group-prepend">';
  bpjs += '<div class="input-group-text">';
  bpjs += '<i class="fa fa-credit-card" aria-hidden="true"></i>';
  bpjs += '</div>';
  bpjs += '</div>';
  bpjs += '<input type="number" class="form-control">';
  bpjs += '</div>';
  bpjs += '</div>';
  bpjs += '</div>';
  $('#jenis_bayar').change(function() {
    var val = $(this).val();
    if (val == 'BPJS') {
      $('.jenis_bayar_value').remove();
      $('#jenis_bayar_value').append(bpjs);
    } else {
      $('.jenis_bayar_value').remove();
    }
  })
</script>
