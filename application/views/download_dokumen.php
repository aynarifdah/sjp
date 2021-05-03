<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <title>Halaman Download Dokumen</title>
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">


    <style type="text/css">
        .table th {
            width: 10%;
        }

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

    <div class="card">
        <div class="card-head">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title">List Dokumen</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">


                <section id="configuration" style="padding: 10px;">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Data Test 1</td>
                                    <td><button class="btn btn-info"><i class="ft-download"> Download</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Data Test 2</td>
                                    <td><button class="btn btn-info"><i class="ft-download"> Download</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Data Test 3</td>
                                    <td><button class="btn btn-info"><i class="ft-download"> Download</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <style>
        .action-menu {
            width: 200px !important;
            height: auto;
        }

        /*#datatable_length{
  display: none;
}*/
        .p-l-15 {
            padding-left: 15px;
        }

        .p-r-15 {
            padding-right: 15px;
        }

        .filter {
            padding-right: 0px;
        }

        /*.table-responsive{
  overflow-x: hidden;
}*/
        .card-body {
            padding-top: 0px;
        }

        .picker__nav--prev:before {
            content: '<' !important;
        }

        .picker__nav--next:before {
            content: '>' !important;
        }

        @media (min-width: 992px) {
            .element {
                float: right !important;
            }
        }

        @media (max-width: 575.98px) {
            .element {
                text-align: center !important;
                padding-right: 0px;
            }

            .filter {
                padding-right: 15px;
                padding-bottom: 5px;
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">

    <script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>

    <!-- tambahan -->

    <script src="<?= base_url() ?>app-assets/vendors/js/tables/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/tables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/tables/responsive.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>app-assets/js/scripts/tables/datatables/date-eu.js" type="text/javascript"></script>

    <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/responsive.bootstrap.min.css">

    <!-- tambahan -->

    <script src="<?= base_url() ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">


</body>

</html>