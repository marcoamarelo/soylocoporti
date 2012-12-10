<?php
/**
 * Plugin Name: Plugin Global do Soylocoporti
 * Plugin URI: http://soylocoporti.org.br/
 * Description: Plugin que aplica configurações por todo o site.
 * Version: 0.01
 * Author: Soylocoporti
 * Author URI: http://soylocoporti.org.br/
 */

global $blog_id;

if ($blog_id == 1) {
    include (ABSPATH.PLUGINDIR.'/soyloco/soyloco-sitewide-feed.php');
}
include (ABSPATH.PLUGINDIR.'/soyloco/soyloco-hooks.php');



?>
