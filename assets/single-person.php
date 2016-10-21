<?php
/**
 * The template for a single person.
 *
 * @package cpt-persons
 */

?>
<article>
	<header>
	<h3><?php cptp_the_name() ?></h3>
		<?php cptp_the_portrait() ?>
	</header>
	<section>
		<?php cptp_the_description(); ?>
	</section>
</article>
