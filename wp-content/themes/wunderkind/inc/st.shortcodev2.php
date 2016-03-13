<?php
class STShortcode
{
    static function init()
    {
        //Hight light text
        // self::st_sc_hight_light();
        add_shortcode('st_hightlight',array('STShortcode','st_sc_hight_light') );
        //High light background
        //self::st_sc_hight_light_bg();
        add_shortcode('highlight_bg',array('STShortcode','st_sc_hight_light_bg') );
        //Service Box
        // self::st_sc_servicebox();
        add_shortcode('servicebox', array('STShortcode','st_sc_servicebox'));
        //About Box
        // self::st_sc_aboutbox();
        add_shortcode('aboutbox',array('STShortcode','st_sc_aboutbox') );
        //Typography
        self::st_sc_typography();
        //Skill
        // self::st_sc_skill();
        add_shortcode('skill',array('STShortcode','st_sc_skill') );
        //section_title
        //self::st_sc_section_title();
        add_shortcode('section_title',array('STShortcode','st_sc_section_title') );
        //MemberItem
        // self::st_sc_memberItem();
        add_shortcode('memberitem',array('STShortcode','st_sc_memberItem') );
        //Fact
        // self::st_sc_fact();
        add_shortcode('st_fact',array('STShortcode','st_sc_fact') );
        //Qoutes
        // self::st_sc_qoute();
        add_shortcode('st_qoute',array('STShortcode','st_sc_qoute') );
        //Testimonial
        // self::st_sc_testimonial();
        add_shortcode('st_testimonial',array('STShortcode','st_sc_testimonial') );
        //Purchase
        // self::st_sc_purchase();
        add_shortcode('st_purchase',array('STShortcode','st_sc_purchase') );
        //Portfolio Grid
        // self::st_sc_portfolios_grid();
        add_shortcode('st_portfolio_grid',array('STShortcode','st_sc_portfolios_grid') );
        //Social Item
        // self::st_sc_social_item();
        add_shortcode('st_social_item',array('STShortcode','st_sc_social_item') );
        //Price
        // self::st_sc_price();
        add_shortcode('st_price',array('STShortcode','st_sc_price') );
        //alert
        //self::st_sc_alert();
        add_shortcode('alert',array('STShortcode','st_sc_alert') );
        //Button
        // self::st_sc_button();
        add_shortcode('button',array('STShortcode','st_sc_button') );
        //Tooltip
        // self::st_sc_tooltip();
        add_shortcode('tooltip',array('STShortcode','st_sc_tooltip') );
        //Label
        // self::st_sc_label();
        add_shortcode('label', array('STShortcode','st_sc_label') );
        //List
        // self::st_sc_list();
        add_shortcode('list',array('STShortcode','st_sc_list') );
        add_shortcode('li',array('STShortcode','st_sc_list_li') );
        //Progress bar
        // self::st_sc_progressbar();
        add_shortcode('progressbar',array('STShortcode','st_sc_progressbar') );
        //Toggle/Accordion
        //self::st_sc_toggle();
        add_shortcode('toggle_wrap',array('STShortcode','st_sc_toggle') );
        add_shortcode('toggle_item',array('STShortcode','st_sc_toggle_item') );
        //Bootstrap Qoute
        // self::st_sc_bootstrap_quote();
        add_shortcode('blockquote',array('STShortcode','st_sc_bootstrap_quote') );
        // Call to action
        // self::st_sc_call_to_action();
        add_shortcode('call_to_action', array('STShortcode','st_sc_call_to_action'));
        //Tabs
        // self::st_sc_tabs();
        add_shortcode('tabs',array('STShortcode','st_sc_tabs') );
        add_shortcode('tabs_item',array('STShortcode','st_sc_tabs_item') );
        add_shortcode('tabs_item_child',array('STShortcode','st_sc_tabs_item_child') );
        //Post List
        // self::st_sc_post_list();
        add_shortcode('st_post_list',array('STShortcode','st_sc_post_list') );
        //Liquid slider
        // self::st_sc_liquid_slider();
        add_shortcode('liquid_slider',array('STShortcode','st_sc_liquid_slider') );
        //Google map
        // self::st_sc_google_map();
        add_shortcode('st_google_map',array('STShortcode','st_sc_google_map') );
        //Support Info
        // self::st_sc_support_info();
        add_shortcode('st_support_info',array('STShortcode','st_sc_support_info') );
        //Product List
        // self::st_sc_product_list();
        add_shortcode('st_product_list',array('STShortcode','st_sc_product_list') );
        //Contact Info
        // self::st_sc_contact_info();
        add_shortcode('contact_info',array('STShortcode','st_sc_contact_info') );
        //Row and Col
        //
        //Banner Item
        // self::st_sc_banner_item();
        add_shortcode('banner', array('STShortcode','st_sc_banner_item'));


        //Shop banner text
        // self::st_sc_shop_banner();
        add_shortcode('shop_banner' ,array('STShortcode','st_sc_shop_banner'));

        add_shortcode('st_quote_wrap',array('STShortcode','st_quote_wrap') );

        add_shortcode('st_post_grid',array('STShortcode','st_post_grid') );
    }
   
    static function st_post_grid($attrs,$content=false)
    {
        $data=wp_parse_args($attrs, array(
                    'posts_per_row'=>1,
                    'posts_per_page'=>3,
                    'category'=>'',
                    'orderby'=>'none',
                    'order'=>'asc',
                    'number_text'=> '30',
            ),$attrs);

        
        extract($data);

        $category=explode(',', $category);
       
        $all=false;

        if(!$category) $all=true;


        if(!empty($category))
        {
            foreach ($category as  $value) {
                # code...
                if(!$value)
                {
                    $all=true;
                }
            }
        }

        


        $post_arg=array(
                'post_type'=>'post',
                'posts_per_page'=>$posts_per_page,
                'orderby'=> $orderby,
                'order' => $order,
                //'cat'=>$category,
            );
        if(!$all)
        {
            $post_arg['category__in']=$category;
        }
       
        query_posts($post_arg); 

        global $wp_query;

        $html= st_load_template('posts-grid/posts-grid',null,$data);
        wp_reset_query();


        return $html;
    }

    static function st_quote_wrap($attrs,$content=false)
    {
         extract(shortcode_atts(array(
                'class'=>'',
                'heading'=>'2'
            ),$attrs));
         $content=st_remove_wpautop($content);
         return  "<h{$heading}><i class='fa fa-quote-left highlight '></i> {$content} <i class='fa fa-quote-right highlight '></i></h{$heading}>";
    }

    static function st_sc_shop_banner($attrs,$content=false){

        return "<div class='col-lg-12'>".wpb_js_remove_wpautop($content)."</div>";

    }

    static function st_sc_banner_item($attrs,$content=false){
            extract(shortcode_atts(array(
                'align'=>'center',
            ),$attrs));

            if($align){
                $align='text-'.$align;
            }

            return "<div class='{$align}'>".wpb_js_remove_wpautop($content)."</div>";
    }
    static function st_sc_contact_info($attrs,$content=false){
            extract(shortcode_atts(array(
                'phone'=>'',
                'class'=>'',
            ),$attrs));
            $content=wpb_js_remove_wpautop($content);
            $html="<div class='contact_info $class text-center '>
                        <div class=\"phone-info\">
                            <h1><i class=\"fa fa-phone\"></i> $phone</h1>
                        </div>
                        <div class=\"col-lg-12\">
                              <h3>$content</h3>
                        </div>
                    </div>";
            return $html;
    }
static function st_sc_product_list($attrs,$content=false){
        extract(shortcode_atts(array(
            'posts_per_page'=>10,
            'style_shop'    =>  'style1',
        ),$attrs));
    global $post;
    if ($style_shop == 'style1'){
        global $st_orgin_page;
        $st_orgin_page=$post;
        $arg=array(
                'post_type'=>'product',           
                'posts_per_page'=>$posts_per_page,
                'paged'=>isset($_GET['paged'])?$_GET['paged']:1,
            );
        if(isset($_GET['orderby']))
        {
            $arg['orderby']=$_GET['orderby'];
        }
        if(isset($_GET['order']))
        {
            $arg['order']=$_GET['order'];
        }
        query_posts($arg);
    global $st_remove_header;
    $st_remove_header=true;
    $html='';
    
    
        $html= woocommerce_get_template_part('archive','product');
        return $html;
    }elseif ($style_shop == 'style2') {
         
        echo '  <div id="popular-products-slider" class="owl-carousel"> ';
     
        global $woocommerce; 
        $query_args = array('posts_per_page' => $posts_per_page, 
                            'no_found_rows' => 1, 
                            'post_status' => 'publish', 
                            'post_type' => 'product'
                            );

        $query_args['meta_query'] = array();
        $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
        $top_seller_posts = new WP_Query( $query_args );

        if ( $top_seller_posts->have_posts() ) {
            while ( $top_seller_posts->have_posts() ) : $top_seller_posts->the_post(); 
            global $product  ;
             echo '<div id="effect" class="effects">
                <div class="img">';
                       do_action( 'woocommerce_before_shop_loop_item_title' ); 
            echo '  <div class="overlay">
                            <a class="expand" href='.get_the_permalink().'>';
                echo '<h4>'.get_the_title().'</h4>';                
            
            $product_category = wp_get_post_terms( $post->ID, 'product_cat' );
            foreach( $product_category as $cat ):
                if( 0 == $cat->parent )
                   echo '<p>'.$cat->name.'</p>';
            endforeach;                               
             echo'     <h2>'.$product->get_price_html().'</h2>
                            </a>
                            <a class="close-overlay hidden">x</a>
                    </div>
                </div>
            </div>
                   ';

            endwhile;
           echo '</div> ';
        }
        else {

            echo __( '' );

        }

        // wp_reset_postdata();
       
    }
    else{ echo ''; }      
        
}


static function st_sc_support_info($attrs,$content=false){
            extract(shortcode_atts(array(
                'phone'=>'',
                'class'=>''
            ),$attrs));
            $content=wpb_js_remove_wpautop($content);
            return "
                <div class='st_support_info $class' >
                    <div class=\"phone-info\">
                        <h1><i class=\"fa fa-phone\"></i>$phone</h1>
                    </div>
                    <div class=\"col-lg-12\">
                        $content
                    </div>
                </div>
            ";
    
    }
    static function st_sc_tabs_item($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'url'=>'',
                'style'=>''
            ),$attrs));
            global $st_tab_child;
            global $st_grand_child;
            global $st_tab_content;
            global $st_tab_item_id;
            $title=strip_tags($title);
            $contens=do_shortcode($content);
            if(!$url)
            {
                $url='dropdown'.$st_tab_item_id;
            }
            $class='';
            if($st_tab_item_id==0)
            {
                $class='active';
            }
            if($st_grand_child)
            {
                $st_tab_child.='<li class="'.$class.'"><a href="#'.$url.'"  class="dropdown-toggle" data-toggle="dropdown">'.$title.' <b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                   '.$st_grand_child.'
                                </ul>
                            </li>';
            }else{
                $st_tab_child.='<li class="'.$class.'"><a href="#'.$url.'"  data-toggle="tab">'.$title.'</a></li>';
                if($class=='active'){
                    $class.=' in';
                }
                $st_tab_content.='<div id="'.$url.'" class="tab-pane fade '.$class.'">'.$content.'</div>';
                $st_tab_item_id++;
            }
            $st_grand_child='';
        }
    static function st_sc_tabs_item_child($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'url'=>''
            ),$attrs));
            global $st_tab_item_id;
            global $st_grand_child;
            $title=strip_tags($title);
            if(!$url)
            {
                $url='dropdown'.$st_tab_item_id;
            }
            $class='';
            if($st_tab_item_id==0){
                $class='active';
            }
            $st_grand_child.='<li class="'.$class.'"><a href="#'.$url.'"  data-toggle="tab">'.$title.'</a></li>';
            global $st_tab_content;
            if($content)
            {
                $st_tab_content.='<div  id="'.$url.'" class="tab-pane fade '.$class.'">'.$content.'</div>';
            }
            $st_tab_item_id++;
        }
    static function  st_sc_tabs($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'style'=>' '
            ),$attrs));
            global $st_tab_child;
            global $st_tab_content;
            global $st_tab_item_id;
            $st_tab_item_id=0;
            $content=wpb_js_remove_wpautop($content);
            if($style)
            {
                $style='nav-tabs-'.$style;
            }
            $html= "
                <div class='bs-example bs-example-tabs'>
                    <ul id='myTab' class='nav nav-tabs '>
                        $st_tab_child
                    </ul>
                    <div id='myTabContent' class='tab-content'>
                        $st_tab_content
                    </div>
                </div>
            ";
            $st_tab_content='';
            $st_tab_child='';
            return $html;
        
    }
    static function st_sc_call_to_action($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'title_level'=>'',
                'button_text'=>'',
                'button_url'=>'',
                'bg_type'=>'dark',
                'align'=>'center',
                'inline'=>0,
                'button_target'=>''
            ),$attrs));
            $content=wpb_js_remove_wpautop($content);
            $color_class='white';
            $call_level=1;
            if($bg_type=='white')
            {
                $color_class='';
                $call_level=2;
            }
            if($inline==1)
            {
                return "<div class='clearfix call-action-$call_level call-action-inline '><div class=\"action-5-info\">
								<h3 class=\"$color_class\"><small class=\"white\">$title</small></h3>
								$content
                            </div>
                        <div class=\"action-5-btn\">
							    <a href=\"$button_url\" target=\"$button_target\" class=\"btn btn-primary btn-lg btn-responsive\">$button_text</a>
						    </div>
						</div>
                            ";
            }else
            {
            return "<div class='clearfix call-action-$call_level text-$align'><div class=\"col-md-12\">
                        <h3 class=\"$color_class\"><small class=\"$color_class\">$title</small></h3>
                        $content
                    </div>
                    <div class=\"col-md-12 action-btn\">
                        <a href=\"$button_url\" class='btn btn-primary btn-lg btn-responsive' target='$button_target'>$button_text</a>
                    </div>
                    </div> ";
            }
        
    }
    static function st_sc_toggle($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
            ),$attrs));
            global $st_toogle_item;
            $st_toogle_item=1;
            $content=wpb_js_remove_wpautop($content);
            return "<div class='panel-group $class' id='accordion'>".$content.'</div>';
        }
    static function st_sc_toggle_item($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'title'=>'',
            ),$attrs));
            global $st_toggle_item;
            $content=wpb_js_remove_wpautop($content);

            $html= "<div class=\"panel panel-default\">
                                <div class=\"panel-heading\">
                                     <h4 class=\"panel-title collapsed\" data-toggle=\"collapse\" data-target=\"#collapse_$st_toggle_item\">
            <i class=\"icon ion-arrow-down-b\"></i> $title
            </h4>
                                </div>
                                <div id=\"collapse_$st_toggle_item\" class=\"panel-collapse collapse '.$class.'\" style=\"height: auto;\">
                                    <div class=\"panel-body\">
                                        $content
                                    </div>
                                </div>
                            </div>";
            $st_toggle_item++;
            return $html;
        
    }
    static function st_sc_bootstrap_quote($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'author'=>''
            ),$attrs));
            $author=strip_tags($author);
            $content=wpb_js_remove_wpautop($content);
            return '<blockquote class="'.$class.'">
                        '.$content.'
                        <small class="small">'.$author.'</small>
                    </blockquote>';
    
    }
    static function st_sc_google_map($attrs,$content=false){
            extract(shortcode_atts(array(
                'address'=>'93 Worth St, New York, NY',
                'type'=>1,
                'marker'=>'',
                'height'=>'480',
                'lightness'=>0,
                'saturation'=>-100,
                'gama'=>0.5,
                'zoom'=>13,
                'longitude'=>false,
                'latitude'=>false
            ),$attrs));
            if(!$marker)
            {
                $marker_url=get_template_directory_uri().'/img/marker.png';
            }else
            {
                $marker_url=wp_get_attachment_image_src($marker);
                if(isset($marker_url[0]))
                {
                    $marker_url=$marker_url[0];
                }else
                {
                    $marker_url=get_template_directory_uri().'/img/marker.png';
                }
            }
            return "<div class='map_wrap'><div data-type='{$type}' data-lat='{$latitude}' data-lng='{$longitude}' data-zoom='{$zoom}' style='height: {$height}px' data-lightness='{$lightness}' data-saturation='{$saturation}' data-gama='{$gama}'  class='st_google_map' data-address='{$address}' data-marker='$marker_url'>
                    </div></div>";
        
    }
    static function st_sc_liquid_slider($attrs,$content){
            extract(shortcode_atts(array(
                'speed'=>4500
            ),$attrs));

            global $st_liquid_slides;
            if(is_array($st_liquid_slides)==false)
            {
                $st_liquid_slides=array();
            }
            $current_id='liquid_slider_'.count($st_liquid_slides);
            $st_liquid_slides[]=$current_id;
            wp_localize_script('themescript','theme_slider',$st_liquid_slides);
            return "<div id='$current_id' data-speed='{$speed}' class='liquid-slider'>".do_shortcode($content).'</div>';
        
    }
    static  function st_sc_post_list($attrs,$content=false){
            extract(shortcode_atts(array(
                'posts_per_page'=>10
            ),$attrs));
            $arg=array(
                'post_type'=>'post',
                'paged'=>isset($_GET['st_paged'])?$_GET['st_paged']:1,
                'posts_per_page'=>$posts_per_page
            );
            query_posts($arg);
            $html='';
            $html=get_template_part('loop');
            wp_reset_query();
            return $html;
        
    }
    static function st_sc_progressbar($attrs,$content=false){
            extract(shortcode_atts(array(
                'name'=>'',
                'percent'=>'',
            ),$attrs));
            return "
                <p class='skill-name'><em>$name</em></p>
                <div class='skillbar' data-percent='$percent%'>
                    <div class='skillbar-title'>
                        <span>$percent%</span>
                    </div>
                    <div class=\"skillbar-bar\"></div>
                </div>
            ";
        
    }
    static function st_sc_list($attrs,$content=false){
            extract(shortcode_atts(array(
                'type'=>'1',
                'class'=>'',
            ),$attrs));
            $holder="ul";
            switch($type)
            {
                case 2:
                    $holder="ol";
                    break;
                case 3:
                    $class.=" check-list-1";
                    break;
                case 4: $class.=" check-list-2";break;
                case 5: $class.=" check-list-3";break;
                case 6: $class.=" chevron-list-1";break;
                case 7: $class.=" dot-circle-list";break;
                case 8: $class.=" chevron-list-2";break;
            }
            global $st_list_content;
            $content=wpb_js_remove_wpautop($content);
            $html= "<$holder class='$class'>
                        $st_list_content
                    </$holder>";
            $st_list_content=false;
            return $html;
        }
    static function st_sc_list_li($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
            ),$attrs));
            $content=wpb_js_remove_wpautop($content);
            global $st_list_content;
            $st_list_content.="<li class='$class'>
                        $content
                    </li>";
        
    }
    static function st_sc_label($attrs,$content=false){
            extract(shortcode_atts(array(
                'type'=>'default',
                'class'=>'',
                'holder'=>'span'
            ),$attrs));
            $content=do_shortcode($content);
            return "<$holder class='$class label label-$type'>$content</$holder>";
        
    }
    static function st_sc_tooltip($attrs,$content=false){
            extract(shortcode_atts(array(
                'holder'=>'a',
                'position'=>'top',
                'tip'=>'',
                'class'=>''
            ),$attrs));
            $content=do_shortcode($content);
            return "
                <$holder class='$class' data-toggle=\"tooltip\" data-placement=\"$position\" data-original-title=\"$tip\">
                    $content
                </$holder>
            ";
        
    }
        static function st_sc_testimonial($attrs,$content=false){
            extract(shortcode_atts(array(
                'author_name'=>'',
                'author_img'=>'',
            ),$attrs));
            //fix by dannie remove </p> tag on head
            $content=ltrim($content,'</p>');
            $content=rtrim($content,'<p>');
            $content=wpb_js_remove_wpautop($content);
            $image='';
            if($author_img)
            {
                $image=wp_get_attachment_image($author_img,array(100,100),false,array('class'=>'testimonial-img','alt'=>$author_name));
            }
            return "
                    <div class=\"col-lg-12 white testimonials text-center\">
                            $image
                            <h4>
                                <i class='fa fa-quote-left highlight'></i>
                                    $content
                                <i class=\"fa fa-quote-right highlight\"></i>
                            </h4>
                            <p class=\"label label-primary\">$author_name</p>
                        </div>
            ";
        
    }
    
    static function st_sc_button($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'type'=>'default',
                'holder'=>'button',
                'url'=>'',
                'size'=>'',
                'target'=>""
            ),$attrs));
            if($url)
            {
                $holder="a";
                $url="href='$url'";
            }
            if($size)
            {
                $size='btn-'.$size;
            }
            $content=do_shortcode($content);
            return"
                <$holder $url class='btn btn-$type $class $size'>
                    $content
                </$holder>
            ";
        
    }
    static function st_sc_alert($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'type'=>'default',
                'effect'=>'fade in',
                'holder'=>'div'
            ),$attrs));
            $content=do_shortcode($content);
            return "
                <$holder class='alert alert-$type $effect $class'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
                    $content
                </$holder>
            ";
        
    }
    static function st_sc_hight_light_bg($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
            ),$attrs));
        
    }
    static  function st_sc_price($attrs,$content=false){
            global $st_textdomain;
            extract(shortcode_atts(array(
                'type'=>1,
                'title'=>'',
                'price_amount'=>'',
                'price_currency'=>'',
                'price_base'=>'',
                // 'number_email'=>'',
                // 'number_projects'=>'',
                // 'number_users'=>'',
                // 'number_storage'=>'',
                'signup_text'=>'',
                'signup_url'=>''
            ),$attrs));
            $email_support=__("Email Support",$st_textdomain);
            $projects=__("Projects",$st_textdomain);
            $users=__("Users",$st_textdomain);
            $storage=__("Storage",$st_textdomain);
            $class='price-box';
            if($type=='3')
            {
                $class='price-box-big';
            }
            $pric_title='';
            switch($type)
            {
                case 1 : $pric_title="<h3>{$title}</h3>";
                    break;
                case 2 : $pric_title="<h2>{$title}</h2>";
                    break;
                case 3 : $pric_title="<h1>{$title}</h1>";
                    break;
            }
            $signup='';
            if($signup_text)
            {
                $btn='';
                if($type==3)
                {
                    $btn='btn-lg';
                }
                $signup="<div class=\"sign-up-btn\">
                    <a href=\"{$signup_url}\" class='btn btn-primary {$btn}'>{$signup_text}</a>
                                    </div>";
            }
            $html= "
                <div class='$class text-center'>
                    <div class='price-box-info'>
                        $pric_title
                        <h2>{$price_amount}<span>{$price_currency}</span><small>/{$price_base}.</small></h2>
                    </div>
                    <div class=\"price-box-offer\">
                        ";
                           $html.=wpb_js_remove_wpautop($content);
                        $html.="
                    </div>
                    $signup
                </div>
            ";
            return $html;
        
    }
    static  function st_sc_social_item($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'sub_title'=>'',
                'icon'=>'',
                'url'=>''
            ),$attrs));
            return "
                <p class='connected-icon'>
                    <a href='$url'>
                        <span class='fa-stack fa-lg fa-4x'>
                            <i class='fa fa-circle fa-stack-2x'></i>
                            <i class='fa fa-{$icon} fa-stack-1x fa-inverse'></i>
                        </span>
                        <br>
                        <span class='lead'>
                        $title
                        </span>
                        <br>
                        <span class='white'>
                        $sub_title
                        </span>
                    </a>
                </p>
            ";
        
    }
    static function st_sc_portfolios_grid($attrs,$content=false){
            $data=shortcode_atts(array(
                'posts_per_page'=>9,
                'category'=>'',
                'orderby'=>'none',
                'order'=>'asc',
                'style'=>'style1',
            ),$attrs);

            global $st_portfolio_data, $style;
            $st_portfolio_data=$data;

            extract($data);

            global $st_textdomain;

            $html='';
            $htmlcontain = '<div><ul>';
            if($style == 'style1'){
                $htmlcontain ='<div id="grid-container" class="cbp-l-grid-projects">';
                $htmlcontain .='<ul class="grid cs-style-3">';
            }else if($style == 'style2'){
                $htmlcontain  = ' <div id="grid-container-fullwidth" class="cbp-l-grid-fullScreen"><ul>'; 
            }else if($style == 'style3'){
                $htmlcontain  = ' <div id="grid-container-masonry" class="cbp-l-grid-masonry"><ul>'; 
            }else{$htmlcontain = '<div><ul>';}
            
            if($style == 'style1'){
                $html.='<div id="filters-container" class="cbp-l-filters-button">';
            }elseif ($style == 'style2') {
                $html .= ' <div id="filters-container-fullwidth" class="cbp-l-filters-alignCenter">';
            }elseif ($style == 'style3') {
                $html .= ' <div id="filters-container-masonry" class="cbp-l-filters-alignRight">';
            }
            else{
                $html .= '<div>';
            }

            $html.="<div data-filter=\"*\" class=\"cbp-filter-item-active cbp-filter-item\">".__('All',$st_textdomain)."
            <div class=\"cbp-filter-counter\"></div>
            </div>";



            $args=array(
                'hierarchical'=>false,
                'parent'=>0,
                'taxonomy'=>'portfolio_cat',

            );

            if($category)
            {
                $args['include']=explode(',', $category);
            }
            $categories = get_categories( $args );
            if(!empty($categories))
            {
                foreach($categories as $key=>$value){
                   
                        $html.="<div data-filter='.{$value->slug}' class=\"cbp-filter-item\">{$value->name}
                        <div class=\"cbp-filter-counter\"></div>
                        </div>";

                }
            }
            $html.='</div><!--End #filters-container-->';


            $html.= $htmlcontain;
            //$posts_per_page=3;
            //Loop portfoliio
            $args=array(
                'post_type'=>'portfolio',
                'posts_per_page'=>$posts_per_page,
                'order'=>$order,
                'orderby'=>$orderby,
                
            );
            if($category)
            {
                $args['tax_query'][]=array(
                        'taxonomy'=>'portfolio_cat',
                        'field'=>'term_id',
                        'operator'=>'in',
                        'terms'=>explode(',', $category)
                    );
            }

     
            query_posts($args);
            $html.=st_load_template('loop','portfolio');
            $html.='</ul>';
            $html.="</div><!--End #grid-container-->";
            global $wp_query;
            if($wp_query->found_posts>$posts_per_page)
            {
                $loadMoreUrl=site_url('?load_more_portfolio=1&amp;posts_per_page='.$posts_per_page);

                $st_portfolio_data['load_more_portfolio']=1;
                $loadMoreUrl=site_url('?'.http_build_query ($st_portfolio_data));

                $html.="<div  class=\"cbp-l-loadMore-button\">
                            <a href=\"{$loadMoreUrl}\" class=\"cbp-l-loadMore-button-link\">".__('Load More',$st_textdomain)."</a></div>";
            }

            wp_reset_query();
        


            return $html;
        
    }
    static function st_sc_purchase($attrs,$content=fale){
            extract(shortcode_atts(array(
                'btn_text'=>'',
                'btn_url'=>'',
                'btn_type'=>'',
            ),$attrs));
            if($btn_type)
            {
                $btn_type="btn-".$btn_type;
            }
            $content=wpb_js_remove_wpautop($content);
            return "
                <div class='action-5-info'>
                $content
                </div>
                <div class='action-5-btn'>
                    <a href='$btn_url' class='btn $btn_type btn-lg btn-responsive'>$btn_text</a>
                </div>
            ";
        
    }
    static function st_sc_qoute($attrs,$content=false){
            extract(shortcode_atts(array(
                'author'=>'',
                'amount'=>'',
            ),$attrs));

            $content=wpb_js_remove_wpautop($content,true);
            return '<div class="col-lg-12 text-center quotes">
                        '.$content.'
                        <p class="label label-primary">'.$author.'</p>
                    </div>';
            return $content;
        
    }
    static function st_sc_fact($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'amount'=>'',
            ),$attrs));
            return "<div class='fact'>
                        <span class='counter highlight'>$amount</span>
                        <p class='lead'>$title</p>
                    </div>";
        
    }
    static function st_sc_memberItem($attrs,$content=false){
            extract(shortcode_atts(array(
                'name'=>'',
                'job'=>'',
                'src'=>'',
                'fb_link'=>'',
                'tweet_link'=>'',
                'skype_id'=>'',
                'instagram_link'=>'',
                'email'=>'',
                'data_effect'=>'flipInY'
            ),$attrs));
            $content=do_shortcode($content);
            $social='';
            if($fb_link)
            {
                $social.='<a href="'.$fb_link.'" ><i class="fa fa-facebook"></i></a>';
            }
            if($tweet_link)
            {
                $social.='<a href="'.$tweet_link.'" ><i class="fa fa-twitter"></i></a>';
            }
            if($skype_id)
            {
                $social.='<a href="skype:'.$skype_id.'" ><i class="fa fa-skype"></i></a>';
            }
            if($instagram_link)
            {
                $social.='<a href="'.$instagram_link.'" ><i class="fa fa-instagram"></i></a>';
            }
            if($email)
            {
                $social.='<a href="mailto:'.$email.'" ><i class="fa fa-envelope"></i></a>';
            }
            if($job)
            {
                $job="<br><small class='highlight'>$job</small>";
            }
            $image=wp_get_attachment_image_src($src,array(650,500,'bfi_thumb'=>true));
            if(isset($image[0]) and $image[0])
            {
                $image=$image[0];
            }else{
                $image='';
            }
            return "
                <div class='team-member wow image_xxx $data_effect'>
                    <ul class='grid cs-style-3'>
                        <li>
                            <figure>
                                <img src='$image' alt='{$name}' />
                                <figcaption>
                                    $social
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                    <div class='team-info'>
                        <h4>
                        $name
                        $job
                        </h4>
                        <p>
                        $content
                        </p>
                    </div>
                </div>
                    ";
        
    }
    static function st_sc_section_title($attrs,$content=false){
            extract(shortcode_atts(array(
                'title'=>'',
                'sub_title'=>'',
            ),$attrs));
//            echo "<pre>";
//            var_dump($content);
//
//            echo "</pre>";
            $content=do_shortcode($content);
            return $content;
            //return "<div class='section-title-team'>".$content."</div>";
            // return "<h2 class=''>
            // $title
            // <br>
            // <small>$sub_title</small>
            // </h2>
            // $content
            // ";
        
    }
    static function st_sc_skill($attrs,$content=false)
        {
            extract(shortcode_atts(array(
                'title'=>'',
                'level'=>0,
                'animate'=>''
            ),$attrs));
            return "
                <p class='skill-name'><em>{$title}</em></p>
                <div class='skillbar' data-percent='{$level}%'>
                    <div class=\"skillbar-title\"><span>{$level}%</span></div>
                    <div class=\"skillbar-bar\"></div>
                </div>
            ";
        
    }
    static function typography_heading($attrs,$content=false){
            extract(shortcode_atts(array(
                'h'=>'1',
                'class'=>''
            ),$attrs));
            $content=do_shortcode($content);
            $class=strip_tags($class);
            $h=strip_tags($h);
            if($content){
                return  "<h{$h} class='{$class}'>".$content." </h{$h}>";
            }
    }
    static function typography_span($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>''
            ),$attrs));
            $content=do_shortcode($content);
            if($content){
                return  "<span class='{$class}'>".$content." </span>";
            }
        }
    static function typography_small($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>''
            ),$attrs));
            $content=do_shortcode($content);
            if($content){
                return  "<small class='{$class}'>".$content." </small>";
            }
        }
    static function typography_br($attrs,$content=false){
            return "<br>";
        }
    static function typography_strong($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>''
            ),$attrs));
            $content=do_shortcode($content);
            if($content){
                return  "<strong class='{$class}'>".$content." </strong>";
            }
        }
    static function typography_p($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>''
            ),$attrs));
            $class=strip_tags($class);
            $content=do_shortcode($content);
            if($content){
                return  "<p class='{$class}'>".$content." </p>";
            }
        }
    static function typography_icon($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'icon'=>''
            ),$attrs));
            $class=strip_tags($class);
            return  "<i class='icon icon-$icon $class'> </i>";
        }
    static function typography_fa_icon($attrs,$content=false){
            extract(shortcode_atts(array(
                'class'=>'',
                'icon'=>''
            ),$attrs));
            $class=strip_tags($class);
            return  "<i class='fa fa-$icon $class'>$content </i>";
        }
    static  function typography_highlight($attrs,$content=false){
           return do_shortcode("<span class='highlight'>{$content}</span>");
        }
    static function typography_home_btn($attrs,$content=false){
            extract(shortcode_atts(array(
                'url'=>'#'
            ),$attrs));
            $url=strip_tags($url);
            $content=do_shortcode($content);
            if($content){
                return  "<div class='home-btn'>
                            <h4 class='btn-home'>
                                <a href='{$url}'>
                                ".$content."
                                </a>
                            </h4>
                        </div>";
            }
        }
    static function st_sc_typography()
    {
        add_shortcode('heading',array('STShortcode','typography_heading'));
        add_shortcode('span',array('STShortcode','typography_span'));
        add_shortcode('small',array('STShortcode','typography_small'));
        add_shortcode('br',array('STShortcode','typography_br'));
        add_shortcode('strong',array('STShortcode','typography_strong'));
        add_shortcode('p',array('STShortcode','typography_p'));
        add_shortcode('icon',array('STShortcode','typography_icon'));
        add_shortcode('fa_icon',array('STShortcode','typography_fa_icon'));
        add_shortcode('highlight',array('STShortcode','typography_highlight'));
        add_shortcode('st_home_btn',array('STShortcode','typography_home_btn'));
    }
    static function st_sc_aboutbox($atts,$content=false){
            extract(shortcode_atts(array(
                'icon'		=>	'',
                'icon_bg'   =>  '',
                'title'		=> 	'',
                'sub_title'=>'',
                'effect'	=> 	'',
                'url'		=> 	'#',
                'style'		=> 	'',
                'position'=>'left'
            ), $atts));
            $icon_class ='';
            if($effect)
            {
                $effect="wow ".$effect;
            }

            $icon_2x=get_icon_string($icon);
            $icon_3x=get_icon_string($icon,'3x');
            if($url!="#" and $url)
            {
                $title="<a href='{$url}'>$title</a>";
            }
             $version = '';
             $back = '';
             $position_right='';
             $about_info = ' ';
             $about_des = ' ';
            if($position == 'right'){
                $version =' about-icon_right';
                $back = ' right_icon';
                $position_right=' text-right';
                 $about_info = ' about_right';
                 $about_des = ' about_des';
            }
           
            $html = '<div class="about-row '.$position_right.'">
                        <div class="about-icon '.$version.'">
                            <i class="'.$icon_3x.' highlight"></i>
                            <i class="'.$icon_2x.' back-icon'.$back.'"></i>
                        </div>
                        <div class="about-info '.$about_info.'" >
                            <h4>'.$title.'<br>
                                <small>'.$sub_title.'</small>
                            </h4>
                            <p class="about-description '.$about_des.'">'.$content.'</p>
                        </div>
                    </div>
                ';
            return $html;
        
    }
    static function st_sc_hight_light($atts,$content){
            return "<span class='hightlight'>{$content}</span>";
        
    }
    static function st_sc_servicebox($atts,$content=false){
            extract(shortcode_atts(array(
                'icon'		=>	'',
                'icon_bg'   =>  '',
                'title'		=> 	'',
                'sub_title'=>'',
                'effect'	=> 	'helix',
                'link'		=> 	'#',
                'style'		=> 	'',
                'position'=>'left'
            ), $atts));
            $icon_class ='';
            if($effect)
            {
                $effect="wow ".$effect;
            }

            $icon_2x=get_icon_string($icon);
            $icon_3x=get_icon_string($icon,'3x');


            $version = '';
            $back = '';
            $position_right='';
            $about_info = ' ';
            $about_des = ' ';
            if($position == 'right'){
                $version =' about-icon_right';
                $back = ' right_icon';
                $position_right=' text-right';
                 $about_info = ' about_right';
                 $about_des = ' about_des';
            }
            
            $html = '<div class="service '.$position_right.'">
                        <div class="service-icon '.$version.'">
                            <i class="icon ion-'.$icon_3x.' ion-3x highlight"></i>
                            <i class="icon ion-'.$icon_2x.' back-icon '.$back.'"></i>
                        </div>
                        <div class="service-info '.$about_info.'" >
                            <h4>'.$title.'<br>
                                <small>'.$sub_title.'</small>
                            </h4>
                            <p class="service-description '.$about_des.'">'.$content.'</p>
                        </div>
                    </div>
                ';
            return $html;
        
    }
}
 

if(class_exists('WPBakeryShortCodesContainer') and  !class_exists('WPBakeryShortCode_st_liquid_slider'))
{

    class WPBakeryShortCode_st_liquid_slider extends WPBakeryShortCodesContainer {


        function content($attrs,$content=false)
        {
            extract(wp_parse_args(array(
                'autoSlide'      =>  1,
                'auto_slide_interval'   =>  6000,
                'pauseOnHover'     =>  1,
            ), $attrs));

            global $st_liquid_slides;
            if(is_array($st_liquid_slides)==false)
            {
                $st_liquid_slides=array();
            }
            $current_id='liquid_slider_'.count($st_liquid_slides);
            $st_liquid_slides[]=$current_id;

            wp_localize_script('themescript','theme_slider',$st_liquid_slides);

            return "<div data-pauseOnHover='{$pauseOnHover}' data-autoSlide='{$autoSlide}' data-autoSlideInterval='{$auto_slide_interval}' id='$current_id' class='liquid-slider'>".do_shortcode($content).'</div>';
        }
    }
}

if(class_exists('WPBakeryShortCode') and  !class_exists('WPBakeryShortCode_st_liquid_testimonial'))
{

    class WPBakeryShortCode_st_liquid_testimonial extends WPBakeryShortCode {


        function content($attrs,$content=false)
        {
            extract(shortcode_atts(array(
                'author_name'=>'',
                'author_img'=>'',
            ),$attrs));
            //fix by dannie remove </p> tag on head
            $content=ltrim($content,'</p>');
            $content=rtrim($content,'<p>');
            $content=wpb_js_remove_wpautop($content);
            $image='';
            if($author_img)
            {
                $image=wp_get_attachment_image($author_img,array(100,100),false,array('class'=>'testimonial-img','alt'=>$author_name));
            }
            return "
                    <div class=\"col-lg-12 white testimonials text-center\">
                            $image
                            
                            $content
                                
                            <p class=\"label label-primary\">$author_name</p>
                        </div>
            ";
        }
    }
}


