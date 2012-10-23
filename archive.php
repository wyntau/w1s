<?php get_header(); ?>
  <div id="main">
<div id="single">
<div id="single_area"></div>
<div class="showdow_bl">
<div class="showdow_br"><div class="showdow_b"></div></div></div>
<div id="qkblock" class="entry">
<div style="padding:10px;">
<?php /* If this is a category */ if (is_category()) { ?>
<h2 class="query-info">以下內容属于 &#8216;<?php single_cat_title(); ?>&#8217; 分类：</h2>
<?php /* If this is a tag */ } elseif( is_tag() ) { ?>
<h2 class="query-info">以下內容属于 &#8216;<?php single_tag_title(); ?>&#8217; 标签：</h2>
<?php /* If this is a daily */ } elseif (is_day()) { ?>
<h2 class="query-info">以下內容是 <?php the_time('Y年 F j日'); ?> 的归档：</h2>
<?php /* If this is a monthly */ } elseif (is_month()) { ?>
<h2 class="query-info">以下內容是 <?php the_time('Y年 F'); ?> 的归档：</h2>
<?php /* If this is a yearly */ } elseif (is_year()) { ?>
<h2 class="query-info">以下內容是 <?php the_time('Y年'); ?> 的归档：</h2>
<?php /* If this is a paged */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h4 class="query-info">您正在浏览的是以前的文章</h4>
<?php } ?>
</div>
<ul>
<?php $posts = query_posts($query_string . '&orderby=date&showposts=30'); ?>
<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
	<li class="qk-list"><a href="<?php the_permalink() ?>" rel="bookmark">《 <?php winyexcerpt(40, '...', 'title'); ?> 》<span><?php the_time('Y-m-d'); ?>&nbsp;|&nbsp;<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;|&nbsp;<?php comments_number('0','1','%'); ?>条评论</span></a></li>			
		<?php endwhile; else: ?>
		    <li><h2>好像出了一点小状况</h2></li>
			<li><p>您所访问的这个页面好像不存在了或者还没有这个页面，你可以搜索看看，或者去其他页面看看。</p></li>
		<?php endif; ?>
</ul>
<div id="pagenavi"><?php pagenavi(); ?></div>
</div>
</div>
<?php get_footer(); ?>  