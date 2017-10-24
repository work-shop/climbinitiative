
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<section class="block spy-target pt4 pb4 vhmin80" id="researchers">
	<div class="container researchers-container">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<h3 class="white conference-heading">
					Researchers
				</h3>
			</div>
			<div class="col-md-9 col-sm-12">
				<?php get_template_part('partials/conference/researchers_module'); ?>
			</div>
		</div>
	</div>
</section>