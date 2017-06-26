<?php
/**
 * WordPress Breadcrumb Utilities
 * to support BEM class namings
 * conventions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class NID_Crumbs
 *
 */
class NID_Crumbs
{


    /**
     * 一番下の階層のカテゴリーを返す
     */
    public static function get_youngest_cat($categories)
    {
        global $post;
        if (count( $categories ) === 1) {
            $youngest = $categories[0];
        } else {
            $count = 0;
            foreach ($categories as $category) {
                $children = get_term_children( $category->term_id, 'category' );
                if ($children) {
                    if ($count < count( $children )) {
                        $count = count( $children );
                        $lot_children = $children;
                        foreach ($lot_children as $child) {
                            if (in_category( $child, $post->ID )) {
                                $youngest = get_category( $child );
                            }
                        }
                    }
                } else {
                    $youngest = $category;
                }
            }
        }
        return $youngest;
    }

     /**
     * 一番下のタクソノミーを返す関数
     */
    public static function get_youngest_tax($taxes, $mytaxonomy)
    {
        global $post;
        if (count( $taxes ) === 1) {
            $youngest - $taxes[key( $taxes ) ];
        } else {
            $count = 0;
            foreach ($taxes as $tax) {
                $children = get_term_children( $tax->term_id, $mytaxonomy );
                if ($children) {
                    if ($count < count( $children )) {
                        $count = count( $children );
                        $lot_children = $children;
                        foreach ($lot_children as $child) {
                            if (is_object_in_term( $post->ID, $mytaxonomy )) {
                                $youngest = get_term( $child, $mytaxonomy );
                            }
                        }
                    }
                } else {
                    $youngest = $tax;
                }
            }
        }
        return $youngest;
    }

    /**
     * パンくずリスト
     */
    public static function breadcrumbs($arg = array())
    {
        global $post;
        $defaults = array(
            'menu_class' => 'breadcrumbs',
            'home' => 'トップページ',
            'search' => 'で検索した結果',
            'tag' => 'タグ',
            'notfound' => 'ページがありません！',
            'ul_option' => 'itemscope itemtype="http://schema.org/BreadcrumbList"',
            'li_option' => 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"',
            'a_option' => 'itemprop="item"',
            'span_option' => 'itemprop="name"',
            'meta_option' => 'itemprop="position"'
        );
        $args = wp_parse_args( $args, $defaults );
        extract( $args, EXTR_SKIP );
        if (! is_front_page() && ! is_admin()) {
            $str .= '<nav aria-label="あなたは今ここにいます！" role="navigation">';
            $str .= "<ul class=\"$menu_class\" $ul_options>";
            $str .= "<li $li_optioin>";
            $str .= "<a href=\"" . home_url() . "\" $a_option>";
            $str .= "<span $span_option>$home</span>";
            $str .= "<meta $meta_option content=\"1\">";
            $str .= '</a></li>';

            // カテゴリー -> Archive
            if (is_archive() || is_home()) {
                $str .= "<li $li_option><a href=\"" . get_page_link( get_page_by_path( 'blog' ) ) . "\" $a_option><span $span_option>" . get_the_title( get_page_by_path( 'blog' ) ) . "</span><meta $meta_option content=\"2\"></a></li>";
                
                if (is_category()) {
                    $cat = get_queried_object();
                    $count = 3;
                    if ($cat->parent !== 0) {
                        $ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
                        $ancestor_Num = count( $ancestors );
                        $count = $ancestor_Num + 2;
                        while ($count < $ancestor_Num + 3) {
                            $str .= "<li $li_option><a href=\"" . get_category_link( $ancestors[$count - 3] ) . "\" $a_option><span $span_option>" . get_cat_name( $ancestors[$count - 3] ) . "</span><meta $meta_option content=\"$count\"></a></li>";
                            $count++;
                        }
                    }
                    $str .= "<li class=\"current\" $li_option><span $span_option>" . $cat->name . "</span><meta $meta_option content=\"$count\"></li>";
                } elseif (is_date()) {
                    if (get_query_var( 'day' ) !== 0) {
                        $str .= "<li $li_option><a href=\"" . get_year_link( get_query_var( 'year' ) ) . "\" $a_option><span $span_option>" . get_query_var( 'year' ) . "年</span><meta $meta_option content=\"3\"></a></li>"
                    }
                }
            }
        }
    }
}
