<?php



//Register Portfolio 

add_action( 'init', 'register_cpt_Portfolio' );



function register_cpt_Portfolio() {

    global $st_textdomain;

    $labels = array( 

        'name' => __( 'All Portfolios', $st_textdomain ),

        'singular_name' => __( 'Portfolio', $st_textdomain ),

        'add_new' => __( 'Add New Portfolio', $st_textdomain ),

        'add_new_item' => __( 'Add New Portfolio', $st_textdomain ),

        'edit_item' => __( 'Edit Portfolio', $st_textdomain ),

        'new_item' => __( 'New Portfolio', $st_textdomain ),

        'view_item' => __( 'View Portfolio', $st_textdomain ),

        'search_items' => __( 'Search Portfolio', $st_textdomain ),

        'not_found' => __( 'No Portfolio found', $st_textdomain ),

        'not_found_in_trash' => __( 'No Portfolio found in Trash', $st_textdomain ),

        'parent_item_colon' => __( 'Parent Portfolio:', $st_textdomain ),

        'menu_name' => __( 'Portfolios', $st_textdomain ),
        
        'all_items'=>__('All Portfolios',$st_textdomain)

    );



    $args = array( 

        'labels' => $labels,

        'hierarchical' => true,

        'description' => 'List Portfolio',

        'supports' => array( 'title', 'editor', 'thumbnail' ,'post-formats','comments'),

        'taxonomies' => array('portfolio_cat','portfolio_tag'),

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true,

        'menu_position' => 5,

        'menu_icon' => get_template_directory_uri(). '/images/admin_ico_portfolio.png', 

        'show_in_nav_menus' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'has_archive' => true,

        'query_var' => true,

        'can_export' => true,

        'rewrite' => true,

        'capability_type' => 'post'

    );



    register_post_type( 'portfolio', $args );

}

//Add Port folio Skill

    

add_action( 'init', 'create_Skills_hierarchical_taxonomy', 0 );



//create a custom taxonomy name it Skills for your posts



function create_Skills_hierarchical_taxonomy() {



// Add new taxonomy, make it hierarchical like categories

//first do the translations part for GUI

    global $st_textdomain;

  $labels = array(

    'name' => __( 'Portfolio Categories', $st_textdomain ),

    'singular_name' => __( 'Portfolio Category', $st_textdomain ),

    'search_items' =>  __( 'Search Portfolio Categories',$st_textdomain ),

    'all_items' => __( 'All Portfolio Categories',$st_textdomain ),

    'parent_item' => __( 'Parent Portfolio Category',$st_textdomain ),

    'parent_item_colon' => __( 'Parent Portfolio Category:',$st_textdomain ),

    'edit_item' => __( 'Edit Portfolio Category',$st_textdomain ),

    'update_item' => __( 'Update Portfolio Category',$st_textdomain ),

    'add_new_item' => __( 'Add New Portfolio Category',$st_textdomain ),

    'new_item_name' => __( 'New Portfolio Category Name',$st_textdomain ),

    'menu_name' => __( 'Portfolio Categories',$st_textdomain ),

  );     



// Now register the taxonomy



  register_taxonomy('portfolio_cat',array('portfolio'), array(

    'hierarchical' => true,

    'labels' => $labels,

    'show_ui' => true,

    'show_admin_column' => true,

    'query_var' => true,

    'rewrite' => array( 'slug' => 'portfolio-cat' ),

  ));



    $labels = array(

        'name' => __( 'Portfolio Tags', $st_textdomain ),

        'singular_name' => __( 'Portfolio Tag', $st_textdomain ),

        'search_items' =>  __( 'Search Portfolio Tags',$st_textdomain ),

        'all_items' => __( 'All Portfolio Tags',$st_textdomain ),

        'parent_item' => __( 'Parent Portfolio Tag',$st_textdomain ),

        'parent_item_colon' => __( 'Parent Portfolio Tag:',$st_textdomain ),

        'edit_item' => __( 'Edit Portfolio Tag',$st_textdomain ),

        'update_item' => __( 'Update Portfolio Tag',$st_textdomain ),

        'add_new_item' => __( 'Add New Portfolio Tag',$st_textdomain ),

        'new_item_name' => __( 'New Portfolio Tag Name',$st_textdomain ),

        'menu_name' => __( 'Portfolio Tags',$st_textdomain ),

    );



// Now register the taxonomy



    register_taxonomy('portfolio_tag',array('portfolio'), array(

        'hierarchical' => false,

        'labels' => $labels,

        'show_ui' => true,

        'show_admin_column' => true,

        'query_var' => true,

        'rewrite' => array( 'slug' => 'portfolio-cat' ),

    ));



}



