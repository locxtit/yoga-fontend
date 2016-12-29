<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />                   
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />                       
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="kopa-page-header">

        <div class="header-top">

            <div class="wrapper clearfix">
                <?php news_maxx_lite_the_current_time(); ?>
                <nav class="top-nav pull-right">
                    <?php
                    if ( has_nav_menu( 'top-nav' ) ) {
                        wp_nav_menu( array(
                            'theme_location'  => 'top-nav',
                            'container'       => false,
                            'items_wrap' => '<ul id="top-menu" class="top-menu clearfix">%3$s</ul>',
                            'depth'           => -1,
                            ));
                    }
                    ?>
                    <!-- top-menu -->
                </nav>
                <!-- top-nav -->
            </div>
            <!-- wrapper -->
        </div>
        <!-- header-top -->

        <?php
        $logo_url =  get_theme_mod('logo');
        if($logo_url) : ?>
        <div class="header-top-2">

            <div class="wrapper clearfix">
                <div id="logo-container" class="pull-left">
                    <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name'); ?>"><img id="logo-image" src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>"/></a>
                </div>
                <!-- logo-container -->

            </div>
            <!-- wrapper -->

        </div>
    <?php endif; ?>

    <!-- header-top-2 -->

    <div class="header-middle">

        <div class="wrapper">

            <nav class="main-nav">
                <div class="wrapper clearfix">
                    <?php
                    if ( has_nav_menu( 'main-nav' )) {
                        wp_nav_menu( array(
                            'theme_location'  => 'main-nav',
                            'container'       => '',
                            'menu_id'         => 'main-menu',
                            'menu_class'      => 'main-menu clearfix',
                            ));
                        echo '<i class="fa fa-align-justify"></i>';
                    } ?>

                    <div class="mobile-menu-wrapper">
                        <?php
                        if ( has_nav_menu( 'main-nav' )) {
                            wp_nav_menu( array(
                                'theme_location'  => 'main-nav',
                                'container'       => '',
                                'menu_id'         => 'mobile-menu',
                                'menu_class'      => '',
                                ));
                        }
                        ?>
                        <!-- mobile-menu -->
                    </div>
                    <!-- mobile-menu-wrapper -->

                </div>
                <!-- wrapper -->

            </nav>
            <!-- main-nav -->

            <?php get_search_form(); ?>
            <!-- search box -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- header-middle -->

    <div class="header-bottom">

        <div class="wrapper">

            <nav class="secondary-nav">
                <?php
                if ( has_nav_menu( 'second-nav' )) {
                    wp_nav_menu( array(
                        'theme_location'  => 'second-nav',
                        'container'       => '',
                        'menu_id'         => '',
                        'menu_class'      => 'secondary-menu clearfix',
                        ));
                    } ?>
                    <!-- secondary-menu -->
                    <span><?php _e('Menu', 'news-maxx-lite'); ?></span>
                    <div class="secondary-mobile-menu-wrapper">
                        <?php
                        if ( has_nav_menu( 'main-nav' )) {
                            wp_nav_menu( array(
                                'theme_location'  => 'main-nav',
                                'container'       => '',
                                'menu_id'         => 'secondary-mobile-menu',
                                'menu_class'      => '',
                                ));
                        }
                        ?>
                        <!-- mobile-menu -->
                    </div>
                    <!-- mobile-menu-wrapper -->
                </nav>
                <!-- secondary-nav -->

            </div>
            <!-- wrapper -->

        </div>
        <!-- header-bottom -->

    </div>
    <!-- kopa-page-header -->

    <div id="main-content">

        <div class="widget-area-1">

            <div class="stripe-box">

                <div class="wrapper">

                    <div class="left-color"></div>

                    <?php news_maxx_lite_the_topnew(); ?>
                    <!-- top new -->

                    <div class="right-color"></div>
                </div>
                <!-- wrapper -->

            </div>
            <!-- stripe-box -->

        </div>
        <!-- widget-area-1 -->

        <div class="bn-box">

            <div class="wrapper clearfix">

                <?php news_maxx_lite_the_headline(); ?>
                <!-- kp-headline-wrapper -->

            </div>
            <!-- wrapper -->

        </div>
        <!-- bn-box -->

        <section class="main-section">