<?php get_header(); 

// Declare global $more, before the loop.
global $more;

 if (have_posts()) :

$post = $posts[0]; // Hack. Set $post so that the_date() works.  ?>
	  
<?php get_sidebar('left'); ?>
	  
	<div id="maincolumn">  
	<div class="mainblock">
    
	<?php get_sidebar('breadcrumb'); ?>
	
 	  <?php /* If this is a category archive */ if (is_tax('pattern_category')) { ?>
		<h2 ><?php single_term_title(); ?></h2>
        <? } else if(is_tax('pattern_gauge')){ ?>
        	<h2 >Patterns for <?php single_term_title(); ?> yarn</h2>
 	  <?php   } else if(is_tax('pattern_difficulty')){ ?>
        	<h2 > <?php single_term_title(); ?> knitting patterns</h2>
 	  <?php } else if(is_tax()){ ?>
        	<h2 ><?php single_term_title(); ?> Patterns</h2>
 	  <?php  } else { ?>
		<h2 class="pagetitle">Knitting patterns</h2>
 	  <?php } ?>


		<?php get_pagination() ?>

		
		<? $i = 1; // set a counter 
		$thumbwidth = 200;?>
		<?php while (have_posts()) : the_post(); ?>
		

					<div class="post" id="post-<?php the_ID(); ?>">
					<?php 
					$custom_fields = get_post_custom();
					if ( array_key_exists('thumbsrc', $custom_fields) ){ 
						$thumbsrc = $custom_fields['thumbsrc'][0];
						show_thumbnail($thumbsrc , the_title_attribute('echo=0'), get_permalink(), $thumbwidth);
				 	} ?>
				
			
					<h3><? if(is_date()){ ?>Pattern:<? } ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><?php edit_post_link('[Edit]', ' ', ''); ?></h3>
				
					
				<p class="postdate">Posted by <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?></a>, <?php the_time('l j F, Y') ?> <?php the_time() ?> </p>

				<div class="entry"><?php echo get_preview(get_the_excerpt('Read more...')); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); 
                //('pattern_category','pattern_gauge', 'pattern_difficulty', 'pattern_gender', 'pattern_age', 'pattern_garment')
				 echo get_the_term_list( $post->ID, 'pattern_difficulty', 'Skill level: ', ', ', '<br />');
				 echo get_the_term_list( $post->ID, 'pattern_gauge', 'Yarn weight: ', ', ', '<br />');
				 ?> 
				
				
				 <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
				
				
							
				<?
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
