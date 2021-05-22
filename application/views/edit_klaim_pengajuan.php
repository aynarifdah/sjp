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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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
                                                        <div class="col-lg-6 col-md-9 col-12">
                                                            <input class="form-control mt-2" type="file" name="dokumen[]" id="dokumen">
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



<script type="text/javascript">
    $('.skin-polaris input').iCheck({
        checkboxClass: 'icheckbox_polaris',
        increaseArea: '-10%'
    });
    // Multiple Select Placeholder
    function diagnosa2() {
        $('.kd_diagnosa').select2({
            placeholder: "Pilih penyakit",
        });
    }
    $(".select2").select2();
    $(document).ready(function() {
        //getkelurahan();
        diagnosapenyakit();
        diagnosa2();
        // $('.diagnosalainnya').hide();
    });
    $('#kd_kecamatanpemohon').change(function() {
        getkelurahan();
    })

    function getkelurahan() {
        var data = $('#kd_kecamatanpemohon').val();
        $.ajax({
            url: "<?= base_url(); ?>/Home/getKelurahan",
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
    // $('.checkbox').on('ifChecked', function (event) {
    //   $('.diagnosalainnya').show();
    // });

    // $('.checkbox').on('ifUnchecked', function (event) {
    //   $('.diagnosalainnya').hide();
    // });
    $('.add').click(function(argument) {
        diagnosapenyakit();
        diagnosa2();
        $('.skin-polaris input').iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
    });

    function diagnosapenyakit() {
        $('.diagnosapenyakit').each(function(index) {
            $('.kd_topik').select2({
                placeholder: "Pilih Topik"
            }).eq(index).on('select2:select', function(evt) {
                var data = $(this).val();
                $.ajax({
                    url: "<?= base_url(); ?>/Home/getDiagnosa",
                    method: "POST",
                    data: {
                        id: data
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '<option>Pilih Diagnosa</option>';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
                        }
                        $('.kd_diagnosa').eq(index).html(html);

                    }
                });
            });
        });
    }
    //  $('.add').click(function() {
    //       $('.kd_topik').each(function(index) {
    //         //console.log(index)
    //   $('.kd_topik').eq(index).change(function(){

    // })
    // })
    //  })


    function getdiagnosa() {
        var data = $('#kd_topik').val();
        $.ajax({
            url: "<?= base_url(); ?>/Home/getDiagnosa",
            method: "POST",
            data: {
                id: data
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '<option>Pilih Diagnosa</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value = "' + data[i].namadiag + '">' + data[i].namadiag + '</option>';
                }
                $('#kd_diagnosa').html(html);

            }
        });
    }
    $('#kd_kecamatanpasien').change(function() {
        getkelurahanpasien();
    })

    function getkelurahanpasien() {
        var data = $('#kd_kecamatanpasien').val();
        $.ajax({
            url: "<?= base_url(); ?>/Home/getKelurahan",
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
                    html += '<option value = "' + data[i].kelurahan.toUpperCase() + '">' + data[i].kelurahan.toUpperCase() + '</option>';
                }
                $('#kd_kelurahanpasien').html(html);

            }
        });
    }
    // $('#simpanpengajuan').click(function() {
    //   var tes = $('.sjpform').serialize();
    //   console.log(decodeURIComponent(tes));
    // })
    $('#nik').change(function() {
        var nik = $(this).val();
        $.ajax({
            url: "getDataByNIK/" + nik,
            type: 'GET',
            beforeSend: function() {
                $('#loader_form').show();
            },
            complete: function() {
                $('#loader_form').hide();
            },
            success: function(data) {
                var json_data = JSON.parse(data);
                var api_data = json_data.content[0];
                let jk = api_data.JENIS_KLMIN;
                let kecPasien = api_data.KEC_NAME;
                let kelPasien = api_data.KEL_NAME;
                console.log(kelPasien);
                if (api_data.hasOwnProperty('RESPONSE_CODE')) {
                    alert(api_data.RESPONSE_DESC + '. Masukkan data secara manual');
                } else {
                    $('#namapasien').val(api_data.NAMA_LGKP);
                    // $('#nama_kepala_keluarga').val(api_data.NAMA_LGKP_AYAH);
                    $('#tanggallahirpasien').val(api_data.TGL_LHR);
                    $('#tempatlahirpasien').val(api_data.TMPT_LHR);
                    $('#pekerjaanpasien').val(api_data.JENIS_PKRJN);
                    $('#alamatpasien').val(api_data.ALAMAT);
                    $('#rtpasien').val(api_data.NO_RT);
                    $('#rwpasien').val(api_data.NO_RW);
                    $("#" + api_data.AGAMA).attr('selected', true);

                    $('#jeniskelaminkpasien').val(jk);
                    $('#kd_kecamatanpasien').val(kecPasien).trigger('change');
                    $('#kd_kelurahanpasien').val(kelPasien).trigger('change');
                    // $('#Kecamatan').remove();
                    // $('#kec_section').append('<input type="text" name="kecamatan" id="kecamatan" class="form-control" value="' + api_data.KEC_NAME + '">');
                    // var kelurahan = '';
                    // kelurahan += '<div class="form-group row kecamatan_value">';
                    // kelurahan += '<label class="col-sm-3 col-form-label">Kelurahan</label>';
                    // kelurahan += '<div class="col-sm-9">';
                    // kelurahan += '<div class="input-group mb-2">';
                    // kelurahan += '<div class="input-group-prepend">';
                    // kelurahan += '<div class="input-group-text">';
                    // kelurahan += '<i class="fa fa-map-marker" aria-hidden="true"></i>';
                    // kelurahan += '</div>';
                    // kelurahan += '</div>';
                    // kelurahan += '<input type="text" name="kelurahan" id="kelurahan" class="form-control" value="' + api_data.KEL_NAME + '">';
                    // kelurahan += '</div>';
                    // kelurahan += '</div>';
                    // kelurahan += '</div>';
                    // $('#kecamatan_value').append(kelurahan);
                }
                // console.log(api_data);
            },
        });



    });
    // TEST 04-02-2021


    // TANGGAL LAHIR PASIEN
    $('#tanggallahirpasien').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    // TANGGAL LAHIR PASIEN
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });


    $("select#jenisrawat").change(function() {
        var selected = $(this).children("option:selected").val();
        // console.log(selected);
        if (selected == 'Rawat Inap') {

            $('#mulairawat').on("change", function() {
                var mulairawat = $("#mulairawat").val().split("-");
                var d = new Date(mulairawat[2], mulairawat[1] - 1, mulairawat[0]);
                d.setDate(d.getDate() + 30);
                var endDateStr = ("0" + d.getDate()).slice(-2) + '-' + (d.getMonth() + 1) + '-' + (d.getYear() + 1900);
                console.log(endDateStr);
                var akhirrawat = $('#akhirrawat').val(endDateStr);

            });

        } else {

            $('#mulairawat').on("change", function() {
                var mulairawat = $("#mulairawat").val().split("-");
                var d = new Date(mulairawat[2], mulairawat[1] - 1, mulairawat[0]);
                d.setDate(d.getDate() + 14);
                var endDateStr = ("0" + d.getDate()).slice(-2) + '-' + (d.getMonth() + 1) + '-' + (d.getYear() + 1900);
                console.log(endDateStr);
                var akhirrawat = $('#akhirrawat').val(endDateStr);
            });

        }
    });

    // TEST 04-02-2021
</script>