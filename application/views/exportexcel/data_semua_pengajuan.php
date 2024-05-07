<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <!-- <h4>Data Semua Pengajuan</h4> -->
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pasien</th>
            <th>No Kartu KIS</th>
            <th>NIK</th>
            <th>Nomor Kartu Keluarga</th>
            <th>Alamat Tempat Tinggal</th>
            <th>RT</th>
            <th>RW</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Hubungan</th>
            <th>Status Pernikahan</th>
            <th>Telepon Pasien</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key['nama_pasien']; ?></td>
                    <td style="mso-number-format:\@;"><?php echo $key['no_kis']; ?></td>
                    <td style="mso-number-format:\@;"><?php echo $key['nik']; ?></td>
                    <td style="mso-number-format:\@;"><?php echo $key['no_kk']; ?></td>
                    <td><?php echo $key['alamat']; ?></td>
                    <td><?php echo $key['rt']; ?></td>
                    <td><?php echo $key['rw']; ?></td>
                    <td><?php echo $key['kd_kelurahan']; ?></td>
                    <td><?php echo $key['kd_kecamatan']; ?></td>
                    <td><?php echo $key['tempat_lahir']; ?></td>
                    <td><?php echo $key['tanggal_lahir']; ?></td>
                    <td>
                        <?php if($key['jenis_kelamin'] == 'Laki-Laki') { ?>
                            1
                        <?php }elseif($key['jenis_kelamin'] == 'Perempuan'){ ?>
                            2
                        <?php }else{ ?>
                            Unknown
                        <?php }?>
                    </td>
                    <td><?php echo $key['id_hubungan']; ?></td>
                    <td><?php echo $key['id_pernikahan']; ?></td>
                    <td><?php echo $key['telepon']; ?></td>
                    <!-- <td><?php echo date_format(date_create($key['tanggal_pengajuan']), "d-m-Y"); ?></td> -->
                    <!-- <td>
                        <?php 
                        if ($key['kd_kecamatan'] == 'Bojongsari' || $key['kd_kecamatan'] == 'Beji' || $key['kd_kecamatan'] == 'Cimanggis' || $key['kd_kecamatan'] == 'Cinere' || $key['kd_kecamatan'] == 'Cipayung' || $key['kd_kecamatan'] == 'Limo' || $key['kd_kecamatan'] == 'Pancoran Mas' || $key['kd_kecamatan'] == 'Sawangan' || $key['kd_kecamatan'] == 'Sukmajaya' || $key['kd_kecamatan'] == 'Tapos' || $key['kd_kecamatan'] == 'Cilodong' || 
                            
                            $key['kd_kecamatan'] == 'BOJONGSARI' || $key['kd_kecamatan'] == 'BEJI' || $key['kd_kecamatan'] == 'CIMANGGIS' || $key['kd_kecamatan'] == 'CINERE' || $key['kd_kecamatan'] == 'CIPAYUNG' || $key['kd_kecamatan'] == 'LIMO' || $key['kd_kecamatan'] == 'PANCORAN MAS' || $key['kd_kecamatan'] == 'SAWANGAN' || $key['kd_kecamatan'] == 'SUKMAJAYA' || $key['kd_kecamatan'] == 'TAPOS' || $key['kd_kecamatan'] == 'CILODONG') {
                                echo 'Depok';
                            }else{
                                echo 'Non Depok';
                            }
                         ?>
                    </td> -->
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>