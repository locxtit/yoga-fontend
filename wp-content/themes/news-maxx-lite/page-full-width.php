<?php
/**
 * Template Name: Page Full Width
 */
get_header(); ?>
<div class="wrapper clearfix">

    <div class="main-col pull-left">

        <?php news_maxx_lite_breadcrumb();?>
        <!-- breadcrumb -->
        <section class="elements-box">
            <?php get_template_part( 'module/loop', 'page' ); ?>
        </section>
    </div>
    <!-- main-col -->
    <div class="clear"></div>

</div>
<!-- wrapper -->
<?php get_footer(); ?>
