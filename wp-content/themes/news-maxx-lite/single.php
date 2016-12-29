<?php get_header(); ?>

<div class="wrapper clearfix">
<div class="main-col pull-left">

    <?php news_maxx_lite_breadcrumb();?>
    <!-- breadcrumb -->

    <?php get_template_part( 'module/loop', 'single' ); ?>

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