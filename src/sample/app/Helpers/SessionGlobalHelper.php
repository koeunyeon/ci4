<?php
namespace App\helpers;


class SessionGlobalHelper
{
    public static function start() // (1)
    {
        if (isset($_SESSION) == false) {  // (2)
            session_start();
        }
    }

    public static function set($key, $val) // (3)
    {
        self::start();
        $_SESSION[$key] = $val;
    }

    public static function get($key, $default = null)  // (4)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return $default;
    }

    public static function remove($key) // (5)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}