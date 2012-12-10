<?php

$wpmuBaseTablePrefix = "wp_";

class wpmu_sitefeed {

	var $version = '0.3.2';

	function wpmu_sitefeed() {
		add_action('init', array(&$this, 'wpmu_sitefeed_init'));
	}

	function wpmu_sitefeed_init() {
		$this->apply_settings();
		if ($this->cache) $this->cache = $this->check_cache();
		if ($this->trigger('posts')) return $this->outputfeed('posts');
		if ($this->trigger('comments')) return $this->outputfeed('comments');
		if ($this->trigger('pages')) return $this->outputfeed('pages');
		add_action('publish_post', array(&$this, 'expire_post_feeds'));
		add_action('delete_post', array(&$this, 'expire_post_feeds'));
		add_action('private_to_published', array(&$this, 'expire_post_feeds'));
		add_action('comment_post', array(&$this, 'expire_comments_feed'));
		add_action('delete_comment', array(&$this, 'expire_comments_feed'));
		add_action('trackback_post', array(&$this, 'expire_comments_feed'));
		add_action('wp_set_comment_status', array(&$this, 'expire_comments_feed'));
		add_action('wpmuadminedit', array(&$this, 'expire_feeds')); // in case the admin deletes a blog
		add_action('admin_menu', array(&$this, 'add_submenu'));
	}

	function trigger($type) {
		global $wpdb;
		if ($wpdb->blogid != $this->triggerblog) return false;
		if ($type == 'posts') $url = $this->triggerurl;
		if ($type == 'comments') $url = $this->triggerurl.$this->commentsurl;
		if ($type == 'pages') $url = $this->triggerurl.$this->pagesurl;
		if( constant( 'VHOST' ) == 'yes' ) {
			return (substr($_SERVER['REQUEST_URI'], strlen($url)*-1) == $url) ? true : false;
		} else {
			if ($type == 'posts' && $_GET['wpmu-feed'] == 'posts') return true;
			if ($type == 'comments' && $_GET['wpmu-feed'] == 'comments') return true;
			if ($type == 'pages' && $_GET['wpmu-feed'] == 'pages') return true;
			return false;
		}
	}

	function sizelimit($array) {
		return (count($array) >= $this->feedcount) ? intval($this->feedcount) : intval(count($array));
	}

	function check_cache() {
		global $wp_object_cache;
		return (is_object($wp_object_cache)
            && isset($wp_object_cache->cache_enabled)
            && $wp_object_cache->cache_enabled == true) ? true : false;
	}

	function cache_expire_time() {
		global $wp_object_cache;
		return ($wp_object_cache->expiration_time/60);
	}

	function add_submenu() {
		get_currentuserinfo();
		if (!is_site_admin()) return false;
		add_submenu_page('wpmu-admin.php', 'Sitewide Feed Configuration', 'Site Feed', 10, 'wpmu_sitewide_feed', array(&$this,'config_page'));
	}

	function save_settings() {
		global $wpdb, $wp_db_version, $updated, $configerror;
		check_admin_referer();
		// validate all input!
		if (preg_match('/^[0-9]+$/',$_POST['triggerblog']) && $_POST['triggerblog'] > 0) $triggerblog = intval($_POST['triggerblog']);
		else $configerror[] = 'Trigger blog must be a numeric blog ID. Default: 1';

		if (preg_match('/^\/[a-zA-Z0-9_\/\-]+\/$/',$_POST['triggerurl'])) $triggerurl = $_POST['triggerurl'];
		else $configerror[] = 'Invalid trigger URL. Must be a relative path beginning with and ending with a "/". Default: /wpmu-feed/';

		if (preg_match('/^[a-zA-Z0-9_\-]+\/$/',$_POST['commentsurl'])) $commentsurl = $_POST['commentsurl'];
		else $configerror[] = 'Invalid comments URL. Must be a relative path ending with a "/". Default: comments/';

		if (preg_match('/^[a-zA-Z0-9_\-]+\/$/',$_POST['pagesurl'])) $pagesurl = $_POST['pagesurl'];
		else $configerror[] = 'Invalid pages URL. Must be a relative path ending with a "/". Default: pages/';

		if (preg_match('/^[0-9]+$/',$_POST['feedcount']) && $_POST['feedcount'] > 0) $feedcount = intval($_POST['feedcount']);
		else $configerror[] = 'Post count must be a number greater than zero. Default: 20';

		if (preg_match('/^[a-zA-Z0-9_\-\s\.]+$/',$_POST['feedtitle']) || $_POST['feedtitle'] == '') $feedtitle = $_POST['feedtitle'];
		else $configerror[] = 'Invalid feed title.';

		if (preg_match('/^[a-zA-Z0-9_\-\s\.\,]+$/',$_POST['feeddesc']) || $_POST['feeddesc'] == '') $feeddesc = $_POST['feeddesc'];
		else $configerror[] = 'Invalid feed description.';

		if (preg_match('/^[a-zA-Z0-9_\-]+$/',$_POST['untitled']) || $_POST['untitled'] == '') $untitled = $_POST['untitled'];
		else $configerror[] = 'Invalid untitled post title. Default: untitled';

		if ($_POST['showstats'] == 1 || $_POST['showstats'] == 0) $showstats = intval($_POST['showstats']);
		else $configerror[] = 'Show stats: Must be a one or zero. Default: 1';

		if ($_POST['excerpt'] == 0 || $_POST['excerpt'] == 1) $excerpt = intval($_POST['excerpt']);
		else $configerror[] = 'Use excerpts: Must be a one or zero. Default: 0';

		if ($_POST['etag'] == 1 || $_POST['etag'] == 0) $etag = intval($_POST['etag']);
		else $configerror[] = 'Use ETag Header: Must be a one or zero. Default: 1';

		if ($_POST['cache'] == 1 || $_POST['cache'] == 0) $cache = intval($_POST['cache']);
		else $configerror[] = 'Use Object Cache: Must be a one or zero. Default: 1';

		if (preg_match('/^[0-9]+$/',$_POST['expiretime']) && $_POST['expiretime'] >= 0) $expiretime = intval($_POST['expiretime']);
		elseif ($wp_db_version > 3513) $configerror[] = 'Expire time must be a number equal to or greater than zero. Default: 0 (expire only when needed)';
		else $configerror[] = 'Expire time must be a number equal to or greater than zero. Default: '.$this->cache_expire_time().' (expire to account for future dated posts)';

		if ($_POST['expiretime'] > $this->cache_expire_time())
			$configerror[] = 'Expire Minutes: Cannot exceed WP Object Cache expiration time of '.$this->cache_expire_time().' minutes.';

		if ($wpdb->blogid == $_POST['triggerblog'] && ($_POST['triggerurl'] == '/' || stristr($_POST['triggerurl'],'wp-admin')))
			$configerror[] = 'Doh! That combination of blog id and trigger url may have locked you out of your site!';

		if (is_array($configerror)) return $configerror;

		$settings = compact('triggerblog','triggerurl','commentsurl','pagesurl','feedtitle','feeddesc','feedcount','excerpt','untitled','showstats','cache','etag','expiretime');
		foreach($settings as $setting => $value) if ($this->$setting != $value) $changed = true;
		if ($changed) {
			update_site_option('wpmu_sitefeed_settings', $settings);
			$this->expire_feeds();
			$this->apply_settings($settings);
			return $updated = true;
		}
	}

	function set_defaults() {
		global $wp_db_version;
		// do not edit here - use the admin screen
		$this->feedcount = 20;
		$this->triggerblog = 1;
		if( constant( 'VHOST' ) == 'yes' ) {
			$this->triggerurl = '/wpmu-feed/';
			$this->commentsurl = 'comments/';
			$this->pagesurl = 'pages/';
		} else {
			$this->triggerurl = '?wpmu-feed=posts';
			$this->commentsurl = '?wpmu-feed=comments';
			$this->pagesurl = '?wpmu-feed=pages';
		}
		$this->untitled = 'untitled';
		$this->showstats = 1;
		$this->excerpt = 0;
		$this->cache = 1;
		$this->etag = 1;
		$this->feedtitle = get_site_option('site_name').' Master Site Feed';
		$this->feeddesc = 'Shows all posts, comments, and pages from all blogs on this WPMU powered site';
		($wp_db_version > 3513) ? $this->expiretime = 0 : ($this->cache_expire_time() > 15) ? $this->expiretime = 15 : $this->expiretime = $this->cache_expire_time();
	}

	function apply_settings($settings = false) {
		if (!$settings) $settings = get_site_option('wpmu_sitefeed_settings');
		if (is_array($settings)) foreach($settings as $setting => $value) $this->$setting = $value;
		else $this->set_defaults();
	}

	function delete_settings() {
		global $wpdb, $updated;
		$settings = get_site_option('wpmu_sitefeed_settings');
		if ($settings) {
			$wpdb->query("DELETE FROM $wpdb->sitemeta WHERE `meta_key` = 'wpmu_sitefeed_settings'");
			if ($this->check_cache()) wp_cache_delete('wpmu_sitefeed_settings','site-options');
			$this->set_defaults();
			$this->expire_feeds();
			return $updated = true;
		}
	}

	function create_testlink($type) {
		global $wpdb;
		if ($type == 'posts') $url = $this->triggerurl;
		if ($type == 'comments') $url = $this->triggerurl.$this->commentsurl;
		if ($type == 'pages') $url = $this->triggerurl.$this->pagesurl;
		$domainpath = $wpdb->get_row("SELECT `domain`, `path` FROM `".$wpdb->blogs."` WHERE `blog_id` = '".$this->triggerblog."'",ARRAY_A);
		if (!is_array($domainpath)) return 'Trigger blog ID is was not found!';
		return '<a href="http://'.$this->untrailingslashit($domainpath['domain'].$domainpath['path']).$url.'" target="_blank">test link</a>';
	}

	function untrailingslashit($str) {
		return (substr($str,-1) == '/') ? substr($str,0,strlen($str)-1) : $str;
	}

	function create_map($type) {
		global $wpdb, $wpmuBaseTablePrefix;

		$multiplier = 100; // new setting to dig deep for posts/comments until we workaround wpmu_update_blogs_date messing with timestamp
		$blogs = $wpdb->get_col("SELECT `blog_id`, 'path' FROM ".$wpmuBaseTablePrefix."blogs
			WHERE `public` = '1' AND `archived` = '0' AND `last_updated` != '0000-00-00 00:00:00'
			ORDER BY `last_updated` DESC LIMIT ".$this->feedcount*$multiplier);


		foreach($blogs as $blogid) {
			if ($type == 'posts') {
				$results = $wpdb->get_results("SELECT `ID`,`post_date_gmt`
					FROM `".$wpmuBaseTablePrefix.$blogid."_posts`
					WHERE `post_status` = 'publish' AND (`post_type` = 'post' OR `post_type` = '') AND `post_date_gmt` < '".gmdate("Y-m-d H:i:s")."'
					ORDER BY `post_date_gmt` DESC LIMIT 1");
			} elseif ($type == 'comments') {
				$defcomment = "Hi, this is a comment.<br />To delete a comment, just log in, and view the posts\' comments, there you will have the option to edit or delete them.";
				$results = $wpdb->get_results("SELECT comment_ID, comment_date_gmt, comment_post_ID,
					".$wpmuBaseTablePrefix.$blogid."_posts.ID, ".$wpmuBaseTablePrefix.$blogid."_posts.post_password
					FROM ".$wpmuBaseTablePrefix.$blogid."_comments
					LEFT JOIN ".$wpmuBaseTablePrefix.$blogid."_posts ON comment_post_id = id
					WHERE ".$wpmuBaseTablePrefix.$blogid."_posts.post_status IN ('publish', 'static', 'object')
					AND `comment_content` != '".$defcomment."'
					AND ".$wpmuBaseTablePrefix.$blogid."_comments.comment_approved = '1'
					AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "'
					ORDER BY comment_date_gmt DESC LIMIT " . $this->feedcount*$multiplier);
			} elseif ($type == 'pages') {
				$aboutpage = 'This is an example of a WordPress page, you could edit this to put information about yourself or your site so readers know where you are coming from. You can create as many pages like this one or sub-pages as you like and manage all of your content inside of WordPress.';
				$results = $wpdb->get_results("SELECT `ID`,`post_date_gmt`
					FROM `".$wpmuBaseTablePrefix.$blogid."_posts`
					WHERE `post_content` != '".$aboutpage."' AND `post_status` = 'static' OR (`post_status` = 'publish' AND `post_type` = 'page')
					AND `post_date_gmt` < '".gmdate("Y-m-d H:i:s")."'
					ORDER BY `post_date_gmt` DESC LIMIT ".$this->feedcount*$multiplier);
			} elseif ($type == 'images') {
				$results = $wpdb->get_results("SELECT `ID`,`post_date_gmt`
					FROM `".$wpmuBaseTablePrefix.$blogid."_posts` as general_posts
					WHERE `post_status` = 'inherit' AND `post_type` = 'attachment' AND post_mime_type like 'image%' AND `post_date_gmt` < '".gmdate("Y-m-d H:	i:s")."' AND (select ID from `".$wpmuBaseTablePrefix.$blogid."_posts` where ID=general_posts.post_parent)
					ORDER BY `post_date_gmt` DESC LIMIT ".$this->feedcount*$multiplier);
			}
			if (is_array($results)) {
				foreach($results as $result) {
					$result_path = (isset($result->path)) ? $result->path : false;
                    if ($type == 'posts' || $type == 'pages' || $type == 'images') {
						$map[] = array($blogid,$result->ID,$result->post_date_gmt, $result_path);
						$ID[] = $result->ID;
						$date_gmt[] = $result->post_date_gmt;
					} elseif ($type == 'comments') {
						$map[] = array($blogid,$result->comment_ID,$result->comment_date_gmt);
						$ID[] = $result->comment_ID;
						$date_gmt[] = $result->comment_date_gmt;
					}
				}
			}
		}
		if (is_array($map)) {
			array_multisort($date_gmt, SORT_DESC, $ID, SORT_ASC, $map);
			return array_slice($map,0,$this->sizelimit($map));
		}
	}

	function get_data($type) {
		global $wpdb, $wpmuBaseTablePrefix;
		$map = $this->create_map($type);
		if (!is_array($map)) return false;
		foreach($map as $item) {
			if ($type == 'posts' || $type == 'pages') {
				$row = $wpdb->get_row("SELECT * FROM `".$wpmuBaseTablePrefix.intval($item[0])."_posts` WHERE `ID` = '".intval($item[1])."' AND ID <> 1");
				/*
				 * recebendo o nome do blog
				 */
				$blogname = $wpdb->get_var("SELECT option_value FROM ".$wpmuBaseTablePrefix.intval($item[0])."_options WHERE option_name = 'blogname'");
				$siteurl = $wpdb->get_var("SELECT option_value FROM ".$wpmuBaseTablePrefix.intval($item[0])."_options WHERE option_name = 'siteurl'");
				$comments_number = $wpdb->get_var("SELECT COUNT( * ) AS total FROM ".$wpmuBaseTablePrefix.intval($item[0])."_comments WHERE comment_approved = '1' AND comment_post_ID = '".intval($item[1])."'");

				if (isset($row->ID) && $row->ID) {
					if (!$row->post_title) $row->post_title = $this->untitled;
					$row->blogid = intval($item[0]);
					$row->blogname = $blogname;
					$row->siteurl = $siteurl;
					$row->comments_number = $comments_number;
					$rows[] = $row;
				}
			} elseif ($type == 'comments') {
				$row = $wpdb->get_row("SELECT * FROM `".$wpmuBaseTablePrefix.intval($item[0])."_comments` WHERE `comment_ID` = '".intval($item[1])."'");
				/*
				 * recebendo o guid do post
				 */
				$url = $wpdb->get_var("SELECT guid FROM ".$wpmuBaseTablePrefix.intval($item[0])."_posts AS posts, ".$wpmuBaseTablePrefix.intval($item[0])."_comments AS comments WHERE posts.ID = comments.comment_post_ID AND comments.comment_ID = '".$row->comment_ID."'");
				if ($row->comment_ID) {
					$row->blogid = intval($item[0]);
					$row->guid = $url;
					$rows[] = $row;
				}
			} elseif ($type == 'images') {
				$row = $wpdb->get_row("SELECT * FROM `".$wpmuBaseTablePrefix.intval($item[0])."_posts` WHERE `ID` = '".intval($item[1])."' AND ID <> 1");
				/*
				 * recebendo o nome do blog
				 */
				$blogname = $wpdb->get_var("SELECT option_value FROM ".$wpmuBaseTablePrefix.intval($item[0])."_options WHERE option_name = 'blogname'");
				$siteurl = $wpdb->get_var("SELECT option_value FROM ".$wpmuBaseTablePrefix.intval($item[0])."_options WHERE option_name = 'siteurl'");
				$post_data = $wpdb->get_row("SELECT post_title,guid FROM ".$wpmuBaseTablePrefix.intval($item[0])."_posts WHERE post_status = 'publish' AND ID=".$row->post_parent);

				if ($post_data->post_title != '') {
					$row->post_title = $post_data->post_title;
					if (!$row->post_title) $row->post_title = $this->untitled;
					$row->blogid = intval($item[0]);
					$row->blogname = $blogname;
					$row->siteurl = $siteurl;
					$row->guid = $post_data->guid;
					$rows[] = $row;
				}
			}
		}
		if ($rows) return $rows;
	}

	function latest_time() {
		global $posts, $comments;
		return ($posts) ? $posts[0]->post_date_gmt : $comments[0]->comment_date_gmt;
	}

	function save_feed($name,$data) {
		if ($this->cache) update_site_option($name.'_ts',time());
		return ($this->cache) ? wp_cache_set($name,$data,'site-options') : false;
	}

	function fetch_feed($name) {
		if ($this->cache) {
			$expires = get_site_option($name.'_ts')+($this->expiretime*60);
			if ($expires <= time()) $this->expire_feed($name);
		}
		return ($this->cache) ? wp_cache_get($name,'site-options') : false;
	}

	function expire_feed($name = 'wpmu_sitefeed_cache') {
		return ($this->check_cache()) ? wp_cache_delete($name,'site-options') : false;
	}

	function expire_comments_feed() {
		return $this->expire_feed('wpmu_sitecomments_cache');
	}

	function expire_pages_feed() {
		return $this->expire_feed('wpmu_sitepages_cache');
	}

	function expire_post_feeds() {
		$this->expire_feed('wpmu_siteposts_cache');
		$this->expire_feed('wpmu_sitepages_cache');
	}

	function expire_feeds() {
		$this->expire_feed();
		$this->expire_comments_feed();
		$this->expire_pages_feed();
	}

	function outputfeed($type) {

		echo '<?xml version="1.0" encoding="'.get_settings('blog_charset').'"?'.'>';
		?>

<!-- generator="wordpress/<?php bloginfo_rss('version') ?>" -->
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	<?php do_action('rss2_ns'); ?>
>

<channel>
	<title>Feed geral do Soylocoporti</title>
	<link>http://soylocoporti.org.br</link>
	<description>Esse é o feed geral do Soylocoporti, mas temporariamente ele está desabilitado por questões de manutenção. Por favor, visite o nosso site pra ver as últimas notícias.</description>
	<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', $this->latest_time(), false); ?></pubDate>
	<generator>http://wordpress.org/?v=<?php bloginfo_rss('version'); ?></generator>
	<language><?php echo get_option('rss_language'); ?></language>
	<item>
		<title>Soylocoporti feed geral temporariamente desabilitado</title>
		<link>http://soylocoporti.org.br</link>
		<comments>Visite nosso site</comments>
		<pubDate><?php echo date('D, d M Y H:i:s +0000'); ?></pubDate>
		<dc:creator>Soylocoporti</dc:creator>
		<guid isPermaLink="false">http://soylocoporti.org.br</guid>
		<description>Visite o nosso site para novas notícias</description>
		<content:encoded>Visite o nosso site para novas notícias</content:encoded>
		<wfw:commentRss></wfw:commentRss>
	</item>
</channel>
</rss>
<?php

		exit();
// Bloqueio para evitar os ataques que o Soyloco vem sofrendo.


		if ($type == 'posts') $name = 'wpmu_sitefeed_cache';
		if ($type == 'comments') $name = 'wpmu_sitecomments_cache';
		if ($type == 'pages') $name = 'wpmu_sitepages_cache';
		if ($this->cache) {
			$feed = $this->fetch_feed($name);
			if ($feed) {
				$cached = true;
			} else {
				$feed = $this->generate_feed($type);
				$saved = $this->save_feed($name,$feed);
			}
		} else {
			$feed = $this->generate_feed($type);
		}
		if ($this->showstats) {
			$feed .= "<!-- ".get_num_queries()." queries ".number_format(timer_stop(),3)." seconds.";
			if ($cached) $feed .= " (cached)";
			$feed .= " -->\r\n";
		}
		preg_match('/<pubDate>(.*)<\/pubDate>/',$feed,$match);
		$lastmodified = date("D, j M Y H:i:s", strtotime($match[1]))." GMT" ;
		$etag = md5($lastmodified);
		header('Content-type: text/xml; charset='.get_settings('blog_charset'), true);
		if ($this->etag && ($_SERVER['HTTP_IF_NONE_MATCH'] == '"' . $etag . '"' || $lastmodified == $_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
			header('HTTP/1.1 304 Not Modified');
			header('Cache-Control: private');
			header('ETag: "'.$etag.'"');
		} else {
			if ($this->etag) {
				header('Last-Modified: ' . $lastmodified);
				header('ETag: "'.$etag.'"');
			}
			echo $feed;
		}
		exit();
	}

/*
	function generate_feed($type) {
		global $posts, $comments, $post, $comment;
		if ($type == 'posts') $posts = $this->get_data($type);
		if ($type == 'comments') $comments = $this->get_data($type);
		if ($type == 'pages') $posts = $this->get_data($type);
		ob_start();
		echo '<?xml version="1.0" encoding="'.get_settings('blog_charset').'"?'.'>';
		?>

<!-- generator="wordpress/<?php bloginfo_rss('version') ?>" -->
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	<?php do_action('rss2_ns'); ?>
>

<channel>
	<title><?php echo $this->feedtitle; if ($type == 'comments') echo ' Comments'; if ($type == 'pages') echo ' Pages'; ?></title>
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php echo $this->feeddesc; ?></description>
	<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', $this->latest_time(), false); ?></pubDate>
	<generator>http://wordpress.org/?v=<?php bloginfo_rss('version'); ?></generator>
	<language><?php echo get_option('rss_language'); ?></language>
<?php do_action('rss2_head'); ?>
<?php if ($posts) { foreach ($posts as $post) { switch_to_blog($post->blogid); start_wp(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php permalink_single_rss() ?></link>
		<comments><?php comments_link(); ?></comments>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<dc:creator><?php the_author() ?></dc:creator>
		<?php the_category_rss() ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if ($this->excerpt) : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
	<?php if ( strlen( $post->post_content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php the_content('', 0, '') ?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
		<wfw:commentRss><?php comments_rss() ?></wfw:commentRss>
<?php rss_enclosure(); ?>
	<?php do_action('rss2_item'); ?>
	</item>
<?php restore_current_blog(); } } ?>
<?php if ($comments) { foreach ($comments as $comment) { switch_to_blog($comment->blogid); get_post_custom($comment->comment_post_ID); ?>
	<item>
		<title>by: <?php comment_author_rss() ?></title>
		<link><?php comment_link() ?></link>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_comment_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<guid><?php comment_link() ?></guid>
<?php if (!empty($comment->post_password) && $_COOKIE['wp-postpass'] != $comment->post_password) { ?>
		<description>Protected Comments: Please enter your password to view comments.</description>
		<content:encoded><![CDATA[<?php echo get_the_password_form() ?>]]></content:encoded>
<?php } else { ?>
		<description><?php comment_text_rss() ?></description>
		<content:encoded><![CDATA[<?php comment_text() ?>]]></content:encoded>
<?php } // close check for password ?>
	</item>
<?php restore_current_blog(); } } ?>
</channel>
</rss>
<?php
		$feed = ob_get_contents();
		ob_end_clean();
		return $feed;
	}

*/

	function config_page() {
		global $updated, $configerror;
		get_currentuserinfo();
		if (!is_site_admin()) die(__('<p>You do not have permission to access this page.</p>'));
		if ($_POST['action'] == 'update') {
			if ($_POST['reset'] != 1) $this->save_settings();
			else $this->delete_settings();
		}
		if ($updated) { ?>
<div id="message" class="updated fade"><p><?php _e('Options saved.') ?></p></div>
<?php	} elseif (is_array($configerror)) { ?>
<div class="error"><p><?php echo implode('<br />',$configerror); ?></p></div>
<?php	} ?>
<div class="wrap">
<h2>Sitewide Feed Options</h2>
<fieldset class="options">
<p>This plugin creates three (3) seperate RSS 2.0 feeds from posts, comments, and pages across all blogs on your WPMU powered site. (version: <?php echo $this->version; ?>) (<a href="http://www.itdamager.com/plugins/wpmu-sitewide-feed/" target="_blank">Plugin Homepage</a> | <a href="http://www.itdamager.com/plugins/wpmu-sitewide-feed/sitewide-feed-help/" target="_blank">Help</a>)</p>
<?php if (!$this->check_cache()) { ?>
<p style="color:#CC0000;font-weight:bold;">NOTE: Your WPMU is not using <a href="http://ryan.wordpress.com/2005/11/14/persistent-object-cache/" target="_blank">WP Object Cache</a>. Performance will be degraded and site load increased. Please use the object cache for maximum performance.</p>
<?php } elseif (!$this->cache) { ?>
<p style="color:#CC0000;font-weight:bold;">NOTE: You have disabled usage of the <a href="http://ryan.wordpress.com/2005/11/14/persistent-object-cache/" target="_blank">WP Object Cache</a> for this plugin. Performance will be degraded and site load increased. Please use the object cache for maximum performance.</p>
<?php } ?>
<form name="sitefeedform" action="" method="post">
<table width="100%" cellspacing="2" cellpadding="5" class="editform">
  <tr valign="top">
    <th scope="row"><?php _e('Trigger Blog ID:') ?>
    </th>
    <td><input name="triggerblog" type="text" id="triggerblog" value="<?php echo $this->triggerblog; ?>" size="3" /></td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Feed URL (relative path):') ?>
    </th>
    <td><input name="triggerurl" type="text" id="triggerurl" value="<?php echo $this->triggerurl; ?>" size="25" />
    (<?php echo $this->create_testlink('posts'); ?>)</td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Comments Feed URL (appended to Feed URL):') ?>
    </th>
    <td><input name="commentsurl" type="text" id="commentsurl" value="<?php echo $this->commentsurl; ?>" size="25" />
    (<?php echo $this->create_testlink('comments'); ?>)</td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Pages Feed URL (appended to Feed URL):') ?>
    </th>
    <td><input name="pagesurl" type="text" id="pagesurl" value="<?php echo $this->pagesurl; ?>" size="25" />
    (<?php echo $this->create_testlink('pages'); ?>)</td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Feed Title:') ?>
    </th>
    <td><input name="feedtitle" type="text" id="feedtitle" value="<?php echo $this->feedtitle; ?>" size="60" /></td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Feed Description:') ?>
    </th>
    <td><input name="feeddesc" type="text" id="feeddesc" value="<?php echo $this->feeddesc; ?>" size="60" /></td>
  </tr>
  <tr valign="top">
    <th width="33%" scope="row"><?php _e('Show the most recent:') ?></th>
    <td><input name="feedcount" type="text" id="feedcount" value="<?php echo $this->feedcount; ?>" size="3" /> <?php _e('posts') ?></td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('For each article, show:') ?>
    </th>
    <td><label>
      <input name="excerpt"  type="radio" value="0" <?php checked(0, $this->excerpt); ?>  />
      <?php _e('Full text') ?>
      </label>
        <br />
        <label>
        <input name="excerpt" type="radio" value="1" <?php checked(1, $this->excerpt); ?> />
        <?php _e('Summary') ?>
        </label>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Untitled post title:') ?>
    </th>
    <td><input name="untitled" type="text" id="untitled" value="<?php echo $this->untitled; ?>" size="25" /></td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Append stats to feed:') ?>
    </th>
    <td><label>
      <input name="showstats"  type="checkbox" id="showstats" value="1" <?php checked(1, $this->showstats); ?>  />
      </label>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Use ETag header:') ?>
    </th>
    <td><label>
      <input name="etag"  type="checkbox" id="etag" value="1" <?php checked(1, $this->etag); ?>  />
      </label>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Use Object Cache:') ?>
    </th>
    <td><label>
      <input name="cache"  type="checkbox" id="cache" value="1" <?php checked(1, $this->cache); ?>  />
      </label>
    </td>
  </tr>
  <tr valign="top">
    <th width="33%" scope="row"><?php _e('Expire feed from cache after:') ?></th>
    <td><input name="expiretime" type="text" id="expiretime" value="<?php echo $this->expiretime; ?>" size="3" />
    <?php _e('minutes') ?></td>
  </tr>
  <tr valign="top">
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <th scope="row"><?php _e('Reset all settings to default:') ?>
    </th>
    <td><label>
      <input name="reset" type="checkbox" value="1" />
      </label>
    </td>
  </tr>
</table>
<p class="submit">
<input type="hidden" name="action" value="update" />
<input type="submit" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
</p>
</form>
</fieldset>
</div>
<?php
	}
}

//all your posts, comments, pages, and base are belong to us!
if (defined('ABSPATH')) $wpmu_sitefeed = new wpmu_sitefeed();

?>
