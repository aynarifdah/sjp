<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <h4>Data Persetujuan SJP</h4>
    <thead>
        <tr>
            <th>No.</th>
            <th>NIK</th>
            <th>Pasien</th>
            <th>Tanggal Pengajuan</th>
            <th>Jenis Jaminan</th>
            <th>Rumah Sakit</th>
            <th>Domisili</th>
            <th>Jenis Rawat</th>
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
                        if ($key['kd_kecamatan'] == 'Bojongsari' || $key['kd_kecamatan'] == 'Beji' || $key['kd_kecamatan'] == 'Cimanggis' || $key['kd_kecamatan'] == 'Cinere' || $key['kd_kecamatan'] == 'Cipayung' || $key['kd_kecamatan'] == 'Limo' || $key['kd_kecamatan'] == 'Pancoran Mas' || $key['kd_kecamatan'] == 'Sawangan' || $key['kd_kecamatan'] == 'Sukmajaya' || $key['kd_kecamatan'] == 'Tapos' || $key['kd_kecamatan'] == 'Cilodong' || 
                            
                            $key['kd_kecamatan'] == 'BOJONGSARI' || $key['kd_kecamatan'] == 'BEJI' || $key['kd_kecamatan'] == 'CIMANGGIS' || $key['kd_kecamatan'] == 'CINERE' || $key['kd_kecamatan'] == 'CIPAYUNG' || $key['kd_kecamatan'] == 'LIMO' || $key['kd_kecamatan'] == 'PANCORAN MAS' || $key['kd_kecamatan'] == 'SAWANGAN' || $key['kd_kecamatan'] == 'SUKMAJAYA' || $key['kd_kecamatan'] == 'TAPOS' || $key['kd_kecamatan'] == 'CILODONG') {
                                echo 'Depok';
                            }else{
                                echo 'Non Depok';
                            }
                         ?>
                    </td>
                    <td><?php echo $key['jenis_rawat']; ?></td>
                    <td><?php echo $key['status_pengajuan']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>