<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_List_Gallery' );
});

class Kopa_Widget_List_Gallery extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-gallery-widget', 'description' => __('Show list posts (gallery format) of categories', 'news-maxx-lite'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-list-gallery-widget', __('Widget List Galleries', 'news-maxx-lite'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'posts_per_page' => 6,
            'kopa_timestamp' => '',
            'orderby' => 'latest'
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $form['categories'] = $instance['categories'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        $form['orderby'] = $instance['orderby'];
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
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['orderby'] = $new_instance['orderby'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters( 'widget_title', empty($instance['title'] ) ? __( 'NEW GALLERY', 'news-maxx-lite' ) : $instance['title'], $instance, $this->id_base );
        $args['categories'] = $instance['categories'];
        $args['posts_per_page'] = (int) $instance['posts_per_page'];
        $args['post_format'] = 'post-format-gallery';
        if (isset($instance['kopa_timestamp'])){
            $args['date_query'] = $instance['kopa_timestamp'];
        }
        $posts = news_maxx_lite_widget_posttype_build_query($args);
        ?>
            <div class="widget kopa-gallery-widget">
                <?php if (!empty($title)):?>
                    <h4 class="widget-title"><?php echo $title; ?></h4>
                <?php endif; ?>
                <?php
                    if ( $posts->have_posts() ){?>
                        <ul class="clearfix">
                            <?php
                                while( $posts->have_posts()){
                                    $posts->the_post(); ?>
                                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('news-maxx-lite-gallery', array('class' => 'img-responsive')); ?></a></li>
                                <?php }
                            ?>
                        </ul>
                    <?php }
                ?>
            </div>
    <?php wp_reset_postdata();
    }
}