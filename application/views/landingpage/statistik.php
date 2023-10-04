<main class="main" id="main">
        <section id="statistik" class="statistik">
          
                <div class="statistiksec text-center border-bottom mb-5 aos-init aos-animate" data-aos="">
                    <h2>Statistik<span class="span"> SJP</span></h2>
                    <div class="breadcrumb aos-init aos-animate d-flex justify-content-center" data-aos="">
                      <nav style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);" aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Statistik</li>
                          </ol>
                      </nav>
                  </div>
                </div>
                
                
                <div class="container">
                <div class="filter mb-3" data-aos="">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Kecamatan</option>
                                <option value="1">Cilodong</option>
                                <option value="2">Pancoranmas</option>
                                <option value="3">Cinere</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Kelurahan</option>
                                <option value="1">Jatimulya</option>
                                <option value="2">Pancoranmas</option>
                                <option value="3">Cinere</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>RW</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>RT</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>

                <!-- KEKERASAN  WIDGET -->
                <div id="counts about" class="counts about">
                    <div class="container" data-aos="">

                        <div class="row gy-4 mb-3">

                            <div class="col-lg-3 col-md-6 kasus">
                                <h2>Dashboard<span class="span"> Sistem Jaminan</span> Pelayanan</h2>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/kekerasan-fisik.png" style="width: 30%" alt="">
                                <div class="text-ke">
                                    <!-- <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span> -->
                                    <p>Jumlah Pasien</p>
                                </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/kekerasan-mental.png" style="width: 30%" alt="">
                                <div class="text-ke">
                                    <!-- <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span> -->
                                    <p>Jumlah Pengajuan SJP</p>
                                </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 end">
                                <div class="count-box">
                                <img src="<?= base_url('assets-web') ?>/img/icon/kekerasan-seksual.png" style="width: 30%" alt="">
                                <div class="text-ke">
                                    <!-- <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span> -->
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
                    </div>
                </div>


                
            </div>
        </section>
    </main>