<?php
/**
 * basic function 
 */
 // no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');
function WinyskyComments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	//主评论计数器初始化 begin - by zwwooooo
	global $commentcount;	
	if(!$commentcount) { //初始化楼层计数器
	$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );//zww
	$cpp=get_option('comments_per_page');//获取每页评论显示数量
		if ($page > 1) {
		$commentcount = $cpp * ($page - 1);
		} else {
		$commentcount = 0;//如果评论还没有分页，初始值为0
		}
	}
	//主评论计数器初始化 end - by zwwooooo	
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php if($depth<5) echo ' style="margin-left: ' . ceil(10/sqrt($depth)) . 'px; "'; ?>>
	<?php  //用于判断该留言的ID是否为管理员的留言
if($comment->user_id >0){
$admin_comment = '<span style="color:#ED539F">博主</span>';
}else{$admin_comment = '童鞋';}?>
		<div id="comment-<?php comment_ID() ?>">
		<div class="comment-author vcard"><span class="floor"><?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);}elseif( $depth > 1&& $depth < 8){printf('B%1$s', $depth-1);}else{ printf('^深渊^');} ?></span>
			<?php printf(__('<cite class="fn">%s</cite><span class="says">%s</span>'), get_comment_author_link(), $admin_comment)         
           ?>
		</div><!-- .comment-author .vcard -->	
		<div class="comment-meta commentmetadata">
		<?php time_diff( $time_type = 'comment' ); ?><?php edit_comment_link( __( '(编辑)' ), ' ' );?>			
			<?php if ( $depth == 8) : ?>
     <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' )" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
	      <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' )" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-quote" rel="nofollow">引用</a>
 <?php else: ?>
     	 <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php comment_ID() ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) " href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
	 <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php comment_ID() ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) " href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-quote" rel="nofollow">引用</a>
 <?php endif; ?>		
		</div>
		<?php $size = ceil(40/sqrt($depth)); echo my_avatar( $comment->comment_author_email, $size );?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( '评论等待审核' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-body"><?php comment_text(); ?></div>
		</div>
<?php	
}
/**
 * list pings
 *
 * @param unknown_type $comment
 * @param unknown_type $args
 * @param unknown_type $depth
 * @return unknown_type
 */
function WinyskyPings($comment, $args = array(), $depth = 1){
	global $user_ID;
	static $index = 1;
	$GLOBALS['comment'] = $comment;
?>
<li class="comment">
	<div class="trackback_time"><?php comment_time(__('M jS, Y @ H:i' )); echo ' | #', $index; ?></div>
	<div class="trackback_title"><a href="<?php comment_author_url() ?>"><?php comment_author(); ?></a>:<?php comment_type( __('Comment: ' ), __('Trackback: ' ), __('Pingback: ' ) ); ?></div>	
</li>
<?php
	$index++;
}
/**
 * Separates comments from trackbacks
 * @since 3.0.0  function copy from philna2
 * @global array $trackbacks Array of trackbacks/pings of current post
 * @param array $comments Array of comments/trackbacks/pings of current post
 * @return array Comments only
 */
function WinyskySeperateComments( $comments ) {
	global $trackbacks;

	$comments_only = array_filter( $comments, 'WinyskyStripTrackback' );
	$trackbacks = array_filter( $comments, 'WinyskyStripComment' );
	return $comments_only;
}
add_filter('comments_array', 'WinyskySeperateComments');
/**
 * Strips out trackbacks/pingbacks
 * the help function of Separates comments
 * @since 3.0.0
 * @param object $var current comment
 * @return boolean true if comment
 */
function WinyskyStripTrackback($var) {
	return ($var->comment_type != 'trackback' and $var->comment_type != 'pingback');
}
/**
 * Strips out comments
 * the help function of Separates comments
 * @since 3.0.0
 * @param object $var current comment
 * @return boolean true if trackback/pingback
 */
function WinyskyStripComment($var) {
	return ($var->comment_type == 'trackback' or $var->comment_type == 'pingback');
}