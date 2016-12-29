<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_Combo' );
});

/**
 * Sidebar Tab Widget Class
 * @since Newsmaxx 1.0
 */
class Kopa_Widget_Combo extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-tab-1-widget', 'description' => __('A widget displays popular articles, recent articles and most comment articles.', 'news-maxx-lite'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_combo', __('Widget Combo', 'news-maxx-lite'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        $query_args['posts_per_page'] = $instance['number_of_article'];
        $tab_args = array();

        if ( $instance['popular_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['popular_title'],
                'orderby' => 'most_comment',
            );
        }

        if ( $instance['latest_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['latest_title'],
                'orderby' => 'latest',
            );
        }

        if ( $instance['comment_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['comment_title'],
                'orderby' => 'most_comment',
            );
        }
        ?>

        <ul class="nav nav-tabs kopa-tabs-1">
            <?php foreach ( $tab_args as $k => $tab_arg ):?>
                <li class="<?php if(0===$k) echo 'active';?>"><a data-toggle="tab" href="#tab1-<?php echo $this->number .$k; ?>"><?php echo $tab_arg['label']; ?></a></li>
            <?php endforeach; ?>
        </ul> <!-- nav-tabs -->

        <div class="tab-content">
            <?php foreach ( $tab_args as $k1 => $tab_arg ):
            $query_args['orderby'] = $tab_arg['orderby'];
            if (isset($instance['kopa_timestamp'])){
                $query_args['date_query'] = $instance['kopa_timestamp'];
            }
            $posts = news_maxx_lite_widget_posttype_build_query( $query_args );
            ?>
            <div id="tab1-<?php echo $this->number . $k1; ?>" class="tab-pane<?php if (0 === $k1) echo ' active'; ?>">
                <ul class="clearfix">
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
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
                                <header>
                                    <?php
                                        if ( news_maxx_lite_check_title_null(get_the_ID())){?>
                                            <span class="entry-date pull-left"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format'));?></span>
                                        <?php }else{ ?>
                                            <span class="entry-date pull-left"><i class="fa <?php echo news_maxx_lite_get_post_format_icon(get_the_ID()); ?>"></i><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_time(get_option('date_format'));?></a></span>
                                        <?php }
                                    ?>

                                    <span class="entry-meta">&nbsp;/&nbsp;</span>
                                    <span class="entry-author"><?php _e('By', 'news-maxx-lite'); ?> <?php the_author_posts_link(); ?></span>
                                </header>
                                <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                            </div>
                        </article>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div><!-- tab-content -->

    <?php
        echo $after_widget;
        wp_reset_postdata();
    }

    function form($instance) {
        $defaults = array(
            'title'             => '',
            'number_of_article' => 3,
            'popular_title'     => __( 'POPULAR', 'news-maxx-lite' ),
            'comment_title'     => __( 'COMMENT', 'news-maxx-lite' ),
            'latest_title'      => __( 'RECENT', 'news-maxx-lite' ),
            'kopa_timestamp' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['number_of_article'] = $instance['number_of_article'];
        $form['popular_title'] = $instance['popular_title'];
        $form['comment_title'] = $instance['comment_title'];
        $form['latest_title'] = $instance['latest_title'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', 'news-maxx-lite'); ?></label>
        <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('popular_title'); ?>"><?php _e('Popular tab title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('popular_title'); ?>" name="<?php echo $this->get_field_name('popular_title'); ?>" type="text" value="<?php echo esc_attr($form['popular_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide popular tab.', 'news-maxx-lite' ); ?></small>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('latest_title'); ?>"><?php _e('Latest tab title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('latest_title'); ?>" name="<?php echo $this->get_field_name('latest_title'); ?>" type="text" value="<?php echo esc_attr($form['latest_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide latest tab.', 'news-maxx-lite' ); ?></small>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('comment_title'); ?>"><?php _e('Comment tab title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('comment_title'); ?>" name="<?php echo $this->get_field_name('comment_title'); ?>" type="text" value="<?php echo esc_attr($form['comment_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide comment tab.', 'news-maxx-lite' ); ?></small>
    </p>

    <?php news_maxx_lite_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        // validate number of article
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 5;
        }
        $instance['popular_title'] = strip_tags( $new_instance['popular_title'] );
        $instance['comment_title'] = strip_tags( $new_instance['comment_title'] );
        $instance['latest_title'] = strip_tags( $new_instance['latest_title'] );
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];

        return $instance;
    }
}