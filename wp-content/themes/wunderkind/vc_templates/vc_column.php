<?php
global $st_use_container;
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'wap_class' => '',
    'effect' =>'',
    'css'=>'',
//    'fullwidth'=>'no'
    'col_id'=>'',
    'is_slider'=>0,
    'slide_speed'=>4500
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

if($effect)
{
    $effect=" wow ".$effect;
}
$el_class .=$effect.' ';

//$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if($is_slider)
{
    $content="[liquid_slider speed='{$slide_speed}']{$content}[/liquid_slider]";
}

if($col_id) $col_id='id="'.$col_id.'"';
if($wap_class) $wap_class='class=" '.$wap_class.'"';



$output .= "\n\t".'<div data-x class="'.$css_class.'">';
//$output .= "\n\t\t".'<div data-y'.$col_id.' '.$wap_class.' >';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;