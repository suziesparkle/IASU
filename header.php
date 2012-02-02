<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-UK"><head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<!--<meta name="description" content="<?php bloginfo('description'); ?>"/>-->
<meta name="verify-v1" content="Qe7in0CQ2oWMRD4WrlxJoOZE31KbTyoS1IDZ8HFyddo=" />
<!--meta property="fb:page_id" content="222918941100931" /-->

<!--

<meta property="og:title" content="<?php if(is_home()){  bloginfo('name'); ?>: <? bloginfo('description');   } else { wp_title('', true, 'right'); ?> on <?  bloginfo('name'); } ?>" />
<meta property="og:type" content="<? if( is_singular('product')){?>blog<? } else { ?>blog<? } ?>" />
<meta property="og:url" content="<?php $Path=$_SERVER['REQUEST_URI']; echo 'http://itsastitchup.co.uk'.$Path; ?>" />
<meta property="og:site_name" content="It&#039;s a Stitch Up" />
<meta property="fb:app_id" content="16081005373" /> -->
<!--meta property="og:image" content="http://farm3.static.flickr.com/2732/4259620371_c5bdd3920e.jpg" / -->


<link rel="shortcut icon" href="favicon.ico" />

<title><?php wp_title(': ', true, 'right'); ?><?php bloginfo('name'); ?>:  <?php bloginfo('description'); ?></title>

<script type="text/javascript" src="/js/jquery-latest.min.js"></script>
<script type="text/javascript" src="/js/utils.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/flickr-products.js"></script>
<script src="http://js.ravelry.com/cart/2.0.js?callback=OnRavelryCart" type="text/javascript"></script>
	

<? if( is_author() && !is_supported_mobile() ){ ?>
<script type="text/javascript" src="/js/ravelrything.js"></script>
<script type="text/javascript" src="http://api.ravelry.com/projects/suziesparkle/progress.json?callback=RavelryThing.progressReceived&amp;key=1b4970b828374fe99bf3974068a0b876db40cb53&amp;version=0"></script>

<? } ?>

<? if (is_supported_mobile()){ 

// stick some device specific stylesheets in here
// create a generic mobile stylesheet then modify it for specific devices
?>

<!--#if expr="$HTTP_USER_AGENT = /iPhone/" -->
<!-- iphone stuff -->
<!--#elif expr="$HTTP_USER_AGENT = /iPod/" -->
<!-- iPod stuff -->
<!--#else -->
<!-- Other -->
<!--#endif -->

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/mobile.css" type="text/css"  />

<? } else {  ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"  />

<? } // end if mobile ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" type="image/png" href="/favicon.ico" />

<?php wp_head(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-205378-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=16081005373";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 

<? if (!is_supported_mobile()){ // non mobile ?>
<div id="banner" style="position:absolute; top:1px; left:770px" ><a href="/shop"><img src="<? bloginfo('template_url');?>/images/boutique.png" alt="boutique" /></a></div>
<div id="header"><h1><?php bloginfo('name'); ?></h1>
  <a href="<?php bloginfo('url'); ?>"><img src="/images/logo-lg.gif" width="504" height="70" /></a> </div>
  
  
  <div id="tagline">Adventures in handmade...</div> 
  <? } else { // mobile!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! ?>
  
<h1><a href="<?php bloginfo('url'); ?>"><img src="/images/mobile/logo.gif" width="239" height="35" alt="<?php bloginfo('name'); ?>" /></a></h1>


<ul id="navigation">
<li <? if (is_home()) { ?> id="current" <? }?>><a href="<?php bloginfo('url'); ?>"><span>Latest</span></a></li>

<li
 <? if (is_category('5') || ( in_category('5') && ! is_date() && !is_home() && !in_child_category('5') && !is_page() )){ 
 	?> id="current" <? } ?>><a href="<?php echo get_category_link(5);?>"><span>Blog</span></a>
 </li>
 
 
<li <? if (is_category('3') || (in_category('3') && ! is_date() && !is_home() &&!is_page() && !is_search()) || is_tag() ){ ?> id="current" <? }?>><a href="<?php echo get_category_link(3);?>"><span>Patterns</span></a>
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
  
  <? } // end mobile ?>

