<?php
function ajax_post(){
	if( isset($_POST['action'])&& $_POST['action'] == 'ajax_post'){	
	include_once TEMPLATEPATH.'/loop/loop-home.php';
		die();
	}else{
		return;
	}
}
add_action('template_redirect', 'ajax_post');
