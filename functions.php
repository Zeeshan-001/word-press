<?php
//------------- Load JS & Styles Files -----------------//
function university_files() {
  //--- JavaScript
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  //--- Google Fonts
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  //--- Icons
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  //--- CSS
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

//--------- Dynamic Title & Nav Links --------------- //
function university_features() {
  add_theme_support("title-tag"); 
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerLocationOne', 'Footer Location One');
  register_nav_menu('footerLocationTwo', 'Footer Location Two');
}

add_action("after_setup_theme", 'university_features');

// Set the excerpt length to 20 words
function custom_excerpt_length($length) {
    return 20; 
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);


// Change Learn more with weiterlesen
function custom_excerpt_more($more) {
    return '... <a class="read-more" href="' . get_permalink() . '">Weiterlesen</a>';
}

add_filter('excerpt_more', 'custom_excerpt_more');


// Custome Page
// function create_custom_page() {
//     // Check if the page already exists
//     $page_title = 'My Custom Page'; // Title of the new page
//     $page_slug = 'my-custom-page'; // Slug for the page URL
//     $page_content = 'This is the content of my custom page.'; // Content for the page

//     $existing_page = get_page_by_path($page_slug, OBJECT, 'page');

//     if (!$existing_page) {
//         // Define page properties
//         $new_page = array(
//             'post_title'    => $page_title,
//             'post_content'  => $page_content,
//             'post_status'   => 'publish', // 'publish', 'draft', or other statuses
//             'post_author'   => 1,        // User ID of the author
//             'post_type'     => 'page',   // Post type 'page'
//             'post_name'     => $page_slug, // Optional: specify the page slug
//         );

//         // Insert the new page into the database
//         $page_id = wp_insert_post($new_page);

//         if ($page_id) {
//             echo "Page created successfully with ID: " . $page_id;
//         } else {
//             echo "Failed to create the page.";
//         }
//     } else {
//         echo "Page already exists!";
//     }
// }

// // Hook into 'init' to run the function after WordPress is fully loaded
// add_action('init', 'create_custom_page');
// ?>
