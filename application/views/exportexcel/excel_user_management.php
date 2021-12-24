<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1">
    <h4>Data User</h4>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Instansi</th>
            <th>Domisili</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataexcel)) {
            $no = 1;
            foreach ($dataexcel as $key) { ?>
                <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key['nama']; ?></td>
                    <td><?php echo $key['username']; ?></td>
                    <td><?php echo $key['nama_level']; ?></td>
                    <td><?php echo $key['nama_instansi']; ?></td>
                    <td><?php echo $key['nama_join']; ?></td>
                </tr>
        <?php $no++;
            }
        } ?>
    </tbody>
</table>