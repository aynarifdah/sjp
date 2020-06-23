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
                    <h2>DINAS KESEHATAN</h2>
                    <h2>UPTD PUSKESMAS LIMO</h2>
                    <h5>Jl. Raya Grogol No. 4 Kel. Grogol, Kec. Limo - Kota Depok</h5>
                    <p>Telp. 021-7754632 email : puskes.limo@gmail.com</p>
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
                    <td>440/1754 - UPTD Puskesmas</td>
                  </tr>
                  <tr>
                    <td>Lamp</td>
                    <td> : </td>
                    <td>1 berkas</td>
                  </tr>
                  <tr>
                    <td>Perihal</td>
                    <td> : </td>
                    <td>Permohonan Bantuan Pembiayaan Jaminan Kesehatan</td>
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
                <p>Walikota Depok</p>
                <p>Di Depok</p>
              </div>

            </div>
    <!--/ Invoice Customer Details -->
    <!-- Invoice Items Details -->
      <br>
      <div class="row">
        <div class="col-lg-12">
          <h5>Berdasarkan surat keterangan dari Kelurahan Limo Kecamatan Limo Nomor : 440 / 86 - Kemasy, bahwa :</h5>
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td style="width: 30%">Nama Pasien</td>
                  <td style="width: 5%">:</td>
                  <td>MOCHAMMAD ELVANO ARDIANSYAH</td>
                </tr>
                <tr>
                  <td style="width: 30%">Tempat Tanggal Lahir</td>
                  <td style="width: 5%">:</td>
                  <td>Depok, 20-08-2018</td>
                </tr>
                <tr>
                  <td style="width: 30%">NIK</td>
                  <td style="width: 5%">:</td>
                  <td>3276042008180004</td>
                </tr>
                <tr>
                  <td style="width: 30%">Jenis Kelamin</td>
                  <td style="width: 5%">:</td>
                  <td>Laki-Laki</td>
                </tr>
                <tr>
                  <td style="width: 30%">Pekerjaan</td>
                  <td style="width: 5%">:</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td style="width: 30%">Alamat</td>
                  <td style="width: 5%">:</td>
                  <td>Jl. Pendowo Blok B RT 002 RW 016 Kel. Limo Kec. Limo - Kota Depok</td>
                </tr>
              </tbody>
            </table>
          
          
        </div>
      </div>
      <br>
      <p>Nama tersebut di atas adalah benar termasuk dalam golongan kurang mampu serta mengajukan Permohonan Bantuan Pembiayaan Jaminan Kesehatan di luar Kuota PBI Jaminan Kesehatan </p>
     
      <div class="row">

                  <div class="col-md-7">

                  </div>

                  <div class="col-md-5 text-center ttdka">
                    Ka. UPTD Puskesmas Limo<br>
                    <br><br><br><br><br><br>

                    
                    dr. Elin Herlina, MARS<br>
                    Pembina IV/a<br>
                    NIP. 196801131998032004
                  </div>

                </div>
    </div>
    <!-- Invoice Footer -->
   
    <!--/ Invoice Footer -->
  </div>
</section>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/css/pages/invoice.css">
 

   
</body>
</html>