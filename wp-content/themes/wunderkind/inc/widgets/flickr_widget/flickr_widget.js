jQuery(document).ready(function($){

	function add_flickr_item( data , itemID ,wrapID) {
								 
		 var pic 		= data.items[itemID];
		 var smallpic 	= pic.media.m.replace('_m.jpg', '_s.jpg');

		 $(".flickr_"+wrapID).append('<li class="st-flickr-item-'+itemID+'"></li>');	
		 
		 setTimeout(function () { 
			
			var item = $("<a title='" + pic.title + "' href='" + pic.link + "' target='_blank'><img width=\"75px\" height=\"75px\" src='" + smallpic + "' /></a>").hide().fadeIn(600 , "easeInOutExpo", function() {
				$(this).parent().addClass("loaded");
			});
										
			$(".flickr_"+wrapID).find(".st-flickr-item-"+itemID).append(item);
			
		 }, 100 * itemID )
		 
		 
	  }	  

	if(typeof list_flickrs != 'undefined' && list_flickrs.length>0)
	{
		$.each(list_flickrs,function(i,v){

			if(typeof v.user_id != "undefined")
			{
				$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id="+v.user_id+"&format=json&jsoncallback=?", function(data) {
							  
						for (i=1; i <= v.number_images; i++) {
							add_flickr_item(data , i,v.flickr_widget_id);							
					    }
						  
				  });
			}

			

		});

	}




});

