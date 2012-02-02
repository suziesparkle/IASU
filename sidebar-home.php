<div id="rightcolumn">	

<? if(is_home() || is_search() || is_date() || is_page()){ ?>
		
			<div class="sidebox printhide">
			<h3>Subscribe			  </h3>
			<ul class="rss">
			  <li><a href="/feed/"><span>All content</span></a></li>
				<li><a href="/knitting-patterns/feed"><span>Just patterns</span></a></li>
				<li><a href="/category/news/feed"><span>Just blog</span></a></li>
				<li><a href="/category/features/feed"><span>Just features</span></a></li>
			  </ul>
              
		  
    
<div class="fb-like-box" data-href="http://www.facebook.com/itsastitchup" data-width="190" data-colorscheme="light" data-show-faces="false" data-border-color="ffffff" data-stream="false" data-header="false" height="90"></div>		
				
    <p><a href="http://www.twitter.com/itsastitchup">@itsastitchup</a> 
     - knit and stitch related tweets </p>
     
  

<span class="bottom">&nbsp;</span>
  </div>
				
		

				
				
				<div class="sidebox printhide"><h3>Patterns by category</h3>
				
			<ul>
			 		<?php wp_list_categories('taxonomy=pattern_category&show_count=1&title_li='); ?> 
			</ul>
			<span class="bottom">&nbsp;</span></div>
			
		<? if(is_home()){ ?>			
					<div class="sidebox printhide">
				<h3>Around the web</h3>
				<ul>
			<?php 
			$args = array(
    'orderby'          => 'rand',
    'order'            => 'ASC',
    'limit'            => 5,
    'category'         => '44',
    'hide_invisible'   => 1,
    'show_updated'     => 0,
    'echo'             => 0,
    'categorize'       => 0,
    'title_li'         => '',
    'category_orderby' => 'name',
    'category_order'   => 'ASC',
    'show_description' => 1,
    'category_before'  => '<li>',
    'category_after'   => '</li>' );
			
			
			$bookmarks = wp_list_bookmarks($args);

//clean up the mess

$bookmarks = preg_replace('/<li[^>]*class="linkcat"[^>]*>/', '', $bookmarks);
$bookmarks = preg_replace('/(<\/ul>\s*)<\/li>/', '$1', $bookmarks);


echo $bookmarks;

 ?>
			</ul><span class="bottom">&nbsp;</span></div>
			
<? } // end if home ?>
			
			
				<div class="sidebox printhide">
		<h3>All entries by date</h3>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<span class="bottom">&nbsp;</span></div>

 	
<? } else if ( (is_category() || is_single()) && (in_category('5') || is_category('5') || in_category(43) || is_category(43)) ){ // blog archive ?>

			<div class="sidebox printhide">
			<h3>Subscribe</h3>
				
				<h4>RSS feeds</h4>
				<ul class="rss">
				<li><a href="/feed/"><span>All content</span></a></li>
				<li><a href="/knitting-patterns/feed"><span>Just patterns</span></a></li>
				<li><a href="/category/blog/feed"><span>Just blog</span></a></li>
				<li><a href="/category/features/feed"><span>Just features</span></a></li>
				</ul>
				<h4>Twitter</h4>
				
    <p>Follow <a href="http://www.twitter.com/itsastitchup">@itsastitchup</a> 
      for knit and stitch related tweets </p>
      
  
				<span class="bottom">&nbsp;</span></div>
				
 		<div class="sidebox printhide">
		<h3>All entries by date</h3>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<span class="bottom">&nbsp;</span></div>
			
<? } else if ( (is_archive('pattern') || is_tax('pattern_category') || is_tax('pattern_garment') || is_tax('pattern_difficulty') || is_tax('pattern_gauge')) ){ // if this is a pattern archive ?>

<? //} else if (is_post_type_archive('pattern')){ // if this is a pattern archive ?>


			<div class="sidebox printhide">
			<h3>Subscribe</h3>
				<ul class="rss">
				
				<li><a href="/feed/"><span>All content</span></a></li>
				<li><a href="/knitting-patterns/feed"><span>Just patterns</span></a></li>

				 </ul>
				<span class="bottom">&nbsp;</span></div>
	
			<div class="sidebox printhide"><h3>Patterns by skill level</h3>
			<ul>
			<li><a href="<?php echo get_term_link(86, 'pattern_difficulty'); ?>">Beginner</a></li>
			<li><a href="<?php echo get_term_link(85, 'pattern_difficulty'); ?>">Easy</a></li>
			<li><a href="<?php echo get_term_link(87, 'pattern_difficulty'); ?>">Intermediate</a></li>
			<!--li><a href="<?php echo get_term_link(99, 'pattern_difficulty'); ?>">Advanced</a></li -->
			 		
			</ul>
			<p><a href="http://www.yarnstandards.com/skill.html">Skill levels explained on Yarn Standards</a></p>
			<span class="bottom">&nbsp;</span></div>

	  
 <?} else { ?>
 
<? }// end if this is a pattern ?>

						
</div>
