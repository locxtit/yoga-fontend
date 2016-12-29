<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_Article_List_Carousel' );
});

/*
 * Widget Article List Carousel
 */

class Kopa_Widget_Article_List_Carousel extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-full-width-carousel-widget', 'description' => __('Article list carousel', 'news-maxx-lite'));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kopa_widget_article_list_carousel', __('Widget Article List Carousel', 'news-maxx-lite'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'posts_per_page' => 4,
            'limit' => 10,
            'kopa_timestamp' => '',
            'orderby' => 'latest',
            'slide_speed'         => 700,
            'is_auto_play'      => 'false',
            'display'      => 'fullwidth_image'
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
        $form['display'] = $instance['display'];
        $form['slide_speed'] = $instance['slide_speed'];
        $form['is_auto_play'] = $instance['is_auto_play'];
        ?>
        <div class="kopa-one-half">
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
                    <p>
                        <label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( 'Display:', 'news-maxx-lite' ); ?></label>
                        <select class="widefat" name="<?php echo $this->get_field_name( 'display' ); ?>" id="<?php echo $this->get_field_id('display' ); ?>">
                            <?php $display = array(
                                'grid_layout_random_flexible_size' => __('Display random articles in flexible grid layout', 'news-maxx-lite'),
                                'grid_with_3items_per_page'    => __('Grid with three items per page', 'news-maxx-lite'),
                                );

                            foreach ($display as $value => $label) :
                                ?>
                            <option value="<?php echo $value; ?>" <?php selected($value, $form['display']); ?>><?php echo $label; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </p>
                </div>
                <div class="kopa-one-half last">
                    <p>
                        <label for="<?php echo $this->get_field_id('slide_speed'); ?>"><?php _e('Slide speed:', 'news-maxx-lite'); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('slide_speed'); ?>" name="<?php echo $this->get_field_name('slide_speed'); ?>" value="<?php echo $form['slide_speed']; ?>" type="number" min="1">
                        <small><?php _e('Slide speed in milliseconds', 'news-maxx-lite'); ?></small>
                    </p>
                    <p>
                        <input id="<?php echo $this->get_field_id('is_auto_play'); ?>" name="<?php echo $this->get_field_name('is_auto_play'); ?>" type="checkbox" value="true" <?php echo ('true' === $form['is_auto_play']) ? 'checked="checked"' : ''; ?> />
                        <label for="<?php echo $this->get_field_id('is_auto_play'); ?>"><?php _e('Auto Play', 'news-maxx-lite'); ?></label>
                    </p>
                </div>
                <div class="kopa-clear"></div>
                <?php
            }

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
                $instance['relation'] = $new_instance['relation'];
                $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
                $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
                $instance['kopa_timestamp'] = (int) $new_instance['kopa_timestamp'];
                $instance['orderby'] = $new_instance['orderby'];
                $instance['limit'] = $new_instance['limit'];
                $instance['slide_speed'] = (int) $new_instance['slide_speed'];
                $instance['is_auto_play'] = isset($new_instance['is_auto_play']) ? $new_instance['is_auto_play'] : 'false';
                $instance['display'] = $new_instance['display'];
                return $instance;
            }

            function widget($args, $instance) {
                extract($args);
                $title = apply_filters('widget_title', empty($instance['title']) ? __('List Articles Carousel', 'news-maxx-lite') : $instance['title'], $instance, $this->id_base);
                $limit = (int) $instance['limit'];
                $posts_per_page = (int) $instance['posts_per_page'];
                $query_args['categories'] = $instance['categories'];
                $query_args['relation'] = esc_attr($instance['relation']);
                $query_args['tags'] = $instance['tags'];
                $query_args['posts_per_page'] = (int) $instance['posts_per_page'];
                $query_args['orderby'] = $instance['orderby'];
                if (isset($instance['kopa_timestamp'])){
                    $query_args['date_query'] = $instance['kopa_timestamp'];
                }

                $posts = news_maxx_lite_widget_posttype_build_query($query_args);
                $categories = $instance['categories'];
                $display = $instance['display'];
                $slideSpeed = (int) $instance['slide_speed'];

                ?>

                <?php if ( 'grid_layout_random_flexible_size' === $display) : ?>
                <div class="widget kopa masonry-list-widget">
                    <?php if ($title){?>
                    <h4 class="widget-title"><?php echo $title; ?></h4>
                    <?php }?>
                    <div class="masonry-wrapper">
                        <?php if ( $posts->have_posts()) : $count = 1; ?>
                        <input type='hidden' id='current_page-<?php echo $this->number;?>' />
                        <input type='hidden' id='show_per_page-<?php echo $this->number; ?>' />
                        <ul class="clearfix masonry-list" id="kopa-masonry-<?php echo $this->number; ?>" data-id="#kopa-masonry-<?php echo $this->number; ?>" data-currentpage="#current_page-<?php echo $this->number; ?>" data-pagenavigation="#page_navigation_<?php echo $this->number; ?>" data-showperpage="#show_per_page-<?php echo $this->number; ?>">
                            <?php while ( $posts->have_posts()) :
                            $posts->the_post();
                            if ( 2 === $count || 3 === $count ) {
                                $li_class = 'masonry-item width-2 height-2';
                            } else if ( 4 === $count ) {
                                $li_class = 'masonry-item width-3 height-2';
                                $count = 0;
                            } else {
                                $li_class = 'masonry-item';
                            }
                            ?>
                            <li class="<?php echo $li_class; ?>">
                                <?php //if ( has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php 
                                    if ( 2 === $count || 3 === $count ) {
                                        the_post_thumbnail('news-maxx-lite-masonry-item-width-2-height-2', array('class' => 'img-responsive'));
                                    } else if ( 4 === $count ) {
                                        the_post_thumbnail('news-maxx-lite-masonry-item-width-3-height-2', array('class' => 'img-responsive'));
                                        $count = 0;
                                    } else {
                                        the_post_thumbnail('news-maxx-lite-masonry-item', array('class' => 'img-responsive'));
                                    }
                                    ?>
                                </a>
                                <?php //endif; ?>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                            </li>
                            <?php $count++; ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="pagination clearfix">
                <ul class="page-numbers clearfix" id='page_navigation_<?php echo $this->number; ?>'>
                </ul><!--page-numbers-->
            </div>
        </div>
    <?php endif; ?>

    <?php if ( 'grid_with_3items_per_page' === $display) : ?>
    <div class="widget kopa-carousel-list-2-widget">
     <?php
     if(!empty($title)){?>
     <h4 class="widget-title"><?php echo $title; ?></h4>
     <?php }
     ?>
     <div class="owl-carousel kopa-owl-carousel-1" data-autoplay="<?php echo $instance['is_auto_play']; ?>" data-slidespeed="<?php echo $slideSpeed;?>">
        <?php
        if ( $posts->have_posts() ){
         $i = 0;
         $before_item = '<div class="item"><ul>';
         $after_item = '</ul></div>';
         while ( $posts->have_posts()) {
            $posts->the_post();
                            //item html
            $item_html = '<li>';
            $item_html .= '<article class="entry-item">';
            if (has_post_thumbnail()){
             $item_html .= '<div class="entry-thumb">';
             $item_html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'.the_post_thumbnail('news-maxx-lite-article-list-carousel', array('class' => 'img-responsive')).'</a>';
             $item_html .= '</div>';
         }
         $item_html .= '<div class="entry-content">';
         $item_html .= '<span class="entry-date"><i class="fa fa-pencil-square-o"></i>'.  get_the_time(get_option('date_format')) . '</span>';
         $item_html .= '<h6 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">'. get_the_title() . '</a></h6>';
         $item_html .= '</div>';
         $item_html .= '</article>';
         $item_html .= '</li>';

         if ($i % 3 == 0){
            echo $before_item;
        }
        echo $item_html;
        if ($i % 3 == 2){
            echo $after_item;
        }

        $i++;
    }
                    //Check in case don't have multiple of 3 items
    if ($i % 3 != 0){
     echo $after_item;
 }
}?>
</div>
</div>
<?php endif; ?>
<?php wp_reset_postdata();
}
}