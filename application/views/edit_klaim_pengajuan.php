<section id="number-tabs">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Edit Klaim Pengajuan</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <?php if (!empty($id_sjp) && !empty($id_pengajuan)) : ?>
                            <form action="<?php echo base_url('Rs/proses_edit_klaim_pengajuan/' . $id_sjp . '/' . $id_pengajuan); ?>" method="POST" enctype="multipart/form-data" class="wpcf7-form sjpform" id="sjpform">
                                <fieldset>
                                    <?php if (!empty($riwayatpengajuan)) : ?>
                                        <?php foreach ($riwayatpengajuan as $val) : ?>
                                            <fieldset class="mt-2">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 label-control" for="nomor_tagihan">Nomor Tagihan</label>
                                                    <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                                                        <input type="text" class="form-control" placeholder="Nomor Tagihan" name="nomor_tagihan" id="nomor_tagihan" value="<?= $val['nomor_tagihan'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 label-control" for="nominal_klaim">Nominal Pengajuan</label>
                                                    <div class="col-lg-6" style="padding: 0px 15px 5px 15px;">
                                                        <input type="text" class="form-control" placeholder="Nominal Pengajuan" name="nominal_klaim" id="nominal_klaim" value="<?= $val['nominal_klaim'] ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Dokumen-dokumen -->
                                                <?php

                                                $extensions_nama_file = pathinfo(base_url('uploads/dokumen/') . $val['namafile'], PATHINFO_EXTENSION);
                                                $extensions_file_resume = pathinfo(base_url('uploads/dokumen/') . $val['file_resume'], PATHINFO_EXTENSION);
                                                $extensions_other_files = pathinfo(base_url('uploads/dokumen/') . $val['other_files'], PATHINFO_EXTENSION);

                                                ?>
                                                <?php if ($extensions_nama_file == "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url() ?>assets/images/pdf.png" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['namafile']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['namafile'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($extensions_file_resume == "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url() ?>assets/images/pdf.png" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['file_resume']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['file_resume'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($extensions_other_files == "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url() ?>assets/images/pdf.png" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['other_files']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['other_files'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>


                                                <?php if ($extensions_nama_file !== "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url('uploads/dokumen/') . $val['namafile'] ?>" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['namafile']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['namafile'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($extensions_file_resume !== "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url('uploads/dokumen/') . $val['file_resume'] ?>" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['file_resume']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['file_resume'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($extensions_other_files !== "pdf") : ?>
                                                    <div class="form-group row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                <img class="mx-auto d-block example-image" style="width: 50%; height: auto;" src="<?php echo base_url('uploads/dokumen/') . $val['other_files'] ?>" alt="" />
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-9 col-12 mt-1">
                                                            <p class="mb-0"><?= $val['other_files']; ?></p>
                                                            <input class="form-control" type="file" name="dokumen[]" id="dokumen">
                                                            <input type="hidden" name="dokumen_hidden[]" value="<?= $val['other_files'] ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </fieldset>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary btn-md" id="simpanpengajuan" style="float: right;">
                                        <i class="ft-check-square"></i> Submit
                                    </button>
                                </fieldset>


                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- </div>
</div> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css"> -->

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />