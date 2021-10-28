<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <h4>Data Disetujui SJP Baru</h4>
    <thead>
        <tr>
            <th>No.</th>
            <th>NIK</th>
            <th>Pasien</th>
            <th>Tanggal Pengajuan</th>
            <th>Jenis Jaminan</th>
            <th>Rumah Sakit</th>
            <th>Hari</th>
            <th>Status Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td style="mso-number-format:\@;"><?php echo $key['nik']; ?></td>
                    <td><?php echo $key['nama_pasien']; ?></td>
                    <td><?php echo date_format(date_create($key['tanggal_pengajuan']), "d-m-Y"); ?></td>
                    <td><?php echo $key['nama_jenis']; ?></td>
                    <td><?php echo $key['nm_rs']; ?></td>
                    <td>
                        <?php
                            $now = date("Y-m-d");
                            $tgl = date_format(date_create($key['tanggal_pengajuan']), "Y-m-d");
                            $date1 = date_create($tgl);
                            if ($key['tanggal_selesai'] == null) {
                              $date2 = date_create($now);
                            } else {
                              $date2 = date_create($key['tanggal_selesai']);
                            }
                            $diff = date_diff($date1, $date2);

                            echo $diff->format("%a Hari")
                        ?>
                    </td>
                    <td><?php echo $key['status_pengajuan']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>