<?php
namespace Ranyuen;

use \Symfony\Component\Yaml\Yaml;

class Navigation
{
    private $nav;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->nav = Yaml::parse(file_get_contents("{$config['templates.path']}/nav.json"));
    }

    /**
     * @param  string $lang
     * @return array
     */
    public function getGlobalNav($lang)
    {
        return $this->gather($this->nav[$lang]);
    }

    /**
     * @param  string $lang
     * @return array
     */
    public function getNews($lang)
    {
        $news = isset($this->nav[$lang]['news']) ?
            $this->nav[$lang]['news'] :
            [];
        unset($news['index']);

        return $news;
    }

    /**
     * @param  string $lang
     * @param  string $template_name
     * @return array
     */
    public function getLocalNav($lang, $template_name)
    {
        $template_name = explode('/', $template_name);
        $nav = $this->nav[$lang];
        foreach ($template_name as $part) {
            if ($part && $part !== 'index') {
                if (!(isset($nav[$part]) && is_array($nav[$part]))) { break; }
                $nav = $nav[$part];
            }
        }

        return $this->gather($nav);
    }

    private function gather($nav)
    {
        $index = [];
        $local = [];
        $sub = [];
        foreach ($nav as $href => $title) {
            if (is_string($title)) {
                if ($href === 'index') {
                    $index['/'] = $title;
                } else {
                    $local[$href] = $title;
                }
            } else {
                $sub["$href/"] = isset($nav[$href]['index']) ?
                    $nav[$href]['index'] :
                    null;
            }
        }
        $local = array_merge($index, $local);
        $local = array_merge($local, $sub);

        return $local;
    }
}
