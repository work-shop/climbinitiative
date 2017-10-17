<?php



    class CLIMBInitiative {

        /**
         * The constructor's job is to register all of the actions and filters
         * that we'll want the site to be react to. If the development has
         * a lot of actions or filters, or complex business logic in general,
         * consider breaking the actions and filters implementing the logic
         * out into more readible chunks. For most Work-Shop developments, it's
         * totally fine to centralize all of the actions and filters here in
         * this class.
         *
         * In general, actions and filters should be implemented as public member functions
         * on this class. They should be registered using the appropriate syntax in the constructor.
         */
        function __construct() {
            add_theme_support("post-formats");
            add_theme_support("menus");

            add_action("init", array($this, "remove_comment_support"));
            add_action("init", array($this, "register_image_sizing"));
            add_action("init", array($this, "register_post_types"));
            add_action("init", array($this, "register_custom_taxonomies"));
            add_action("acf/init", array($this, "add_options_pages"));
            add_action("admin_menu", array($this, "remove_menu_items"));
            add_action("admin_init", array($this, "admin_setup"));
            add_action("wp_dashboard_setup", array($this, "remove_dashboard_widgets") );
            add_action("wp_before_admin_bar_render", array($this, "remove_admin_bar_items"));
            add_action("wp_enqueue_scripts", array($this, "enqueue"));
            add_action('admin_menu', array($this, 'remove_screen_options'));

            add_filter('show_admin_bar', '__return_false');
            add_filter('wp_get_attachment_url', array($this, 'rewrite_cdn_url') );


        }

        /**
         * Custom image sizes can be registered here.
         */
        public function register_image_sizing() {
            if ( function_exists( "add_image_size" ) ) {
                add_image_size("social_card", 600, 600, array( "x_crop_position" => "center", "y_crop_position" => "center"));
            }
        }

        /**
         * Registers custom post types for the site
         */
        public function register_post_types() {
            if ( function_exists( "register_post_type" ) ) {
                register_post_type(
                    "research",
                    array(
                        "labels" => array(
                            "name" => "Research",
                            "singular_name" => "Research Result",
                            "add_new" => "Add New",
                            "add_new_item" => "Add New Result",
                            "edit_item" => "Edit Result",
                            "new_item" => "New Result",
                            "view_item" => "View Result",
                            "search_items" => "Search Research",
                            "not_found" => "No Results Found",
                            "not_found_in_trash" => "No Results Found in the Trash",
                            "all_items" => "All Research",
                            "archive_title" => "Research"
                        ),
                        "description" => "Research represents ongoing and completed research results that CLIMB is developing.",
                        "public" => true,
                        "hierarchical" => false,
                        "exclude_from_search" => false,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "show_in_rest" => true,
                        "menu_position" => null,
                        "menu_icon" => "dashicons-media-document",
                        "supports" => array(
                            "title", "editor", "revisions", "excerpt"
                        ),
                        "has_archive" => "research"
                    )
                );

                register_post_type(
                    "people",
                    array(
                        "labels" => array(
                            "name" => "People",
                            "singular_name" => "Person",
                            "add_new" => "Add New",
                            "add_new_item" => "Add New Person",
                            "edit_item" => "Edit Person",
                            "new_item" => "New Person",
                            "view_item" => "View Person",
                            "search_items" => "Search People",
                            "not_found" => "No People Found",
                            "not_found_in_trash" => "No People Found in the Trash",
                            "all_items" => "All People",
                            "archive_title" => "Team"
                        ),
                        "description" => "Principle Investigators, Researchers, Staff, Research Fellows, Funding, and Support for CLIMB.",
                        "public" => false,
                        "hierarchical" => false,
                        "exclude_from_search" => false,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "menu_icon" => "dashicons-admin-users",
                        "show_in_rest" => true,
                        "menu_position" => null,
                        "supports" => array(
                            "title"
                        ),
                        "has_archive" => 'team'
                    )
                );

                register_post_type(
                    "partners",
                    array(
                        "labels" => array(
                            "name" => "Partners",
                            "singular_name" => "Partner",
                            "add_new" => "Add New",
                            "add_new_item" => "Add New Partner",
                            "edit_item" => "Edit Partner",
                            "new_item" => "New Partner",
                            "view_item" => "View Partner",
                            "search_items" => "Search Partners",
                            "not_found" => "No Partners Found",
                            "not_found_in_trash" => "No Partners Found in the Trash",
                            "all_items" => "All Partners",
                            "archive_title" => "Partners"
                        ),
                        "description" => "Research Partners for CLIMB.",
                        "public" => false,
                        "hierarchical" => false,
                        "exclude_from_search" => false,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "menu_icon" => "dashicons-welcome-learn-more",
                        "show_in_rest" => true,
                        "menu_position" => null,
                        "supports" => array(
                            "title"
                        ),
                        "has_archive" => 'partners'
                    )
                );

                register_post_type(
                    "conferences",
                    array(
                        "labels" => array(
                            "name" => "Conferences",
                            "singular_name" => "Conference",
                            "add_new" => "Add New",
                            "add_new_item" => "Add New Conference",
                            "edit_item" => "Edit Conference",
                            "new_item" => "New Conference",
                            "view_item" => "View Conference",
                            "search_items" => "Search Conferences",
                            "not_found" => "No Conferences Found",
                            "not_found_in_trash" => "No Conferences Found in the Trash",
                            "all_items" => "All Conferences",
                            "archive_title" => "Conferences"
                        ),
                        "description" => "CLIMB Conferences",
                        "public" => true,
                        "hierarchical" => false,
                        "exclude_from_search" => false,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "show_in_rest" => true,
                        "menu_position" => null,
                        "menu_icon" => "dashicons-format-chat",
                        "supports" => array(
                            "title"
                        ),
                        "has_archive" => 'conferences'
                    )
                );
            }
        }

        public function register_custom_taxonomies() {
            if ( function_exists( 'register_taxonomy' ) ) {
                register_taxonomy(
                    "role",
                    "people",
                    array(
                        "labels" => array(
                            "name" => "Roles",
                            "singular_name" => "Role",
                            "all_items" => "All Roles",
                            "edit_item" => "Edit Role",
                            "view_item" => "View Role",
                            "update_item" => "Update Role",
                            "add_new_item" => "Add New Role",
                            "new_item_name" => "New Role Name",
                            "search_items" => "Search Roles",
                        ),
                        "public" => true,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "show_in_rest" => true,
                        "show_tag_cloud" => false,
                        "show_in_quick_edit" => true,
                        "hierarchical" => false
                    )
                );

                register_taxonomy(
                    "partner_role",
                    "partners",
                    array(
                        "labels" => array(
                            "name" => "Partner Roles",
                            "singular_name" => "Partner Role",
                            "all_items" => "All Partner Roles",
                            "edit_item" => "Edit Partner Role",
                            "view_item" => "View Partner Role",
                            "update_item" => "Update Partner Role",
                            "add_new_item" => "Add New Partner Role",
                            "new_item_name" => "New Partner Role Name",
                            "search_items" => "Search Partner Roles",
                        ),
                        "public" => true,
                        "publicly_queryable" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "show_in_rest" => true,
                        "show_tag_cloud" => false,
                        "show_in_quick_edit" => true,
                        "hierarchical" => false
                    )
                );
            }
        }

        /**
         * Additional ACF options pages can be registered here.
         */
        public function add_options_pages() {
            if ( function_exists('acf_add_options_page') ) {
                acf_add_options_page(array(
                    "page_title" => "Site",
                    "capability" => "edit_posts",
                    "position" => 5,
                    "icon_url" => "dashicons-admin-home"
                ));
            }
        }

        /** remove comment support for pages and posts. */
        public function remove_comment_support() {
            remove_post_type_support("post", "comments");
            remove_post_type_support("page", "comments");
        }


        // Remove comments link from menu
        public function remove_menu_items() {
            remove_menu_page("edit-comments.php");
            remove_menu_page("edit.php");
        }

        // Remove comments link from admin bar
        public function remove_admin_bar_items() {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu("comments");
        }

        /** remove admin menu home page widgets */
        public function remove_dashboard_widgets () {
            remove_meta_box("dashboard_primary", "dashboard", "side");   // WordPress.com blog
            remove_meta_box("dashboard_secondary", "dashboard", "side"); // Other WordPress news

            global $wp_meta_boxes;

            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        }

        /** enqueue styles for the front-end */
        public function enqueue() {
            $main = "/styles/bundle.css";

            $main_src = get_template_directory_uri() . $main;
            $main_ver = filemtime(get_template_directory() . $main);
            wp_enqueue_style("main", $main_src, array(), $main_ver);

            wp_enqueue_script("jquery");

            $bundle_src = get_template_directory_uri() . "/scripts/bundle.js";
            $bundle_ver = filemtime(get_template_directory() . "/scripts/bundle.js");
            wp_enqueue_script("bundle", $bundle_src, array("jquery"), $bundle_ver, true);

        }

        /**
         * Add a custom role without administrative capabilities, but with appearance capabilities.
         * This allows users with the `Editor` permission to manage menu-items, without giving them access
         * to the any other tabs in the `Appearance` menu section.
         */
        public function remove_screen_options() {

            global $submenu;

            $user = wp_get_current_user();

            if ( !in_array( 'administrator', $user->roles ) && isset( $submenu['themes.php'] ) ) {
                foreach ($submenu['themes.php'] as $key => $menu_item ) {
                    if ( in_array('Customize', $menu_item ) ) {
                        unset( $submenu['themes.php'][$key] );
                    }
                    if ( in_array('Themes', $menu_item ) ) {
                        unset( $submenu['themes.php'][$key] );
                    }
                }
            }

        }

        /**
         * Admin setup registers additional settings on the global options page for us.
         *
         * TODO: Need to update the `register_setting` function to take an array in the third parameter – once we're able to update to 4.7.3
         * That API is not available in 4.6.3
         */
        public function admin_setup() {
            register_setting(
                'general',
                'cdn_url'
                );

            add_settings_field(
                'cdn_url',
                'CDN Address (URL)',
                array( $this, 'render_settings_field' ),
                'general',
                'default',
                array( 'cdn_url', get_option('cdn_url') )
                );
        }

        /**
         * Callback function to render the CDN URL field in the options.
         *
         * @param $args array the array of value arguments
         *
         */
        public function render_settings_field( $args ) {
            echo "<input aria-describedby='cdn-description' name='cdn_url' class='regular-text code' type='text' id='" . $args[0] . "' value='" . $args[1] . "'/>";
            echo "<p id='cdn-description' class='description'>Input the url of the CDN to use with this site or leave this field blank to bypass the CDN.";
        }

        /**
         * Rewrite attachment URL from the base CMS form to the desired CDN form.
         *
         * @filter 'wp_get_attachment_url'
         * @param $original string the original attachment URL
         * @return String the updated CDN url.
         */
        public function rewrite_cdn_url( $original ) {

            $trailing_string = '/wp-content/uploads/';
            $cms_url =  get_option( 'siteurl' );
            $cdn_url = get_option('cdn_url');


            if ( ! empty( $cdn_url ) ) {

                return str_replace( $cms_url . $trailing_string, $cdn_url . '/', $original );

            } else {

                return $original;

            }

        }

        /**
         * Rewrite attachment URL from the base CMS form to the desired CDN form.
         *
         * @filter 'timber_image_src'
         * @param $original string the original attachment URL
         * @return String the updated CDN url.
         */
        public function rewrite_timber_cdn_url( $src, $ID ) {

            $size = '';
            $attachement_src = wp_get_attachment_image_src( $ID, $size )[0];
            $fixed_src = $attachement_src ? $attachement_src : $src;
            return $fixed_src;

        }



    }

    new CLIMBInitiative();
