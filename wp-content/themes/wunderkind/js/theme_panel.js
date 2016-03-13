
/* ==============================================
Theme Panel Style Switcher
=============================================== */
jQuery(document).ready(function($)
{


    $( "#theme-panel .panel-btn" ).click(function(){
        $( "#theme-panel" ).toggleClass( "panel-close", "panel-open", 800 );
        $( "#theme-panel" ).toggleClass( "panel-open", "panel-close", 400 );
        return false;
    });

    $('.color-switch').click(function(){
        var title = jQuery(this).attr('title');
        var new_url=st_params.theme_url;
        console.log(new_url+'/css/colors/' + title + '.css');
        jQuery('#color-skin-css').attr('href', new_url+'/css/colors/' + title + '.css');
        return false;
    });

});
