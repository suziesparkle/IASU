	<div id="rightcolumn">
		
		
		
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			

		

			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged() ) {
			?> 
<div class="rightbox">
			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <?php the_time('F, Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the year <?php the_time('Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>

			
				
			<? } //else ?>
<span class="bottom">&nbsp;</span></div>
			<?php }?>

			

			<div class="rightbox">
			<h3>Archives</h3>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<span class="bottom">&nbsp;</span></div>
				
				
				<div class="rightbox"><h3>Patterns</h3>
			<ul>
			 		<?php wp_list_categories('child_of=3&show_count=1&title_li='); ?> 
			</ul>
			<span class="bottom">&nbsp;</span></div>
			
			
			<div class="rightbox"><h3>News</h3>
			<ul>
			 		<?php wp_list_categories('child_of=5&show_count=1&title_li='); ?> 
			</ul>
			<span class="bottom">&nbsp;</span></div>
			
			


			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
				<? /*php wp_list_bookmarks(); */ ?>

				
			<?php } ?>

			<?php endif; ?>
		
	</div>

