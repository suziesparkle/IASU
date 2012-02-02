<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

	<?php get_sidebar('left'); ?>
	<div id="maincolumn">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<h2><?php the_title(); ?></h2>

<div class="entry">

				<?php the_content(); ?>

				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

			
<?php $bookmarks = wp_list_bookmarks('echo=0&show_description=1');

//clean up the mess
$bookmarks = preg_replace('/[Hh]2>/', 'h3>', $bookmarks);

$bookmarks = preg_replace('/<li[^>]*class="linkcat"[^>]*>/', '', $bookmarks);
$bookmarks = preg_replace('/(<\/ul>\s*)<\/li>/', '$1', $bookmarks);


echo $bookmarks;

 ?>
</div>


</div>
	<?php endwhile; endif; ?>
<?php  get_sidebar('home'); 
get_footer(); ?>
