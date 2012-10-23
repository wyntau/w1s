<div id="content-post" >
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php //if (in_array($post->ID, $do_not_duplicate)) continue;update_post_caches($posts); ?>
<div id="post-<?php the_ID(); ?>" class="post">
	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="查看文章: <?php the_title_attribute(); ?>"><?php winyexcerpt(70, '...', 'title'); ?></a></h3>
	<div class="postmeta">
		<span class="alignleft">〖<?php the_category(',') ?>〗&nbsp;<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;〖<?php comments_popup_link('来抢沙发', '1  条评论', '%  条评论'); ?>〗<?php edit_post_link(__('编辑'), '', ''); ?></span><span class="alignright">-<?php time_diff( $time_type = 'post' ); ?></span>
	</div>
<div class="postentry">
<?php the_excerpt(300); ?>
</div>
<div class="postimg">
<?php winypostimg();?>
</div>
<div class="clear"></div>
</div>
<?php endwhile; else: ?>
	<?php header("HTTP/1.1 404 Method Not Allowed");
header("Content-type: text/plain");
exit;?>
<?php endif; ?>
</div>
<div id="pagenavi"><?php pagenavi();  ?></div>
