<?php get_header(); ?>

<div class="wrapper clearfix">
    <?php 
    $layout = get_theme_mod('blog-layout', '1');
    get_template_part('module/blog', $layout); 
    ?>
</div>
<!-- wrapper -->

<?php
get_footer();