<?php
namespace App\Config;

class Config
{
    public static array $settings;

    public static function getSetting( $name, $default = NAN )
    {
        if( array_key_exists( $name, self::$settings ) )
        {
            return self::$settings[$name];
        }

        if( is_nan($default))
        {
            throw new \InvalidArgumentException( "requested setting '$name 'is not defined" );
        }

        return $default;
    }

    public static function hasSetting( $name )
    {
        return array_key_exists( $name, self::$settings );
    }
    
}
Config::$settings = require __DIR__ . '/Settings.php';
?>