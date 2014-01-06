<?php
namespace Ranyuen;

/**
 * Helper methods using in the view.
 */
class Helper
{
    /**
     * Escape all HTML5 special charactors.
     *
     * @param string $str
     */
    public function h($str)
    {
        echo htmlspecialchars($str,
            ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5,
            'utf-8');
    }

    /**
     * @param array $nav
     */
    public function echoNav($nav, $base = '/')
    {
        echo '<ul>';
        foreach ($nav as $href => $title) {
            echo '<li><a href="';
            $this->h(preg_replace('/\/\//', '/', $base . $href));
            echo '">';
            $this->h($title);
            echo '</a></li>';
        }
        echo '</ul>';
    }

    public function echoBreadcrumb($breadcrumb)
    {
        echo '<div class="breadcrumb"><a href="">Home</a> &gt; category</div>'; // FIXME: Write the logic.
    }

    /**
     * Generate pager links.
     *
     * @param  integer $page
     * @param  integer $page_count
     * @param  string  $base_url
     * @return string
     */
    public function genPagerLink($page, $page_count, $base_url)
    {
        $has_base_url_query = isset(parse_url($base_url)['query']);
        $build_item = function ($page, $text_content, $class_list = []) use ($base_url, $has_base_url_query) {
            if ($page === null) {
                $class_list = 'pageritem disabled ' . implode($class_list, ' ');
                $url = '#';
            } else {
                $class_list = 'pageritem ' . implode($class_list, ' ');
                $url = $base_url . ($has_base_url_query ? '&' : '?') . 'page=' . $page;
            }

            return '<li class="' . $class_list . '"><a href="' . $url . '">' . $text_content . '</a></li>';
        };
        $items[] = $build_item(0, '&laquo;', ['pagerstart']);
        $items[] = $build_item($page === 0 ? null : $page - 1, '&lt;', ['pagerprev']);
        $items[] = $build_item(null, $page + 1, ['pagercurrent']);
        $items[] = $build_item($page >= $page_count - 1 ? null : $page + 1, '&gt;', ['pagernext']);
        $items[] = $build_item($page_count - 1, '&raquo;', ['pagerend']);

        return '<ul class="pagination">' . implode($items, "\n") . '</ul>';
    }

    /**
     * @param string $template
     * @param array  $params
     */
    public function render($template, $params)
    {
        $config = (new Config)->load();
        echo (new Renderer($config))
            ->renderTemplate($template, $params);
    }
}
