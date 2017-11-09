<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php
if ( !is_single() ) {
	echo '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
}
else {
	echo '<h2>'.get_the_title().'</h2>';
}
the_content();
?>