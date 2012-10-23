<?php
// no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!-- W1s design by Winy ( http://winyskycom/ ) Modified by 自说Me话(http://ISayMe.com) -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="zh">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.png"  type="image/x-ico"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/ie6.css" />
<![endif]--> 
<!-- PNG -->
<!--[if lt IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.boxCaption,.top_box,.logo');
</script>
<![endif]-->
<?php if($_COOKIE["comment_author_" . COOKIEHASH]!="") { ?>
    <script type="text/javascript">document.title = "<?php echo $_COOKIE["comment_author_" . COOKIEHASH].'，欢迎归来~'; ?>" + document.title</script>
<?php } ?>
<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
		<div id="wrapper">
			<div id="container"<?php if(!is_bot()){ echo ' style="opacity:0;"';}?>>			
				<div id="header" >
				   <div id="logo">
				   <?php $hhead = is_home() ? 'h1' : 'div'; ?><<?php echo $hhead; ?> id="site-title"><a rel="bloghome" href="<?php echo get_option('home'); ?>/" title="Home"><?php bloginfo('name') ?></a></<?php echo $hhead; ?>><div id="description"><?php bloginfo('description') ?></div>
					</div>
					<div id="headbar">
						<div id="box_corner"></div>
						<div id="box_content">
						<?php if(!is_bot()) :?>
						<?php welcome_msg();?>
						<?php endif;?>
						</div>
					</div>
					<div id="menu">
							<ul id="navmenu">
								<li class="home <?php echo (is_home() || is_single()) ? 'current_page_item' : 'page_item'; ?>"><a href="<?php echo get_option('Home'); ?>/" title="首页">首页</a></li>
				<?php wp_list_pages('depth=1&title_li=0&sort_column=menu_order'); ?>
							</ul> 
							<div id="search">
				   <?php include (TEMPLATEPATH . "/searchform.php"); ?>
				   </div>
					</div> <!-- end of  menu -->
				   <div id="rss">
				   <a id="feed" href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="订阅小站">RSS Feed</a>
				   </div>
      			<div class="clear"></div>
				</div> <!-- end of header -->
