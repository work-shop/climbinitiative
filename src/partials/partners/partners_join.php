
<section class="block spy-target vhm70 pt7 pb7" id="partners-join">
	<?php
	$image = get_field('call_to_action_image','84');
	if( !empty($image) ): $call_to_action_image = $image['url']; endif;
	?>
	<div class="block-background mask-darker" style="background-image: url('<?php echo $call_to_action_image ?>')";>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-3 col-xl-7">
				<div class="border-box">
					<h1 class="white mb1">
						<?php the_field('call_to_action_text','84'); ?>
					</h1>
					<a href="/contact" class="white border-box-button">
						Contact Us About Partnership <span class="icon ml1" data-icon="Î"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
