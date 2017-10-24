
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<section class="block spy-target pt4 pb4" id="speakers">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<h3 class="white conference-heading">
					Speakers
				</h3>
			</div>
			<div class="col-md-9 col-sm-12">
				<?php get_template_part('partials/conference/speakers_module'); ?>
			</div>
		</div>
	</div>
</section>