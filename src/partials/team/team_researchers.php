
<section class="block spy-target pt8 pb8" id="team-researchers">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xl-3 col-sm-12">
				<h3 class="white conference-heading">
					Principle Investigators				
				</h3>
			</div>
			<div class="col-md-9 col-xl-8 offset-xl-1 col-sm-12">
				<div id="principle-investigators">
					<?php
					$the_query = new WP_Query( array(
						'post_type' => 'people',
						'posts_per_page' => -1,
						'tax_query' => array(
							array (
								'taxonomy' => 'role',
								'field' => 'slug',
								'terms' => 'principal-investigators',
							)
						)
					) );
					while ( $the_query->have_posts() ) : 
						$the_query->the_post();
						get_template_part('partials/person');
					endwhile; 
					wp_reset_postdata(); 
					?>
				</div>
			</div>
		</div>
		<?php
		$the_query = new WP_Query( array(
			'post_type' => 'people',
			'posts_per_page' => -1,
			'tax_query' => array(
				array (
					'taxonomy' => 'role',
					'field' => 'slug',
					'terms' => 'researchers-and-staff',
				)
			)
		) );
		if ( $the_query->have_posts() ) : ?>
		<div class="row mt6">
			<div class="col-md-3 col-xl-3 col-sm-12">
				<h3 class="white conference-heading">
					Researchers and Staff				
				</h3>
			</div>
			<div class="col-md-9 col-xl-8 offset-xl-1 col-sm-12">
				<div id="researchers-and-staff">
					<?php
					while ( $the_query->have_posts() ) : 
						$the_query->the_post();
						get_template_part('partials/person');  
						get_template_part('partials/person');  
						get_template_part('partials/person');  
						get_template_part('partials/person');  
						get_template_part('partials/person');  						
						get_template_part('partials/person');  						

						get_template_part('partials/person'); ?> 

					<?php endwhile; ?>

				</div>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>
</section>