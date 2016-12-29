<?php $options = get_option('playbook'); ?>
<?php get_header(); ?>
<div id="page" class="container <?php if(is_front_page()) echo "full-size"; ?>">
	<div class="content">
		<article class="article">
			<div id="content_box" >
				<div id="content" class="hfeed">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
							<div class="single_page">
								<header>
									<?php if(!is_front_page()){ ?>
										<h1 class="title"><?php the_title(); ?></h1>
									<?php } ?>
								</header>
								<div class="post-content box mark-links">
									<?php the_content(); ?>
									<?php custom_link_pages(array('before' => '<div class="pagination">' . __(''), 'after' => '</div>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next'), 'previouspagelink' => __('Previous'), 'pagelink' => '%','echo' => 1 )); ?>
								</div><!--.post-content box mark-links-->
							</div>
						</div>
						<?php //comments_template( '', true ); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</article>
		<?php if(!is_front_page()) get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>