<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <!-- <li class=" nav-item"><a href="<?php echo base_url('Rs/Dashboard'); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Dashboard</span></a>
      </li> -->

      <li class=" nav-item"><a href="<?php echo base_url('Rs/pengajuan_rs'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Permohonan SJP</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Rs/index'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">List SJP</span></a>
      </li>

      <li class=" nav-item"><a href="<?php echo base_url('Rs/daftar_klaim'); ?>"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">List Pengajuan Klaim</span></a>
      </li>
      <li class=" nav-item"><a href="<?php echo base_url('Rs/download_dokumen') ?>"><i class="ft-download"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Download Dokumen</span></a>
      </li>

      <?php if ($this->session->userdata('level') == 1 && $this->session->userdata('instansi') == 2) : ?>
        <li class=" nav-item"><a href="<?php echo base_url('Rs/UserManagement'); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
        </li>
      <?php endif ?>
    </ul>
  </div>
</div>