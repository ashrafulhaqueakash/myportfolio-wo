<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}
class TrydusCustomPosts
{
	function __construct()
	{
		add_action( 'admin_menu', array($this, 'trydus_header_footer_menu') );
		// Header
		add_action('init', array($this, 'trydus_header'));
		add_action('init', array($this, 'trydus_footer'));
		// team 
		// add_action('init', array($this, 'trydus_team'));
		// add_action('init', array($this, 'trydus_team_category'));
		// add_action('init', array($this, 'trydus_team_tags'));
		// services 
		add_action('init', array($this, 'trydus_service'));
		add_action('init', array($this, 'trydus_service_category'));
		add_action('init', array($this, 'trydus_service_tags'));

		// Projects 
		// add_action('init', array($this, 'trydus_project'));
		// add_action('init', array($this, 'trydus_project_category'));
		// add_action('init', array($this, 'trydus_project_tags'));

		//sakib testimonial
	// 	add_action('init', array($this, 'trydus_testimonial'));
	// 	add_action('init', array($this, 'trydus_project_category'));
	// 	add_action('init', array($this, 'trydus_project_tags'));
	// 	flush_rewrite_rules( true );
	}
	public function trydus_header_footer_menu() {
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
	 * Trydus Header Footer Post Type
	 *
	 */
	public function trydus_header()
	{
		$labels = array(
			'name'               => _x('Header', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Header', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Header', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Header', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Header', 'trydus-hp'),
			'add_new_item'       => __('Add New Header', 'trydus-hp'),
			'new_item'           => __('New Header', 'trydus-hp'),
			'edit_item'          => __('Edit Header', 'trydus-hp'),
			'view_item'          => __('View Header', 'trydus-hp'),
			'all_items'          => __('All Headers', 'trydus-hp'),
			'search_items'       => __('Search Headers', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Headers found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Headers found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
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
		register_post_type('trydus_header', $args);
	}
	public function trydus_footer()
	{
		$labels = array(
			'name'               => _x('Footer', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Footer', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Footer', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Footer', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Footer', 'trydus-hp'),
			'add_new_item'       => __('Add New Footer', 'trydus-hp'),
			'new_item'           => __('New Footer', 'trydus-hp'),
			'edit_item'          => __('Edit Footer', 'trydus-hp'),
			'view_item'          => __('View Footer', 'trydus-hp'),
			'all_items'          => __('All Footers', 'trydus-hp'),
			'search_items'       => __('Search Footers', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Footers found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Footers found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
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
		register_post_type('trydus_footer', $args);
	}
	/**
	 *
	 * trydus Service Custom Post Type
	 *
	 */
	public function trydus_service()
	{
		$labels = array(
			'name'               => _x('Service', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Service', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Service', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Service', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Service', 'trydus-hp'),
			'add_new_item'       => __('Add New Service', 'trydus-hp'),
			'new_item'           => __('New Service', 'trydus-hp'),
			'edit_item'          => __('Edit Service', 'trydus-hp'),
			'view_item'          => __('View Service', 'trydus-hp'),
			'all_items'          => __('All Services', 'trydus-hp'),
			'search_items'       => __('Search Services', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Services found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Services found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
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

	public function trydus_service_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Categories', 'trydus-hp'),
			'all_items'         => __('All Categories', 'trydus-hp'),
			'parent_item'       => __('Parent Category', 'trydus-hp'),
			'parent_item_colon' => __('Parent Category:', 'trydus-hp'),
			'edit_item'         => __('Edit Category', 'trydus-hp'),
			'update_item'       => __('Update Category', 'trydus-hp'),
			'add_new_item'      => __('Add New Category', 'trydus-hp'),
			'new_item_name'     => __('New Category Name', 'trydus-hp'),
			'menu_name'         => __('Category', 'trydus-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'service-category'),
		);
		register_taxonomy('service-category', array('trydus-service'), $args);
	}
	public function trydus_service_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Tags', 'trydus-hp'),
			'all_items'         => __('All Tags', 'trydus-hp'),
			'parent_item'       => __('Parent Tag', 'trydus-hp'),
			'parent_item_colon' => __('Parent Tag:', 'trydus-hp'),
			'edit_item'         => __('Edit Tag', 'trydus-hp'),
			'update_item'       => __('Update Tag', 'trydus-hp'),
			'add_new_item'      => __('Add New Tag', 'trydus-hp'),
			'new_item_name'     => __('New Tag Name', 'trydus-hp'),
			'menu_name'         => __('Tag', 'trydus-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'pf-tag'),
		);
		register_taxonomy('service-tag', array('trydus-service'), $args);
	}
	/**
	 *
	 * Trydus Team Post Type
	 *
	 */
	public function trydus_team()
	{
		$labels = array(
			'name'               => _x('Team Member', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Team Member', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Team Member', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Member', 'trydus-hp'),
			'add_new_item'       => __('Add New Member', 'trydus-hp'),
			'new_item'           => __('New Member', 'trydus-hp'),
			'edit_item'          => __('Edit Member', 'trydus-hp'),
			'view_item'          => __('View Member', 'trydus-hp'),
			'all_items'          => __('All Team Members', 'trydus-hp'),
			'search_items'       => __('Search Team Members', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Team Members found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Team Members found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
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
	public function trydus_team_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Categories', 'trydus-hp'),
			'all_items'         => __('All Categories', 'trydus-hp'),
			'parent_item'       => __('Parent Category', 'trydus-hp'),
			'parent_item_colon' => __('Parent Category:', 'trydus-hp'),
			'edit_item'         => __('Edit Category', 'trydus-hp'),
			'update_item'       => __('Update Category', 'trydus-hp'),
			'add_new_item'      => __('Add New Category', 'trydus-hp'),
			'new_item_name'     => __('New Category Name', 'trydus-hp'),
			'menu_name'         => __('Category', 'trydus-hp'),
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
	public function trydus_team_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Tags', 'trydus-hp'),
			'all_items'         => __('All Tags', 'trydus-hp'),
			'parent_item'       => __('Parent Tag', 'trydus-hp'),
			'parent_item_colon' => __('Parent Tag:', 'trydus-hp'),
			'edit_item'         => __('Edit Tag', 'trydus-hp'),
			'update_item'       => __('Update Tag', 'trydus-hp'),
			'add_new_item'      => __('Add New Tag', 'trydus-hp'),
			'new_item_name'     => __('New Tag Name', 'trydus-hp'),
			'menu_name'         => __('Tag', 'trydus-hp'),
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
	 * Trydus Team Post Type
	 *
	 */
	public function trydus_project()
	{
		$labels = array(
			'name'               => _x('Project', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Project', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Project', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Project', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Project', 'trydus-hp'),
			'add_new_item'       => __('Add New Project', 'trydus-hp'),
			'new_item'           => __('New Project', 'trydus-hp'),
			'edit_item'          => __('Edit Project', 'trydus-hp'),
			'view_item'          => __('View Project', 'trydus-hp'),
			'all_items'          => __('All Projects', 'trydus-hp'),
			'search_items'       => __('Search Projects', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Projects found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Projects found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
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
	public function trydus_project_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Categories', 'trydus-hp'),
			'all_items'         => __('All Categories', 'trydus-hp'),
			'parent_item'       => __('Parent Category', 'trydus-hp'),
			'parent_item_colon' => __('Parent Category:', 'trydus-hp'),
			'edit_item'         => __('Edit Category', 'trydus-hp'),
			'update_item'       => __('Update Category', 'trydus-hp'),
			'add_new_item'      => __('Add New Category', 'trydus-hp'),
			'new_item_name'     => __('New Category Name', 'trydus-hp'),
			'menu_name'         => __('Category', 'trydus-hp'),
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
	public function trydus_project_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'trydus-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'trydus-hp'),
			'search_items'      => __('Search Tags', 'trydus-hp'),
			'all_items'         => __('All Tags', 'trydus-hp'),
			'parent_item'       => __('Parent Tag', 'trydus-hp'),
			'parent_item_colon' => __('Parent Tag:', 'trydus-hp'),
			'edit_item'         => __('Edit Tag', 'trydus-hp'),
			'update_item'       => __('Update Tag', 'trydus-hp'),
			'add_new_item'      => __('Add New Tag', 'trydus-hp'),
			'new_item_name'     => __('New Tag Name', 'trydus-hp'),
			'menu_name'         => __('Tag', 'trydus-hp'),
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
	public function trydus_testimonial()
	{
		$labels = array(
			'name'               => _x('Testimonial', 'post type general name', 'trydus-hp'),
			'singular_name'      => _x('Testimonial', 'post type singular name', 'trydus-hp'),
			'menu_name'          => _x('Testimonial', 'admin menu', 'trydus-hp'),
			'name_admin_bar'     => _x('Testimonial', 'add new on admin bar', 'trydus-hp'),
			'add_new'            => __('Add New Testimonial', 'trydus-hp'),
			'add_new_item'       => __('Add New Testimonial', 'trydus-hp'),
			'new_item'           => __('New Testimonial', 'trydus-hp'),
			'edit_item'          => __('Edit Testimonial', 'trydus-hp'),
			'view_item'          => __('View Testimonial', 'trydus-hp'),
			'all_items'          => __('All Testimonial', 'trydus-hp'),
			'search_items'       => __('Search Testimonial', 'trydus-hp'),
			'parent_item_colon'  => __('Parent :', 'trydus-hp'),
			'not_found'          => __('No Testimonial found.', 'trydus-hp'),
			'not_found_in_trash' => __('No Testimonial found in Trash.', 'trydus-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'trydus-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-testimonial',
			'rewrite'            => array('slug' => 'trydus_testimonial', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail',  'page-attributes')
		);
		register_post_type('trydus_testimonial', $args);
	}
	public function trydus_testimonial_category()
		{
			$labels = array(
				'name'              => _x('Categories', 'taxonomy general name', 'trydus-hp'),
				'singular_name'     => _x('Category', 'taxonomy singular name', 'trydus-hp'),
				'search_items'      => __('Search Categories', 'trydus-hp'),
				'all_items'         => __('All Categories', 'trydus-hp'),
				'parent_item'       => __('Parent Category', 'trydus-hp'),
				'parent_item_colon' => __('Parent Category:', 'trydus-hp'),
				'edit_item'         => __('Edit Category', 'trydus-hp'),
				'update_item'       => __('Update Category', 'trydus-hp'),
				'add_new_item'      => __('Add New Category', 'trydus-hp'),
				'new_item_name'     => __('New Category Name', 'trydus-hp'),
				'menu_name'         => __('Category', 'trydus-hp'),
			);
			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'project-category'),
			);
			register_taxonomy('testimonial_category', array('trydus_testimonial'), $args);
		}
		public function trydus_testimonial_tags()
		{
			$labels = array(
				'name'              => _x('Tags', 'taxonomy general name', 'trydus-hp'),
				'singular_name'     => _x('Tag', 'taxonomy singular name', 'trydus-hp'),
				'search_items'      => __('Search Tags', 'trydus-hp'),
				'all_items'         => __('All Tags', 'trydus-hp'),
				'parent_item'       => __('Parent Tag', 'trydus-hp'),
				'parent_item_colon' => __('Parent Tag:', 'trydus-hp'),
				'edit_item'         => __('Edit Tag', 'trydus-hp'),
				'update_item'       => __('Update Tag', 'trydus-hp'),
				'add_new_item'      => __('Add New Tag', 'trydus-hp'),
				'new_item_name'     => __('New Tag Name', 'trydus-hp'),
				'menu_name'         => __('Tag', 'trydus-hp'),
			);
			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'project-tag'),
			);
			register_taxonomy('testimonial_tag', array('trydus_testimonial'), $args);
		}
}
$trydusCcases_stydyInstance = new TrydusCustomPosts;
