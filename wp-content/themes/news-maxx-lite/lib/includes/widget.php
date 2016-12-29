<?php

add_action('admin_enqueue_scripts', 'news_maxx_lite_widget_admin_enqueue_scripts');

function news_maxx_lite_widget_admin_enqueue_scripts($hook) {
	if ('widgets.php' === $hook) {
		$dir = get_template_directory_uri() . '/lib';
		wp_enqueue_style('kopa_widget_admin', "{$dir}/css/widget.css");
		wp_enqueue_script('kopa_widget_admin', "{$dir}/js/widget.js", array('jquery'));
	}
}

function news_maxx_lite_widget_posttype_build_query( $query_args = array() ) {
	$default_query_args = array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'post__not_in'   => array(),
		'ignore_sticky_posts' => 1,
		'categories'     => array(),
		'tags'           => array(),
		'relation'       => 'OR',
		'post_format' => '',
		'orderby'        => 'latest',
		'cat_name'       => 'category',
		'tag_name'       => 'post_tag'
		);

	$query_args = wp_parse_args( $query_args, $default_query_args );

	$args = array(
		'post_type'           => $query_args['post_type'],
		'posts_per_page'      => $query_args['posts_per_page'],
		'post_format' => $query_args['post_format'],
		'post__not_in'        => $query_args['post__not_in'],
		'ignore_sticky_posts' => $query_args['ignore_sticky_posts']
		);

	$tax_query = array();

	if ( $query_args['categories'] ) {
		$tax_query[] = array(
			'taxonomy' => $query_args['cat_name'],
			'field'    => 'id',
			'terms'    => $query_args['categories']
			);
	}
	if ( $query_args['tags'] ) {
		$tax_query[] = array(
			'taxonomy' => $query_args['tag_name'],
			'field'    => 'id',
			'terms'    => $query_args['tags']
			);
	}
	if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
		$tax_query['relation'] = $query_args['relation'];
	}
	if ( $query_args['post_format'] ) {
		$tax_query[] = array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( $query_args['post_format'] )
			);
	}

	if ( isset($query_args['date_query']) && $query_args['date_query'] ){
		global $wp_version;
		$timestamp =  $query_args['date_query'];
		if (version_compare($wp_version, '3.7.0', '>=')) {
			if (isset($timestamp) && !empty($timestamp)) {
				$y = date('Y', strtotime($timestamp));
				$m = date('m', strtotime($timestamp));
				$d = date('d', strtotime($timestamp));
				$args['date_query'] = array(
					array(
						'after' => array(
							'year' => (int) $y,
							'month' => (int) $m,
							'day' => (int) $d
							)
						)
					);
			}
		}
	}

	if ( $tax_query ) {
		$args['tax_query'] = $tax_query;
	}

	switch ( $query_args['orderby'] ) {
		case 'popular':
		$args['meta_key'] = 'news-maxx-lite' . '_total_view';
		$args['orderby'] = 'meta_value_num';
		break;
		case 'most_comment':
		$args['orderby'] = 'comment_count';
		break;
		case 'random':
		$args['orderby'] = 'rand';
		break;
		default:
		$args['orderby'] = 'date';
		break;
	}

	return new WP_Query( $args );
}

function news_maxx_lite_print_timeago($field_id, $field_name, $selected_timeago, $is_admin = false){
    $timeago = array(
        'label' => __('Timestamp (ago)', 'news-maxx-lite'),
        'options' => array(
            '' => __('-- Select --', 'news-maxx-lite'),
            '-1 week' => __('1 week', 'news-maxx-lite'),
            '-2 week' => __('2 weeks', 'news-maxx-lite'),
            '-3 week' => __('3 weeks', 'news-maxx-lite'),
            '-1 month' => __('1 months', 'news-maxx-lite'),
            '-2 month' => __('2 months', 'news-maxx-lite'),
            '-3 month' => __('3 months', 'news-maxx-lite'),
            '-4 month' => __('4 months', 'news-maxx-lite'),
            '-5 month' => __('5 months', 'news-maxx-lite'),
            '-6 month' => __('6 months', 'news-maxx-lite'),
            '-7 month' => __('7 months', 'news-maxx-lite'),
            '-8 month' => __('8 months', 'news-maxx-lite'),
            '-9 month' => __('9 months', 'news-maxx-lite'),
            '-10 month' => __('10 months', 'news-maxx-lite'),
            '-11 month' => __('11 months', 'news-maxx-lite'),
            '-1 year' => __('1 year', 'news-maxx-lite'),
            '-2 year' => __('2 years', 'news-maxx-lite'),
            '-3 year' => __('3 years', 'news-maxx-lite'),
            '-4 year' => __('4 years', 'news-maxx-lite'),
            '-5 year' => __('5 years', 'news-maxx-lite'),
            '-6 year' => __('6 years', 'news-maxx-lite'),
            '-7 year' => __('7 years', 'news-maxx-lite'),
            '-8 year' => __('8 years', 'news-maxx-lite'),
            '-9 year' => __('9 years', 'news-maxx-lite'),
            '-10 year' => __('10 years', 'news-maxx-lite'),
        )
    );
    if ($is_admin) {
        $str_ret = '';
        $str_ret .= '<span class="kopa-component-title">'. $timeago['label'] . '</span>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '" class="kopa-ui-taxonomy kopa-ui-select form-control">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
    } else {
        $str_ret = '<p>';
        $str_ret .= '<label for="'.$field_id.'">'. $timeago['label'] . '</label>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
        $str_ret .= '</p>';
    }

    echo $str_ret;
}

// Widgets

get_template_part('lib/includes/widgets/widget', 'article-list-carousel');
get_template_part('lib/includes/widgets/widget', 'articles-list-cat');
get_template_part('lib/includes/widgets/widget', 'articles-list');
get_template_part('lib/includes/widgets/widget', 'combo');
get_template_part('lib/includes/widgets/widget', 'contact-info');
get_template_part('lib/includes/widgets/widget', 'list-gallery');
get_template_part('lib/includes/widgets/widget', 'text');
get_template_part('lib/includes/widgets/widget', 'video');
