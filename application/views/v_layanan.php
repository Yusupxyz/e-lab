
<!DOCTYPE html>
<html class="no-js">
	<head>
	<?php 
		$this->load->view('template/v_top_frontend');
	?>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo base_url().'theme/css/animate.css'?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo base_url().'theme/css/icomoon.css'?>">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo base_url().'theme/css/bootstrap.css'?>">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="<?php echo base_url().'theme/css/flexslider.css'?>">
	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php echo base_url().'theme/css/style.css'?>">

	<!-- Modernizr JS -->
	<script src="<?php echo base_url().'theme/js/modernizr-2.6.2.min.js'?>"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<?php 
		$this->load->view('template/v_menu');
	?>
	</header>


	<aside id="fh5co-hero" style="height: 560px;">
		<div class="flexslider " style="height: 560px;">
			<ul class="slides"  style="height: 560px;">
		   	<li style="background-image: url(<?php echo base_url().'theme/images/thomas-peham-bJVvTYBXms4-unsplash.jpg'?>);" >
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center  slider-text" style="height: 560px;">
		   				<div class="slider-text-inner" style="height: 560px;">
		   					<h2 style="font-size: 30px;">Semua Layanan Kami</h2>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>



	<div id="fh5co-grid-products" class="animate-box" >
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Layanan Laboratorium</h2>
					<p>Beberapa layanan yang tersedia</p>
				</div>
			</div>
		</div>
		<?php
			foreach ($data->result_array() as $i) :
				$layanan_id=$i['layanan_id'];
				$layanan_nama=$i['layanan_nama'];
				$layanan_ikon=$i['layanan_ikon'];
				$layanan_teks=$i['layanan_teks'];

		?>
		<div class="col-md-3" align="center">
			<a href="<?php echo base_url().'layanan/detail/'.$layanan_id;?>" style="padding:1px"><img src="<?php echo base_url().'assets/layanan/'.$layanan_ikon;?>" class="img-responsive"></a>
				<div class="v-align">
					<div class="v-align-middle" >
						<h3 class="title" style="color:black"><?php echo $layanan_nama;?></h3>
						<h6 class="category" style="color:black">Klik gambar untuk detail info</h6>
					</div>
				</div><br/>
		</div>
		<?php endforeach;?>


	</div>
	<br/>
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<br/>
					<p><?php echo $page;?></p>
				</div>
			</div>
	</div>

	<?php $this->load->view('template/v_footer');?>
	</div>



	<!-- jQuery -->
	<script src="<?php echo base_url().'theme/js/jquery.min.js'?>"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo base_url().'theme/js/jquery.easing.1.3.js'?>"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url().'theme/js/bootstrap.min.js'?>"></script>
	<!-- Waypoints -->
	<script src="<?php echo base_url().'theme/js/jquery.waypoints.min.js'?>"></script>
	<!-- Easy PieChart -->
	<script src="<?php echo base_url().'theme/js/jquery.easypiechart.min.js'?>"></script>
	<!-- Flexslider -->
	<script src="<?php echo base_url().'theme/js/jquery.flexslider-min.js'?>"></script>
	<!-- Stellar -->
	<script src="<?php echo base_url().'theme/js/jquery.stellar.min.js'?>"></script>

	<!-- MAIN JS -->
	<script src="<?php echo base_url().'theme/js/main.js'?>"></script>

	</body>
</html>
