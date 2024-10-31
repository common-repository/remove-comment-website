<?php
/**
 * Plugin Name:         Remove comment website
 * Plugin URI:          http://wordpress.org/extend/plugins/remove-comment-website/
 * Description:         Remove website from comments.
 * Version:             1.0.2
 * Requires PHP:        7.2
 * Requires at least:   5.0
 * Author:              myluoluo
 * Author URI:          https://www.myluoluo.com
 * License:             GPLv2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 */
namespace myluoluo;
defined('ABSPATH') or die();

class Remove_Comment_Website {
    // Remove website from comment form.
    public static function website_remove_hook($fields) {
        if(isset($fields['url']))
        unset($fields['url']);
        return $fields;
    }

    // Remove website from comments list.
    public static function remove_comment_author_url_hook($comments) {
        foreach ($comments as $comment) {
            $comment->comment_author_url = '';
        }
        return $comments;
    }

    public static function add_hooks() {
        add_filter('comment_form_default_fields', array(__CLASS__, 'website_remove_hook'));
        add_filter('comments_array', array(__CLASS__, 'remove_comment_author_url_hook'));
    }
}

Remove_Comment_Website::add_hooks();
