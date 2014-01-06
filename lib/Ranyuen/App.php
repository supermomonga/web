<?php
namespace Ranyuen;

use \Slim;
use \Symfony\Component\Yaml\Yaml;

/**
 * Quick start
 * ===========
 * ```php
 * (new \Ranyuen\App([]))->run();
 * ```
 */
class App
{
    /** @type \Slim\Slim */
    public $app;

    /** @type \Ranyuen\Logger */
    public $logger;

    private $config;

    /**
     * @param string|array $config
     */
    public function __construct($config = [])
    {
        $env = 'development';
        if (isset($_ENV['SERVER_ENV'])) {
            $env = $_ENV['SERVER_ENV'];
        }
        if (is_string($config)) {
            $env = $config;
            $config = (new Config)->load("config/$config.yaml");
        }
        $this->config = $this->setDefaultConfig($config, $env);
        $this->app = new Slim\Slim;
        $this->app->config($this->config);
        $this->setDefaultRouteConditions($this->config);
        $this->applyDefaultRoutes($this->app);
        $this->logger = new Logger($this->config['mode'], $this->config);
    }

    /**
     * @return App
     */
    public function run()
    {
        $this->app->run();

        return $this;
    }

    /**
     * @param  string $lang
     * @param  string $template_name
     * @param  array  $params
     * @return App
     */
    public function render($lang, $template_name, $params = [])
    {
        $renderer = new Renderer($this->config);
        if (isset($this->config['lang'][$lang])) {
            $lang = $this->config['lang'][$lang];
        }
        $params['lang'] = $lang;
        foreach ($this->getNav($lang, $template_name) as $name => $nav) {
            $params["${name}_nav"] = $nav;
        }
        echo $renderer
            ->setLayout($this->config['layout'])
            ->render("$template_name.$lang", $params);

        return $this;
    }

    /**
     * @param  array  $config
     * @param  string $env
     * @return array
     */
    private function setDefaultConfig($config, $env)
    {
        $set_default = function (&$array, $key, $dafault) {
            if (! isset($array[$key])) { $array[$key] = $dafault; }
        };

        // Configuration for Ranyuen App.
        $set_default($config, 'lang', []);
        $set_default($config['lang'], 'default', 'en');
        $set_default($config, 'layout', 'layout');
        $set_default($config, 'log.path', 'logs');

        // Configuration for Slim Framwork.
        $set_default($config, 'debug', true);
        $set_default($config, 'log.enabled', false);
        $set_default($config, 'log.level', \Slim\LOG::INFO);
        $set_default($config, 'mode', $env);
        $set_default($config, 'templates.path', 'templates');

        return $config;
    }

    /**
     * @param array $config
     */
    private function setDefaultRouteConditions($config)
    {
        $langs = [];
        $dir = $config['templates.path'];
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (is_dir($dir . $file)) { $langs[] = $file; }
            }
        }
        $langs = array_unique(array_merge($langs, array_keys($config['lang'])));
        $lang_regex = implode('|', $langs);
        Slim\Route::setDefaultConditions([
            'lang' => $lang_regex
        ]);
    }

    /**
     * @param \Slim\Slim
     */
    private function applyDefaultRoutes($app)
    {
        $controller = function ($lang, $path) {
            $this->render($lang, $path);
            $this->logger->addAccessInfo();
        };
        $app->get('/:lang/', function ($lang) use ($controller) {
            $controller($lang, '/index');
        });
        $app->get('/', function () use ($controller) {
            $controller('default', '/index');
        });
        $app->get('/:lang/:path+', function ($lang, $path) use ($controller) {
            if ($path[count($path) - 1] === '') {
                $path[count($path) - 1] = 'index';
            }
            $path = implode('/', $path);
            $controller($lang, $path);
        });
        $app->get('/:path+', function ($path) use ($controller) {
            if ($path[count($path) - 1] === '') {
                $path[count($path) - 1] = 'index';
            }
            $path = implode('/', $path);
            $controller('default', $path);
        });
    }

    /**
     * Get list of navigations.
     *
     * @param  string $lang
     * @param  string $template_name
     * @return array  [ 'global' => array $global_nav,
     *                              'news'   => array $news_nav,
     *                              'local'  => array $local_nav ]
     */
    private function getNav($lang, $template_name)
    {
        $gather = function ($navs) {
            $index = [];
            $local = [];
            $sub = [];
            foreach ($navs as $href => $title) {
                if (is_string($title)) {
                    if ($href === 'index') {
                        $index['/'] = $title;
                    } else {
                        $local[$href] = $title;
                    }
                } else {
                    $sub["$href/"] = isset($navs[$href]['index']) ?
                        $navs[$href]['index'] :
                        null;
                }
            }
            $local = array_merge($index, $local);
            $local = array_merge($local, $sub);

            return $local;
        };
        $navs = Yaml::parse(file_get_contents(
            "{$this->config['templates.path']}/nav.json"))[$lang];
        $global = $gather($navs);
        $news = isset($navs['news']) ? $navs['news'] : [];
        unset($news['index']);
        $template_name = explode('/', $template_name);
        foreach ($template_name as $part) {
            if ($part && $part !== 'index') {
                if (!(isset($navs[$part]) && is_array($navs[$part]))) { break; }
                $navs = $navs[$part];
            }
        }
        $local = $gather($navs);

        return [
            'global' => $global,
            'news'   => $news,
            'local'  => $local
        ];
    }
}
