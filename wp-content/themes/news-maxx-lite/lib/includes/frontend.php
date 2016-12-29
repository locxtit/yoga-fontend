<?php

/*
 * kopa get current time
 */
function news_maxx_lite_the_current_time(){
   $retdate = '';
   $gmt = (int) get_option('gmt_offset');
   $retdate .= date( 'l, j/n/Y \| g:i T', current_time( 'timestamp', 1 ));//get_the_time('l, j/n/Y \| g:i T');
   $retdate .= $gmt >= 0 ? '+'.$gmt : $gmt;
    echo '<span class="kopa-current-time pull-left">' . $retdate . '</span>';
}

/*
* top new
*/
function news_maxx_lite_the_topnew()
{
    $limit = (int) get_option('kopa_theme_options_topnew_limit', 5);
    if ($limit) {
        $title = get_option('kopa_theme_options_topnew_title', __('From around the world', 'news-maxx-lite'));
        $cats = (array)get_option('kopa_theme_options_topnew_cats');
        $cats = implode(',', $cats);
        $args = array(
            'posts_per_page'      => $limit,
            'ignore_sticky_posts' => true
        );
        $tax_query = array();
        if ( $cats ) {
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $cats
            );
        }
        if ( $tax_query ) {
            $args['tax_query'] = $tax_query;
        }
        $posts = new WP_Query( $args );
        $index = 1;
        ?>

    <div class="widget kopa-nothumb-carousel-widget loading">
        <h4 class="widget-title"><?php echo $title; ?></h4>
        <div class="owl-carousel kopa-nothumb-carousel loading">
            <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                <div class="item">
                    <article class="entry-item clearfix">
                        <div class="entry-number">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('news-maxx-lite-topnew', array('class' => 'img-responsive')); ?></a>
                        </div>
                        <div class="entry-content">
                            <header>
                                <span class="entry-date pull-left"><i class="fa fa-pencil-square-o"></i><?php the_time(get_option('date_format')); ?></span>
                            </header>
                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                        </div>
                        <!-- entry-content -->
                    </article>
                    <!-- entry-item -->
                </div>
                <!-- item -->
                <?php $index++; ?>
            <?php endwhile; ?>
        </div>
        <!-- kopa-nothumb-carousel -->
    </div>
    <!-- widget -->
    <?php
    }
}

function news_maxx_lite_set_view_count($post_id) {
    $new_view_count = 0;
    $meta_key = 'news-maxx-lite'.'_total_view';

    $current_views = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function news_maxx_lite_get_view_count($post_id) {
    $key = 'news-maxx-lite'.'_total_view';
    return news_maxx_lite_get_post_meta($post_id, $key, true, 'Int');
}

function news_maxx_lite_get_post_meta($pid, $key = '', $single = false, $type = 'String', $default = '') {
    $data = get_post_meta($pid, $key, $single);
    switch ($type) {
        case 'Int':
            $data = (int) $data;
            return ($data >= 0) ? $data : $default;
            break;
        default:
            return ($data) ? $data : $default;
            break;
    }
}

/*
 * header headline
 */
function news_maxx_lite_the_headline()
{
    $limit = (int) get_option('kopa_theme_options_headline_limit', 5);
    $speed = (float)get_option('kopa_theme_options_headline_duration',700);
    $speed = $speed/10000;
    if ($limit) {
        $prefix = get_option('kopa_theme_options_headline_prefix', 'Breaking news');
        $cats = (array)get_option('kopa_theme_options_headline_cats');
        $cats = implode(',', $cats);

        if( !empty($cats) ){
            $posts = new WP_Query('cat='.$cats.'&posts_per_page='.$limit);
        }else{
            $posts = new WP_Query( 'posts_per_page='.$limit);
        }
        ?>
            <div class="kp-headline-wrapper clearfix">
                <span class="kp-headline-title"><?php echo $prefix; ?></span>
                <div class="kp-headline clearfix">
                        <?php
                        if ($posts->have_posts()) { ?>
                                <dl class="ticker-1 clearfix" data-speed="<?php echo $speed;?>">
                                    <dt style="display: none;">ticket title</dt>
                                    <?php
                                    while ($posts->have_posts()) {
                                        $posts->the_post();
                                        $post_url = get_permalink();
                                        $post_title = get_the_title();
                                        ?>
                                        <dd><a href="<?php echo $post_url; ?>" title="<?php echo get_the_title(); ?>"><?php echo $post_title; ?></a></dd>
                                        <?php
                                    }
                                    wp_reset_query();
                                    ?>
                                </dl>
                            <?php
                        }
                        ?>
                </div>
            </div>
        <?php
    }
}

/**
 * Template tag: print breadcrumb
 */
function news_maxx_lite_breadcrumb() {
    // get show/hide option
    $kopa_breadcrumb_status = get_option('kopa_theme_options_breadcrumb_status', 'show');

    if ( $kopa_breadcrumb_status != 'show' ) {
        return;
    }

    if (is_main_query()) {
        global $post, $wp_query;

        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="breadcrumb clearfix">';
        $breadcrumb_after = '</div>';
        $breadcrumb_home = '<span>'.__('You are here: ', 'news-maxx-lite') .'</span> <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="' . home_url() . '"><span itemprop="title">' . __('Home', 'news-maxx-lite') . '</span></a></span>';
        $breadcrumb = '';
        ?>

        <?php
        if (is_home()) {
            $breadcrumb.= $breadcrumb_home;
            if ( get_option( 'page_for_posts' ) ) {
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="%1$s">%2$s</span>', $current_class, get_the_title(get_option('page_for_posts')));
            } else {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', 'news-maxx-lite'));
            }
        } else if (is_post_type_archive('product') && get_option('woocommerce_shop_page_id')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="%1$s">%2$s</span>', $current_class, get_the_title(get_option('woocommerce_shop_page_id')));
        } else if (is_tag()) {
            $breadcrumb.= $breadcrumb_home;

            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb.= $breadcrumb_home;

            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span class="%1$s" itemprop="title">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));

        } else if ( is_tax('product_cat') ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                $parent = $new_parent->parent;
            endwhile;
            if( ! empty( $parents ) ):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                endforeach;
            endif;

            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if ( is_tax( 'product_tag' ) ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb.= $breadcrumb_home;

            if ( get_post_type() === 'product' ) :

                $breadcrumb .= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';

                if ($terms = get_the_terms( $post->ID, 'product_cat' )) :
                    $term = apply_filters( 'jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, 'product_cat');
                            $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>';
                endif;

                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());

            else : 

                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }

                $post_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));

            endif;

        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb.= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb.= $breadcrumb_home;

            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);

            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');

            if (is_year()) {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }

            if (is_month()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date_i18n('F', $date['m']));
            }

            if (is_day()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date_i18n('F', $date['m']));
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }

        } else if (is_search()) {
            $breadcrumb.= $breadcrumb_home;

            $s = get_search_query();
            $c = $wp_query->found_posts;
            $count = $wp_query->post_count.'';

            $description = sprintf(__('<span class="%1$s">Your search for "%2$s" return %3$s results', 'news-maxx-lite'), $current_class, $s, $count);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb.= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', 'news-maxx-lite'), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Error 404', 'news-maxx-lite'));
        }

        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

// function news_maxx_lite_image_size_names_choose($sizes) {
//     $kopa_sizes = news_maxx_lite_get_image_sizes();
//     foreach ($kopa_sizes as $size => $image) {
//         $width = ($image[0]) ? $image[0] : __('auto', 'news-maxx-lite');
//         $height = ($image[1]) ? $image[1] : __('auto', 'news-maxx-lite');
//         $sizes[$size] = $image[3] . " ({$width} x {$height})";
//     }
//     return $sizes;
// }

/*
 * Kopa check post title is null
 */
function news_maxx_lite_check_title_null($id){
    $title = get_the_title($id);
    if ( empty($title) )
        return false;

    return true;
}

/*
 * Kopa get post format icon
 */
function news_maxx_lite_get_post_format_icon ($post_id) {
    $post_format = get_post_format();
    if ( false === $post_format ) {
        $post_format = 'standard';
    }
    switch($post_format){
        case 'standard':
            $fa_icon = 'fa-pencil-square-o';
            break;
        case 'video':
            $fa_icon = 'fa-picture-o';
            break;
        case 'audio':
            $fa_icon = 'fa-file-audio-o';
            break;
        default:
            $fa_icon = 'fa-pencil-square-o';
            break;
    }
    return $fa_icon;
}

function news_maxx_lite_about_author() {
    ?>
    <section class="about-author">
        <div class="about-author-inner clearfix">
            <div class="author-avatar">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?></a>
            </div>
            <div class="author-content">
                <h5><?php _e('About', 'news-maxx-lite');?> <?php the_author_posts_link(); ?></h5>
                <p><?php the_author_meta( 'description' ); ?></p>
            </div>
        </div>
        <!-- about-author-inner -->
    </section>
<?php
}

function news_maxx_lite_related_articles() {
    if (is_single()) {
        $get_by = 'category';
        if ('hide' != $get_by) {
            $limit = (int) 4;
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }

                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query( $related_args );
                    if ( $related_posts->have_posts() ) { ?>

                        <div class="related-post">
                            <h3><span><?php _e('Post by related', 'news-maxx-lite'); ?></span><?php _e('Related post', 'news-maxx-lite'); ?></h3>
                        </div>
                        <div class="owl-carousel kopa-related-post-carousel">
                            <?php $i = 0; ?>
                            <?php while ( $related_posts->have_posts() ) : $related_posts->the_post();
                                if ($i % 2 == 0){
                                    echo '<div class="item"><ul>';
                                }?>

                                <li>
                                    <article class="entry-item clearfix">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <div class="entry-thumb">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php the_post_thumbnail('news-maxx-lite-topnew', array('class' => 'img-responsive')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="entry-content">
                                            <?php if ( 'post' === get_post_type() ) :?>
                                                <?php
                                                if ( news_maxx_lite_check_title_null(get_the_ID())){?>
                                                        <span class="entry-date"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID());?>"></i><?php the_time(get_option('date_format')); ?></span>
                                                    <?php }else{ ?>
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="entry-date"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID());?>"></i><?php the_time(get_option('date_format')); ?></span></a>
                                                    <?php }
                                                ?>


                                            <?php endif; ?>
                                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                                        </div>
                                    </article>
                                </li>

                                <?php if ($i % 2 == 1){
                                    echo '</ul></div>';
                                }
                                $i++;
                            ?>
                            <?php endwhile; ?>
                            <?php
                            //Check in case don't have multiple of 3 items
                                if ($i % 2 != 0){
                                    echo '</ul></div>';
                                }
                            ?>
                        </div>
                        <?php
                    } // endif
                    wp_reset_postdata();
                }
            }
        }
    }
}

function news_maxx_lite_content_get_gallery($content, $enable_multi = false) {
    return news_maxx_lite_content_get_media($content, $enable_multi, array('gallery'));
}

function news_maxx_lite_content_get_video($content, $enable_multi = false) {
    return news_maxx_lite_content_get_media($content, $enable_multi, array('vimeo', 'youtube', 'video'));
}

function news_maxx_lite_content_get_audio($content, $enable_multi = false) {
    return news_maxx_lite_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function news_maxx_lite_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }    return $media;
}

/**
 * Get gallery string ids after getting matched gallery array
 * @return array of attachment ids in gallery
 * @return empty if no gallery were found
 */
function news_maxx_lite_content_get_gallery_attachment_ids( $content ) {
    $gallery = news_maxx_lite_content_get_gallery( $content );

    if (isset( $gallery[0] )) {
        $gallery = $gallery[0];
    } else {
        return '';
    } 

    if ( isset($gallery['shortcode']) ) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    } 

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if ( isset( $gallery_string_ids[0][0] ) ) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    } 

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if ( isset( $gallery_ids[0] ) ) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    } 

    return $gallery_ids;
}

function news_maxx_lite_the_category($thelist) {
    return $thelist;
}

function news_maxx_lite_comment_reply_link($link) {
    return str_replace('comment-reply-link', 'comment-reply-link reply-link', $link);
}

function news_maxx_lite_edit_comment_link($link) {
    return str_replace('comment-edit-link', 'comment-edit-link edit-link', $link);
}

function news_maxx_lite_get_the_excerpt_for_widget($excerpt, $content, $length = 0) {
    if ( $length ){
        $str_length = $length;
    }elseif(is_category() || is_tag()) {
        $str_length = (int) 10;
    }else{
        $str_length = (int) 10;
    }
    $temp_excerp = $excerpt;
    if ( empty($temp_excerp) ) {
        $temp_excerp =  strip_tags($content);
        $temp_excerp =  strip_shortcodes($temp_excerp);
    }


    $kopa_excerpt = wp_trim_words($temp_excerp, $str_length, $more = null);
    return $kopa_excerpt;
}


