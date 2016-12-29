
<?php
if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

<?php ?>

    <div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">
        <?php the_content(); ?>
    </div>

    <?php wp_link_pages( array(
        'before' => '<div class="wrap-page-links clearfix">
                          <div class="page-links pull-right">
                          <span class="page-links-title">'.__( 'Pages:', 'news-maxx-lite' ).'</span>',
        'after'  => '</div></div>',
    ) ); ?>

    <?php comments_template(); ?>
    
<?php } // endwhile
} // endif
?>