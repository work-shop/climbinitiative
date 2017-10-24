
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<div id="conference-researchers">
	<?php 
	$researchers = get_field('conf_researchers', $conference_id ); 
	foreach( $researchers as $person ):
		$person_id = $person->ID; 
		$person_slug = $person->post_name
		?>
		<div class="researcher col-xs-4 modal-toggle" data-modal-target="modal-<?php echo $person_slug; ?>" id="speaker-<?php echo $person_slug; ?>">
			<?php $image = get_field('image',$person_id); ?>
			<img class="speaker-image" src="<?php echo $image['url']; ?>" alt="Photo of <?php echo get_the_title($person_id); ?>">
			<h3 class="white speaker-name"><?php echo get_the_title($person_id); ?></h3>
			<h4 class="white speaker-position"><?php the_field('position',$person_id); ?>, <?php the_field('affiliation',$person_id); ?></h4>
		</div>
		<div class="modal modal-person off scroll" id="modal-<?php echo $person_slug; ?>">
			<div class="modal-body container">	
				<div class="row">
					<div class="col-xs-12">
						<a href="#" class="modal-close modal-close-button"><span class="icon" data-icon="ﬂ"></span></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<?php $image = get_field('image',$person_id); ?>
						<img class="speaker-image" src="<?php echo $image['url']; ?>" alt="Photo of <?php echo get_the_title($person_id); ?>">
						<h3 class="white speaker-name"><?php echo get_the_title($person_id); ?></h3>
						<h4 class="white speaker-position"><?php the_field('position',$person_id); ?>, <?php the_field('affiliation',$person_id); ?></h4>
					</div>
					<div class="col-md-9">
						<div class="speaker-bio"><?php the_field('bio',$person_id); ?></div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>