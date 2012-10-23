<?php
//表情载入函数,Mod From PhilNa2 By iSayme
function SayMeCommentSmilies(){
	global $wpsmiliestrans;
	$path = get_bloginfo('template_directory').'/img/smilies/';
	$output = '';
	$smilies = array_unique($wpsmiliestrans);
	$startimg = '<a id="smiliebtn" class="smelis" href="javascript:void(0);" style="background:none;"><img src="'.$path.'33.gif'.'" alt="" title="'.__('Add a smiley?', YHL).'"/></a>';
	foreach ($smilies as $title=>$smilies){
		$output .= '<a title=" '.$title.' " href="#" rel="nofollow"><img src="'.$path.$smilies.'" alt=""/></a>';
	}
	$output = '<div id="smelislist">'.$output.'</div>'."\n";
	echo $startimg,$output;
}
