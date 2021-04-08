<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $allowedFields = ['title', 'content', 'author'];
    protected $primaryKey = "post_id";

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}