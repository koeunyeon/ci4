<?php
namespace App\Helpers;

class LoginHelper
{
    public const MEMBER_ID = "member_id";
    
    public static function isLogin()
    {
        return SessionGlobalHelper::get(self::MEMBER_ID) !== null;
    }

    public static function memberId(){
        return SessionGlobalHelper::get(self::MEMBER_ID);
    }
}