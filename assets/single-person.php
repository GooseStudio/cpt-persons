<?php
/**
 * The template for a single person.
 *
 * @package cpt-persons
 */

?>
<article id="cpt-person-<?php cptp_the_id() ?>" class="cpt-person-single">
	<header>
		<h3 class="cpt-person-name"><?php cptp_the_name() ?></h3>
	</header>
	<div class="cpt-person-portrait">
		<?php cptp_the_portrait() ?>
	</div>
	<section class="cpt-person-description">
		<?php cptp_the_description(); ?>
	</section>
	<footer>
	<?php do_action( 'cpt_person_single_footer' ) ?>
	</footer>
</article>
