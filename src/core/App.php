<?php

class App
{
    public static function setContainer()
    {
        require_once base_path("/src/core/Container.php");

        $container = new Container();
        $container->bind('db', function () {
            require_once base_path("/src/core/Database.php");
            
            // Charger la configuration directement
            $isProd = getenv('RAILWAY_ENVIRONMENT_NAME') !== false || getenv('KUBERNETES_SERVICE_HOST') !== false;
            
            if ($isProd) {
                $DB_HOST = getenv('DB_HOST');
                $DB_PORT = getenv('DB_PORT');
                $DB_NAME = getenv('DB_NAME');
                $DB_USER = getenv('DB_USER');
                $DB_PASSWORD = getenv('DB_PASSWORD');
            } else {
                require_once base_path("/vendor/autoload.php");
                $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
                $dotenv->safeLoad();
                
                $DB_HOST = $_SERVER['DB_HOST'] ?? null;
                $DB_PORT = $_SERVER['DB_PORT'] ?? null;
                $DB_NAME = $_SERVER['DB_NAME'] ?? null;
                $DB_USER = $_SERVER['DB_USER'] ?? null;
                $DB_PASSWORD = $_SERVER['DB_PASSWORD'] ?? null;
            }
            
            $dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
            $DB_CONFIG = [
                'dsn' => $dsn,
                'user' => $DB_USER,
                'password' => $DB_PASSWORD
            ];
            
            return new Database($DB_CONFIG);
        });
        
        $container->bind('PUBG_API_KEY', function () {
            $isProd = getenv('RAILWAY_ENVIRONMENT_NAME') !== false || getenv('KUBERNETES_SERVICE_HOST') !== false;
            
            if ($isProd) {
                return getenv('PUBG_API_KEY');
            } else {
                require_once base_path("/vendor/autoload.php");
                $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
                $dotenv->safeLoad();
                
                return $_SERVER['PUBG_API_KEY'] ?? null;
            }
        });
        return $container;
    }
    public static function resolve($key)
    {
        $container = self::setContainer();
        return $container->resolve($key);
    }
}
