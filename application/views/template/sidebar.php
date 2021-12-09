<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      <?php if ($this->session->userdata('instansi') == 6) { ?>

        <li class=" nav-item"><a href="<?php echo base_url('Kelurahan/pengajuan'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Semua Pengajuan</span></a>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-server"></i><span class="menu-title" data-i18n="nav.templates.main">Proses SJP</span></a>
          <ul class="menu-content">

            <li><a class="menu-item" href="<?php echo base_url('Kelurahan/permohonan_baru'); ?>" data-i18n="nav.templates.horz.main">Pengajuan Baru</a></li>
            <li><a class="menu-item" href="<?php echo base_url('Kelurahan/persetujuan_sjp'); ?>" data-i18n="nav.templates.horz.main">Persetujuan SJP</a></li>

          </ul>
        </li>
        <li class="nav-item"><a href="<?php echo base_url('Kelurahan/download_dokumen') ?>"><i class="ft-download"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Download Dokumen</span></a>
        </li>
        <?php }else{ ?>
        <li class=" nav-item"><a href="<?php echo base_url('Home/pengajuan'); ?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Semua Pengajuan</span></a>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-server"></i><span class="menu-title" data-i18n="nav.templates.main">Proses SJP</span></a>
          <ul class="menu-content">

            <li><a class="menu-item" href="<?php echo base_url('Home/permohonan_baru'); ?>" data-i18n="nav.templates.horz.main">Pengajuan Baru</a></li>
            <li><a class="menu-item" href="<?php echo base_url('Home/persetujuan_sjp'); ?>" data-i18n="nav.templates.horz.main">Persetujuan SJP</a></li>

          </ul>
        </li>
        <li class="nav-item"><a href="<?php echo base_url('Home/download_dokumen') ?>"><i class="ft-download"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Download Dokumen</span></a>
        </li>
        <?php } ?>

      <?php if ($this->session->userdata('level') == 1 && $this->session->userdata('instansi') == 3) : ?>

        <li class=" nav-item"><a href="<?php echo base_url('Home/UserManagement'); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
        </li>

      <?php endif ?>
    </ul>
  </div>
</div>