<?php


namespace App\Controllers;


use CodeIgniter\Controller;

class Devblog extends Controller
{
    public function list(){
        return view("/devblog/list");
    }

    public function post(){
        return view("/devblog/post");
    }
}