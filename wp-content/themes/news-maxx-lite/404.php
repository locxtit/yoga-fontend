<?php
    get_header();
?>
<div class="wrapper clearfix">

    <div class="main-col pull-left">
        <?php news_maxx_lite_breadcrumb(); ?>
        <!-- breadcrumb -->
        <section class="error-404 clearfix">
            <div class="left-col">
                <p><?php _e( '404', 'news-maxx-lite' ); ?></p>
            </div><!--left-col-->
            <div class="right-col">
                <h1<?php _e( 'Page not found...', 'news-maxx-lite' ); ?></h1>
                <p><?php _e( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of these options:", 'news-maxx-lite' ); ?></p>
                <ul class="arrow-list">
                    <li><a href="javascript: history.go(-1);"><?php _e( 'Go back to previous page', 'news-maxx-lite' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Go to homepage', 'news-maxx-lite' ); ?></a></li>
                </ul>
            </div><!--right-col-->
        </section><!--error-404-->
    </div>
    <!-- main-col -->

    <div class="sidebar widget-area-2 pull-left">
        <?php
        if ( is_active_sidebar('sidebar-right-top') ) {
            dynamic_sidebar('sidebar-right-top');
        }
        ?>
    </div>
    <!-- widget-area-2 -->

    <div class="clear"></div>

</div>
<!-- wrapper -->
<?php get_footer(); ?>
