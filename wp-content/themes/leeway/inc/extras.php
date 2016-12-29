<?php
/**
 * Custom functions that are not template related
 *
 * @package Leeway
 */


// Add Default Menu Fallback Function
function leeway_default_menu() {
	echo '<ul id="mainnav-menu" class="menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
}


// Get Featured Posts
function leeway_get_featured_content() {
	return apply_filters( 'leeway_get_featured_content', false );
}


// Change Excerpt Length
add_filter('excerpt_length', 'leeway_excerpt_length');
function leeway_excerpt_length($length) {
    return 60;
}


// Slideshow Excerpt Length
function leeway_slideshow_excerpt_length($length) {
    return 32;
}

// Category Posts Large Excerpt Length
function leeway_category_posts_large_excerpt($length) {
    return 32;
}

// Category Posts Medium Excerpt Length
function leeway_category_posts_medium_excerpt($length) {
    return 20;
}

// Category Posts Small Excerpt Length
function leeway_category_posts_small_excerpt($length) {
    return 8;
}