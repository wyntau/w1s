<?php
/**
 * when comment check the comment_author comment_author_email
 * @param unknown_type $comment_author
 * @param unknown_type $comment_author_email
 * @return unknown_type
 */
function CheckEmailAndName(){
	global $wpdb;
	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	if(!$comment_author || !$comment_author_email){
		return;
	}
	$result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
	if ($result_set) {
		if ($result_set[0]->display_name == $comment_author){
			$errorMessage =  __('警告: 您不能用这个昵称，因为这是我的名字！乖，不要捣乱(*^__^*)……');
		}else{
			$errorMessage = __('警告: 您不能使用该邮箱地址，因为这是我的邮箱！乖，不要捣乱(*^__^*)……');
		}
		fail($errorMessage);
	}
}
add_action('pre_comment_on_post', 'CheckEmailAndName');
