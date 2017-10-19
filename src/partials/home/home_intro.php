
<section class="block spy-target pt7 pb7" id="home-intro">
	<div class="container-fluid" id="home-intro-page">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-box border-box-white">
					<div class="row mb6">
						<div class="col-xs-12">
							<?php get_template_part('partials/logo_full_white'); ?>
						</div>
					</div>
					<div class="row mb3">
						<div class="col-lg-10">
							<h1 class="white">
								<?php the_field('introduction_title') ?>
							</h1>
						</div>
					</div>	
					<div class="row mb2">
						<div class="col-lg-10">
							<h3 class="bold white">
								<?php the_field('introduction_subtitle') ?>
							</h3>
						</div>
					</div>	
					<div class="row mb2">
						<div class="col-xs-12 col-xl-10">
							<div class="wysiwyg">
								<?php the_field('climb_introduction') ?>
							</div>
						</div>
					</div>															
				</div>
			</div>
		</div>
	</div>
</section>