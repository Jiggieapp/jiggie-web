<?php
global $st_textdomain,$st_portfolio_data, $style;
$html='';
$count=0;
if(isset($_GET['style']))
{
    $style=$_GET['style'];
}
while(have_posts())
    {

        the_post();
        $terms=wp_get_post_terms(get_the_ID(),'portfolio_cat');
        $term_string='';
        if(!empty($terms))
        {
            foreach($terms as $key=>$value)
            {
                $term_string.=' '.$value->slug;
            }
        }
       
    if ($style == 'style1'){
        $size=array(362, 272,'bfi_thumb'=>true);
        $thumb=get_the_post_thumbnail(get_the_ID(),$size);
        $full = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true))
        {
            $full=$video;
        }
        $title=get_the_title();
        $permalink=get_permalink();
        $html.="<li class='cbp-item {$term_string}'>
                    <figure>
                                {$thumb}
                                <figcaption>
                                    <a href='{$full}' class='cbp-lightbox' data-title='{$title}'><i class=\"fa fa-search fa-2x\"></i></a>
                                    <a href='{$permalink}' class=\"cbp-singlePage\"><i class=\"fa fa-expand fa-2x\"></i></a>
                                </figcaption>
                            </figure>
                </li>";
    }elseif ($style == 'style2') {
        $size=array(362, 272,'bfi_thumb'=>true);
        $thumb=get_the_post_thumbnail(get_the_ID(),$size);
        $full = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true))
        {
            $full=$video;
        }
        $title=get_the_title();
        $author = get_the_author();
        $permalink=get_permalink();
        $html .= " <li class='cbp-item {$term_string}'>
                            <a href='{$permalink}' class='cbp-caption cbp-lightbox' data-title='{$title}'>
                                <div class='cbp-caption-defaultWrap'>{$thumb}</div>
                                
                                <div class='cbp-caption-activeWrap'>
                                    <div class='cbp-l-caption-alignCenter'>
                                        <div class='cbp-l-caption-body'>
                                            <div class='cbp-l-caption-title'>{$title}</div>
                                            <div class='cbp-l-caption-desc'>by {$author}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>";
    }elseif ($style == 'style3') {
        // if($count%2==0){ 
        //      $size=array(273, 409,'bfi_thumb'=>true);
        // }else{
        //     $size=array(273, 263,'bfi_thumb'=>true);
        // } 
        $size=array(273, 9999,'bfi_thumb'=>true);      
        $thumb=get_the_post_thumbnail(get_the_ID(),$size);
        $full = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true))
        {
            $full=$video;
        }
        $title=get_the_title();
        $author = get_the_author();
        $permalink=get_permalink();
        $class='';
        if($count%2==0){ 
            $class = 'cbp-l-grid-masonry-height2';
        }else{
            $class = 'cbp-l-grid-masonry-height1';
        }
        $html .= " <li class='cbp-item {$term_string} ".$class."'>
                            <a href='{$permalink}' class='cbp-caption cbp-lightbox' data-title='{$title} by {$author}'>
                                <div class='cbp-caption-defaultWrap'>{$thumb}</div>
                                
                                <div class='cbp-caption-activeWrap'>
                                    <div class='cbp-l-caption-alignCenter'>
                                        <div class='cbp-l-caption-body'>
                                            <div class='cbp-l-caption-title'>{$title}</div>
                                            <div class='cbp-l-caption-desc'>by {$author}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>";
                        
    }
    else{ $html.="<li></li>";}

 
// $count ++;

    }
   
echo $html;


