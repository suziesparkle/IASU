<?php
/*
Template Name: Shop basket
*/
?><?

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Status: 200");

$sess = session_id();
$error = '';

// Remove old sessions from the database
$yesterday = date("ymdHis", strtotime("-192 hours"));
$deletequery = "DELETE FROM wp_basket WHERE basket_timestamp < '$yesterday'"; // <----- create new db table
//mysql_query($deletequery, $linkdb); *************************


if( !empty($_GET) && array_key_exists( 'action', $_GET) && $_GET['action'] ){
	
	// !!!!!!!!!!!!!!!!!!!!!! CHECK PRODUCT EXISTS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	// !!!!!!!!!!!!!!!!!!!!!!!! update all timestamps for session on add/update/remove !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	if( $_GET['action'] == 'add' && array_key_exists( 'sku', $_GET) && $_GET['sku'] ){ // add 1 of this product to basket
		
			# check if item already in basket?
			$query = "SELECT COUNT(*) FROM wp_iasu_basket WHERE iasu_basket_session = '$sess' AND iasu_basket_prod_id = '".mysql_real_escape_string($_GET['sku'])."'";
			$count = $wpdb->get_var($query);
			
			if( $count > 0 ){ # call URL with update method with +1
				
				$query = "SELECT iasu_basket_quantity FROM wp_iasu_basket WHERE iasu_basket_session = '$sess' AND iasu_basket_prod_id = '".mysql_real_escape_string($_GET['sku'])."';";
				$current_quantity = $wpdb->get_var($query) * 1;
 	
 				header("Location: ". get_permalink() . '?action=update&sku=' . $_GET['sku'] . '&quantity='. ($current_quantity +1));
				die;
			}
			
			#check stock level
			$stock_level = get_post_meta($_GET['sku'], 'stock_level', true);
			
			if($stock_level >= $_GET['quantity'] ){ # add to basket
			
				$query = "INSERT INTO wp_iasu_basket VALUES ('$sess', ".mysql_real_escape_string($_GET['sku']).", CURRENT_TIMESTAMP, '1' )";

				if( $wpdb->query($query)){
					header("Location: ". get_permalink());
					exit;
				} else {
					$wpdb->print_error();
				}
			} else {
				$error = "not enough stock to complete your request";
				echo $error;	
			}
			
		
	} else if ( $_GET['action'] == 'update' && array_key_exists( 'sku', $_GET) && $_GET['sku'] && array_key_exists( 'quantity', $_GET) && $_GET['quantity'] ){ // update the quantity of item in basket
			
			if($_GET['quantity'] <=0 ){	# if new quantity = 0, call remove
				header("Location: ". get_permalink() . '?action=delete&sku=' . $_GET['sku']);
				die;
			}
			
			# check if item already in basket?
			$query = "SELECT COUNT(*) FROM wp_iasu_basket WHERE iasu_basket_session = '$sess' AND iasu_basket_prod_id = '".mysql_real_escape_string($_GET['sku'])."'";
			$count = $wpdb->get_var($query);
			if( ! $count  || $count == 0 ){ // if it's not in the basket, do nothing
				header("Location: ". get_permalink());
				die;
			}
			
			#check stock level
			$stock_level = get_post_meta($_GET['sku'], 'stock_level', true);
			
			if($stock_level >= $_GET['quantity'] ){ # do the update
				$query = "UPDATE wp_iasu_basket SET iasu_basket_quantity = ".mysql_real_escape_string($_GET['quantity']).", basket_timestamp = CURRENT_TIMESTAMP WHERE iasu_basket_session = '$sess' AND iasu_basket_prod_id = ".mysql_real_escape_string($_GET['sku']);
				
				if( $wpdb->query($query)){
					header("Location: ". get_permalink());
					die;
				} else {
					$wpdb->print_error();
				}
			}
		
		
	} else if ( $_GET['action'] ==  'remove' && array_key_exists( 'sku', $_GET) && $_GET['sku'] ){ // remove an item from the basket 
			# delete from basket
			$query = "DELETE FROM wp_iasu_basket WHERE iasu_basket_session = '$sess' AND iasu_basket_prod_id = '".mysql_real_escape_string($_GET['sku'])."'";
			if( $wpdb->query($query)){

			} else {
				$wpdb->print_error();
			}
			header("Location: ".get_permalink() );
			die;
		
	} else if ( $_GET['action'] ==  'empty' ){  // delete everything in the basket
			# remove from basket
			
			$query = "DELETE FROM wp_iasu_basket WHERE iasu_basket_session = '$sess'";
			$wpdb->query($query);

			header("Location: ".get_permalink() );
			die;
			
	} // end if action

} // end if get vars

# that's the end of the basket stuff


get_header(); ?>


<?php get_sidebar('left'); ?>



<div id="maincolumn">
<div class="mainblock">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?> <?php edit_post_link('[edit]', '', ''); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

			

			</div>
  <?
# could put contine shopping button here
	$referer =  'javascript:history.back();';

	if( array_key_exists("HTTP_REFERER", $_SERVER) ){
		if(ereg ("^http://www.delta9shop.com/", $_SERVER['HTTP_REFERER'])){
			$referer =  $_SERVER['HTTP_REFERER'];
		} else {
			$referer =  'http://itsastitchup.co.uk/shop';
		}
	} 
?><div> <a class="lowCTA back" href="<? echo $referer ?>">&lt; Continue shopping</a>  </div>       
            
            
<?php 
	
	#need to do a join to get stock levels and thumbnail etc
	$query = "SELECT DISTINCT ID FROM wp_iasu_basket, wp_posts, wp_postmeta WHERE ID = post_id AND ID = iasu_basket_prod_id AND iasu_basket_session = '$sess' AND post_status = 'publish' AND meta_key = 'stock_level' AND meta_value > 0 ORDER BY iasu_basket_timestamp";
	
	$prodids = $wpdb->get_col($query);
	if($prodids){
			
		$total = 0;
		$counter = 1;
		?>
        		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart" />
<input type="hidden" name="upload" value="1" />
<input type="hidden" name="business" value="shop@delta-9.net" />
<input type="hidden" name="upload" value="1" />
<input type="hidden" name="currency_code" value="GBP" />
        <table id="shop_basket">
		<thead><tr><th>&nbsp;</th><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>&nbsp;</th></tr></thead>
        <tbody>
        <? foreach( $prodids as $prodid ){
			$prod = get_post( $prodid); 
			?><tr>
            	<td class="thumb"><? $thumbsrc = get_post_meta($prodid, 'thumbsrc', true); 
					if( $thumbsrc ){
						$thumbsrc = preg_replace( '/(\.jpg)/', '_s$1', preg_replace('/_[mtzb](\.jpg)/', '$1', $thumbsrc ) );
						?><a href="<? echo get_permalink($prodid); ?>"><img src="<? echo $thumbsrc; ?>" title="<? echo $prod->post_title ?>" width="75" height="75" /></a><?
					} else{
						?>&nbsp;<?	
					}
				?></td>
                <td class="title"><a href="<? echo get_permalink($prodid); ?>"><? echo $prod->post_title ?></a></td>
                <td>&pound;<? $price =  get_post_meta($prodid, 'price', true); echo number_format($price, 2); ?></td>
                <td><? 
					$query = "SELECT iasu_basket_quantity FROM wp_iasu_basket WHERE iasu_basket_prod_id = '$prodid' AND iasu_basket_session = '$sess';";
					$quantity = $wpdb->get_var($query);
					echo $quantity;
					?><div class="available">(<? echo get_post_meta($prodid, 'stock_level', true); ?> available)</div>
					</td>
                <td>&pound;<? echo number_format($price * $quantity, 2); $total += $price * $quantity; ?></td>
                
                <td class="remove"><a href="<? get_permalink();?>?action=remove&amp;sku=<? echo $prodid; ?>" class="smalllowCTA">remove</a>
         <input type='hidden' name='item_name_<? echo $counter; ?>' value='<? echo $prod->post_title ?>'/>
        <input type='hidden' name='quantity_<? echo $counter; ?>' value='<? echo $quantity ?>'/>
        <input type='hidden' name='amount_<? echo $counter; ?>' value='<? echo $price ?>'/>
 <input type='hidden' name='item_number_<? echo $counter; ?>' value='<? echo $prodid ?>'/>
               <input type='hidden' name='shipping_<? echo $counter; ?>' value='0' />

                
                </td>
                
                </tr><?
			$counter++;
		} // for each
		$shipping = 3;
		?>
        <tr><th colspan="4">Goods total</th><td>&pound;<? echo number_format($total, 2) ?></td><td>&nbsp;</td></tr>
        <tr><th colspan="4">Wordlwide flat rate shipping</th><td>&pound;<? echo number_format($shipping,2) ?></td><td>&nbsp;</td></tr>
        <tr><th colspan="4">Grand total</th><td>&pound;<? echo number_format($shipping + $total,2) ?></td><td>&nbsp;</td></tr>
        </tbody></table>
		
        

		
        
      <input type='hidden' name='no_shipping' value='2' />
               <input type='hidden' name='shipping_1' value='<? echo $shipping ?>' />
  
               <input type='hidden' name='shopping_url' value="http://itsastitchup.co.uk/shop/" />
<input type="submit" value="Go to checkout" class="bigCTA forward" onclick="_gaq.push(['_trackEvent', 'Shop', 'Go to checkout', 'PayPal', <? echo $total ?>, 'true']);return true;" />

<div> <a class="lowCTA back" href="<? echo $referer ?>">&lt; Continue shopping</a>  </div>    
        </form>
        <hr class="clearboth" />
        <!-- PayPal Logo --><div id="paypallogo"><a href="#" onclick="javascript:window.open('https://www.paypal.com/uk/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="https://www.paypal.com/en_GB/i/bnr/horizontal_solution_PP.gif" border="0" alt="Pay with PayPal"></a></div><!-- PayPal Logo -->
         <hr class="clearboth" />
		<?
	} else {
		?><p>Your basket is empty!</p><?
	}
			
?>
		</div>
		<?php endwhile; endif; ?>
	
	

	</div>
	</div>

<?php get_footer(); ?>