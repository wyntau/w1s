<?php
/**
 * W1 functions and definitions
 * 主题初始化，设定一些参数
 */
 
// no direct access
defined('ABSPATH') or die('Restricted access -- WINYSKY ');
// -- BASE Define BEGIN ----------------------------------------

/* PHP warning message */
error_reporting(E_ALL & ~E_NOTICE); // 偵錯用

/* 限制直接访问的定义*/
define('WINYSKY', 'WINYSKY');
// app dir
define('winysky_app', TEMPLATEPATH.'/app');
// debug - if true the errors will display below footer when admin login
//define('winysky_DEBUG', true);
//
define('WINYSKY', 'WINYSKY');

/**
 * include all PHP script
 * @param string $dir
 * @return unknown_type
 */
function iSaymeIncludeAll($dir){
	$dir = realpath($dir);
	if($dir){
		$files = scandir($dir);
		sort($files);
		foreach($files as $file){
			if($file == '.' || $file == '..'){
				continue;
			}elseif(preg_match('/\.php$/i', $file)){
				include_once $dir.'/'.$file;
			}
		}
	}
}
// include functions by yinheli
iSaymeIncludeAll( winysky_app );
function custom_smilies_src($src, $img){
    return get_bloginfo('template_directory').'/img/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2); // 優先級10(默認), 變量2個($src 和 $img)
if ( !isset( $wpsmiliestrans ) ) {
		$wpsmiliestrans = array(
		':mrgreen:' => '11.gif',
		 ':no:' => '1.gif',
		':neutral:' => '12.gif',
		':twisted:' => '19.gif',
		 ':shut:' => '23.gif',
		 ':eat:' => '3.gif',
		  ':arrow:' => '16.gif',
		  ':shock:' => '7.gif',
		   ':surprise:' => '26.gif',
		  ':smile:' => '33.gif',
		    ':???:' => '5.gif',
		   ':cool:' => '10.gif',
		    ':cold:' => '14.gif',
		   ':evil:' => '2.gif',
		   ':grin:' => '4.gif',
		   ':idea:' => '9.gif',
		    ':han:' => '6.gif',
		   ':oops:' => '25.gif',
		   ':mask:'=>'27.gif',
		    ':sigh:' => '15.gif',
		   ':razz:' => '17.gif',
		   ':roll:' => '21.gif',
		    ':cry:' => '28.gif',
		    ':zzz:' => '29.gif',
		    ':eek:' => '18.gif',
		     ':love:' => '20.gif',
		      ':sex:' => '13.gif',
		       ':jiong:' => '8.gif',
		    ':lol:' => '24.gif',
		    ':mad:' => '31.gif',
		     ':ool:' => '32.gif',
		    ':sad:' => '30.gif',
		);
	}
?>
