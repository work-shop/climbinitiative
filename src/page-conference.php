<?php get_template_part('partials/header'); ?>

<?php 
	$conference = get_field('current_conference'); 
	$conference_id = $conference[0]->ID;
?>

<?php get_template_part('partials/home/home_preview'); ?>

<?php get_template_part('partials/conference/conference_agenda'); ?>

<?php get_template_part('partials/conference/conference_speakers'); ?>

<?php get_template_part('partials/conference/conference_researchers'); ?>

<?php get_template_part('partials/conference/conference_live_stream'); ?>

<?php get_template_part('partials/footer'); ?>
