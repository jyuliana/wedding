<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs');?>
 <div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if( have_posts() ): ?>
				<?php while( have_posts() ): the_post();
					get_template_part('template-parts/content', 'single');
				endwhile;
			endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
       