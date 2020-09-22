<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-LAB | Registrasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/logo plk.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css'?>">

  
</head>
<body class="hold-transition login-page">
<div>
   <p><?php echo $this->session->flashdata('msg');?></p>
  </div>
<div class="register-box">
 
  <!-- /.login-logo -->
  <div class="register-box-body" style="margin-top:-80px;">
  <p class="register-box-msg"> <img src="<?php echo base_url().'assets/images/logo plk.png'?>" height="50" widht="50"></p>
  <p align="center"><b>E-LAB </b></p>
    <p class="register-box-msg">UPT LINGKUNGAN<br> DINAS LINGKUNGAN HIDUP KOTA PALANGKA RAYA </p>
    <p align="center"><b>Reset Password Baru</b></p>

    <form action="<?php echo base_url().'administrator/reset_password/'.$reset_key?>" method="post">
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repassword" class="form-control" placeholder="Ulangi Password" required id="repassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div>
            <label>
              Sudah punya akun? <a href="<?php echo base_url(); echo ($role=='anggota'?'anggota':'administrator');?>">Masuk</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Ubah</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->
    <hr/>
    <p><center>Copyright <?php echo '2020'?> by Sekarlangit <br/> All Right Reserved</center></p>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $(document).ready(function(){
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
  });

  $(document).ready(function(){
    $('#username').change(function(){ 
      var username=document.getElementById("username").value;
      $.ajax({
          url: "<?php echo base_url().'administrator/cek_username' ?>",
          type: "post",
          data:{ username:username},
          success: function (response) {
              console.log(response);
              $("#message").html(response);
              if (response==1){
                alert("Username sudah terpakai, silahkan ganti!");
                $('input[name=username]').val('');
                $("#username").focus();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }
      });  
    });
  });
</script>
</body>
</html>
