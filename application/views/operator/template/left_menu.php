<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li <?= $title=='Beranda'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'operator/dashboard'?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li <?= $title=='Profil'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'operator/profil'?>">
            <i class="fa fa-user"></i> <span>Profil</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Kelola Uji Sampel'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>Kelola Uji Sampel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="<?= $title=='Kelola Status'?'active':''?>"><a href="<?php echo base_url().'operator/uji_sampel'?>"><i class="fa fa-list"></i> Kelola Status</a></li>
            <li class="<?= $title=='Kelola Informasi Sampel'?'active':''?>"><a href="<?php echo base_url().'operator/uji_sampel/informasi'?>"><i class="fa fa-info"></i> Kelola Informasi Sampel</a></li>
            <li class="<?= $title=='Kelola Transaksi'?'active':''?>"><a href="<?php echo base_url().'operator/uji_sampel/transaksi'?>"><i class="fa fa-shopping-cart"></i> Kelola Transaksi</a></li>
          </ul>
        </li>
        <li <?= $title=='Laporan'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'operator/laporan'?>">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Riwayat'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-history"></i>
            <span>Riwayat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="<?= $title=='Riwayat Uji Sampel'?'active':''?>"><a href="<?php echo base_url().'operator/riwayat_uji_sampel'?>"><i class="fa fa-clock-o"></i> Riwayat Uji Sampel</a></li>
            <li class="<?= $title=='Riwayat Transaksi'?'active':''?>"><a href="<?php echo base_url().'operator/riwayat_transaksi'?>"><i class="fa fa-clock-o"></i> Riwayat Transaksi</a></li>
          </ul>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>