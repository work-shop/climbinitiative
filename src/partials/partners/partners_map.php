
<section class="block spy-target vhm100 pt7 pb7" id="partners-map">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-xs-6">
				<div class="border-box">
					<h1 class="white mb1">
						<?php the_field('page_heading', '84'); ?>
					</h1>
					<h4 class="white border-box-text mb2">
						<?php the_field('page_introduction', '84'); ?>
					</h4>
					<a href="#partners-list" class="white border-box-button hidden">
						Full Partner List <span class="icon ml1" data-icon="Î"></span>
					</a>
				</div>		
			</div>
			<div class="col-md-8 col-xs-12">
				<?php get_template_part('partials/partners/map_module'); ?>
			</div>
		</div>
	</div>
</section>