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
