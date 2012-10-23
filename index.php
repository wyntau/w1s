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
	<div class="single-entry">
		<?php the_content(); ?>
		<?php wp_link_pages('before='.__('Continue').__('Reading').'... &after=&pagelink=[ % ]'); ?>
	<div class="postmetadata">
		<?php if (is_sticky()) { ?><span class="sticky"> ※ <?php _e('Sticky'); ?>　</span><?php } ?>
		<span><?php the_time('Y年m月d日'); ?>
<?php $u_time = get_the_time('U');$u_modified_time = get_the_modified_time('U');if ($u_modified_time != $u_time) {echo "最后修订在 ";the_modified_time('F jS, Y');echo ". "; } ?>
		</span><span>标签: <?php the_tags('', ',', ' '); ?></span><span>分类: <?php the_category(',') ?></span><span><?php edit_post_link(__('编辑文章>'),'',''); ?></span>
	</div>
	</div>
<div id="postnav">
<div class="alignleft"><?php previous_post_link('&laquo; '.__('Previous Post').' : %link'); ?></div>
<div class="alignright"><?php next_post_link('%link : '.__('Next Post').' &raquo;'); ?></div>
<div class="clear"></div>
</div>
</div>
</div>
<?php comments_template('', true); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?> 