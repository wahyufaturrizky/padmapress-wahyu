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
				<a href="<?= base_url() .'welcome/index' ?>"><img src="<?php echo base_url().'assets/padma_logo.png' ?>" alt="Logo"></a>
			</div>
			
			<div id="video-search-header">
				<form action="<?= base_url() ?>Welcome/video" method="GET">
					<input name="s" type="text" placeholder="Cari Judul video disini" aria-label="Search">
				</form>
			</div>
			<div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
			
			
			
			<div class="clearfix"></div>
			
			<?php $data['nav']='video'; ?>
		
			<?php $this->load->view('padma/mobile-nav',$data) ?>
			
      </header>
		
		
	  <?php $data['nav']='video'; ?>
		
	  <?php $this->load->view('padma/sidebar-nav',$data) ?>
	
		<main id="col-main">
			<iframe src="https://www.youtube.com/embed/<?= explode("?v=",$headline->url)[1] ?>" style="height:600px;width:100%" class="ifr-video">
			</iframe>
			<ul class="dashboard-genres-pro row"  <?php echo isset($_GET['s']) ? 'style="display:none;margin-top:20px;" ' : '';  ?>>
				<div id="issue-prev" class="col-md-1 col-sm-1 col-3 col float-left"><button class="btn btn-info"><</button></div>
				<div id="issue-next" class="col-md-1 col-sm-1 col-3 float-right"><button class="btn btn-info">></button></div>
				<div class="col-md-10 col-sm-10 col-6 float-left issue-class">
				<?php foreach($program as $programs): ?>
				<li class=" <?php echo ($programs->id == $_GET['program_id']) ? 'active' : ''; ?> ">
					<a href="<?= base_url('welcome/video?program_id=').$programs->id ?>">
					<h6><?= $programs->program ?></h6>
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

				<?php if ( ! isset($_GET['s'])){ ?>
				<?php $program =  $this->my_query->get_data('*' , 'program' , ['id' => $program_id ])->row(); ?>
				<h4 class="heading-extra-margin-bottom"> <?php echo $program->program ?></h4>
				<?php } ?>
				<div class="row">
					<?php if(count($video) ){ ?> 
					<?php foreach ($video as $vid): ?>
						
					<div class="col-12 col-md-6 col-lg-4 col-xl-6">
						<div class="item-listing-container-skrn">
							<a href=" <?php echo base_url().'welcome/detail_video/'.$vid->slug ?>"><iframe width="100%"class="video-list-frame" src="https://www.youtube.com/embed/<?= explode("?v=",$vid->url)[1] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></a>
							<div class="item-listing-text-skrn">
								<div class="item-listing-text-skrn-vertical-align"><h6><a href="<?php echo base_url().'welcome/detail_video/'.$vid->slug ?>"><?= $vid->judul ?></a></h6>
						
								</div><!-- close .item-listing-text-skrn-vertical-align -->
							</div><!-- close .item-listing-text-skrn -->
						</div><!-- close .item-listing-container-skrn -->
					</div><!-- close .col -->
					<?php endforeach ?>
					
					
				</div><!-- close .row -->
				
				<?php if( ! isset($_GET['s']) ){ ?>
				<ul class="page-numbers">
					<?php if ($_GET['page'] != 1){ ?>
					<li><a class="previous page-numbers" href="<?= base_url() .'welcome/video?program_id='.$_GET['program_id'].'&page='.($_GET['page'] - 1) ?>"><i class="fas fa-chevron-left"></i></a></li> <!-- //prev -->
					<?php }  ?>
					<!-- <li><span class="page-numbers current">1</span></li> -->
					<?php for ($i=1; $i<=$pages ; $i++){ ?>
					<li><a class="page-numbers <?php echo ($_GET['page'] == $i) ? 'current' : ''; ?>" href="<?= base_url() .'welcome/video?program_id='.$_GET['program_id'].'&page='.$i ?>"><?= $i ?></a></li>
					<?php } ?>
					
					<?php if ($_GET['page'] != $pages){ ?>
					<li><a class="next page-numbers" href="<?= base_url() .'welcome/video?program_id='.$_GET['program_id'].'&page='.($_GET['page'] + 1) ?>"><i class="fas fa-chevron-right"></i></a></li> <!-- next -->
					<?php }  ?>
				<?php } ?>
				</ul>
				<?php } else { ?>

					<div class="col-xl-8 offset-xl-2" style="height:350px;">
						
						<h2 class="text-center">
							Maaf tidak ada Video Tersebut
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
		<script src="<?php echo base_url() .'assets/js/script-dashboard.js'; ?>" defer></script>
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
			$('#issue-next').on('click',function(){
				$('.issue-class').slick('slickNext');
			});
			$('#issue-prev').on('click',function(){
				$('.issue-class').slick('slickPrev');
			});
		</script>
	</body>
</html>