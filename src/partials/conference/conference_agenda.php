
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<section class="block spy-target pt8 p48 vhmin100" id="agenda">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-12">
				<h3 class="white conference-heading">
					Agenda				
				</h3>
			</div>
			<div class="col-md-10 col-sm-12">
				<?php get_template_part('partials/conference/agenda_module'); ?>
			</div>
		</div>
	</div>
</section>