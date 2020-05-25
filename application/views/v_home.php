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

	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
			<?php foreach ($slider->result() as $key => $value) { ?>	
				<li style="background-image: url(<?php echo base_url().'assets/slider/'.$value->slider_foto?>);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
							<div class="slider-text-inner">
								<h2 ><font color="white"><?= $value->slider_promo ?></font></h2>
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

	<div id="fh5co-why-us" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4 text-center">
					<img src="<?php echo base_url().'assets/kepala/001-man.png'?>"  onerror="this.src='<?php echo base_url().'assets/kepala/001-man.png'?>">
					<h3>Bowo Budiarso, ST</h3>
					<p>Kepala UPTD. Laboratorium Lingkungan
					<br>
					Dinas Lingkungan Hidup Kota Palangka Raya</p>
				</div>
				<div class="col-md-8 text-center item-block">
					<h2>Sambutan Pimpinan</h2>
					<p>Puji syukur kehadirat Tuhan Y.M.E. dengan rahmat dan hidayah-Nya Official Web UPT Laboratorium Lingkungan telah hadir. Diharapkan dengan adanya Official Web ini dapat bermanfaat dalam mengembangkan masyarakat yang informatif. Web ini menyediakan informasi seputar pelatihan kerja.</p>
					<!-- <p><a href="<?php echo base_url().'sambutan'?>" class="btn btn-primary btn-outline with-arrow">Selengkapnya <i class="icon-arrow-right"></i></a></p> -->
				</div>
			</div>
		</div>
	</div>


	<div class="fh5co-section-with-image">

		<img src="<?php echo base_url().'theme/images/image_1.jpg'?>" alt="" class="img-responsive">
		<div class="fh5co-box animate-box">
			<h2>Layanan Laboratorium</h2>
			<p>Dapatkan informasi mengenai jenis layanan laboratorium serta tarif yang berlaku.</p>
			<p><a href="<?php echo base_url().'layanan'?>" class="btn btn-primary btn-outline with-arrow">Lanjut <i class="icon-arrow-right"></i></a></p>
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
