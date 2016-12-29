<?php
function wpcf_Bluesky_Post_Contact( $atts ){   
    $page_data = get_post( 2990 );
    return $page_data->post_content;   
}
?>