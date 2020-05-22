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
        Data Hasil Uji Sampel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Kelola Uji Sampel</a></li>
        <li class="active">Data Hasil Uji Sampel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">           
          <div class="box">
          <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#ModalSelesai<?php echo $kode;?>"><span class="fa fa-check-square-o"></span> Pengujian Selesai</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
					          <th>No.</th>
                    <th>Sifat</th>
                    <th>Parameter</th>
                    <th>Baku Mutu</th>
                    <th>Satuan</th>
                    <th>Hasil</th>
                    <th>Acuan Metode</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($data->result_array() as $i) :
                       $parameter_us=$i['parameter_us'];
                       $pu_nama=$i['pu_nama'];
                       $sp_jenis=$i['sp_jenis'];
                       $satuan_nama=$i['satuan_nama'];
                       $parameter_us_hasil=$i['parameter_us_hasil'];
                       $pu_mutu=$i['pu_mutu'];
                       $acuan_metode_nama=$i['acuan_metode_nama'];
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $sp_jenis;?></td>
                  <td><?php echo $pu_nama;?></td>
                  <td><?php echo $pu_mutu;?></td>
                  <td><?php echo $satuan_nama;?></td>
                  <td><?php echo $parameter_us_hasil;?></td>
                  <td><?php echo $acuan_metode_nama;?></td>
                  <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $parameter_us;?>"><span class="fa fa-pencil"></span></a>
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
  <footer class="main-footer">
    <?php $this->load->view('template/copyright'); ?>  
  </footer>


  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
		
		<?php foreach ($data->result_array() as $i) :
             $parameter_us=$i['parameter_us'];
             $pu_nama=$i['pu_nama'];
             $sp_jenis=$i['sp_jenis'];
             $satuan_nama=$i['satuan_nama'];
             $parameter_us_hasil=$i['parameter_us_hasil'];
             $pu_mutu=$i['pu_mutu'];
             $parameter_us_metode_id=$i['parameter_us_metode_id'];
             $parameter_us_satuan_id=$i['parameter_us_satuan_id'];
             $parameter_us_id=$i['parameter_us_id'];
            ?>
	<!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $parameter_us;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Hasil</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/update_hasil'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Sifat</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="xid" value="<?php echo $parameter_us;?>"/> 
                            <input type="hidden" name="xus_id" value="<?php echo $parameter_us_id;?>"/> 
                            <input type="text" readonly class="form-control" id="inputUserName" value="<?php echo $sp_jenis;?>" placeholder="Setting" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Parameter</label>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control" id="inputUserName" value="<?php echo $pu_nama;?>" placeholder="Data" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Baku Mutu</label>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control" id="inputUserName" value="<?php echo $pu_mutu;?>" placeholder="Data" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Acuan Metode</label>
                        <div class="col-sm-7">
                          <?php
                                echo form_dropdown('xmetode', $am, $parameter_us_metode_id, $attribute);
                          ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Hasil</label>
                        <div class="col-sm-7">
                            <input type="text" name="xhasil" class="form-control" id="inputUserName" value="<?php echo $parameter_us_hasil;?>" placeholder="Hasil Pengujian Sampel" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Satuan</label>
                        <div class="col-sm-7">
                          <?php
                                  echo form_dropdown('xsatuan', $satuan, $parameter_us_satuan_id, $attribute);
                            ?>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endforeach;?>
	
	<!--ModalSelesai-->
        <div class="modal fade" id="ModalSelesai<?php echo $kode;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi Pengujian Selesai</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/selesai'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">       
							       <input type="hidden" name="kode" value="<?php echo $kode;?>"/> 
                            <p>Apakah pengujian sampel telah benar-benar selesai pada hari ini ?</p>                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Selesai</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


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
    <?php elseif($this->session->flashdata('msg')=='warning'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Gambar yang Anda masukan terlalu besar.",
                    showHideTransition: 'slide',
                    icon: 'warning',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FFC017'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Pengguna Berhasil disimpan ke database.",
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
                    text: "Pengguna berhasil di update",
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
                    text: "Pengguna Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='show-modal'):?>
        <script type="text/javascript">
                $('#ModalResetPassword').modal('show');
        </script>
    <?php else:?>

    <?php endif;?>
</body>
</html>
