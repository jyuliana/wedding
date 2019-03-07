<?php

require get_template_directory() . '/inc/class-wedding-recent-post-widget.php';

// function wedding_register_widget() {	
	// register_widget( 'wedding_widget_recent_posts' );
// }
// add_action( 'widgets_init', 'wedding_register_widget' );


 function wedding_setup(){
	 
	 load_theme_textdomain('wedding');
	 
	  add_theme_support('title-tag'); 
	 
	 add_theme_support('custom-logo', array(
		'height' => 100, 
		'width' => 100, 
		'flex-height' => true
	));
	
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(800,550);
	
	add_theme_support('html5',  array(
		'search_form', 
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	));
	 
	add_theme_support('post-formats', array(
		 'aside',
		 'image',
		 'video',
		 'gallery'
	));

	register_nav_menu('primary', 'primary menu');
	
}

add_action('after_setup_theme', 'wedding_setup');



function the_breadcrumb(){
	global $post;
	if(!is_home()){ 
	   echo '<a href="'.site_url().'">главная</a>';
		if(is_single()){ // page
		the_category(', ');
		echo " text; ";
		the_title();
		}
		elseif (is_page()) { // page
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' text; ';
			}
			echo the_title();
		}
		elseif (is_category()) { // category
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0) 
				echo(get_category_parents($parent_cat, TRUE, ' text; '));
			single_cat_title();
		}
		elseif (is_search()) { // page search
			echo 'Результаты поиска для "' . get_search_query() . '"';
		}
		elseif (is_tag()) { // tags
			echo single_tag_title('', false);
		}
		elseif (is_day()) { // archive (days)
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> text; ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> text ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> text; ';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo 'Опубликовал(а) ' . $userdata->display_name;
		} elseif (is_404()) { // if page not found
			echo '<li>'. esc_html__('ошибка 404', 'wedding'). '</li>';
		}
	 
		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'paged)';
	 
	} else { // Home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
		  echo '<a href="'.site_url().'">Главная</a>';
	   else
		  echo '<li><i class="fa fa-home" aria-hidden="true">'. esc_html__('Главная', 'wedding') .'</li>';
	}
}
		

/**
* pagination
*/		
function wedding_pagination( $args = array() ) {
		
	$defaults = array(
		'range'           => 4,
		'custom_query'    => FALSE,
		'previous_string' => __( 'Previous', 'text-domain' ),
		'next_string'     => __( 'Next', 'text-domain' ),
		'before_output'   => '<div class="next-posts"><ul class="navigation">',
		'after_output'    => '</ul></div>'
	);
	
	$args = wp_parse_args( 
		$args, 
		apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
	);
	
	$args['range'] = (int) $args['range'] - 1;
	if ( !$args['custom_query'] )
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page  = intval( get_query_var( 'paged' ) );
	$ceil  = ceil( $args['range'] / 2 );
	
	if ( $count <= 1 )
		return FALSE;
	
	if ( !$page )
		$page = 1;
	
	if ( $count > $args['range'] ) {
		if ( $page <= $args['range'] ) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ( $page >= ($count - $ceil) ) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}
	
	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr( get_pagenum_link($previous) );
	
	if ( $previous && (1 != $page) )
		$echo .= '<li><a href="' . $previous . '" class="navigation" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
	
	if ( !empty($min) && !empty($max) ) {
		for( $i = $min; $i <= $max; $i++ ) {
			if ($page == $i) {
				$echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 1, '0', STR_PAD_LEFT ) . '</span></li>';
			} else {
				$echo .= sprintf( '<li><a href="%s" class="navigation">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
			}
		}
	}
	
	$next = intval($page) + 1;
	$next = esc_attr( get_pagenum_link($next) );
	if ($next && ($count != $page) )
		$echo .= '<li><a href="' . $next . '" class="navigation" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
	
	if ( isset($echo) )
		echo $args['before_output'] . $echo . $args['after_output'];
}
		
	
function wedding_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'header_social' , array(
	  'default'   => __(' с днем всех влюбленных', wedding),
	  'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'facebook_social' , array(
	  'default'   => __('url facebook', wedding),
	  'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'linkedin_social' , array(
	  'default'   => __('url linkedin', wedding),
	  'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'twitter_social' , array(
	  'default'   => __('url twitter', wedding),
	  'transport' => 'refresh',
	));
				
		
	$wp_customize->add_section( 'social_section' , array(
		  'title'      => __( 'Social setting', 'wedding' ),
		  'priority'   => 30,
		));
		
	$wp_customize->add_control(
	'header_social',
	array(
		'label'    => __( 'Social header in footer', 'wedding' ),
		'section'  => 'social_section',
		'settings' => 'header_social',
		'type'     => 'text',
	));	
	
	$wp_customize->add_control(
	'Facebook_social',
	array(
		'label'    => __( 'facebook profile url', 'wedding' ),
		'section'  => 'social_section',
		'settings' => 'facebook_social',
		'type'     => 'text',
	));	
	
	$wp_customize->add_control(
	'Linkedin_social',
	array(
		'label'    => __( 'linkedin profile url', 'wedding' ),
		'section'  => 'social_section',
		'settings' => 'linkedin_social',
		'type'     => 'text',
	));	
	
	$wp_customize->add_control(
	'twitter_social',
	array(
		'label'    => __( 'twitter profile url', 'wedding' ),
		'section'  => 'social_section',
		'settings' => 'twitter_social',
		'type'     => 'text',
	));	
	$wp_customize->add_control(
	'facebook_social',
	array(
		'label'    => __( 'facebook profile url', 'wedding' ),
		'section'  => 'social_section',
		'settings' => 'facebook_sociasl',
		'type'     => 'text',
	));

}
add_action( 'customize_register', 'wedding_customize_register' );



// правильный способ подключить стили и скрипты
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function wedding_scripts() {
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'font-roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' );
	
	wp_enqueue_style( 'font-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' );
	
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js');
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.min.js');
	wp_enqueue_script('html5shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
	wp_enqueue_script('respond', 'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js');
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
	wp_script_add_data('respond', 'conditional', 'lt IE 9');
	
}
add_action( 'wp_enqueue_scripts', 'wedding_scripts' );


/**
 * Add a sidebar.
 */
function wedding_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'wedding' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and 
			pages.', 'wedding' ),
        'before_widget' => ' <div id="%1$s" navbarCollapse" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h1>',
        'after_title'   => '</h1>',
    ));
	register_sidebar( array(
        'name'          => __( 'Поиск меню', 'wedding' ),
        'id'            => 'search-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and 
			pages.', 'wedding' ),
        'before_widget' => ' <div id="%1$s" navbarCollapse class="%2$s col-md-4">',
        'after_widget'  => '</div>'
    ));
	
}




add_action( 'widgets_init', 'wedding_widgets_init' );

function wedding_widget_categories($args) {
	$walker = new walker_categories_wedding();

	$args = array_merge($args, array('walker' => $walker));
	
	return $args;
}
add_filter('widget_categories_args', 'wedding_widget_categories');

class walker_categories_wedding extends walker_category {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		parent::start_lvl($output, $depth, $args);
	}
	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		parent::end_lvl($output, $depth, $args);
	}
	/**
	 * Starts the element output.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output   Used to append additional content (passed by reference).
	 * @param object $category Category data object.
	 * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
	 * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
	 * @param int    $id       Optional. ID of the current category. Default 0.
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters(
			'list_cats',
			esc_attr( $category->name ),
			$category
		);
		// Don't generate an element if the category name is empty.
		if ( '' === $cat_name ) {
			return;
		}
		$link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
			/**
			 * Filters the category description for display.
			 *
			 * @since 1.2.0
			 *
			 * @param string $description Category description.
			 * @param object $category    Category object.
			 */
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		}
		$link .= '<i class="fa fa- folder-open-o" aria-hidden="true"></i>';
		$link .= $cat_name;
		if ( ! empty( $args['show_count'] ) ) {
			$link .= '<span>' . number_format_i18n( $category->count ) . '</span>';
		}
		
		$link .= '</a>';
		if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
			$link .= ' ';
			if ( empty( $args['feed_image'] ) ) {
				$link .= '(';
			}
			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';
			if ( empty( $args['feed'] ) ) {
				$alt = ' alt="' . sprintf( __( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
			} else {
				$alt   = ' alt="' . $args['feed'] . '"';
				$name  = $args['feed'];
				$link .= empty( $args['title'] ) ? '' : $args['title'];
			}
			$link .= '>';
			if ( empty( $args['feed_image'] ) ) {
				$link .= $name;
			} else {
				$link .= "<img src='" . esc_url( $args['feed_image'] ) . "'$alt" . ' />';
			}
			$link .= '</a>';
			if ( empty( $args['feed_image'] ) ) {
				$link .= ')';
			}
		}
		if ( 'list' == $args['style'] ) {
			$output     .= "\t<li";
			$css_classes = array(
				'cat-item',
				'cat-item-' . $category->term_id,
			);
			if ( ! empty( $args['current_category'] ) ) {
				// 'current_category' can be an array, so we use `get_terms()`.
				$_current_terms = get_terms(
					$category->taxonomy,
					array(
						'include'    => $args['current_category'],
						'hide_empty' => false,
					)
				);
				foreach ( $_current_terms as $_current_term ) {
					if ( $category->term_id == $_current_term->term_id ) {
						$css_classes[] = 'current-cat';
					} elseif ( $category->term_id == $_current_term->parent ) {
						$css_classes[] = 'current-cat-parent';
					}
					while ( $_current_term->parent ) {
						if ( $category->term_id == $_current_term->parent ) {
							$css_classes[] = 'current-cat-ancestor';
							break;
						}
						$_current_term = get_term( $_current_term->parent, $category->taxonomy );
					}
				}
			}
			/**
			 * Filters the list of CSS classes to include with each category in the list.
			 *
			 * @since 4.2.0
			 *
			 * @see wp_list_categories()
			 *
			 * @param array  $css_classes An array of CSS classes to be applied to each list item.
			 * @param object $category    Category data object.
			 * @param int    $depth       Depth of page, used for padding.
			 * @param array  $args        An array of wp_list_categories() arguments.
			 */
			$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
			$css_classes = $css_classes ? ' class="' . esc_attr( $css_classes ) . '"' : '';
			$output .= $css_classes;
			$output .= ">$link\n";
		} elseif ( isset( $args['separator'] ) ) {
			$output .= "\t$link" . $args['separator'] . "\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $page   Not used.
	 * @param int    $depth  Optional. Depth of category. Not used.
	 * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
	 *                       to output. See wp_list_categories(). Default empty array.
	 */
	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		parent::end_lvl( $output, $page, $depth, $args );
		
	}
}
	
	
function wedding_tag_cloud($args) {
	
	$args['format'] = 'list';
	$args['smallest'] = '14';
	$args['unit'] = 'px';
	
	return $args;
	
}
add_filter('widget_tag_cloud_args', 'wedding_tag_cloud');
	
// Change order comment fields
add_filter('comment_form_fields', 'wedding_reorder_comment_fields' );
function wedding_reorder_comment_fields( $fields ){
	$new_fields = array();
	$myorder = array('author','email','comment');
	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}	
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;
		return $new_fields;	
}		

function wedding_list_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
	id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?> 
	<div class="comment-wrap-info">
		<div class="comment-author vcard">
			<?php 
				if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] ); 
				} 
			 ?>
		</div>
		<div class="comment-meta commentmetadata">
			<?php printf( __( '<cite class="fn author-name">%s</cite>' ), get_comment_author_link() ); ?>
			<br>
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date"></a>
			<?php
				/* translators: 1: date, 2: time */
				printf( 
					__('%1$s at %2$s'), 
					get_comment_date(),  
					get_comment_time() 
				); 
			?>
			<?php 
				edit_comment_link( __( '(Edit)' ), '  ', '' ); 
				 ?>
		</div>
	</div>
		<?php 
			if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
			} 
		?>
        <?php comment_text(); ?>

        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

	

?>













