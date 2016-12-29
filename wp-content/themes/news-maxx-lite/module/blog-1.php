<div class="main-col pull-left">

    <?php news_maxx_lite_breadcrumb(); ?>
    <!-- breadcrumb -->

    <?php
    if ( is_active_sidebar( 'top-left' ) ) {
        dynamic_sidebar( 'top-left' );
    }
    ?>

    <section class="entry-list">
        <?php get_template_part( 'module/loop', 'blog-1' ); ?>
    </section>
    <!-- entry-list -->

</div>
<!-- main-col -->

<div class="sidebar widget-area-2 pull-left">
    <?php
    if ( is_active_sidebar('sidebar-right-top') ) {
        dynamic_sidebar('sidebar-right-top');
    }
    ?>

<div class="widget-area-7 pull-left">

    <?php
    if ( is_active_sidebar('sidebar-right-center-left') ) {
        dynamic_sidebar('sidebar-right-center-left');
    }
    ?>

</div>
<!-- widget-area-7 -->

<div class="widget-area-8 pull-left">

    <?php
    if ( is_active_sidebar('sidebar-right-center-right') ) {
        dynamic_sidebar('sidebar-right-center-right');
    }
    ?>

</div>
<!-- widget-area-8 -->

<div class="clear"></div>

    <?php
    if ( is_active_sidebar('sidebar-right-bottom') ) {
        dynamic_sidebar('sidebar-right-bottom');
    }
    ?>

</div>
<!-- widget-area-2 -->

<div class="clear"></div>