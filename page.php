<?php get_header(); ?>

<div class="row">
	<div class="col-md-8">
		<?php if( have_posts() ): ?>
			<?php while( have_posts() ): the_post();
			
				get_template_part('template-parts/content', get_post_format());
				
				if ( comments_open() || get_comments_number() ){
					comments_template();
				}
				
			endwhile; ?>
		<?php endif; ?>
		<?php wedding_pagination();?>
	</div> 
</div>
<?php get_footer(); ?>
       