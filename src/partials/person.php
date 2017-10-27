<?php global $post;
$person_slug=$post->post_name; ?>

<div class="person col-xs-4 modal-toggle" data-modal-target="modal-person-<?php echo $person_slug; ?>" id="researcher-<?php echo $person_slug; ?>">
	<?php $image = get_field('image'); ?>
	<img class="speaker-image" src="<?php echo $image['url']; ?>" alt="Photo of <?php echo get_the_title($person_id); ?>">
	<h3 class="white speaker-name"><?php the_title(); ?></h3>
	<h4 class="white speaker-position"><?php the_field('position'); ?>, <?php the_field('affiliation'); ?></h4>
</div>
<div class="modal modal-person off scroll" id="modal-person-<?php echo $person_slug; ?>">
	<div class="modal-body container">	
		<div class="row">
			<div class="col-xs-12">
				<a href="#" class="modal-close modal-close-button"><span class="icon" data-icon="ﬂ"></span></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php $image = get_field('image'); ?>
				<img class="speaker-image" src="<?php echo $image['url']; ?>" alt="Photo of <?php the_title(); ?>">
				<h3 class="white speaker-name"><?php the_title(); ?></h3>
				<h4 class="white speaker-position"><?php the_field('position'); ?>, <?php the_field('affiliation'); ?></h4>
			</div>
			<div class="col-md-9">
				<div class="speaker-bio"><?php the_field('bio'); ?></div>
			</div>
		</div>
	</div>
</div>