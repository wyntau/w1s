<?php
/**
 * basic function 
 */
 // no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');
/**
 * Filter post_comments_feed_link_html
 * @param unknown_type $c
 * @return unknown_type
 * function copy from philna2
 */
function WinyskyPostCommentsFeedLinkHtml($c){
	return stripslashes( wp_rel_nofollow($c) );
}
add_filter('post_comments_feed_link_html', 'WinyskyPostCommentsFeedLinkHtml');


/*rss*/
function WinyskyFeedAdditional($content){
if(is_feed()||is_single()){
		$content.= '<div class="copyright_info">
		　&raquo; <b>原创文章如转载请注明来源：<a title="I Say Me | 我说我自己 | 我说世界" href="http://ISayMe.com">自说Me话 &#8482;</a> 　&raquo; <a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'">《'.get_the_title().'》</a></b><br>
		　&raquo; <b>本文链接地址：<a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'">'.get_permalink().'</a></b><br>
		　&raquo; <b>欢迎订阅本站：您可以选择通过<a href="http://feeds2.feedburner.com/ISayMe" target="_blank">RSS阅读器订阅</a>或者通过<a href="http://feedburner.google.com/fb/a/mailverify?uri=isayme" target="_blank">邮件E-mail订阅</a></b><br>
		<strong class="icon">声明:</strong><b>如無特別申明,文章均為博主原創并遵循<a title="署名-非商业性使用-相同方式共享3.0共享协议" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" target="_blank" rel="external nofollow">署名-非商业性使用-相同方式共享3.0</a>. 转载请注明转自<a title="I Say Me | 我说我自己 | 我说世界" href="http://ISayMe.com" rel="bookmark inlinks"> 自说Me话 &#8482;</a></b></div>';}
	if(is_feed()){
		$content .= '<BR />';		
		global $id;
		$comment_num = get_comments_number($id);
		if($comment_num==0){
			$rss_comment_tip="<BR />&raquo;当你从RSS阅览器里看到这篇文章时，还没有评论，还不赶紧过来抢沙发？ ";
		}elseif($comment_num>=1 && $comment_num<15){
			$rss_comment_tip="<BR />&raquo;当你从RSS阅览器里看到这篇文章时，已有 <strong> ".$comment_num." </strong>条评论 ,欢迎过来看看 !";
		}else{
			$rss_comment_tip="<BR />&raquo;当你从RSS阅览器里看到这篇文章时，已有超过<strong> ".$comment_num." </strong>条评论,火热盖楼进行中...";
		}
		$content .= $rss_comment_tip;
	}
	return $content;
}
add_filter('the_content', 'WinyskyFeedAdditional',0);
/*
 *去掉标题字样
 *
 */
function blah($title) {
       return '%s';
}
add_filter('protected_title_format', 'blah');
add_filter('private_title_format', 'blah');


/* Mini Pagenavi v1.0 by Willin Kan. */
function pagenavi( $p = 4 ) { // 取當前頁前後各 2 頁
  if ( is_singular() ) return; // 文章與插頁不用
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return; // 只有一頁不用
  if ( empty( $paged ) ) $paged = 1;
  // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // 頁數
  if ( $paged > $p + 1 ) p_link( 1, __('first') );
  if ( $paged > $p + 2 ) echo "<span class='dots'> ... </span>";
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中間頁
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) echo "<span class='dots'> ... </span>";
  if ( $paged < $max_page - $p ) p_link( $max_page, __('last') );
}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = __('Pages')." {$i}";
  echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
}
// -- END ----------------------------------------



// --Function BEGIN ------------------------------------------


/* 首页图片 by winy*/
function winypostimg($imagestype='post'){
global $post;
$href=get_permalink();
$szPostContent = $post->post_content;
$first_img = '';
if($imagestype =='slider'){
$w='/img/slider';
$width='236px';
$height='100px';
}else{
$w='/img/post';
$width='150px';
$height='100px';
}
$imagesDir = TEMPLATEPATH.$w;
//匹配 <img>
preg_match_all('~<img [^\>]*>~', $szPostContent, $matches);
$first_image = $matches[0][0];
//匹配 src
preg_match_all('~src=[\'"]([^\'"]+)[\'"]~', $first_image, $matches);
$src=$matches[1][0];
if (empty($src)){//如果文章没有图片
	
	$src = get_bloginfo('template_directory') .$w.'/'.rand(1,6).'.jpg';
}
    $src1 = get_bloginfo('template_directory').'/img/clear.gif';
    echo "<a title=\"文章图片\" href=\"$href\"><img alt=\"文章图片\" src=\"$src1\" style=\"background:url($src) no-repeat 50% 50%; ;width:$width;height:$height;\" /></a>";
}


/* Auto-excerpt by winy */
function winyexcerpt($max_char = 200, $more_text = '...', $limit_type = 'content') {
	
    if ($limit_type == 'title') { $text = get_the_title(); }
    else { $text = get_the_content(); }
    $text = apply_filters('the_content', $text);
    $text = strip_tags(str_replace(']]>', ']]>', $text));
	$text = trim($text);
     if (strlen($text) > $max_char) {
		 $text = substr($text, 0, $max_char+1);
         $text = utf8_conver($text);
		 $text = str_replace(array("\r", "\n", "&"), ' ', $text);
		 $text .= $more_text;
		 if ($limit_type == 'content'){
		 $text = "<p>".$text."</p>";
         $text .= "<div class='readmore'><a href='".get_permalink()."' title='查看全文点击此处' rel='nofollow'>继续阅读</a></div>";
		 }
        echo $text;
    } else {
		 if ($limit_type == 'content'){$text = "<p>".$text."</p>";}
        echo $text;
    }
}

function utf8_conver($str) {
        $len = strlen($str);
        for ($i=strlen($str)-1; $i>=0; $i-=1){
                $hex .= ' '.ord($str[$i]);
                $ch = ord($str[$i]);
        if (($ch & 128)==0) return(substr($str,0,$i));
                if (($ch & 192)==192) return(substr($str,0,$i));
        }
        return($str.$hex);
}


function time_diff( $time_type ){
    switch( $time_type ){
        case 'comment':    //如果是评论的时间
            $time_diff = current_time('timestamp') - get_comment_time('U');
            if( $time_diff <= 86400 )    //24 小时之内
                echo human_time_diff(get_comment_time('U'), current_time('timestamp')).' 之前';    //显示格式 OOXX 之前
            else
                printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time());    //显示格式 X年X月X日 OOXX 时
            break;
        case 'post';    //如果是日志的时间
            $time_diff = current_time('timestamp') - get_the_time('U');
            if( $time_diff <= 86400 )
                echo human_time_diff(get_the_time('U'), current_time('timestamp'));
            else
                the_time('Y.m.d');
            break;
    }
}

 
function cache_buster_code($stylesheet_uri){
    $pieces = explode('wp-content', $stylesheet_uri);
    $stylesheet_uri = $stylesheet_uri . '?v=' . filemtime(ABSPATH . '/wp-content' . $pieces[1]);
    return $stylesheet_uri;
}
add_filter('stylesheet_uri','cache_buster_code',9999,1); 
/**
 * load js in footer
 * @return null
 */
function SayMeLoadJS(){
	$blogurl = get_bloginfo('url').'/';
	$themeurl= get_bloginfo('template_directory') ;
	$jsFileURI =$themeurl.'/js.php';
	$jsFile =TEMPLATEPATH.'/js/W1.min.js';
	$jsFileURI .= '?v='.date('YmdHis', filemtime($jsFile));
	$text = <<<EOF
<script type="text/javascript">
/* <![CDATA[ */
var iSayme={}; base="$blogurl"; var themeurl="$themeurl/";
/* ]]> */
</script>
<script src="{$jsFileURI}" type="text/javascript"></script>\n
EOF;
	echo $text;
}
add_action('wp_footer', 'SayMeLoadJS', 100);
