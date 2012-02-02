<?php get_header(); ?>

	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>

	<div id="maincolumn">
<div class="mainblock">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

			

			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
	<?php comments_template(); ?>
	</div>
	</div>
<? 
	if(is_page(462) || is_page(455) /* live */ || is_child_of(462) || is_child_of(455)){  
	 	//get_sidebar('shop'); 
		get_sidebar('home'); 
	} else {
		get_sidebar('home'); 
	}
?>

<?php get_footer(); ?>