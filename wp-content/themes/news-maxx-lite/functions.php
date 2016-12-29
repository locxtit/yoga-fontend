<?php

require_once "lib/kopa-customization.php";
require trailingslashit(get_template_directory()) . '/lib/includes/frontend.php';
require trailingslashit(get_template_directory()) . '/lib/includes/sidebars.php';
require trailingslashit(get_template_directory()) . '/lib/includes/panels/general-settings.php';
require trailingslashit(get_template_directory()) . '/lib/includes/widget.php';

add_action('after_setup_theme', 'news_maxx_after_setup_theme');

function news_maxx_after_setup_theme() {

    load_theme_textdomain('news-maxx-lite', get_template_directory() . '/languages');

    add_theme_support( 'custom-background', array(
        'default-color'      => '',
        'default-attachment' => 'fixed',
        ));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array('gallery', 'video', 'audio'));

    // news_maxx_lite_register_new_image_sizes();
    news_maxx_lite_register_new_image_sizes();
    
    global $content_width;
    if (!isset($content_width))
        $content_width = 911;

    register_nav_menus(array(
        'top-nav'      => __( 'Top Menu (All Items Flat)', 'news-maxx-lite' ),
        'main-nav'     => __( 'Main Menu', 'news-maxx-lite' ),
        'second-nav'     => __( 'Second Menu', 'news-maxx-lite' ),
        'bottom-nav'   => __( 'Bottom Menu (All Items Flat)', 'news-maxx-lite' ),
        ));

    add_filter('kopa_customization_init_options', 'news_maxx_lite_init_options');
    add_action('widgets_init', 'news_maxx_lite_register_sidebar');

    if (is_admin()) {
        add_filter('image_size_names_choose', 'news_maxx_lite_image_size_names_choose');
    }else{
        add_action('wp_enqueue_scripts', 'news_maxx_lite_enqueue_scripts');        
        add_filter('body_class', 'news_maxx_lite_body_class');
        add_filter('post_class', 'news_maxx_lite_post_class');
        add_filter('excerpt_more', '__return_false'); 
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_category', 'news_maxx_lite_the_category');
        add_filter('comment_reply_link', 'news_maxx_lite_comment_reply_link');
        add_filter('edit_comment_link', 'news_maxx_lite_edit_comment_link');
    }
}

function news_maxx_lite_register_new_image_sizes(){
    add_image_size('news-maxx-lite-topnew', 60, 60, true);
    add_image_size('news-maxx-lite-masonry-item-width-2-height-2', 226, 224, true);
    add_image_size('news-maxx-lite-masonry-item-width-3-height-2', 457, 224, true);
    add_image_size('news-maxx-lite-masonry-item', 420, 452, true);
    add_image_size('news-maxx-lite-article-list', 267, 256, true); 
    add_image_size('news-maxx-lite-article-list-carousel', 217, 168, true); 
    add_image_size('news-maxx-lite-gallery', 127, 97, true); 
    add_image_size('news-maxx-lite-video', 267, 180, true);  
    add_image_size('news-maxx-lite-format-single', 866, 428, true);   
    add_image_size('news-maxx-lite-loop-blog', 265, 215, true);
    add_image_size('news-maxx-lite-contact-info', 247, 131, true); 
    add_image_size('news-maxx-lite-article-list-cat-2column-feature2', 548, 419, true);                                                                             
        
}

function news_maxx_lite_enqueue_scripts(){
    if (!is_admin()) {
        global $wp_styles, $is_IE;

        $dir = get_template_directory_uri();

        /* STYLESHEETs */ 
        wp_enqueue_style('kopa-oswald', '//fonts.googleapis.com/css?family=Oswald:400,300,700');
        wp_enqueue_style('kopa-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('kopa-font-awesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('kopa-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('kopa-owl.carousel', $dir . '/css/owl.carousel.css');
        wp_enqueue_style('kopa-owl.theme', $dir . '/css/owl.theme.css');
        wp_enqueue_style('kopa-navgoco', $dir . '/css/jquery.navgoco.css');
        wp_enqueue_style('kopa-extra', $dir . '/css/extra.css');
        wp_enqueue_style('kopa-style', get_stylesheet_uri());
        wp_enqueue_style('kopa-responsive', $dir . '/css/responsive.css');

        if ( $is_IE ) {
            wp_register_style('kopa-ie', $dir . '/css/ie.css');
            $wp_styles->add_data('kopa-ie', 'conditional', 'lt IE 9');
            wp_register_style('kopa-ie9', $dir . '/css/ie9.css');
            wp_enqueue_style('kopa-ie');
            wp_enqueue_style('kopa-ie9');
        }

        /* JAVASCRIPTs */
        wp_enqueue_script('jquery');
        wp_localize_script('jquery', 'kopa_front_variable', news_maxx_lite_front_localize_script());
        wp_enqueue_script('modernizr.custom', $dir . '/js/modernizr.custom.min.js', array(), null);
        wp_enqueue_script('kopa-bootstrap', $dir . '/js/bootstrap.min.js', array(), null);
        wp_enqueue_script('kopa-custom-js', $dir . '/js/custom.js', array(), null, true);
        wp_enqueue_script('kopa-match-height', $dir . '/js/jquery.matchHeight-min.js', array(), null, true);

        // send localization to frontend
        wp_localize_script('kopa-custom-js', 'news_maxx_lite_custom_front_localization', news_maxx_lite_custom_front_localization());

        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function news_maxx_lite_front_localize_script() {
    $news_maxx_lite_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
            ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
            )
        );
    return $news_maxx_lite_variable;
}

function news_maxx_lite_custom_front_localization() {
    $front_localization = array(
        'url' => array(
            'template_directory_uri' => get_template_directory_uri(),
            ),
        'validate' => array(
            'form' => array(
                'submit'  => __('SEND', 'news-maxx-lite'),
                'sending' => __('SENDING...', 'news-maxx-lite')
                ),
            'name' => array(
                'required'  => __('Please enter your name.', 'news-maxx-lite')
                ),
            'email' => array(
                'required' => __('Please enter your email.', 'news-maxx-lite'),
                'email'    => __('Please enter a valid email.', 'news-maxx-lite')
                ),
            'comment' => array(
                'required'  => __('Please enter your comment.', 'news-maxx-lite')
                )
            )
        );

    return $front_localization;
}

function news_maxx_lite_body_class($classes){

    global $template;
    $dir = dirname(__FILE__).'/';
    $page_temp = substr($template, strlen($dir));
    
    $layout = get_theme_mod('blog-layout', '2');
    
    if(is_page()){
        switch($page_temp){
            case 'page-full-width.php':
                $classes[] = 'kopa-subpage kopa-fullwidth';
                break;
            default:
                $classes[] = 'kopa-subpage';
                break;
        }
    }

    switch ($layout){
        case '2':
            $classes[] = 'kopa-subpage kopa-categories-2';
            break;
        default:
            $classes[] = 'kopa-subpage';
            break;
    }

    $format = get_post_format();
    switch ($format){
        case 'audio':
            $classes[] = 'kopa-subpage kopa-single-audio';
            break;
        default:
            break;
    }

    return $classes;
}

function news_maxx_lite_post_class($classes){
    return $classes;
}





















