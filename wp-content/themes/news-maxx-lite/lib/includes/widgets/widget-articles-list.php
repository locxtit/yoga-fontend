<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_Articles_List' );
});

/**
 * Widget article list
 */
class Kopa_Widget_Articles_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kp-article-list-widget', 'description' => __('Article list widget', 'news-maxx-lite'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_article_list', __('Widget Article List', 'news-maxx-lite'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('List Articles', 'news-maxx-lite') : $instance['title'], $instance, $this->id_base);

        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = esc_attr($instance['relation']);
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = (int) $instance['posts_per_page'];
        if (isset($instance['kopa_timestamp'])){
            $query_args['date_query'] = $instance['kopa_timestamp'];
        }
        $query_args['orderby'] = $instance['orderby'];
        $limit = $instance['limit'];

        $posts = news_maxx_lite_widget_posttype_build_query($query_args);
        ?>

        <div class="widget kopa-article-list-1-widget clearfix">
            <h4 class="widget-title"><?php echo $title; ?></h4>
            <?php
                if ( $posts->have_posts() ){
                    $index = 0;
                    while ( $posts->have_posts() ){
                        $posts->the_post();
                       $index++;

                        $li_common = '<li>';
                        $li_common .= '<article class="entry-item clearfix">';
                        $li_common .= '<div class="entry-content">';
                        $li_common .= '<header>';
                        if ( news_maxx_lite_check_title_null(get_the_ID())){
                           $li_common .= '<span class="entry-date"><i class="fa '. news_maxx_lite_get_post_format_icon(get_the_ID()) . '"></i>' . get_the_time(get_option('date_format')) . '</span>';
                        }else{
                           $li_common .= '<span class="entry-date"><i class="fa '. news_maxx_lite_get_post_format_icon(get_the_ID()) . '"></i><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_time(get_option('date_format')) . '</a></span>';
                        }
                        $li_common .= '<span class="entry-meta">&nbsp;/&nbsp;</span>';
                        $li_common .= '<span class="entry-author">' .  __("By ", 'news-maxx-lite') . '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></span>';
                        $li_common .= '</header>';
                        $li_common .= '<h6 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h6>';
                        $li_common .= '</div>';
                        $li_common .= '</article>';
                        $li_common .= '</li>';


                       if ( 1 === $index ){?>
                           <article class="last-item clearfix">
                               <?php if ( has_post_thumbnail() ) :?>
                                   <div class="entry-thumb">
                                       <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                           <?php the_post_thumbnail('news-maxx-lite-article-list', array('class' => 'img-responsive')); ?>
                                       </a>
                                   </div>
                               <?php endif; ?><!-- entry-thumb -->
                               <div class="entry-content">
                                   <header>
                                       <span class="entry-date pull-left"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format')); ?></span>
                                   </header>
                                   <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                                   <?php global $post; ?>
                                   <p><?php echo news_maxx_lite_get_the_excerpt_for_widget($post->post_excerpt, $post->post_content, $limit); ?></p>
                                   <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-link"><span><?php _e('Read more', 'news-maxx-lite'); ?></span></a>
                               </div>
                               <!-- entry-content -->
                           </article>
                           <!-- last-item -->
                       <?php } elseif ( 2 === $index ){?>
                           <ul class="older-post clearfix">
                               <?php echo $li_common; ?>
                       <?php } elseif ( $index === $posts->post_count ){?>
                                <?php echo $li_common; ?>
                           </ul>
                       <?php } else {?>
                        <?php echo $li_common; ?>
                       <?php }
                    }
                }
            ?>
        </div>



    <?php
        wp_reset_postdata();
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'posts_per_page' => 6,
            'kopa_timestamp' => '',
            'limit' => 10,
            'orderby' => 'latest',
            'display_type' => 'medium'
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $limit = (int)$instance['limit'];

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        $form['orderby'] = $instance['orderby'];
        $form['display_type'] = $instance['display_type'];
        ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'news-maxx-lite' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'news-maxx-lite'); ?></option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation', 'news-maxx-lite'); ?>:</label>
        <select class="widefat" name="<?php echo $this->get_field_name('relation'); ?>" id="<?php echo $this->get_field_id('relation'); ?>">
            <option value="OR" <?php selected('OR', $form['relation']); ?>><?php _e('OR', 'news-maxx-lite'); ?></option>
            <option value="AND" <?php selected('AND', $form['relation']); ?>><?php _e('AND', 'news-maxx-lite'); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags', 'news-maxx-lite' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'news-maxx-lite'); ?></option>
            <?php
            $tags = get_tags();
            foreach ($tags as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['tags']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <?php news_maxx_lite_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby', 'news-maxx-lite' ); ?></label>
        <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id('orderby' ); ?>">
            <?php $orderby = array(
            'latest'      => __('Latest', 'news-maxx-lite'),
            'popular'      => __('Popular by view count', 'news-maxx-lite'),
            'most_comment' => __('Popular by comment count', 'news-maxx-lite'),
            'random'       => __('Random', 'news-maxx-lite')
        );

            foreach ($orderby as $value => $label) :
                ?>
                <option value="<?php echo $value; ?>" <?php selected($value, $form['orderby']); ?>><?php echo $label; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of items:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $form['posts_per_page']; ?>" type="number" min="1">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number words of post excerpt:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
    </p>


    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['limit'] = $new_instance['limit'];
        return $instance;
    }
}