<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}
class AkashCustomPosts
{
	function __construct()
	{
		add_action( 'admin_menu', array($this, 'akash_header_footer_menu') );
		// Header
		add_action('init', array($this, 'akash_header'));
		add_action('init', array($this, 'akash_footer'));
		// team 
		// add_action('init', array($this, 'akash_team'));
		// add_action('init', array($this, 'akash_team_category'));
		// add_action('init', array($this, 'akash_team_tags'));
		// services 
		add_action('init', array($this, 'akash_service'));
		add_action('init', array($this, 'akash_service_category'));
		add_action('init', array($this, 'akash_service_tags'));

		// Projects 
		// add_action('init', array($this, 'akash_project'));
		// add_action('init', array($this, 'akash_project_category'));
		// add_action('init', array($this, 'akash_project_tags'));

		//sakib testimonial
	// 	add_action('init', array($this, 'akash_testimonial'));
	// 	add_action('init', array($this, 'akash_project_category'));
	// 	add_action('init', array($this, 'akash_project_tags'));
	// 	flush_rewrite_rules( true );
	}
	public function akash_header_footer_menu() {
		add_menu_page(
			'Header & Footer',
			'Header & Footer',
			'read',
			'header-footer',
			'',
			'dashicons-archive',
			40
		);
	 }
	 /**
	 *
	 * Akash Header Footer Post Type
	 *
	 */
	public function akash_header()
	{
		$labels = array(
			'name'               => _x('Header', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Header', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Header', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Header', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Header', 'akash-hp'),
			'add_new_item'       => __('Add New Header', 'akash-hp'),
			'new_item'           => __('New Header', 'akash-hp'),
			'edit_item'          => __('Edit Header', 'akash-hp'),
			'view_item'          => __('View Header', 'akash-hp'),
			'all_items'          => __('All Headers', 'akash-hp'),
			'search_items'       => __('Search Headers', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Headers found.', 'akash-hp'),
			'not_found_in_trash' => __('No Headers found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'show_in_menu' 		 => 'header-footer',
			'rewrite'            => array('slug' => 'header'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title','elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('akash_header', $args);
	}
	public function akash_footer()
	{
		$labels = array(
			'name'               => _x('Footer', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Footer', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Footer', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Footer', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Footer', 'akash-hp'),
			'add_new_item'       => __('Add New Footer', 'akash-hp'),
			'new_item'           => __('New Footer', 'akash-hp'),
			'edit_item'          => __('Edit Footer', 'akash-hp'),
			'view_item'          => __('View Footer', 'akash-hp'),
			'all_items'          => __('All Footers', 'akash-hp'),
			'search_items'       => __('Search Footers', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Footers found.', 'akash-hp'),
			'not_found_in_trash' => __('No Footers found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'footer'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'show_in_menu' 		 => 'header-footer',
			'supports'           => array('title','elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('akash_footer', $args);
	}
	/**
	 *
	 * akash Service Custom Post Type
	 *
	 */
	public function akash_service()
	{
		$labels = array(
			'name'               => _x('Service', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Service', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Service', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Service', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Service', 'akash-hp'),
			'add_new_item'       => __('Add New Service', 'akash-hp'),
			'new_item'           => __('New Service', 'akash-hp'),
			'edit_item'          => __('Edit Service', 'akash-hp'),
			'view_item'          => __('View Service', 'akash-hp'),
			'all_items'          => __('All Services', 'akash-hp'),
			'search_items'       => __('Search Services', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Services found.', 'akash-hp'),
			'not_found_in_trash' => __('No Services found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-megaphone',
			'rewrite'            => array('slug' => 'service', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('elementor', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('service', $args);
	}

	public function akash_service_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Categories', 'akash-hp'),
			'all_items'         => __('All Categories', 'akash-hp'),
			'parent_item'       => __('Parent Category', 'akash-hp'),
			'parent_item_colon' => __('Parent Category:', 'akash-hp'),
			'edit_item'         => __('Edit Category', 'akash-hp'),
			'update_item'       => __('Update Category', 'akash-hp'),
			'add_new_item'      => __('Add New Category', 'akash-hp'),
			'new_item_name'     => __('New Category Name', 'akash-hp'),
			'menu_name'         => __('Category', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'service-category'),
		);
		register_taxonomy('service-category', array('akash-service'), $args);
	}
	public function akash_service_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Tags', 'akash-hp'),
			'all_items'         => __('All Tags', 'akash-hp'),
			'parent_item'       => __('Parent Tag', 'akash-hp'),
			'parent_item_colon' => __('Parent Tag:', 'akash-hp'),
			'edit_item'         => __('Edit Tag', 'akash-hp'),
			'update_item'       => __('Update Tag', 'akash-hp'),
			'add_new_item'      => __('Add New Tag', 'akash-hp'),
			'new_item_name'     => __('New Tag Name', 'akash-hp'),
			'menu_name'         => __('Tag', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'pf-tag'),
		);
		register_taxonomy('service-tag', array('akash-service'), $args);
	}
	/**
	 *
	 * Akash Team Post Type
	 *
	 */
	public function akash_team()
	{
		$labels = array(
			'name'               => _x('Team Member', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Team Member', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Team Member', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Member', 'akash-hp'),
			'add_new_item'       => __('Add New Member', 'akash-hp'),
			'new_item'           => __('New Member', 'akash-hp'),
			'edit_item'          => __('Edit Member', 'akash-hp'),
			'view_item'          => __('View Member', 'akash-hp'),
			'all_items'          => __('All Team Members', 'akash-hp'),
			'search_items'       => __('Search Team Members', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Team Members found.', 'akash-hp'),
			'not_found_in_trash' => __('No Team Members found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'team', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('team', $args);
	}
	public function akash_team_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Categories', 'akash-hp'),
			'all_items'         => __('All Categories', 'akash-hp'),
			'parent_item'       => __('Parent Category', 'akash-hp'),
			'parent_item_colon' => __('Parent Category:', 'akash-hp'),
			'edit_item'         => __('Edit Category', 'akash-hp'),
			'update_item'       => __('Update Category', 'akash-hp'),
			'add_new_item'      => __('Add New Category', 'akash-hp'),
			'new_item_name'     => __('New Category Name', 'akash-hp'),
			'menu_name'         => __('Category', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'team-category'),
		);
		register_taxonomy('team-category', array('team'), $args);
	}
	public function akash_team_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Tags', 'akash-hp'),
			'all_items'         => __('All Tags', 'akash-hp'),
			'parent_item'       => __('Parent Tag', 'akash-hp'),
			'parent_item_colon' => __('Parent Tag:', 'akash-hp'),
			'edit_item'         => __('Edit Tag', 'akash-hp'),
			'update_item'       => __('Update Tag', 'akash-hp'),
			'add_new_item'      => __('Add New Tag', 'akash-hp'),
			'new_item_name'     => __('New Tag Name', 'akash-hp'),
			'menu_name'         => __('Tag', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'team-tag'),
		);
		register_taxonomy('team-tag', array('team'), $args);
	}

	/**
	 *
	 * Akash Team Post Type
	 *
	 */
	public function akash_project()
	{
		$labels = array(
			'name'               => _x('Project', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Project', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Project', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Project', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Project', 'akash-hp'),
			'add_new_item'       => __('Add New Project', 'akash-hp'),
			'new_item'           => __('New Project', 'akash-hp'),
			'edit_item'          => __('Edit Project', 'akash-hp'),
			'view_item'          => __('View Project', 'akash-hp'),
			'all_items'          => __('All Projects', 'akash-hp'),
			'search_items'       => __('Search Projects', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Projects found.', 'akash-hp'),
			'not_found_in_trash' => __('No Projects found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'project', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('project', $args);
	}
	public function akash_project_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Categories', 'akash-hp'),
			'all_items'         => __('All Categories', 'akash-hp'),
			'parent_item'       => __('Parent Category', 'akash-hp'),
			'parent_item_colon' => __('Parent Category:', 'akash-hp'),
			'edit_item'         => __('Edit Category', 'akash-hp'),
			'update_item'       => __('Update Category', 'akash-hp'),
			'add_new_item'      => __('Add New Category', 'akash-hp'),
			'new_item_name'     => __('New Category Name', 'akash-hp'),
			'menu_name'         => __('Category', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-category'),
		);
		register_taxonomy('project-category', array('project'), $args);
	}
	public function akash_project_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'akash-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'akash-hp'),
			'search_items'      => __('Search Tags', 'akash-hp'),
			'all_items'         => __('All Tags', 'akash-hp'),
			'parent_item'       => __('Parent Tag', 'akash-hp'),
			'parent_item_colon' => __('Parent Tag:', 'akash-hp'),
			'edit_item'         => __('Edit Tag', 'akash-hp'),
			'update_item'       => __('Update Tag', 'akash-hp'),
			'add_new_item'      => __('Add New Tag', 'akash-hp'),
			'new_item_name'     => __('New Tag Name', 'akash-hp'),
			'menu_name'         => __('Tag', 'akash-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-tag'),
		);
		register_taxonomy('project-tag', array('project'), $args);
	}
	
	//sakib
	public function akash_testimonial()
	{
		$labels = array(
			'name'               => _x('Testimonial', 'post type general name', 'akash-hp'),
			'singular_name'      => _x('Testimonial', 'post type singular name', 'akash-hp'),
			'menu_name'          => _x('Testimonial', 'admin menu', 'akash-hp'),
			'name_admin_bar'     => _x('Testimonial', 'add new on admin bar', 'akash-hp'),
			'add_new'            => __('Add New Testimonial', 'akash-hp'),
			'add_new_item'       => __('Add New Testimonial', 'akash-hp'),
			'new_item'           => __('New Testimonial', 'akash-hp'),
			'edit_item'          => __('Edit Testimonial', 'akash-hp'),
			'view_item'          => __('View Testimonial', 'akash-hp'),
			'all_items'          => __('All Testimonial', 'akash-hp'),
			'search_items'       => __('Search Testimonial', 'akash-hp'),
			'parent_item_colon'  => __('Parent :', 'akash-hp'),
			'not_found'          => __('No Testimonial found.', 'akash-hp'),
			'not_found_in_trash' => __('No Testimonial found in Trash.', 'akash-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'akash-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-testimonial',
			'rewrite'            => array('slug' => 'akash_testimonial', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('akash_testimonial', $args);
	}
	public function akash_testimonial_category()
		{
			$labels = array(
				'name'              => _x('Categories', 'taxonomy general name', 'akash-hp'),
				'singular_name'     => _x('Category', 'taxonomy singular name', 'akash-hp'),
				'search_items'      => __('Search Categories', 'akash-hp'),
				'all_items'         => __('All Categories', 'akash-hp'),
				'parent_item'       => __('Parent Category', 'akash-hp'),
				'parent_item_colon' => __('Parent Category:', 'akash-hp'),
				'edit_item'         => __('Edit Category', 'akash-hp'),
				'update_item'       => __('Update Category', 'akash-hp'),
				'add_new_item'      => __('Add New Category', 'akash-hp'),
				'new_item_name'     => __('New Category Name', 'akash-hp'),
				'menu_name'         => __('Category', 'akash-hp'),
			);
			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'project-category'),
			);
			register_taxonomy('testimonial_category', array('akash_testimonial'), $args);
		}
		public function akash_testimonial_tags()
		{
			$labels = array(
				'name'              => _x('Tags', 'taxonomy general name', 'akash-hp'),
				'singular_name'     => _x('Tag', 'taxonomy singular name', 'akash-hp'),
				'search_items'      => __('Search Tags', 'akash-hp'),
				'all_items'         => __('All Tags', 'akash-hp'),
				'parent_item'       => __('Parent Tag', 'akash-hp'),
				'parent_item_colon' => __('Parent Tag:', 'akash-hp'),
				'edit_item'         => __('Edit Tag', 'akash-hp'),
				'update_item'       => __('Update Tag', 'akash-hp'),
				'add_new_item'      => __('Add New Tag', 'akash-hp'),
				'new_item_name'     => __('New Tag Name', 'akash-hp'),
				'menu_name'         => __('Tag', 'akash-hp'),
			);
			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'project-tag'),
			);
			register_taxonomy('testimonial_tag', array('akash_testimonial'), $args);
		}
}
$akashCcases_stydyInstance = new AkashCustomPosts;
