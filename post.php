<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs');?>

<div class="row">
	<div class="col-md-8">
		<?php if( have_posts() ): ?>
			<?php while( have_posts() ) the_post();
				get_template_part('template-parts/content', 'single');
			endwhile; ?>
		<?php endif; 
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;?>
		<?php wedding_pagination();?>
	</div>
	<?php get_sidebar();?>
</div>
<?php get_footer(); ?>


       