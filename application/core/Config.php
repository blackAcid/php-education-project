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
        self::$config = parse_ini_file('config.ini', true);
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
            }
        }
}

