<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Halaman utama</title>
</head>


  

   <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Survey</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body">
                 <table class="table table-bordered table-striped">
                      <tbody>
                      <?php foreach ($pengajuan as $key => $value) {
                        $id = $value->id_sjp;
                        $status_sjp = $value->id_status_pengajuan;
                         ?>
                        <tr>
                          <th scope="row">
                            Nama Pasien
                          </th>
                          <td><?php echo $value->nama_pasien;?></td>
                        </tr>
                        <tr>
                          <th scope="row">
                            Alamat
                          </th>
                          <td><?php echo $value->alamat;?>, Kec
                              <?php echo $value->kd_kecamatan;?>, Kel
                              <?php echo $value->kd_kelurahan;?>, Rt/Rw
                              <?php echo $value->rt;?>
                              <?php echo $value->rw;?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            Tanggal Survey
                          </th>
                          <td><?php echo $value->tanggal_survey; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">
                            Surveyor
                          </th>
                          <td><?php echo $value->surveyor; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">
                            Catatan
                          </th>
                          <td>Sangat layak</td>
                        </tr>
                        <tr>
                          <th scope="row">
                            Hasil Rekomendasi
                          </th>
                          <td>12/15</td>
                        </tr>
                         <tr>
                          <th scope="row">
                            Status
                          </th>
                          <td><?php if (!empty($count_jawaban)) {
                           foreach ($count_jawaban as $key) {
                           if ($key['id_sjp'] == $id) {
                  // $var = count($survey);
                           if ($key['total'] < 12) {?>
                           <div class="badge bg-danger bg-darken-1 round" style="font-size: 14px;">Ditolak <i class="ft-check-circle"></i></div>
                           <?php }else{?>
                           <div class="badge bg-success bg-darken-1 round" style="font-size: 14px;">Disetujui <i class="ft-check-circle"></i></div>
                           <?php } } 
                          }  }?></td>
                        </tr>
                      <?php } ?>
                        
                      </tbody>
                    </table>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Variabel</th>
                          <th>Isi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Luas lantai bangunan</td>
                          <?php  foreach ($isi1 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban1 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan1;?></td>  -->
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jenis Lantai</td>
                          <?php  foreach ($isi2 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban2 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan2;?></td> -->
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Jenis dinding tempat tinggal</td>
                          <?php  foreach ($isi3 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban3 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan3;?></td> -->
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Fasilitas buang air</td>
                          <?php  foreach ($isi4 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban4 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan4;?></td> -->
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Sumber penerangan</td>
                          <?php  foreach ($isi5 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban5 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan5;?></td> -->
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Sumber air minum</td>
                          <?php  foreach ($isi6 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban6 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan6;?></td> -->
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Bahan bakar untuk memasak sehari-hari</td>
                          <?php  foreach ($isi7 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban7 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan7;?></td> -->
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Konsumsi lauk pauk</td>
                          <?php  foreach ($isi8 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban8 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan8;?></td> -->
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Kebutuhan pakaian</td>
                          <?php  foreach ($isi9 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban9 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan9;?></td> -->
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Kemampuan makan</td>
                          <?php  foreach ($isi10 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban10 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan10;?></td> -->
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Kesanggupan biaya pengobatan</td>
                          <?php  foreach ($isi11 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban11 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan11;?></td> -->
                        </tr>
                        <tr>
                          <td>12</td>
                          <td>Pendidikan kepala rumah tangga</td>
                          <?php  foreach ($isi12 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban12 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan12;?></td> -->
                        </tr>
                        <tr>
                          <td>13</td>
                          <td>Sumber penghasilan kepala rumah tangga</td>
                          <?php  foreach ($isi13 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban13 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan13;?></td> -->
                        </tr>
                        <tr>
                          <td>14</td>
                          <td>Kepemilikan tabungan</td>
                          <?php  foreach ($isi14 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban14 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan14;?></td> -->
                        </tr>
                        <tr>
                          <td>15</td>
                          <td>Statuskepemilikan rumah</td>
                          <?php  foreach ($isi15 as $key => $value) {?>
                          <td><?php echo $value->keterangan; ?></td>
                          <!-- <?php  } ?>
                          <?php if($jawaban15 == 'Setuju'){?>
                          <td><div class="state icheckbox_flat-green checked mr-1"></div></td>
                          <?php }else{ ?>
                            <td><div class="state icheckbox_flat-green  mr-1"></div></td>
                          <?php } ?>
                          <td><?php echo $catatan15;?></td> -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    <td><a href="<?php echo base_url('Cetak/cetak_survey_sjp/');?><?php echo $id;?>"><button type="button" class="btn mr-1 mb-1 btn-primary btn-sm"  style="float: right;">Cetak</button></td></a>
                    <?php if($this->session->userdata('level') == "3"){
                                if($status_sjp == "Disetujui"){}elseif($status_sjp == "Ditolak"){}else{
                      ?>
                    <!-- <td><a href="<?php echo base_url('Home/tolakSurvey/');?><?php echo $id;?>"><button type="button" class="btn mr-1 mb-1 btn-danger btn-sm"  style="float: right;">Tolak</button></td></a>
                    <td><a href="<?php echo base_url('Home/setujuiSurvey/');?><?php echo $id;?>"><button type="button" class="btn mr-1 mb-1 btn-success btn-sm"  style="float: right;">Setujui</button></td></a> -->
                    <?php }} ?>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
  </div>
</div>
  
 
</body>
</html>