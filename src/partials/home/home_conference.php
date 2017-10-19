
<section class="block spy-target vh100 pt7 pb7" id="home-conference">

	<?php
	$image = get_field('conf_preview_image','88');
	if( !empty($image) ): $conf_preview_image = $image['url']; endif;
	?>

	<div class="block-background mask-dark" style="background-image: url('<?php echo $conf_preview_image ?>')";>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-xl-3 offset-xl-1">
				<h1 class="white mb1">
					Climb<br>
					Conference<br>
					2017
				</h1>
				<h4 class="white mb5">
					<?php the_field('conf_date','88'); ?>
					<br>
					<?php the_field('conf_location','88'); ?>
				</h4>			
			</div>
			<div class="col-md-9 col-xl-7">
				<div class="border-box">
					<h3 class="white border-box-text mb2">
						<?php the_field('conf_introduction','88'); ?>
					</h3>
					<a href="#" class="white border-box-button">
						Conference Details
					</a>
				</div>
			</div>
		</div>
	</div>
</section>