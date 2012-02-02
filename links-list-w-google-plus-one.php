<?php
/*
Plugin Name: Links List with Google +1 Button
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Provides a Wordpress shortcode allowing you to insert a list of links, optionally with a Google +1 button for each link.
Version: 0.1
Author: Sarah Vessels
Author URI: http://www.3till7.net/
License: GPL2
*/
/*  Copyright 2012  Sarah Vessels  (email : cheshire137@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode('plus-one-links', 'plusonelinks_shortcode');

$plusonelinks_url_key = '{url}';
$plusonelinks_name_key = '{name}';
$plusonelinks_desc_key = '{desc}';
$plusonelinks_plusone_key = '{plusone}';
$plusonelinks_default_tmpl = '<a href="' . $plusonelinks_url_key . '">' . $plusonelinks_name_key . '</a> - ' . $plusonelinks_desc_key . '<br/>' . $plusonelinks_plusone_key;
// Explicit script:
/*$plusonelinks_plusone_script = '<script type="text/javascript">' .
      '(function() {' .
        "var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;" .
        "po.src = 'https://apis.google.com/js/plusone.js';" .
        "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);" .
      '})();' .
      '</script>';*/
// On-load script:
$plusonelinks_plusone_script = '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';

function plusonelinks_plusone($url, $size, $annotation) {
    $sizeStr = 'data-size="small"';
    if ('standard' == $size) {
        $sizeStr = '';
    } else if ('medium' == $size) {
        $sizeStr = 'data-size="medium"';
    } else if ('tall' == $size) {
        $sizeStr = 'data-size="tall"';
    }

    $annotStr = 'data-annotation="inline"';
    if ('bubble' == $annotation) {
        $annotStr = '';
    } else if ('none' == $annotation) {
        $annotStr = 'data-annotation="none"';
    }

    return '<div class="g-plusone" ' . $sizeStr . ' ' . $annotStr . ' data-href="' . $url . '"></div>';
}

function plusonelinks_is_str_true($str) {
    $str = strtolower($str);
    return '' != $str && 'false' != $str && 'no' != $str && '0' != $str;
}

function plusonelinks_shortcode($atts, $content=NULL) {
    global $plusonelinks_default_tmpl, $plusonelinks_plusone_script,
        $plusonelinks_url_key, $plusonelinks_name_key, $plusonelinks_desc_key,
        $plusonelinks_plusone_key;
    extract(shortcode_atts(
        array(
            'before' => '<li class="link">',
            'after' => '</li>',
			'plusone' => '1',
			'orderby' => 'name', 
			'order' => 'ASC',
			'limit' => '-1', 
			'category' => null,
			'category_name' => null, 
			'hide_invisible' => 1,
            'show_updated' => 0,
			'include' => null,
			'exclude' => null,
            'search' => '.',
            'plusone_size' => 'small',
            'plusone_annotation' => 'inline',
            'include_plusone_script' => '1',
            'only_plusone_script' => ''
		), $atts
    ));
    if (plusonelinks_is_str_true($only_plusone_script)) {
        // Only output the Google script for displaying +1 buttons
        return $plusonelinks_plusone_script;
    }
    $links = get_bookmarks(array(
        'orderby' => $orderby, 
        'order' => $order,
        'limit' => $limit, 
        'category' => $category,
        'category_name' => $category_name, 
        'hide_invisible' => $hide_invisible,
        'show_updated' => $show_updated, 
        'include' => $include,
        'exclude' => $exclude,
        'search' => $search
    ));
    $output = '';
    if (plusonelinks_is_str_true($include_plusone_script)) {
        // Also output the Google script for displaying all +1 buttons
        $output .= $plusonelinks_plusone_script;
    }
    $template = (NULL == $content) ? $plusonelinks_default_tmpl : plusonelinks_clean($content);
    foreach ($links as $link) {
        $output .= plusonelinks_clean($before);
        $url = $link->link_url;
        $name = $link->link_name;
        $desc = $link->link_description;
        $plus_one = plusonelinks_plusone($url, $plusone_size, $plusone_annotation);
        $placeholders = array($plusonelinks_url_key, $plusonelinks_name_key,
            $plusonelinks_desc_key, $plusonelinks_plusone_key);
        $values = array($url, $name, $desc, $plus_one);
        $link_output = str_replace($placeholders, $values, $template);
        $output .= $link_output;
        $output .= plusonelinks_clean($after);
    }
    return $output;
}

function plusonelinks_clean($str) {
    return preg_replace('#^<\/p>|<p>|<br \/>|<br>|<br\/>$#', '', $str);
}
?>
