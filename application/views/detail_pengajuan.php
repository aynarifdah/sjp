 <!DOCTYPE html>
 <html class="loading" lang="en" data-textdirection="ltr">
 <head>
  <title>Halaman pengajuan SJP</title>
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">


<div class="card">
  <div class="card-header">
    <h4 class="card-title">Detail Pengajuan</h4>
    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
    <div class="heading-elements">
      <ul class="list-inline mb-0">
        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
        <li><a data-action="close"><i class="ft-x"></i></a></li>
      </ul>
    </div>
  </div>
  <div class="card-content collapse show">
    <div class="card-body">
      <?php if (!empty($datapermohonan)) {
        foreach ($datapermohonan as $key) { $id_sjp = $key['id_sjp']; $id_pengajuan = $key['id_pengajuan'];?>
        <div class="row">
          <div class="col-lg-4 col-12">
            <div class="text-center">
              <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="rounded-circle img-border mb-1" alt="avatar" style="width: 105px">
              <h4 class="text-center"><strong><?php echo strtoupper($key['nama_pasien']); ?></strong></h4>
              <ul class="list-inline list-inline-pipe">
                <i class="ft-phone-call"></i> &nbsp;&nbsp;
                <li><a href="tel:02192729182"><?php echo $key['telepon']; ?></a> (Telp)</li>
                <li><a href="tel:081982798273"><?php echo $key['whatsapp']; ?></a> (WA)</li>
              </ul>
            </div>

          </div>
          <div class="col-lg-8 mt-0 col-12">
           <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
                <tr>
                  <th scope="row"  class="border-top-0">Tanggal Pengajuan</th>
                  <td class="border-top-0"><?php echo date_format(date_create($key['tanggal_pengajuan']),"d-m-Y") ?>&nbsp;&nbsp;&nbsp;
                    <?php if ($key['id_status_pengajuan'] == 1) {
                     echo '<div class="badge bg-blue-grey" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                   }elseif ($key['id_status_pengajuan'] == 2) {
                    echo '<div class="badge bg-info" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif ($key['id_status_pengajuan'] == 3) {
                    echo '<div class="badge bg-primary" style="font-size: 14px;">'.$key['status_pengajuan'].' <i class="ft-x"></i></div>';
                  }elseif($key['id_status_pengajuan'] == 4){
                    echo '<div class="badge bg-warning" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 5){
                    echo '<div class="badge bg-warning" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 6){
                    echo '<div class="badge bg-success bg-darken-1" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 7){
                    echo '<div class="badge bg-danger bg-darken-1" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  } ?>
                  
                  <?php
                  $now = date("Y-m-d");
                  $tgl = date_format(date_create($key['tanggal_pengajuan']),"Y-m-d");
                  $date1=date_create($tgl);
                   // echo $now, $key['tanggal_pengajuan'];
                  if ($key['tanggal_selesai'] == null) {
                    $date2=date_create($now);
                    $diff=date_diff($date1,$date2);
                    ?>
                    <div class="badge bg-secondary bg-darken-1" style="font-size: 14px; margin: 0px 0px 5px 0px;">
                      <?php echo $diff->format("%a Hari");
                    }
                    ?>
                  </div>
                  <div class="badge bg-info bg-darken-1" style="font-size: 14px;cursor: pointer;" data-toggle="modal" data-target="#riwayatProses">Riwayat Proses</div>
                </td>
              </tr>
              <?php if (!empty($key['tanggal_selesai'])) {?>
              <tr>
                <th scope="row"  class="border-top-0">Tanggal Selesai</th>
                <td class="border-top-0"><?php echo date_format(date_create($key['tanggal_surat']),"d-m-Y"); ?>
                 <div class="badge bg-secondary bg-darken-1" style="font-size: 14px;">
                  <?php
                  $now = date("Y-m-d");
                  $tgl = date_format(date_create($key['tanggal_pengajuan']),"Y-m-d");
                  $date1=date_create($tgl);
                  if ($key['tanggal_selesai'] == null) {
                    $date2=date_create($now);
                  }else{
                    $date2=date_create($key['tanggal_selesai']);
                  }
                  $diff=date_diff($date1,$date2);

                  echo $diff->format("%a Hari")
                  ?>
                </div>
              </td>
            </tr>
            <?php } ?>
 
           
            <tr>
              <th scope="row">Anggaran</th>
              <td class="text"><span class="angggaran"><?php if ($anggaran) {
                    foreach ($anggaran as $keyanggaran) {?>

                     <?= number_format($keyanggaran['nominal_anggaran']); ?>

                    <?php }
                  } ?></span>&nbsp;&nbsp;<span class="limit badge bg-success bg-darken-1 round" style="font-size: 14px;">Limit : <span class="nomlimit"><?php 
$a =  $keyanggaran['nominal_anggaran']; 
$b =  $key['nominal_pembiayaan'];
//Operator pengurangan variabel a dengan variabel b
echo $a - $b;
?></span></span></td>
            </tr>
            
             <!--  <tr>
                <th scope="row">Sisa Anggaran</th>
                <td class="text">150.000.000</td>
              </tr> -->
              <?php if (!empty($key['tanggal_survey'])) {?>
              <tr>
                <th scope="row">Hasil Survey</th>
                <td><h5><strong><span class="hasil"></span><span>/</span><span class="persyaratan"></span>&nbsp;&nbsp;<span class="kethasil"></span>&nbsp;<i class="iconhasil"></i></strong></h5></td>
              </tr>
              <tr>
                <th scope="row">Surveyor</th>
                <td><?= $key['surveyor']; ?> <strong>(<?php echo date_format(date_create($key['tanggal_survey']),"d-m-Y") ?>)</strong></td>
              </tr>
              <?php } ?>
              <!-- <?php echo $this->session->userdata('instansi'); echo $key['id_status_pengajuan']; echo $key['status_klaim']; ?> -->
              <?php if ($this->session->userdata('instansi') == 1 && $key['id_status_pengajuan'] == 6 && $key['status_klaim'] == 2) {?>
              <tr>
                <th scope="row">Nominal Klaim</th>
                <td><?= number_format($key['nominal_klaim']); ?></td>
              </tr>
              <?php } ?>
              <tr>
                <th scope="row">Nominal Pembiayaan</th>
                <?php if ($this->session->userdata('instansi') == 1 && $key['id_status_pengajuan'] == 6 && $key['nominal_pembiayaan'] == null && $key['status_klaim'] == 2) {?>
                <td>
                  <input type="number" class="form-control tambahnominal" >
                  <input type="hidden" class="id_sjpval" value="<?= $key['id_sjp']; ?>">
                   
                </td>
                <?php  }else{?>
                <td><?= number_format($key['nominal_pembiayaan']); ?>&nbsp;&nbsp;
                  <?php if ($key['status_klaim'] == 1) {
                    echo '<div class="badge bg-blue-grey" style="font-size: 14px;">'.$key['nama_statusklaim'].'  </div>';
                  }elseif ($key['status_klaim'] == 2) {
                    echo '<div class="badge bg-info" style="font-size: 14px;">'.$key['nama_statusklaim'].'  </div>';
                  }elseif ($key['status_klaim'] == 3) {
                    echo '<div class="badge bg-warning" style="font-size: 14px;">'.$key['nama_statusklaim'].'<i class="ft-alert-triangle"></i></div>';
                  }else{
                    echo '<div class="badge bg-success" style="font-size: 14px;">'.$key['nama_statusklaim'].'  </div>';
                  }?>
                </td>
                <?php } ?>
              </tr>
              
            </tbody>
          </table>
        </div>

    
        <!-- Tombol -->
         <div class="float-right mt-2">
            <?php if ($this->session->userdata('instansi') == 3): ?>
              <a href="<?php echo base_url($controller.'edit_data_pasien/'.$this->uri->segment(3).'/'.$this->uri->segment(4) )?>"><button type="button" class="btn btn-dark btn-sm float-right"><i class="ft-edit"></i>&nbsp;Edit Profile Pasien</button></a>
            <?php endif ?>
          </div>
        <div class="float-right mt-2">
          <?php if ($this->session->userdata('instansi') == 3 && empty($key['tanggal_survey']) ) {?>
          <a href="<?php echo base_url($controller.'siap_survey/'.$key['id_sjp'].'/'.$key['id_pengajuan']); ?>" class="btn btn-secondary btn-sm float-right" style="margin-left: 5px; color: #fff; "><i class="ft-zoom-in"></i>&nbsp;Survey Tempat Tinggal</a>
          <?php } ?>
          <?php if ($this->session->userdata('instansi') == 4 && ($key['id_status_pengajuan'] == 6 || $key['id_status_pengajuan'] == 7)) {?>
          <a href="<?php echo base_url($controller.'permohonan_sjp')?>" class="btn btn-secondary btn-sm text-center"><i class="ft-credit-card"></i>&nbsp;Tambah Pengajuan</a>
          <?php }?>
          <?php if ($this->session->userdata('instansi') == 1 && $key['id_status_pengajuan'] == 6 && $key['status_klaim'] == 2) {?>
          <button type="button" class="btn btn-secondary btn-sm text-center submitnominal"> Submit Nominal</button>
          <?php }?>
          <?php if ($this->session->userdata('instansi') == 1 && $key['id_status_pengajuan'] == 6 && $key['status_klaim'] == 3) {?>
          <a href="<?php echo base_url();?>Dinkes/updatestatbayar?get=<?php echo $key['id_sjp']?>" class="btn btn-secondary btn-sm text-center updatestatbayar"> Update Status Bayar</a>
          <?php }?>
          <?php  if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1 && $key['id_status_pengajuan'] == 4) {?>
          <button type="button" class="btn btn-secondary btn-sm text-center proses_sjp" data-toggle="modal"
          data-target="#default"> Proses SJP</button>

        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Upload dokumen Persyaratan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="form" action="<?= base_url(); ?>Dinkes/uploadDokPersyaratan/<?= $key['id_pengajuan']; ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <center><img src="https://increasify.com.au/wp-content/uploads/2016/08/default-image.png" class="img-responsive img-center col-sm-6" alt="img" id="showimages"></center>
                  <p class="text-center img-center mt-1">Surat Keterangan Miskin</p>
                  
                  <center>
                    <button class=" img-center btn btn-light" type="button">
                    <input type="file" name="file" id="inputimages">
                  </button>
                </center>
                <br>
                <div class="form-group">
                <label for="">Status Pengajuan</label>
                <select name="status_pengajuan" class="form-control" required="">
                 
                  <option value="">Status Pengajuan</option>
                  <option value="6">Ajukan Ke Yankesru</option>
                  <option value="7">Tolak Pengajuan</option>
                </select>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn-sm btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn-sm btn btn-outline-primary" onclick="return confirm('Apakah anda yakin? Pengajuan yang sudah disubmit akan langsung dikirim ke Kepala Seksi Yankesru untuk diminta persetujuan. Dan tidak dapat di ubah kembali.')">Submit </button>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
      <?php }elseif ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 2  && $key['id_status_pengajuan'] == 5) {?>
      <button type ="button" class="btn btn-secondary btn-sm text-center" data-toggle="modal" data-target="#setujuipengajuan"><i class="ft-check"></i>&nbsp;Proses SJP</button>

      <div class="modal fade text-left" id="setujuipengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Formulir Persetujuan </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form" action="<?= base_url(); ?>Dinkes/approvesjp/<?= $key['id_sjp'].'/'.$key['id_pengajuan']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group"> 
                <label for="">Tanggal Persetujuan</label>
                <input type="date" class="form-control" name="tgl_persetujuan" required="">
              </div>
              <div class="form-group"> 
                <label for="">Status Pengajuan</label>
                <select name="status_pengajuan" class="form-control" required="">
                  <option value="">Status Pengajuan</option>
                  <option value="6">Disetujui</option>
                  <option value="7">Ditolak</option>
                </select>
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn-sm btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-sm btn btn-outline-primary"  onclick="return confirm('Apakah anda yakin akan menyetujui pengajuan ini?. Pengajuan yang sudah disubmit tidak dapat diubah kembali')">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php }elseif ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1 && ($key['id_status_pengajuan'] == 6 && $key['id_status_pengajuan'] != 7))  {?>
    <!-- <div class="btn  btn-secondary btn-sm" onclick="logCetak()"><i class="ft-printer"></i> Cetak SJP</div> -->
    <a class="btn  btn-secondary btn-sm" href="<?php echo base_url('Dinkes/CetakTest/'.$key['id_sjp']); ?>"><i class="ft-printer">Cetak SJP</i></a>
    <?php } ?>
  </div>
</div>
<div class="col-lg-12 mt-2 ml-1" style="padding: 0px;">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active tabpenyewa" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1"
      href="#tabIcon1" aria-expanded="true"><i class="ft-user"></i> Profil Pasien</a>
    </li>
        <li class="nav-item">
          <a class="nav-link tabdetail" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2"
          href="#tabIcon2" aria-expanded="false"><i class="ft-clipboard"></i> Diagnosa</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link tabdetail" id="baseIcon-tab4" data-toggle="tab" aria-controls="tabIcon4"
          href="#tabIcon4" aria-expanded="false"><i class="ft-clipboard"></i> Hasil Survey</a>
        </li>
        <li class="nav-item">
          <a class="nav-link tabdetail" id="baseIcon-tab5" data-toggle="tab" aria-controls="tabIcon5"
          href="#tabIcon5" aria-expanded="false"><i class="ft-clipboard"></i> Dokumen Persyaratan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link tabdetail" id="baseIcon-tab3" data-toggle="tab" aria-controls="tabIcon3"
          href="#tabIcon3" aria-expanded="false"><i class="ft-activity"></i> Riwayat Pengajuan</a>
        </li>
      </ul>
      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active panelpenyewa" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
          <table class="table" style="width: 100%;">
            <div class="row">
              <h5>informasi pasien</h5>
            </div>
            <tbody>
              <tr>
                <th scope="row" class="border-top-0">NIK</th>
                <td class="border-top-0"><?php echo $key['nik']; ?></td>
              </tr>
              <tr>
                <th scope="row" class="border-top-0">Nama Pasien</th>
                <td class="border-top-0"><?php echo strtoupper($key['nama_pasien']); ?></td>
              </tr>
              <tr>
                <th scope="row">Tempat/ Tanggal Lahir</th>
                <td><?php echo strtoupper($key['tempat_lahir']); ?>, <?php echo strtoupper($key['tanggal_lahir']); ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td><?php echo strtoupper($key['alamat']); ?>, KEC. <?php echo strtoupper($key['kd_kecamatan']); ?>, KEL. <?php echo strtoupper($key['kd_kelurahan']); ?>, RT/RW : <?php echo strtoupper($key['rt']); ?>/<?php echo strtoupper($key['rw']); ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?php echo strtoupper($key['email']); ?></td>
              </tr>
              <tr>
                <th scope="row">Golongan Darah</th>
                <td><?php echo strtoupper($key['golongan_darah']); ?></td>
              </tr>
              <tr>
                <th scope="row">Pekerjaan</th>
                <td><?php echo strtoupper($key['pekerjaan']); ?></td>
              </tr>
            </tbody>
          </table><br>
          <table class="table mb-0 ">
            <div class="row">
              <h5>informasi pemohon</h5>
            </div>
            <tbody>
              <tr>
                <th scope="row" class="border-top-0">Nama Pemohon</th>
                <td class="border-top-0"><?php echo strtoupper($key['nama_pemohon']); ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td><?php echo strtoupper($key['alamatpemohon']); ?>, KEC. <?php echo strtoupper($key['kecpemohon']); ?>, KEL. <?php echo strtoupper($key['kelpemohon']); ?>, RT/RW : <?php echo strtoupper($key['rtpemohon']); ?>/<?php echo strtoupper($key['rwpemohon']); ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?php echo strtoupper($key['emailpemohon']); ?></td>
              </tr>
              <tr>
                <th scope="row">Telepon/Whatsapp</th>
                <td><?php echo strtoupper($key['telpemohon']); ?> / <?php echo strtoupper($key['wapemohon']); ?></td>
              </tr>
              <tr>
                <th scope="row">Status Hubungan Dengan Pasien</th>
                <td><?php echo strtoupper($key['status_hubungan']); ?></td>
              </tr>
            </tbody>
          </table>
 
        </div>
        <div class="tab-pane paneldetail" id="tabIcon2" aria-labelledby="baseIcon-tab2">
          <table class="table mb-0 ">
            <tbody>
              <tr>
                <th scope="row" class="border-top-0">Jenis Jaminan</th>
                <td class="border-top-0"><?php echo strtoupper($key['nama_jenis']); ?></td>
              </tr>
              <tr>
                <th scope="row" class="border-top-0">Puskesmas</th>
                <td class="border-top-0"><?php echo strtoupper($key['nama_puskesmas']); ?></td>
              </tr>
              <tr>
                <th scope="row">Rumah Sakit</th>
                <td class="border-top-0"><?php echo strtoupper($key['nm_rs']); ?></td>
              </tr>
              <tr>
                <th scope="row">Mulai/Selesai Rawat</th>
                <td class="border-top-0"><?php echo strtoupper($key['mulai_rawat']); ?> <b>s/d</b> <?php echo strtoupper($key['selesai_rawat']); ?></td>
              </tr>
               <tr>
                <th scope="row" class="border-top-0">Jenis Rawat</th>
                <td class="border-top-0"><?php echo strtoupper($key['jenis_rawat']); ?></td>
              </tr>
              <tr>
                <th scope="row" class="border-top-0">Kelas Rawat</th>
                <td class="border-top-0"><?php echo strtoupper($key['nama_kelas']); ?></td>
              </tr>
              <tr>
                <th scope="row">Diagnosa</th>
                <td><ul>
                  <?php if ($penyakit) {
                    foreach ($penyakit as $keypenyakit) {?>

                    <li>-<?php echo strtoupper($keypenyakit['namadiag']); ?></li>

                    <?php }
                  } ?>
                </ul>
              </td>
            </tr>

          </tbody>
        </table>

      </div>
      <div class="tab-pane paneldetail" id="tabIcon3" aria-labelledby="baseIcon-tab3">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th>Tanggal Pengajuan</th>
              <th>Puskesmas</th>
              <th>Rumah Sakit</th>
              <th>Diagnosa</th>
              <th>Nominal Klaim</th>
              <th>Nominal pembiayaan</th>
              <th>Status Pengajuan</th> 
            </thead>
            <tbody>
             <?php if (!empty($riwayatpengajuan)) {
              foreach ($riwayatpengajuan as $key) {?>
              <tr> 
                <td><?php echo date_format(date_create($key['tanggal_pengajuan']),"d-m-Y") ?></td>
                <td><?php echo strtoupper($key['nama_puskesmas']); ?></td>
                <td><?php echo strtoupper($key['nama_rs']); ?></td>
               
                <td><ul>
                  <?php if ($penyakit) {
                    foreach ($penyakit as $keypenyakit) {?>

                    <li>- <?php echo $keypenyakit['namadiag']; ?></li>

                    <?php }
                  } ?>
                </ul>
              </td>

              <td><?php
              if(isset($key)  &&  !empty($key)){
                echo number_format($key['nominal_klaim']);
            
              }
              
              else{
     echo  "0";
}
              ?>
                
              </td>
              <td><?= number_format($key['nominal_pembiayaan']); ?></td>

              <td><?php if ($key['id_status_pengajuan'] == 1) {
                     echo '<div class="badge bg-blue-grey" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                   }elseif ($key['id_status_pengajuan'] == 2) {
                    echo '<div class="badge bg-info" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif ($key['id_status_pengajuan'] == 3) {
                    echo '<div class="badge bg-primary" style="font-size: 14px;">'.$key['status_pengajuan'].' <i class="ft-x"></i></div>';
                  }elseif($key['id_status_pengajuan'] == 4){
                    echo '<div class="badge bg-warning" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 5){
                    echo '<div class="badge bg-warning" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 6){
                    echo '<div class="badge bg-success bg-darken-1" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  }elseif($key['id_status_pengajuan'] == 7){
                    echo '<div class="badge bg-danger bg-darken-1" style="font-size: 14px;">'.$key['status_pengajuan'].' </div>';
                  } ?></td>
          </tr>
          <?php }
        } ?>
      </tbody>
    </table>
    <!-- <button type="button" class="btn btn-primary btn-sm float-right mt-1"><i class="ft-printer"></i>&nbsp;Cetak</button> -->
  </div>
</div>
<div class="tab-pane paneldetail" id="tabIcon4" aria-labelledby="baseIcon-tab4">
  <div class="note">
   <p> <strong>Catatan:</strong> <span class="catatan"><?php echo $key['keterangan_survey']; ?></span></p>
 </div>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Variabel</th>
          <th>Isi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($kethasilsurvey)){ 
          $no = 1; 
          foreach ($kethasilsurvey as $hs) {?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $hs['ceklist_survey']; ?></td>
            <td><?php echo $hs['keterangan']; ?></td>
          </tr>
          <?php } } ?>
        </tbody>
      </table>
    </table>
   <!--  <td><a href="<?php echo base_url('Cetak/cetak_survey_sjp/');?><?php echo $id_sjp;?>"><button type="button" class="btn mr-1 mb-1 btn-primary btn-sm"  style="float: right;">Cetak</button></td></a> -->
  </div>
</div>
<div class="tab-pane paneldetail" id="tabIcon5" aria-labelledby="baseIcon-tab5">

<!--    <div class="note">
   <p> <strong>Catatan:</strong> <span class="catatan"><?php echo $key['feedback']; ?></span></p>
 </div>
 -->
    <div class="note">
   <p> <strong>Catatan Dokumen:</strong> <span class="catatan"><?php echo $key['feedback']; ?></span></p>
 </div>
 <section id="image-gallery" class="card">
   <div class="card-content">
     <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
       <div class="row">
   
        <?php if (!empty($getdokumenpersyaratan)) {
         foreach ($getdokumenpersyaratan as $att) {?>
        
         <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
           <a href="<?php echo base_url()?>uploads/dokumen/<?php echo $att['attachment'] ?>" itemprop="contentUrl" data-size="480x360">
            <img class="img-thumbnail img-fluid" height="200" width="200" src="<?php echo base_url()?>uploads/dokumen/<?php echo $att['attachment'] ?>"
            itemprop="thumbnail" alt="Image description" />
          </a>
        </figure>
        <?php }
      } ?>
    </div>


  </div>
  <!--/ Image grid -->
  <!-- Root element of PhotoSwipe. Must have class pswp. -->
  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Background of PhotoSwipe. 
     It's a separate element as animating opacity is faster than rgba(). -->
     <div class="pswp__bg"></div>
     <!-- Slides wrapper with overflow:hidden. -->
     <div class="pswp__scroll-wrap">
      <!-- Container that holds slides. PhotoSwipe keeps only 3 of them in the DOM to save memory.Don't modify these 3 pswp__item elements, data is added later on. -->
      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>
      <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
      <div class="pswp__ui pswp__ui--hidden">
        <div class="pswp__top-bar">
          <!--  Controls are self-explanatory. Order can be changed. -->
          <div class="pswp__counter"></div>
          <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
          <button class="pswp__button pswp__button--share" title="Share"></button>
          <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
          <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
          <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
          <!-- element will get class pswp__preloader-active when preloader is running -->
          <div class="pswp__preloader">
            <div class="pswp__preloader__icn">
              <div class="pswp__preloader__cut">
                <div class="pswp__preloader__donut"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
          <div class="pswp__share-tooltip"></div>
        </div>
        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
        </button>
        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
        </button>
        <div class="pswp__caption">
          <div class="pswp__caption__center"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ PhotoSwipe -->
</section>
</div>
</div>      
</div>
</div>
<?php }
} ?>
</div>
</div>
</div>
</div>
</div>

<!-- end modal -->

<style type="text/css">
.table th, .table td {
  padding-top: 0.75rem;
  padding-right: 2rem;
  padding-bottom: 0.75rem;
  padding-left: 0px;
}
th {
  white-space: pre-wrap;
}
ul {
  list-style-type: circle !important;
}
</style>

  <div class="modal  fade text-left " id="riwayatProses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Riwayat Proses</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              	<div class="table-responsive">
		            <table class="table mb-0">
		              <tbody>
		              	<?php foreach ($riwayat_cetak as $rc): ?>
			                <tr>
			                  <th scope="row"  class="border-top-0">Tanggal Cetak</th>
			                  <td class="border-top-0"><?= date_format(date_create($rc["log_time"]),"Y-m-d") ?></td>
			                  <td class="border-top-0"><b>Oleh : </b><?= $rc["nama"] ?></td>
			                </tr>
		              	<?php endforeach ?> 
		              	<?php if (!empty($tanggalMenyetujui)): ?>
			                <tr>
			                  <th scope="row"  class="border-top-0">Tanggal Menyetujui</th>
			                  <td class="border-top-0"><?= ($tanggalMenyetujui[0]["tanggal_surat"] == Null)? "-" : $tanggalMenyetujui[0]["tanggal_surat"] ?></td>
			                  <td class="border-top-0"><?= ($tanggalMenyetujui[0]["nama"] == Null)? "" : "<b>Oleh : " . $tanggalMenyetujui[0]["nama"] ."</b>" ?></td>
			                </tr>
		              	<?php endif ?>
		               </tbody>
		            </table>
		        </div>
              </div>
          </div>
      </div>
  </div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>app-assets/vendors/css/forms/selects/select2.min.css">
<script src="<?= base_url()?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script type="text/javascript">

	function logCetak(){
		$.ajax({
	      	url : '<?= base_url($controller); ?>logCetak',
	      	method : "POST",
	      	async : false,
	      	"data" : {idUser:<?= $this->session->userdata('id_user') ?>,idInstansi:<?= $this->session->userdata('instansi') ?>,pengajuan:<?= $id_pengajuan ?>,type:"print",desc:"Cetak SJP"},
	      	success: function(data){
	      		window.location.href = "<?= base_url('Cetak/cetak_sjp/'). $id_sjp?>";
	     	}
	   	});
	}
  // $(document).on('click', '.tambahnominal', function(){
  //   $(this).addClass('form-control');
  // });
  // $('.inputnominal').click(function(event) {
  //   $(this).hide();
  //   $('.submitnominal').show();
  //   $('.tambahnominal').addClass('form-control');
  //   $('.tambahnominal').attr('contenteditable', '');
  // });
  $('.submitnominal').click(function(event) {
    $('.inputnominal').hide();
    // $('.tambahnominal').removeClass('form-control');
    var value = $('.tambahnominal').val();
    var id_sjp = $('.id_sjpval').val();
    $.ajax({
      url : '<?= base_url(); ?>Dinkes/input_pembiayaan',
      method : "POST",
      data : {nominal: value, id_sjp : id_sjp},
      async : false,
      //dataType : 'json',
      success: function(data){
       location.reload();  
     }
   });
  });
  // $(document).on('click', '.submitnominal', function(){
  //   $('.tambahnominal').removeClass('form-control');
  // });
  // $(document).on('blur', '.tambahnominal', function(){
  //   $(this).removeClass('form-control');
  // });
  function readURL(input) {
   if (input.files && input.files[0]) {
     var reader = new FileReader();

     reader.onload = function (e) {
       $('#showimages').attr('src', e.target.result);
     }

     reader.readAsDataURL(input.files[0]);
   }
 }

 $("#inputimages").change(function () {
   readURL(this);
 });
 // Multiple Select Placeholder
 function diagnosa2() {
  $('.kd_diagnosa').select2({
    placeholder: "Pilih penyakit",
  });
}
$(document).ready(function(){
  gethasilsurvey();
  diagnosapenyakit();
  diagnosa2();
  //$('.submitnominal').hide();
});
$('#kd_kecamatanpemohon').change(function(){
  getkelurahan();
})
function getkelurahan() {
  var data = $('#kd_kecamatanpemohon').val();
  $.ajax({
    url : "<?= base_url($controller);?>getKelurahan",
    method : "POST",
    data : {id: data},
    async : false,
    dataType : 'json',
    success: function(data){
      var html = '<option>Pilih Kelurahan</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value = "'+data[i].kelurahan+'">'+data[i].kelurahan+'</option>';
      }
      $('#kd_kelurahanpemohon').html(html);

    }
  });
}
$('.add').click(function (argument) {
  diagnosapenyakit();
  diagnosa2()
})
function diagnosapenyakit() {
 $('.diagnosapenyakit').each(function(index) {
  $('.kd_topik').select2({
   placeholder: "Pilih Topik"
 }).eq(index).on('select2:select', function (evt) {
  var data = $(this).val();
  $.ajax({
    url : "<?= base_url($controller);?>getDiagnosa",
    method : "POST",
    data : {id: data},
    async : false,
    dataType : 'json',
    success: function(data){
      var html = '<option>Pilih Diagnosa</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value = "'+data[i].key_penyakit+'">'+data[i].namadiag+'</option>';
      }
      $('.kd_diagnosa').eq(index).html(html);

    }
  });
});
});
}
    //  $('.add').click(function() {
    //       $('.kd_topik').each(function(index) {
    //         //console.log(index)
    //   $('.kd_topik').eq(index).change(function(){

    // })
    // })
    //  })


    function getdiagnosa() {
      var data = $('#kd_topik').val();
      $.ajax({
        url : "<?= base_url($controller);?>getDiagnosa",
        method : "POST",
        data : {id: data},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option>Pilih Diagnosa</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value = "'+data[i].key_penyakit+'">'+data[i].namadiag+'</option>';
          }
          $('#kd_diagnosa').html(html);

        }
      });
    }
    $('#kd_kecamatanpasien').change(function(){
      getkelurahanpasien();
    })
    function getkelurahanpasien() {
      var data = $('#kd_kecamatanpasien').val();
      $.ajax({
        url : "<?= base_url($controller);?>getKelurahan",
        method : "POST",
        data : {id: data},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option>Pilih Kelurahan</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value = "'+data[i].kelurahan+'">'+data[i].kelurahan+'</option>';
          }
          $('#kd_kelurahanpasien').html(html);

        }
      });
    }
    function myFunc(total, num) {
      return total + num;
    }
    function gethasilsurvey() {
      var id_sjp = '<?= $id_sjp; ?>';
      var level = '<?= $this->session->userdata('instansi') ?>';
      if (level == 1) {
        var urltarget = "<?= base_url();?>/Dinkes/gethasilsurvey";
      }else{
        var urltarget = "<?= base_url($controller);?>gethasilsurvey";
      }
      $.ajax({
        url : urltarget,
        method : "POST",
        data : {id_sjp: id_sjp},
        async : false,
        dataType : 'json',
        success: function(data){
          var hasil = []; 
          for(i=0; i<data.length; i++){
            hasil.push(+data[i].jawaban);
          }
          var countbobot =  hasil.reduce(myFunc);
          $('.hasil').html(countbobot);
          $('.persyaratan').html(hasil.length);
          if (countbobot >= 12) {
            $('.iconhasil').addClass('ft-user-check text-success');
            $('.kethasil').addClass('text-success');
            $('.kethasil').html('LAYAK');
          }else{
            $('.iconhasil').addClass('ft-user-x text-danger');
            $('.kethasil').addClass('text-danger');
            $('.kethasil').html('TIDAK LAYAK');
          }
          console.log(hasil);

        }
      });
    }
    // $('#simpanpengajuan').click(function() {
    //   var tes = $('.sjpform').serialize();
    //   console.log(decodeURIComponent(tes));
    // })

  </script>



</body>
</html>