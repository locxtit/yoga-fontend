<?php

add_action( 'widgets_init', function(){
	register_widget( 'Kopa_Widget_Contact_Info' );
});

/*
 * Contact Info Widget Class
 */
class Kopa_Widget_Contact_Info extends WP_Widget
{
    function __construct() {
        $widget_ops = array('classname' => 'kopa-contact-info-widget', 'description' => __('Display contact info', 'news-maxx-lite'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_contact_info', __('Widget Contact Info', 'news-maxx-lite'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('CONTACT', 'news-maxx-lite') : $instance['title'], $instance, $this->id_base );
        $sub = apply_filters( 'widget_title_sub', empty( $instance['sub'] ) ? __('US', 'news-maxx-lite') : $instance['sub'], $instance, $this->id_base );
        $mail = $instance['mail'];
        $phone = $instance['phone'];
        $fax = $instance['fax'];
        $address = $instance['address'];

        echo $before_widget;
        if (!empty($title)){?>
            <h4 class="widget-title"><?php echo $title; ?>
                <?php if (!empty($sub)){ ?>
                    <span><?php echo $sub;?></span>
                <?php }?>
            </h4>
        <?php }
        ?>

        <?php if (!empty($instance['image'])) : ?>
            <div class="contact-map">
                <?php
                    the_post_thumbnail('news-maxx-lite-contact-info', array('class' => 'img-responsive'));
                ?>
            </div>
        <?php endif; ?>
        <div class="contact-info">
            <?php if (!empty($mail)): ?>
                <p class="clearfix"><i class="fa fa-envelope"></i><strong><?php _e('Email:', 'news-maxx-lite'); ?> </strong><a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></p>
            <?php endif ;?>

            <?php if (!empty($phone)): ?>
                <p class="clearfix"><i class="fa fa-phone"></i><strong><?php _e('Phone:', 'news-maxx-lite'); ?> </strong><?php echo $phone; ?></p>
            <?php endif ;?>

            <?php if (!empty($fax)): ?>
                <p class="clearfix"><i class="fa fa-print"></i><strong><?php _e('Fax:', 'news-maxx-lite'); ?> </strong><?php echo $fax; ?></p>
            <?php endif ;?>

            <?php if (!empty($address)): ?>
                <p class="clearfix"><i class="fa fa-map-marker"></i><strong><?php _e('Address:', 'news-maxx-lite'); ?> </strong><span><?php echo $address; ?></span></p>
            <?php endif ;?>
        </div>
    <?php
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'                  => __( 'Contact', 'news-maxx-lite' ),
            'sub'                  => __( 'Us', 'news-maxx-lite' ),
            'image'  => '',
            'mail'  => '',
            'phone' => '',
            'fax'            => '',
            'address'            => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $sub = strip_tags( $instance['sub'] );
        $form['mail'] = strip_tags($instance['mail']);
        $form['phone'] = strip_tags ($instance['phone']);
        $form['fax'] = strip_tags($instance['fax']);
        $form['address'] = strip_tags($instance['address']);
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('sub'); ?>"><?php _e('Sub title:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('sub'); ?>" name="<?php echo $this->get_field_name('sub'); ?>" type="text" value="<?php echo esc_attr($sub); ?>">
    </p>

    <p class="clearfix">
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:', 'news-maxx-lite' ) ?></label>
        <input class="widefat" type="url" value="<?php echo $instance['image']; ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
        <span>&nbsp;</span>
        <button class="left btn btn-success upload_image_button" alt="<?php echo $this->get_field_id( 'image' ); ?>"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'news-maxx-lite'); ?></button>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('mail'); ?>"><?php _e('Email:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo esc_attr($form['mail']); ?>">
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($form['phone']); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($form['fax']); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'news-maxx-lite'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($form['address']); ?>">
    </p>
    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['sub'] = strip_tags( $new_instance['sub'] );
        // $instance['image'] = $new_instance['image'];
        $instance['mail'] = strip_tags( $new_instance['mail'] );
        $instance['phone'] = strip_tags( $new_instance['phone'] );
        $instance['fax'] = strip_tags( $new_instance['fax'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        return $instance;
    }
}