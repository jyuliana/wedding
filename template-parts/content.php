<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?> >
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_content(); ?>
	</div>
						
	<div class="blog_category">
		<ul>
			<li> <?php the_category(', ');?></li>
		</ul>
   </div>
   
   <div class="blog_text">
		<ul>
			<li> | </li>
			<li> <?php esc_html_e('post By :', 'wedding'); ?> <?php the_author_posts_link(); ?></li>
			<li> | </li>
			<li> <?php esc_html_e('on :', 'wedding'); ?> <?php the_time('j F Y');?> </li>
		</ul>	
   </div>
   
   <div class="blog_post_img">
		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?>
		</a>
   </div>	 
   
   <?php the_excerpt(); ?>
   
   <a href="<?php the_permalink(); ?>"> <php esc_html_e('continue reading', 
		 'wedding')?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
		 
	</a>	 
</article>	




















							