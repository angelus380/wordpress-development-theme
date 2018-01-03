<?php if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

#-----------------#
# LIST OF STYLES  #
#-----------------#

function get_css_files() {

	# CORE
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.css' );	
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css' );

}
add_action( 'wp_enqueue_scripts', 'get_css_files' );

#------------------#
# LIST OF SCRIPTS  #
#------------------#

function get_js_files() {

	# CORE
	wp_enqueue_script( 'jquery', array(), null, true );
	wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/vendor/popper/popper.js', array(), null, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.js', array(), null, true );
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'get_js_files' );

#-------------------#
# CUSTOM POST TYPES #
#-------------------#

# generate arguments for custom post type creation
function p_args( $singular, $plural, $archive = true, $no_search = false ) {
  return array( 
    'labels'                => array( 
      'name'                => $plural,
      'singular_name'       => $singular,
      'menu_name'           => $plural,
      'all_items'           => 'Ver'.' '.$plural,
      'add_new_item'        => 'Adicionar'.' '.$singular,
      'add_new'             => 'Adicionar',
      'new_item'            => 'Adicionar'.' '.$singular,
      'edit_item'           => 'Editar'.' '.$singular,
      'update_item'         => 'Actualizar'.' '.$singular,
      'view_item'           => 'Visualizar'.' '.$singular,
      'view_items'          => 'Visualizar'.' '.$singular,
      'search_items'        => 'Pesquisar'.' '.$singular,
      'not_found'           => 'Não exitem'.' '.$plural,
      'not_found_in_trash'  => 'Não exitem'.' '.$plural,
    ),
    'public'                => true,
    'hierarchical'          => false,
    'has_archive'           => $archive,        # false to remove from archive page
    'exclude_from_search'   => $no_search,      # true to remove from search
  );
}

# creates custom post types
function create_post_type() {
 
  register_post_type( 'pilots', p_args( 'Piloto', 'Pilotos' ) );
  register_post_type( 'events', p_args( 'Evento', 'Eventos', false ) );
  register_post_type( 'researcher', p_args( 'Investigador', 'Investigadores', false, true ) );

}
// add_action( 'init', 'create_post_type' );

#-----------------#
# CUSTOM TAXONOMY #
#-----------------#

# generate simple arguments for taxonomy creation
function c_args( $singular, $plural, $rewrite = null ) {
  return array( 
    'labels'          => array( 
      'name'          => $plural,
      'singular_name' => $singular,
      'menu_name'     => $plural,
      'add_new_item'  => 'Adicionar',
      'add_new'       => 'Adicionar',
      'new_item'      => 'Adicionar'.' '.$singular,
      'edit_item'     => 'Editar'.' '.$singular,
      'update_item'   => 'Actualizar'.' '.$singular,
      'view_item'     => 'Visualizar'.' '.$singular,
      'view_items'    => 'Visualizar'.' '.$singular,
      'search_items'  => 'Pesquisar'.' '.$singular,
      'not_found'     => 'Não exitem'.' '.$plural,
    ),
    'public'          => true,
    'hierarchical'    => true,
    'query_var'       => true,
    'rewrite'         => array( 'slug' => $rewrite, 'with_front' => false ),
  );
}

# creates taxonomies
function create_new_taxonomy() {

  register_taxonomy( 'noticias-cat', 'noticias', c_args( 'Categoria', 'Categorias' ) );

}
// add_action( 'init', 'create_new_taxonomy', 0 );

#---------------------#
# DASHBOARD SEPARATOR #
#---------------------#

# create new separator
function create_separator() {

  global $menu;

  $menu[ $position ] = array( 
    0 => '',
    1 => 'read',
    2 => 'separator3' . $position,
    3 => '',
    4 => 'wp-menu-separator',
  );

}
// add_action( 'admin_init', 'create_separator' );

# set separator
function set_admin_menu_separator() {

  do_action( 'admin_init', 79 );

}
// add_action( 'admin_menu', 'set_admin_menu_separator' );

#--------------------------#
# DASHBOARD MENU POSITIONS #
#--------------------------#

function reorder_admin_menu( $__return_true ) {

  return array( 
   'index.php', # Dashboard
   'edit.php?post_type=page', # Page
   'edit.php?post_type=pilots', # Pilots
   'edit.php?post_type=activities', # Activities

   'separator1', # --Space--

   'edit.php?post_type=events', # Events
   'edit.php?post_type=news', # News
   'edit.php?post_type=opportunities', # Opportunities
   'edit.php?post_type=publications', # Publications

   'separator2', # --Space--

   'edit.php?post_type=institution', # Institutions
   'edit.php?post_type=researcher', # Researchers
   'edit.php?post_type=map', # Map

   'separator3', # --Space--

   'edit.php', # Posts
   'upload.php', # Media
   'themes.php', # Appearance
   'edit-comments.php', # Comments
   'users.php', # Users
   'plugins.php', # Plugins
   'tools.php', # Tools
   'options-general.php', # Settings
 );

}
// add_filter( 'custom_menu_order', 'reorder_admin_menu', 99 );
// add_filter( 'menu_order', 'reorder_admin_menu', 99 );

#------------------------#
# REMOVE DASHBOARD ITEMS #
#------------------------#

function remove_menu_items() {

  remove_menu_page( 'edit.php' ); # posts page
  remove_menu_page( 'themes.php' ); # theme selection
  remove_menu_page( 'plugins.php' ); # plugins selection
  remove_menu_page( 'edit-comments.php' ); # comments page
  remove_menu_page( 'users.php' ); # users page
  remove_menu_page( 'options-general.php' ); # options page
  remove_menu_page( 'ms-delete-site.php' ); # delete website
  remove_menu_page( 'mlang' ); # polylang page
  remove_menu_page( 'edit.php?post_type=acf-field-group' ); # acf page

}
// add_action( 'admin_menu', 'remove_menu_items' );

#------------------#
# REMOVE METABOXES #
#------------------#

function remove_metaboxes() {

  remove_meta_box( 'new-catdiv', 'news', 'advanced' );
  remove_meta_box( 'publ-catdiv', 'publications', 'advanced' );
  remove_meta_box( 'opp-catdiv', 'opportunities', 'advanced' );
  remove_meta_box( 'event-catdiv', 'events', 'advanced' );
  remove_meta_box( 'act-catdiv', 'activities', 'advanced' );
  remove_meta_box( 'regionsdiv', 'pilots', 'advanced' );
  remove_meta_box( 'regionsdiv', 'activities', 'advanced' );
  remove_meta_box( 'craftsdiv', 'activities', 'advanced' );

}
// add_action( 'admin_menu', 'remove_metaboxes' );

#--------------------------#
# REMOVE DASHBOARD WIDGETS #
#--------------------------#

function remove_dashboard_widgets() {

  remove_action('welcome_panel', 'wp_welcome_panel'); # welcome panel
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); # wordpress events and news
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); # quick draft
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); # at a glance
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); # activity
  # remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); # recent drafts
  # remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); # recent comments

}
// add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

#--------------------------#
# CUSTOM DASHBOARD WIDGETS #
#--------------------------#

# post type widgets
function pilots_widget() {
  create_post_widget( 'activities' );
}

# generate post type widgets
function create_post_widget( $post_type ) { # GENERATES A POST TYPE LOOP
  global $post;
  
  echo '<ol>';

  $myposts = get_posts( array(
    'numberposts' => 5,
    'order'       => 'DSC',
    'post_type'   => $post_type
  ));
  
  foreach( $myposts as $post ) {
    setup_postdata($post);
    echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
  }

  echo '</ol>';
}

# add widgets to dashboard
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;

	# ADD WIDGETS HERE
	wp_add_dashboard_widget( 'activities_widget', 'Activitdades', 'activities_widget' );

}
// add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

#----------------#
# CUSTOM QUERIES #
#----------------#

# pilots query
function pilots_query() {
  global $wp_query;

  if ( is_post_type_archive( 'pilots' ) and $wp_query->is_main_query() ) {
    $wp_query->set( 'posts_per_page', -1 );
    $wp_query->set( 'order', 'ASC' );
    $wp_query->set( 'orderby', 'meta_value_num' );
		$wp_query->set( 'meta_key', 'categories' );
  }
}
// add_action( 'pre_get_posts', 'pilots_query' );

# search query
function search_query( $query ) {

  if ( $query->is_search && !is_admin() ) {
    $query->set( 'post_type', array( 'activities', 'pilots', 'events', 'news', 'publications', 'opportunities', ) );
    $query->set( 'posts_per_page', -1 );
    $query->set( 'order', 'DSC' );
  }

  return $query;
}
// add_filter( 'pre_get_posts', 'search_custom_query' );

#-----------------#
# LOAD MORE POSTS #
#-----------------#

# set values into the HTML code
function ajax_assets() {
  global $wp_query;

  wp_localize_script( 'core-js', 'loadmore', array( 
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'query_vars' => json_encode( $wp_query->query_vars ),
  ) );

}
// add_action( 'wp_enqueue_scripts', 'ajax_assets' );

# counts max number of pages in post type
function get_page_count() {
  global $wp_query;
  global $page_count;

  $page_count = $wp_query->max_num_pages;
}

# function for loading more posts
function load_more() {

  $query_vars           = json_decode( stripslashes( $_POST['query_vars'] ), true );
  $query_vars['paged']  = $_POST['page']; # set the next page to load
  $type                 = $_POST['type'];
  $posts                = new WP_Query( $query_vars );
  $GLOBALS['wp_query']  = $posts;

  switch ( $type ) :

    case 'events' :
      get_template_part( 'template_parts/loops/events' );
      break;
    
    case 'news' :
    case 'opportunities' :
      get_template_part( 'template_parts/loops/posts' );
      break;
    
    case 'publications' :
      get_template_part( 'template_parts/loops/publications' );
      break;

  endswitch;
  die();

}
// add_action( 'wp_ajax_nopriv_load_more', 'load_more' );
// add_action( 'wp_ajax_load_more', 'load_more' );

#-------------------#
# CHECK USER DEVICE #
#-------------------#

# return false if is ipad or tablet
function is_mobile() {

  $server    = $_SERVER['HTTP_USER_AGENT'];
	$ipod    	 = stripos( $server, 'ipod' );
	$iphone  	 = stripos( $server, 'iphone' );
	$ipad    	 = stripos( $server, 'ipad' );
	$android 	 = stripos( $server, 'android' );
	$webOS   	 = stripos( $server, 'webOS' );
  $tablet 	 = stripos( $server, 'tablet' );
  $not_empty = !empty( $server );

  # return false if is ipad
  if ( $not_empty && false !== $ipad ) :
    return false;
  
  # return false if is tablet
  elseif ( $not_empty && false !== $tablet ) :
    return false;

  else :
    return wp_is_mobile();

  endif;
}

#----------------#
# ACF GOOGLE MAP #
#----------------#

function my_acf_init() {
  acf_update_setting( 'google_api_key', 'AIzaSyCENK52GYrNSNWWc1KlqSbHtIK4KVbCHt0' );
}
// add_action( 'acf/init', 'my_acf_init' );

?>