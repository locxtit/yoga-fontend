<?php
function wpcf_Yoga_Home_Yoga_For( $atts ){   
    $page_data = get_post( 43 );
    return $page_data->post_content;   
}
?>