<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>Halaman utama</title>
</head>

<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url() ?>app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>

<div class="form-row">

  <div class="form-group col-md-3 col-sm-6">
    <select class="form-control form-control-select" id="bulan" style="border: none !important; border-radius: 5px;">
      <option value="" selected>Semua Bulan</option>
      <option value="2020-01-11">Januari.</option>
      <option value="2020-02-11">Februari</option>
      <option value="2020-03-11">Maret</option>
      <option value="2020-04-11">April.</option>
      <option value="2020-05-11">Mei.</option>
      <option value="2020-06-11">Juni</option>
      <option value="2020-07-11">Juli</option>
      <option value="2020-08-11">Agustus</option>
      <option value="2020-09-11">September</option>
      <option value="2020-10-11">Oktober</option>
      <option value="2020-11-11">November</option>
      <option value="2020-12-11">Desember</option>
    </select>
  </div>
  <div class="form-group col-md-3 col-sm-6">
    <select class="form-control form-control-select" id="tahun" style="border: none !important; border-radius: 5px;">
      <option value="" selected>Semua Tahun</option>
      <!-- <option value="2021" >Test1</option>
            <option value="2022" >Test2</option> -->
      <?php if (!empty($tahun)) {
        foreach ($tahun as $thn) { ?>
          <option value="<?= $thn['tahun'] ?>"><?= $thn['tahun'] ?></option>
      <?php }
      } ?>
    </select>
  </div>
  <div class="form-group col-md-3 col-sm-6">
    <select class="form-control form-control-select" id="kecamatan" name="kecamatan" style="border: none !important; border-radius: 5px;">
      <option value="" selected>Semua Kecamatan</option>
      <?php if (!empty($kecamatan)) {
        foreach ($kecamatan as $key) { ?>
          <option value="<?= $key['kecamatan'] ?>"><?= $key['kecamatan'] ?></option>
      <?php }
      } ?>
    </select>
  </div>
  <div class="form-group col-md-3 col-sm-6">
    <select class="form-control form-control-select" id="kd_kelurahanpemohon" name="kd_kelurahanpemohon" style="border: none !important; border-radius: 5px;">
      <option value="" selected>Semua Kelurahan</option>
    </select>
  </div>

</div>
<style type="text/css">
  .table th,
  .table td {
    padding-top: 0.75rem;
    padding-right: 2rem;
    padding-bottom: 0.75rem;
    padding-left: 20px;
  }

  th {
    white-space: pre-wrap;
  }
</style>
<section id="minimal-statistics-bg">
<div class="col-lg-12 col-12">
  <div class="row">
    <div class="col-lg-8 col-8">
      <div class="row">
          <div class="col-lg-6 col-6">
            <div class="card pull-up" style="border-radius: 10px;">
              <div class="card-content">
                <div class="card-body bg-success" style="border-radius: 10px; padding: 30px;">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h2 class="white" id="nominal_pembiayaan" style="font-weight: bold;">Rp. <?php echo number_format($nominal_pembiayaan); ?></h2>
                      <h4 class="text-white">Total Nominal Pembiayaan</h4>
                    </div>
                    <div>
                      <i class="la la-money font-large-2 float-right text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="card pull-up" style="border-radius: 10px;">
              <div class="card-content">
                <div class="card-body bg-danger" style="border-radius: 10px; padding: 30px;">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h2 class="white" id="total_pasien" style="font-weight: bold;"><?php echo number_format($total_pasien); ?></h2>
                      <h4 class="text-white">Total Pasien</h4>
                    </div>
                    <div>
                      <i class="la la-user font-large-2 float-right text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
                    <h4 style="color: white; font-weight: bold;">Jumlah Pengajuan SJP</h4>
                </div>
                <div class="card-content collapse show" style="padding: 10px;">
                    <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody id="sjp">
                        <?php
                        if (!empty($jumlah_sjp)) {
                            foreach ($jumlah_sjp as $sjp) : ?>
                            <tr>
                                <th scope="row" class="border-top-0"><?= $sjp["nama"] ?></th>
                                <td class="border-top-0"><?= $sjp["jumlah"] ?></td>
                            </tr>
                        <?php endforeach;
                        } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
    <div class="row">
      <div class="col-xl-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
            <h4 style="color: white; font-weight: bold;">Jumlah Pasien Kunjungan Bantuan Sosial</h4>
          </div>
          <div class="card-content collapse show" style="padding: 40px 10px 0px 10px; min-height: 185px;">
            <div class="card-body pt-0">
              <div class="row mb-1" id="jenis_rawat">
                <?php foreach ($jenis_rawat as $jr) : ?>
                  <div class="col-6 col-md-4">
                    <h5 style="font-weight: bold;"><?= $jr['jenis_rawat'] ?></h5>
                    <h2 class="<?= ($jr['jenis_rawat'] == 'Orang Terlantar') ? 'danger' : 'text-muted' ?>"><?= $jr['jumlah'] ?></h2>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
                <h4 style="color: white; font-weight: bold;">Jumlah Pengajuan UHC</h4>
            </div>
            <div class="card-content collapse show" style="padding: 10px;">
                <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody id="uhc">
                    <?php
                    if (!empty($jumlah_uhc)) {
                        foreach ($jumlah_uhc as $uhc) : ?>
                        <tr>
                            <th scope="row" class="border-top-0"><?= $uhc["nama"] ?></th>
                            <td class="border-top-0"><?= $uhc["jumlah"] ?></td>
                        </tr>
                    <?php endforeach;
                    } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


</section>



<div id='loader'>
  <div class="lds-ripple">
    <div></div>
    <div></div>
  </div>
</div>
<style>
  .lds-ripple {
    display: inline-block;
    position: relative;
    width: 200px;
    height: 200px;
  }

  .lds-ripple div {
    position: absolute;
    border: 4px solid #dfc;
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
  }

  .lds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
  }

  @keyframes lds-ripple {
    0% {
      top: 36px;
      left: 36px;
      width: 0;
      height: 0;
      opacity: 1;
    }

    100% {
      top: 0px;
      left: 0px;
      width: 72px;
      height: 72px;
      opacity: 0;
    }
  }

  #loader {
    text-align: center;
    padding-top: 40%;
    color: white;
    display: none;
    background: salmon;
    z-index: 20;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
  }
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/highchart/highcharts.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script>

  $('#kecamatan').change(function() {
    getkelurahan();
  })

  function getkelurahan() {
    var data = $('#kecamatan').val();
    $.ajax({
      url: "<?= base_url($controller); ?>/getKelurahan",
      method: "POST",
      data: {
        id: data
      },
      async: false,
      dataType: 'json',
      success: function(data) {
        var html = '<option value="">Pilih Kelurahan</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value = "' + data[i].kelurahan + '">' + data[i].kelurahan + '</option>';
        }
        $('#kd_kelurahanpemohon').html(html);

      }
    });
  }

  // FILTER
  $(".form-control-select").change(function() {
    // alert( "Bulan: " + bulan + " Tahun: " + tahun + " Kecamatan: " + kecamatan + " kelurahan: " + kelurahan);
    const bulan = $("#bulan").val();
    const tahun = $("#tahun").val();
    const kecamatan = $("#kecamatan").val();
    const kelurahan = $("#kd_kelurahanpemohon").val();

    $.ajax({
      url: "<?= base_url($controller . 'Filter_perbaikan') ?>",
      method: "POST",
      data: {
        bulan: bulan,
        tahun: tahun,
        kecamatan: kecamatan,
        kelurahan: kelurahan
      },
      success: function(json) {
        var obj = JSON.parse(json);
        // sjp || OK!
        $("#sjp").html('');
        $("#uhc").html('');
        const sjp = Object.entries(obj["jumlah_sjp"]);
        const uhc = Object.entries(obj["jumlah_uhc"]);
        // console.log(sjp);
        // alert(sjp);
        for (const [key, value] of sjp) {
          $("#sjp").append(`<tr><th scope="row" class="border-top-0">${obj["jumlah_sjp"][key[0]]["nama"]} </th><td class="border-top-0"> ${value["jumlah"]} </td></tr>`);
          console.log(`There are ${key} ${value["jumlah"]}`);
        }

        for (const [key, value] of uhc) {
          $("#uhc").append(`<tr><th scope="row" class="border-top-0">${obj["jumlah_uhc"][key[0]]["nama"]} </th><td class="border-top-0"> ${value["jumlah"]} </td></tr>`);
          console.log(`There are ${key} ${value["jumlah"]}`);
        }

        // Anggaran & Pasien || OK!
        const anggaran_tahun = (obj["anggaran_tahun"][0].nominal_anggaran != null ? obj["anggaran_tahun"][0].nominal_anggaran : '0');
        const nominal_pembiayaan = (obj["nominal_pembiayaan"][0].nominal != null ? obj["nominal_pembiayaan"][0].nominal : '0');
        const sisa_anggaran = anggaran_tahun - nominal_pembiayaan;
        // Handle Null
        $("#anggaran_tahun").html('Rp. 0');
        $("#anggaran_tahun").html('Rp. ' + anggaran_tahun);
        $("#nominal_pembiayaan").html('Rp. 0');
        $("#nominal_pembiayaan").html('Rp. ' + nominal_pembiayaan);
        $("#sisa_anggaran").html('Rp. 0');
        $("#sisa_anggaran").html('Rp. ' + sisa_anggaran);
        $("#total_pasien").html('0');
        $("#total_pasien").html(obj.total_pasien);

      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert('Error AJAX');
      }
    });

  }); // change function



  function format_uang(n) {
    return n.toFixed(2).replace(/./g, function(c, i, a) {
      return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
  }
</script>


</body>

</html>