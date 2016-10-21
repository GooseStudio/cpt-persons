<?php
use GooseStudio\CPTPersons\Persons;

/**
 * Returns the name of the person post type.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function cpt_persons_get_post_type() {
	return apply_filters( 'cpt_persons_get_post_type', 'cpt-persons' );
}

/**
 * Echoes the persons name.
 */
function cptp_the_id() {
	echo esc_attr( cptp_get_the_id() );
}

/**
 * Retrieves the current persons name.
 *
 * @return string
 */
function cptp_get_the_id() {
	return Persons::current()->ID;
}

/**
 * Echoes the persons name.
 */
function cptp_the_name() {
	echo esc_html( cptp_get_the_name() );
}

/**
 * Retrieves the current persons name.
 *
 * @return string
 */
function cptp_get_the_name() {
	return Persons::current()->post_title;
}

/**
 * Echoes the persons uri.
 */
function cptp_the_permalink() {
	echo esc_url( cptp_get_the_permalink() );
}

/**
 * Retrieves the current persons permalink.
 *
 * @return string
 */
function cptp_get_the_permalink() {
	return get_post_permalink( Persons::current()->ID );
}

/**
 * Echoes the current persons excerpt.
 *
 * @param bool $show_learn_more Displays a learn more link.
 */
function cptp_the_excerpt( $show_learn_more = false ) {
	echo cptp_get_the_excerpt( $show_learn_more );
}

/**
 * Retrieves the current persons excerpt.
 *
 * @param bool $show_learn_more Displays a learn more link.
 *
 * @return string
 */
function cptp_get_the_excerpt( $show_learn_more = false ) {
	$excerpt = Persons::current()->post_excerpt;
	if ( $show_learn_more ) {
		$learn_more_link = sprintf( ' ... <a href="%s">%s</a>',
			esc_url( cptp_get_the_permalink() ),
			esc_html( __( 'Learn more', 'cpt-persons' ) )
		);
		$excerpt .= apply_filters( 'cpt_persons_excerpt_more', $learn_more_link, Persons::current() );
	}

	return apply_filters( 'the_content', $excerpt );
}

/**
 * Echoes the current persons description.
 *
 */
function cptp_the_description() {
	echo cptp_get_the_description();
}

/**
 * Retrieves the current persons description.
 *
 * @return string
 */
function cptp_get_the_description() {
	return apply_filters( 'the_content', Persons::current()->post_content );
}

/**
 * Echoes the current persons description.
 *
 */
function cptp_the_portrait() {
	echo cptp_get_the_portrait();
}

/**
 * Retrieves the current persons description.
 *
 * @return string
 */
function cptp_get_the_portrait() {
	return get_the_post_thumbnail( Persons::current(), 'thumb' );
}
