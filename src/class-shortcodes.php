<?php
namespace GooseStudio\CPTPersons;

/**
 * Class Shortcodes
 *
 * @package GooseStudio\CPTPersons
 */
class Shortcodes {

	/**
	 * Initiates shortcodes.
	 */
	public function init() {
		add_shortcode( 'person', array( $this, 'render_single_person' ) );
	}

	/**
	 * Render a single person short code
	 *
	 * @param array $attributes Attributes for the shortcode.
	 *
	 * @return string
	 */
	public function render_single_person( $attributes ) {
		wp_enqueue_style( 'cpt-persons-frontend-css', plugin_dir_url( CPT_PERSONS_PLUGIN_FILE ) . '/assets/css/frontend.css' );
		$attributes = shortcode_atts( array(
			'id'      => '',
			'slug'    => '',
			'name'    => '',
			'link'    => false,
			'display' => 'row',
			'excerpt' => true,
		), $attributes, 'person' );
		$by         = '';
		$identifier = '';
		if ( isset( $attributes['id'] ) ) {
			$by         = 'id';
			$identifier = $attributes['id'];
		} elseif ( isset( $attributes['slug'] ) ) {
			$by         = 'slug';
			$identifier = $attributes['slug'];
		} elseif ( isset( $attributes['name'] ) ) {
			$by         = 'name';
			$identifier = $attributes['name'];
		}
		$use_link = boolval( $attributes['link'] );
		$display_excerpt = boolval( $attributes['excerpt'] );
		$display  = in_array( $attributes['display'], array( 'row', 'block' ), true ) ? $attributes['display'] : 'row';

		if ( '' !== $by ) {
			$person = Persons::get_post_by( $identifier, $by );
			ob_start();
			include plugin_dir_path( CPT_PERSONS_PLUGIN_FILE ) . '/assets/single-person.php';
			$template = ob_get_contents();
			ob_end_clean();
		} else {
			$template = 'Missing shortcode attributes.';
		}

		return $template;
	}
}
