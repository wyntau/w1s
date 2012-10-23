<?php
/**
 * Template Name: 链接页面 (links)
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
	<div class="postmetadata">
			发布于 <?php the_time('F jS, Y') ?>		
		<?php comments_popup_link('(0)','(1)','(%)'); ?>Comments　
		<?php edit_post_link('('.__('Edit').')'); ?>
	</div>
	<div class="single-entry">
	<div class="linkpage">
				<ul>
					<?php my_list_bookmarks('title_li=&categorize=1&orderby=rand&title_before=<h3 style="background:#cccccc;font-size:14px;padding:5px;">&title_after=</h3>&category_before=<li>&category_after=</li>'); ?>
				</ul>
			</div>
			<div class="clear"></div>
		<?php the_content(); ?>
		<?php wp_link_pages('before='.__('Continue').__('Reading').'... &after=&pagelink=[ % ]'); ?>
	</div>
</div>
</div>
<?php comments_template('', true); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>  
