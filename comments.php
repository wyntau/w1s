<?php
/**
 * comments
 */
 // no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');
?>
	
<?php if ( post_password_required() ) : ?>
				<div id="comments">	<p class="nopassword"><?php _e( '私人文章，输入密码查看留言'  ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>


<!--comment satae-->

<div id="comments" >
<div id="comment_header">
<ul id="comment_header_left">
<li id="add_comment"><a href="#respond">写评论</a></li>
<li id="comment_feed"><?php post_comments_feed_link( __('订阅这里的评论') ); ?></li>
</ul>
<ul id="comment_header_right">
<li id="trackback_switch"><a href="javascript:void(0);">引用( <?php echo count($GLOBALS['trackbacks']); ?> )</a></li>
<li id="comment_switch" class="comment_switch_active"><a href="javascript:void(0);"> <span id="number"><?php
$my_email = get_bloginfo ( 'admin_email' );
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID 
AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;
$count_v = $wpdb->get_var("$str != '$my_email'");
$count_h = $wpdb->get_var("$str = '$my_email'");
echo $count_t, " 篇回应 (访客:", $count_v, " 篇, 博主:", $count_h, " 篇)";
?> </span></a></li>
</ul>
<div class="clear"></div>
</div>
<div id="comment_area" >
<!--list comment-->

<?php if( have_comments() ):?>

<ol id="thecomments" class="commentlist">

<?php wp_list_comments('callback=WinyskyComments&max_depth=10000');?>
</ol>

<?php else:?>
<ol id="thecomments" class="commentlist">
	<li class="comment">
		<div class="comment-content"><p>目前还没有评论</p></div>
	</li>
</ol>
<?php endif; ?>

<!--comments pages-->
<?php
if (get_option('page_comments')){
		// 获取评论分页的 HTML
		$comment_pages = paginate_comments_links('echo=0');
		// 如果评论分页的 HTML 不为空, 显示上一页和下一页的链接
		if ($comment_pages) {
?>
<span id="cp_post_id" style="display:none"><?php echo $post->ID; ?></span>

<div id="comment_pager" >
		<?php echo $comment_pages; ?>
</div>
<?php
	
		}
	}

?>

</div>
<div id="trackback_area" style="display: none;">
<!--list trackbacks-->
<ol id="pinglist" class="commentlist">
<?php
if( !empty($GLOBALS['trackbacks']) ):
	foreach ($GLOBALS['trackbacks'] as $comment){
		WinyskyPings($comment);
	}
else:
?>
	<li class=" comment">
		<div class="comment-content"><p><?php _e('目前还没有trackbacks.'); ?></p></div>
	</li>
<?php
endif;
if(!pings_open()):
?>
	<li class=" comment">
		<div class="comment-content"><p><?php _e('Trackbacks被禁用了'); ?></p></div>
	</li>
<?php endif; ?>
</ol>
</div>


<?php if(comments_open()):?>


	<div id="respond" >
	<h3 style="display:none;"><?php comment_form_title(__('Leave a Reply'), __('Leave a Reply to %s')); ?></h3>
<div id="cancel-comment-reply">
	<?php cancel_comment_reply_link(); ?>
</div>

		<form id="commentform" action="<?php bloginfo('url'); ?>/wp-comments-post.php" method="post">
				<?php if($user_ID) : ?>
		
				<div id="comment_login">
				
				<p><?php _e('欢迎回来 !');?></p><p><?php _e('以管理员ID：'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><strong><?php echo $user_identity; ?></strong></a><?php _e(' 登录'); ?> .
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('退出 &raquo;'); ?></a></p>
				</div>
				
			<?php else: ?>
		<?php if(isset($_COOKIE['comment_author_email_'.COOKIEHASH]) && isset($_COOKIE['comment_author_'.COOKIEHASH]))  : ?>
		<div id="commentwelcome">
		<?php printf(__('嘿! <strong>%1s</strong>, 欢迎回来! 评论指导否？'), $comment_author); ?><a id="edit_profile" title="重新填写资料" href="javascript:void(0);"><?php _e(' (编辑信息?)'); ?></a>
					</div>
			<?php endif; ?>


		<div id="guest_info" class="<?php echo $comment_author_email ? 'hidden' : 'profile'; ?>">
		<div id="guest_name">
			<label for="author"><span>昵称:</span><?php if ($req) _e('(required)'); ?></label>
			<input type="text" name="author" id="author" class="textfield" value="<?php echo $comment_author; ?>" size="22" tabindex="1"/>
		</div>
		<div id="guest_email">
			<label for="email"><span>邮箱：</span><?php if ($req) _e('(required)'); ?>-<a id="Get_Gravatar"  title="Get Gravatar" href="http://en.gravatar.com/" rel="external">（设置Gravatar头像）</a></label>
			<input type="text" name="email" id="email" class="textfield" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2"/>
		</div>
		<div id="guest_url">
			<label for="url"><span>网站或博客：</span></label>
			<input type="text" name="url"  id="url" class="textfield" value="<?php echo $comment_author_url;  ?>" size="22" tabindex="3"/>
			</div>
	</div>
	<?php endif; ?>
	
<?php include(TEMPLATEPATH . '/smiley.php'); ?>
		<div id="comment_textarea" >
			<textarea id="comment" class="textfield" rows="10" cols="50" name="comment"  tabindex="4" title="支持Ctrl+Enter提交" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit_comment').click();return false};"></textarea>
	</div>	
<div id="submit_comment_wrapper">
<input name="submit" type="submit" id="submit_comment"  tabindex="5" value="写好了 " />
<?php comment_id_fields(); ?>

</div>
<p><?php do_action('comment_form', $post->ID); ?></p>
</form>
</div>
</div>



<?php else: ?>

	<?php _e('评论关闭了.'); ?></div>

<?php endif; ?>
