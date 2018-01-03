<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width" >
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/logo.png" rel="apple-touch-icon-precomposed">

  <meta property="og:title" content="<?php bloginfo( 'name' ); ?>" />
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo get_permalink(); ?>" />
  <meta property="og:image" content="<?php echo get_template_directory_uri().'/screenshot.png';?>"/>

	<title><?php bloginfo( 'name' ) ?></title>
	
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>