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
<div id="single-bottom">
    <div id="share" style="float: left;">赶快分享到:
<a id="facebook-share" title="Facebook" rel="nofollow">Facebook</a>
<a id="twitter-share" title="Twitter" rel="nofollow">Twitter</a>
<a id="delicious-share" title="Delicious" rel="nofollow">Delicious</a>
<a id="kaixin001-share" title="开心网" rel="nofollow">开心网</a>
<a id="renren-share" title="人人网" rel="nofollow">人人网</a>
<a id="douban-share" title="豆瓣" rel="nofollow">豆瓣</a>
<a id="sina-share" title="新浪微博" rel="nofollow">新浪微博</a>
<a id="netease-share" title="网易微博" rel="nofollow">网易微博</a>
<a id="tencent-share" title="腾讯微博" rel="nofollow">腾讯微博</a>
    </div>
    <div id="single-rss"style="float:right;">订阅博文:
<a class="rss-feed" title="订阅博客文章" rel="nofollow external" href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a>
     </div>
</div>
<div id="wumiiDisplayDiv" style="margin:0 auto;"></div>
		<?php wp_link_pages('before='.__('Continue').__('Reading').'... &after=&pagelink=[ % ]'); ?>
	<div class="postmetadata">
		<?php if (is_sticky()) { ?><span class="sticky"> ※ <?php _e('Sticky'); ?>　</span><?php } ?>
		<span><?php the_time('Y年m月d日'); ?>
		</span><span>标签: <?php the_tags('', ',', ' '); ?></span><span>分类: <?php the_category(',') ?></span><span><?php edit_post_link(__('编辑文章>'),'',''); ?></span>
	</div>
	</div>
<div id="center" >
<div style="float:right; width:50%">
<h3>热门文章</h3>
<ul>
<?php
$post_num = 5; // 數量設定.
$exclude_id = $post->ID;
$myposts = $wpdb->get_results("
  SELECT ID, post_title FROM $wpdb->posts
  WHERE ID != $exclude_id
  AND post_status = 'publish'
  AND post_type = 'post'
  ORDER BY comment_count
  DESC LIMIT $post_num
"); // get_results() since 0.71 /wp-includes/wp-db.php 
  foreach($myposts as $mypost) {
    echo '<li><a href="', get_permalink($mypost->ID), '">', $mypost->post_title, '</a></li>';
  $exclude_id .= ',' . $post->ID; // 記錄文章 ID, 讓 Related Posts 不重覆.(單獨使用可刪此行)
  }
?>
</ul>
</div>
<div style="float:right; width:45%">
<h3>相关文章</h3>
<ul>
<?php
$post_num = 5; // 數量設定.
//$exclude_id = $post->ID; // 單獨使用要開此行
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
$args = array(
	'post_status' => 'publish',
	'tag_slug__in' => explode(',', $tags), // 只選 tags 的文章.
	'post__not_in' => explode(',', $exclude_id), // 排除已出現過的文章.
	'caller_get_posts' => 1,
	'orderby' => 'comment_date', // 依評論日期排序.
	'posts_per_page' => $post_num
);
query_posts($args);
 while( have_posts() ) { the_post(); ?>
    <li> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
    $exclude_id .= ',' . $post->ID; $i ++;
 } wp_reset_query();
}
if ( $i < $post_num ) { // 當 tags 文章數量不足, 再取 category 補足.
$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
$args = array(
	'category__in' => explode(',', $cats), // 只選 category 的文章.
	'post__not_in' => explode(',', $exclude_id),
	'caller_get_posts' => 1,
	'orderby' => 'comment_date',
	'posts_per_page' => $post_num - $i
);
query_posts($args);
 while( have_posts() ) { the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
    $i ++;
 } wp_reset_query();
}
if ( $i  == 0 )  echo '<li>尚无相关文章</li>';
?>
</ul>
</div>
<div class="clear"></div>
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
