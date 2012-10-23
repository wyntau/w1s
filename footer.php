<?php 
 // no direct access
defined('WINYSKY') or die('Restricted access -- WINYSKY ');
?>
<div id="footer">
	<p>
	Copyright &copy; <?php echo date('Y'),' '; bloginfo('name'); ?><sup>&reg;</sup>&nbsp;&nbsp;骄傲的使用<a href="http://wordpress.org/" title="WordPress.org"> WordPress</a> 
	<strong style="color:#a61">W1</strong> Theme by <a href="http://winysky.com/" title="W1 designer">Winy</a>&nbsp;Modified by <a href="http://ISayMe.com/" title="集成功能扩展">自说Me话 </a>&nbsp;<br/><strong style="color:#496">Valid</strong> <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.1">XHTML 1.1</a>
		&amp; <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="This page validates as CSS 3.0">CSS 3.0</a>&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:#57d">Optimized</strong> loading <?php echo get_num_queries(); ?> queries, <?php timer_stop(1); ?> seconds. 
<?php
if ( function_exists('wp_gzip') ) { ?><strong style="color:#94a">Gzipped</strong><?php } // 啟用 gzip 才出現
?>&nbsp;&nbsp;
<?php if ( is_user_logged_in() ) : ?><a href="<?php bloginfo('url'); ?>/wp-admin/" title="wp-admin">后台</a> &nbsp;|&nbsp;<?php wp_loginout() ?>
<?php else : ?><?php wp_loginout() ?><?php endif; ?>&nbsp;|&nbsp;<a id="gotop" href="#wrap" title="返回顶部">返回顶部</a>
	</p>
</div>
</div>
</div>
</div>
<div id="shangxia"><div id="shang"></div>
<?php if (is_single()): ?><div id="comt"></div><?php endif; ?><div id="xia"></div></div>
<?php wp_footer(); ?>
<!--[if IE 6]>
	<script src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
<![endif]-->
</body>
</html>
