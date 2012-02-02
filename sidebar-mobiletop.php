
<ul id="navigation">
<li <? if (is_home()) { ?> id="current" <? }?>><a href="<?php bloginfo('url'); ?>"><span>Home</span></a></li>

<li
 <? if (is_category('5') ){ 
 	?> id="current" <? 
	
	} else if( in_category('5') && ! is_date() && !is_home() && !in_child_category('5') && !is_page() ){ 
 	?> class="parent" <?
  } ?>><a href="<?php echo get_category_link(5);?>"><span>Blog</span></a>

 
 
 <? if(is_category('5') || in_category('5') && ! is_date() && !is_home() &&!is_page() && !is_search()){ ?>
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
 
 
<li <? if (is_category('3') ){ ?> id="current" <? }?>><a href="<?php echo get_category_link(3);?>"><span>Knitting patterns</span></a>
<? if(is_category('3') || (in_category('3') && ! is_date() && !is_home() &&!is_page() && !is_search()) || is_tag()){ ?>
	
			<ul>
			<?php $parameters = array('type' => 'post',
            'child_of' => '3',
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
<li<?php if (is_page('19')) { ?> id="current" <? }?>><a href="/index.php/about/"><span>About</span></a>

<?	if(is_page(19) || is_child_of(19)){ ?>
	<ul>
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


		
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			
