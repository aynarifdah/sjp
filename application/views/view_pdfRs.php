<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <title>Halaman Tampil PDF</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
                <?php foreach ($pengajuan_sjp as $key) { ?>
                    <a href="<?php echo base_url($controller); ?>/detail_pengajuan/<?= $key['id_sjp'] ?>/<?= $key['id_pengajuan'] ?>" data-action="collapse" class="btn btn-danger text-white" style="padding: 8px 10px;
                    margin-bottom: 20px;">Kembali</a>
                <?php } ?>
            <h4 class="card-title">Tampilan PDF </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
            <div class="heading-elements">
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                    <?php foreach ($pengajuan_sjp as $att) :?>
                        <div class="namafile"></div>
                    <?php endforeach; ?>
                    <?php foreach ($pengajuan_sjpFileResume as $att) :?>
                        <div class="file_resume"></div>
                    <?php endforeach; ?>
                    <?php foreach ($pengajuan_sjpOtherFiles as $att) :?>
                        <div class="other_files"></div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/viewerPdf/js/libs/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/viewerPdf/js/dflip.min.js" type="text/javascript"></script>
    <script type="text/javascript">

    function getDataIdFromUrl() {
        var urlParams = new URLSearchParams(window.location.search);
        var dataId = urlParams.get('file');
        return dataId;
    }

// $(document).ready(function () {
    var dataId = getDataIdFromUrl();
    console.log(dataId);

    if (dataId === 'namafile') {
        var pdfElement = '<div class="_df_book" webgl="true" backgroundcolor="gray" source="<?php echo base_url() ?>uploads/dokumen/<?php echo $att['namafile'] ?>" id="pdf_collections<?php echo $att['namafile'] ?>"></div>';
        $('.namafile').append(pdfElement);
    } else if (dataId === 'file_resume') {
        var pdfElement = '<div class="_df_book" webgl="true" backgroundcolor="gray" source="<?php echo base_url() ?>uploads/dokumen/<?php echo $att['file_resume'] ?>" id="pdf_collections<?php echo $att['file_resume'] ?>"></div>';
        $('.file_resume').append(pdfElement);
    } else if (dataId === 'other_files') {
        var pdfElement = '<div class="_df_book" webgl="true" backgroundcolor="gray" source="<?php echo base_url() ?>uploads/dokumen/<?php echo $att['other_files'] ?>" id="pdf_collections<?php echo $att['other_files'] ?>"></div>';
        $('.other_files').append(pdfElement);
    } 

    document.addEventListener('click', function(event) {
        const clickedElement = event.target;
        const flipbookElement = document.getElementById('pdf_collections');

        if (flipbookElement.contains(clickedElement)) {

            let linkElement = clickedElement.closest('a');

            if (linkElement && linkElement.classList.contains('ti-download') && linkElement.getAttribute('href')
                .endsWith('.pdf')) {
                event.preventDefault();

                const pdfURL = linkElement.getAttribute('href');

                function downloadFile(pdfURL) {
                    return fetch(pdfURL)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.blob();
                        })
                        .then(blob => {
                            const blobURL = URL.createObjectURL(blob);
                            const link = document.createElement('a');
                            link.href = blobURL;
                            link.setAttribute('download', NameFile);
                            link.click();
                            URL.revokeObjectURL(blobURL);
                        })
                        .catch(error => console.error(error));
                }

                // Menjalankan fungsi unduh
                downloadFile(pdfURL);
            }
        }
    });

    // Mendapatkan nilai data-id dari URL

    // });

    </script>
</body>

</html>