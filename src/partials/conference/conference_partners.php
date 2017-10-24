
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<section class="block spy-target pt4 pb4 vhmin60" id="partners">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<h3 class="white conference-heading">
					Partners
				</h3>
			</div>
			<div class="col-md-9 col-sm-12">
				<?php get_template_part('partials/conference/partners_module'); ?>
			</div>
		</div>
	</div>
</section>