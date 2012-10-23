<?php get_header(); ?>
  <div id="main">
<div id="single">
<div id="single_area"></div>
<div class="showdow_bl">
<div class="showdow_br"><div class="showdow_b"></div></div></div>
<div class="entry">
<div id="post-title-page" style="padding:10px;">
<h1><span><?php _e('Search Results'); ?></span></h1>
</div>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" class="post">
	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="查看文章: <?php the_title_attribute(); ?>"><?php winyexcerpt(40, '...', 'title'); ?></a></h3>
	<div class="postmeta">
		<span class="alignleft">分类：<?php the_category(',') ?>&nbsp;|&nbsp;点击：<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;|&nbsp;<?php comments_popup_link('来抢沙发', '1  条评论', '%  条评论'); ?><?php edit_post_link(__('编辑'), ' | ', ''); ?></span><span class="alignright">-<?php the_time(' m月 d日,Y'); ?></span>
	</div>
<div class="postentry">
<?php winyexcerpt(300); ?>
</div>
<div class="postimg">
<?php winypostimg();?>
</div>
<div class="clear"></div>
</div>
<?php endwhile; ?>
<div id="pagenavi"><?php pagenavi(); ?></div>
<?php else: ?>
		<div class="post"><div class="postentry"><p>没有找到文章</p>		
		</div></div>
		<?php endif; ?>
</div>
</div>
<?php get_footer(); ?> 