<?php
/*
Plugin Name: CPT Persons
Plugin URI:  http://goose.studio/plugins/cpt-persons
Description: Adds a new Custom Post Type called Persons for adding and displaying persons on your site.
Version:     0.1
Author:      Andreas Nurb
Author URI:  http://goose.studio
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: cpt-persons
*/

include 'src/class-cpt-persons.php';
(new \GooseStudio\CPTPersons\CPT_Persons())->init();
