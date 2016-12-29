<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_Articles_List_Cat' );
});

/**
 * Widget article list
 */
class Kopa_Widget_Articles_List_Cat extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kp-article-list-widget', 'description' => __('Article list widget for category', 'news-maxx-lite'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_article_list_cat', __('Widget Article List Category', 'news-maxx-lite'), $widget_ops, $control_ops);
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
        $type = $instance['display_type'];
        $posts = news_maxx_lite_widget_posttype_build_query($query_args);
        ?>

<?php if ( 'grid_2columns_with_featured_style2' === $type) :?>
            <div class="widget kopa-article-list-3-widget">
                <h4 class="widget-title"><?php echo esc_attr($title); ?></h4>
                <div class="widget-inner clearfix">
                <?php $count = 0; $next = true; ?>
                <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                <?php
                if ( 0 === $count ){?>
                    <article class="last-item">
                        <?php //if ( has_post_thumbnail() ) : ?>
                        <div class="entry-thumb">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_post_thumbnail('news-maxx-lite-article-list-cat-2column-feature2', array('class' => 'img-responsive')); ?>
                            </a>
                        </div>
                        <?php //endif; ?><!-- entry-thumb -->
                        <div class="entry-content">
                            <h6 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                        </div>
                        <!-- entry-content -->
                    </article>
                    <!-- last-item -->
                    <?php
                } else {
                    if ( $next ) {
                        echo '<ul class="older-post clearfix">';
                        $next = false;
                    }?>
                    <li>
                        <article class="entry-item clearfix">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="entry-thumb">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail('news-maxx-lite-topnew', array('class' => 'img-responsive')); ?>
                                </a>
                            </div>
                            <?php endif; ?><!-- entry-thumb -->
                            <div class="entry-content<?php if ( !has_post_thumbnail() ) echo ' no-thumbnail'; ?>">
                                <header>
                                    <?php
                                    if ( news_maxx_lite_check_title_null(get_the_ID()) ){?>
                                        <span class="entry-date"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format')); ?></span>
                                        <?php }else{ ?>
                                        <span class="entry-date"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format')); ?></a></span>
                                        <?php }
                                    ?>
                                    <span class="entry-meta">&nbsp;/&nbsp;</span>
                                    <span class="entry-author"><?php _e('By', 'news-maxx-lite'); ?> <?php the_author_posts_link(); ?></span>
                                </header>
                                <h6 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" itemprop="name"><?php the_title(); ?></a></h6>
                            </div>
                        </article>
                        <!-- entry-item -->
                    </li>

                    <?php if ( $count === ($posts->post_count - 1) ) {
                        echo '</ul>';
                    }
                }
                ?>
                <?php $count++; endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

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
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'categories' )); ?>"><?php _e( 'Categories', 'news-maxx-lite' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'categories' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'categories' )) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'news-maxx-lite'); ?></option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) :
                ?>
                <option value="<?php echo esc_attr($category->term_id); ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                    <?php echo esc_attr($category->name).' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('relation')); ?>"><?php _e('Relation', 'news-maxx-lite'); ?>:</label>
        <select class="widefat" name="<?php echo esc_attr($this->get_field_name('relation')); ?>" id="<?php echo esc_attr($this->get_field_id('relation')); ?>">
            <option value="OR" <?php selected('OR', $form['relation']); ?>><?php _e('OR', 'news-maxx-lite'); ?></option>
            <option value="AND" <?php selected('AND', $form['relation']); ?>><?php _e('AND', 'news-maxx-lite'); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>"><?php _e( 'Tags', 'news-maxx-lite' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tags' )) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'news-maxx-lite'); ?></option>
            <?php
            $tags = get_tags();
            foreach ($tags as $category) :
                ?>
                <option value="<?php echo esc_attr($category->term_id); ?>" <?php echo in_array($category->term_id, $form['tags']) ? 'selected="selected"' : ''; ?>>
                    <?php echo esc_attr($category->name).' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <?php news_maxx_lite_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>"><?php _e( 'Orderby', 'news-maxx-lite' ); ?></label>
        <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" id="<?php echo esc_attr($this->get_field_id('orderby' )); ?>">
            <?php $orderby = array(
            'latest'      => __('Latest', 'news-maxx-lite'),
            'popular'      => __('Popular by view count', 'news-maxx-lite'),
            'most_comment' => __('Popular by comment count', 'news-maxx-lite'),
            'random'       => __('Random', 'news-maxx-lite')
        );

            foreach ($orderby as $value => $label) :
                ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $form['orderby']); ?>><?php echo esc_attr($label); ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>"><?php _e('Number of items:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" value="<?php echo esc_attr($form['posts_per_page']); ?>" type="number" min="1">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php _e('Number words of post excerpt:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="text" value="<?php echo esc_attr($limit); ?>" />
    </p>

    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'display_type' )); ?>"><?php _e( 'Display type', 'news-maxx-lite' ); ?></label>
        <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'display_type' )); ?>" id="<?php echo esc_attr($this->get_field_id('display_type' )); ?>">
            <?php $display_type = array(
            'grid_2columns_with_featured_style2'      => __('Grid layout with two columns, first column is featured style 2', 'news-maxx-lite')
        );

            foreach ($display_type as $value => $label) :
                ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $form['display_type']); ?>><?php echo esc_attr($label); ?></option>
                <?php
            endforeach;
            ?>
        </select>
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
        $instance['display_type'] = $new_instance['display_type'];
        return $instance;
    }
}