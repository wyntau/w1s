<?php
/**
 * Template Name: 留言|读者墙(message)
 *
 */
get_header();
?>
  <div id="main">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="single">
<div id="single_area"></div>
<div class="showdow_bl">
<div class="showdow_br"><div class="showdow_b"></div></div></div>
<div class="entry" >
<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
	<div class="single-entry">
<div align="center"><h2>在此留言就可以上墙哦</h2></div><br>
<div align="center"><b>信春哥.原地满血,爆极品神器.</b>想要满血吗?赶紧来说几句吧!</div>
	<!-- start 读者墙 -->
<?php
    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'admin@yourdomain.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 42";//最后的这个40是选取多少个头像，我一次让它显示40个。
    $wall = $wpdb->get_results($query);
    $maxNum = $wall[0]->cnt;
    foreach ($wall as $comment) 
    {
        $width = round(40 / ($maxNum / $comment->cnt),2);//这个40是我设置头像的宽度，和下面&size=40里的40一个概念，如果你头像宽度32，这里就是32了。
        if( $comment->comment_author_url ) 
        $url = $comment->comment_author_url;
        else $url="#";
        $tmp = "<li title='".$comment->comment_author." (".$comment->cnt."次重要讲话)'><a href='".$comment->comment_author_url."' target='_blank'>".my_avatar($comment->comment_author_email, 80)."</a><div class='active-bg'><div class='active-degree' style='width:".$width."px'></div></li>";
        $output .= $tmp; 
     }
    $output = "<div id='readerswall'><ul class='gavaimg'>".$output."</ul></div>";
    echo $output ;
?>
<!-- end 读者墙 -->
		<?php the_content(); ?>
	</div>
</div>
</div>
<?php comments_template('', true); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>  
