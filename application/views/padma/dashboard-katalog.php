<!doctype html>
<?php 
  if ( ! isset($_GET['page'])){
		$_GET['page'] = 1;
  }   
 ?>
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
			<div id="video-logo-background">
				<a href="<?= base_url() ?>"><img src="<?php echo base_url().'assets/padma_logo.png' ?>" alt="Logo"></a>
			</div>
			
			<div id="video-search-header">
				<form action="<?= base_url() ?>Welcome/katalog" method="GET">
					<input name="s" type="text" placeholder="Cari Catalog disini" aria-label="Search">
				</form>
			</div>
			<div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
			
			
			
			<div class="clearfix"></div>
			
			
			<?php $data['nav']='katalog'; ?>
		
			<?php $this->load->view('padma/mobile-nav',$data) ?>
			
      </header>
		
		
	   <?php $data['nav']='katalog'; ?>
		
		<?php $this->load->view('padma/sidebar-nav',$data) ?>

		<main id="col-main">
			
			
			
			
			<div class="flexslider progression-studios-dashboard-slider" id="katalogslide">
		      <ul class="slides">
			  <?php if(count($headline)){ ?>  
			  <?php foreach($headline as $head): ?>
					<li class="progression_studios_animate_left banner_desktop">
						<div class="progression-studios-slider-dashboard-image-background" style="background-color: #fff;background-image:url('https://server.padmapress.com/<?= $head->banner_desktop ?>');">
							<div class="progression-studios-slider-display-table">
								<div class="progression-studios-slider-vertical-align">
									<div class="container">
										<div class="progression-studios-slider-dashboard-caption-width">
											<div class="progression-studios-slider-caption-align">
												<h2><a href="<?= base_url().'welcome/detail_katalog/'.$head->slug ?>"><?= $head->judul ?></a></h2>
												
												<p class="progression-studios-slider-description"><?= $head->deskripsi ?></p>
												
												<div class="clearfix"></div>      
												
											</div><!-- close .progression-studios-slider-caption-align -->
										</div><!-- close .progression-studios-slider-caption-width -->
									
									</div><!-- close .container -->
								
								</div><!-- close .progression-studios-slider-vertical-align -->
							</div><!-- close .progression-studios-slider-display-table -->
						
							<div class="progression-studios-slider-mobile-background-cover"></div>
						</div><!-- close .progression-studios-slider-image-background -->
					</li>
					<?php endforeach ?>
			 		<?php foreach($headline as $head): ?>
					<li class="progression_studios_animate_left banner_mobile">
						<div class="progression-studios-slider-dashboard-image-background" style="background-image:url('https://server.padmapress.com/<?= $head->banner_mobile ?>');">
							<div class="progression-studios-slider-display-table">
								<div class="progression-studios-slider-vertical-align">
								
									<div class="container">
										
										
									
										<div class="progression-studios-slider-dashboard-caption-width">
											<div class="progression-studios-slider-caption-align">
												
												<h2><a href="<?= base_url().'welcome/detail_katalog/'.$head->slug ?>"><?= $head->judul ?></a></h2>
												
												<div class="progression-studios-slider-description">
												    <p class="mobi-hide"><?= $head->deskripsi ?></p>
												    <a href="<?= base_url().'welcome/detail_katalog/'.$head->slug ?>" class="btn btn-green-pro btn-katalog-head">Baca Selengkapnya</a>
												</div>
												
												<div class="clearfix"></div>      
												
											</div><!-- close .progression-studios-slider-caption-align -->
										</div><!-- close .progression-studios-slider-caption-width -->
									
									</div><!-- close .container -->
								
								</div><!-- close .progression-studios-slider-vertical-align -->
							</div><!-- close .progression-studios-slider-display-table -->
						
							<div class="progression-studios-slider-mobile-background-cover"></div>
						</div><!-- close .progression-studios-slider-image-background -->
					</li>
					<?php endforeach ?>
			  <?php }else{ ?>
				<?php $head=$this->my_query->query('SELECT * FROM `buku` order by id desc limit 1')->row(); ?>
				<li class="progression_studios_animate_left banner_desktop">
						<div class="progression-studios-slider-dashboard-image-background" style="background-image:url('https://server.padmapress.com/<?= $head->banner_desktop ?>');">
							<div class="progression-studios-slider-display-table">
								<div class="progression-studios-slider-vertical-align">
								
									<div class="container">
										
										
									
										<div class="progression-studios-slider-dashboard-caption-width">
											<div class="progression-studios-slider-caption-align">
												
												<h2><a href="<?= base_url().'welcome/detail_katalog/'.$head->slug ?>"><?= $head->judul ?></a></h2>
												
												<p class="progression-studios-slider-description"><?= $head->deskripsi ?></p>
												
												
												<div class="clearfix"></div>      
												
											</div><!-- close .progression-studios-slider-caption-align -->
										</div><!-- close .progression-studios-slider-caption-width -->
									
									</div><!-- close .container -->
								
								</div><!-- close .progression-studios-slider-vertical-align -->
							</div><!-- close .progression-studios-slider-display-table -->
						
							<div class="progression-studios-slider-mobile-background-cover"></div>
						</div><!-- close .progression-studios-slider-image-background -->
					</li>
					<li class="progression_studios_animate_left banner_mobile">
						<div class="progression-studios-slider-dashboard-image-background" style="background-image:url('https://server.padmapress.com/<?= $head->banner_mobile ?>');">
							<div class="progression-studios-slider-display-table">
								<div class="progression-studios-slider-vertical-align">
								
									<div class="container">
										
										
									
										<div class="progression-studios-slider-dashboard-caption-width">
											<div class="progression-studios-slider-caption-align">
												
												<h2><a href="<?= base_url().'welcome/detail_katalog/'.$head->slug ?>"><?= $head->judul ?></a></h2>
												
												<p class="progression-studios-slider-description"><?= $head->deskripsi ?></p>
												
												
												<div class="clearfix"></div>      
												
											</div><!-- close .progression-studios-slider-caption-align -->
										</div><!-- close .progression-studios-slider-caption-width -->
									
									</div><!-- close .container -->
								
								</div><!-- close .progression-studios-slider-vertical-align -->
							</div><!-- close .progression-studios-slider-display-table -->
						
							<div class="progression-studios-slider-mobile-background-cover"></div>
						</div><!-- close .progression-studios-slider-image-background -->
					</li>
				<?php } ?>
				</ul>
			</div><!-- close .progression-studios-slider - See /js/script.js file for options -->
			

			<ul class="dashboard-genres-pro row"  <?php echo isset($_GET['s']) ? 'style="display:none;margin-top:20px;" ' : '';  ?>  >
				<div id="penulis-prev" class="col-md-1 col-sm-1 col-3 col float-left"><button class="btn btn-info"><</button></div>
				<div id="penulis-next" class="col-md-1 col-sm-1 col-3 float-right"><button class="btn btn-info">></button></div>
				<div class="col-md-10 col-sm-10 col-6 float-left penulis-class">
				<?php foreach($penulis as $writer): ?>
				<li class=" <?php echo ($writer->id == $_GET['penulis_id']) ? 'active' : ''; ?> ">
					<a href="<?= base_url('welcome/katalog?penulis_id=').$writer->id ?>">
					<h6><?= $writer->nama_penulis ?></h6>
					</a>
				</li>
				<?php endforeach ?>
			</div>
			</ul>
			
			<div class="clearfix"></div>
			
				<div class="dashboard-container">

				<div class="row">
					<br>

					 <?php echo isset($_GET['s']) ? 'Hasil pencarian dengan kata kunci "'.$_GET['s'].'"' : '';  ?>
					<br>
					<br>
				</div>
				
				<div class="row">
				<?php if(count($book) > 0 ){ ?> 
					<?php foreach($book as $buku){ ?>
						<div class="col-12 col-md-6 col-lg-4 col-xl-3">
							<div class="item-playlist-container-skrn">
								<a href="<?php echo base_url().'welcome/detail_katalog/'.$buku->slug ?>"><img src="http://server.padmapress.com/<?= $buku->banner_desktop ?>" alt="Listing"></a>
								<div class="item-playlist-text-skrn">
									<?php $result = $this->my_query->get_data('nama_penulis as nama , foto as pic' , 'penulis' , ['id'=> $_GET['penulis_id'] ])->row(); ?>
									<img src="http://server.padmapress.com/<?= $result->pic ?>" alt="User Profile">
									<h5><a href="<?php echo base_url().'welcome/detail_katalog/'.$buku->slug ?>"><?= $buku->judul ?></a></h5>
									<h6>Oleh : <?= $result->nama ?></h6>
								</div><!-- close .item-listing-text-skrn -->
							</div><!-- close .item-playlist-container-skrn -->
						</div><!-- close .col -->
					<?php } ?>
					
					
				</div><!-- close .row -->
					<?php if( ! isset($_GET['s']) ){ ?>
					<ul class="page-numbers">
						<?php if ($_GET['page'] != 1){ ?>
						<li><a class="previous page-numbers" href="<?= base_url() .'welcome/katalog?penulis_id='.$_GET['penulis_id'].'&page='.($_GET['page'] - 1) ?>"><i class="fas fa-chevron-left"></i></a></li> <!-- //prev -->
						<?php }  ?>
						<!-- <li><span class="page-numbers current">1</span></li> -->
						<?php for ($i=1; $i<=$pages ; $i++){ ?>
						<li><a class="page-numbers <?php echo ($_GET['page'] == $i) ? 'current' : ''; ?>" href="<?= base_url() .'welcome/katalog?penulis_id='.$_GET['penulis_id'].'&page='.$i ?>"><?= $i ?></a></li>
						<?php } ?>
						
						<?php if ($_GET['page'] != $pages){ ?>
						<li><a class="next page-numbers" href="<?= base_url() .'welcome/katalog?penulis_id='.$_GET['penulis_id'].'&page='.($_GET['page'] + 1) ?>"><i class="fas fa-chevron-right"></i></a></li> <!-- next -->
						<?php }  ?>
					</ul>
					<?php } ?>

				<?php } else { ?>
				
					<div class="col-xl-8 offset-xl-2" style="height:350px;">
						
						<h2 class="text-center">
							Maaf tidak ada Catalog Tersebut
						</h2>
					</div>

				<?php } ?>
						
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
			$('.penulis-class').slick({
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
			$('#penulis-next').on('click',function(){
				$('.penulis-class').slick('slickNext');
			});
			$('#penulis-prev').on('click',function(){
				$('.penulis-class').slick('slickPrev');
			});
		</script>
	</body>
</html>