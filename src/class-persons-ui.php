<?php
namespace GooseStudio\CPTPersons;


/**
 * Class Persons_UI
 *
 * @package GooseStudio\CPTPersons
 */
class Persons_UI {

	/**
	 * Sets up the needed actions.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function init() {
		add_action( 'load-edit.php', array( $this, 'load' ) );
		add_filter( 'enter_title_here', array( $this, 'enter_title_here' ), 10, 2 );
	}

	/**
	 * Setups filters and actions
	 */
	public function load() {
		$post_type = cpt_persons_get_post_type();
		add_filter( "manage_edit-{$post_type}_columns", array( $this, 'columns' ) );
		add_action( "manage_{$post_type}_posts_custom_column", array( $this, 'custom_column' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_css' ) );
	}

	/**
	 * Loads the css
	 *
	 * @param string $hook The hook running.
	 */
	public function load_css( $hook ) {
		$post_type = get_query_var( 'post_type' );
		if ( 'edit.php' === $hook && 'cpt-persons' === $post_type ) {
			wp_enqueue_style( 'cpt-persons-admin-css', plugin_dir_url( CPT_PERSONS_PLUGIN_DIR ) . '/assets/css/admin.css' );
		}
	}

	/**
	 * Sets up custom columns on the projects edit screen.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param  array $columns The columns for the table header row.
	 *
	 * @return array
	 */
	public function columns( $columns ) {

		$new_columns = array(
			'cb'        => $columns['cb'],
			'thumbnail' => __( 'Thumbnail', 'cpt-persons' ),
			'title'     => __( 'Name', 'cpt-persons' ),
		);

		$columns = array_merge( $new_columns, $columns );
		unset( $columns['date'] );
		$columns['title'] = $new_columns['title'];

		return $columns;
	}

	/**
	 * Displays the content of persons columns on the edit screen.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param  string $column Id of the column.
	 *
	 * @return void
	 */
	public function custom_column( $column ) {
		if ( 'thumbnail' === $column ) {
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( array( 75, 75 ) );
			} elseif ( function_exists( 'get_the_image' ) ) {
				get_the_image( array( 'scan' => true, 'width' => 75, 'link' => false ) );
			}
		}
	}

	/**
	 * Returns placeholder title text
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $title The text to display on new/edit persons page as title.
	 * @param object|\WP_Post $post The current post.
	 *
	 * @return string
	 */
	public function enter_title_here( $title, $post ) {
		return cpt_persons_get_post_type() === $post->post_type ? esc_html__( 'Enter name', 'cpt-persons' ) : $title;
	}
}
