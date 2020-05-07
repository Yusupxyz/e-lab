<!DOCTYPE html>
<html>
<head>
<?php 
    $this->load->view('template/v_top');
  ?>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/all.css'?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/colorpicker/bootstrap-colorpicker.min.css'?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css'?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/select2/select2.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">

  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <?php 
    $this->load->view('operator/template/v_header');
  ?>
  
  <?php $this->load->view('operator/template/left_menu'); ?>  


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <?php if ($success = $this->session->flashdata('success')) { ?>
            <div class="alert alert-success">
              <strong>Sukses!</strong> <?= $success; ?>
            </div>
          <?php } else if ($error = $this->session->flashdata('error')) { ?>
            <div class="alert alert-danger">
              <strong>Gagal!</strong> <?= $error; ?>
            </div>
            <?php } ?>
        </div>
        <div class="col-md-8">
    
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Data</h3>
            </div>
            <form action="<?php echo base_url().'operator/profil/update'?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" value="<?= $data->pengguna_nama ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?= $data->pengguna_username ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Jenis Kelamin Personil Penghubung</label>
                  <select name="jl" class="form-control" required>
                    <option selected="true" disabled="disabled" value="">Pilih Jenis Kelamin</option>
                    <option value="L" <?= $data->pengguna_jenkel=='L'?'selected':'';?>>Laki-laki</option>
                    <option value="P" <?= $data->pengguna_jenkel=='P'?'selected':'';?>>Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" name="email" class="form-control" placeholder="Masukkan email" value="<?= $data->pengguna_email ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kontak</label>
                  <input type="text" name="nohp" class="form-control" placeholder="Masukkan kontak" value="<?= $data->pengguna_nohp ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto</label>
                  <input type="file" name="filefoto" />
                </div>
               <div class="form-group">
                  <label for="exampleInputEmail1" style="color:red"> Password Konfirmasi</label>
                  <input type="password" name="konfirmasipassword" class="form-control" placeholder="Masukkan password untuk ubah profil" id="konfirmasipassword" required>
               </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Ubah Profil</button>
              </div>
            </form>
            <!-- /.col -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Ubah Password</h3>
            </div>
            <form role="form" action="<?php echo base_url().'operator/profil/update_password'?>" method="post">

            <div class="box-body">
             
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" class="form-control" placeholder="Masukkan Password Baru" name="password" id="password" required>
              </div>

              <div class="form-group">
                <label>Ulang Password Baru</label>
                <input type="password" class="form-control" placeholder="Masukkan Ulang Password Baru" name="repassword" id="repassword" required>
              </div>

              <div class="form-group">
                <label style="color:red">Password Lama</label>
                <input type="password" class="form-control" placeholder="Masukkan Password Lama" name="oldpassword" id="oldpassword" required>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Ubah Password</button>
              </div>
            </form>
			
              <!-- /.form group -->
		
			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php $this->load->view('template/copyright'); ?>  
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url().'assets/plugins/select2/select2.full.min.js'?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js'?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url().'assets/plugins/colorpicker/bootstrap-colorpicker.min.js'?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js'?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script src=<?php echo base_url().'assets/js/md5.min.js'?>></script>

<!-- Page script -->

<script>
  $(document).ready(function(){
    $('#konfirmasipassword').change(function(){ 
      var p1=document.getElementById("konfirmasipassword").value;
      var p2='<?= $data->operator_password ?>';
      if (md5(p1)!=p2){
        alert("Password tidak sama! Silahkan ulangi!");
        $('input[name=konfirmasipassword]').val('');
        $("#konfirmasipassword").focus();

      }
    });

    $('#repassword').change(function(){ 
      var p1=document.getElementById("password").value;
      var p2=document.getElementById("repassword").value;
      if (p1!=p2){
        alert("Password tidak sama! Silahkan ulangi!");
        $('input[name=password]').val('');
        $('input[name=repassword]').val('');
        $("#password").focus();

      }
    });

    $('#oldpassword').change(function(){ 
      var p1=document.getElementById("oldpassword").value;
      var p2='<?= $data->operator_password ?>';
      if (md5(p1)!=p2){
        alert("Password tidak sama! Silahkan ulangi!");
        $('input[name=oldpassword]').val('');
        $("#oldpassword").focus();

      }
    });
  });
</script>
</body>
</html>
