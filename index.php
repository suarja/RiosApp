<?php
echo __DIR__;

require __DIR__ . "/functions.php";
$path = $_SERVER["HTTP_HOST"]  === "riosapp.zeabur.app" ? __DIR__ . "/../" : __DIR__;
echo $path;

dd($_SERVER);
