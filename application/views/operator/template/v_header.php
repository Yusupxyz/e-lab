<!--Counter Inbox-->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_us WHERE us_notif_status='0'");
    $jum_pesan=$query->num_rows();
?>
<header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">EL</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">E-LAB</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $jum_pesan;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki <?php echo $jum_pesan;?> uji sampel baru</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php 
                    $inbox=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_anggota ON tbl_anggota.anggota_id=tbl_us.us_anggota WHERE us_notif_status='0' ORDER BY us_id DESC LIMIT 5");
                    foreach ($inbox->result_array() as $in) :
                        $us_id=$in['us_id'];
                        $anggota_nama=$in['anggota_nama'];
                        $us_kode_sampel=$in['us_kode_sampel'];
                        $us_total=$in['us_total'];
                ?>
                  <li><!-- start message -->
                    <a href="<?php echo base_url().'admin/uji_sampel'?>">
                      <div class="pull-left">
                        <img src="<?php echo base_url().'assets/images/user_blank.png'?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $anggota_nama;?>
                        <small><i>Rp <?php echo number_format($us_total).',-';?></i> </small>
                      </h4>
                      <p><?php echo $us_kode_sampel;?></p>
                    </a>
                  </li>
                  <!-- end message -->
                  <?php endforeach;?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo base_url().'operator/uji_sampel'?>">Lihat Semua Uji Sampel</a></li>
            </ul>
          </li>
          
          <?php
              $id_admin=$this->session->userdata('idadmin');
              $q=$this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
              $c=$q->row_array();
          ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'assets/images/profil/'.$c['pengguna_photo'];?>" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $c['pengguna_nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'assets/images/profil/'.$c['pengguna_photo'];?>" class="img-circle" alt="">

                <p>
                  <?php echo $c['pengguna_nama'];?>
                  <?php if($c['pengguna_level']=='1'):?>
                    <small>Administrator</small>
                  <?php else:?>
                    <small>Operator</small>
                  <?php endif;?>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'administrator/logout'?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url().''?>" target="_blank" title="Lihat Website"><i class="fa fa-globe"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>