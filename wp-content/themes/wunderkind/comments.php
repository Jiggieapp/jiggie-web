<?phpglobal $st_textdomain;/* * If the current post is protected by a password and the visitor has not yet * entered the password we will return early without loading the comments. */if ( post_password_required() )    return;?><div id="comments" class="comments-area">    <?php if ( have_comments() ) : ?>        <h3 class="comments-title">            <?php            printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', $st_textdomain ),                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );            ?>        </h3>        <ol class="comment-list unstylelist">            <?php            wp_list_comments( array(                'style'       => 'ol',                'short_ping'  => true,                'avatar_size' => 74,                'callback'=>'wunderkind_comments'            ) );            ?>        </ol><!-- .comment-list -->        <?php        // Are there comments to navigate through?        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :            ?>            <nav class="navigation comment-navigation" role="navigation">                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', $st_textdomain ); ?></h1>                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', $st_textdomain ) ); ?></div>                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', $st_textdomain ) ); ?></div>            </nav><!-- .comment-navigation -->        <?php endif; // Check for comment navigation ?>        <?php if ( ! comments_open() && get_comments_number() ) : ?>            <p class="no-comments"><?php _e( 'Comments are closed.' , $st_textdomain ); ?></p>        <?php endif; ?>    <?php endif; // have_comments() ?>    <div id="review_form_wrapper">        <div id="review_form">            <?php            $commenter = wp_get_current_commenter();            $comment_form = array(                'title_reply'          => have_comments() ? __( 'Add a comment', $st_textdomain ) : __( 'Be the first to comment', $st_textdomain ) . ' &ldquo;' . get_the_title() . '&rdquo;',                'title_reply_to'       => __( 'Leave a Reply to %s', $st_textdomain ),                'comment_notes_before' => '',                'fields'               => array(                    'author' => '<div class="row">							                <div class="form-group">							                    <div class="col-md-6">' .                        '<input id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true"  class="form-control" placeholder="'.__('Name*',$st_textdomain).'" />							                     </div>   ',                    'email'  => '<div class="col-md-6">' .                        '<input  placeholder="'.__('Your email address *',$st_textdomain).'"  class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div>							                </div>							                </div><!--End row-->',                ),                'label_submit'  => __( 'Post Comment', $st_textdomain ),                'logged_in_as'  => '',                'comment_field' => '<div class="row">                                        <div class="form-group">                                            <div class="col-md-12">                                                <textarea id="comment" name="comment" cols="40" rows="5" placeholder="'.__('Message',$st_textdomain).'"></textarea>                                            </div>                                        </div>                                    </div>',                'comment_notes_after'=>''            );            comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );            ?>        </div>    </div></div><!-- #comments -->