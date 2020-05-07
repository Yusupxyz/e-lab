<!--Counter Inbox-->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $jum_pesan=$query->num_rows();
    // $query1=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_Transaksi='0'");
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
        Transaksi Uji Sampel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Uji Sampel</a></li>
        <li class="active">Transaksi</li>
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
      					<th>Kode Uji Sampel</th>
      					<th>Total</th>
      					<th>Uang Muka</th>
      					<th>Sisa Pembayaran</th>
      					<th>Status</th>
      					<th>Aksi</th>
                </tr>
                </thead>
                <tbody>
          				<?php
          					$no=1;
          					foreach ($data->result_array() as $i) :
          					   $us_id=$i['us_id'];
          					   $us_kode_sampel=$i['us_kode_sampel'];         
          					   $us_total=$i['us_total'];                   
          					   $us_uang_muka=$i['us_uang_muka'];                   
          					   $us_sisa=$i['us_sisa'];                     
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $us_kode_sampel;?></td>
                  <td><?php echo "Rp ".number_format($us_total);?></td>
                  <td><?php echo "Rp ".number_format($us_uang_muka);?></td>
                  <td><?php echo "Rp ".number_format($us_sisa);?></td>
                  <td> <?php if ($us_sisa!=0){ ?>
                    <span class="alert-warning alert" style="padding:5px">Belum Lunas</span></td>
                  <?php }else{ ?>
                    <span class="alert-success alert" style="padding:5px">Lunas</span></td>
                  <?php } ?>
                  <td>
                    <a class="btn btn-xs btn-warning" href="#modalDetail<?php echo $us_id?>"  data-toggle="modal" title="Detail Transaksi"><span class="fa fa-info"></span> Detail</a>
                    <?php if ($us_sisa!=0){ ?>
                      <a class="btn btn-xs btn-success" href="#modalBayar<?php echo $us_id?>"  data-toggle="modal" title="Bayar Transaksi"><span class="fa fa-credit-card"></span> Bayar</a>
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
                        <h3 class="modal-title" id="myModalLabel">Detail Transaksi Parameter Uji</h3>
                    </div>
                        <div class="modal-body">
                        
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Parameter Uji</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <?php
                        foreach ($detail[$i++] as $key => $b) {
                        $pu_nama=$b['pu_nama'];
                        $pu_tarif=$b['pu_tarif'];
                        $sp_jenis=$b['sp_jenis'];
                    ?>
                            <tbody>
                           
                            <tr>
                                <td><?= $j++ ?></td>
                                <td><?= $pu_nama ?></td>
                                <td><?= $sp_jenis ?></td>
                                <td><?= $pu_tarif ?></td>
                            </tr>
                            </tbody>
                                            <?php
                    }
                        ?>
                        </table>
                        Total = Rp <?= $us_total ?> ,-
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
               $us_kode_sampel=$i['us_kode_sampel'];         
               $us_total=$i['us_total'];                   
               $us_uang_muka=$i['us_uang_muka'];                   
               $us_sisa=$i['us_sisa'];          
            ?>
	<!--Modal Bayar-->
        <div class="modal fade" id="modalBayar<?php echo $us_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Bayar Transaksi</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'operator/uji_sampel/bayar'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Total</label>
                      <div class="col-sm-7">
                        <input type="text" name="xno" class="form-control" id="inputUserName" value="Rp <?php echo number_format($us_total);?>" placeholder="Masukkan No. Sampel Lab" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Uang Muka</label>
                      <div class="col-sm-7">
                        <input type="text" name="xno" class="form-control" id="inputUserName" value="Rp <?php echo number_format($us_uang_muka);?>" placeholder="Masukkan No. Sampel Lab" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Sisa</label>
                      <div class="col-sm-7">
                        <input type="hidden" name="xsisa" class="form-control" id="inputUserName" value="<?php echo $us_sisa;?>" placeholder="Masukkan No. Sampel Lab" readonly>
                        <input type="text" name="x" class="form-control" id="inputUserName" value="Rp <?php echo number_format($us_sisa);?>" placeholder="Masukkan No. Sampel Lab" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Bayar (Rp)</label>
                      <div class="col-sm-7">
                        <input type="number" name="xbayar" class="form-control" id="inputUserName" placeholder="Masukkan Jumlah Pembayaran" max="<?php echo $us_sisa;?>" required>
                      </div>
                  </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" name="xid" value="<?php echo $us_id;?>" class="btn btn-primary btn-flat" id="simpan">Bayar</button>
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
<script>

</script>

</body>
</html>
