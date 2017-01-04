<?php
function wpcf_Yoga_Home_News( $atts ){ 
    $catquery = new WP_Query( 'cat=4&posts_per_page=4' );
	ob_start();
	?>
	<div class="home-category clearfix row">
	<?php
	$index = 0;
	while($catquery->have_posts()) : $catquery->the_post();
	$index++;
	if($index == 1){
	?>
    <div class="col-md-6 latest-news">
		<div class="articledetail clearfix">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></a>
			<!--<p class=date-post><?php the_time('F j, Y'); ?></p>-->
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="article-summary"><?php the_excerpt();?></p>
			<!--<a <a href="<?php //the_permalink(); ?>" title="<?php //the_title(); ?>" class="read-more">Xem thêm >></a>-->
		</div> 
    </div>
	<?php
	}
	else{
		if($index == 2){
			?>
            <div class="col-md-6">
			<?php
		}
		?>
		<div class="articledetail clearfix">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></a>
			<!--<p class=date-post><?php the_time('F j, Y'); ?></p>-->
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="article-summary"><?php the_excerpt();?></p>
			<!--<a <a href="<?php //the_permalink(); ?>" title="<?php //the_title(); ?>" class="read-more">Xem thêm >></a>-->
		</div>
	<?php }
	 endwhile;
	 if($index > 1){
	 ?>
     </div>
     <?php
	 }
	 ?>
	</div>
<?php
	$list_post = ob_get_contents(); //Lấy toàn bộ nội dung phía trên bỏ vào biến $list_post để return
	ob_end_clean();
	return $list_post;
}	
?>
	