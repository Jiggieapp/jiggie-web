<?phpglobal $st_textdomain;?><form role="search" method="get" id="searchform" action="<?php echo  esc_url( home_url( '/'  ) )?>">    <div class="input-group">        <input type="text" class="form-control" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="<?php echo __('Search Shop',$st_textdomain) ?>">            <span class="input-group-btn">                <button class="btn btn-primary" type="submit">                    <span class="glyphicon glyphicon-search"></span>                </button>            </span>        <input type="hidden" name="post_type" value="product">        </div></form>