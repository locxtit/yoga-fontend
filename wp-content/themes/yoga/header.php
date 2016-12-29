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
	<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body id ="blog" <?php body_class('main'); ?>>
	<header class="main-header">
		<div class="top-header">
			<div class="container">
			</div>
		</div>
		<div class="container">
			<div id="header">
				<h1 id="logo">
					<a href="/"><img src="/wp-content/uploads/2016/12/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
				</h1><!-- END #logo -->
				
				<nav id="navigation">
                <?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
                <?php } else { ?>
                    <ul class="menu">
                        <?php wp_list_categories('title_li='); ?>
                    </ul>
                <?php } ?>
            </nav>				
			</div><!--#header-->
		</div>
		<?php if(is_front_page()){?>
			<div class="slider">
				<?php masterslider(1); ?>
			</div>
			<div class="slogan">
				<h3>Chuyên cung cấp giáo viên dạy Yaga tại Nhà riêng, Công ty và các Trung tâm</h3>
			</div>
		<?php } ?>
		<div class="container">
		  <?php echo do_shortcode('[post-content post_name=home-yoga-for]'); ?>
		</div>
	</header>
	<div class="main-container">