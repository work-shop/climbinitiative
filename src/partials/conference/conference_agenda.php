
<?php 
$conference = get_field('current_conference'); 
$conference_id = $conference[0]->ID;
?>

<section class="block spy-target pt7 pb7 vhmin100" id="conference-agenda">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-xl-3">
				<h3 class="white conference-heading">
					Agenda<br>
				</h3>
			</div>
			<div class="col-md-10 col-xl-7">
				<div id="agenda">	
					
					<?php 
					if( have_rows('conf_single_day_agenda', $conference_id ) ):
						while( have_rows('conf_single_day_agenda', $conference_id ) ): the_row(); ?>

						<div class="row agenda-item">
							<div class="col-sm-3 agenda-left">
								<h4 class="white agenda-item-time">
									<?php the_sub_field('conf_agenda_item_time'); ?>
								</h4>
								<h5 class="white agenda-item-location">
									<?php the_sub_field('conf_agenda_item_location'); ?>
								</h5>
							</div>
							<div class="col-sm-8 offset-sm-1 agenda-right">
								<h3 class="white agenda-item-title">
									<?php the_sub_field('conf_agenda_item_title'); ?>
								</h3>
								
								<?php if( get_sub_field('conf_agenda_item_participants') ): ?>
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
									</div>
								
								<?php endif;?>
							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
</section>