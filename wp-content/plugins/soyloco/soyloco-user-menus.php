<?php


//------------------------------------------------------------------------//
//---Hooks----------------------------------------------------------------//
//------------------------------------------------------------------------//
add_action( 'admin_menu', 'ds_delete_blog_menu_disable',-99); // I really don't want blog Admin to delete their blog
add_action( 'wpmu_options','ds_menu_option', -99 ); // below "Menus (Enable or disable WP Backend Menus) Plugins"
add_action( 'wp_dashboard_setup','ds_hide_dash' );
add_action( 'admin_menu','ds_hide_dash_menu', -99 ); // removes menus added by add_submenu_page
add_action( 'admin_head', 'ds_media_buttons_remove' );
add_action( '_admin_menu', 'ds_menu_disable' ); 
add_filter('favorite_actions', 'ds_reduce_favorite_actions'); // hide favorites in menu header, too - props mdgross

//------------------------------------------------------------------------//
//---Functions to Enable/Disable admin menus------------------------------//
//------------------------------------------------------------------------//
function ds_reduce_favorite_actions ($actions)
{
			$menu_perms = get_site_option( "menu_items" );

if(( $menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1' ) && (is_site_admin())) 
	return $actions;

		$remove_menu_items = array(''); // start with an empty array
		
			if( $menu_perms[ 'Posts Add New' ] != '1' && current_user_can('edit_posts') ) {
		$remove_menu_items = array('post-new.php','edit.php?post_status=draft');
			}
			if( $menu_perms[ 'Pages Add New' ] != '1' && current_user_can('edit_pages')) {
		$remove_menu_items = array_merge(array('page-new.php'),$remove_menu_items); // merge the existing or empty arrays and continue
			}
			if( $menu_perms[ 'Media Add New' ] != '1' && current_user_can('upload_files')) {
		$remove_menu_items = array_merge(array('media-new.php'),$remove_menu_items); 
			}

			if( $menu_perms[ 'Comments' ] != '1' && current_user_can('edit_posts')) {
		$remove_menu_items = array_merge(array('edit-comments.php'),$remove_menu_items); 
			}

		foreach($remove_menu_items as $menu_item)
		{
			if(array_key_exists($menu_item, $actions))
			{
				unset($actions[$menu_item]);
			}
		}
	
	return $actions;
}
function ds_menu_disable() {
	global $submenu, $menu;
		$menu_perms = get_site_option( "menu_items" );
		if( is_array( $menu_perms ) == false )
		$menu_perms = array();
		
			if(($menu_perms) && ($menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1') && (is_site_admin())) // TODO: let there be settings first
			return;
	// 'Dashboard'
	if( $menu_perms && $menu_perms[ 'Dashboard' ] != '1' && current_user_can('read')) {
		if(!empty($menu)) {
			foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Dashboard" || $sm[2] == "index.php") {
				unset($menu[$key]);
				unset( $submenu[ 'index.php' ] );
				break; 
				}
			}
		}
		//redirect with hook to wp_dashboard_setup below
	}



	// 'Posts'
	if( $menu_perms && $menu_perms[ 'Posts' ] != '1' && (current_user_can('edit_posts'))) {
		if(!empty($menu)) {
			foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Posts" || $sm[2] == "edit.php") {
				unset($menu[$key]);
				unset($submenu['edit.php']);
				break; 
				}
			}
		} // disable child menus to add a redirect
	}
	
	// 'Posts Edit'
	if( $menu_perms && $menu_perms[ 'Posts Edit' ] != '1' && current_user_can('edit_posts')) {
		if(!empty($submenu['edit.php'])) {
		foreach($submenu['edit.php'] as $key => $sm) {
			if(__($sm[0]) == "Posts" || $sm[2] == "edit.php") {
				unset($submenu['edit.php'][$key]);
				break;
				}
			}
		}

		if( strpos($_SERVER['REQUEST_URI'], 'edit.php'))	// plugin settings will redirect, too.	
			wp_redirect('profile.php');
	}	
	// 'Posts Add New'
	if( $menu_perms && $menu_perms[ 'Posts Add New' ] != '1' && current_user_can('edit_posts') ) {
		if(!empty($submenu['edit.php'])) {
		foreach($submenu['edit.php'] as $key => $sm) {
			if(__($sm[0]) == "Add New" || $sm[2] == "post-new.php") {
				unset($submenu['edit.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'post-new.php'))		
			wp_redirect('profile.php');
	}	

	// 'Posts Tags'
	if( $menu_perms && $menu_perms[ 'Posts Tags' ] != '1' && current_user_can('manage_categories')) {
		if(!empty($submenu['edit.php'])) {
		foreach($submenu['edit.php'] as $key => $sm) {
			if(__($sm[0]) == "Post Tags" || $sm[2] == "edit-tags.php") {
				unset($submenu['edit.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'edit-tags.php'))		
			wp_redirect('edit.php');
	}
	// 'Posts Categories'
	if( $menu_perms && $menu_perms[ 'Posts Categories' ] != '1' && current_user_can('manage_categories') ) {
		if(!empty($submenu['edit.php'])) {
		foreach($submenu['edit.php'] as $key => $sm) {
			if(__($sm[0]) == "Categories" || $sm[2] == "categories.php") {
				unset($submenu['edit.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], '/categories.php'))  // '/' needed to keep edit-link-categories.php from redirecting		
			wp_redirect('edit.php');
	}
	// 'Media'
	if( $menu_perms && $menu_perms[ 'Media' ] != '1' && current_user_can('upload_files')) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Media" || $sm[2] == "upload.php") {
				unset ($menu[$key]); 
				unset( $submenu[ 'upload.php' ] );
				break;
				}
			}
		}
	}	
	// 'Media Library'
	if( $menu_perms && $menu_perms[ 'Media Library' ] != '1' && current_user_can('upload_files')) {
		if(!empty($submenu['upload.php'])) {
		foreach($submenu['upload.php'] as $key => $sm) {
			if(__($sm[0]) == "Library" || $sm[2] == "upload.php") {
				unset($submenu['upload.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'upload.php'))	// needs testing	
	//	wp_redirect('edit.php'); // creates iframes within iframes in the popup media uploader
		wp_die('Sorry, uploads are closed. SiteAdmin has disabled Media Library.'); // kinda dumb if the media_buttons are not hidden in the post edit form.
	}
	// 'Media Add New'
	if( $menu_perms && $menu_perms[ 'Media Add New' ] != '1' && current_user_can('upload_files')) {
		if(!empty($submenu['upload.php'])) {
		foreach($submenu['upload.php'] as $key => $sm) {
			if(__($sm[0]) == "Add New" || $sm[2] == "media-new.php") {
				unset($submenu['upload.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'media-new.php'))		
		wp_redirect('post-new.php');

	}
	// 'Links'
	if( $menu_perms && $menu_perms[ 'Links' ] != '1' && (current_user_can('manage_links'))) {
		if(!empty($menu)) {
			foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Links" || $sm[2] == "link-manager.php") {
				unset($menu[$key]);
				unset( $submenu[ 'link-manager.php' ] );
				break; 
				}
			}
		} // disable child menus to add a redirect
	}
	// 'Links Edit'
	if( $menu_perms && $menu_perms[ 'Links Edit' ] != '1' && current_user_can('manage_links')) {
		if(!empty($submenu['link-manager.php'])) {
		foreach($submenu['link-manager.php'] as $key => $sm) {
			if(__($sm[0]) == "Edit" || $sm[2] == "link-manager.php") {
				unset($submenu['link-manager.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'link-manager.php'))		
			wp_redirect('edit.php');
	}
	// 'Links Add New'
	if( $menu_perms && $menu_perms[ 'Links Add New' ] != '1' && current_user_can('manage_links') ) {
		if(!empty($submenu['link-manager.php'])) {
		foreach($submenu['link-manager.php'] as $key => $sm) {
			if(__($sm[0]) == "Link" || $sm[2] == "link-add.php") {
				unset($submenu['link-manager.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'link-add.php'))		
			wp_redirect('post-new.php');
	}
	// 'Links Link Categories'
	if( $menu_perms && $menu_perms[ 'Links Link Categories' ] != '1' && current_user_can('manage_categories')) {
		if(!empty($submenu['link-manager.php'])) {
		foreach($submenu['link-manager.php'] as $key => $sm) {
			if(__($sm[0]) == "Link Categories" || $sm[2] == "edit-link-categories.php") { 
				unset($submenu['link-manager.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'edit-link-categories.php'))		
			wp_redirect('edit.php');
	}
	// 'Pages'
	if( $menu_perms && $menu_perms[ 'Pages' ] != '1' && (current_user_can('edit_pages'))) {
		if(!empty($menu)) {
			foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Pages" || $sm[2] == "edit-pages.php" ) {
				unset($menu[$key]);
				unset( $submenu[ 'edit-pages.php' ] );
				break; 
				}
			}
		} // disable child menus to add a redirect
	}
	// 'Pages Edit'
	if( $menu_perms && $menu_perms[ 'Pages Edit' ] != '1' && current_user_can('edit_pages')) {
		if(!empty($submenu['edit-pages.php'])) {
		foreach($submenu['edit-pages.php'] as $key => $sm) {
			if(__($sm[0]) == "Pages" || $sm[2] == "edit-pages.php") {
				unset($submenu['edit-pages.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'edit-pages.php'))		
			wp_redirect('edit.php');
	}
	// 'Pages Add New'
	if( $menu_perms && $menu_perms[ 'Pages Add New' ] != '1' && current_user_can('edit_pages')) {
		if(!empty($submenu['edit-pages.php'])) {
		foreach($submenu['edit-pages.php'] as $key => $sm) {
			if(__($sm[0]) == "Add New" || $sm[2] == "page-new.php") {
				unset($submenu['edit-pages.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'page-new.php'))		
			wp_redirect('post-new.php');
	}
	// Comments
	if( $menu_perms && $menu_perms[ 'Comments' ] != '1' && current_user_can('edit_posts')) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Comments" || $sm[2] == "edit-comments.php") {
				unset ($menu[$key]); // kinda dumb if comments are open and awaiting moderation
				unset( $submenu[ 'edit-comments.php' ] );
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'edit-comments.php'))		
			wp_redirect('profile.php');
	}	
	
	// If 'Appearance' is hidden, Widgets and Themes are still url accessible
	if( $menu_perms && $menu_perms[ 'Appearance' ] != '1' && current_user_can('switch_themes')) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Appearance") {
				unset ($menu[$key]); 
				unset($submenu['themes.php']);
				break;
				}
			}
		}
	}	 // best not to redirect here, either
	// 'Appearance Themes'
	if( $menu_perms && $menu_perms[ 'Appearance Themes' ] != '1' && current_user_can('switch_themes')) { 
		if(!empty($submenu['themes.php'])) {
		foreach($submenu['themes.php'] as $key => $sm) {
			if(__($sm[0]) == "Themes" || $sm[2] == "themes.php") {
				unset($submenu['themes.php'][$key]);
				break;
				}
			}
		}
		/*********
		//  redirecting themes may break more than it is worth ... needs testing with your theme options pages
		if( strpos($_SERVER['REQUEST_URI'], 'themes.php'))	
			wp_redirect('widgets.php'); 
			***********/
	}
	
	// 'Users'
	if( $menu_perms && $menu_perms[ 'Users' ] != '1' && current_user_can('edit_users') ) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Users") {
				if( $menu_perms[ 'Users Your Profile' ] == '1' && current_user_can('read')) {
				$menu[$key] = array(__('Profile'), 'read', 'profile.php'); // promote
				} else {
				unset($menu[$key]);
				unset( $submenu[ 'users.php' ] );
				}
				break;
				}
			}
		} //	the redirect here is not possible, must also disable Author & Users to enable the redirect
	}
	// 'Users Authors and Users'
	if( $menu_perms && $menu_perms[ 'Users Authors and Users' ] != '1' && current_user_can('edit_users')) {
		if(!empty($submenu['users.php'])) {
		foreach($submenu['users.php'] as $key => $sm) {
			if(__($sm[0]) == "Authors &amp; Users" || $sm[2] == "users.php") {
				unset($submenu['users.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], '/users.php'))  // '/' needed to keep wpmu-users.php from redirecting
			wp_redirect('profile.php');
	}
	// 'Users Add New'
	if( $menu_perms && $menu_perms[ 'Users Add New' ] != '1' && current_user_can('edit_users')) {
		if(!empty($submenu['users.php'])) {
		foreach($submenu['users.php'] as $key => $sm) {
			if(__($sm[0]) == "Add New" || $sm[2] == "users-new.php") {
				unset($submenu['users.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'users-new.php')) 
			wp_redirect('profile.php');
	}
	// 'Users Your Profile'
	if( $menu_perms && $menu_perms[ 'Users Your Profile' ] != '1' && current_user_can('read')) {
		if(!empty($submenu['users.php'])) {
		foreach($submenu['users.php'] as $key => $sm) {
			if(__($sm[0]) == "Your Profile" || $sm[2] == "profile.php") {
				unset($submenu['users.php'][$key]);
				break;
				}
			} 
		} elseif(( $menu_perms[ 'Users Your Profile' ] != '1' && current_user_can('read')) && !empty($menu)) {
			foreach($menu as $key => $sm) {
				if(!empty($sm[0])) {
			if(__($sm[0]) == "Profile" || $sm[2] == "profile.php") {
				unset($menu[$key]);
				break; 
					} // enabling a redirect here may be more trouble than it is worth. Shouldn't every user at least see a profile page?
				}
			}
		}
	}

	// 'Tools'
	if( $menu_perms && $menu_perms[ 'Tools' ] != '1' && current_user_can('read')) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Tools" || $sm[2] == "tools.php") {
				unset ($menu[$key]); 
				unset( $submenu[ 'tools.php' ] );
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'import.php'))		
			wp_redirect('profile.php');
	}	
	// 'Tools'
	if( $menu_perms && $menu_perms[ 'Tools' ] != '1' && current_user_can('import')) {
		if(!empty($submenu['tools.php'])) {
		foreach($submenu['tools.php'] as $key => $sm) {
			if(__($sm[0]) == "Tools" || $sm[2] == "tools.php") {
				unset($submenu['tools.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'import.php'))	
			wp_redirect('edit.php');
	}
	// 'Tools Import'
	if( $menu_perms && $menu_perms[ 'Tools Import' ] != '1' && current_user_can('import')) {
		if(!empty($submenu['tools.php'])) {
		foreach($submenu['tools.php'] as $key => $sm) {
			if(__($sm[0]) == "Import" || $sm[2] == "import.php") {
				unset($submenu['tools.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'import.php'))	
			wp_redirect('edit.php');
	}
	// 'Tools Export'
	if( $menu_perms && $menu_perms[ 'Tools Export' ] != '1' && current_user_can('import')) {
		if(!empty($submenu['tools.php'])) {
		foreach($submenu['tools.php'] as $key => $sm) {
			if(__($sm[0]) == "Export" || $sm[2] == "export.php") {
				unset($submenu['tools.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'export.php'))	
			wp_redirect('edit.php');
	}
	// 'Tools Tools'
	if( $menu_perms && $menu_perms[ 'Tools Tools' ] != '1' && current_user_can('import')) {
		if(!empty($submenu['tools.php'])) {
		foreach($submenu['tools.php'] as $key => $sm) {
			if(__($sm[0]) == "Tools" || $sm[2] == "Tools.php") {
				unset($submenu['tools.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'tools.php'))	
			wp_redirect('edit.php');
	}
	// 'Settings'
		if( $menu_perms && $menu_perms[ 'Settings' ] != '1' && current_user_can('manage_options')) {
			if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(__($sm[0]) == "Settings" || $sm[2] == "options-general.php") {
				unset($menu[$key]);
				unset( $submenu[ 'options-general.php' ] );
				break; 
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-general.php'))		
			wp_redirect('profile.php');
	}
	// 'Settings General'
	if( $menu_perms && $menu_perms[ 'Settings General' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "General" || $sm[2] == "options-general.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-general.php'))		
			wp_redirect('profile.php');
	}
	// 'Settings Writing'
	if( $menu_perms && $menu_perms[ 'Settings Writing' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Writing" || $sm[2] == "options-writing.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-writing.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Reading'
	if( $menu_perms && $menu_perms[ 'Settings Reading' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Reading" || $sm[2] == "options-reading.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-reading.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Discussion'
	if( $menu_perms && $menu_perms[ 'Settings Discussion' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Discussion" || $sm[2] == "options-discussion.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-discussion.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Media'
	if( $menu_perms && $menu_perms[ 'Settings Media' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Media" || $sm[2] == "options-media.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-media.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Privacy'
	if( $menu_perms && $menu_perms[ 'Settings Privacy' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Privacy" || $sm[2] == "options-privacy.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-privacy.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Permalinks'
	if( $menu_perms && $menu_perms[ 'Settings Permalinks' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Permalinks" || $sm[2] == "options-permalink.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-permalink.php'))		
			wp_redirect('options-general.php');
	}
	// 'Settings Miscellaneous'
	if( $menu_perms && $menu_perms[ 'Settings Miscellaneous' ] != '1' && current_user_can('manage_options')) {
		if(!empty($submenu['options-general.php'])) {
		foreach($submenu['options-general.php'] as $key => $sm) {
			if(__($sm[0]) == "Miscellaneous" || $sm[2] == "options-misc.php") {
				unset($submenu['options-general.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'options-misc.php'))		
			wp_redirect('options-general.php');
	}
}

// 'Delete Blog'
function ds_delete_blog_menu_disable() {
	global $submenu, $menu, $delete_blog_obj;
	$menu_perms = get_site_option( "menu_items" );
	if( is_array( $menu_perms ) == false )
		$menu_perms = array();
			if(($menu_perms) && ( $menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1' ) && (is_site_admin()))
			return;
	if(($menu_perms) && $menu_perms[ 'Settings Delete Blog' ] != '1' ) {
		if (isset($delete_blog_obj)) {
			remove_action('admin_menu', array(&$delete_blog_obj, 'admin_menu'));
			}
	} // no rediect needed in my tests
}

//------------------------------------------------------------------------//
//--- Function to toggle Media Buttons in edit forms----------------------//
//---- Media buttons now limit file types by default in wpmu-options.php --//
function ds_media_buttons_remove () {
	$menu_perms = get_site_option( "menu_items" );
	if( is_array( $menu_perms ) == false )
		$menu_perms = array();
			if(($menu_perms) &&( $menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1' ) && (is_site_admin()))
			return;
	if( $menu_perms && $menu_perms[ 'WPMU Media Buttons' ] != '1' ) 
	 	remove_action( 'media_buttons', 'mu_media_buttons' );
					
 	if( $menu_perms && $menu_perms[ 'WP Media Buttons' ] == '1' ) 
	 	add_action( 'media_buttons', 'media_buttons' );
}
//------------------------------------------------------------------------//
//---Functions to redirect from Dashboard --------------------------------//
//---Warning: any other plugin using dashboard setup may be affected------//
function ds_hide_dash() {
	$menu_perms = get_site_option( "menu_items" );
	if( is_array( $menu_perms ) == false )
		$menu_perms = array();
			if(($menu_perms) && ( $menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1' ) && (is_site_admin()))
			return;
			if( $menu_perms[ 'Dashboard' ] != '1' ) {
			wp_redirect('profile.php');
			exit();
		}
}
function ds_hide_dash_menu() {
	// hide WMPU dashboard submenus in the admin_menu hook rather than _admin_menu
	global $menu, $submenu;
		$menu_perms = get_site_option( "menu_items" );
		if( is_array( $menu_perms ) == false )
		$menu_perms = array();
		
			if(($menu_perms) && ( $menu_perms[ 'Site Administrator Gets Limited Menus?' ] != '1' ) && (is_site_admin())) // TODO: let there be settings first
			return;
	// 'Dashboard My Blogs'
	if(($menu_perms) &&  $menu_perms[ 'Dashboard My Blogs' ] != '1' && current_user_can('read')) {
remove_action('admin_menu', 'blogs_page_init');

	}	

}
//------------------------------------------------------------------------//
//---Function SiteAdmin->Options------------------------------------------//
//---Options are saved as site_options on wpmu-options.php page-----------//
function ds_menu_option() {
	$menu_perms = get_site_option( "menu_items" );
	if( is_array( $menu_perms ) == false )
		$menu_perms = array();
			$menu_items = array(
			// remove or add any menu, just be sure to do same above 
			'Site Administrator Gets Limited Menus?',
			'Posts',
			'Posts Add New',
			'Posts Edit',
			'Posts Tags',
			'Posts Categories',
			'Links',
			'Links Add New',
			'Links Edit',
			'Links Link Categories',
			'Pages',
			'Pages Add New',
			'Pages Edit',
			'Media',
			'Media Library',
			'Media Add New',
			'Comments',
			'Appearance', 
			'Appearance Themes',
			'Users', 
			'Users Authors and Users',
			'Users Add New',
			'Users Your Profile',
			'Tools',
			'Tools Tools',
			'Tools Import',
			'Tools Export',
			'Settings',
			'Settings General',
			'Settings Writing',
			'Settings Reading',
			'Settings Discussion',
			'Settings Media',  
			'Settings Privacy',
			'Settings Permalinks',
			'Settings Delete Blog',
			'Settings Miscellaneous', 
			'WPMU Media Buttons',
			'WP Media Buttons',
			'Dashboard',
			'Dashboard My Blogs'
			);
	echo '<table class="form-table">'; 
			foreach ( (array) $menu_items as $key => $val ) {
				$checked = ( $menu_perms[$val] == '1' ) ? ' checked=""' : '';
				echo "<tr><th scope='row'>" . ucfirst( $val ) . "</th><th scope='row'><input type='checkbox' name='menu_items[" . $val . "]' value='1'" . $checked . " /></th></tr>"; 
			}
	echo '
		</table>
		<small>Known Menu Bugs: Disabling "Your Profile" may not be a good idea, there needs to be a page every user can see. Even though a menu(or submenu) is disabled, access to the menu page(or submenu pages) via the url may still be possible. Disabling "Media Edit" will add a "Sorry, uploads are closed." to the Media Upload Buttons as well. Plugins adding submenu items to Adminbar may not be hidden in all browsers. Happy testing!</small>';
}	
?>
