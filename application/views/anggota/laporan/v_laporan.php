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
    $this->load->view('anggota/template/v_header');
    ?>
<!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('anggota/template/left_menu'); ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Uji Sampel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Uji Sampel</a></li>
        <li class="active">Laporan</li>
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
      					<th>Laporan</th>
                </tr>
                </thead>
                <tbody>
          				<?php
          					$no=1;
          					foreach ($data->result_array() as $i) :
          					   $us_id=$i['us_id'];
          					   $us_kode_sampel=$i['us_kode_sampel'];
          					   $us_laporan=$i['us_laporan'];                     
                    ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $us_kode_sampel;?></td>
                  <td style="text-align:right;">
                        <a class="btn" href="<?php echo base_url().'assets/file_laporan/'.$us_laporan;?>"><span class="fa fa-download"></span></a>
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
