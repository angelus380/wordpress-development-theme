<?php if ( ! defined( 'ABSPATH' )) exit; // Exit if accessed directly ?>

<?php

# get page globals
global $page_type;
global $page_count;

# globals for load-more button
# paste this on page for load more to work
// global $page_type;
// get_page_count(); # custom function @ functions.php
// $page_type = get_post_type( $id ); # custom function @ functions.php ?>

<div id="more" title="load more" data-page="1"
	data-type="<?php echo $page_type; ?>"
	data-count="<?php echo $page_count; ?>" >
		Load More
</div>