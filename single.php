<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>

	 <div id="maincolumn"> 
<div class="mainblock">
<?php get_sidebar('breadcrumb'); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

	
		
	<?php if ( in_category(3) ){ // if this is a pattern ?>
	

 		<h2><?php the_title(); ?></h2>
			<div id="authordate">  By <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?> <? the_author_lastname();  ?></a>, <?php the_time('j F Y') ?> <? edit_post_link('Edit',' | ','');?></div>
<?php } else { ?>
	
	<h2><?php the_title(); ?></h2>
			<p id="authordate"> Posted by <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?></a> on <?php the_time('l, j F Y') ?> at <?php the_time() ?>  <? edit_post_link('Edit',' | ','');?></p>
<? }// end if this is a pattern ?>

<p id="comments_link"> <a href="#comments"><?php comments_number('No comments','One comment','% comments'); ?></a> | <a href="#respond">Leave a comment</a></p>
			
<?php the_tags( '<p class="tags">Tags: ', ', ', '</p>'); ?>
			<div class="entry">
			
<?php 
if(is_single('129')){ // test post here!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$content = get_the_content(); 
}// end if test
?> 

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				
				
		<?php if ( ! in_category(3) ){ // if this is news ?>
 		<div class="navigation">
			<div class="alignleft"><?php //previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php //next_post_link('%link &raquo;') ?></div>
		</div>
<?php }  ?>		
	
		
		
				
					
	<!-- start of comments -->					
<div id="comments_tab"
>

				
				<?php comments_template( '', true ); ?>
				
				</div><!-- end of comments -->

			</div>
			

				
		</div>

	
	

	
	

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
	
	</div>



	<?php if ( in_category(3) ){ // if this is a pattern ?>
 		<?php get_sidebar('pattern'); ?>
<?php } else { ?>
	<?php get_sidebar('home'); ?>
<? }// end if this is a pattern ?>
<?php get_footer(); ?>