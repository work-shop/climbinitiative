
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<section class="block spy-target pt4 pb8 vhmin70" id="live-stream">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<h3 class="white conference-heading">
					Live Stream
				</h3>
			</div>
			<div class="col-md-9 col-sm-12">
                <p class="white">Thank you for your interest in the conference. The event is over, but check back soon for videos of the sessions!</p>
				<?php // the_field('conf_live_stream', $conference_id); ?>
			</div>
		</div>
	</div>
</section>
