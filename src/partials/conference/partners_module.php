
<?php $conference = get_field('current_conference'); $conference_id = $conference[0]->ID; ?>

<div class="row" id="conference-partners">
	<div class="conference-partners-sponsors col-xs-6">
		<h4 class="white tracked mb2">SPONSORS</h4>
		<?php
		$sponsors = get_field('sponsors', $conference_id ); 
		foreach( $sponsors as $partner ):
			$partner_id = $partner->ID; 
			$partner_slug = $partner->post_name
			?>
			<div class="partner" id="sponsor-<?php echo $partner_slug; ?>">
				<?php if( get_field('partner_link',$partner_id) ): ?>
					<a href="<?php the_field('partner_link',$partner_id);?>">
					<?php endif; ?>
					<h3 class="white speaker-name"><?php echo get_the_title($partner_id); ?></h3>
					<?php if( get_field('partner_link',$partner_id) ): ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="conference-partners-partners col-xs-6">
		<h4 class="white tracked mb2">ORGANIZING PARTNERS</h4>
		<?php
		$partners = get_field('conf_organizational_partners', $conference_id ); 
		foreach( $partners as $partner ):
			$partner_id = $partner->ID; 
			$partner_slug = $partner->post_name
			?>
			<div class="partner" id="partner-<?php echo $partner_slug; ?>">
				<?php if( get_field('partner_link',$partner_id) ): ?>
					<a href="<?php the_field('partner_link',$partner_id);?>">
					<?php endif; ?>
					<h3 class="white speaker-name"><?php echo get_the_title($partner_id); ?></h3>
					<?php if( get_field('partner_link',$partner_id) ): ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>	
</div>