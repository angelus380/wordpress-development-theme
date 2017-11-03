<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>


<?php get_header(); ?>

<h1>Headline</h1>

<?php 

if (have_posts()) : while (have_posts()) : the_post();

	echo '<h2>'.get_the_title().'</h2>';
	the_content();

endwhile; endif;

?>

<?php get_footer(); ?>