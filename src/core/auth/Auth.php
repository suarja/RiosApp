<?php
class Auth
{
    public static function handle()
    {
        $isLogged = $_SESSION["user"]["isLogged"] ?? false;
        if (!$isLogged) {
            header("Location: /login");
            exit;
        }
    }
}
