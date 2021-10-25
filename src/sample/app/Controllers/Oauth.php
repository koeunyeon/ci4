<?php


namespace App\Controllers;


use App\Models\MemberModel;
use CodeIgniter\Controller;
use Hybridauth\Provider\Google; // (1)

class Oauth extends Controller
{
    private function getConfig(){ // (2)
        $config = [
            'callback' => 'http://localhost:8080/oauth/google',
            'keys' => [
                'id' => env("oauth.google.id"),
                'secret' => env("oauth.google.secret")
            ],
        ];

        return $config;
    }

    public function google() // (3)
    {
        $adapter = new Google($this->getConfig());
        $adapter->authenticate(); // (4)

        if ($adapter->isConnected()){ // (5)            
            $userProfile = $adapter->getUserProfile(); // (6)

            $identifier = $userProfile->identifier ?? null; // (7)
            $displayName = $userProfile->displayName ?? null; // (8)

            $model = new MemberModel();
            $exist_data = $model->where([ // (9)
                'identifier'=> $identifier,
                'social_name' => 'google'
            ])->first();                

            $member_id = null;
            if ($exist_data == null){  // (10)
                $member_id = $model->insert([
                    'social_name' => 'google',
                    'identifier' => $identifier,
                    'member_name' => $displayName
                ]);
            }else{
                $member_id = $exist_data['member_id'];  // (11)
            }

            $_SESSION['member_id'] = $member_id;  // (12)
            $this->response->redirect("/post");

        }else{ // (13)
            $this->response->redirect("/post");
        }
    }

    public function logout(){ // (14)
        $adapter = new Google($this->getConfig());
        $adapter->disconnect(); // (15)

        if (isset($_SESSION['member_id'])){ // (16)
            unset($_SESSION['member_id']);
        }

 $this->response->redirect("/post");
    }
}