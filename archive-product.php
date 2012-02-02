<?php get_header(); 

// Declare global $more, before the loop.
global $more;

 if (have_posts()) :

$post = $posts[0]; // Hack. Set $post so that the_date() works.
endif;
?>
<?php get_sidebar('left'); ?>


	  
	<div id="maincolumn" class="shopfront">  
<div class="mainblock">
	<?php get_sidebar('breadcrumb'); ?>
<h2 class="pagetitle"><? if( is_post_type_archive( 'product' )) {?>
Shop<? } else if(is_tax( 'product_category' )){ ?>
	<?php single_term_title(); } ?>
</h2>



<?
global $wp_query;
$args = array_merge( $wp_query->query, array(  'posts_per_page' => 15 ) );
query_posts( $args );

?>
<?php get_pagination() ?>
<?php while (have_posts()) : the_post(); ?>
<div class="shopfrontitem">

<?php $custom_fields = get_post_custom();
	if ( array_key_exists('thumbsrc', $custom_fields) ){ 
			$thumbsrc = $custom_fields['thumbsrc'][0];
	} else {
		$thumbsrc = '';
	}
?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span class="shopfrontimage"
<? if ($thumbsrc != '' ){ ?>style="background-image:url('<? echo $thumbsrc; ?>')" <? } ?>>

<? /* style="background-image:url('/image.php?src=<? echo $thumbsrc; ?>&amp;maxwidth=<? echo $thumbwidth; ?>&amp;quality=80')" <? } ?> */ ?>
	
	<span class="shopfronttitle"> <?php the_title(); ?> 
	<br /><span class="price"><? if (  get_post_meta($post->ID, 'price', true) && get_post_meta($post->ID, 'stock_level', true) > 0 ){ 
		?>&pound;<? echo number_format ( get_post_meta($post->ID, 'price', true), 2 ); 
	} else if(get_post_meta($post->ID, 'oos_msg', true)){ 
		echo get_post_meta($post->ID, 'oos_msg', true) ;
	} else {
			?> NOT AVAILABLE<? 
	} ?></span>	</span></span>		
			
</a>
				
</div>
<? endwhile; ?>   
<hr class="clearboth" /> 

<div class="pagination"><?php get_pagination() ?></div> 
                    
</div></div>

<?php get_footer(); ?>