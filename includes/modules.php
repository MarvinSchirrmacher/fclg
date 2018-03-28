<?php
class FcOnlineModules
{
    private static function onlyOnePageExists($wp_query)
    {
        return $wp_query->max_num_pages <= 1;
    }

    private static function getPageLinks($paged, $max)
    {
        if ($paged >= 1) {
            $links[] = $paged;
        }

        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (($paged + 2) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }
        return $links;
    }

    public static function buildHtmlList($paged, $max, $links)
    {
        $output = '<ul class="paging-nav">';

        if (get_previous_posts_link()) {
            $output .= sprintf('<li>%s</li>', get_previous_posts_link());
        }

        /** Link to first page, plus ellipses if necessary */
        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';

            $output .= sprintf(
                '<li%s><a href="%s">%s</a></li>',
                $class, esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links)) {
                $output .= '<li>…</li>';
            }

        }

        /** Link to current page, plus 2 pages in either direction if necessary */
        sort($links);
        foreach ((array) $links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            $output .= sprintf(
                '<li%s><a href="%s">%s</a></li>',
                $class, esc_url(get_pagenum_link($link)), $link);
        }

        /** Link to last page, plus ellipses if necessary */
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                $output .= '<li>…</li>';
            }

            $class = $paged == $max ? ' class="active"' : '';
            $output .= sprintf(
                '<li%s><a href="%s">%s</a></li>',
                $class, esc_url(get_pagenum_link($max)), $max);
        }

        /** Next Post Link */
        if (get_next_posts_link()) {
            $output .= sprintf('<li>%s</li>', get_next_posts_link());
        }

        $output .= '</ul>';
        return $output;
    }

    public static function pageNavigation()
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;

        if (self::onlyOnePageExists($wp_query)) {
            return;
        }

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);

        $links = self::getPageLinks($paged, $max);
        echo self::buildHtmlList($paged, $max, $links);
    }
}
