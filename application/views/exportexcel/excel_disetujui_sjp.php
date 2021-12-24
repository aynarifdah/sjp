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
            <th>Jam</th>
            <th>Domisili</th>
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
                        $now = date_format(date_create($key['tanggal_selesai']), "Y-m-d h:i:s");
                        $tgl = date_format(date_create($key['tanggal_pengajuan']), "Y-m-d h:i:s");
                        $date1 = date_create($tgl);
                        if ($key['tanggal_selesai'] == null) {
                        $date2 = date_create($now);
                        } else {
                        $date2 = date_create($key['tanggal_selesai']);
                        }
                        // $diff = date_diff($now, $tgl);

                        $stro1 = strtotime($now);

                        $stro2 = strtotime($tgl);

                        echo $jam = round(($stro1 - $stro2)/(60 * 60));
                        ?>
                        Jam
                    </td>
                    <td>
                        <?php 
                        if ($key['kd_kecamatan'] == 'Bojongsari' || $key['kd_kecamatan'] == 'Beji' || $key['kd_kecamatan'] == 'Cimanggis' || $key['kd_kecamatan'] == 'Cinere' || $key['kd_kecamatan'] == 'Cipayung' || $key['kd_kecamatan'] == 'Limo' || $key['kd_kecamatan'] == 'Pancoran Mas' || $key['kd_kecamatan'] == 'Sawangan' || $key['kd_kecamatan'] == 'Sukmajaya' || $key['kd_kecamatan'] == 'Tapos' || $key['kd_kecamatan'] == 'Cilodong' || 
                            
                            $key['kd_kecamatan'] == 'BOJONGSARI' || $key['kd_kecamatan'] == 'BEJI' || $key['kd_kecamatan'] == 'CIMANGGIS' || $key['kd_kecamatan'] == 'CINERE' || $key['kd_kecamatan'] == 'CIPAYUNG' || $key['kd_kecamatan'] == 'LIMO' || $key['kd_kecamatan'] == 'PANCORAN MAS' || $key['kd_kecamatan'] == 'SAWANGAN' || $key['kd_kecamatan'] == 'SUKMAJAYA' || $key['kd_kecamatan'] == 'TAPOS' || $key['kd_kecamatan'] == 'CILODONG') {
                                echo 'Depok';
                            }else{
                                echo 'Non Depok';
                            }
                         ?>
                    </td>
                    <td><?php echo $key['status_pengajuan']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>