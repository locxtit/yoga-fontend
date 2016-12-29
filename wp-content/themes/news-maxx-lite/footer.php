
</section>
<!-- main-section -->
</div>
<!-- main-content -->
<section class="dark-box">

    <div class="wrapper">

        <nav id="bottom-nav" class="text-center">
            <?php
            if ( has_nav_menu( 'bottom-nav' )) {
                wp_nav_menu( array(
                    'theme_location'  => 'bottom-nav',
                    'container'       => false,
                    'items_wrap' => '<ul id="bottom-menu" class="clearfix">%3$s</ul>',
                    'depth'           => -1,
                    ));
            }
            ?>

            <i class='fa fa-align-justify'></i>
            <div class="bottom-mobile-menu-wrapper">
                <?php
                if ( has_nav_menu( 'bottom-nav' )) {
                    wp_nav_menu( array(
                        'theme_location'  => 'bottom-nav',
                        'container'       => false,
                        'items_wrap' => '<ul id="bottom-mobile-menu">%3$s</ul>',
                        'depth'           => -1,
                        ));
                }
                ?>
                <!-- mobile-menu -->
            </div>
            <!-- mobile-menu-wrapper -->
        </nav>
        <!-- bottom-nav -->

    </div>
    <!-- wrapper -->
</section>
<!-- dark-box -->
<section id="bottom-sidebar">

    <div class="wrapper">

        <div class="row">
            <!-- position 9 -->
            <div class="col-md-3 col-sm-3 widget-area-9">

                <?php $logo_url =  get_theme_mod('bottom-logo');
                if( $logo_url ) : ?>
                <div class="bottom-logo">
                    <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name'); ?>"><img id="logo-image2" src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>"/></a>
                </div>
            <?php endif; ?>
            <!-- bottom-logo -->

            <?php
            if ( is_active_sidebar('footer-1-sidebar') ) {
                dynamic_sidebar('footer-1-sidebar');
            }
            ?>
        </div>
        <!-- col-md-3 -->

        <!-- position 10 -->
        <div class="col-md-3 col-sm-3 widget-area-10">
            <?php
            if ( is_active_sidebar('footer-2-sidebar') ) {
                dynamic_sidebar('footer-2-sidebar');
            }
            ?>
        </div>
        <!-- col-md-3 -->

        <!-- position 11 -->
        <div class="col-md-3 col-sm-3 widget-area-11">
            <?php
            if ( is_active_sidebar('footer-3-sidebar') ) {
                dynamic_sidebar('footer-3-sidebar');
            }
            ?>
        </div>
        <!-- col-md-3 -->

        <!-- position 12 -->
        <div class="col-md-3 col-sm-3 widget-area-12">

            <?php
            if ( is_active_sidebar('footer-4-sidebar') ) {
                dynamic_sidebar('footer-4-sidebar');
            }
            ?>

        </div>
        <!-- col-md-3 -->

    </div>
    <!-- row -->

</div>
<!-- wrapper -->

</section>
<!-- bottom-sidebar -->

<?php
$kopa_theme_options_copyright = get_theme_mod('copyright' );
$kopa_theme_options_copyright = htmlspecialchars_decode(stripslashes($kopa_theme_options_copyright));
?>
<?php if ( ! empty( $kopa_theme_options_copyright ) ) : ?>
    <footer class="kopa-page-footer">

        <div class="wrapper">
            <p id="copyright" ><?php echo $kopa_theme_options_copyright; ?></p>
        </div>
        <!-- wrapper -->

    </footer>
    <!-- kopa-page-footer -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>