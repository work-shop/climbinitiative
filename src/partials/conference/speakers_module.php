
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<div id="conference-speakers">
	<?php 
	$speakers = get_field('conf_speakers', $conference_id ); 
	foreach( $speakers as $speaker ):
		$speaker_id = $speaker->ID; 
		$speaker_slug = $speaker->post_name
		?>
		<div class="speaker modal-toggle" data-modal-target="modal-<?php echo $speaker_slug; ?>" id="speaker-<?php echo $speaker_slug; ?>">
			<h3 class="white speaker-name"><?php echo get_the_title($speaker_id); ?></h3>
			<h4 class="white speaker-position"><?php the_field('position',$speaker_id); ?>, <?php the_field('affiliation',$speaker_id); ?></h4>
		</div>
		<div class="modal modal-speaker off scroll" id="modal-<?php echo $speaker_slug; ?>">
			<div class="modal-body container">	
				<div class="row">
					<div class="col-xs-12">
						<a href="#" class="modal-close modal-close-button"><span class="icon" data-icon="ﬂ"></span></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<?php $image = get_field('image',$speaker_id); ?>
						<img class="speaker-image" src="<?php echo $image['url']; ?>" alt="Photo of <?php echo get_the_title($speaker_id); ?>">
						<h3 class="white speaker-name"><?php echo get_the_title($speaker_id); ?></h3>
						<h4 class="white speaker-position"><?php the_field('position',$speaker_id); ?>, <?php the_field('affiliation',$speaker_id); ?></h4>
					</div>
					<div class="col-md-9">
						<div class="speaker-bio"><?php the_field('bio',$speaker_id); ?></div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>