
	<?php
		error_reporting(0);
        $b=$data->row_array();
        $url=base_url().'artikel/'.$b['layanan_id'];
	    $ikon=base_url().'assets/layanan/'.$b['layanan_ikon'];
	    $nama=$b['layanan_nama'];
	    $teks=$b['layanan_teks'];
    ?>
<!DOCTYPE html>
<html class="no-js">
	<head>
	<?php 
		$this->load->view('template/v_top_frontend');
	?>

	<meta property="fb:app_id" content="966242223397117" />
    <meta property="og:locale" content="id_id" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $title;?>" />
    <meta property="og:description" content="<?php echo $deskripsi;?>" />
    <meta property="og:url" content="<?php echo $url?>" />
    <meta property="og:site_name" content="mfikri.com" />

    <meta property="article:section" content="<?php echo $author;?>" />
    <meta property="og:image" content="<?php echo $img?>" />
    <meta property="og:image:width" content="460" />
    <meta property="og:image:height" content="440" />

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

	<link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">

	<!-- Modernizr JS -->
	<script src="<?php echo base_url().'theme/js/modernizr-2.6.2.min.js'?>"></script>

	</head>
	<body>

	<?php 
		$this->load->view('template/v_menu');
	?>
	</header>


	<aside id="fh5co-hero" style="height: 560px;">
		<div class="flexslider " style="height: 560px;">
			<ul class="slides"  style="height: 560px;">
		   	<li style="background-image: url(<?php echo base_url().'theme/images/slide_6.jpg'?>);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center slider-text"  style="height: 560px;">
		   				<div class="slider-text-inner">
		   					<h2 style="font-size: 30px;">Layanan Laboratorium</h2>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>


	<div class="fh5co-pricing">
		<div class="container">


			<div class="row">

					<div class="col-md-12" style="display:inline; ">
					<div class="row">
					<h1 style="margin-bottom:0px;"><a href="<?php echo $url;?>"><?php echo $nama;?></a></h1>
					<br>
					<div class="col-md-4">
							<figure>
								<img src="<?php echo $ikon;?>" alt="ikon" class="img-responsive">
							</figure>
							</div>
							<div class="col-md-8" style="text-align: justify;">
							<p ><?php echo $teks;?></p>
							</div>
						</div>
						<br><br>
						<h4>Share:</h4>
						<div>
							<a class="popup2 btn btn-info btn-sm" target="_parent" href="https://www.facebook.com/dialog/share?app_id=966242223397117&display=popup&href=<?php echo $url;?>" title="Bagikan ke Facebook"><i class="fa fa-facebook"></i> Facebook</a>
							<a class="popup2 btn btn-info btn-sm" href="http://twitter.com/share?source=sharethiscom&text=<?php echo $b['tulisan_judul'];?>&url=<?php echo $url; ?>&via=badoey" title="Bagikan ke Twitter"><i class="fa fa-twitter"></i> Twitter</a>
						</div>
					</div>


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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btncari').hide();
		});
	</script>
	<script>
        jQuery(document).ready(function($) {
          $('.popup2').click(function(event) {
            var width  = 575,
                height = 400,
                left   = ($(window).width()  - width)  / 2,
                top    = ($(window).height() - height) / 2,
                url    = this.href,
                opts   = 'status=1' +
                         ',width='  + width  +
                         ',height=' + height +
                         ',top='    + top    +
                         ',left='   + left;
            window.open(url, 'facebook', opts);
            return false;
          });
        });
	</script>

	</body>
</html>
