<?php 
global $st_textdomain;
if(get_post_type()!='portfolio')

{ ?>


    <h2 class="post-title"><a href="<?php echo the_permalink()?>"><?php the_title()?></a></h2>

    <p><?php _e('by',$st_textdomain)?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author() ?></a> <small><?php echo get_user_meta(get_the_author_meta('ID'),'job',true) ?></small></p>

    <p><span class="icon ion-ios7-clock"></span> <?php echo __('Posted on',$st_textdomain)?> <?php echo the_date('F d, Y \a\t H:i A') ?></p>



<?php

}



the_content();


?>