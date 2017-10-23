
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<div id="conference-agenda">	

	<?php 
	if( have_rows('conf_single_day_agenda', $conference_id ) ):
		while( have_rows('conf_single_day_agenda', $conference_id ) ): the_row(); ?>

		<div class="row agenda-item">
			<div class="col-xs-4 col-sm-3 agenda-left">
				<h4 class="white agenda-item-time">
					<?php the_sub_field('conf_agenda_item_time'); ?>
				</h4>
				<h5 class="white agenda-item-location">
					<?php the_sub_field('conf_agenda_item_location'); ?>
				</h5>
			</div>
			<div class="col-xs-8 col-sm-8 offset-sm-1 agenda-right">
				<h3 class="white agenda-item-title <?php if( get_sub_field('conf_agenda_item_location') ): echo 'has-location'; endif; ?>">
					<?php the_sub_field('conf_agenda_item_title'); ?>
				</h3>

				<?php if( get_sub_field('conf_agenda_item_participants') || get_sub_field('conf_agenda_item_moderator') ): ?>
					<div class="agenda-item-participants">
						<?php
						$participants = get_sub_field('conf_agenda_item_participants');
						foreach( $participants as $participant ):
							$participant_id = $participant->ID; ?>
							<div class="agenda-item-participant">
								<h4 class="white">
									<?php echo get_the_title($participant_id); ?>, 
									<span class="affiliation"><?php the_field('affiliation' ,$participant_id); ?></span>
								</h4>
							</div>
						<?php endforeach; ?>

						<?php if( get_sub_field('conf_agenda_item_moderator') ): ?>
							<div class="agenda-item-participant agenda-item-moderator">
								<h4 class="white">
									Moderated by 
									<?php $moderator_id = get_sub_field('conf_agenda_item_moderator')[0]->ID; ?>
									<?php echo get_the_title($moderator_id); ?>, 
									<span class="affiliation"><?php the_field('affiliation' ,$moderator_id); ?></span>
								</h4>
							</div>
						<?php endif;?>	

					</div>
				<?php endif;?>

			</div>
		</div>

	<?php endwhile; ?>
<?php endif; ?>

</div>