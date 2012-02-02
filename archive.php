<?php get_header(); 

// Declare global $more, before the loop.
global $more;

 if (have_posts()) :

$post = $posts[0]; // Hack. Set $post so that the_date() works.  ?>
	  
	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>
	  
	<div id="maincolumn">  
	<div class="mainblock">
	<?php get_sidebar('breadcrumb'); ?>
	
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 ><?php single_cat_title(); ?> </h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">
		
		<? if(is_tag(array('easy', 'beginner', 'intermediate', 'advanced'))){
		?>Skill level: <?
		} else {
		?>Tag: <?
		} single_tag_title(); ?></h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Archives</h2>
 	  <?php } ?>


		<?php get_pagination() ?>

		
		<? $i = 1; // set a counter 
		$thumbwidth = 200;?>
		<?php while (have_posts()) : the_post(); 
		
			
			
			
			if ( in_category(3) || is_category('3') ){ // this is a pattern ?>
					<div class="post" id="post-<?php the_ID(); ?>">
					<?php 
					$custom_fields = get_post_custom();
					if ( array_key_exists('thumbsrc', $custom_fields) ){ 
						$thumbsrc = $custom_fields['thumbsrc'][0];
						show_thumbnail($thumbsrc , the_title_attribute('echo=0'), get_permalink(), $thumbwidth);
				 	} ?>
				
			
					<h3><? if(is_date()){ ?>Pattern:<? } ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
					
				<p class="postdate">Posted by <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?></a>, <?php the_time('l j F, Y') ?> <?php the_time() ?> </p>

				<div class="entry"><?php echo get_preview(get_the_excerpt('Read more...')); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?>  <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
				
				
				<? } else { // this is news ?>
					<div class="post" id="post-<?php the_ID(); ?>">
					
					<?	$custom_fields = get_post_custom();
					if ( array_key_exists('thumbsrc', $custom_fields) ){ 
						$thumbsrc = $custom_fields['thumbsrc'][0];
						show_thumbnail($thumbsrc , the_title_attribute('echo=0'), get_permalink(), $thumbwidth);
				 	} ?>
			
					<h3><? if(is_date()){ ?>Blog:<? 
					}  ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
				<p class="postdate"> Posted by <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?></a>, <?php the_time('l j F, Y') ?> <?php the_time() ?> </p>
				<div class="entry"><?php echo get_preview(get_the_excerpt('Read more...')); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?>  <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
							
				<? }  // end if category
			
				
			
		$i++;
		 endwhile; ?>

		

			<? get_pagination(); ?>
	<?php else : ?>

		<h2 class="center">Not Found</h2>
		

	<?php endif; ?>

	</div>
	
</div>
	
	<?php get_sidebar('home'); ?>


<?php get_footer(); ?>
