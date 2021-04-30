<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/index'); ?>"><i class="la la-dashboard"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Dashboard</span></a>
      </li>

      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/pengajuanall'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Semua Pengajuan</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/pengajuan_sjp'); ?>"><i class="ft-book"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Pengajuan SJP</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/persetujuan_sjp_kayankesru'); ?>"><i class="ft-check-square"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Persetujuan SJP</span></a>
      </li>

      <li class=" nav-item"><a href="#"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="nav.page_headers.main">Proses Klaim</span></a>
        <ul class="menu-content">
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim'); ?>" class="menu-item">Semua Klaim</a>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/2'); ?>" class="menu-item">Persetujuan Klaim</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/3'); ?>" class="menu-item">Pembayaran Klaim</a>
          </li>
          <li><a href="<?php echo base_url('Dinkes/pengajuan_klaim/4'); ?>" class="menu-item">Sudah Bayar</a>
          </li>

      </li>
    </ul>
    </li>
    <li class=" nav-item"><a href="#"><i class="ft-printer"></i><span class="menu-title" data-i18n="nav.page_headers.main">Laporan Rekapitulasi</span></a>
      <ul class="menu-content">

        <li><a href="<?php echo base_url('Dinkes/daftar_pembiayaan'); ?>" class="menu-item">Rekapitulasi Pembiayaan</a>
        </li>
      </ul>
    </li>
    <li class=" nav-item"><a href="#"><i class="ft-download"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Download Dokumen</span></a>
    </li>
    <?php if ($this->session->userdata('instansi') == 1 && $this->session->userdata('level') == 1) : ?>
      <li class=" nav-item"><a href="<?php echo base_url('Dinkes/UserManagement'); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
      </li>
    <?php endif ?>
    </ul>
  </div>
</div>