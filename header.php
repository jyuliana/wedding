<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	  <meta charset="<?php bloginfo('charset'); ?>">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="shortcut icon" href="docs-assets/ico/favicon.png">
	  <title>Jumbotron Template for Bootstrap</title>
	<?php wp_head(); ?>  
	</head>
	<body> 	
	<header>
	   <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark top-menu">
			<a class="navbar-brand" href="#"></a>
			<a class="navbar-logo" href="/"><img src="https://html5book.ru/wp-content/uploads/2017/04/lily-logo.png"></a>
			<a class="navbar-logo" href=""><?php the_custom_logo();?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="col-md-8">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container'       => false, 
							'items_wrap' => '<ul id="%1$s" class="%2$s navbar-nav mr-auto menu-main">%3$s</ul>',
							'menu_class' => 'menu-main',
							'menu_id' => '',
							'depth' => 1,
							
						));
					?>
				</div>
				<?php dynamic_sidebar(' search-1'); ?>
			</div>
		</nav>
	</header> 