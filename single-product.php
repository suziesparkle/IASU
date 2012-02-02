<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<? if (!is_supported_mobile()){ // non mobile ?>
<?php get_sidebar('left'); ?>

<? } ?>

	 <div id="maincolumn" class="product"> 
<div class="mainblock">
<?php get_sidebar('breadcrumb'); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

	
	<h2><?php the_title(); ?><? edit_post_link('[edit]',' ','');?></h2>
			
			
<?php the_tags( '<p class="tags">Tags: ', ', ', '</p>'); ?>
			<div class="entry">
			

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                
 <?php 

 
 	$custom_fields = get_post_custom();
	
	 if ( array_key_exists('price', $custom_fields) && $custom_fields['price'][0] != '' ){ 
	 	?><p class="price"><strong>&pound;<? echo number_format ( $custom_fields['price'][0],2 );?></strong></p><? 
	 } 
	 
	  if ( get_post_meta($post->ID, 'stock_level', true) > 0 ){ 
	 	?><div class="buybutton"><a href="http://itsastitchup.co.uk/shopping-basket/?action=add&amp;sku=<? echo $post->ID ?>&amp;quantity=1" class="bigCTA" 
        onclick="_gaq.push(['_trackEvent', 'Shop', 'Add to basket', '<? echo $post->ID . ': ' . get_the_title() ?>', <? echo  $custom_fields['price'][0] ?>]);">Add to basket</a></div>
		<p> Flatrate &pound;3.00 worldwide shipping.</p><? 
	 } else if ( array_key_exists('oos_msg', $custom_fields) && $custom_fields['oos_msg'][0] != '' ){ 
		 ?><p><? echo  $custom_fields['oos_msg'][0];?></p><?
	 } else {
		?><p>Not currently available</p><? 
	 }
		 
	
	 
	 if ( array_key_exists('product_msg', $custom_fields) && $custom_fields['product_msg'][0] != '' ){ 
	 	?><p><? echo $custom_fields['product_msg'][0];?></p><? 
	 } 
	 
?>
                
<div>&nbsp;</div>
                
                <div class="fb-like" data-href="<?php $Path=$_SERVER['REQUEST_URI']; 'http://'.$_SERVER['SERVER_NAME'].$Path; ?>" data-send="false" data-width="200" data-show-faces="false"></div>
				

			</div>

		</div>

	
	

	
	

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
	
	</div>



<?php get_footer(); ?>