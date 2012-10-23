<?php
/**
 * basic function 
 */
 // no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');

/**
 * 错误泡泡
 *
 * 用于抛出错误
 * 实现$s的多变
 * 摘自著名主题 k2
 * 修改了参数类型,更方便使用!
 *
 * @since 1.0
 */
function fail($s) {
	header('HTTP/1.0 403 Forbidden');
	header('Content-Type: text/plain');
	if(is_string($s)){
		die($s);
	}else{
		$s;
		die;
	}
}
/**
 * 通过USER_Agent判断是否为机器人.
 * Edit by winy 10.01.28
 * @return Boolean
 */
function is_bot(){
	$bots = array('Baiduspider1'=>'Baiduspider','Baiduspider2'=>'Baiduspider+','Google Bot1' => 'googlebot', 'Google Bot2' => 'google', 'Google AdSense' => 'Mediapartners', 'MSN' => 'msnbot', 'Yahoo Bot1' => 'yahoo', 'Yahoo Bot2' => 'Yahoo! Slurp','Yahoo Bot3' => 'Yahoo! Slurp China','YodaoBot' => 'YodaoBot','iaskspider' => 'iaskspider','Sogou web spider' => 'Sogou web spider','Sogou Push Spider' => 'Sogou Push Spider','Sosospider' => 'Sosospider','Alex' => 'ia_archiver', 'Bot'=>'bot','Spider'=>'spider','for_test'=>'sFirefox');
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	foreach ($bots as $name => $lookfor) {
		if (stristr($useragent, $lookfor) !== false) {
			return true;
			break;
		}
	}
}



/* UTF-8 substr() for none mb_substr() */
if ( !function_exists('mb_substr') ) {
  function mb_substr( $str, $start, $length, $encoding ) {
    return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $start . '}'.
    '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $length . '}).*#s', '$1', $str);
  }
}

function iSaymeKeywordsAndDescription(){
	global $post, $wp_query;
	// default
	$keywords = '自说Me话 wordpress Linux Internet';
	$description = 'I Say Me | 我说我自己 | 我说世界 一个理工科人的网络记录,同喜欢网络,Linux,wordpress,折腾的人共同分享,记录折腾wordpress,Linux的心得还有学习过程.';
	if(is_singular()){ // 普通页面
		$keywords = array($keywords);
		$keywords[] = get_post_meta($post->ID, 'Keywords', true);
		$keywords[] = get_post_meta($post->ID, 'keywords', true);
		// 仅对 单篇文章页( single ) 处理
		if( is_single() ){
			//获得分类名称 作为关键字
			$cats = get_the_category();
			if($cats){
				foreach( $cats as $cat ){
					$keywords[] = $cat->name;
				}
			}
			//获取Tags 将Tags 作为关键字
			$tags = get_the_tags();
			if($tags){
				foreach( $tags as $tag ){
					$keywords[] = $tag->name;
				}
			}
		}
		// 格式化处理 $keywords
		if(count($keywords) > 1){
			array_shift($keywords);
		}
		$keywords = array_filter($keywords);
		$keywords = join(',', $keywords);
		// 对 description 的处理
		if(!empty($post->post_password)){ // 受保护的文章
			$keywords = '';
			$description = __('Protected post.Enter your password to view',YHL);
		}else{
			//获取自定义域内容
			 $description = mb_strimwidth(strip_tags($post->post_content),0,220);
			 if( empty($description) ){
				 $description = get_post_meta($post->ID, 'description', true);
			 }
			//自定义域为空 试试Excerpt
			if( empty($description) ){
				$description = get_the_excerpt();
			}
			//依然为空 则截取文章的前210个字符作为描述
			if( empty($description) ){
				$description = WinyskyStriptags($post->post_content);
				$description = WinyskySubstr($description, 260);
			}
		}
	}elseif(is_category()){ // 分类页
		$keywords = single_cat_title('', false);
		$description = WinyskyStriptags(category_description());
	}elseif(is_author()){ // 作者页
		$meta_auth = get_userdata(get_query_var('author'));
		$keywords = $meta_auth->display_name;
		$description = str_replace(array('"'), '&quot;', $meta_auth->description);
		$description = WinyskyStriptags($description);
	}elseif(is_tag()){ // 标签页
		$keywords = single_cat_title('', false);
		$description = tag_description();
		$description = WinyskyStriptags($description);
	}elseif(is_month()){ // 月份存档页
		$description = single_month_title(' ', false);
	}
	if( !empty($keywords) ){
		echo '<meta name="keywords" content="',trim($keywords),'" />',"\n";
	}
	if( !empty($description) ){
		echo '<meta name="description" content="',trim($description),'" />',"\n";
	}
	$currentTheme = get_current_theme();
	$theme = $themes[$currentTheme]['Title'];
	$version = $themes[$currentTheme]['Version'];
	$themeAuthor = WinyskyStriptags($themes[$currentTheme]['Author']);
	unset($keywords,$description,$currentTheme,$themes,$theme,$version,$themeAuthor);
	//hook
 	do_action('after_keywords_desc');
}
add_action('wp_head', 'iSaymeKeywordsAndDescription',1);
