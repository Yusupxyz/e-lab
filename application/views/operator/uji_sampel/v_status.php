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
                <th>Kode Uji Sampel</th>
                <th>Pengambilan Oleh</th>
      					<th>Jenis Sampel</th>
      					<th>Jenis Wadah</th>
      					<th>Parameter Uji</th>
      					<th>No. Sampel Lab</th>
      					<th>Metode Pengujian</th>
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
          					   $us_no_sampel=$i['us_no_sampel'];  
          					   $us_metode=$i['us_metode'];                            
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $anggota_nama;?></td>
                  <td><?php echo $us_kode_sampel;?></td>
                  <td><?php echo $us_pengambilan;?></td>
                  <td><?php echo $js_nama;?></td>
                  <td><?php echo $jw_nama;?></td>
                  <td>
                    <a class="btn btn-xs btn-warning" href="#modalDetail<?php echo $us_id?>"  data-toggle="modal" title="Detail"><span class="fa fa-info"></span> Detail</a>
                  </td>
                  <td><?php echo $us_no_sampel;?></td>
                  <td><?php echo $us_metode;?></td>
                  <td><span class="<?= $status_class ?> alert" style="padding:5px"><?php echo $status_nama;?></span></td>
                  <td style="text-align:right;">
                    <?php if ($us_status_id!='3') { ?>
                      <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $us_id;?>"><span class="fa fa-pencil"></span></a>
                    <?php }else{  ?>
                      <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $us_id;?>"><span class="fa fa-trash"></span></a>
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
              $us_no_sampel=$i['us_no_sampel'];  
              $us_metode=$i['us_metode'];              
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
                      <label for="inputUserName" class="col-sm-4 control-label">No. Sampel Laboratorium</label>
                      <div class="col-sm-7">
                        <input type="text" name="xno" class="form-control" id="inputUserName" value="<?php echo $us_no_sampel;?>" placeholder="Masukkan No. Sampel Lab" required>
                      </div>
                                    </div>
                      <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Metode Pengujian</label>
                          <div class="col-sm-7">
                          <?php
                            echo form_dropdown('xmetode', $am, $us_metode, $attribute);
                        ?><br>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                          <div class="col-sm-7">
                          <?php
                            echo form_dropdown('xstatus', $status, $us_status_id, $attribute);
                        ?><br>
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
                    text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
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
</body>
</html>
