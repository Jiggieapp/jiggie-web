<?phpglobal $st_textdomain;if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true)){    ?>    <div class="fluid-width-video-wrapper post-img" style="padding-top:56.25%;">        <?php       // echo  do_shortcode('[embed ]'.$video.'[/embed]');        	$embed_code =  wp_oembed_get($video, array('height'=>750));             echo $embed_code;        ?>        <!-- Replace just numbers of video link -->    </div><?php}if(get_post_type()!='portfolio'){?>    <h2 class="post-title"><a href="<?php echo the_permalink()?>"><?php the_title()?></a></h2>    <p><?php echo __('by',$st_textdomain)?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author() ?></a> <small><?php echo get_user_meta(get_the_author_meta('ID'),'job',true) ?></small></p>    <p><span class="icon ion-ios7-clock"></span> <?php echo __('Posted on',$st_textdomain)?> <?php echo the_date('F d, Y \a\t H:i A') ?></p>    <?php}the_content();?>