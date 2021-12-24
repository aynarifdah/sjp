<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <h4>Data Semua Pengajuan</h4>
    <thead>
        <tr>
            <th>No.</th>
            <th>Pemohon</th>
            <th>Pasien</th>
            <th>Tanggal Pengajuan</th>
            <th>Rumah Sakit</th>
            <th>Status Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key['nama_pemohon']; ?></td>
                    <td><?php echo $key['nama_pasien']; ?></td>
                    <td><?php echo date_format(date_create($key['tanggal_pengajuan']), "d-m-Y"); ?></td>
                    <td><?php echo $key['nm_rs']; ?></td>
                    <td><?php echo $key['status_pengajuan']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>