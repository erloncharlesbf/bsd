<?php

/**
 * Resume Posts
 *
 * @param int $words
 * @param int $idPost
 * @return string $content
 */
function _theme_resume_post(int $words = 40, int $idPost = 0): string
{
    $allowedTags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>';
    if ($idPost > 0) {
        $post = get_post($idPost);
    } else {
        global $post;
    }

    $text = preg_replace('/\[.*]/', '', strip_tags($post->post_content, $allowedTags));
    $text = explode(' ', $text);
    $tot = count($text);

    if ($tot < $words) {
        $words = $tot;
    }

    $output = '';
    for ($i = 0; $i < $words; $i++) {
        $output .= $text[$i] . ' ';
    }

    $content = force_balance_tags(rtrim($output));

    if ($i < $tot) {
        $content .= '...';
    }

    return $content;
}