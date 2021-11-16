<?php
namespace App\Helpers;


class SessionGlobalHelper
{
    public static function start()
    {
        if (isset($_SESSION) == false) {
            session_start();
        }
    }

    public static function set($key, $val)
    {
        self::start();
        $_SESSION[$key] = $val;
    }

    public static function get($key, $default = null)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return $default;
    }

    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}