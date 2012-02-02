<? if( is_single()){ ?>	<div id="rightcolumn"> <?
// we're inside the loop -->
$custom_fields = get_post_custom();

if ( array_key_exists('price', $custom_fields) && $custom_fields['price'][0] && $custom_fields['price'][0] > 0){ 
?><div class="sidebox printhide">
<h3>Buy</h3> <?

			$price = $custom_fields['price'][0];
			?><p><strong>PDF download, &pound;<? echo $price ?></strong>
			
			<? if ( array_key_exists('buybutton', $custom_fields) ){ 
			$buyurl = $custom_fields['buybutton'][0];
			
			?><a href="<? echo $buyurl ?>" class="buybutton" 	<? if(array_key_exists('addtobasket', $custom_fields) ){ 
					$onclick = $custom_fields['addtobasket'][0];
					?> onclick="<? echo $onclick ?>" <?
				} ?>>Add to basket</a><?
			
				if ( array_key_exists('pdfthumb', $custom_fields) && $custom_fields['pdfthumb'][0] != '' ){  
				?></p><p><a href="<? echo $buyurl ?>" class="hidden"><img src="<? echo $custom_fields['pdfthumb'][0]; ?>" alt="PDF download" title="PDF download" /></a>
			
				<? } // end if PDFthumb /
			
			} //end if  ?>
			
			</p>
		
			

<span class="bottom">&nbsp;</span>
</div>
<?

} else {

?><div id="printme" class="sidebox">
<h3>Print options</h3>
<form action="#">
<input type="checkbox" id="printimages" value=".wp-caption" checked onchange="printhide(this);"/> <label for="printimages">Print images</label><br/>
<input type="checkbox" id="printintro" value="#intro p" checked onchange="printhide(this);"/> <label for="printintro">Print intro</label><br/>
<input type="checkbox" id="printglossary" value="#glossary" checked onchange="printhide(this);"/> <label for="printglossary">Print  abbreviations</label>
</form>
<p><a href="javascript:print()">Print me</a> I'm printer friendly!</p>
<span class="bottom">&nbsp;</span></div>
		
<?
} // end if paid-for




	if( array_key_exists('ravelrybutton', $custom_fields) && array_key_exists('ravelrylink', $custom_fields)){
		$ravelry_button = $custom_fields['ravelrybutton'][0];
		$ravelry_link = $custom_fields['ravelrylink'][0];
	
		?><div id="activity"  class="sidebox">
    	<h3>Pattern activity</h3>
        <h4>Projects on Ravelry</h4>
		<p>
		<a href="<? echo $ravelry_link; ?>" class="hidden"><img src="<? echo $ravelry_button; ?>" alt=""   class="projectsbutton" /></a> </p>
    	<p  class="queuelink"><a href="javascript:location.href='http://www.ravelry.com/bookmarklets/queue?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent('<?php the_title();?> <?php the_author_firstname(); ?> <? the_author_lastname();  ?>')">Add 
      	to Ravelry queue</a></p>
        
        <? if( array_key_exists('flickrtag', $custom_fields)){
				sfp_gallery($custom_fields['flickrtag'][0]); 
		} // end if flickr tag ?>
	<span class="bottom">&nbsp;</span></div>

<? 	} // end if ravelry link 
	
	
	// if abbreviations
	if( array_key_exists('abbr', $custom_fields)){			
		$abbreviations = $custom_fields['abbr'];
	?>
			<div id="glossary"  class="sidebox">
  	<H3>Abbreviations</h3>
  	<dl> 
  
  	<? get_abbr($abbreviations) ?>

	
    	</dl><span class="bottom">&nbsp;</span>
	</div>

<? 	} // end if abbreviations ?>

	</div>

<? } //end if is_single() ?>