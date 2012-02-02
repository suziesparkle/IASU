<? $sess = session_id(); ?><div id="leftcolumn">


<div class="sidebox">
<h3>&nbsp; </h3>
<ul id="navigation">
<li <? if (is_home()) { ?> id="current" <? }?>><a href="<?php bloginfo('url'); ?>"><span>Home</span></a></li>



<li <? 
	 if( is_post_type_archive( 'product' ) && !(is_tax( 'product_category' ) )){ 
		?> id="current" <? 
	}?>><a href="/shop" ><span>Shop</span></a><? 

	if( is_tax( 'product_category' ) || is_singular('product') || is_post_type_archive( 'product' ) ){ 

		// get an array of term IDs for this product
		global $product_terms, $currentterm;
		$product_terms = Array();
		if(is_singular('product')){
			$product_terms = wp_get_object_terms( $post->ID, 'product_category', array('fields' => 'ids') );
		}
		//echo "product terms: "; foreach($product_terms as $term){ echo $term.','; }
		$currentterm = get_term_by( 'slug', get_query_var( 'term' ), 'product_category' );
		///echo "current term: ".$currentterm->term_id;

	
		function build_nav_tree($node ){ // term object
			global $product_terms, $currentterm;
			// any child categories? 
			$children = get_terms( 'product_category', array('hierarchical' => 0, 'parent' => $node->term_id, 'fields' => 'ids'));		
			$descendants = get_terms( 'product_category', array('hierarchical' => 0, 'child_of' => $node->term_id, 'fields' => 'ids'));
			
			//echo sizeof(array_intersect($product_terms, $descendants ));
			?> 
			<li <? 
			if (is_tax('product_category', $node->term_id)){ 
				?> id="current" <? 
			} else if( 
					is_singular() 
					&& has_term( $node->term_id, 'product_category', $post ) 
					&& sizeof(array_intersect($product_terms, $descendants )) == 0 ){ // parent of product
				?> class="parent" <?
			} // end if else 
			
			?> ><a href="<? echo get_term_link($node); ?>"><span><? echo $node->name; ?> <span class="count">(<? echo $node->count; ?>)</span></span></a> <?
			
			//echo "children: "; foreach($children as $term){ echo $term.','; }	
			//echo "<br/>descendants: "; foreach($descendants as $term){ echo $term.','; }
			
			// if this is the current category or a single with child terms of this category

			if(
					is_tax('product_category', $node->term_id) 
					|| sizeof(array_intersect($product_terms, $descendants)) > 0 
					|| in_array( $currentterm->term_id, $descendants) 
					){ 
				
				if(count($children) > 0 ){
					?> <ul>  <?
					foreach ($children as $child) {
						 build_nav_tree(get_term_by( 'id', $child, 'product_category' ));
					} 
					?></ul> <? 
				} 
			} // end if current node
			?></li><?
				
		} // end build_nav_tree($node, $product_terms )
		
		// build it
		$categories = get_terms( 'product_category', array('hierarchical' => 1, 'parent' => '0'));
		if(count($categories > 0 )){
			?> <ul> <?
			foreach ($categories as $cat) {
				build_nav_tree($cat );
			}
		?></ul><?
		} // end if sub cats
	
 	} // end if show shop nav?>

</li> 
 <li <? if (is_page(1711)){ ?>id="current" <? } ?>><a href="<? echo  get_permalink('1711'); ?>" ><span>View basket<?  
 
 	//let's have a li'l look in the shopping basket
	$query = "SELECT COUNT(*) FROM wp_iasu_basket WHERE iasu_basket_session = '$sess'";
	$count = $wpdb->get_var($query);

	if( $count > 0 ){ echo " (".$count.")" ;}
 
 ?></span></a></li> 
 
 
 <li <? // PATTERNS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	 if( is_post_type_archive( 'pattern' ) ){ 
		?> id="current" <? 
	} 
	if( is_tax( 'pattern_gauge' ) || is_tax( 'pattern_difficulty' ) || is_tax( 'pattern_garment' ) ){ ?> class="parent" <?
	} 
	?>><a href="/knitting-patterns" ><span>Knitting patterns</span></a><? 

	if( is_tax( 'pattern_category' ) || is_singular('pattern') || is_post_type_archive( 'pattern' ) || is_tax( 'pattern_gauge' ) || is_tax( 'pattern_difficulty' ) || is_tax( 'pattern_garment' ) ){ 

		// get an array of term IDs for this product
		global $pattern_cats, $currentcat;
		$pattern_cats = Array();
		if(is_singular('pattern')){
			$pattern_cats = wp_get_object_terms( $post->ID, 'pattern_category', array('fields' => 'ids') );
		}
		//echo "product terms: "; foreach($product_terms as $term){ echo $term.','; }
		$currentcat = get_term_by( 'slug', get_query_var( 'term' ), 'pattern_category' );
		///echo "current term: ".$currentterm->term_id;

	
		function build_nav_tree($node ){ // term object
			global $pattern_cats, $currentcat;
			// any child categories? 
			$children = get_terms( 'pattern_category', array('hierarchical' => 0, 'parent' => $node->term_id, 'fields' => 'ids'));		
			$descendants = get_terms( 'pattern_category', array('hierarchical' => 0, 'child_of' => $node->term_id, 'fields' => 'ids'));
			
			//echo sizeof(array_intersect($product_terms, $descendants ));
			?> 
			<li <? 
			if (is_tax('pattern_category', $node->term_id)){ 
				?> id="current" <? 
			} else if( 
					is_singular() 
					&& has_term( $node->term_id, 'pattern_category', $post ) 
					&& sizeof(array_intersect($pattern_cats, $descendants )) == 0 ){ // parent of product
				?> class="parent" <?
			} // end if else 
			
			?> ><a href="<? echo get_term_link($node); ?>"><span><? echo $node->name; ?><!--span class="count">(<? echo $node->count; ?>) --></span></span></a> <?
			
			//echo "children: "; foreach($children as $term){ echo $term.','; }	
			//echo "<br/>descendants: "; foreach($descendants as $term){ echo $term.','; }
			
			// if this is the current category or a single with child terms of this category

			if(
					is_tax('pattern_category', $node->term_id) 
					|| sizeof(array_intersect($pattern_cats, $descendants)) > 0 
					|| in_array( $currentcat->term_id, $descendants) 
					){ 
				
				if(count($children) > 0 ){
					?> <ul>  <?
					foreach ($children as $child) {
						 build_nav_tree(get_term_by( 'id', $child, 'pattern_category' ));
					} 
					?></ul> <? 
				} 
			} // end if current node
			?></li><?
				
		} // end build_nav_tree($node, $product_terms )
		
		// build it
		$categories = get_terms( 'pattern_category', array('hierarchical' => 1, 'parent' => '0'));
		if(count($categories > 0 )){
			?> <ul> <?
			foreach ($categories as $cat) {
				build_nav_tree($cat );
			}
		?></ul><?
		} // end if sub cats
	
 	} // end if show shop nav?>
 
<li
 <? if (is_category('43') ){ 
 	?> id="current" <? } ?> >
	
	<a href="<?php echo get_category_link(43);?>"><span>Features</span></a>
<? if( is_category('43') || in_category('43') && ! is_date() && !is_home() &&!is_page() && !is_search() && !is_tag()){ ?>
	
			<ul>
			<?php $parameters = array('type' => 'post',
            'child_of' => '43',
            'hierarchical' => 0, 
            'pad_counts' => false);?>
			 <?php $categories = get_categories($parameters);
			 foreach ($categories as $cat) {
			 ?> <li <? if (is_category($cat)){ ?> id="current" <? }
			 if( in_category($cat->cat_ID) && is_single() ){
			 	?> class="parent" <? 
			 } ?>
			 ><a href="<? echo get_category_link($cat); ?>"><span><?
  	echo $cat->cat_name; ?></span></a></li><?
				
				
  			} ?>

			 
			</ul>
		
			<? } ?>

</li>
 
 

<li
 <? if (is_category('5') ){ 
 	?> id="current" <? 
	
	} else if( in_category('5') && ! is_date() && !is_home() && !in_child_category('5') && !is_page() &&!is_author() &&! is_search()){ 
 	?> class="parent" <?
  } ?>><a href="<?php echo get_category_link(5);?>"><span>Blog</span></a>

 
 
 <? if(is_category('5') || in_category('5') && ! is_date() && !is_home() &&!is_page() && !is_search() &&!is_author() ){ ?>
 <ul>
 <?php $parameters = array('type' => 'post',
            'child_of' => '5',
            'hierarchical' => 0, 
            'pad_counts' => false);
			 $categories = get_categories($parameters);
			 foreach ($categories as $cat) {
			 ?> <li <? if (is_category($cat->cat_ID)){ ?> id="current" <? 
			 } else if( in_category($cat->cat_ID) && is_single() ){
			 	?> class="parent" <? 
			 } ?>
			 ><a href="<? echo get_category_link($cat); ?>"><span><?
  	echo $cat->cat_name; ?></span></a></li><?
				
				
  			} ?>
 
 </ul>
 
 <? } // end if ?>
 </li>
 
 
 
<!--<li<?php if (is_page('455')) { ?> id="current" <? }?>><a href="/index.php/<? echo get_page_uri('455'); ?>"><span>Shop</span></a></li> -->

<li<?php if (is_page('19')) { ?> id="current" <? }?>><a href="/about/"><span>About</span></a>

<?	if(is_page(19) || is_child_of(19) || is_author()){ ?>
	<ul>
    
    <li <? if(is_author('suzie')){  ?> id="current" <? } ?>>
    	<a href="/author/suzie/"><span>About Suzie</span></a>
    </li>
    
	<?
	$pages = get_pages('sort_column=menu_order&child_of=19&exclude=19');

	foreach ($pages as $pag) {
	
			 ?> <li <? if (is_page($pag)){ ?> id="current" <? }?>
			 ><a href="<? echo get_page_uri($pag); ?>"><span><?
  	echo $pag->post_title; ?></span></a></li>
				
				
  	<?		} ?>

	</ul>
<? } ?>

</li>
 <? if (0) { ?>
<li<?php if (is_page('462')) { ?> id="current" <? }?>><a href="/index.php/<? echo get_page_uri(462); ?>"><span>Shop</span></a>

<?	if(is_page(462) || is_child_of(462)){ ?>
	<ul>
	
	<? 
	show_cats_brands();
	$pages = get_pages('sort_column=menu_order&child_of=462');

	foreach ($pages as $pag) {
	
			 ?> <li <? if (is_page($pag)){ ?> id="current" <? }?>
			 ><a href="<? echo get_page_uri($pag); ?>"><span><?
  	echo $pag->post_title; ?></span></a></li>
				
				
  	<?		} ?>

	</ul>
<? } ?>

</li> <? } ?>

</ul>
<span class="bottom">&nbsp;</span>
</div>	

		
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
<? if(is_single() && in_category(3)){ 
		$custom_fields = get_post_custom();
				// get donation box
	if( array_key_exists('paypalbuttongbp', $custom_fields) ){
		$paypalbutton = $custom_fields['paypalbuttongbp'][0];
	
		?><div id="activity"  class="sidebox">
    	<h3>Donate</h3>
		<p>If you like this pattern, please consider making a small PayPal donation.
		</p> 
		<? echo $paypalbutton ?>
		<p>Your donations help towards website and materials costs.</p>
	<span class="bottom">&nbsp;</span></div>

<? 	} // get donation box
	
	} // is single?>
				
	</div>