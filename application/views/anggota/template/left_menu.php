<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li <?= $title=='Beranda'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'anggota/dashboard'?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li <?= $title=='Profil'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'anggota/profil'?>">
            <i class="fa fa-user"></i> <span>Profil</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Uji Sampel'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>Uji Sampel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="<?= $title=='Pendaftaran Uji Sampel'?'active':''?>"><a href="<?php echo base_url().'anggota/uji_sampel/pendaftaran'?>"><i class="fa fa-send"></i>Pendaftaran</a></li>
            <li class="<?= $title=='Status Uji Sampel'?'active':''?>"><a href="<?php echo base_url().'anggota/uji_sampel'?>"><i class="fa fa-list"></i> Status</a></li>
            <li class="<?= $title=='Transaksi Uji Sampel'?'active':''?>"><a href="<?php echo base_url().'anggota/uji_sampel/transaksi'?>"><i class="fa fa-shopping-cart"></i> Transaksi</a></li>
          </ul>
        </li>
        <li <?= $title=='Laporan'?'class="active"':''; ?>>
          <a href="<?php echo base_url().'anggota/laporan'?>">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>