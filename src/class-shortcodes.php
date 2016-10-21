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
		$attributes = array_intersect_key( $attributes, array( 'id' => '', 'slug' => '', 'name' => '' ) );
		$by = '';
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