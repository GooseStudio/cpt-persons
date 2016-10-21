<?php
namespace GooseStudio\CPTPersons;

/**
 * Class Persons
 * @package GooseStudio\CPTPersons
 */
class Persons {

	/**
	 * The current person post object.
	 *
	 * @var \WP_Post
	 */
	public static $current_person = null;

	/**
	 * Retrieve the post object
	 *
	 * @param int|string $identifier The post to retrieve.
	 * @param string     $by What to use to retrieve; id, slug or name.
	 *
	 * @return mixed|\WP_Post
	 */
	public static function get_by( $identifier, $by = 'slug' ) {
		switch ( $by ) {
			case 'id':
				$query_params = array( 'p' => intval( $identifier ) );
				break;
			case 'name':
				$query_params = array( 'title' => $identifier );
				break;
			case 'slug':
			default:
				$query_params = array( 'pagename' => $identifier );
				break;
		}
		$query_params         = array_merge( $query_params, array(
			'posts_per_page' => 1,
			'post_type'      => cpt_persons_get_post_type(),
		) );
		$query                = new \WP_Query( $query_params );
		$post                 = $query->get_posts();
		self::$current_person = array_pop( $post );

		return self::$current_person;
	}

	/**
	 * Get the current person object.
	 *
	 * @return \WP_Post The current person if query been run.
	 */
	public static function current() {
		return self::$current_person;
	}

	/**
	 * Retrieves all published persons.
	 *
	 * @param int $limit Limit results.
	 *
	 * @return \WP_Query
	 */
	public static function find_published( $limit = -1 ) {
		$query_params = array();
		$query_params         = array_merge( $query_params, array(
			'posts_per_page' => $limit,
			'post_type'      => cpt_persons_get_post_type(),
		) );
		$query = new \WP_Query( $query_params );
		return $query;
	}
}
