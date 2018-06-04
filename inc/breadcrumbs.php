<?php
/* Display template for breadcrumbs. */
function bootstrap_breadcrumbs()
{
    $home      = __('<i class="fas fa-home"></i> Home', 'bootstrapwp'); // text for the 'Home' link
    $before    = '<span class="active">'; // tag before the current crumb
    $sep       = ' <i class="fas fa-angle-right"></i> ';
    $after     = '</span>'; // tag after the current crumb
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div class="breadcrumbs">';
        global $post;
        $homeLink = home_url();
            echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $sep;
            if (is_category()) {
                global $wp_query;
                $cat_obj   = $wp_query->get_queried_object();
                $thisCat   = $cat_obj->term_id;
                $thisCat   = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo get_category_parents($parentCat, true, $sep);
                }
                echo $before . __('Archive by category', 'bootstrapwp') . ' "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a> ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                    'F'
                ) . '</a> ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a> ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug      = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ';
                    echo $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo get_category_parents($cat, true, $sep);
                    echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat    = get_the_category($parent->ID);
                $cat    = $cat[0];
                echo get_category_parents($cat, true, $sep);
                echo '<a href="' . get_permalink(
                    $parent
                ) . '">' . $parent->post_title . '</a> ';
                echo $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id   = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page          = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title(
                        $page->ID
                    ) . '</a>' . $sep;
                    $parent_id     = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $crumb;
                }
                echo $before . get_the_title() . $after;
            } elseif (is_search()) {
                echo $before . __('Search results for', 'bootstrapwp') . ' "'. get_search_query() . '"' . $after;
            } elseif (is_tag()) {
                echo $before . __('Posts tagged', 'bootstrapwp') . ' "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Articles posted by', 'bootstrapwp') . ' ' . $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . __('Error 404', 'bootstrapwp') . $after;
            }
        echo '</div>';
    }
}