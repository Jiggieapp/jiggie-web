<?php
//Define Text Doimain
global $st_textdomain;
$st_textdomain = 'wunderkind';
$lang = get_template_directory() . '/languages';
load_theme_textdomain($st_textdomain, $lang);

if(file_exists(get_template_directory().'/inc/st.setup.php'))
{
    require_once get_template_directory().'/inc/st.setup.php';
}

if(!class_exists('STSetup')) die('Can not setup Wunderkind! Please contact us at<a href="http://shinetheme.com">Shinetheme</a>');

$load_file=array(
            'st.helpers',
            'st.themeoptions',
            'st.metabox',
            'st.posttype',
            'st.bootstrap_navwalker',
            'st.hook_functions',
            'st.hook_register',
            'st.customvc'
    );

STSetup::load_libs($load_file);

STSetup::init();


if(!function_exists('st_add_vcelements'))
{
    function st_add_vcelements()
    {
        $load_file=array(
            'st.vcelement'
            );
        
        STSetup::load_libs($load_file);
            
    }
}
add_action('init','st_add_vcelements' );




if(file_exists(dirname( __FILE__ ) .'/demo/demo_functions.php'))
{
    require_once dirname( __FILE__ ) .'/demo/demo_functions.php';
}


if ( ! isset( $content_width ) ){
    $content_width = 855;
}


function wunderkind_comments($comment, $args, $depth ){
    $GLOBALS['comment'] = $comment;
    global $st_textdomain;
    /* override default avatar size */
    $args['avatar_size'] = 74;
    if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <div class="comment-body">
            <?php _e( 'Pingback:', $st_textdomain ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'unitedthemes' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
        </div>
    <?php else : ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="clearfix">
            <figure class="comment-avatar hide-on-mobile">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </figure><!-- .comment-avatar -->
            <div class="ut-arrow-left"></div>
            <div class="comment-body">
                <header class="comment-header">
                    <div class="comment-author vcard">
                        <?php printf( __( '%s', $st_textdomain ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    </div><!-- .comment-author -->
                    <div class="comment-metadata">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <time datetime="<?php comment_time( 'c' ); ?>">
                                <?php printf( _x( '%1$s', '1: date', $st_textdomain ), get_comment_date() ); ?>
                            </time>
                        </a>
                    </div><!-- .comment-metadata -->
                </header><!-- .comment-meta -->
                <div class="comment-content clearfix">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', $st_textdomain ); ?></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
                <footer class="comment-footer clearfix">
                <span class="reply-link"><i class="fa fa-reply"></i>
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </span>
                    <?php edit_comment_link( __( 'Edit', $st_textdomain ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
                </footer><!-- .reply -->
            </div>
        </article><!-- .comment-body -->
    <?php
    endif;
}

//Hide Update check
global $redux_update_check;
$redux_update_check=1;
//Add Boxed Class