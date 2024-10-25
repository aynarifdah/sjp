<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <!-- <li class=" nav-item"><a href="<?php echo base_url('Dinkes/index'); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Dashboard</span></a> -->
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/dashboard'); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Dashboard</span></a>
      </li>

      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/pengajuanall'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Semua Pengajuan</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/pengajuanuhc'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Semua UHC</span></a>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/pengajuan_sjp'); ?>"><i class="ft-book"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Pengajuan SJP</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/persetujuan_sjp_kayankesru'); ?>"><i class="ft-check-square"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Persetujuan SJP</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/disetujui_sjp'); ?>"><i class="ft-check-square"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">SJP Disetujui</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/ditolak_sjp'); ?>"><i class="ft-x-square"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">SJP Ditolak</span></a>
      </li>

      <!-- <li class=" nav-item"><a href="#"><i class="ft-file"></i><span class="menu-title" data-i18n="nav.page_headers.main">Pengajuan UHC</span></a>
        <ul class="menu-content">
          <li><a href="<?php echo base_url('Dinkes/pengajuanall/4'); ?>" class="menu-item">Semua UHC</a>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_sjp/4'); ?>" class="menu-item">Pengajuan UHC</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/ditolak_sjp/4'); ?>" class="menu-item">Ditolak UHC</a>
          </li>
        </ul>
      </li>
 -->
      <?php if($this->session->userdata('level') !== '7') : ?>
      <li class=" nav-item"><a href="#"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="nav.page_headers.main">Proses Klaim</span></a>
        <ul class="menu-content">
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim'); ?>" class="menu-item">Semua Klaim</a>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/2'); ?>" class="menu-item">Persetujuan Klaim</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/3'); ?>" class="menu-item">Pembayaran Klaim</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/4'); ?>" class="menu-item">Sudah Bayar</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/pengajuanall/4'); ?>" class="menu-item">List UHC</a>
          </li>
      </li>
      <?php  endif; ?>
    </ul>
  </li>
  <?php if($this->session->userdata('level') !== '7') : ?>
    <li class=" nav-item"><a href="#"><i class="ft-printer"></i><span class="menu-title" data-i18n="nav.page_headers.main">Laporan Rekapitulasi</span></a>
      <ul class="menu-content">

        <li><a href="<?php echo base_url('Dinkes/daftar_pembiayaan'); ?>" class="menu-item">Rekapitulasi Pembiayaan</a>
        </li>
      </ul>
    </li>
    <li class=" nav-item"><a href="<?php echo base_url('Dinkes/download_dokumen') ?>"><i class="ft-download"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Download Dokumen</span></a>
    </li>
    <?php endif;?> 
    <?php if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1) : ?>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/UserManagement'); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
      </li>
      <li class=" nav-item"><a href="#"><i class="ft-settings"></i><span class="menu-title" data-i18n="nav.page_headers.main">Parameter</span></a>
      <ul class="menu-content">

        <li><a href="<?php echo base_url('Dinkes/Waktu_pengajuan'); ?>" class="menu-item">Waktu Pengajuan</a>
        </li>

        <li><a href="<?php echo base_url('Dinkes/Waktu_survey'); ?>" class="menu-item">Waktu Survey</a>
        </li>
      </ul>
    </li>
    <?php endif ?>
    </ul>
  </div>
</div>