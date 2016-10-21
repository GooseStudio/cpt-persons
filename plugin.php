<?php
/*
Plugin Name: CPT Persons
Plugin URI:  http://goose.studio/plugins/cpt-persons
Description: Adds a new Custom Post Type called Persons for adding and displaying persons on your site.
Version:     0.1
Author:      Andreas Nurb
Author URI:  http://goose.studio
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: cpt-persons
*/
define( 'CPT_PERSONS_PLUGIN_DIR', __FILE__ );
include 'src/_functions.php';
include 'src/class-persons-post-type.php';
( new \GooseStudio\CPTPersons\Persons_PostType() )->init();
if ( is_admin() ) {
	include 'src/class-persons-ui.php';
	( new \GooseStudio\CPTPersons\Persons_UI() )->init();
}

register_activation_hook( __FILE__, function () {
	$role = get_role( 'administrator' );
	if ( ! is_null( $role ) ) {
		$capabilities = array(
			'edit_post'          => 'edit_person',
			'read_post'          => 'read_person',
			'delete_post'        => 'delete_person',
			'delete_posts'        => 'delete_persons',
			'edit_posts'         => 'edit_persons',
			'edit_others_posts'  => 'edit_others_persons',
			'publish_posts'      => 'publish_persons',
			'read_private_posts' => 'read_private_persons',
		);
		array_walk( $capabilities, function ( $cap ) use ( $role ) {
			$role->add_cap( $cap );
		} );
	}
});
