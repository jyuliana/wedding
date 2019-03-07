
<?php
/**
	<?php print_r(111111111111);die(); ?>
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage wedding 
 * @since wedding 1.0
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<div id="comments" class="row comments-area">
	<?php if ( have_comments() ) : ?>
		<div class="col-md-12">
			<h3 class="comments-title">
				<?php
					printf( _nx('"%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'wedding' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h3>
		</div>
	 
		<div class="col-md-12">
			<ol class="comment-list">
					<?php
					wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 74,
					'callback' => 'wedding_list_comment'

					) );
				?>
			</ol><!-- .comment-list -->
		</div>
		<div class="col-md-12 contact_form">
	 
			<?php
				// Are there comments to navigate through?
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
				<nav class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'wedding' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wedding' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wedding' ) ); ?></div>
				</nav><!-- .comment-navigation -->
			<?php endif; // Check for comment navigation ?>
	 
			<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'wedding' ); ?></p>
			<?php endif; ?>
 
		<?php endif; // have_comments() ?>
		<?php
			$author = '<div class="form-group">' . '<label class="col-md-12" for="author">' . 
							esc_html__( 'ФИО', 'wedding' ) . '</label> ' .
								'<div class="col-md-12"><input id="author" class="form-control is-valid" placeholder="автор" name="author" type="text" value="' . 
								esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>';
			
			$email = '<div class="form-group">' . '<label class="col-md-12"  for="email">' . 
							esc_html__( 'Адрес электронной почты*', 'wedding') . '</label>' .
							'<div class="col-md-12"><input class="form-control is-valid" id="email" name="email"'. ( $html5 ? 'type="email"' : 'type="text"') . 
							' value="' . esc_attr(  $commenter['comment_author_email'] ) . '"aria-describedby="email-notes"' . $aria_req . 
							$html_req . ' /></div></div>';
			
			$comment_field = '<div class="form-group">' . '<label class="col-md-12"  for="comment">' .
									esc_html_x( 'сообщение', 'wedding' ) . '</label> 
									<div class="col-md-12"><textarea id="comment"
									class="form-control form-textarea" name="comment" rows="3" aria-required="true"></textarea></div></div>';
							
			$fields =  array(
				'author' => $author,
				'email'  => $email,			
			);
			$comments_args = array(
				'fields'=> $fields,
				'class_submit' => 'btn btn-default',
				'submit_field' => '<div class="section_sub_btn">%1$s %2$s</div>',
				'comment_field' => $comment_field,
				'class_form' => 'form-horizontal',
				'comment_notes_before' => '<div class="form-group"><p class="comment-notes">' .
				__( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
				'</p></div>',
			);
			comment_form($comments_args);
		?>
	</div>
 
</div><!-- #comments -->


					
					
					
					









