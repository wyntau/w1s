<?php get_header(); ?>
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
		<?php the_content(); ?>
		<?php wp_link_pages('before='.__('Continue').__('Reading').'... &after=&pagelink=[ % ]'); ?>
	</div>
</div>
</div>
<?php comments_template('', true); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>  