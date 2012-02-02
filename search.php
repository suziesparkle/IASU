<?php get_header(); ?>
	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>
	<div id="maincolumn" class="searchresults">
<div class="mainblock">
	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

	

<?php get_pagination(); ?>
		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h3 id="post-<?php the_ID(); ?>">
				<?php if ( in_category(3) && $post->post_type == 'post' ){ ?>
				Pattern: 
				<? } else if ( in_category(5) && $post->post_type == 'post' ){ ?>
				Blog:  
				<? } else if ($post->post_type == 'page'){ ?>
				Page:
				
				<? } ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
				<?php 
				$custom_fields = get_post_custom();
				if ( in_category(3) && array_key_exists('thumbsrc', $custom_fields) ){ 
					$thumbsrc = $custom_fields['thumbsrc'][0];
					show_thumbnail($thumbsrc , the_title_attribute('echo=0'), get_permalink(), 200);
				} ?>
				
				<p class="postdate"> Posted by <?php the_author_firstname(); ?>, <?php the_time('l j F Y') ?> <?php the_time() ?> </p>
				<div class="entry">
			<? 	if ( in_category(3) ){ // if it's a pattern, just show the exerpt
				
			} else {
					
					
				}// end if pattern 
				the_excerpt();?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>

		<?php endwhile; ?>

		
			<?php get_pagination(); ?>


	<?php else : ?>

		<h2>No posts found. Try a different search?</h2>
		
	<?php endif; ?>

	</div></div>

<?php get_sidebar('home'); ?>

<?php get_footer(); ?>