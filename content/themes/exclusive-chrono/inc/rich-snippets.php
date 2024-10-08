<?php
/**
 * Rich Snippets - Schema.org
 *
 * @package wbase
 */

function html_tag_schema() {
    $schema = 'http://schema.org/';

    
    if(is_single()) :
        $type = "Article";              // Is single post
    elseif( is_page(1) ) :
        $type = 'ContactPage';          // Contact form page ID
    elseif( is_author() ) :
        $type = 'ProfilePage';          // Is author page
    elseif( is_search() ) :
        $type = 'SearchResultsPage';    // Is search results page
    elseif(is_singular('movies')) :
        $type = 'Movie';                // Is of movie post type
    elseif(is_singular('books')) :
        $type = 'Book';                 // Is of book post type
    else :
        $type = 'WebPage';
    endif;

    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}