<?php
/**
 * js loader
 *
 */
if ( extension_loaded('zlib') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) {
	ob_start('ob_gzhandler');
} else {
	ob_start();
}
header("Cache-Control: max-age=3600, public");
header("Pragma: cache");
header( "Vary: Accept-Encoding" ); // Handle proxies
header('Content-Type: text/javascript; charset: UTF-8');
$head = <<<EOF
/*
Copyright (C) 2011 Some rights reserved.
Author: iSayme
Author URI: http://ISayMe.com/ 自说Me话
The JSLoader Mod from PhilNa2(http://philna.com)
*/\n\n
EOF;
$jsFiles = array('jQuery','single.min','W1.min','MyFunction');
$jsDir = dirname(__FILE__) . '/js';
echo $head;
foreach ($jsFiles as $file) {
	$minfile = $jsDir.'/'.$file.'.js';
	if (file_exists($minfile))
		include_once $minfile;
}
