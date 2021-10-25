<?php
namespace App\helpers;

class LoginHelper
{
    public const MEMBER_ID = "member_id"; // (1)
    
    public static function isLogin() // (2)
    {
        return SessionGlobalHelper::get(self::MEMBER_ID) !== null; //(3)
    }

    public static function memberId(){ // (4)
        return SessionGlobalHelper::get(self::MEMBER_ID);
    }
}