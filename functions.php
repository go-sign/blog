<?php
/**
 * Gosign functions and definitions
 *
 * @package WordPress
 * @subpackage Gosign
 * @since Gosign 1.0
 */

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' ); 

/**
 * Enqueue scripts and styles.
 */
function gs_scripts() {
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Montserrat:700' );
    wp_enqueue_style( 'gosign-site', get_template_directory_uri() . '/site.css' );
    wp_enqueue_style( 'gosign-style', get_stylesheet_uri() );
    wp_enqueue_script( 'gosign-bundle', get_template_directory_uri() . '/bundle.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'gs_scripts' );

/**
 * Pankuzu
 */
function gs_breadcrumb(){
    global $post;
    $str = '';
    if ( !is_home() && !is_admin() ) {
        $str .= '<nav class="breadcrumb" aria-label="breadcrumbs">';
        $str .= '<ul>';
        $str .= '<li><a href="' . home_url() . '"><span class="icon is-small"><i class="fa fa-bars"></i></span><span>Index</a></li>';

        if ( is_search() ) {
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-folder" aria-hidden="true"></i></span><span>' . get_search_query() . '</span></a></li>';
        } elseif ( is_tag() ) {
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-tag" aria-hidden="true"></i></span><span>' . single_tag_title( '', false ) . '</span></a></li>';
        } elseif ( is_404() ) {
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-folder" aria-hidden="true"></i></span><span>404 Not found</span></a></li>';
        } elseif ( is_category() ) {
            $cat = get_queried_object();
            if( $cat->parent != 0 ) {
                $ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
                foreach ( $ancestors as $ancestor ) {
                    $str .= '<li><a href="' . get_category_link( $ancestor ) . '"><span class="icon is-small"><i class="fa fa-folder"></i></span><span>' . get_cat_name( $ancestor ) . '</span></a></li>';
                }
            }
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-folder" aria-hidden="true"></i></span><span>' . $cat->name . '</span></a></li>';
        } elseif ( is_page() ) {
            if ( $post->post_parent != 0 ) {
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                foreach ( $ancestors as $ancestor ) {
                    $str .= '<li><a href="' . get_category_link( $ancestor ) . '"><span class="icon is-small"><i class="fa fa-folder"></i></span><span>' . get_cat_name( $ancestor ) . '</span></a></li>';
                }
            }
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-book" aria-hidden="true"></i></span><span>' . $post->post_title . '</span></a></li>';

        } elseif ( is_single() ) {
            $categories = get_the_category( $post->ID );
            $cat = $categories[0];
            if ( $cat->parent != 0 ) {
                $ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
                foreach ( $ancestors as $ancestor ) {
                    $str .= '<li><a href="' . get_category_link( $ancestor ) . '"><span class="icon is-small"><i class="fa fa-folder"></i></span><span>' . get_cat_name( $ancestor ) . '</span></a></li>';
                }
            }
            $str .= '<li><a href="' . get_category_link( $cat->term_id ) . '"><span class="icon is-small"><i class="fa fa-folder"></i></span><span>' . $cat->cat_name . '</a></li>';
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-book" aria-hidden="true"></i></span><span>' . $post->post_title . '</span></a></li>';
        } else {
            $str .= '<li class="is-active"><a href="#" aria-current="page"><span class="icon is-small"><i class="fa fa-book" aria-hidden="true"></i></span><span>' . wp_title( '', false ) . '</span></a></li>';
        }
        $str .= '</ul>';
        $str .= '</nav>';
    }
    echo $str;
}

/**
 * Pankuzu
 */
function gs_pagenate(){
    $str = '';
    $str .= '<nav>';
    $links = paginate_links( array(
        'prev_text' => '前へ',
        'type' => 'array',
        'next_text' => '次へ',
    ));
    if ( $links ) {
        // prev
        foreach ( $links as $link ) {
            if ( strpos( $link, 'prev' ) !== false ) {
                $str .= str_replace( 'page-numbers', 'pagination-previous', $link );
                break;
            }
        }
        // pages
        foreach ( $links as $link ) {
            if ( strpos( $link, 'prev' ) === false && strpos( $link, 'next' ) === false ) {
                $str .= str_replace( 'page-numbers', 'pagination-next', $link );
            }
        }
        // next
        foreach ( $links as $link ) {
            if ( strpos( $link, 'next' ) !== false ) {
                $str .= str_replace( 'page-numbers', 'pagination-next', $link );
                break;
            }
        }
    }
    $str .= '</nav>';
    echo $str;
}
