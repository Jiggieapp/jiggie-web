<?php 
global $st_textdomain, $number_text;
 
while(have_posts())
{
	the_post();
	?>
		<div class="col-sm-<?php echo st_number_to_row($posts_per_row);?>">
			<div <?php post_class('blog-posts-content' ); ?>>
				<?php
				switch (get_post_format( )) {
					case 'video':
						# code...
						?>
						 <div class="fluid-width-video-wrapper post-img" style="padding-top:56.25%;">
					        <?php
					        	if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true))
					        	{
					        		$embed_code =  wp_oembed_get($video, array('height'=>750)); 
					            	echo $embed_code;	
					        	}
					        	
					        ?>

					    </div>
					   	<?php 
						break;

					case 'audio':
						# code...
						?>
						 <div class="fluid-width-video-wrapper post-img" style="padding-top:56.25%;">
					        <?php
					        	if($video=get_post_meta(get_the_ID(),'_cmb_embed_video',true))
					        	{
					        		$embed_code =  wp_oembed_get($video, array('height'=>350)); 
					            	echo $embed_code;	
					        	}
					        	
					        ?>

					    </div>
					   	<?php 
						break;

					case "image":
							echo "<a href='".get_permalink( )."'>";
    						the_post_thumbnail('full',array('class'=>'img-responsive'));
    						echo "</a>";
							
						break;

					case "gallery":

					

						$gallery = get_post_gallery( get_the_ID(), false );
						if($gallery and !empty($gallery) and isset($gallery['ids']))
							{
							    $ids=explode(',',$gallery['ids']);
							    if(!empty($ids))
							    {
							        echo '<div class="flexslider project-img"><ul class="slides">';
							        foreach($ids as $key=>$value)
							        {
							            
							            $image=wp_get_attachment_image_src($value,array(750,389,'bfi_thumb'=>true));
							            ?>
							            <li>
							                <img class="img-responsive" src="<?php echo $image[0]; ?>" />
							            </li>
							        <?php
							        }
							        echo '</ul></div>';
							    }
							}
					break;

					default:
						# code...
						break;
				}
				?>
				<div class="post-head">
                    <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <span class="meta-author"><?php _e('By',$st_textdomain);?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author( );?></a></span>
                    <?php $cate=get_the_category();
                   // var_dump($cate);
                    	if(!empty($cate))
                    	{
                    		foreach ($cate as $key => $value) {
                    			# code...
                    			?>
                    				<span class="meta-category">| <a href="<?php echo get_category_link($value ); ?>"><?php echo $value->name ; ?></a></span> 
                    			<?php
                    		}
                    	}
                    ?> 
                    <span class="meta-comment-count">| <a href="<?php comments_link()?>"> <?php _e('Comments',$st_textdomain) ?></a></span>
                </div>

				<p><?php echo st_excerpt_content($number_text); ?></p>
				<div class="blog-post-bottom">
	                <a class="date"><?php echo get_the_date('F d, Y' ); ?></a>
	                <a href="<?php the_permalink();?>" class="blog-likes"><i class="icon ion-heart"></i><span> <?php echo st_get_post_view(); ?></span></a>		
	            </div>
           	</div>
		</div>
	<?php
}