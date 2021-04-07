<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>Halaman utama</title>
</head>

<script src="https://code.highcharts.com/highcharts.js"></script>
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
  <div class="row">
    <div class="col-lg-4 col-12  col-sm-6">
      <div class="card pull-up" style="border-radius: 10px;">
        <div class="card-content">
          <div class="card-body bg-warning" style="border-radius: 10px; padding: 30px; background-color: #FFB22B !important;">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h2 class="white" id="anggaran_tahun" style="font-weight: bold;">Rp. <?php echo number_format($anggaran_tahun); ?></h2>
                <h4 class="text-white">Anggaran Tahun Ini</h4>
                <!--      <h5 class="warning">50%</h5> -->
              </div>
              <div>
                <i class="la la-money font-large-2 float-right text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card pull-up" style="border-radius: 10px;">
        <div class="card-content">
          <div class="card-body bg-info" style="border-radius: 10px; padding: 30px;">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h2 class="white" id="sisa_anggaran" style="font-weight: bold;">Rp. <?php echo number_format($sisa_anggaran); ?></h2>
                <h4 class="text-white">Sisa Anggaran Tahun Ini</h4>
                <!--  <h5 class="white">50%</h5> -->
              </div>
              <div>
                <i class="la la-money font-large-2 float-right text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="card pull-up" style="border-radius: 10px;">
        <div class="card-content">
          <div class="card-body bg-success" style="border-radius: 10px; padding: 30px;">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h2 class="white" id="nominal_pembiayaan" style="font-weight: bold;">Rp. <?php echo number_format($nominal_pembiayaan); ?></h2>
                <h4 class="text-white">Total Nominal Pembiayaan</h4>
                <!-- <h5 class="white">50%</h5> -->
              </div>
              <div>
                <i class="la la-money font-large-2 float-right text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card pull-up" style="border-radius: 10px;">
        <div class="card-content">
          <div class="card-body bg-danger" style="border-radius: 10px; padding: 30px;">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h2 class="white" id="total_pasien" style="font-weight: bold;"><?php echo number_format($total_pasien); ?></h2>
                <h4 class="text-white">Total Pasien</h4>
                <!-- <h5 class="text-white">50%</h5> -->
              </div>
              <div>
                <i class="la la-user font-large-2 float-right text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
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
            <div class="chartjs">
              <div id="kunjungan_bantuan"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">
  <div class="col-xl-8 col-12 col-sm-6">
    <div class="card">
      <div class="card-header pb-0">
        <div class="form-group col-md-12">
          <select class="form-control" id="orderDistribusi">
            <option value="0" selected>ALL DISTRIBUSI SJP</option>
            <option value="1">TOP TEN DISTRIBUSI SJP</option>
            <option value="2">TOP FIVE DISTRIBUSI SJP</option>
          </select>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body pb-1">
          <div id="distribusi"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-4 col-sm-6">
    <div class="card">
      <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
        <h4 style="color: white; font-weight: bold;">Jumlah Pengajuan SJP</h4>
      </div>
      <div class="card-content collapse show" style="padding: 10px; min-height: 440px;">
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


<div class="row">

  <div class="col-xl-6 col-sm-6 col-12">
    <div class="card">
      <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
        <h4 style="color: white; font-weight: bold;">Jumlah Kunjungan / Bulan</h4>
      </div>
      <div class="card-content">
        <div class="card-body pb-1">
          <div id="kunjungan_bulan"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-12 col-sm-6">
    <div class="card">
      <div class="card-header" style="background-color: #1E9FF2; border-radius: 5px 5px 0px 0px;">
        <h4 style="color: white; font-weight: bold;">Tren Pasien Per-Tahun</h4>
      </div>
      <div class="card-content">
        <div class="card-body pb-1">
          <div id="trendpasien"></div>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="row">


</div>

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
  // jQuery.ajaxSetup({
  //   beforeSend: function() {
  //      $('#loader').show();
  //      // $('.lds-ripple').show();
  //   },
  //   complete: function(){
  //     // $('.lds-ripple').hide();
  //      $('#loader').hide();
  //   }
  // });

  $("#orderDistribusi").change(function() {
    const bulan = $("#bulan").val();
    const tahun = $("#tahun").val();
    const kecamatan = $("#kecamatan").val();
    const kelurahan = $("#kelurahan").val();
    const orderDistribusi = $("#orderDistribusi").val();

    $.ajax({
      url: "<?= base_url($controller . 'orderDistribusi') ?>",
      method: "POST",
      data: {
        bulan: bulan,
        tahun: tahun,
        kecamatan: kecamatan,
        kelurahan: kelurahan,
        orderDistribusi: orderDistribusi
      },
      success: function(json) {
        // Chart
        var cek = JSON.parse(json);
        $("#distribusi").html('');
        // alert(cek);
        chartDistribusi(cek);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert('Load Order DISTRIBUSI Error');
      }
    });
  });


  $(document).ready(function() {
    // alert("OK! \n Baru Bisa sebagian Filter dashboardnya. \n di Localhost lancar -_- di server error \n (FIlter Bulan hanya bisa febbruari dan semua(Error) & FIlter kelurahan error )");
    var distribusiData = <?= $distribusi  ?>;
    var kunjunganData = <?= $jumlah_kunjungan_bulan ?>;
    var trendData = <?= $trend_pasien ?>;
    var kunjanganBData = <?= $chartJenisRawat ?>;

    // Tetap Error
    // var datakunjungan = "";
    // var panjang = 3
    // for (var i = 1; i <= panjang; i++) {
    //   datakunjungan += kunjanganBData[i];
    //   if(i < panjang){
    //     datakunjungan += ",";
    //   }
    // }
    // alert(distribusiData);

    chartDistribusi(<?= $distribusi  ?>);
    chartKunjungan(<?= $jumlah_kunjungan_bulan ?>);
    chartTrend(<?= $trend_pasien ?>);
    chartKunjunganBantuan([kunjanganBData[1], kunjanganBData[2], kunjanganBData[3]]);
  });

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
        var html = '<option>Pilih Kelurahan</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value = "' + data[i].kelurahan + '">' + data[i].kelurahan + '</option>';
        }
        $('#kd_kelurahanpemohon').html(html);

      }
    });
  }
  // alert("OK");

  // FILTER
  $(".form-control-select").change(function() {
    // alert( "Bulan: " + bulan + " Tahun: " + tahun + " Kecamatan: " + kecamatan + " kelurahan: " + kelurahan);
    const bulan = $("#bulan").val();
    const tahun = $("#tahun").val();
    const kecamatan = $("#kecamatan").val();
    const kelurahan = $("#kd_kelurahanpemohon").val();
    const orderDistribusi = $("#orderDistribusi").val();

    $.ajax({
      url: "<?= base_url($controller . 'Filter') ?>",
      method: "POST",
      data: {
        bulan: bulan,
        tahun: tahun,
        kecamatan: kecamatan,
        kelurahan: kelurahan,
        orderDistribusi: orderDistribusi
      },
      success: function(json) {
        // alert(json);
        var obj = JSON.parse(json);
        // alert(obj.chartJenisRawat);
        // console.log("CEK : " + obj.chartJenisRawat);

        // sjp || OK!
        $("#sjp").html('');
        const sjp = Object.entries(obj["jumlah_sjp"]);
        // console.log(sjp);
        // alert(sjp);
        for (const [key, value] of sjp) {
          $("#sjp").append(`<tr><th scope="row" class="border-top-0">${obj["jumlah_sjp"][key[0]]["nama"]} </th><td class="border-top-0"> ${value["jumlah"]} </td></tr>`);
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

        // Chart

        // Untuk hapus Chart (error)
        // kunjungan_bantuan.destroy();
        // distribusi.destroy();
        // kunjungan_bulan.destroy();
        // trendpasien.destroy();

        // console.log("cek test :  " + obj.distribusi.replace("\"", ""));
        // alert(json.distribusi);
        console.log("ini : " + obj2);
        chartDistribusi(obj.distribusi);
        chartKunjungan(obj.jumlah_kunjungan_bulan);

        // Ripuhhh
        var obj2 = JSON.parse(obj.trend_pasien);
        chartTrend(obj2);

        var obj3 = JSON.parse(obj.chartJenisRawat);
        chartKunjunganBantuan(obj3);

        // Jenis Rawat
        $("#jenis_rawat").html('');
        const jenis_rawat = Object.entries(obj["jenis_rawat"]);
        // alert(sjp);
        for (const [key, value] of jenis_rawat) {
          const cekClass = (obj["jenis_rawat"][key[0]]["jenis_rawat"] == 'Orang Terlantar' ? 'danger' : 'text-muted')
          $("#jenis_rawat").append(`<div class="col-6 col-md-4"><h5>${obj["jenis_rawat"][key[0]]["jenis_rawat"]}</h5><h2 class="${cekClass}">${value["jumlah"]} </h2></div>`);
          // console.log(`Test : ${obj["jenis_rawat"][key[0]]["jenis_rawat"]} ${value["jumlah"]}s`);
        }

      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert('Error AJAX');
      }
    });

  }); // change function


  $(".select2").select2();

  function chartDistribusi(data) {
    // console.log("distribusi : " + data);
    var distribusi = new Highcharts.chart('distribusi', {
      credits: {
        enabled: false
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        type: 'category',
      },
      yAxis: {
        min: 0,
        title: {
          text: ''
        }
      },
      legend: {
        enabled: false
      },
      series: [{
        name: 'SJP',
        color: "#fa983a",
        data: data
      }]
    });

    // if(destroy == 1){
    //   distribusi.destroy();
    // }
  }

  function chartKunjungan(data) {
    // alert(data);
    // console.log(data);
    // var cek = JSON.parse(data);

    var kunjungan_bulan = new Highcharts.chart('kunjungan_bulan', {
      credits: {
        enabled: false
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        type: 'category',
      },
      yAxis: {
        min: 0,
        title: {
          text: ''
        }
      },
      legend: {
        enabled: false
      },
      series: [{
        name: 'Pasien',
        data: data
      }]
    });
  }

  function chartTrend(data) {
    $("#trendpasien").html('');
    var trendpasien = new Highcharts.chart('trendpasien', {
      credits: {
        enabled: false
      },
      chart: {
        type: 'spline'
      },
      title: {
        text: ''
      },
      xAxis: {
        type: 'category',
      },
      yAxis: {
        min: 0,
        title: {
          text: ''
        }
      },
      legend: {
        enabled: false
      },
      series: [{
        name: 'Pasien',
        data: data
      }],
      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
          chartOptions: {
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom'
            }
          }
        }]
      }
    });
  }

  // function chartKunjunganBantuan(data){

  //   $("#kunjungan_bantuan").html('');
  //   var kunjungan_bantuan = new Highcharts.chart('kunjungan_bantuan', {
  //       credits: {
  //         enabled: false
  //       },
  //       title: {
  //           text: ''
  //       },
  //       xAxis: {
  //           categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  //       },
  //       legend: {
  //         enabled: false
  //       },
  //       tooltip: {
  //           crosshairs: true,
  //           shared: true
  //       },
  //       yAxis: {
  //         min: 0,
  //         title: {
  //           text: ''
  //         }
  //       },
  //       plotOptions: {
  //           spline: {
  //               marker: {
  //                   radius: 4,
  //                   lineColor: '#666666',
  //                   lineWidth: 1
  //               }
  //           }
  //       },
  //       series: data,

  //       responsive: {
  //           rules: [{
  //               condition: {
  //                   maxWidth: 500
  //               },
  //               chartOptions: {
  //                   legend: {
  //                       layout: 'horizontal',
  //                       align: 'center',
  //                       verticalAlign: 'bottom'
  //                   }
  //               }
  //           }]
  //       }
  //   });

  //    console.log(data);
  //   alert(data);

  // }




  // Next
  function format_uang(n) {
    return n.toFixed(2).replace(/./g, function(c, i, a) {
      return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
  }
</script>


</body>

</html>