<div class="page-title-bar">
	<div class="container page-title-row">
		<div class="page-title-wrapper">
			<header class="page-title-captions">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php if ( function_exists('yoast_breadcrumb') ) : ?>
				<div class="page-title-secondary">				
				<?php yoast_breadcrumb('<div class="breadcrumbs">','</div>'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>