
<nav id="nav" class="fixed">
	<div class="container-fluid">
		<div class="row">
			<div class="logo col-sm-2 col-xs-6 nav-col">
				<a href="/">
					<?php get_template_part('partials/logo'); ?>
				</a>
			</div>
			<div class="col-sm-10 col-xs-6 nav-col" id="nav-menu">
				<?php wp_nav_menu(); ?>
			</div>
		</div>
	</div>
	<div class="nav-background"></div>	
</nav>
<div id="mobile-nav">
	<ul class="mobile-nav-items">
		<?php wp_nav_menu(); ?>
	</ul>
</div>
<div class="hamburger menu-toggle">
	<span class="hamburger-line hl-1"></span>
	<span class="hamburger-line hl-2"></span>
	<span class="hamburger-line hl-3"></span>
</div>

