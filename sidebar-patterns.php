	<div id="rightcolumn">
		
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			<div class="rightbox"><h3>Patterns by category</h3>
			<ul>
			 		<?php wp_list_categories('child_of=3&show_count=1&title_li='); ?> 
			</ul>
			<span class="bottom">&nbsp;</span></div>
			
			
				
			<div class="rightbox">
			<h3>Archives</h3>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<span class="bottom">&nbsp;</span></div>
				
				

		
	</div>

