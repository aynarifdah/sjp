<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SJP</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendors.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">

    <style type="text/css">
        body {
            background-color: royalblue !important;
        }
    </style>
</head>

<body>
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-6 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div class="p-1">
                                <img src="<?php echo base_url('assets/images/logo sjp.png'); ?>"
                                    style="width: 50%; height: auto;">
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>Registrasi Akun</span>
                        </h6>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <?= $this->session->flashdata('pesan'); ?>

                            <form class="form-horizontal" method="POST"
                                action="<?= base_url('Register/proses_register') ?>">

                                <!-- CSRF Token -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                    value="<?= $this->security->get_csrf_hash(); ?>">

                                <!-- Username -->
                                <fieldset class="form-group position-relative has-icon-left mb-1">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Username (min 4 karakter)" required>
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                </fieldset>

                                <!-- Nama Lengkap -->
                                <fieldset class="form-group position-relative has-icon-left mb-1">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"
                                        required>
                                    <div class="form-control-position">
                                        <i class="ft-user-check"></i>
                                    </div>
                                </fieldset>


                                <!-- Password -->
                                <fieldset class="form-group position-relative has-icon-left mb-1">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password (min 6 karakter)" required>
                                    <div class="form-control-position">
                                        <i class="ft-lock"></i>
                                    </div>
                                </fieldset>

                                <!-- Instansi -->
                                <fieldset class="form-group position-relative has-icon-left mb-1">
                                    <select name="instansi" class="form-control" required>
                                        <option value="">-- Pilih Instansi --</option>
                                        <option value="1">Dinkes</option>
                                        <option value="2">Rumah Sakit</option>
                                        <option value="3">Masyarakat Umum</option>
                                        <option value="4">Dinsos</option>
                                        <option value="6">Kelurahan</option>
                                        <option value="7">Lainnya</option>
                                    </select>
                                    <div class="form-control-position">
                                        <i class="ft-home"></i>
                                    </div>
                                </fieldset>

                                <button type="submit" class="btn btn-info btn-lg btn-block">
                                    <i class="ft-user-plus"></i> Daftar
                                </button>

                                <div class="text-center mt-2">
                                    <a href="<?php echo base_url('Auth'); ?>" class="text-white">
                                        Sudah punya akun? Login di sini
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="<?php echo base_url('assets/vendors/js/vendors.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/core/app.js'); ?>"></script>
</body>

</html>