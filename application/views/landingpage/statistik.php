<main class="main" id="main">
    <section id="statistik" class="statistik">

        <div class="statistiksec text-center border-bottom mb-5 aos-init aos-animate" data-aos="fade-up">
            <h2>Statistik<span class="span"> SJP</span></h2>
            <div class="breadcrumb aos-init aos-animate d-flex justify-content-center" data-aos="fade-up">
                <nav style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('Landing/index') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Statistik</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="container">
            <div class="filter mb-3" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control statistik-filter" id="kecamatan" name="kecamatan">
                            <option value="" selected>Semua Kecamatan</option>
                            <?php if (!empty($kecamatan)) {
                                foreach ($kecamatan as $key) { ?>
                                <option value="<?= $key['kecamatan'] ?>"><?= $key['kecamatan'] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control statistik-filter" id="kd_kelurahanpemohon" name="kd_kelurahanpemohon">
                            <option value="" selected>Semua Kelurahan</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <!-- KEKERASAN  WIDGET -->
            <div id="counts about" class="counts about">
                <div class="container" data-aos="fade-up">

                    <div class="row gy-4 mb-3">

                        <div class="col-lg-3 col-md-6 kasus">
                            <h2>Dashboard<span class="span"> Sistem Jaminan</span> Pelayanan</h2>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/icon3.png" style="width: 20%" alt="">
                                <div class="text-ke">
                                    <h2><span id="jumlah_pasien"></span></h2>
                                    <p>Jumlah Pasien</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-3 col-md-6">
                            <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/icon6.png" style="width: 20%" alt="">
                                <div class="text-ke">
                                    <h2><span id="jumlah_pengajuan"></span></h2>
                                    <p>Jumlah Pengajuan SJP</p>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-3 col-md-6 end">
                            <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/icon5.png" style="width: 20%" alt="">
                                <div class="text-ke">
                                    <h2><span id="pengajuan_disetujui"></span></h2>
                                    <p>Jumlah SJP di Setujui</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div><!-- End Counts Section -->

            <br>
            <br>
            <div class="chart mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="shadow-sm p-3 mb-3 rounded">
                            <figure class="highcharts-figure">
                                <div id="pasien-daerah"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow-sm p-3 mb-3 rounded">
                            <figure class="highcharts-figure">
                                <div id="pasien-kelurahan"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow-sm p-3 mb-3 rounded">
                            <figure class="highcharts-figure">
                                <div id="pasien-keseluruhan"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow-sm p-3 mb-3 rounded">
                            <figure class="highcharts-figure">
                                <div id="pasien-pertahun"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
</main>