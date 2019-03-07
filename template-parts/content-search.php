<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?> >
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_content(); ?>
	</div>
      
   <div class="blog_post_img">
		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?>
		</a>
   </div>	 
</article>								