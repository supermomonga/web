<?php
namespace Ranyuen;

use \Symfony\Component\Yaml\Yaml;

class Config
{
    private static $config = null;

    /**
     * @param  string $filepath
     * @return array
     */
    public function load($filepath = '')
    {
        if ($filepath && is_readable($filepath))
            self::$config = Yaml::parse(file_get_contents($filepath));

        return self::$config;
    }
}
