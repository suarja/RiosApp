<?php
require base_path('/src/core/auth/Auth.php');
require base_path('/src/core/auth/Gest.php');
class Midddleware
{
    const MAP = [
        'auth' => Auth::class,
        'gest' => Gest::class
    ];
    public static function resolve($key)
    {
        if (!array_key_exists($key, self::MAP)) {
            return;
        }
        $middleware = self::MAP[$key];
        if (!class_exists($middleware)) {
            throw new Exception("Middleware class not found");
        }
        return $middleware::handle();
    }
}
