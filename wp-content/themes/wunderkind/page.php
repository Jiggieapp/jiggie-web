<?php global $wp_query;$sidebar_position=get_post_meta(get_the_ID(), '_cmb_sidebar_position', true);$hide_page_title=get_post_meta(get_the_ID(),'_cmb_hide_page_title',true);$sub_title=get_post_meta(get_the_ID(),'_cmb_page_sub_title',true);if(!$sidebar_position) $sidebar_position='no';if($sidebar_position == 'yes'){    global $st_remove_container;    $st_remove_container=true;}?><?php get_header(); ?><?php if(!$hide_page_title){    ?>    <section id="blog-page-title" class="current">        <div class="container">            <div class="row text-center" style="margin:60px 0 20px 0;">                <div class="col-lg-12 section-title wow flipInX ">                    <h1><small><?php //bloginfo('name')?></small><br><strong><?php the_title()?> </strong></h1>                    <?php if($sub_title)                        {                    ?>                            <p class="lead"><?php echo do_shortcode($sub_title)?></p>                    <?php                        }                    ?>                </div>            </div>        </div>    </section><?php}?><section class="section-single no-title">    <div class="container">        <div class="row">        <?php while(have_posts()) : the_post(); ?>            <?php            if($sidebar_position == "no"){                $page_class="single-post-wrapper clearfix col-lg-12 col-md-12";            }else{                $page_class="single-post-wrapper clearfix  col-lg-8";            }            ?>            <?php            if($sidebar_position == 'left'){                $page_class .=' pull-right';            }            ?>            <div class="<?php echo $page_class; ?>">                <?php the_content(); ?>                <?php wp_link_pages(); ?>            </div><!-- single-post-wrapper -->        <?php endwhile; ?>        <?php if($sidebar_position != "no"){ ?>            <div id="sidebar" class="col-lg-4">                <?php dynamic_sidebar('single-post'); ?>            </div><!-- end sidebar -->        <?php } ?>        </div>    </div><!-- end container --></section><!-- end section-single --><?php get_footer(); ?>