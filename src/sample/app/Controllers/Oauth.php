<?php


namespace App\Controllers;


use App\Models\MemberModel;
use CodeIgniter\Controller;
use Hybridauth\Provider\Google;

class Oauth extends Controller
{
    private function getConfig(){
        $config = [
            'callback' => 'http://localhost:8080/oauth/google',
            'keys' => [
                'id' => env("oauth.google.id"),
                'secret' => env("oauth.google.secret")
            ],
        ];

        return $config;
    }

    public function google()
    {
        $adapter = new Google($this->getConfig());
        $adapter->authenticate();

        if ($adapter->isConnected()){
            $userProfile = $adapter->getUserProfile();

            $identifier = $userProfile->identifier ?? null;
            $displayName = $userProfile->displayName ?? null;

            $model = new MemberModel();
            $exist_data = $model->where([
                'identifier'=> $identifier,
                'social_name' => 'google'
            ])->first();                

            $member_id = null;
            if ($exist_data == null){
                $member_id = $model->insert([
                    'social_name' => 'google',
                    'identifier' => $identifier,
                    'member_name' => $displayName
                ]);
            }else{
                $member_id = $exist_data['member_id'];
            }

            $_SESSION['member_id'] = $member_id;
            $this->response->redirect("/post");

        }else{
            $this->response->redirect("/post");
        }
    }

    public function logout(){
        $adapter = new Google($this->getConfig());
        $adapter->disconnect();

        if (isset($_SESSION['member_id'])){
            unset($_SESSION['member_id']);
        }

        $this->response->redirect("/post");
    }
}