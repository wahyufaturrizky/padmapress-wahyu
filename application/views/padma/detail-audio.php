<!doctype html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

			<link rel="stylesheet" href="<?php echo base_url() .'assets/css/bootstrap.min.css'; ?>">
			<link rel="stylesheet" href="<?php echo base_url() .'assets/style.css'; ?>">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700%7CMontserrat:300,400,600,700">
			
			<link rel="stylesheet" href="<?php echo base_url() .'assets/icons/fontawesome/css/fontawesome-all.min.css'; ?>"><!-- FontAwesome Icons -->
			<link rel="stylesheet" href="<?php echo base_url() .'assets/icons/Iconsmind__Ultimate_Pack/Line%20icons/styles.min.css'; ?>"><!-- iconsmind.com Icons -->
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>	
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.css">
			
			<style>
			#overlay-wa { position: fixed; bottom:10px; right:10px; z-index:100;}
		</style>
		<title>Padmapress</title>
	</head>
	<body>
	<div id="overlay-wa">
		<a href="https://wa.me/6287878785856"><img class="img img-fluid" style="max-width: 70px;" src="<?php echo base_url() .'assets/images/wa.png'?>" class alt="" srcset="">
		</a>
	</div>
		<div id="sidebar-bg">
			
     	<header id="videohead-pro" class="sticky-header">
			<div id="video-logo-background"><a href="<?= base_url() ?>"><img src=" <?php echo base_url().'assets/padma_logo.png' ?>" alt="Logo"></a></div>
			<div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
			<div class="clearfix"></div>
			<?php $data['nav']='audio'; ?>
		
			<?php $this->load->view('padma/mobile-nav',$data) ?>
      	</header>
		
		
		  <?php $data['nav']='audio'; ?>
		
		<?php $this->load->view('padma/sidebar-nav',$data) ?>

		<main id="col-main">

			
			<div id="movie-detail-header-pro" class="banner_desktop" style="background-image:url('https://server.padmapress.com/<?= $detail->banner_desktop ?>')">
				
				
				<a class="movie-detail-header-play-btn afterglow" href="<?= $detail->url ?>" data-lity><i class="fas fa-play"></i></a>
				

				
				<div id="movie-detail-gradient-pro"></div>
			</div><!-- close #movie-detail-header-pro -->
			<div id="movie-detail-header-pro" class="banner_mobile" style="background-image:url('https://server.padmapress.com/<?= $detail->banner_mobile ?>')">
				
				
				<a class="movie-detail-header-play-btn afterglow" href="<?= $detail->url ?>" data-lity><i class="fas fa-play"></i></a>
				

				
				<div id="movie-detail-gradient-pro"></div>
			</div><!-- close #movie-detail-header-pro -->			
			
			<div id="movie-detail-rating">
				<div class="dashboard-container">
					<div class="row">
						<div class="col-sm">
							<h3><?= $detail->judul ?></h3>
						</div>
					</div><!-- close .row -->
				</div><!-- close .dashboard-container -->
			</div><!-- close #movie-detail-rating -->
			
			<div class="dashboard-container">
				
				
				<div class="movie-details-section">
					<h2>Deskripsi</h2>
					<p><?= $detail->deskripsi ?></p>
				</div><!-- close .movie-details-section -->

				<div class="movie-details-section">
					<h2>Buku Terkait</h2>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4 col-xl-3">
							<div class="item-playlist-container-skrn">
								<a href="<?php echo base_url().'welcome/katalog-detail/'.$related_books->slug ?>"><img src="http://server.padmapress.com/<?= $related_books->banner_desktop ?>" alt="Listing"></a>
								<div class="item-playlist-text-skrn">
									<?php $result = $this->my_query->get_data('nama_penulis as nama , foto as pic' , 'penulis' , ['id'=> $related_books->penulis_id ])->row(); ?>
									<img src="http://server.padmapress.com/<?= $result->pic ?>" alt="User Profile">
									<h5><a href="<?php echo base_url().'welcome/katalog-detail/'.$related_books->slug ?>"><?= $related_books->judul ?></a></h5>
									<h6>Oleh : <?= $result->nama ?></h6>
								</div><!-- close .item-listing-text-skrn -->
							</div><!-- close .item-playlist-container-skrn -->
						</div><!-- close .col -->
					</div><!-- close .row -->
				</div><!-- close .movie-details-section -->

					
				<div class="movie-details-section">
					<h2>Audio Terkait</h2>
					<div class="row">
					<?php if(count($related_audios)>0){ ?>
						<?php foreach($related_audios as $audio){ ?>
						<div class="col-12 col-md-6 col-lg-4 col-xl-6">
							<div class="item-listing-container-skrn">
								<a href="<?php echo base_url().'welcome/detail_audio/'.$audio->slug ?>"><iframe width="100%" height="280" src="https://www.youtube.com/embed/<?= explode("?v=",$audio->url)[1] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></a>
								<div class="item-listing-text-skrn">
									<div class="item-listing-text-skrn-vertical-align"><h6><a href="<?php echo base_url().'welcome/detail_audio/'.$audio->slug ?>"><?= $audio->judul ?></a></h6>
							
									</div><!-- close .item-listing-text-skrn-vertical-align -->
								</div><!-- close .item-listing-text-skrn -->
							</div><!-- close .item-listing-container-skrn -->
						</div><!-- close .col -->
						<?php } ?>
						<?php }else{ ?>			
						<div class="col-12 col-md-6 col-lg-4 col-xl-6">
							<div class="">
								<p>Audio belum ada</p>
							</div><!-- close .item-listing-container-skrn -->
						</div><!-- close .col -->
						<?php } ?>		
				</div><!-- close .movie-details-section -->
				
			</div><!-- close .dashboard-container -->
		</main>
		
		
		</div><!-- close #sidebar-bg-->
		
		<!-- Required Framework JavaScript -->
		<script src="<?php echo base_url() .'assets/js/libs/jquery-3.3.1.min.js'; ?>"></script><!-- jQuery -->
		<script src="<?php echo base_url() .'assets/js/libs/popper.min.js'; ?>" defer></script><!-- Bootstrap Popper/Extras JS -->
		<script src="<?php echo base_url() .'assets/js/libs/bootstrap.min.js'; ?>" defer></script><!-- Bootstrap Main JS -->
		<!-- All JavaScript in Footer -->
		
		<!-- Additional Plugins and JavaScript -->
		<script src="<?php echo base_url() .'assets/js/navigation.js'; ?>" defer></script><!-- Header Navigation JS Plugin -->
		<script src="<?php echo base_url() .'assets/js/jquery.flexslider-min.js'; ?>" defer></script><!-- FlexSlider JS Plugin -->
		<script src="<?php echo base_url() .'assets/js/jquery-asRange.min.js'; ?>" defer></script><!-- Range Slider JS Plugin -->
		<script src="<?php echo base_url() .'assets/js/circle-progress.min.js'; ?>" defer></script><!-- Circle Progress JS Plugin -->
		<script src="<?php echo base_url() .'assets/js/afterglow.min.js'; ?>" defer></script><!-- Video Player JS Plugin -->
		<script src="<?php echo base_url() .'assets/js/script.js'; ?>" defer></script><!-- Custom Document Ready JS -->
		<script src="<?php echo base_url() .'assets/js/script-dashboard.js'; ?>" defer></script><!-- Custom Document Ready for Dashboard Only JS -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js"></script>
		<script>
		    $( document ).ready(function() {
                if (window.matchMedia('(max-width: 768px)').matches) {
                    $('.banner_desktop').remove();
                } else {
                    $('.banner_mobile').remove();
                }
            });
		</script>  
		
	</body>
</html>