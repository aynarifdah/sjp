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
            <th>Nama</th>
            <th>Nomor SJP</th>
            <th>Rumah Sakit</th>
            <th>Jenis Rawat</th>
            <th>Tanggal Tagihan</th>
            <th>Nominal Pengajuan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key['nama_pasien']; ?></td>
                    <td><?php echo $key['nomor_surat']; ?></td>
                    <td><?php echo $key['nm_rs']; ?></td>
                    <td><?php echo $key['jenis_rawat']; ?></td>
                    <td><?php echo date_format(date_create($key['tanggal_tagihan']), "d-m-Y"); ?></td>
                    <td><?php echo $key['nominal_klaim']; ?></td>
                    <td><?php echo $key['nama_statusklaim']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>