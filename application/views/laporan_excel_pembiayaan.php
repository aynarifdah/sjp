<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="datatable" class="table table-bordered" style="cursor:pointer;" border="1" >
          <thead>
            <tr>
              <!-- <th><div class="skin skin-polaris check-all"><input type="checkbox" id="check-all"></div></th> -->
              <th>No</th>
              <th>Nama Pasien</th>
              <th>NIK</th>
              <th style="width: 50px;">Alamat</th>
              <th>Fasilitas <br>Kesehatan</th>
              <th>Diagnosa</th>
              <th>Jumlah (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($dataklaim)) {
            	$no = 1;
              foreach ($dataklaim as $key) {?> 
            <tr>
            	<td><?php echo $no; ?>.</td>
              <td><?php echo $key['nama_pasien']; ?></td>
              <td><?php echo $key['nik']; ?></td>
              <td><?php echo $key['alamatpasien']; ?>
                
              </td>
              <td><?php echo $key['nm_rs']; ?></td>
              <td><?php if (!empty($penyakit)) {
                    foreach ($penyakit as $keypenyakit) { 
                      if ($key['id_sjp'] == $keypenyakit['id_sjp']) {?>
                      
                        <li>- <?php echo $keypenyakit['namadiag']; ?></li>
                     
                    <?php } }
                  } ?></td>
              <td><?php echo $key['nominal_klaim']; ?></td>
            </tr>

            <?php $no++; }
            } ?> 
          </tbody>
        </table>