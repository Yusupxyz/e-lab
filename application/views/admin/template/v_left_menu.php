<!--Counter Inbox-->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $jum_pesan=$query->num_rows();
    // $query1=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
    // $jum_komentar=$query1->num_rows();
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li class="<?= $title=='Beranda'?'active':''?>">
          <a href="<?php echo base_url().'admin/dashboard'?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="header">Front End</li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Slider'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-image"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Slider'?'active':''?>"><a href="<?php echo base_url().'admin/slider/add_slider'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Slider'?'active':''?>"><a href="<?php echo base_url().'admin/slider'?>"><i class="fa fa-list"></i> Daftar Slider</a></li>
          </ul>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Layanan Lab'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-bars"></i>
            <span>Layanan Lab</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Layanan Lab'?'active':''?>"><a href="<?php echo base_url().'admin/layanan/add_layanan'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Layanan Lab'?'active':''?>"><a href="<?php echo base_url().'admin/layanan'?>"><i class="fa fa-list"></i> Daftar Layanan Lab</a></li>
          </ul>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Tentang Lab'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Tentang Lab</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Tentang Lab'?'active':''?>"><a href="<?php echo base_url().'admin/tentang/add_tentang'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Tentang Lab'?'active':''?>"><a href="<?php echo base_url().'admin/tentang'?>"><i class="fa fa-list"></i> Daftar Tentang Lab</a></li>
          </ul> 
        </li>
        <li class="<?= $title=='Kontak'?'active':''?>">
          <a href="<?php echo base_url().'admin/kontak'?>">
            <i class="fa fa-info-circle"></i> <span>Kontak</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="header">Back End</li>

        <li class="<?= $title=='Pengguna'?'active':''?>">
          <a href="<?php echo base_url().'admin/pengguna'?>">
            <i class="fa fa-users"></i> <span>Pengguna</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Sifat Pengujian'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-magic"></i>
            <span>Sifat Pengujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Sifat Pengujian'?'active':''?>"><a href="<?php echo base_url().'admin/sifat_pengujian/add_sifat_pengujian'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Sifat Pengujian'?'active':''?>"><a href="<?php echo base_url().'admin/sifat_pengujian'?>"><i class="fa fa-list"></i> Daftar Sifat Pengujian</a></li>
          </ul> 
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Parameter Uji'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-fire"></i>
            <span>Parameter Uji</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Parameter Uji'?'active':''?>"><a href="<?php echo base_url().'admin/parameter_uji/add_parameter_uji'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Parameter Uji'?'active':''?>"><a href="<?php echo base_url().'admin/parameter_uji'?>"><i class="fa fa-list"></i> Daftar Parameter Uji</a></li>
          </ul> 
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Jenis Sampel'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-hand-pointer-o"></i>
            <span>Jenis Sampel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Jenis Sampel'?'active':''?>"><a href="<?php echo base_url().'admin/jenis_sampel/add'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Jenis Sampel'?'active':''?>"><a href="<?php echo base_url().'admin/jenis_sampel'?>"><i class="fa fa-list"></i> Daftar Jenis Sampel</a></li>
          </ul> 
        </li>
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Jenis Wadah'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-hand-lizard-o"></i>
            <span>Jenis Wadah</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Jenis Wadah'?'active':''?>"><a href="<?php echo base_url().'admin/jenis_wadah/add'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Jenis Wadah'?'active':''?>"><a href="<?php echo base_url().'admin/jenis_wadah'?>"><i class="fa fa-list"></i> Daftar Jenis Wadah</a></li>
          </ul> 
        </li>
        <!-- <li class="treeview <?= (isset($pratitle))?($pratitle=='Status'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-star-o"></i>
            <span>Status</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Status'?'active':''?>"><a href="<?php echo base_url().'admin/status/add'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Status'?'active':''?>"><a href="<?php echo base_url().'admin/status'?>"><i class="fa fa-list"></i> Daftar Status</a></li>
          </ul> 
        </li> -->
        <li class="treeview <?= (isset($pratitle))?($pratitle=='Acuan Metode'?'active':''):''?>">
          <a href="#">
            <i class="fa fa-arrows"></i>
            <span>Acuan Metode</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $title=='Tambah Status'?'active':''?>"><a href="<?php echo base_url().'admin/metode/add'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
            <li class="<?= $title=='Daftar Status'?'active':''?>"><a href="<?php echo base_url().'admin/metode'?>"><i class="fa fa-list"></i> Daftar Acuan Metode</a></li>
          </ul> 
        </li>
        <li class="<?= $title=='Setting'?'active':''?>">
          <a href="<?php echo base_url().'admin/setting'?>">
            <i class="fa fa-cog"></i> <span>Setting</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= $title=='Setting Email'?'active':''?>">
          <a href="<?php echo base_url().'admin/setting_email'?>">
            <i class="fa fa-envelope-o"></i> <span>Setting Email</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= $title=='Status'?'active':''?>">
          <a href="<?php echo base_url().'admin/status'?>">
            <i class="fa fa-star-o"></i> <span>Status</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= $title=='Kontak'?'active':''?>">
          <a href="<?php echo base_url().'admin/kontak'?>">
            <i class="fa fa-info-circle"></i> <span>Kontak</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url().'admin/inbox'?>">
            <i class="fa fa-envelope"></i> <span>Inbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $jum_pesan;?></small>
            </span>
          </a>
        </li>

         <li>
          <a href="<?php echo base_url().'administrator/logout'?>">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>