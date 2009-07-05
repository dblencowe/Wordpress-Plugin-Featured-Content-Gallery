<?php
/*
Plugin Name: Featured Content Gallery 2
Plugin URI: http://www.spacewebdesign.co.uk
Description: Used to create a customizable rotating image gallery anywhere within your WordPress site.
Version: 1.0.0
Author: John Hamelink
Author URI: http://spacewebdesign.co.uk
*/
/*  Copyright 2009  John Hamelink  (email : john@spacewebdesign.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*********************************************************\
 Based on the work of iePlexus (email : info@ieplexus.com)
\*********************************************************/

/* options page */
$options_page = get_option('siteurl') . '/wp-admin/admin.php?page=featured-content-gallery2/options.php';
/* Adds our admin options under "Options" */
function gallery_options_page() {
	add_options_page('Featured Content Gallery 2 Options', 'Featured Content Gallery 2', 10, 'featured-content-gallery2/options.php');
}

function gallery_styles() {
    /* The next lines figures out where the javascripts and images and CSS are installed,
    relative to your wordpress server's root: */
    $gallery_path =  get_bloginfo('wpurl')."/wp-content/plugins/featured-content-gallery2/";

    /* The xhtml header code needed for gallery to work: */
	$jquery = get_option('gallery-jquery');
	if($jquery !== 'on'){ $galleryscript .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>'; }
	$galleryscript .= "
	<!-- begin gallery scripts -->
    <link rel=\"stylesheet\" href=\"".$gallery_path."css/featured-content-gallery2.big.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\"/>
	<script type=\"text/javascript\" src=\"".$gallery_path."scripts/slider.big.js\"></script>
	<script type=\"text/javascript\" src=\"".$gallery_path."scripts/jquery.timers.js\"></script>
	<!-- end gallery scripts -->\n";
	/* Output $galleryscript as text for our web pages: */
	echo($galleryscript);
}

function get_a_post($id='GETPOST') {
	global $post, $tableposts, $tablepostmeta, $wp_version, $wpdb;

	if($wp_version < 1.5)
		$table = $tableposts;
	else
		$table = $wpdb->posts;

	$now = current_time('mysql');
	$name_or_id = '';
	$orderby = 'post_date';

	if( !$id || 'GETPOST' == $id || 'GETRANDOM' == $id ) {
		if( $wp_version < 2.1 )
			$query_suffix = "post_status = 'publish'";
		else
			$query_suffix = "post_type = 'post' AND post_status = 'publish'";
	} elseif('GETPAGE' == $id) {
		if($wp_version < 2.1)
			$query_suffix = "post_status = 'static'";
		else
			$query_suffix = "post_type = 'page' AND post_status = 'publish'";
	} elseif('GETSTICKY' == $id) {
		if($wp_version < 1.5)
			$table .= ', ' . $tablepostmeta;
		else
			$table .= ', ' . $wpdb->postmeta;
		$query_suffix = "ID = post_id AND meta_key = 'sticky' AND meta_value = 1";
	} else {
		$query_suffix = "(post_status = 'publish' OR post_status = 'static')";

		if(is_numeric($id)) {
			$name_or_id = "ID = '$id' AND";
		} else {
			$name_or_id = "post_name = '$id' AND";
		}
	}

	if('GETRANDOM' == $id)
		$orderby = 'RAND()';

	$post = $wpdb->get_row("SELECT * FROM $table WHERE $name_or_id post_date <= '$now' AND $query_suffix ORDER BY $orderby DESC LIMIT 1");
	get_post_custom($post->ID);

	if($wp_version < 1.5)
		start_wp();
	else
		setup_postdata($post);
}

function  gallery_slice_content($post_content, $limit = 255)
{
    	$string = strip_tags($post_content);
		$break = " ";
		$pad = "...";

		if(strlen($string) >= $limit)
		{
			$breakpoint = strpos($string, $break, $limit);
			return substr($string, 0, $breakpoint) . $pad;
		}
		else
		{
			return $string;
		}
}

/* we want to add the above xhtml to the header of our pages: */
add_action('wp_head', 'gallery_styles');
add_action('admin_menu', 'gallery_options_page');
?>
