<?php
/**
 * comment_mail_notify
 * http://kan.willin.org
 */
/* comment_mail_notify v1.0 by willin kan. (有勾選欄, 由訪客決定) */
function comment_mail_notify($comment_id) {
  $admin_notify = '0'; // admin 要不要收回覆通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;    
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    //$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
    $wp_email ='isayme.com@gmail.com';
	$to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 上的留言被 ' . trim($comment->comment_author) . ' 回复';
    $message = '
	<p>Hello,' . trim(get_comment($parent_id)->comment_author) . '.<br/>
	您在 "<strong>' . get_the_title($comment->comment_post_ID) . '</strong>" 上的留言被 <strong>' . trim($comment->comment_author) . ' </strong>回复<br/>
	<div style="margin:5px;padding:5px;border:1px solid #eee;background-color:#f8f8f8;color:#aaa;">您的留言:<br />'. trim(get_comment($parent_id)->comment_content) . '<br /></div>
	<div style="margin-left:5px;margin-right:5px;padding:5px;border:1px solid #ccc;background-color:#f2f2f2;color:#333;">回复内容:<br />'. trim($comment->comment_content) . '</div>
	<div style="margin-top:10px;padding-bottom:10px;border-bottom:1px solid #ccc;">
	<a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看完整内容</a> 或者 <a href="mailto:lwent90@gmail.com">给管理员发E-mail</a> </div>
	<div style="font-style:italic;margin-top:5px;">[您可以直接回复本邮件联系我！]</div>
	<p><a href="' . get_option('home') . '">访问' . get_option('blogname') . '</a>. <a href="http://isayme.com/feed">订阅' . get_option('blogname') . '</a>.<br/>
    </div>';
$message = convert_smilies($message);
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

/* 自動加勾選欄 */
function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="margin-left:20px;" /><label for="comment_mail_notify">有人回复时通知我</label>';
}
add_action('comment_form', 'add_checkbox');
// -- END ----------------------------------------
