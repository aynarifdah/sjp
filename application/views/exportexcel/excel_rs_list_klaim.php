<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <h4>Data Pengajuan Klaim</h4>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pasien</th>
            <th>Nama Pemohon</th>
            <th>Nomor Surat</th>
            <th>Tanggal Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key['nama_pasien']; ?></td>
                    <td><?php echo $key['nama_pemohon']; ?></td>
                    <td><?php echo $key['nomor_surat']; ?></td>
                    <td><?php echo date_format(date_create($key['tanggal_pengajuan']), "d-m-Y"); ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>