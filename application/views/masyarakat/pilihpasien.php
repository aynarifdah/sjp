 <main>
    
    <div class="container" style="padding-top: 60px; padding-bottom: 50px;">

      <div class="main_title">
        <h2>Silahkan Pilih <strong>Jenis Pasien</strong></h2>
        <p>Sistem Pendaftaran Online SJP Kota Depok.</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 geser">
          <a href="<?php echo site_url('Masyarakat/inputpasienbaru') ?>" class="box_cat_home">
            <img src="<?php echo base_url('assets/images/1.png')?>" width="150" height="150" alt="Simpus Depok">
            <h3>Pasien Baru</h3>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a href="<?php echo site_url('Masyarakat/inputpasienlama') ?>" class="box_cat_home">
            <img src="<?php echo base_url('assets/images/2.png')?>" width="150" height="150" alt="Simpus Depok">
            <h3>Pasien Lama</h3>
          </a>
        </div>
      </div>
      <!-- /row -->

      <!-- Home -->
    <p class="text-center"><a href="" class="btn_1 medium">Sebelumnya</a></p>

    </div>
    <!-- /container -->   

  </main>
  <!-- /main content -->

  <style type="text/css">
    .geser{
      margin-left: 200px;
    }

    @media only screen and (max-width: 600px) {
    .geser{
      margin-left: 0px;
    }
}
  </style>

