<?php

namespace App\Entities;

class SampleEntity extends \CodeIgniter\Entity
{    
    protected $datamap = [
        'name' => 'person_name'
    ];
    
    public function setLoginPw($login_pw)
    {
        $this->attributes['login_pw'] = password_hash($login_pw, PASSWORD_BCRYPT);
        $this->attributes['origin_login_pw'] = $login_pw;
    }
    
    public function getAge(){
        if ($this->attributes['age'] >= 20){
            return "adult";
        }
        if ($this->attributes['age'] >= 10){
            return "student";
        }
        if ($this->attributes['age'] >= 5){
            return "kids";
        }
        return "baby";
    }
    
    public function checkUser($origin_password): bool
    {
        $hashed_password = $this->attributes['login_pw'];
        return password_verify($origin_password, $hashed_password);
    }
    
    public function getFullData(){
        return $this->attributes['person_name'] . " " . $this->attributes['age'] . " ";
    }
}