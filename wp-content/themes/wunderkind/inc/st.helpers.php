<?php


if(!function_exists('st_get_option'))
{
    function st_get_option($key,$default=false)
    {
        global $st_theme_option;
        if(isset($st_theme_option[$key]))
        {
            return $st_theme_option[$key];
        }else{
            return $default;
        }
    }
}


if(!function_exists('st_get_option_media')){
    function st_get_option_media($key,$default=false)
    {
        global $st_theme_option;
        if(isset($st_theme_option[$key]['url']))
        {
            return $st_theme_option[$key]['url'];
        }else{
            return $default;
        }
    }
    
    
}


if(!function_exists('st_hex2rgb')){

    function st_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);
       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }
}

if(!function_exists('st_blog_paging'))
{
    function st_blog_paging()
    {
        global $wp_query;
        global $st_textdomain;
        $posts_per_page=$wp_query->query_vars['posts_per_page'];
        $paged=$wp_query->query_vars['paged']?$wp_query->query_vars['paged']:1;
        $html='<div class="pager">';
        $current_url=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        if($paged<ceil($wp_query->found_posts/$posts_per_page))
        {
            $html.='<a href="'.st_buildUri('paged',($paged+1)).'"><button type="button" class="btn btn-primary" style="float:left"><i class="icon ion-arrow-left-b"></i> '.__('Older',$st_textdomain).'</button></a>';
        }
        if($paged>1)
        {
            $html.='<a href="'.st_buildUri('paged',($paged-1)).'"><button type="button" class="btn btn-primary" style="float:right">'.__("Newer",$st_textdomain).' <i class="icon ion-arrow-right-b"></i></button></a>';
        }
        $html.='</div>';
        echo $html;
    }
}


if(!function_exists('st_buildUri'))
{
    function st_buildUri($name,$value){
        $current_url=st_curPageURL();
        $_GET[$name]=$value;
        return $current_url.'?'.http_build_query ($_GET);
    }
}
if(!function_exists('st_curPageURL'))
{
    function st_curPageURL() {
        $pageURL = 'http';
        if (isset($_SERVER['HTTPS']) and $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
        }
        $pageURL=rtrim($pageURL,'index.php');
        return $pageURL;
    }
}

if(!function_exists('st_strip_shortcode_gallery'))
{
    function  st_strip_shortcode_gallery( $content ) {
        preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
        if ( ! empty( $matches ) ) {
            foreach ( $matches as $shortcode ) {
                if ( 'gallery' === $shortcode[2] ) {
                    $pos = strpos( $content, $shortcode[0] );
                    if ($pos !== false)
                        return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
                }
            }
        }
        return $content;
    }
}

if(function_exists('st_is_ajax')==false)
{
    function st_is_ajax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                return true;
            }
            {
                return false;
            }
    }
}

if(!function_exists('pre_process_icon'))
{
    function pre_process_icon($icon_code=false)
    {

        $icon_code=trim($icon_code);
        $r=array(
                'type'=>'',
                'icon'=>''
            );        

        if($icon_code)
        {
            if(substr($icon_code,0,3)=='fa-')
            {
                $r['type']='fa';
                $r['icon']=substr($icon_code,3);
            }elseif(substr($icon_code,0,4)=='ion-')
            {
                $r['type']='ion';
                $r['icon']=substr($icon_code,4);
            }else
            {
                $r['type']='ion';
                $r['icon']=$icon_code;
            }
        }


        return $r;
    }
}

if(!function_exists('get_icon_string'))
{
    function get_icon_string($icon_code_str,$size='')
    {

        $icon_code=pre_process_icon($icon_code_str);

        if(isset($icon_code['type']) and isset($icon_code['icon']))
        {
            switch ($icon_code['type']) {
                case 'fa':
                    
                    if($size)
                    {
                        $size='fa-'.$size;
                    }
                    $str='fa fa-'.$icon_code['icon'].' '.$size;
                    return $str;

                    break;
                
                case 'ion':

                    if($size)
                    {
                        $size='ion-'.$size;
                    }
                    $str='ion-'.$icon_code['icon'].' '.$size;
                    return $str;
                break;
            }
        }
    }
}


if(!function_exists('st_remove_wpautop'))
{
    function st_remove_wpautop($content, $autop = false ) {


        if(function_exists('wpb_js_remove_wpautop'))
        {
            return wpb_js_remove_wpautop($content,$autop);
        }else
        {
            if ( $autop ) { // Possible to use !preg_match('('.WPBMap::getTagsRegexp().')', $content)
                $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
            }
            return do_shortcode( shortcode_unautop( $content) );
        }
    }
}

if(!function_exists('st_get_template_part'))
{
    function st_get_template_part($file=false,$slug=false,$data=array(),$echo=false)
    {
        extract($data);
        if($echo)
        {
            get_template_part($file, $slug);
            return;
        }

        ob_start();
            get_template_part($file, $slug);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }
}
if(!function_exists('st_load_template'))
{
    function st_load_template($file=false,$slug=false,$data=array(),$echo=false)
    {
        extract($data);

        if($slug)
        {
            $template_file=get_template_directory().'/st_templates/'.$file.'-'.$slug.'.php';
            $core_template_file=ST_CORE_DIR.'/templates/'.$file.'-'.$slug.'.php';
        }else {
            # code...
            $template_file=get_template_directory().'/st_templates/'.$file.'.php';
            $core_template_file=ST_CORE_DIR.'/templates/'.$file.'.php';
        }      

        if(file_exists($template_file))
        {
            if($echo)
            {
                //get_template_part($file, $slug);
                include $template_file;
                return;
            }

            ob_start();
                include $template_file;
            $var = ob_get_contents();
            ob_end_clean();
            return $var;

        }elseif(file_exists($core_template_file))
        {
            if($echo)
            {
                //get_template_part($file, $slug);
                include $core_template_file;
                return;
            }

            ob_start();
                include $core_template_file;
            $var = ob_get_contents();
            ob_end_clean();
            return $var;        
        }else
        {
            st_log('FILE not found: '.$core_template_file);
            return;
        }

        // if($slug and file_exists($file.'-'.$slug.'.php'))
        // {
        //     $file=$file.'-'
        // }


        // if($echo)
        // {
        //     get_template_part($file, $slug);
        //     return;
        // }

        // ob_start();
        //     get_template_part($file, $slug);
        // $var = ob_get_contents();
        // ob_end_clean();
        // return $var;
    }
}

// if(!function_exists('st_include_template'))
// {
//     function st_include_template($file=false,$data=array(),$echo=false)
//     {

//         if(is_array($data))
//         {
//             extract($data);
//         }
        
//         $file =$file.'.php';              

//         $template_file=get_template_directory().'/st_templates/'.$file;
//         $core_template_file=ST_CORE_DIR.'/template/'.$file;

//         if(file_exists($template_file))
//         {
//             $file_new=$template_file;


//         }elseif(file_exists($core_template_file))
//         {
//             $file_new=$core_template_file;
//         }else
//         {
//             st_log('FILE not found: '.$core_template_file);
//             return;
//         }

//         st_include_file($file_new,$data,$echo);

        
//     }
// }

// if(!function_exists('st_include_file'))
// {
//     function st_include_file($file_new,$data=array(),$echo=false)
//     {

//         extract($data);

//         if($echo)
//         {
//             include $file_new;
//             return;
//         }

//         ob_start();
//             include $file_new;
//         $var = ob_get_contents();
//         ob_end_clean();
//         return $var;
//     }
// }

if(!function_exists('st_number_to_row'))
{
    function st_number_to_row($item_per_row=1)
    {
        switch ($item_per_row) {
            case 12:
                # code... 
                    return 1;
                break;
            
            case 6:
                # code... 
                    return 1;
                break;
            case 4:
                # code... 
                    return 3;
                break;
            case 3:
                # code... 
                    return 4;
                break;
            case 2:
                # code... 
                    return 6;
                break;
            case 1:
                # code... 
                    return 12;
                break;
        }
    }
}

if(!function_exists('st_set_post_view'))
{
    function st_set_post_view($post_id=false)
    {
        if(!$post_id)
        {
            $post_id=get_the_ID();
        }

        $old=get_post_meta($post_id,'views_count',true);
        if(!$old)
        {
            $old=0;
        }
        $old++;

        update_post_meta($post_id,'views_count',$old);




    }
}

if(!function_exists('st_get_post_view'))
{
    function st_get_post_view($post_id=false)
    {
        if(!$post_id)
        {
            $post_id=get_the_id();
        }
        return (int) get_post_meta($post_id,'views_count',true);
    }

}
if(!function_exists('st_log'))
{
    function st_log($str,$message_type=3)
    {
        error_log(date('Y-m-d H:i:s').': '.$str."\n", $message_type, ST_CORE_DIR."/logs/log-".date('Y-m-d').".log");
    }
}

if(!function_exists('st_get_list_taxonomy'))
{
    function st_get_list_taxonomy($tax='category',$array=array())
    {
        global $st_textdomain;
        $taxonomies = get_terms($tax,$array);

        $r=array();

        $r[__('All Categories',$st_textdomain)]=0;

        if(!is_wp_error($taxonomies))
        {

            foreach ($taxonomies as $key => $value) {
                # code...
                $r[$value->name]=$value->term_id;

            }
        }

        return $r;
    }
}
if(!function_exists('st_get_list_order_by'))
{
    function st_get_list_order_by()
    {
        global $st_textdomain;
        return array(
                __('None',$st_textdomain)=>'none',
                __('ID',$st_textdomain)=>'ID',
                __('Author',$st_textdomain)=>'author',
                __('Title',$st_textdomain)=>'title',
                __('Name',$st_textdomain)=>'name',
                __('Type',$st_textdomain)=>'type',
                __('Date',$st_textdomain)=>'date',
                __('Modified',$st_textdomain)=>'modified',
                __('Parent',$st_textdomain)=>'parent',
                __('Rand',$st_textdomain)=>'rand',
                __('Comment Count',$st_textdomain)=>'comment_count',
            );
    }
}

if(!function_exists('st_get_widget_area'))
{
    function st_get_widget_area()
    {
        global $wp_registered_sidebars;

        if(!empty($wp_registered_sidebars))
        {
            $r=array();
            foreach ($wp_registered_sidebars as $key => $value) {
                # code...
                $r[$key]=$value['name'];

            }
            return $r;
        }

    }
}

if(!function_exists('st_excerpt_content'))
{
function st_excerpt_content($limit){
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if(count($excerpt)>= $limit){
        array_pop($excerpt);
         $excerpt = implode(" ",$excerpt).'...';
    }else{
    $excerpt=implode(" ", $excerpt);
    }
    $excerpt =preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
}

if(!function_exists('st_get_portfolio_style'))
{
    function st_get_portfolio_style()
    {
        global $st_textdomain;
        return array(
                __('Fullwidth with single detail',$st_textdomain)=>'style1',
                __('Fullwidth only content',$st_textdomain)=>'style2',
                __('Mansory',$st_textdomain)=>'style3',
            );
    }
}