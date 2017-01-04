<!DOCTYPE html>
<?php $options = get_option('playbook'); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?></title>
	<?php mts_meta(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<?php mts_head(); ?>
	<link href="/wp-content/themes/yoga/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<?php wp_head(); ?>
    <script src="/wp-content/themes/yoga/js/jquery.js"></script>
	<script src="/wp-content/themes/yoga/bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script src="/wp-content/themes/yoga/js/jquery.bxslider.js"></script>
    <script src="/wp-content/themes/yoga/js/rainbow.min.js"></script>
    <script src="/wp-content/themes/yoga/js/scripts.js"></script>
    <script>
		$(document).ready(function(){
		  $('.slider4').bxSlider({
  			auto: true,
			slideWidth: 200,
			minSlides: 2,
			maxSlides: 5,
			moveSlides: 1,
			slideMargin: 20
		  });
		});
	</script>
	<link rel="stylesheet" href="/wp-content/themes/yoga/css/jquery.bxslider.css">
	<link rel="stylesheet" href="/wp-content/themes/yoga/css/custom.css">
</head>
<?php flush(); ?>
<body id ="blog" <?php body_class('main'); ?>>
	<header class="main-header">
		<div class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-xs-5 clearfix social">
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-google-plus"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
					</div>
					<div class="col-md-8 col-xs-7 hotline">
						<i class="fa fa-phone"></i>
						<strong>093396698<span>-</span>0971525048</strong>
					</div>
				</div>
			</div>
		</div>
		
		<nav class="navbar navbar-default">
			<div class="container clearfix">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="/wp-content/uploads/2016/12/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?php //if ( has_nav_menu( 'primary-menu' ) ) { ?>
                    <?php //wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
					<?php //} else { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'nav navbar-nav navbar-right', 'container' => '' ) ); ?>
						
					<?php //} ?>
					<!--ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
						<li><a href="../navbar-static-top/">Static top</a></li>
						<li><a href="../navbar-fixed-top/">Fixed top</a></li>
					</ul-->
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
		
		<!--div class="container">
			<div id="header">
				<h1 id="logo">
					<a href="/"><img src="/wp-content/uploads/2016/12/logo.png" alt="<?php //bloginfo( 'name' ); ?>"></a>
				</h1>
				
				<nav id="navigation">
                <?php //if ( has_nav_menu( 'primary-menu' ) ) { ?>
                    <?php //wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
                <?php //} else { ?>
                    <ul class="menu">
                        <?php //wp_list_categories('title_li='); ?>
                    </ul>
                <?php //} ?>
            </nav>				
			</div>
		</div-->
		
		<?php if(is_front_page()){?>
			<div class="slider">
				<?php masterslider(1); ?>
			</div>
			<!--div class="slogan">
				<h3>Chuyên cung cấp giáo viên dạy Yaga tại Nhà riêng, Công ty và các Trung tâm</h3>
			</div-->
		<?php } ?>
		  <?php echo do_shortcode('[post-content post_name=home-yoga-for]'); ?>
	</header>
	<div class="main-container">