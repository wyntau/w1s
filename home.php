<?php
/**
 * The main template file.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * 这是index
 *
 *
 *          ::.--.-.::
 *          :( (    ):::::  东边日出西边雨 
 *          (_,  \ ) ,_)::  道是无晴却有情       |
 *          :::-'--`--:::::::: ~~|     ,       \ _ /
 *          ::::::::::::::::::: ,|`-._/|   -==  (_)  ==-
 *          ::::::::^^::::::::.' |   /||\      /   \
 *          ::::::^^::::::::.'   | ./ ||`\       |
 *          :::::::::::::::/ `-. |/._ ||  \
 *          ::::::::::::::|      ||   ||   \
 *          ~~=~_~^~ =~ \~~~~~~~'~~~~'~~~~/~~`` ~=~^~
 *          ~^^~~-=~^~ ^ `--------------'~^~=~^~_~^=~^~
 *
 * @author winy <admin@winysky.com>
 * @link http://winysky.com/
 */
?>
<?php get_header(); ?>
  <div id="main">
        <div id="top">
		<div class="main_view">
    <div class="window">
              <ul class="image_reel">
  <?php $new_query = new WP_Query('showposts=3');while ($new_query->have_posts()) : $new_query->the_post();$do_not_duplicate[] = $post->ID;?>
    	<li class="slider_content">	
	<h2><a href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php winyexcerpt(70, '...', 'title'); ?></a></h2>
	<div class="postinfo">
		〖<?php time_diff( $time_type = 'post' ); ?>〗〖<?php the_category(',') ?>〗&nbsp;<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;〖<?php comments_popup_link('来抢沙发', '1  条评论', '%  条评论'); ?>〗<?php edit_post_link(__('编辑'), '', ''); ?>
	</div>
	<div class="sliderimg">
<?php winypostimg($imagestype='slider');?>
</div>
	<?php winyexcerpt(430); ?>
  </li> 
  <?php endwhile; ?>
   <?php $new_query = new WP_Query('showposts=1&orderby=rand&post_not_in=array($do_not_duplicate)');while ($new_query->have_posts()) : $new_query->the_post();$do_not_duplicate[] = $post->ID;?>
   	<li class="slider_content">
	<h2><a href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php winyexcerpt(45, '...', 'title'); ?></a></h2>
	<div class="postinfo">
		〖<?php time_diff( $time_type = 'post' ); ?>〗〖<?php the_category(',') ?>〗&nbsp;<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;〖<?php comments_popup_link('来抢沙发', '1  条评论', '%  条评论'); ?>〗<?php edit_post_link(__('编辑'), '', ''); ?>
	</div>
	<div class="sliderimg">
<?php winypostimg($imagestype='slider');?>
</div>
	<?php winyexcerpt(430); ?>
  </li> 
  <?php endwhile; wp_reset_query();?>
  </ul> 
    </div>
    <div class="paging">
        <a href="javascript:void(0);" title="1">1</a>
        <a href="javascript:void(0);" title="2">2</a>
        <a href="javascript:void(0);" title="3">3</a>
        <a href="javascript:void(0);" title="4">4</a>
    </div>
</div>
<div class="clear"></div>        
<div class="showdow_bl">
<div class="showdow_br"><div class="showdow_b"></div></div></div>
</div>
<div id="quick" >
	<ul>
	<?php wp_list_categories('orderby=name&title_li=&style=list'); ?></ul>	
	<div class="clear"></div>
</div> 
<div id="middle">
<div id="content-post" > 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (in_array($post->ID, $do_not_duplicate)) continue;update_post_caches($posts); ?>
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
<div id="pagenavi"><?php pagenavi();  ?></div></div>
<?php get_footer(); ?>  