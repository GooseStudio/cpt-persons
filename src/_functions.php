<?php

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
