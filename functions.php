<?php

// user agent stuff for mobile

function is_supported_mobile(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')){
		return false; //true;
	}
}


// shop stuff

function get_price($price_uk, $postage, $exm, $exc){
   
   return number_format( (($price_uk + $postage) * $exm ) + $exc, 2);
}

function get_local_price ($price_uk, $exm ){
	return number_format( $price_uk  * $exm , 2);
}

function get_postage( $post1, $post_additional, $quantity){
	$maxset = false;
	$total_post = 0;
	for ( $i=0; $i < sizeof($post1); $i++) {
   		if ($post1[$i] == max($post1) && !$maxset ) {
			$total_post += $post1[$i] + ($post_additional[$i] * ($quantity[$i] - 1));
			$maxset = true;
		} else {
			$total_post += $post_additional[$i] * $quantity[$i];
		}
   	}
	return number_format($total_post,2);

}
		
// get currency & region info
	//set defaults
		$currency = 'GBP';
		$region = 'uk';

		// if POST vars
		if( sizeof($_POST) == 2 ){
			
			if( array_key_exists("currency", ($_POST)) ){
				reset($_POST);
				$currency = current($_POST);
				$region = next($_POST);
				setcookie( "d9shopregion", "$currency#$region", time()+60480000, "", ".delta9shop.com" );
			}

		// else test for cookie
		} else if( array_key_exists("d9shopregion", $HTTP_COOKIE_VARS) ){
			list($currency, $region)= split ("#", $d9shopregion );
		} // end if region

// get currency info

if($currency == 'GBP' ){
		$exm = 1; # multiplier
		$exc = 0; #constant
		$symbol = '£';

	} else if( $currency == 'EUR' ){
		$query_euro = "SELECT exch_percent, exch_constant FROM s_exch WHERE exch_type = 'euro'";
		ExecuteQuery($linkdb, $result_euro, $query_euro);
		$tmp = NextRow($result_euro);
		$exm = $tmp[0];	
		$exc = $tmp[1]; 
		$symbol = '&euro;';
		

	} else if ($currency == 'USD'){
		$query_usd = "SELECT exch_percent, exch_constant FROM s_exch WHERE exch_type = 'usd'";
		ExecuteQuery($linkdb, $result_usd, $query_usd);
		$tmp = NextRow($result_usd);
		$exm = $tmp[0];
		$exc = $tmp[1];
		$symbol = '$';

	}


// end shop stuff ///////////////////////////////////////////////////

// do stuff with feeds
function my_feeds($query) {
    if ($query->is_feed) {
        //$query->set('cat','-20,-21,-22');
    }
    return $query;
}

// insert pagination into the listing, this is an add-on to the pagination plugin
function get_pagination(){
        global $wp_query;
        global $max_page;
        if ( !$max_page ) { $max_page = $wp_query->max_num_pages; }

        if(function_exists('wp_page_numbers') && $wp_query->max_num_pages > 1 ) { ?><div
class="pagination"> <? wp_page_numbers();
?></div> <? 
	} else { ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div> <?
	} 
} // end function get_pagination()


// is in a child category of the cagetory arg
function in_child_category($thecategory ){
	$params = array('type' => 'post',
            'child_of' => $thecategory,
            'hierarchical' => 0, );
	$cats = get_categories($params);

	foreach ($cats as $cat) {
		if ( in_category($cat->cat_ID) ){
			return true;
		}
 	} // end for children
	return false;
} // end function in_child_category($thecategory )


// is a child category of the cagetory arg!!!!!!!!!!!!!! - not finished
function is_child_category($thecategory ){
	$params = array('type' => 'post',
            'child_of' => $thecategory,
            'hierarchical' => 0, );
	$cats = get_categories($params);

	foreach ($cats as $cat) {
		if ( is_category($cat->cat_ID) ){
			return true;
		}
 	} // end for children
	return false;
} // end function is_child_category($thecategory )


// is a child of the parent page
function is_child_of($theparentid){
	$childpages = get_pages('child_of='.$theparentid);
	foreach($childpages as $thepage){ 
		if( is_page($thepage->ID)){
			return true;
		}
	
	} // end for each  
	return false;
}

add_filter('pre_get_posts','my_feeds');

// get relevant list of knitting abbreviations
function get_abbr($args){

	$abbr = array(
   'k' => 'knit',
    'p' => 'purl',
    'CO' => 'cast on',
    'cm' => 'centimetre(s)',
    'mm' => 'millimetre(s)',
	'in.' => 'inch(es)',
	'alt' => 'alternate',
	'tog' => 'together',
	'sl1' => 'slip one stitch',
	'sl1p' => 'slip one stitch purlwise',
	'yo' => 'yarn over - bring yarn forward under needle then back over needle (increase 1 stitch)',
	'ws' => 'wrong side',
	'k2tog' => 'knit next two stitches together (decrease 1 stitch)',
	'rs' => 'right side',
	'kfb' => 'knit through front and back loop of next stitch (increase 1 stitch)',
	'tbl' => 'through back loop',
	'psso' => 'pass slipped stitch over',
	'p2tog' => 'purl 2 together (decrease 1 stitch)',
	'dec' => 'decrease',
	'st' => 'stitch',); 

	
	$terms = explode(",", $args);
	// new system
	$terms = $args;
	
	// clean up and sort
	for( $i=0; $i < sizeof($terms); $i++){
		$terms[$i] = trim($terms[$i]);
	} // end for each token
	sort($terms);
	
	for( $i=0; $i < sizeof($terms); $i++){
		if(array_key_exists($terms[$i], $abbr)){
			?><dt><? echo $terms[$i]; ?></dt>
    		<dd><? echo $abbr[$terms[$i]]; ?></dd>
			<?
		}// if is an abbreviation
	} // end for each tokensort

} // end function get_abbr()

function show_thumbnail($imgsrc, $posttitle, $postlink, $width){

	?><div class="wp-caption alignright" style="width: <? echo $width + 10; ?>px">
	<a href="<?php echo $postlink; ?>" rel="bookmark" title="<? echo $posttitle; ?>">
	<img title="<?php echo $posttitle; ?>" src="/image.php?src=<? echo $imgsrc; ?>&amp;maxwidth=<? echo $width; ?>&amp;quality=80" alt="<?php echo $posttitle; ?>"  /></a></div>

<? } // end show_thumbnail

function get_preview($content){
	
	// remove headings
	$pattern = '/<[hH][3-6]>([^<]*)<\/[hH][3-6]>/e';
	$replacement = "'<p><strong>$1</strong></p>'"; // does now work
	$replacement = '';
	$content = preg_replace($pattern, $replacement, $content);
	// then strip out images

	$pattern = '/\[caption[^\]]*+\][^\[]*\[\/caption\]/';
	$content = preg_replace($pattern, '', $content);

	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	
	return $content;

} // end get_preview()

function strip_images($content){
	// first, get the URL of the first image
	// then strip out images
	$pattern = '/\[caption(^\])*\](^\[)*\[\/caption\]/';

	$pattern = '/\[caption[^\]]*+\][^\[]*\[\/caption\]/';
	$replacement = '';
	$content = preg_replace($pattern, $replacement, $content);

	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	
	return $content;

}// end strip_images()


