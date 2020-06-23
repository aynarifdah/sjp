<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Halaman utama</title>
</head>


  


<section class="card">
  <div id="invoice-template" class="card-body">
    <!-- Invoice Company Details -->
    <div class="row justify-content-center mt-2">
              <!-- logo dinkes -->
              <div class="col-md-3 text-center">
                <img src="<?= base_url(''); ?>app-assets/images/logo_dinkes.jpg" alt="logo_dinkes" height="180" width="150">
              </div> 

              <!-- teks -->
              <div class="col-md-9 text-center omae">
                <div class="row">
                  <div class="col-md-9 ml-3 mt-1">
                    <h2>PEMERINTAH KOTA DEPOK</h2>
                    <h1>DINAS KESEHATAN</h1>
                    <h5>Jl. Margonda Raya No. 54, Gedung DIBALEKA II Lt. 3 DEPOK 16431</h5>
                    <p>Telp / Fax : (021) 29402281</p>
                  </div>
                </div>
              </div>
            </div>
            <hr class="garisatas">
            <hr class="garisbawah">

            <!-- Surat pembuka -->
            <div class="row">

              <div class="col-md-8 mt-5 lmpr">
                <table>
                  <tr>
                    <td>Nomor</td>
                    <td> : </td>
                    <td>401/02.3768/Yankesru dan PK</td>
                  </tr>
                  <tr>
                    <td>Lamp</td>
                    <td> : </td>
                    <td>1 berkas</td>
                  </tr>
                  <tr>
                    <td>Hal</td>
                    <td> : </td>
                    <td>Surat Jaminan Pelayanan</td>
                  </tr>
                </table>
              </div>

              <div class="col-md-4 tmpt">
                <p>
                  <?php 

                    // $tanggal = mktime(date("m"),date("d"),date("Y"));
                    echo "Depok, ".date("d F Y")." ";
                  ?>
                </p>
                <p>Kepada Yth.</p>
                <p>Direktur RSUD Depok</p>
                <p>Di Tempat</p>
              </div>

            </div>
    <!--/ Invoice Customer Details -->
    <!-- Invoice Items Details -->
      <br>
      <div class="row">
        <div class="col-lg-12">
          <h5>Dari hasil penelitian kami atas surat-surat dari :</h5>
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td style="width: 30%">Nama Pasien</td>
                  <td style="width: 5%">:</td>
                  <td>MOCHAMMAD ELVANO ARDIANSYAH</td>
                </tr>
                <tr>
                  <td style="width: 30%">Tanggal Lahir</td>
                  <td style="width: 5%">:</td>
                  <td>20/08/2018</td>
                </tr>
                <tr>
                  <td style="width: 30%">Jenis Kelamin</td>
                  <td style="width: 5%">:</td>
                  <td>Laki-Laki</td>
                </tr>
                <tr>
                  <td style="width: 30%">Tgl. Mulai Rawat</td>
                  <td style="width: 5%">:</td>
                  <td>30/08/2019</td>
                </tr>
                <tr>
                  <td style="width: 30%">Alamat</td>
                  <td style="width: 5%">:</td>
                  <td>Jl. Pendowo Blok B RT 002 RW 016 Kel. Limo Kec. Limo - Kota Depok</td>
                </tr>
              </tbody>
            </table>
          
          <h5>Ternyata pasien tersebut memenuhi syarat :</h5>
           <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td  style="width: 30%">Dirawat di</td>
                <td style="width: 5%">:</td>
                <td>Kelas III</td>
              </tr>
              <tr>
                <td  style="width: 30%">Dilakukan</td>
                <td style="width: 5%">:</td>
                <td>Rawat Inap</td>
              </tr>
              <tr>
                <td  style="width: 30%">Scanning</td>
                <td style="width: 5%">:</td>
                <td>-</td>
              </tr>
              <tr>
                <td  style="width: 30%">USG</td>
                <td style="width: 5%">:</td>
                <td>-</td>
              </tr>
              <tr>
                <td  style="width: 30%">Lain-Lain</td>
                <td style="width: 5%">:</td>
                <td>-</td>
              </tr>
              <tr>
                <td  style="width: 30%">Diagnosa sementara</td>
                <td style="width: 5%">:</td>
                <td>GE, Vomi tvs, Leukositosis</td>
              </tr>
              <tr>
                <td  style="width: 30%">Diberikan jaminan</td>
                <td style="width: 5%">:</td>
                <td>30 Agustus 2019 s/d 13 september 2019</td>
              </tr>
              <tr>
                <td  style="width: 30%">Jaminan</td>
                <td style="width: 5%">:</td>
                <td>Pembiayaan Jaminan Kesehatan Maskin Diluar Kuota PBI Jaminan Kesehatan</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <p>Atas biaya Pemerintah Kota Depok dengan ketentuan yang berlaku. Biaya tersebut agar diajukan oleh Rumah Sakit secara kolektif sebelum tanggal 10 pada bulan berikutnya.</p>
     
      <div class="row">

                  <div class="col-md-7">

                  </div>

                  <div class="col-md-5 text-center ttdka">
                    a.n Kepala Dinas Kesehatan Kota Depok<br>
                    Kepala Bidang Pelayanan Kesehatan<br>
                    u.b Kepala Seksi Yankesru dan PK<br><br><br><br><br><br>

                    
                    dr. Fikrotul Ulya<br>
                    Pembina IV/a<br>
                    NIP. 19780524 200604 2 017
                  </div>

                </div>

    </div>

    <!-- Invoice Footer -->
   
    <!--/ Invoice Footer -->
  </div>
  <td><button type="button" class="btn mr-1 mb-1 btn-primary btn-sm"  style="float: right;">Cetak</button></td>
</section>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/css/pages/invoice.css">
 

  
</body>
</html>