<?php get_header(); ?>

<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>
<? } ?>

	 <div id="maincolumn" class="home"> 
	 <div class="mainblock">

<h2 class="division">Knitting patterns</h2>
<? // custom query 
	$featured = 896; // ID of featured pattern

	query_posts('p='.$featured);

	//The Loop
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?><div id="featured"><?
		$custom_fields = get_post_custom();
		if ( array_key_exists('thumbsrc', $custom_fields) ){ 
			$thumbsrc = $custom_fields['thumbsrc'][0]; ?>
			
			<div class="wp-caption alignleft" style="width: <? echo 294 + 10; ?>px">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<? the_title(); ?>">
	<img title="<?php the_title(); ?>" src="/image.php?src=<? echo $thumbsrc; ?>&amp;maxwidth=294&amp;quality=75" alt="<?php the_title(); ?>"  /></a></div>
	
	<? } // end if thumbnail ?>
<div class="copy">		
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span class="cat_title">Featured pattern </span><?php the_title(); ?></a></h3>

<div class="author">By <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></div>

<?php the_excerpt('more...');

	if ( array_key_exists('price', $custom_fields) && $custom_fields['price'][0] && $custom_fields['price'][0] > 0){ 
			$price = $custom_fields['price'][0];
			?><div class="price">PDF download, &pound;<? echo $price ?></div><?
			
	} //end if 

 if ( array_key_exists('buybutton', $custom_fields) ){ 
			$buyurl = $custom_fields['buybutton'][0];
			
			?><a href="<? echo $buyurl ?>" class="buybutton" 	<? if(array_key_exists('addtobasket', $custom_fields) ){ 
					$onclick = $custom_fields['addtobasket'][0];
					?> onclick="<? echo $onclick ?>" <?
				} ?>>Add to basket</a><?
	} //end if 
				
?>

</div>
</div><?
		
	endwhile; 
	endif;
//Reset Query
wp_reset_query();

// next query, get some more patterns



query_posts(array(
 'cat'      => 3, 
 'posts_per_page' => 3, 
 'orderby'    => 'rand',
));

if (have_posts()) : 

?>
<div class="smallpro"><?
$i = 0; // set a counter 
	while (have_posts() && $i < 2 ) : the_post(); 
		if(get_the_id() != $featured){
			$i++;
			?><div class="item"><?
			$custom_fields = get_post_custom();
		if ( array_key_exists('thumbsrc', $custom_fields) ){ 
			$thumbsrc = $custom_fields['thumbsrc'][0]; ?>
			
			<div class="wp-caption alignleft" style="width: <? echo 141 + 10; ?>px">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<? the_title(); ?>">
	<img title="<?php the_title(); ?>" src="/image.php?src=<? echo $thumbsrc; ?>&amp;maxwidth=141&amp;quality=75" alt="<?php the_title(); ?>"  /></a></div>
	<? } // end if thumbnail ?>
			
			<div class="copy">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span class="cat_title">
			<? if ( !array_key_exists('price', $custom_fields) || $custom_fields['price'][0] == '' || $custom_fields['price'][0] <= 0){ 
				?>Free <?
			} //end if ?>
			
			 knitting pattern </span><?php the_title(); ?></a>
			 
			 </h3>
			 <div class="author">By <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></div></div></div><?
		
		}
	
	
	endwhile; 
	
	?></div><?
endif;
//Reset Query
wp_reset_query();

?>

<p class="morelink"><a href="<?php echo get_category_link(3);?>">View all patterns</a></p>

<h2 class="division">Features and blog</h2>

	<?
	query_posts(array(
 'cat'      => -3, 
 'posts_per_page' => 5, 
));

	
	
	
	 if (have_posts()) : 
	 
	  $i = 1; // set a counter ?>
		<div class="otherposts">
		<?php while (have_posts()) : the_post(); 
			$i++;
			$thumb = "";
				?><div class="post" id="post-<?php the_ID(); ?>"><?
				
				$custom_fields = get_post_custom();
				if ( array_key_exists('thumbsrc', $custom_fields) ){ 
			$thumbsrc = $custom_fields['thumbsrc'][0]; ?>
			<? $thumb = "thumbcopy"; ?>
			<div class="wp-caption alignleft" style="width: <? echo 141 + 10; ?>px">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<? the_title(); ?>">
	<img title="<?php the_title(); ?>" src="/image.php?src=<? echo $thumbsrc; ?>&amp;maxwidth=141&amp;quality=70" alt="<?php the_title(); ?>"  /></a></div>
	<? } // end if thumbnail ?>
			
			<div class="copy <? echo $thumb ?>">
					<h3><?if  ( in_category(5) ){  ?>
						Blog: 
					<? } else { ?>
						Feature: 
					<? } ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
			
				
				
				
				<p class="postdate"> Posted by <a href="/index.php/author/<?php the_author_meta('user_login'); ?>"><?php the_author_firstname(); ?></a>, <?php the_time('l j F, Y') ?>, <?php the_time() ?> </p>

				<div class="entry"><?php echo get_preview(get_the_excerpt('Read more...')); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?>  <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				
				</div><span class="clearboth">&nbsp;</span>
			</div>
			

		<?php endwhile; ?>
</div>


	<?php else : ?>

		<h3>Not Found</h3>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div></div>

<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
