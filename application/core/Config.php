<?php
class Config
{
    private static $config;
    private static $section;

    public static function getConfig()
    {
        if (!self::$config) {
            self::parseConfig();
        }
        return self::$config;
    }

    private static function parseConfig()
    {
        $match = glob(DIR_CORE . '*.ini');
        if (is_array($match)) {
            $ConfigName = $match[0];
        }
        self::$config = parse_ini_file($ConfigName, true);
    }

    public static function getSection($section)
    {

        if (!self::$config) {
            self::parseConfig();
        }

        if (isset(self::$config[$section])) {
            return self::$config[$section];
        } else {
            return null;
        }

    }

    public static function getProperty($section, $property)
    {
        if (!self::$config) {
            self::parseConfig();
        }
        self::$section = self::getSection($section);
        if (isset(self::$section[$property])) {
            return self::$section[$property];
        } else {
            return null;
        }
    }
}
