<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <title>Halaman Tampil PDF</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tampilan PDF </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <?php if (!empty($getdokumenpersyaratan)) {
                    $i = 1;
                    foreach ($getdokumenpersyaratan as $att) { ?>
                        <div class="_df_book" webgl="true" backgroundcolor="gray" source="<?php echo base_url() ?>uploads/dokumen/<?php echo $att['attachment'] ?>" id="pdf_collections"></div>
                <?php }
                } ?>

            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/viewerPdf/js/libs/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/viewerPdf/js/dflip.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //  @if($content)
        //  @foreach($content as $item)
        if ($getgetdokumenpersyaratan) {
            array.forEach($getgetdokumenpersyaratan => {
                
                var NameFile = $getgetdokumenpersyaratan['attachment'];
            });
        }

        document.addEventListener('click', function(event) {
            const clickedElement = event.target;
            const flipbookElement = document.getElementById('pdf_collections');

            // Periksa apakah elemen yang diklik berada dalam elemen flipbook
            if (flipbookElement.contains(clickedElement)) {

                // Periksa apakah elemen yang diklik adalah elemen <a> atau elemen turunannya
                let linkElement = clickedElement.closest('a');

                // Periksa apakah elemen yang diklik memiliki class "ti-download" dan href menuju file PDF
                if (linkElement && linkElement.classList.contains('ti-download') && linkElement.getAttribute('href')
                    .endsWith('.pdf')) {
                    // Membatalkan aksi default dari tautan untuk mencegah navigasi ke halaman baru
                    event.preventDefault();

                    // Ambil URL file PDF dari atribut 'href'
                    const pdfURL = linkElement.getAttribute('href');

                    // Fungsi untuk mengunduh file PDF
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
    </script>
</body>

</html>