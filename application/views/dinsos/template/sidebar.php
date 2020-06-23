<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
       <!--  <li class=" nav-item"><a href="<?php echo base_url('Dinsos/dashboard2');?>"><i class="la la-dashboard"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Dashboard</span></a>
      </li> -->
        <?php if ($this->session->userdata('instansi') == 4 && $this->session->userdata('level') == 1): ?>
          <li class=" nav-item"><a href="<?php echo base_url('Dinsos/UserManagement');?>"><i class="ft-user"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">User Management</span></a>
          </li>
        <?php endif ?>
         <li class=" nav-item"><a href="<?php echo base_url('Dinsos/pengajuan_dinsos');?>"><i class="ft-grid"></i><span class="menu-title" data-i18n="nav.add_on_block_ui.main">Semua Pengajuan</span></a>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-server"></i><span class="menu-title" data-i18n="nav.templates.main">Proses SJP</span></a>
          <ul class="menu-content">
            <!-- <li><a class="menu-item" href="<?php echo base_url('Dinsos/pengajuan_dinsos');?>" data-i18n="nav.templates.vert.main">Semua Pengajuan</a></li> -->
            <li><a class="menu-item" href="<?php echo base_url('Dinsos/permohonan_baru_dinsos');?>" data-i18n="nav.templates.horz.main">Pengajuan SJP</a></li>
            <li><a class="menu-item" href="<?php echo base_url('Dinsos/persetujuan_sjp_dinsos');?>" data-i18n="nav.templates.horz.main">Persetujuan SJP</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>