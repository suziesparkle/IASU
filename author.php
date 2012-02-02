<? get_header(); ?>

	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>

	<div id="maincolumn">
<div class="mainblock">
<div class="post" >
<? if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
else :
$curauth = get_userdata(intval($author));
endif;

	  
 	  if (is_author()) { ?>
		<h2 class="pagetitle"> About <?php echo $curauth->first_name; ?>    </h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>
 	  <?php } ?>


<div class="wp-caption alignleft" style="width: 160px;">
	<?php 
   echo get_avatar( $curauth->user_email, $size = '150' ); 
   ?></div>

   <p><?php  echo preg_replace('/\n\s*/', '</p><p>', $curauth->description );?></p>
   
   </div></div></div>


<? /*	<?php if (have_posts()) : ?>
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. 
        
        <div class="blogposts">



<span class="clearboth">&nbsp; </span>

<h3 class="authorposts">My posts </h3>
<?php get_pagination(); ?>
		<?php while (have_posts()) : the_post(); ?>
		<div  class="blog_post" >
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<div class="blog_datetime">Posted <? the_time('j F  Y') ?>  by <a href="?author=<?php the_author_ID(); ?>"><? the_author_firstname(); ?></a></div>

				<div class="entry">
					<?php the_excerpt() ?>
                    	<p><?php the_tags('Tags: ', ', ', '<br />'); ?>  </p>
                    <p><?php edit_post_link('Edit', '', ' | '); ?>  
					
					<a href="<?php comments_link(); ?>">
					<?php comments_number('No comments','1 comment &#187;','% comments &#187;'); ?></a></p>
				</div>

				
 <span class="blog_postfooter">&nbsp;</span>
			</div>

		<?php endwhile; ?>


	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
	

	endif;
?>

	</div> */?>

<?php get_sidebar('author'); ?>

<?php get_footer(); ?>
