


		<?php wp_footer(); ?>
		<div id="footer">&copy; Suzie Blackman 2008&ndash;<? echo  date("Y");?> <span class="printhide"> | <a href="<?
	
			 bloginfo('rss2_url'); ?>">RSS</a>
		
		| <a href="/index.php/about/contact/">Contact</a>
		| <a href="/index.php/about/terms-of-use/">Terms of use</a></span></div>


<? if( !(is_tax( 'product_category' ) || is_singular('product') || is_post_type_archive( 'product' )) ){ ?>  <div id="basket"> <span><img src="<?php bloginfo('template_directory'); ?>/images/silk-basket.png" /></span> <a href="#" onclick="R.cart.show(1392); return false;"> PDF Patterns</a> </div><? }?>



</body>
</html>
