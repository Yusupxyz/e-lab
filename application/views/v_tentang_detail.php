
<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
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

	</head>
	<body>

	<?php 
		$this->load->view('template/v_menu');
	?>
	</header>


	<aside id="fh5co-hero" clsas="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li style="background-image: url(<?php echo base_url().'theme/images/slide_3.jpg'?>);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>Tentang Kami</h2>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>	

	<div class="fh5co-about animate-box">
		<div class="col-md-10 col-md-offset-1 text-center fh5co-heading">
			<h2><?= $data->tentang_judul ?></h2>
			<p><?= $data->tentang_isi ?></p>
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
	<!-- Flexslider -->
	<script src="<?php echo base_url().'theme/js/jquery.flexslider-min.js'?>"></script>

	<!-- MAIN JS -->
	<script src="<?php echo base_url().'theme/js/main.js'?>"></script>

	</body>
</html>
