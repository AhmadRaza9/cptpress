<?php
/**
 * Basic Custom Post Types. Custom Post Types include Team, Clients,
 * Portfolios, Our Story and Testimonials.
 *
 * @package CPTpress
 *
 * @wordpress-plugin
 * Plugin Name: CPT Press
 * Plugin URI:  https://github.com/Ahmadraza9/cptpress
 * Description: Basic Custom Post Types. Custom Post Types include  Team, Clients, Portfolios, Case Study.
 * Version: 1.2.1
 * Author: Ahmad Raza
 * Author URI: http://ahmedraza.dev/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cptpress
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('CPT_PRESS_VERSION', '1.0.0');

defined('CPT_PRESS_NAME') or define('CPT_PRESS_NAME', 'ataki-team');

defined('CPT_PRESS_BASE_FILE') or define('CPT_PRESS_BASE_FILE', __FILE__);

define('CPT_PRESS_BASE_DIR', plugin_dir_path(__FILE__));

require 'class-cpt-press-portfolio-colors-metabox.php';
require 'class-cpt-press-template-loader.php';

function cptpress_enqueue_style()
{
    $plugin_url = plugin_dir_url(__FILE__);
    wp_enqueue_style('cptpress-style', $plugin_url . 'css/cptpress.css');
}

add_action('wp_enqueue_scripts', 'cptpress_enqueue_style');

/**
 * Add custom post types.
 */
function cptpress_custom_posts_init()
{
    // Localization.
    load_plugin_textdomain('cptpress', false, dirname(plugin_basename(__FILE__)) . '/languages');

    // Register the "Team" custom post type.
    $team_labels = array(
        'name' => _x('Team', 'Post type general name', 'cptpress'),
        'singular_name' => _x('Team', 'Post type singular name', 'cptpress'),
        'menu_name' => _x('Team', 'Admin Menu text', 'cptpress'),
        'name_admin_bar' => _x('Team', 'Add New on Toolbar', 'cptpress'),
        'add_new' => __('Add New Team', 'cptpress'),
        'add_new_item' => __('Add New Team', 'cptpress'),
        'new_item' => __('New Team', 'cptpress'),
        'edit_item' => __('Edit Team', 'cptpress'),
        'view_item' => __('View Team', 'cptpress'),
        'all_items' => __('All Team', 'cptpress'),
        'search_items' => __('Search Team', 'cptpress'),
        'parent_item_colon' => __('Parent Team:', 'cptpress'),
        'not_found' => __('No Team found.', 'cptpress'),
        'not_found_in_trash' => __('No Team found in Trash.', 'cptpress'),
        'featured_image' => _x('Team Member Image', 'Overrides the "Featured Image", phrase for this post type. Added in 4.3', 'cptpress'),
        'set_featured_image' => _x('Set Team Member Image', 'Overrides the "Set featured image", phrase for this post type. Added in 4.3', 'cptpress'),
        'remove_featured_image' => _x('Remove Team Member Image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'use_featured_image' => _x('Use as Team Member Image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'archives' => _x('Team archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'cptpress'),
        'insert_into_item' => _x('Insert into team', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'cptpress'),
        'uploaded_to_this_item' => _x('Uploaded to this team', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'cptpress'),
        'filter_items_list' => _x('Filter team list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'cptpress'),
        'items_list_navigation' => _x('Team list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'cptpress'),
        'items_list' => _x('Team list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'cptpress'),
    );

    $post_type_team = array(
        'labels' => $team_labels,
        'public' => true,
        'hierarchical' => false,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-businessman',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'team',
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'exclude_from_search' => false,
        'menu_position' => null,
        'can_export' => true,
        'show_in_rest' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    );
    register_post_type('team', $post_type_team);

    /**
     * Register the "Profession" taxonomy.
     */
    $profession_label = array(
        'name' => _x('Professions', 'Taxonomy General Name', 'cptpress'),
        'singular_name' => _x('Profession', 'Taxonomy Singular Name', 'cptpress'),
        'search_items' => _x('Search Professions', 'cptpress'),
        'menu_name' => __('Profession', 'cptpress'),
        'all_items' => __('All Professions', 'cptpress'),
        'parent_item' => __('Parent Profession', 'cptpress'),
        'parent_item_colon' => __('Parent Profession:', 'cptpress'),
        'new_item_name' => __('New Profession Name', 'cptpress'),
        'add_new_item' => __('Add New Profession', 'cptpress'),
        'edit_item' => __('Edit Profession', 'cptpress'),
        'update_item' => __('Update Profession', 'cptpress'),
        'view_item' => __('View Profession', 'cptpress'),
        'separate_items_with_commas' => __('Separate Professions with commas', 'cptpress'),
        'add_or_remove_items' => __('Add or remove Professions', 'cptpress'),
        'choose_from_most_used' => __('Choose from the most used', 'cptpress'),
        'popular_items' => __('Popular Professions', 'cptpress'),
        'search_items' => __('Search Professions', 'cptpress'),
        'not_found' => __('Not Found', 'cptpress'),
        'no_terms' => __('No Professions', 'cptpress'),
        'items_list' => __('Professions list', 'cptpress'),
        'items_list_navigation' => __('Professions list navigation', 'cptpress'),
    );

    $post_type_professional = array(
        'labels' => $profession_label,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('profession', array('team'), $post_type_professional);

    // Register the "Portfolio" custom post type.
    $portfolio_labels = array(
        'name' => _x('Portfolio', 'Post type general name', 'cptpress'),
        'singular_name' => _x('Portfolio', 'Post type singular name', 'cptpress'),
        'menu_name' => _x('Portfolio', 'Admin Menu text', 'cptpress'),
        'name_admin_bar' => _x('Portfolio', 'Add New on Toolbar', 'cptpress'),
        'add_new' => __('Add New Portfolio', 'cptpress'),
        'add_new_item' => __('Add New Portfolio', 'cptpress'),
        'new_item' => __('New Portfolio', 'cptpress'),
        'edit_item' => __('Edit Portfolio', 'cptpress'),
        'view_item' => __('View Portfolio', 'cptpress'),
        'all_items' => __('All Portfolio', 'cptpress'),
        'search_items' => __('Search Portfolio', 'cptpress'),
        'parent_item_colon' => __('Parent Portfolio:', 'cptpress'),
        'not_found' => __('No Portfolio found.', 'cptpress'),
        'not_found_in_trash' => __('No Portfolio found in Trash.', 'cptpress'),
        'featured_image' => _x('Portfolio Image', 'Overrides the "Featured Image", phrase for this post type. Added in 4.3', 'cptpress'),
        'set_featured_image' => _x('Set Portfolio Image', 'Overrides the "Set featured image", phrase for this post type. Added in 4.3', 'cptpress'),
        'remove_featured_image' => _x('Remove Portfolio Image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'use_featured_image' => _x('Use as Portfolio Image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'archives' => _x('Portfolio archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'cptpress'),
        'insert_into_item' => _x('Insert into Portfolio', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'cptpress'),
        'uploaded_to_this_item' => _x('Uploaded to this Portfolio', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'cptpress'),
        'filter_items_list' => _x('Filter Portfolio list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'cptpress'),
        'items_list_navigation' => _x('Portfolio list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'cptpress'),
        'items_list' => _x('Portfolio list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'cptpress'),
    );

    $post_type_portfolio = array(
        'labels' => $portfolio_labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'portfolio',
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'show_in_rest' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
    );
    register_post_type('portfolio', $post_type_portfolio);

    /**
     * Register the "Portfolio Categories" custom post type.
     */
    $category_label = array(
        'name' => _x('Portfolio Categories', 'Taxonomy General Name', 'cptpress'),
        'singular_name' => _x('Portfolio Category', 'Taxonomy Singular Name', 'cptpress'),
        'menu_name' => __('Portfolio Category', 'cptpress'),
        'all_items' => __('All Portfolio Categories', 'cptpress'),
        'parent_item' => __('Parent Portfolio Category', 'cptpress'),
        'parent_item_colon' => __('Parent Portfolio Category:', 'cptpress'),
        'new_item_name' => __('New Portfolio Category Name', 'cptpress'),
        'add_new_item' => __('Add New Portfolio Category', 'cptpress'),
        'edit_item' => __('Edit Portfolio Category', 'cptpress'),
        'update_item' => __('Update Portfolio Category', 'cptpress'),
        'view_item' => __('View Portfolio Category', 'cptpress'),
        'separate_items_with_commas' => __('Separate Portfolio Categories with commas', 'cptpress'),
        'add_or_remove_items' => __('Add or remove Portfolio Categories', 'cptpress'),
        'choose_from_most_used' => __('Choose from the most used', 'cptpress'),
        'popular_items' => __('Popular Portfolio Categories', 'cptpress'),
        'search_items' => __('Search Portfolio Categories', 'cptpress'),
        'not_found' => __('Not Found', 'cptpress'),
        'no_terms' => __('No Portfolio Categories', 'cptpress'),
        'items_list' => __('Portfolio Categories list', 'cptpress'),
        'items_list_navigation' => __('Portfolio Categories list navigation', 'cptpress'),
    );

    $post_type_category = array(
        'labels' => $category_label,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('portfolio-category', array('portfolio'), $post_type_category);

    // Register the "Case Studies" custom post type.
    $case_study_labels = array(
        'name' => _x('Case Studies', 'Post type general name', 'cptpress'),
        'singular_name' => _x('Case Study', 'Post type singular name', 'cptpress'),
        'menu_name' => _x('Case Study', 'Admin Menu text', 'cptpress'),
        'name_admin_bar' => _x('Case Study', 'Add New on Toolbar', 'cptpress'),
        'add_new' => __('Add New Case Study', 'cptpress'),
        'add_new_item' => __('Add New Case Study', 'cptpress'),
        'new_item' => __('New Case Study', 'cptpress'),
        'edit_item' => __('Edit Case Study', 'cptpress'),
        'view_item' => __('View Case Study', 'cptpress'),
        'all_items' => __('All Case Studies', 'cptpress'),
        'search_items' => __('Search Case Study', 'cptpress'),
        'parent_item_colon' => __('Parent Case Study:', 'cptpress'),
        'not_found' => __('No Case Study found.', 'cptpress'),
        'not_found_in_trash' => __('No Case Study found in Trash.', 'cptpress'),
        'featured_image' => _x('Case Study Image', 'Overrides the "Featured Image", phrase for this post type. Added in 4.3', 'cptpress'),
        'set_featured_image' => _x('Set Case Study Image', 'Overrides the "Set featured image", phrase for this post type. Added in 4.3', 'cptpress'),
        'remove_featured_image' => _x('Remove Case Study Image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'use_featured_image' => _x('Use as Case Study Image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        // 'archives' => _x('Case Study archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'cptpress'),
        'insert_into_item' => _x('Insert into Case Study', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'cptpress'),
        'uploaded_to_this_item' => _x('Uploaded to this Case Study', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'cptpress'),
        'filter_items_list' => _x('Filter Case Study list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'cptpress'),
        'items_list_navigation' => _x('Case Study list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'cptpress'),
        'items_list' => _x('Case Study list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'cptpress'),
    );

    $post_type_case_study = array(
        'labels' => $case_study_labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'case-studies',
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'query_var' => true,
        'can_export' => true,
        'show_in_rest' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    );
    register_post_type('case-studies', $post_type_case_study);

    /**
     * Register the "Case Study Categories" custom post type.
     */
    $case_study_category_label = array(
        'name' => _x('Case Study Categories', 'Taxonomy General Name', 'cptpress'),
        'singular_name' => _x('Case Study Category', 'Taxonomy Singular Name', 'cptpress'),
        'menu_name' => __('Case Study Category', 'cptpress'),
        'all_items' => __('All Case Study Categories', 'cptpress'),
        'parent_item' => __('Parent Case Study Category', 'cptpress'),
        'parent_item_colon' => __('Parent Case Study Category:', 'cptpress'),
        'new_item_name' => __('New Case Study Category Name', 'cptpress'),
        'add_new_item' => __('Add New Case Study Category', 'cptpress'),
        'edit_item' => __('Edit Case Study Category', 'cptpress'),
        'update_item' => __('Update Case Study Category', 'cptpress'),
        'view_item' => __('View Case Study Category', 'cptpress'),
        'separate_items_with_commas' => __('Separate Case Study Categories with commas', 'cptpress'),
        'add_or_remove_items' => __('Add or remove Case Study Categories', 'cptpress'),
        'choose_from_most_used' => __('Choose from the most used', 'cptpress'),
        'popular_items' => __('Popular Case Study Categories', 'cptpress'),
        'search_items' => __('Search Case Study Categories', 'cptpress'),
        'not_found' => __('Not Found', 'cptpress'),
        'no_terms' => __('No Case Study Categories', 'cptpress'),
        'items_list' => __('Case Study Categories list', 'cptpress'),
        'items_list_navigation' => __('Case Study Categories list navigation', 'cptpress'),
    );

    $post_type_category_case_study = array(
        'labels' => $case_study_category_label,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('case-study-category', array('case-studies'), $post_type_category_case_study);

    // Register the "Clients" custom post type.
    $clients_labels = array(
        'name' => _x('Clients', 'Post type general name', 'cptpress'),
        'singular_name' => _x('Client', 'Post type singular name', 'cptpress'),
        'menu_name' => _x('Clients', 'Admin Menu text', 'cptpress'),
        'name_admin_bar' => _x('Client', 'Add New on Toolbar', 'cptpress'),
        'add_new' => __('Add New Client', 'cptpress'),
        'add_new_item' => __('Add New Clients', 'cptpress'),
        'new_item' => __('New Clients', 'cptpress'),
        'edit_item' => __('Edit Clients', 'cptpress'),
        'view_item' => __('View Clients', 'cptpress'),
        'all_items' => __('All Clients', 'cptpress'),
        'search_items' => __('Search Clients', 'cptpress'),
        'parent_item_colon' => __('Parent Clients:', 'cptpress'),
        'not_found' => __('No Clients found.', 'cptpress'),
        'not_found_in_trash' => __('No Clients found in Trash.', 'cptpress'),
        'featured_image' => _x('Client Cover Image', 'Overrides the "Featured Image", phrase for this post type. Added in 4.3', 'cptpress'),
        'set_featured_image' => _x('Set Client Image', 'Overrides the "Set featured image", phrase for this post type. Added in 4.3', 'cptpress'),
        'remove_featured_image' => _x('Remove Client image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'use_featured_image' => _x('Use as Client image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'cptpress'),
        'archives' => _x('Clients archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'cptpress'),
        'insert_into_item' => _x('Insert into Client', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'cptpress'),
        'uploaded_to_this_item' => _x('Uploaded to this Client', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'cptpress'),
        'filter_items_list' => _x('Filter Clients list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'cptpress'),
        'items_list_navigation' => _x('Clients list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'cptpress'),
        'items_list' => _x('Clients list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'cptpress'),
    );

    $post_type_client = array(
        'labels' => $clients_labels,
        'public' => true,
        'hierarchical' => false,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-businessman',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'client',
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'exclude_from_search' => false,
        'menu_position' => null,
        'can_export' => true,
        'show_in_rest' => false,
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
    );
    register_post_type('client', $post_type_client);

    /**
     * Register the Client Category taxonomy.
     */
    $client_label = array(
        'name' => _x('Client Categories', 'Taxonomy General Name', 'cptpress'),
        'singular_name' => _x('Client Category', 'Taxonomy Singular Name', 'cptpress'),
        'menu_name' => __('Client Category', 'cptpress'),
        'all_items' => __('All Client Categories', 'cptpress'),
        'parent_item' => __('Parent Client Category', 'cptpress'),
        'parent_item_colon' => __('Parent Client Category:', 'cptpress'),
        'new_item_name' => __('New Client Category Name', 'cptpress'),
        'add_new_item' => __('Add New Client Category', 'cptpress'),
        'edit_item' => __('Edit Client Category', 'cptpress'),
        'update_item' => __('Update Client Category', 'cptpress'),
        'view_item' => __('View Client Category', 'cptpress'),
        'separate_items_with_commas' => __('Separate Client Categories with commas', 'cptpress'),
        'add_or_remove_items' => __('Add or remove Client Categories', 'cptpress'),
        'choose_from_most_used' => __('Choose from the most used', 'cptpress'),
        'popular_items' => __('Popular Client Categories', 'cptpress'),
        'search_items' => __('Search Client Categories', 'cptpress'),
        'not_found' => __('Not Found', 'cptpress'),
        'no_terms' => __('No Client Categories', 'cptpress'),
        'items_list' => __('Client Categories list', 'cptpress'),
        'items_list_navigation' => __('Client Categories list navigation', 'cptpress'),
    );

    $post_type_client = array(
        'labels' => $client_label,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('client-category', array('client'), $post_type_client);
}

/**
 * Hook into the 'init' action so that the function
 * Containing our post type registration is not
 * unnecessarily executed.
 */
add_action('init', 'cptpress_custom_posts_init');

function single_template_blog($template)
{
    if (is_singular('portfolio')) {
        require_once CPT_PRESS_BASE_DIR . 'class-cpt-press-template-loader.php';
        $template_loader = new CPT_PRESS_Template_Loader();

        return $template_loader->get_template_part('single', 'portfolio', false);
    }

    if (is_singular('team')) {
        require_once CPT_PRESS_BASE_DIR . 'class-cpt-press-template-loader.php';
        $template_loader = new CPT_PRESS_Template_Loader();

        return $template_loader->get_template_part('single', 'team', false);
    }

    if (is_singular('case-studies')) {
        require_once CPT_PRESS_BASE_DIR . 'class-cpt-press-template-loader.php';
        $template_loader = new CPT_PRESS_Template_Loader();

        return $template_loader->get_template_part('single', 'caseStudies', false);
    }

    if (is_singular('client')) {
        require_once CPT_PRESS_BASE_DIR . 'class-cpt-press-template-loader.php';
        $template_loader = new CPT_PRESS_Template_Loader();

        return $template_loader->get_template_part('single', 'client', false);
    }

    if (is_post_type_archive('portfolio') || is_post_type_archive('team') || is_post_type_archive('client') || is_post_type_archive('case-studies')) {
        require_once CPT_PRESS_BASE_DIR . 'class-cpt-press-template-loader.php';
        $template_loader = new CPT_PRESS_Template_Loader();

        return $template_loader->get_template_part('archive', '', false);
    }

    return $template;
}

add_filter('template_include', 'single_template_blog');

/**
 * Add meta box for testimonials
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function testimonial_add_meta_boxes($post)
{
    add_meta_box(
        'testimonial_meta_box',
        __('CLIENT INFORMATION', 'cptpress'),
        'testimonial_build_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes_testimonial', 'testimonial_add_meta_boxes');

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function testimonial_build_meta_box($post)
{
    // make sure the form request comes from WordPress.
    wp_nonce_field(basename(__FILE__), 'testimonial_meta_box_nonce');

    // retrieve the _testimonial_designation current value.
    $current_designation = get_post_meta($post->ID, '_testimonial_designation', true);
    ?>
	<div class='inside'>

		<h3><?php esc_html_e('Designation', 'cptpress');?></h3>
		<input type="text" class="widefat" name="designation" value="<?php echo esc_attr($current_designation); ?>" />

	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function testimonial_save_meta_box_data($post_id)
{
    // verify meta box nonce.
    if (!isset($_POST['testimonial_meta_box_nonce']) || !wp_verify_nonce(sanitize_key($_POST['testimonial_meta_box_nonce']), basename(__FILE__))) { // Input var okay.
        return;
    }
    // return if autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // store custom fields values
    // designation string.
    if (isset($_REQUEST['designation'])) { // Input var okay.
        update_post_meta($post_id, '_testimonial_designation', sanitize_text_field(wp_unslash($_POST['designation']))); // Input var okay.
    }
}
add_action('save_post_testimonial', 'testimonial_save_meta_box_data');
/**
 * Add meta box for team
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function team_add_meta_boxes($post)
{
    add_meta_box(
        'team_meta_box',
        __('PERSON INFORMATION', 'cptpress'),
        'team_build_meta_box',
        'team',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes_team', 'team_add_meta_boxes');

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function team_build_meta_box($post)
{
    // make sure the form request comes from WordPress.
    wp_nonce_field(basename(__FILE__), 'team_meta_box_nonce');

    // retrieve the _team_facebook current value.
    // $current_phone = get_post_meta($post->ID, '_team_phone', true);

    // retrieve the _team_facebook current value.
    $current_email = get_post_meta($post->ID, '_team_email', true);

    // retrieve the _team_website current value.
    $current_website = get_post_meta($post->ID, '_team_website', true);


    // retrieve the _team_facebook current value.
    $current_facebook = get_post_meta($post->ID, '_team_facebook', true);

    // retrieve the _team_twitter current value.
    $current_twitter = get_post_meta($post->ID, '_team_twitter', true);

    // retrieve the _team_instagram current value.
    $current_instagram = get_post_meta($post->ID, '_team_instagram', true);

    // retrieve the _team_linkedin current value.
    $current_linkedin = get_post_meta($post->ID, '_team_linkedin', true);

    // retrieve the _team_github current value.
    $current_github = get_post_meta($post->ID, '_team_github', true);

    // retrieve the _team_gplus current value.
    // $current_gplus = get_post_meta($post->ID, '_team_gplus', true);

    // retrieve the _team_pinterest current value.
    // $current_pinterest = get_post_meta($post->ID, '_team_pinterest', true);

    ?>
	<div class='inside'>
		<!-- <h3><?php esc_html_e('Phone', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="phone" value="<#?php echo esc_html($current_phone); ?>" />
		</p> -->

		<h3><?php esc_html_e('Email', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="email" value="<?php echo sanitize_email($current_email); ?>" />
		</p>

        <h3><?php esc_html_e('Website Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="website" value="<?php echo esc_url($current_website); ?>" />
		</p>

		<h3><?php esc_html_e('Facebook Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="facebook" value="<?php echo esc_url($current_facebook); ?>" />
		</p>

		<h3><?php esc_html_e('Twitter Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="twitter" value="<?php echo esc_url($current_twitter); ?>" />
		</p>

        <h3><?php esc_html_e('Instagram Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="instagram" value="<?php echo esc_url($current_instagram); ?>" />
		</p>

        <h3><?php esc_html_e('Linkedin Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="linkedin" value="<?php echo esc_url($current_linkedin); ?>" />
		</p>

        <h3><?php esc_html_e('Github Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="github" value="<?php echo esc_url($current_github); ?>" />
		</p>

		<!-- <h3><#?php esc_html_e('Google Plus Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="gplus" value="<#?php echo esc_url($current_gplus); ?>" />
		</p>

		<h3><#?php esc_html_e('Pinterest Link', 'cptpress');?></h3>
		<p>
			<input type="text" class="widefat" name="pinterest" value="<#?php echo esc_url($current_pinterest); ?>" />
		</p> -->
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function team_save_meta_box_data($post_id)
{
    // verify meta box nonce.
    if (!isset($_POST['team_meta_box_nonce']) || !wp_verify_nonce(sanitize_key($_POST['team_meta_box_nonce']), basename(__FILE__))) { // Input var okay.
        return;
    }
    // return if autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // store custom fields values
    // phone link.
    // if (isset($_REQUEST['phone'])) { // Input var okay.
    //     update_post_meta($post_id, '_team_phone', sanitize_text_field(wp_unslash($_POST['phone']))); // Input var okay.
    // }
    // store custom fields values
    // phone link.
    if (isset($_REQUEST['website'])) { // Input var okay.
        update_post_meta($post_id, '_team_website', sanitize_text_field(wp_unslash($_POST['website']))); // Input var okay.
    }

    // store custom fields values
    // phone link.
    if (isset($_REQUEST['email'])) { // Input var okay.
        update_post_meta($post_id, '_team_email', sanitize_text_field(wp_unslash($_POST['email']))); // Input var okay.
    }
    // store custom fields values
    // facebook link.
    if (isset($_REQUEST['facebook'])) { // Input var okay.
        update_post_meta($post_id, '_team_facebook', sanitize_text_field(wp_unslash($_POST['facebook']))); // Input var okay.
    }
    // store custom fields values
    // twitter link.
    if (isset($_REQUEST['twitter'])) { // Input var okay.
        update_post_meta($post_id, '_team_twitter', sanitize_text_field(wp_unslash($_POST['twitter']))); // Input var okay.
    }
    // store custom fields values
    // instagram link.
    if (isset($_REQUEST['instagram'])) { // Input var okay.
        update_post_meta($post_id, '_team_instagram', sanitize_text_field(wp_unslash($_POST['instagram']))); // Input var okay.
    }
    // store custom fields values
    // linkedin link.
    if (isset($_REQUEST['linkedin'])) { // Input var okay.
        update_post_meta($post_id, '_team_linkedin', sanitize_text_field(wp_unslash($_POST['linkedin']))); // Input var okay.
    }
    // store custom fields values
    // Github link.
    if (isset($_REQUEST['github'])) { // Input var okay.
        update_post_meta($post_id, '_team_github', sanitize_text_field(wp_unslash($_POST['github']))); // Input var okay.
    }

    // store custom fields values
    // gplus link.
    // if (isset($_REQUEST['gplus'])) { // Input var okay.
    //     update_post_meta($post_id, '_team_gplus', sanitize_text_field(wp_unslash($_POST['gplus']))); // Input var okay.
    // }
    // store custom fields values
    // pinterest link.
    // if (isset($_REQUEST['pinterest'])) { // Input var okay.
    //     update_post_meta($post_id, '_team_pinterest', sanitize_text_field(wp_unslash($_POST['pinterest']))); // Input var okay.
    // }
}
add_action('save_post_team', 'team_save_meta_box_data');

/**
 * The following function is fired during plugin activation which calls
 * lcpt_setup_post_types function
 */
function lcpt_install()
{
    // trigger our function that registers the custom post type.
    cptpress_custom_posts_init();

    // clear the permalinks after the post type has been registered.
    flush_rewrite_rules();
}

/**
 * The following function is fired during plugin deactivation
 */
function lcpt_deactivation()
{
    // our post type will be automatically removed, so no need to unregister it
    // clear the permalinks to remove our post type's rules.
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'lcpt_install');
register_deactivation_hook(__FILE__, 'lcpt_deactivation');
