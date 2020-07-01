<!--Counter Inbox-->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $jum_pesan=$query->num_rows();
    // $query1=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
    // $jum_komentar=$query1->num_rows();
?>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datepicker/datepicker3.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>
  
	<?php 
            function limit_words($string, $word_limit){
                $words = explode(" ",$string);
                return implode(" ",array_splice($words,0,$word_limit));
            }
                
    ?>
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <?php 
    $this->load->view('operator/template/v_header');
    ?>
<!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('operator/template/left_menu'); ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Informasi Sampel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Uji Sampel</a></li>
        <li class="active">Informasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
          <div class="box">
 
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                <th>No.</th>
      					<th>Pelanggan</th>
      					<th>Kode Uji Sampel</th>
                <th>Pengambilan Oleh</th>
      					<th>No. Identifikasi</th>
      					<th>Uraian</th>
                <th>Kondisi Saat Diterima</th>
      					<th>Tanggal Diterima</th>
      					<th>Tanggal Pengujian</th>
                <th style="text-align:right;">Aksi</th>
                </tr>
                </thead>
                <tbody>
          				<?php
          					$no=1;
          					foreach ($data->result_array() as $i) :
          					   $us_id=$i['us_id'];
          					   $us_status_id=$i['us_status_id'];
          					   $no_identifikasi=$i['no_identifikasi'];
          					   $kondisi=$i['kondisi'];
          					   $us_kode_sampel=$i['us_kode_sampel'];
          					   $js_nama=$i['js_nama'];              
          					   $tanggal_sampel=$i['tanggal_sampel'];             
          					   $tanggal_pengujian_awal=$i['tanggal_pengujian_awal'];   
          					   $tanggal_pengujian_akhir=$i['tanggal_pengujian_akhir'];  
          					   $us_pengambilan=$i['us_pengambilan'];      
          					   $us_catatan=$i['us_catatan'];  
                       $us_catatan_status=$i['us_catatan_status'];   
                       $anggota_nama=$i['anggota_nama'];        
                       if ($tanggal_pengujian_awal==null){
                          $tanggal_pengujian_awal='-';
                       }else{
                          $tanggal_pengujian_awal=date_indo($tanggal_pengujian_awal);
                       }
                       if ($tanggal_pengujian_akhir==null){
                        $tanggal_pengujian_akhir='-';
                       }else{
                        $tanggal_pengujian_akhir=date_indo($tanggal_pengujian_akhir);
                       }
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $anggota_nama;?></td>
                  <td><?php echo $us_kode_sampel;?></td>
                  <td><?php echo $us_pengambilan;?></td>
                  <td><?php echo $no_identifikasi;?></td>
                  <td><?php echo $js_nama;?></td>
                  <td><?php echo $kondisi;?></td>
                  <td><?php echo $tanggal_sampel!=null?date_indo($tanggal_sampel):'-';?></td>
                  <td><?php echo $tanggal_pengujian_awal.'<i> s.d </i>'.$tanggal_pengujian_akhir;?></td>
                  <td style="text-align:center;">
                    <?php if ($us_pengambilan=='Pelanggan') { ?>
                      <a  class="btn" data-toggle="modal" <?= ($us_status_id!=1)?' data-target="#ModalEdit'.$us_id.'"':'disabled' ?>  ><span class="fa fa-pencil"></span></a>
                    <?php }else{  ?>
                      <a class="btn" data-toggle="modal" data-target="#ModalEditLab<?php echo $us_id;?>"><span class="fa fa-pencil"></span></a>
                    <?php } ?>
                  </td>
                </tr>
				<?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

 <?php foreach ($data->result_array() as $i) :
              $is_id=$i['is_id'];
              $us_status_id=$i['us_status_id'];
              $no_identifikasi=$i['no_identifikasi']; 
              $kondisi=$i['kondisi'];   
              $us_pengambilan=$i['us_pengambilan'];        
            ?>
	<!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $us_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Penerimaan Sampel dari Pelanggan</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/update_informasi'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">No. Sampel Laboratorium</label>
                      <div class="col-sm-7">
                      <input type="hidden" name="xoleh" value="<?php echo $us_pengambilan;?>" >
                        <input type="text" name="xno" class="form-control" id="inputUserName" value="<?php echo $no_identifikasi;?>" placeholder="Masukkan No. Sampel Lab" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Kondisi Saat Diterima</label>
                      <div class="col-sm-7">
                        <input type="text" name="xkondisi" class="form-control" id="inputUserName" value="<?php echo $kondisi;?>" placeholder="Masukkan Kondisi Sampel" required>
                      </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" name="xid" value="<?php echo $is_id;?>" class="btn btn-primary btn-flat" id="simpan">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endforeach;?>


  <?php foreach ($data->result_array() as $i) :
              $us_id=$i['us_id'];
              $us_status_id=$i['us_status_id'];
              $no_identifikasi=$i['no_identifikasi']; 
              $kondisi=$i['kondisi'];   
              $tanggal_sampel=$i['tanggal_sampel'];  
              $lokasi=$i['lokasi'];      
              $metode_id=$i['metode_id'];    
              $rincian=$i['rincian'];   
              $us_pengambilan=$i['us_pengambilan'];         
            ?>
	<!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalEditLab<?php echo $us_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Penerimaan Sampel oleh Laboratorium</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/update_informasi'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">No. Sampel Laboratorium*</label>
                      <div class="col-sm-7">
                      <input type="hidden" name="xoleh" value="<?php echo $us_pengambilan;?>" >
                        <input type="text" name="xno" class="form-control" id="inputUserName" value="<?php echo $no_identifikasi;?>" placeholder="Masukkan No. Sampel Lab" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Kondisi Lingkungan Selama Pengambilan Sampel*</label>
                      <div class="col-sm-7">
                          <input  placeholder="Kondisi Lingkungan Selama Pengambilan Sampel" type="text" class="form-control" name="xkondisi" value="<?php echo $kondisi;?>" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Tanggal Pengambilan Sampel*</label>
                      <div class="col-sm-7">
                        <input  placeholder="Tanggal Pengambilan Sampel" type="text" class="form-control datepicker" name="xtanggal" value="<?php echo $tanggal_sampel;?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Lokasi Pengambilan Sampel*</label>
                      <div class="col-sm-7">
                        <input  placeholder="Lokasi Pengambilan Sampel" type="text" class="form-control" name="xlokasi" value="<?php echo $lokasi;?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Acuan Prosedur Pengambilan Sampel*</label>
                      <div class="col-sm-7">
                      <?php
                              echo form_dropdown('xmetode', $am, $metode_id, $attribute);
                        ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Penyimpanan Prosedur Pengambilan Sampel</label>
                      <div class="col-sm-7">
                        <textarea placeholder="Penyimpanan Prosedur Pengambilan Sampel" class="form-control" name="xrincian" ><?php echo $rincian;?></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" name="xid" value="<?php echo $us_id;?>" class="btn btn-primary btn-flat" id="simpan">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endforeach;?>

<footer class="main-footer">
    <?php $this->load->view('template/copyright'); ?>  
  </footer>
	
	


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Status berhasil diubah. Namun email gagal terkirim ke pelanggan.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>
    
    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Informasi Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success2'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Informasi Berhasil disimpan ke database. Dan email berhasil terkiriM ketujuan. Silahkan cek kotak keluar gmail Anda.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='info'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Info',
                    text: "Informasi berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Informasi Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php else:?>

    <?php endif;?>

    <script>
$(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });

    $('#xstatus').on('change', function() {
      document.getElementById("catatan").style.display = "block";
    });
    </script>
</body>
</html>
