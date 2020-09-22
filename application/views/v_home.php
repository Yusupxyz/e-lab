<!DOCTYPE html>
<html class="no-js">
	<head>
	<?php 
		$this->load->view('template/v_top_frontend');
	?>

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
	<?php
            error_reporting(0);
            function limit_words($string, $word_limit){
                $words = explode(" ",$string);
                return implode(" ",array_splice($words,0,$word_limit));
            }

        ?>

	</head>
	<body>
	<?php 
		$this->load->view('template/v_menu');
	?>
	</header>
	<aside id="fh5co-hero" style="height: 560px;">
		<div class="flexslider " style="height: 560px;">
			<ul class="slides"  style="height: 560px;">
		   	<li style="background-image: url(<?php echo base_url().'theme/images/samuel-elias-nadler-48Ys7bUryKE-unsplash.jpg'?>);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center slider-text" style="height: 560px;">
		   				<div class="slider-text-inner">
		   					<h2 style="font-size: 30px;">Permudah Proses Uji Sampel Sekarang</h2>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

	<aside id="fh5co-hero" style="height: 560px;">
		<div class="flexslider " style="height: 560px;">
			<ul class="slides" style="height: 560px;">
			<?php foreach ($slider->result() as $key => $value) { ?>	
				<li style="background-image: url(<?php echo base_url().'assets/slider/'.$value->slider_foto?>);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="col-md-10 col-md-offset-1 text-center  slider-text" style="height: 560px;">
							<div class="slider-text-inner">
								<h2 style="font-size: 30px;"><font color="white"><?= $value->slider_promo ?></font></h2>
								<?php if($value->slider_tombol!=null) { ?>
									<p><a href="<?= $value->slider_link ?>" class="btn btn-primary btn-lg"><?= $value->slider_tombol ?></a></p>
								<?php } ?>
							</div>
						</div>
					</div>
				</li>
			<?php } ?>
		  	</ul>
	  	</div>
	</aside>

	


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
