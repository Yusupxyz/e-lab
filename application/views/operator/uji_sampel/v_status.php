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
        Status Uji Sampel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Uji Sampel</a></li>
        <li class="active">Status</li>
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
      					<th>Surat Permohonan</th>
      					<th>Catatan Pelanggan</th>
                <th>Kode Uji Sampel</th>
                <th>Pengambilan Oleh</th>
      					<th>Jenis Sampel</th>
      					<th>Jenis Wadah</th>
      					<th>Parameter Uji</th>
      					<!-- <th>No. Sampel Lab</th> -->
      					<th>Catatan Status</th>
      					<th>Status</th>
                <th style="text-align:right;">Aksi</th>
                </tr>
                </thead>
                <tbody>
          				<?php
          					$no=1;
          					foreach ($data->result_array() as $i) :
          					   $us_id=$i['us_id'];
          					   $us_status_id=$i['us_status_id'];
          					   $status_nama=$i['status_nama'];
          					   $status_class=$i['status_class'];
          					   $us_kode_sampel=$i['us_kode_sampel'];
          					   $js_nama=$i['js_nama'];              
          					   $jw_nama=$i['jw_nama'];             
          					   $anggota_nama=$i['anggota_nama'];   
          					   $us_pengambilan=$i['us_pengambilan'];  
          					   $us_file=$i['us_file'];      
          					   $us_catatan=$i['us_catatan'];  
          					   $us_catatan_status=$i['us_catatan_status'];        
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $anggota_nama;?></td>
                  <td>
                  <a href="<?php echo base_url().'/assets/surat_permohonan/'.$us_file?>"> Download PDF </a>
                  <td><?php echo ($us_catatan!='')?$us_catatan:'-';?></td>
                  <td><?php echo $us_kode_sampel;?></td>
                  <td><?php echo $us_pengambilan;?></td>
                  <td><?php echo $js_nama;?></td>
                  <td><?php echo $jw_nama;?></td>
                  <td>
                    <a class="btn btn-xs btn-warning" href="#modalDetail<?php echo $us_id?>"  data-toggle="modal" title="Detail"><span class="fa fa-info"></span> Detail</a>
                  </td>
                  <td><?php echo ($us_catatan_status!='')?$us_catatan_status:'-';?></td>
                  <td><span class="<?= $status_class ?> alert" style="padding:1px"><?php echo $status_nama;?></span></td>
                  <td style="text-align:center;">
                    <?php if ($us_status_id!='3' && $us_status_id!='5' && $us_status_id!='6' && $us_status_id!='4') { ?>
                      <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $us_id;?>"><span class="fa fa-pencil"></span></a>
                    <?php }elseif($us_status_id=='3' OR  $us_status_id=='4'){  ?>
                      <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $us_id;?>"><span class="fa fa-trash"></span></a>
                    <?php }elseif($us_status_id=='6'){  ?>
                      <a class="btn" href="<?php echo base_url().'operator/uji_sampel/isi_laporan/'.$us_id?>"><span class="fa fa-file-text-o"></span></a>
                    <?php }else{  ?>
                      -
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
 
  <!-- ============ MODAL EDIT =============== -->
  <?php $i=0; 
            foreach ($data->result_array() as $a){
              $us_id=$a['us_id'];
              $us_total=$a['us_total']; 
              $j=1;
                    ?>
                <div id="modalDetail<?php echo $us_id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Detail Parameter Uji</h3>
                    </div>
                        <div class="modal-body">
                        
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Parameter Uji</th>
                                <th>Jenis</th>
                            </tr>
                            </thead>
                            <?php
                        foreach ($detail[$i++] as $key => $b) {
                        $pu_nama=$b['pu_nama'];
                        $sp_jenis=$b['sp_jenis'];
                    ?>
                            <tbody>
                           
                            <tr>
                                <td><?= $j++ ?></td>
                                <td><?= $pu_nama ?></td>
                                <td><?= $sp_jenis ?></td>
                            </tr>
                            </tbody>
                                            <?php
                    }
                        ?>
                        </table>
                </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                </div>
                </div>
                </div>
            <?php
        }
        ?>

 <?php foreach ($data->result_array() as $i) :
              $us_id=$i['us_id'];
              $us_status_id=$i['us_status_id'];
            ?>
	<!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $us_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Pemeriksaan</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/update'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                          <div class="col-sm-7">
                          <?php
                            if ($us_status_id==1){
                              echo form_dropdown('xstatus', $status, $us_status_id, $attribute2);
                            }elseif($us_status_id==6){
                              echo form_dropdown('xstatus', $status2, $us_status_id, $attribute2);
                            }elseif($us_status_id==7){
                              echo form_dropdown('xstatus', $status3, $us_status_id, $attribute2);
                            }elseif($us_status_id==2){
                              echo form_dropdown('xstatus', $status4, $us_status_id, $attribute2);
                            }
                        ?><br>
                          </div>
                      </div>
                      <div class="form-group" id="catatan" style="display:none">
                      <label for="inputUserName" class="col-sm-4 control-label">Catatan untuk pelanggan (Jika diperlukan)</label>
                      <div class="col-sm-7" >
                        <textarea name="xcatatan"  class="form-control"></textarea>
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

  <?php foreach ($data->result_array() as $i) :
              $us_id=$i['us_id'];
            ?>
	<!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalHapus<?php echo $us_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/hapus'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">       
							<input type="hidden" name="kode" value="<?php echo $us_id;?>"/> 
                            <p>Apakah Anda yakin mau menghapus Data Uji Sampel yang dibatalkan ini?</p>
                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
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
                    text: "Status gagal diubah. Dan email gagal terkirim ke pelanggan.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>

  <?php elseif($this->session->flashdata('msg')=='error2'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Informasi Berhasil disimpan ke database. Namun email gagal dikirim.",
                    showHideTransition: 'slide',
                    icon: 'success',
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
                    text: "Informasi Berhasil disimpan ke database. Dan email berhasil terkirim ketujuan. Silahkan cek kotak keluar gmail Anda.",
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
