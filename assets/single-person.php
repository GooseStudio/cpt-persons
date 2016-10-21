<?php
/**
 * The template for a single person.
 *
 * @package cpt-persons
 *
 * @var bool $use_link If to use person link or not.
 * @var bool $display_excerpt If to display excerpt or not..
 * @var string $display How to display the person area.
 */

?>
<article id="cpt-person-<?php cptp_the_id() ?>" class="cpt-person-single <?php echo esc_attr( $display ) ?>">
	<header>
		<h3 class="cpt-person-name">
			<?php if ( $use_link ) : ?>
				<?php printf( '<a href="%s">%s</a>', esc_url( cptp_get_the_permalink() ), esc_html( cptp_get_the_name() ) ) ?>
			<?php else : ?>
				<?php cptp_the_name() ?>
			<?php endif ?>
		</h3>
	</header>
	<div class="cpt-person-portrait">
		<?php if ( $use_link ) : ?>
			<?php printf( '<a href="%s">%s</a>', esc_url( cptp_get_the_permalink() ), cptp_get_the_portrait() ) ?>
		<?php else : ?>
			<?php cptp_the_portrait() ?>
		<?php endif ?>
	</div>
	<?php if ( $display_excerpt ) : ?>
		<section class="cpt-person-excerpt">
			<?php cptp_the_excerpt($use_link); ?>
		</section>
	<?php else : ?>
		<section class="cpt-person-description">
			<?php cptp_the_description(); ?>
		</section>
	<?php endif ?>
	<footer>
		<?php do_action( 'cpt_person_single_footer' ) ?>
	</footer>
</article>
