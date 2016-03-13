<?php
$pre_text="ST ";
if(function_exists('vc_map')){
	global $st_textdomain;


  vc_map(array(
      'name'=>__($pre_text.'Liquid Slider'),
      'base'=>'st_liquid_slider',
      'icon'=>'icon-st',
      'as_parent'=>array('only'=>'st_liquid_testimonial'),
      'content_element'=>true,
      'js_view'=>'VcColumnView',
      'params'=>array(
            array(
                  'type'=>'dropdown',
                  'heading'=>__('Auto Slide',$st_textdomain),
                  'param_name'=>"autoSlide",
                  'value'=>array(
                      __('Yes',$st_textdomain)=>1,
                      __('No',$st_textdomain)=>0
                    ),
                  'description'=>__('If you want the slider to automitically slide, set this to Yes.',$st_textdomain)
              ),
            array(
                  'type'=>'textfield',
                  'heading'=>__('Auto Slide Interval',$st_textdomain),
                  'param_name'=>"auto_slide_interval",
                  'value'=>6000,
                  'description'=>__('You can change this if you want the slider to transition more frequently. The lower the number, the more frequently it will change',$st_textdomain)
              ),
            array(
                  'type'=>'dropdown',
                  'heading'=>__('Pause On Hover',$st_textdomain),
                  'param_name'=>"pauseOnHover",
                  'value'=>array(
                      __('Yes',$st_textdomain)=>1,
                      __('No',$st_textdomain)=>0
                    ),
                  'description'=>__('This pauses the slider when someone hovers over it. Note that it doesn\'t work on crosslinks.',$st_textdomain)
              )

        )

    ));

vc_map(array(
      'name'=>__($pre_text.'Post Grid'),
      'base'=>'st_post_grid',
      'icon'=>'icon-st',
      'content_element'=>true,
      'params'=>array(
            array(
               "type"      => "dropdown",
               "holder"    => "div",
               "class"     => "",
               "heading"   => __("Items per row", $st_textdomain),
               "param_name"=> "posts_per_row",
               "value"     => 
                  array(1,2,3,4,6,12),
               "description" => __("Items per row", $st_textdomain),
            ),
          array(
               "type"      => "textfield",
               "holder"    => "div",
               "class"     => "",
               "heading"   => __("Number Items", $st_textdomain),
               "param_name"=> "posts_per_page",
               "value"     => "3",
               "description" => __("Total items will be showing ", $st_textdomain)
            ),
          array(
               "type"      => "checkbox",
               "holder"    => "div",
               "class"     => "",
               "heading"   => __("Categories", $st_textdomain),
               "param_name"=> "category",
               "value"     => st_get_list_taxonomy('category'),
               "description" => __("If you want to show Post of all categories, you only need tick 'All Categories'", $st_textdomain)
            ),
          array(
               "type"      => "dropdown",
               "holder"    => "div",
               "class"     => "",
               "heading"   => __("Order By", $st_textdomain),
               "param_name"=> "orderby",
               "value"     => st_get_list_order_by(),
            ),
          array(
               "type"       => "textfield",
               "holder"     => "div",
               "class"      => "",
               "heading"    => __("Number text", $st_textdomain),
               "param_name" => "number_text",
               "value"      => 30,
               "description"=> __("Number text you want to display in each post"),
            ),

          array(
               "type"      => "dropdown",
               "holder"    => "div",
               "class"     => "",
               "heading"   => __("Order", $st_textdomain),
               "param_name"=> "order",
               "value"     => array(
                  __("Asc",$st_textdomain)=>'asc',
                  __('Desc',$st_textdomain)=>'desc'
                ),
            ),

        )

    ));


vc_map( array(
   "name"      => __($pre_text." Liquid Testimonial", $st_textdomain),
   "base"      => "st_liquid_testimonial",
   'content_element'=>true,
   "icon" => "icon-st",
   "as_child" => array('only' => 'st_liquid_slider'),
   "params"    => array(
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author Name", $st_textdomain),
         "param_name"=> "author_name",
         "value"     => "",
         "description" => __("Author Name", $st_textdomain)
      ),
       array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author's image", $st_textdomain),
         "param_name"=> "author_img",
         "value"     => "",
         "description" => __("Author's image", $st_textdomain)
      ),
    array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),

    )));


   


	vc_map( array(
   "name" => __($pre_text."Services box"),
   "base" => "servicebox",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", $st_textdomain),
         "param_name" => "title",
         "value" => "Web Design",
         "description" => __("Title display in Services box.", $st_textdomain)
      ),
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Sub Title", $st_textdomain),
         "param_name" => "sub_title",
         "value" => "Crafting with Love ",
         "description" => __("Text display under title in service box.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon", $st_textdomain),
         "param_name" => "icon",
         "value" => 'laptop',
         "description" => __("NOTE: Use fa-<em>icon_code</em> for <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome</a> and Use ion-<em>icon_code</em> for <a href='http://ionicons.com/' target='_blank'>IonIcons</a>", $st_textdomain)
      ),
       array(
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => __("Icon align", $st_textdomain),
           "param_name" => "position",
           "value" => array(
              __('Left',$st_textdomain)=>'left',
              __('Right',$st_textdomain)=>'right'
            ),
       ),
       array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content", $st_textdomain),
         "param_name" => "content",
         "value" => "Lorem Ipsum is simply dummy Lorem Ipsum has been the industry's standard dummy text..",
         "description" => __("About your Services.", $st_textdomain)
      ),
    )
    ));
}
//memberItem
if(function_exists('vc_map')){
	vc_map( array(
   "name" => __($pre_text."Member Item ", $st_textdomain),
   "base" => "memberitem",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Member's name", $st_textdomain),
         "param_name" => "name",
         "value" => "",
         "description" => __("Member's Name", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Job", $st_textdomain),
         "param_name" => "job",
         "value" => "",
         "description" => __("Member's job.", $st_textdomain)
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Avarta",
         "param_name" => "src",
         "value" => "",
         "description" => __("Avarta of member.", $st_textdomain)
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content", $st_textdomain),
         "param_name" => "content",
         "value" => "It was popularised in the 1960s with the release of Letraset..",
         "description" => __("About member.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Facebook Url", $st_textdomain),
         "param_name" => "fb_link",
         "value" => "",
         "description" => __("Facebook Url to contact.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Twitter Url", $st_textdomain),
         "param_name" => "tweet_link",
         "value" => "",
         "description" => __("Twitter Url to contact.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Skype username", $st_textdomain),
         "param_name" => "skype_id",
         "value" => "",
         "description" => __("Skype username to contact.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Instagram Url", $st_textdomain),
         "param_name" => "instagram_link",
         "value" => "",
         "description" => __("Instagram Url to contact.", $st_textdomain)
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Email address", $st_textdomain),
         "param_name" => "email",
         "value" => "",
         "description" => __("Email to contact.", $st_textdomain)
      )
      
      
    )));
}
//Clear fix
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __($pre_text."Clear fix", $st_textdomain),
   "base"      => "clearfix",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "Clear fix",
         "description" => ""
      ),
      
    )));
}
//Product List
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __($pre_text." Product List", $st_textdomain),
   "base"      => "st_product_list",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
       array(
           "type"      => "textfield",
           "holder"    => "div",
           "class"     => "",
           "heading"   => __("Posts per page", $st_textdomain),
           "param_name"=> "posts_per_page",
           "value"     => "10",
           "description" => __("Posts per page.", $st_textdomain)
       ),
       array(
           "type"      => "dropdown",
           "holder"    => "div",
           "class"     => "",
           "heading"   => __("Style for product grid", $st_textdomain),
           "param_name"=> "style_shop",
            "value" => array(
              __('Style  1',$st_textdomain)=>'style1',
              __('Style  2',$st_textdomain)=>'style2'
            ),
           "description" => __("Posts per page.", $st_textdomain)
       )
    )));
}
//Contact Info
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __($pre_text." Contact Info", $st_textdomain),
   "base"      => "contact_info",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
       array(
           "type"      => "textfield",
           "holder"    => "div",
           "class"     => "",
           "heading"   => __("Phone number", $st_textdomain),
           "param_name"=> "phone",
           "value"     => "",
           "description" => __("Phone number.", $st_textdomain)
       ),
       array(
           "type"      => "textarea",
           "holder"    => "div",
           "class"     => "",
           "heading"   => __("Content", $st_textdomain),
           "param_name"=> "content",
           "value"     => "",
           "description" => __("Content.", $st_textdomain)
       )
    )));
}
 //Social Items
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __($pre_text."Social Item", $st_textdomain),
   "base"      => "st_social_item",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "",
         "description" => __("Title.", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Sub title", $st_textdomain),
         "param_name"=> "sub_title",
         "value"     => "",
         "description" => __("Sub title.", $st_textdomain)
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon", $st_textdomain),
         "param_name"=> "icon",
         "value"     => "",
         "description" => "<a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>".__("Find more icon here.", $st_textdomain).'</a>'
      ),
	  array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __('Url',$st_textdomain),
         "param_name"=> "url",
         "value"     => "",
         "description" => __("Url.", $st_textdomain)
      ),
    )));
}
//Price item
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __($pre_text." Price Item", $st_textdomain),
   "base"      => "st_price",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Type", $st_textdomain),
         "param_name"=> "type",
         "value"     => array(
             __('Normal',$st_textdomain)=>1,
             __('Medium',$st_textdomain)=>2,
             __('High',$st_textdomain)=>3
         ),
         "description" => __("Type.", $st_textdomain)
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "",
         "description" => __("Title.", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Price Amount", $st_textdomain),
         "param_name"=> "price_amount",
         "value"     => "",
         "description" => __("Price Amount", $st_textdomain)
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Price Currency", $st_textdomain),
         "param_name"=> "price_currency",
         "value"     => "$",
      ),
	  array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __('Price Base',$st_textdomain),
         "param_name"=> "price_base",
         "value"     => "mon",
         "description" => __("Ex: mon,day,years", $st_textdomain)
      ),
	  array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __('Sign Up Text',$st_textdomain),
         "param_name"=> "signup_text",
         "value"     => "Sign Up Now",
         "description" => __("Sign Up Text", $st_textdomain)
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __('Sign Up URL',$st_textdomain),
         "param_name"=> "signup_url",
         "value"     => "#",
         "description" => __("Sign Up URL", $st_textdomain)
      ),
     array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __('Content',$st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),
    )));
}

if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Skill", $st_textdomain),
   "base"      => "skill",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "",
         "description" => __("Example: <em>User Experience</em>", $st_textdomain)
      ),
	  array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Level", $st_textdomain),
         "param_name"=> "level",
         "value"     => "",
         "description" => __("Example: <em>80</em>", $st_textdomain)
      ),

    )));
}
//ST Fact
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Fact", $st_textdomain),
   "base"      => "st_fact",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "",
         "description" => __("Title", $st_textdomain)
      ),
	  array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Amount", $st_textdomain),
         "param_name"=> "amount",
         "value"     => "",
         "description" => __("amount", $st_textdomain)
      ),
//	  array(
//		  "type" => "textfield",
//		  "heading" => __('Skill animate', $st_textdomain),
//		  "param_name" => "animate",
//		  'value'       =>'flipInX',
//		  "description" => __("Skill animate", $st_textdomain),
//		)
    )));
}
//ST Qoutes
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Quote item", $st_textdomain),
   "base"      => "st_qoute",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author", $st_textdomain),
         "param_name"=> "author",
         "value"     => "",
         "description" => __("Author of Quote", $st_textdomain)
      ),
	  array(
         "type"      => "textarea_html",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),
//	  array(
//		  "type" => "textfield",
//		  "heading" => __('Skill animate', $st_textdomain),
//		  "param_name" => "animate",
//		  'value'       =>'flipInX',
//		  "description" => __("Skill animate", $st_textdomain),
//		)
    )));
}
//ST Testimonial Item
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Testimonial Item", $st_textdomain),
   "base"      => "st_testimonial",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author Name", $st_textdomain),
         "param_name"=> "author_name",
         "value"     => "",
         "description" => __("Author Name", $st_textdomain)
      ),
       array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author's image", $st_textdomain),
         "param_name"=> "author_img",
         "value"     => "",
         "description" => __("Author's image", $st_textdomain)
      ),
	  array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),
//	  array(
//		  "type" => "textfield",
//		  "heading" => __('Skill animate', $st_textdomain),
//		  "param_name" => "animate",
//		  'value'       =>'flipInX',
//		  "description" => __("Skill animate", $st_textdomain),
//		)
    )));
}
//ST Post List
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Post List", $st_textdomain),
   "base"      => "st_post_list",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Posts Per Page", $st_textdomain),
         "param_name"=> "posts_per_page",
         "value"     => "10",
         "description" => __("Posts Per Page", $st_textdomain)
      ),
    )));
}
//ST Toggle
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Toggle", $st_textdomain),
   "base"      => "toggle_wrap",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Toggle Items", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Toggle Items", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Extra class", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Extra class", $st_textdomain)
      ),
    )));
}
//ST Alert
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Alert", $st_textdomain),
   "base"      => "alert",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Type", $st_textdomain),
         "param_name"=> "content",
         "value"     => array(
             __('Danger',$st_textdomain)=>'danger',
             __('Success',$st_textdomain)=>'success',
             __('Warning',$st_textdomain)=>'warning',
             __('Info',$st_textdomain)=>'info'
         ),
         "description" => __("Type", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Extra class", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Extra class", $st_textdomain)
      ),
    )));
}
//ST Block Qoute
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Block Quote", $st_textdomain),
   "base"      => "blockquote",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Author", $st_textdomain),
         "param_name"=> "content",
         "value"     => '',
         "description" => __("Author", $st_textdomain)
      ),array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Extra class", $st_textdomain),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Extra class", $st_textdomain)
      ),
    )));
}
//
//Call to action
if(function_exists('vc_map'))
{
    vc_map(array(
       'name'=>__('ST Call To Action',$st_textdomain),
        'base'=>'call_to_action',
        'class'=>'',
        'icon'=>'icon-st',
        'category'=>'Content',
        'params'=>array(
            array(
                'type'=>'textfield',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Title',$st_textdomain),
                'param_name'=>'title',
                'value'=>'',
                'description'=>__('Heading title',$st_textdomain),
            ),
            array(
                'type'=>'dropdown',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Title Level',$st_textdomain),
                'param_name'=>'title_level',
                'value'=>array(
                    1=>1,
                    2=>2,
                    3=>3,
                    4=>4,
                    5=>5,
                    6=>6
                ),
                'description'=>__('Heading title level',$st_textdomain),
            ),
            array(
                'type'=>'textfield',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Button text',$st_textdomain),
                'param_name'=>'button_text',
                'value'=>'',
                'description'=>__('Button text',$st_textdomain),
            ),
            array(
                'type'=>'textfield',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Button Url',$st_textdomain),
                'param_name'=>'button_url',
                'value'=>'',
                'description'=>__('Button Url',$st_textdomain),
            ),
            array(
                'type'=>'dropdown',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Open link in',$st_textdomain),
                'param_name'=>'button_target',
                'value'=>array(
                    __('New Page',$st_textdomain)=>'',
                    __('Current Page',$st_textdomain)=>'',
                ),
                'description'=>__('Button Target',$st_textdomain),
            ),
            array(
                'type'=>'dropdown',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Background style',$st_textdomain),
                'param_name'=>'bg_type',
                'value'=>array(
                    __("Dark",$st_textdomain)=>'dark',
                    __("White",$st_textdomain)=>'white'
                ),
                'description'=>__('Background style',$st_textdomain),
            ),
            array(
                'type'=>'dropdown',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Align',$st_textdomain),
                'param_name'=>'bg_type',
                'value'=>array(
                    __("Center",$st_textdomain)=>'center',
                    __("Left",$st_textdomain)=>'left',
                    __("Right",$st_textdomain)=>'right',
                ),
                'description'=>__('Text align',$st_textdomain),
            ),
            array(
                'type'=>'dropdown',
                'holder'=>'div',
                'class'=>'',
                'heading'=>__('Inline',$st_textdomain),
                'param_name'=>'bg_type',
                'value'=>array(
                    __('No',$st_textdomain)=>0,
                    __("Yes",$st_textdomain)=>1,
                ),
                'description'=>__('Heading and button are inline',$st_textdomain),
            )
        )
    ));
}
//ST Map
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Google Map", $st_textdomain),
   "base"      => "st_google_map",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
    array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Type", $st_textdomain),
         "param_name"=> "type",
         "value"     => array(
            __('Use Address',$st_textdomain)=>1,
            __('User Latitude and Longitude',$st_textdomain)=>2,
          ),
         "description" => __("Address or using Latitude and Longitude", $st_textdomain)
      ),
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Address", $st_textdomain),
         "param_name"=> "address",
         "value"     => "",
         "description" => __("Address", $st_textdomain)
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Latitude", $st_textdomain),
         "param_name"=> "latitude",
         "value"     => "",
         "description" => __("Latitude, you can get it from  <a target='_blank' href='http://www.latlong.net/convert-address-to-lat-long.html'>here</a>", $st_textdomain)
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Longitude", $st_textdomain),
         "param_name"=> "longitude",
         "value"     => "",
         "description" => __("Longitude", $st_textdomain)
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Lightness", $st_textdomain),
         "param_name"=> "lightness",
         "value"     => 0,
         "description" => __("(a floating point value between -100 and 100) indicates the percentage change in brightness of the element.", $st_textdomain)
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Saturation", $st_textdomain),
         "param_name"=> "saturation",
         "value"     => "-100",
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Gamma", $st_textdomain),
         "param_name"=> "gama",
         "value"     => 0.5,
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Zoom", $st_textdomain),
         "param_name"=> "zoom",
         "value"     => 13,
      ),
       array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Custom Marker Icon", $st_textdomain),
         "param_name"=> "marker",
         "value"     => "",
         "description" => __("Custom Marker Icon", $st_textdomain)
      ),
    )));
}
//ST Purchase
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Purchase", $st_textdomain),
   "base"      => "st_purchase",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Button text", $st_textdomain),
         "param_name"=> "btn_text",
         "value"     => "",
         "description" => __("Button text", $st_textdomain)
      ),
       array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Button Url", $st_textdomain),
         "param_name"=> "btn_url",
         "value"     => "",
         "description" => __("Button Url", $st_textdomain)
      )
       ,array(
             "type"      => "dropdown",
//             "holder"    => "div",
             "class"     => "",
             "heading"   => __("Button type", $st_textdomain),
             "param_name"=> "btn_type",
             "value"     => array(
                 __('Default',$st_textdomain)=>'default',
                 __('Primary',$st_textdomain)=>'primary',
                 __('Warning',$st_textdomain)=>'warning',
                 __('Danger',$st_textdomain)=>'danger',
                 __('Success',$st_textdomain)=>'success',
                 __("Info",$st_textdomain)=>'Info'
             ),
             "description" => __("Button type", $st_textdomain)
          ),
          array(
             "type"      => "textarea",
             "holder"    => "div",
             "class"     => "",
             "heading"   => __("Content", $st_textdomain),
             "param_name"=> "content",
             "value"     => "",
             "description" => __("Content", $st_textdomain)
          ),
    )));
}
//ST Porfolio grid
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Portfolio Grid", $st_textdomain),
   "base"      => "st_portfolio_grid",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
     array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Style for Portfolio", $st_textdomain),
         "param_name"=> "style",
         "value"     => st_get_portfolio_style(),
      ),
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Items per page", $st_textdomain),
         "param_name"=> "posts_per_page",
         "value"     => "9",
         "description" => __("Items per page", $st_textdomain)
      ),
    array(
         "type"      => "checkbox",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Categories", $st_textdomain),
         "param_name"=> "category",
         "value"     => st_get_list_taxonomy('portfolio_cat'),
         "description" => __("If you want to show Portfolio of all categories, you only need tick 'All Categories'", $st_textdomain)
      ),
    array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Order By", $st_textdomain),
         "param_name"=> "orderby",
         "value"     => st_get_list_order_by(),
      ),

    array(
         "type"      => "dropdown",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Order", $st_textdomain),
         "param_name"=> "order",
         "value"     => array(
            __("Asc",$st_textdomain)=>'asc',
            __('Desc',$st_textdomain)=>'desc'
          ),
      ),

    )));
}
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Clients", $st_textdomain),
   "base"      => "clients",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
     
		array(
         "type"      => "attach_images",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Avatar", $st_textdomain),
         "param_name"=> "gallery",
         "value"     => "",
         "description" => __("Upload Avatar", $st_textdomain)
      ),
	  
	
    )));
}
//About
if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." Stat"),
   "base"      => "stat",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
     
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Icon", $st_textdomain),
         "param_name"=> "icon",
         "value"     => "",
         "description" => __("Icon", $st_textdomain)
      ),
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Num", $st_textdomain),
         "param_name"=> "num",
         "value"     => "",
         "description" => __("Num", $st_textdomain)
      ),
		array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", $st_textdomain),
         "param_name"=> "title",
         "value"     => "",
         "description" => __("Title", $st_textdomain)
      ),
	  
	
    )));
}

if(function_exists('vc_map')){
	vc_map( array(
   "name"      => __($pre_text." About", $st_textdomain),
   "base"      => "aboutbox",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
       array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title", $st_textdomain),
           "param_name" => "title",
           "value" => "Web Design",
           "description" => __("Title display in About box.", $st_textdomain)
       ),
       array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Url", $st_textdomain),
           "param_name" => "url",
           "value" => "",
           "description" => __("Url of about box", $st_textdomain)
       ),
       array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Sub Title", $st_textdomain),
           "param_name" => "sub_title",
           "value" => "Crafting with Love ",
           "description" => __("Text display under title in About box.", $st_textdomain)
       ),
       array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Icon", $st_textdomain),
           "param_name" => "icon",
           "value" => 'laptop',
           "description" => __("NOTE: Use fa-<em>icon_code</em> for <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font Awesome</a> and Use ion-<em>icon_code</em> for <a href='http://ionicons.com/' target='_blank'>IonIcons</a>.", $st_textdomain)
       ),
       array(
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => __("Icon align", $st_textdomain),
           "param_name" => "position",
           "value" => array(
              __('Left',$st_textdomain)=>'left',
              __('Right',$st_textdomain)=>'right'
            ),
       ),
       array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content", $st_textdomain),
         "param_name" => "content",
         "value" => "Lorem Ipsum is simply dummy Lorem Ipsum has been the industry's standard dummy text..",
         "description" => __("Introduction about you", $st_textdomain)
      ),
      
    )));
}
 ?>