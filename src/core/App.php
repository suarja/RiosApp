<?php

require_once base_path("/src/core/Container.php");
require_once base_path("/src/core/Database.php");
class App
{
    public static function setContainer()
    {
        $container = new Container();
        $container->bind('db', function () {
            require base_path("/config.php");
            return new Database(
                $DB_CONFIG
            );
        });
        $container->bind('PUBG_API_KEY', function () {
            require base_path("/config.php");
            return $PUBG_API_KEY;
        });
        return $container;
    }
    public static function resolve($key)
    {
        $container = self::setContainer();
        return $container->resolve($key);
    }
}
