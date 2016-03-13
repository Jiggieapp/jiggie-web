<?php if(st_get_option('twitter_url') or st_get_option('custom_social') or st_get_option('instagram_url') or st_get_option('facebook_url')) :?>
<div class="col-md-12 footer-social">
    <ul class="connected-icons text-center">
        <?php if(st_get_option('twitter_url')): ?>
        <li class="connected-icon"><a target="_blank" href="<?php echo st_get_option('twitter_url') ?>"><i class="fa fa-twitter fa-2-5x"></i></a></li>
        <?php endif;?>

        <?php if(st_get_option('facebook_url')): ?>
        <li class="connected-icon"><a target="_blank" href="<?php echo st_get_option('instagram_url') ?>"><i class="fa fa-facebook fa-2-5x"></i></a></li>
        <?php endif;?>

        <?php if(st_get_option('instagram_url')): ?>
        <li class="connected-icon"><a target="_blank" href="<?php echo st_get_option('instagram_url') ?>"><i class="fa fa-instagram fa-2-5x"></i></a></li>
        <?php endif;?>

        <?php echo st_get_option('custom_social') ?>

    </ul>
</div>
<?php endif;?>

<p><?php bloginfo('description' ); ?></p>
<h4 class="footer-logo"><a href="<?php echo site_url( );?>"><?php bloginfo('name' ); ?></a></h4>

<div class="col-lg-12 footer-menu">
    <div class="pull-left"><?php echo st_remove_wpautop(st_get_option('footer-text'),true)?></div>

    <?php  if(has_nav_menu('footer' )){
            wp_nav_menu(array('theme_location'=>'footer','container_id'=>'footer_wrap','container_class'=>'pull-right','walker'=>new wp_bootstrap_navwalker()) );
        }else{
            echo "<span class=\"pull-right\">Make your footer menu at Appearance => Menus</span>";
            } ?>
    
</div>
