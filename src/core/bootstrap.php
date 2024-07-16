
<?php
require base_path("/src/core/Container.php");
require base_path("/src/core/Database.php");

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

$db = $container->resolve('db');
