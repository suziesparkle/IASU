<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	

<?php get_sidebar('left'); ?>


	 <div id="maincolumn"> 
<div class="mainblock">
<?php get_sidebar('breadcrumb'); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
	

 		<h2><?php the_title(); ?></h2>
			<div id="authordate">  By <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?> <? the_author_lastname();  ?></a>, <?php the_time('j F Y') ?> <? edit_post_link('Edit',' | ','');?></div>


<p id="comments_link"> <a href="#comments"><?php comments_number('No comments','One comment','% comments'); ?></a> | <a href="#respond">Leave a comment</a></p>
			
<?php the_tags( '<p class="tags">Tags: ', ', ', '</p>'); ?>
			<div class="entry">
 

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

					
	<!-- start of comments -->					
<div id="comments_tab">

				
				<?php comments_template( '', true ); ?>
				
				</div><!-- end of comments -->

			</div>
		</div>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
	
	</div>

 		<?php get_sidebar('pattern'); ?>

<?php get_footer(); ?>