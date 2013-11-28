<?php
class Config
{
    private static $config = array();
    private static $section;

    public static function getConfig()
    {
        if (!self::$config) {
            self::parseConfig();
        }
        return self::$config;
    }

    /*private static function parseConfig()
    {
        $match = glob(DIR_CORE . '*.ini');
        if (is_array($match)) {
            $ConfigName = $match[0];
        }
        self::$config = parse_ini_file($ConfigName, true);
    }*/

    public static function parseConfig()
    {
        $matches = glob(DIR_CORE . '*.ini');
        if (is_array($matches))
        {
            /*for($i = 0; count($matches) > $i; $i++ )
            {
                if($matches[$i])
                {
                    $configFile = parse_ini_file($matches[$i], true);
                    self::$config[$i] = $configFile;
                }
            }*/
            if (count($matches) > 1)
            {
                for($i = 1; count($matches) > $i; $i++ )
                {
                    $content = file_get_contents($matches[$i]);
                    $openIni = fopen($matches[0], 'a');
                    $finalIni = fwrite($openIni, $content);
                }
                fclose($openIni);
                self::$config = parse_ini_file($finalIni, true);
            } else {
                self::$config = parse_ini_file($matches[0], true);
            }
        }
        return self::$config;
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
