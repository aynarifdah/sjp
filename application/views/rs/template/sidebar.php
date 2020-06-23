<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <?php if ($this->session->userdata('level') == 1 && $this->session->userdata('instansi') == 2): ?>
         <li class=" nav-item"><a href="<?php echo base_url('Rs/UserManagement');?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
        </li> 
        <?php endif ?>
         <li class=" nav-item"><a href="<?php echo base_url('Rs/index');?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">List SJP</span></a>
        </li>
        <li class=" nav-item"><a href="<?php echo base_url('Rs/daftar_klaim');?>"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">List Pengajuan Klaim</span></a>
        </li>
        
        <!-- <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Proses SJP</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="<?php echo base_url('Home/pengajuan');?>" data-i18n="nav.templates.vert.main">Semua Pengajuan</a></li>
            <li><a class="menu-item" href="<?php echo base_url('Home/permohonan_baru');?>" data-i18n="nav.templates.horz.main">Permohonan SJP</a></li>
            <li><a class="menu-item" href="<?php echo base_url('Home/survey');?>" data-i18n="nav.templates.horz.main">Persetujuan SJP</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
  </div>