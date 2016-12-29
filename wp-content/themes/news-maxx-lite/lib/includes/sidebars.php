<?php

function news_maxx_lite_register_sidebar(){

    $args = array(
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>');

    $sidebars = array(
        array(
            'name'          => __( 'Sidebar Top Left', 'news-maxx-lite' ),
            'id'            => 'top-left'),
        array(
            'name'          => __( 'Sidebar Right Top', 'news-maxx-lite' ),
            'id'            => 'sidebar-right-top'),
        array(
            'name'          => __( 'Sidebar Right Center Left', 'news-maxx-lite' ),
            'id'            => 'sidebar-right-center-left'),
        array(
            'name'          => __( 'Sidebar Right Center Right', 'news-maxx-lite' ),
            'id'            => 'sidebar-right-center-right'),
        array(
            'name'          => __( 'Sidebar Right Bottom', 'news-maxx-lite' ),
            'id'            => 'sidebar-right-bottom'),
        array(
            'name' => __('Footer 1st', 'news-maxx-lite'),
            'id' => 'footer-1-sidebar'),     
        array(
            'name' => __('Footer 2nd', 'news-maxx-lite'),
            'id' => 'footer-2-sidebar'),     
        array(
            'name' => __('Footer 3rd', 'news-maxx-lite'),
            'id' => 'footer-3-sidebar'),     
        array(
            'name' => __('Footer 4th', 'news-maxx-lite'),
            'id' => 'footer-4-sidebar')        
        );

    foreach($sidebars as $sidebar){
        $sidebar = array_merge($sidebar, $args);
        register_sidebar($sidebar);
    }       
}