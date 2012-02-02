	<div id="rightcolumn">
	
	<? if 	(is_page('19')){
	
	?>
<div  class="sidebox" >
<h3>What's knitting</h3>

</div>

<?
} // end if is about page
?>

<?php echo nzshpcrt_shopping_basket(); ?>
						
			<div class="sidebox"><h3>Patterns by skill level</h3>
			<ul>
			<li><a href="<?php echo get_tag_link(25); ?>">Beginner</a></li>
			<li><a href="<?php echo get_tag_link(18); ?>">Easy</a></li>
			<li><a href="<?php echo get_tag_link(19); ?>">Intermediate</a></li>
			<!--li><a href="<?php echo get_tag_link(20); ?>">Advanced</a></li -->
			 		
			</ul>
			<p><a href="http://www.yarnstandards.com/skill.html">Skill levels explained on Yarn Standards</a></p>
			<span class="bottom">&nbsp;</span></div>
		
			
<? if(!is_page()){ ?>

			<div class="sidebox">
			<h3>All entries by date</h3>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<span class="bottom">&nbsp;</span></div>	
	
<? } ?>
</div>
