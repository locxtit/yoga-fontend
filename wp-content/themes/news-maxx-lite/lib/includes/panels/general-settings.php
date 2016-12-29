<?php

function news_maxx_lite_init_options($options){
    $options['sections'][] = array(
        'id'    => 'news_maxx_opt_general',
        'title' => __('General Settings', 'news-maxx-lite'));

    $options['settings'][] = array(
        'settings'    => 'logo',
        'label'       => __('Logo', 'news-maxx-lite'),
        'description' => __('Upload your logo image.', 'news-maxx-lite'),
        'default'     => '',
        'type'        => 'image',
        'section'     => 'news_maxx_opt_general',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'    => 'bottom-logo',
        'label'       => __('Bottom logo', 'news-maxx-lite'),
        'description' => __('Upload your bottom logo image.', 'news-maxx-lite'),
        'default'     => '',
        'type'        => 'image',
        'section'     => 'news_maxx_opt_general',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'    => 'copyright',
        'label'       => __('Copyright', 'news-maxx-lite'),
        'description' => __('Your copyright information on footer.', 'news-maxx-lite'),
        'default'     => '',
        'type'        => 'textarea',
        'section'     => 'news_maxx_opt_general',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings' => 'blog-layout',
        'label'    => __('Blog layout', 'news-maxx-lite'),        
        'default'  => '1',
        'type'     => 'select',
        'choices'  => array(
            '1' => __('Blog-1', 'news-maxx-lite'),
            '2' => __('Blog-2', 'news-maxx-lite')
            ),
        'section'     => 'news_maxx_opt_general',
        'transport'   => 'refresh');  


    return $options;
}