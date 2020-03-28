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
			<div id="video-logo-background"><a href="<?= base_url() .'welcome/index' ?>"><img src=" <?php echo base_url().'assets/padma_logo.png' ?>" alt="Logo"></a></div>
			
			<div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
			
			
			
			<div class="clearfix"></div>
			
			<?php $data['nav']='tentang'; ?>
		
			<?php $this->load->view('padma/mobile-nav',$data) ?>
			
      </header>
      <?php $data['nav']='tentang'; ?>
		
			<?php $this->load->view('padma/sidebar-nav',$data) ?>

		<main id="col-main">
              
              <div id="content-pro">
                  
                     <div class="container">
                      
                    <h1 class="text-center">Tentang Padmapress</h1>
                      <div class="row mt-3">
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                              <img src="https://server.padmapress.com/<?php echo $tentang->foto_1 ?>" class="img-fluid" alt="Watch in Any Devices">
                          </div>
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                                <h2 class="short-border-bottom"><?php echo $tentang->header_1 ?></h2>
                              <p><?php echo $tentang->deskripsi_1 ?></p>
                              <div style="height:15px;"></div>
                            </div>
                      </div><!-- close .row -->
                      
                      
                      <div class="row">
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                                <h2 class="short-border-bottom"><?php echo $tentang->header_2 ?></h2>
                              <p><?php echo $tentang->deskripsi_2 ?></p>
                              <div style="height:15px;"></div>
                             </div>
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                              <img src="https://server.padmapress.com/<?php echo $tentang->foto_2 ?>" class="img-fluid" alt="Make Your Own Playlist">
                          </div>
                      </div><!-- close .row -->
                      
                      
                      <div class="row">
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                              <img src="https://server.padmapress.com/<?php echo $tentang->foto_3 ?>" class="img-fluid" alt="Watch in Ultra HD">
                          </div>
                          <div class="col-md my-auto"><!-- .my-auto vertically centers contents -->
                                <h2 class="short-border-bottom"><?php echo $tentang->header_3 ?></h2>
                              <p><?php echo $tentang->deskripsi_3 ?></p>
                              <div style="height:15px;"></div>
                         </div>
                      </div><!-- close .row -->
                      
                      <div style="height:35px;"></div>
                      
                      <div class="clearfix"></div>
                  </div><!-- close .container -->
                  
                  
                  <hr>
                  
                  <!--div class="progression-pricing-section-background">
                  
                  </div><!-- close .progression-pricing-section-background -->
                  
              </div><!-- close #content-pro -->
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
			$('.issue-class').slick({
  				autoplaySpeed: 5000,
				slidesToShow: 8,
				slidesToScroll: 1,
				prevArrow:'<button class="slick-prev  d-none"> < </button>',
				nextArrow:'<button class="slick-next d-none"> > </button>',
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 6,
						slidesToScroll: 1,
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			});
			$('.video-class').slick({
  				autoplaySpeed: 5000,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow:'<button class="slick-prev  d-none"> < </button>',
				nextArrow:'<button class="slick-next d-none"> > </button>',
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			});
			$('.katalog-class').slick({
  				autoplaySpeed: 5000,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow:'<button class="slick-prev  d-none"> < </button>',
				nextArrow:'<button class="slick-next d-none"> > </button>',
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			});
			$('#issue-next').on('click',function(){
				$('.issue-class').slick('slickNext');
			});
			$('#issue-prev').on('click',function(){
				$('.issue-class').slick('slickPrev');
			});
			$('#video-next').on('click',function(){
				$('.video-class').slick('slickNext');
			});
			$('#video-prev').on('click',function(){
				$('.video-class').slick('slickPrev');
			});
			$('#katalog-next').on('click',function(){
				$('.katalog-class').slick('slickNext');
			});
			$('#katalog-prev').on('click',function(){
				$('.katalog-class').slick('slickPrev');
			});
		</script>
	</body>
</html>