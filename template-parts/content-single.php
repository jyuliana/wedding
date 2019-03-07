<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post row'); ?> >
	<div <?php post_class('col-md-12'); ?> id="post-<?php the_ID(); ?>">
		<div class="row">
			<h4> <?php the_title(); ?> </h4>
			<div class="col-md-10">
				<?php the_content(); ?>
			</div>
			<div class="col-md-2">
				<?php 
					$attr = array(
						'class'=> 'post_image',
					);
					the_post_thumbnail('thumbnail', $attr); 
				?>
			</div>
		</div>
	</div>
	
	<div class="blog_category col-mb-6">
		
		 <?php the_category(' ');?>
   </div>
	<div class="blog_text col-md-6">
		<?php esc_html_e(''); ?>
	</div>
	<div class="col-md-12">
		<?php 
			if ( comments_open() || get_comments_number() ) :
				comments_template();	
			endif;
		?>
	</div>
</article>			