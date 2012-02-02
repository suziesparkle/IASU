<div class="sidebox">
<h3>Site search</h3>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<label class="hidden" for="s" title="search for:">
<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="textinput" /></label>
<input type="submit" id="searchsubmit" value="search" class="button" />

</form>
<span class="bottom">&nbsp;</span></div>