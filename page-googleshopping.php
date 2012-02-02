<?php
/*
Template Name: Google shopping xml feed
*/
?><?

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

echo '<?xml version="1.0"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
<channel>
<title>' . htmlspecialchars ("It's a stitch up products") . '</title>
<link>http://itsastitchup.co.uk</link>
<description>A description of your content</description>
';


					
$the_query = new WP_Query( array( 
		'meta_key' => 'stock_level', 
		'meta_value' => '0', 
		'meta_compare' => '>',
		'post_type' => 'product', 
		'nopaging' => 'true'
));
	
// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
	
	echo '<item>
<title>'. htmlspecialchars ($post->post_title) .'</title>
<link>'. get_permalink($post->ID) . '</link>
<description>' . htmlspecialchars (get_the_excerpt('')) . '</description>
<g:image_link>' . preg_replace('/_[mtzb](\.jpg)/', '$1', get_post_meta($post->ID, 'thumbsrc', true) ) .'</g:image_link> 
<g:price>'. get_post_meta($post->ID, 'price', true) . '</g:price> 
<g:google_product_category>'. htmlspecialchars (get_post_meta($post->ID, 'google_product_category', true)) . '</g:google_product_category>
<g:id>' . $post->ID .'</g:id>
<g:availability>in stock</g:availability>
<g:online_only>y</g:online_only>';

$condition = 'new';
$vintage = get_post_meta($post->ID, 'vintage', true);
if( $vintage ){ $condition = 'used'; }

echo '<g:condition>' . $condition .'</g:condition>
</item>';

//<g:brand>Acme</g:brand>
//<g:product_type>Arts & Entertainment > Party Supplies > Fancy Dress Wigs,Clothing & Accessories > Clothing Accessories > Wigs</g:product_type> <- wrong, include multiple tags in XML
// wp_get_object_terms( $object_ids, $taxonomies, $args )
//$product_terms = wp_get_object_terms($post->ID, 'product_category');
//if(!empty($product_terms)){
//  if(!is_wp_error( $product_terms )){
//    foreach($product_terms as $term){
 //     echo '<li><a href="'.get_term_link($term->slug, 'product').'">'.$term->name.'</a></li>'; 
 //   }
//    echo '</ul>';
//  }
//}
//<g:gender>male</g:gender>
//<g:age_group>adult</g:age_group>
//<g:color>Black</g:color>
//
//shipping

endwhile;

echo '</channel></rss>';


?>