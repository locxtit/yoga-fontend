<?php
/*
Plugin Name: Post To Email
Description: [wp-post-to-email]
Version: 1.0.0
Author: XuanLoc
*/
add_action( 'init', 'post_to_email_init' );

function post_to_email_init()
{
	add_action( 'wp_footer', 'post_to_email_javascript' );
}

function post_to_email_javascript() {?>
	<div class="modal fade" id="modal-post-to-mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Gửi mail đến email sau:</h4>
		  </div>
		  <div class="modal-body">
			<div class="row search-booking">
				<div class="col-md-2" style="text-align:right;"><label>Email</label></div>
				<div class="col-md-5"><input name="" id="txtToEmail" type="text"></div>
				<div class="col-md-5">
                	<input name="" onclick="postToEmail();" type="button" value="Gửi"/>
                    <input name="" style="margin-left:10px;" class="btn btn-default" data-dismiss="modal" aria-label="Close" type="button" value="Đóng"/>
                </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<script>
		function postToEmail()
		{
			var toEmail = jQuery('#txtToEmail').val();
			var postId = jQuery('#postId').val();
			if(toEmail == undefined || toEmail == '')
			{
				return;
			}
			if(postId == undefined || postId == '')
			{
				return;
			}
			var datasend = {
				action:'post_to_email',
				toEmail:toEmail,
				postId: postId
			};
			
			jQuery('#modal-post-to-mail').find('.search-booking').before('<p class="success">'+'Gửi mail thành công'+'</p>');
			jQuery.ajax({
				type : 'POST',
				data : datasend,
				url : '<?php echo admin_url( "admin-ajax.php" ); ?>',
				success : function (resp){
					
				}
			});
		}
		jQuery(document).ready(function($) {
			$('#modal-post-to-mail').on('shown.bs.modal', function() {
				$('#modal-post-to-mail p.success, #modal-post-to-mail p.error').remove();
				$('#modal-post-to-mail #txtToEmail').val('');
			});
		});
		
	</script>
	<?php
}

add_action('wp_ajax_post_to_email', 'post_to_emai_action_callback');
add_action('wp_ajax_nopriv_post_to_email', 'post_to_emai_action_callback');

function post_to_emai_action_callback() {
    $toEmail = '';
	$postId = '';
	if(isset($_POST['toEmail']))
		$toEmail = trim($_POST['toEmail']);
	if(isset($_POST['postId']))
		$postId = trim($_POST['postId']);
	if($toEmail == '')
	{
		echo 'Vui lòng nhập Email';
		die();
	}
	if($postId == '' && !is_int($postId))
	{
		echo 'Chưa có bài post';
		die();
	}
		
	$post_get = get_post(intval($postId)); 
	$subject = $post_get->post_title;
	$message = $post_get->post_content;
	$to = $toEmail;

	if(!empty($subject) && !empty($message))
	{
		try{
			$result = wp_mail($to,$subject,$message);
			if($result == 1)
				echo 'Gửi thành công';
			else
				echo 'Gửi mail thất bại';
				
		}catch(phpmailerException $e){
			echo 'Lỗi'.$e->errorMessage();
		}
	}
	else
	{
		echo 'Chưa có tiêu đề hoặc nội dung mail.';
	}
	
    die();
}

?>