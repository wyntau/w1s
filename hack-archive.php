<?php
/**
 * Template Name: 归档(archive)
 */
get_header();
?>
<?php
/*author:荒野无灯
*URL: http://www.ihacklog.com
*文章存档页面模板
*使用方法：添加页面，选取本模板，内容设置为：

usejs=1; 
monthorder=old;
postorder=old;
postcount=1;
commentcount=1;
*/


	class hacklog_archives
{
	// Grab all posts and filter them into an array
	function GetPosts() 
	{
		global  $wpdb;	
		// If we have a cached copy of the filtered posts array, use that instead
		if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
			return $posts;
		// 取得文章ID等
		$query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
		$rawposts =$wpdb->get_results( $query, OBJECT );
		// Loop through each post and sort it into a structured array
		foreach( $rawposts as $key => $post ) {
			$posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;
			$rawposts[$key] = null; // Try and free up memory for users with lots of posts and poor server configs
		}
		$rawposts = null; // More memory cleanup
		// Store the results into the WordPress cache
		wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;
		return $posts;
	}
	// Generates the HTML output based on $atts array from the shortcode
	function PostList( $atts = array() ) 
	{
		global $wp_locale;
		global $hacklog_clean_archives_config;
		// Set any missing $atts items to the defaults
		$atts = shortcode_atts(array(
			'usejs'        => $hacklog_clean_archives_config['usejs'],
			'monthorder'   => $hacklog_clean_archives_config['monthorder'],
			'postorder'    => $hacklog_clean_archives_config['postorder'],
			'postcount'    => '1',
			'commentcount' => '1',
		), $atts);
		$atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);
		// Get the big array of all posts
		$posts = $this->GetPosts();
		// Sort the months based on $atts
		( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
		// Sort the posts within each month based on $atts
		foreach( $posts as $key => $month ) {
			$sorter = array();
			foreach ( $month as $post )
				$sorter[] = $post->post_date_gmt;
			$sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
			array_multisort( $sorter, $sortorder, $month );
			$posts[$key] = $month;
			unset($month);
		}
		// Generate the HTML
		$html = '<div class="car-container';
		if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
		$html .= '">'. "\n";
		if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">展开所有月份'."</a>\n\n";
		$html .= '<ul class="car-list">' . "\n";
		$firstmonth = TRUE;
		foreach( $posts as $yearmonth => $posts ) {
			list( $year, $month ) = explode( '.', $yearmonth );
			$firstpost = TRUE;
			foreach( $posts as $post ) {
				if ( TRUE == $firstpost ) {
					$html .= '	<li><span class="car-yearmonth">' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
					if ( '0' != $atts['postcount'] ) 
					{
						$html .= ' <span title="文章数量">(共' . count($posts) . '篇文章)</span>';
					}
					$html .= "</span>\n		<ul class='car-monthlisting'>\n";
					$firstpost = FALSE;
				}
				$html .= '			<li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
				// Unless comments are closed and there are no comments, show the comment count
				if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
					$html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
				$html .= "</li>\n";
			}
			$html .= "		</ul>\n	</li>\n";
		}
		$html .= "</ul>\n</div>\n";
		return $html;
	}
	// Returns the total number of posts
	function PostCount() 
	{
		$num_posts = wp_count_posts( 'post' );
		return number_format_i18n( $num_posts->publish );
	}
} //end  class hacklog_archives
if(!empty($post->post_content))
{
	$all_config=explode(';',$post->post_content);
	foreach($all_config as $item)
	{
		$temp=explode('=',$item);
		$hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
	}
}
else
{
	$hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new');	
}
$hacklog_archives=new hacklog_archives();
?>
  <div id="main">
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
	<div class="single-entry" style="padding-left:30px;">
<p class="date"style="margin-left:-40px;"><strong><?php bloginfo('name'); ?></strong>目前共有文章：  <?php echo $hacklog_archives->PostCount();?>篇	</p>
	<!-- Hacklog Clean Archives By 荒野无灯 @ www.ihacklog.com -->
	<?php echo $hacklog_archives->PostList();?>
	<br>
		<?php the_content(); ?>	
		<?php wp_link_pages('before='.__('Continue').__('Reading').'... &after=&pagelink=[ % ]'); ?>
<div class="clear"></div>
	</div>
</div>
</div>
<?php comments_template('', true); ?>
<?php
function callback($buffer)
{
  $append_js=<<<EOT
	<script type="text/javascript">
		/* <![CDATA[ */
			jQuery(document).ready(function() {
				jQuery('.car-collapse').find('.car-monthlisting').hide();
				jQuery('.car-collapse').find('.car-monthlisting:first').show();
				jQuery('.car-collapse').find('.car-yearmonth').click(function() {
					jQuery(this).next('ul').slideToggle('fast');
				});
				jQuery('.car-collapse').find('.car-toggler').click(function() {
					if ( '展开所有月份' == jQuery(this).text() ) {
						jQuery(this).parent('.car-container').find('.car-monthlisting').show();
						jQuery(this).text('折叠所有月份');
					}
					else {
						jQuery(this).parent('.car-container').find('.car-monthlisting').hide();
						jQuery(this).text('展开所有月份');
					}
					return false;
				});
			});
		/* ]]> */
	</script>
EOT;
//$buffer=ob_get_contents();
$buffer=str_replace('</body>',$append_js.'</body>',$buffer);
  return $buffer;
}
ob_start("callback");
get_footer();
ob_end_flush();
?>
<?php get_footer(); ?>  
