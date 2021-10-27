<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $allowedFields = ['title', 'content', 'author', 'html_content'];
    protected $primaryKey = "post_id";

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $returnType = "App\Entities\PostEntity";

    protected $validationRules = [
    'title' => 'required|min_length[4]|max_length[100]',
    'content' => 'required|min_length[10]|max_length[512]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => '제목이 필요합니다',
            'min_length' => '제목은 최소 4글자 이상입니다.',
            'max_length' => '제목은 최대 100글자 이하입니다.'
        ],
        'content' => [
            'required' => '본문이 필요합니다',
            'min_length' => '본문은 최소 10글자 이상입니다.',
            'max_length' => '본문은 최대 512글자 이하입니다.'
        ],
];
}