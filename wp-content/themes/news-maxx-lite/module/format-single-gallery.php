<section id="post-<?php the_ID(); ?>" <?php post_class('entry-box'); ?>>
    <header>
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php if ('post' === get_post_type() ) :?>
        <span class="entry-date pull-left"><i class="fa fa-pencil-square-o"></i><?php the_time(get_option('date_format')); ?></span>
        <?php endif; ?>

        <span class="entry-meta pull-left">&nbsp;/&nbsp;</span>
        <span class="entry-author pull-left"><?php _e('By', 'news-maxx-lite');?> <?php the_author_posts_link(); ?></span>
    </header>

    <?php
    $gal_ids = news_maxx_lite_content_get_gallery_attachment_ids(get_the_content());
    if ( !empty($gal_ids) ){?>
        <div class="entry-thumb">
            <div class="owl-carousel single-post-carousel">
                <?php foreach ($gal_ids as $id): ?>
                <?php if ( wp_attachment_is_image($id) ) :?>
                    <div class="item">
                        <?php echo wp_get_attachment_image($id, 'kopa-size-3'); ?>
                    </div>
                    <!-- item -->
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php } elseif ( has_post_thumbnail()) {?>
        <div class="entry-thumb">
            <?php the_post_thumbnail('news-maxx-lite-format-single', array('class' => 'img-responsive')); ?>
        </div>
        <?php }
    ?>
    <!-- entry-thumb -->


    <div class="entry-content clearfix">
        <div class="left-col pull-left">
            <?php news_maxx_lite_related_articles(); ?>
            <!-- related-post -->
        </div><!-- left-col -->
        <?php
        $content = get_the_content();
        $content = preg_replace('/\[gallery.*](.*\[gallery]){0,1}/', '', $content);
        $content = apply_filters( 'the_content', $content );
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
        ?>
    </div>
    <?php
    $args = array(
        'before'           => '<div class="page-links-wrapper"><div class="page-links">',
        'after'            => '</div></div>',
        'link_before'      => '<span>',
        'link_after'       => '</span>',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => __( 'Next page', 'news-maxx-lite' ),
        'previouspagelink' => __( 'Previous page', 'news-maxx-lite' ),
        'pagelink'         => '%',
        'echo'             => 1
    );
    wp_link_pages($args);
    ?><!-- pagination in post -->

    <?php the_tags( '<div class="tag-box"><strong>' . __( 'Tags: ', 'news-maxx-lite' ) . ' </strong>', ', ', '</div>' ); ?>
    <!-- tag box-->

    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    <?php if (( get_next_post() || get_previous_post() ) ) :?>
    <footer class="entry-box-footer clearfix">
        <div class="article-directnav clearfix">
            <?php if (!empty( $prev_post )):?>
            <p class="prev-post pull-left clearfix">
                <a class="clearfix" href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-angle-double-left"></i><?php echo __('Previous article', 'news-maxx-lite');?></a>
            </p>
            <?php endif; ?>
            <?php if (!empty($next_post)) : ?>
            <p class="next-post pull-right clearfix">
                <a class="clearfix" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo __('Next article', 'news-maxx-lite');?><i class="fa fa-angle-double-right"></i></a>
            </p>
            <?php endif; ?>
        </div>

        <div class="article-title clearfix">
            <?php if (!empty( $prev_post )):?>
            <p class="prev-post pull-left clearfix">
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title;?></a>
                <span class="entry-date"><i class="fa fa-pencil-square-o"></i><?php echo get_the_time( get_option('date_format'), $prev_post->ID ); ?></span>
                <span class="entry-meta">&nbsp;/&nbsp;</span>
                <span class="entry-author"><?php _e('By', 'news-maxx-lite'); ?> <?php the_author_posts_link(); ?></span>
            </p>
            <?php endif; ?>
            <?php if (!empty($next_post)) : ?>
            <p class="next-post pull-right clearfix">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title;?></a>
                <span class="entry-date"><i class="fa fa-pencil-square-o"></i><?php echo get_the_time( get_option('date_format'), $next_post->ID ); ?></span>
                <span class="entry-meta">&nbsp;/&nbsp;</span>
                <span class="entry-author"><?php _e('By', 'news-maxx-lite'); ?> <?php the_author_posts_link(); ?></span>
            </p>
            <?php endif; ?>
        </div>

    </footer>
    <?php endif; ?>
    <!-- kopa navigation -->
</section><!-- entry-box -->

<?php news_maxx_lite_about_author(); ?><!-- kopa author -->

